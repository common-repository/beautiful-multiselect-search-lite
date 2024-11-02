<?php
/**
 * @package Beautiful Multiselect Search
 */

//***************************************************************
//classe etendue de WP_Widget permettant d acceder à ses methodes
//***************************************************************
class cpc_bms_Widget_Beautiful_Multiselect_Search_Lite extends WP_Widget {
    function __construct() {
        load_plugin_textdomain( 'beautiful-multiselect-search' );
        parent::__construct(
            'beautiful-multiselect-search-lite',
            __( 'Beautiful Multiselect Search Lite' , 'beautiful-multiselect-search-lite'),
            array( 'description' => __( 'POST multiselect Search (by categories)' , 'beautiful-multiselect-search-lite') )
        );
        add_filter('query_vars', array($this, 'cpc_bms_add_query_vars'));
        add_filter('rewrite_rules_array', array($this, 'cpc_bms_add_rewrite_rules'));
    }

    function cpc_bms_add_query_vars($aVars) {
        $aVars[] = "cpc_bms_url_cat";
        $aVars[] = "cpc_bms_default_cat";
        $aVars[] = "cpc_bms_page";
        return $aVars;
    }

    // recupere dans url la categorie par default et les categories recherchées serialisées
    function cpc_bms_add_rewrite_rules($aRules) {
        $urldusite = get_bloginfo('wpurl');
        $permalink_site = get_permalink();
        $aNewRules = array(
            '([^/]+)/cpc_bms_searchr/([^/]+)/([^/]+)/?$' => 'index.php/?pagename=$matches[1]&cpc_bms_default_cat=$matches[2]&cpc_bms_url_cat=$matches[3]',
            '([^/]+)/cpc_bms_searchr/([^/]+)/([^/]+)/page/([^/]+)/?$' => 'index.php/?pagename=$matches[1]&cpc_bms_default_cat=$matches[2]&cpc_bms_url_cat=$matches[3]&cpc_bms_page=$matches[4]'
        );
        $aRules = $aNewRules + $aRules;
        return $aRules;
    }


    public function widget($args,$instance) {
        $bms_get_options=get_option('cpc_bms_admin_options');
        $bms_get_aoptions=get_option('cpc_bms_advanced_admin_options');
        $bms_get_textmod=get_option('cpc_bms_admin_text_mod');
        if (is_page_template("template-beautiful-multiselect-search1.php")){
            //*****************************
            //affichage  du widget  ********
            //*****************************
            extract($args);
            global $post;
            global $wp_query;
            $urlCat=$defaultCat=$default_category="";
            $id=get_the_ID();
            /* recupere le nom de la page */
            $pagename = $post->post_name;
            /* recuperer type recherche url actuellement juste categories */
            /* test sur url car a l'arrivee sur la page, avant de faire une première recherche
            les variables dans l'url - cpc_bms_url_cat etc. - ne sont pas encore définies on verifie qu une recherche a été lancee
            avec le mot cle cpc_bms_searchr present dans l url*/
            $searchpermalink=0;
            /* si recherche avec permalien */
            if (strpos($_SERVER['REQUEST_URI'], "cpc_bms_searchr")){
                $urlCat = unserialize(urldecode($wp_query->query_vars['cpc_bms_url_cat']));
                $defaultCat = urldecode($wp_query->query_vars['cpc_bms_default_cat']);
                $searchpermalink=1;
            }
            /* si recherche sans permalien */
            else {
                if ((isset($_GET['defaultcrit']))&&($_GET['defaultcrit']!="")){$defaultCat=intval($_GET['defaultcrit']);}
            }
            $default_category = $instance['default_category'];
            echo $before_widget;
            /*------------------------------------------------------------*/
            /* champs cachés permettant d avoir les criteres dans la page */
            /*------------------------------------------------------------*/
            echo "<input type='hidden' name='default_critere' id='default_critere' value='".$defaultCat."' />";
            echo "<input type='hidden' name='default_critere_instance' id='default_critere_instance' value='".$default_category."' />";

            for ($i = 1; $i <= 5; $i++) {
                $urlCat_critere="";
                /* si permalien */
                if ((isset($urlCat['critere'.$i]))&&($urlCat['critere'.$i]!="")){$urlCat_critere=intval($urlCat['critere'.$i]);}
                /* si pas de permalien */
                if ((isset($_GET['critere'.$i]))&&($_GET['critere'.$i]!="")){$urlCat_critere=intval($_GET['critere'.$i]);}
                echo "<input type='hidden' name='bms_crit_search_critere".$i."' id='bms_crit_search_critere".$i."' value='".$urlCat_critere."' />";
            }
            /*-------------------------------------*/
            /* affichage des criteres selectionnes */
            /*-------------------------------------*/
            $cat_name_critere ="";
            $displayselectedcritere=0;
            $displaycancelcritere=0;
            /* */
            for ($k = 1; $k <= 5; $k++) {
                /* si permalien */
                if(isset($urlCat['critere'.$k])){
                    $cat_name_critere[$k] = sanitize_text_field(get_cat_name( $urlCat['critere'.$k] ));
                    $cat_id_critere[$k]=intval($urlCat['critere'.$k]);

                }
                /* si pas de permalien */
                if(isset($_GET['critere'.$k])){
                    $cat_name_critere[$k] = sanitize_text_field(get_cat_name( $_GET['critere'.$k] ));
                    $cat_id_critere[$k]=intval($_GET['critere'.$k]);
                }
                if(isset($cat_name_critere[$k])){
                    if (($cat_name_critere[$k]!="")&&($displayselectedcritere!=1)){
                        echo '<div class="bms-rappel">';
                        if (!isset($bms_get_textmod['search_selection'])){
                            _e('YOUR SELECTION','beautifulmultiselectsearch');;
                        }
                        elseif (isset($bms_get_textmod['search_selection'])){
                            if ($bms_get_textmod['search_selection']=="") {
                                _e('YOUR SELECTION','beautifulmultiselectsearch');;
                            }
                            elseif ($bms_get_textmod['search_selection']!=""){
                                echo (sanitize_text_field($bms_get_textmod['search_selection']));
                            }
                        }
                        echo '</div>';
                        $displayselectedcritere=1;
                    }
                    if (strlen($cat_name_critere[$k])>=30){
                        $substr_cat_name_critere=sanitize_text_field(substr($cat_name_critere[$k], 0, 30))."...";
                    }
                    else{
                        $substr_cat_name_critere=sanitize_text_field($cat_name_critere[$k]);
                    }
                    // teste si c'est une soucatégorie ou une catégorie
                    $category = get_category(intval($cat_id_critere[$k]));
                    // si la catégorie a un parent - c'est une sous catégorie
                    if ($category->category_parent > 0){
                        echo '<a class="bms-selectedcritere bms-selectedcritere'.$k.'" onclick="del_val_crit(\'critere'.$k.'\',\''.$defaultCat.'\',\''.$searchpermalink.'\');">
                        <span style="padding-left: 15px;">'.$substr_cat_name_critere.'</span></a>';
                    }
                    // si c'est une catégorie sans parent - categorie principale
                    else{
                        // si le titre de la catégorie a été mis a jour dans le widget
                        if (isset($instance['title_category'.$k.''])){
                            if ($instance['title_category'.$k.'']!=""){
                                echo '<a class="bms-selectedcritere bms-selectedcritere'.$k.'" onclick="del_val_crit(\'critere'.$k.'\',\''.$defaultCat.'\',\''.$searchpermalink.'\');">
                        <span style="padding-left: 15px;">'.$instance['title_category'.$k.''].'</span></a>';
                            }
                            else {
                                echo '<a class="bms-selectedcritere bms-selectedcritere'.$k.'" onclick="del_val_crit(\'critere'.$k.'\',\''.$defaultCat.'\',\''.$searchpermalink.'\');">
                        <span style="padding-left: 15px;">'.$substr_cat_name_critere.'</span></a>';
                            }

                        }

                    }
                }
            }
            echo '<a class="bms-cancelselectedcritere" onclick="del_all_crit(\''.$defaultCat.'\',\''.$searchpermalink.'\');">';
            if (!isset($bms_get_textmod['search_erase'])){
                _e('DELETE ALL CRITERIAS','beautifulmultiselectsearch');
            }
            elseif (isset($bms_get_textmod['search_erase'])){
                if ($bms_get_textmod['search_erase']=="") {
                    _e('DELETE ALL CRITERIAS','beautifulmultiselectsearch');
                }
                elseif ($bms_get_textmod['search_erase']!=""){
                    echo (sanitize_text_field($bms_get_textmod['search_erase']));
                }
            }
            echo '</a>';
            if($instance['title']!=''){
                echo '<div class="bms-titrerecherche">';
                if ($bms_get_options['qmcolor']){
                    echo ' <div class="bms-point-interrogation">
							<div class="bms-boite-interrogation">
								<img class="bms-imgpointinterrogation" src="'.cpc_bms_BEAUTIFUL_MULTISELECT_SEARCH_URL.'images/point-interrogationx2'.$bms_get_options['qmcolor'].'square.png" align="center" alt="">
							</div>
						</div>';
                }
                echo '<div class="bmstitrerecherchetexte">'.$instance['title'].'</div>
				</div>';
                $bmsadminoptions = get_option("cpc_bms_admin_options");
                if (!empty($bmsadminoptions)) {
                    foreach ($bmsadminoptions as $key => $option)
                        $bmsoptionsarray[$key] = $option;
                }
            }
            $args = array(
                'type' => 'post', 'child_of' => 0,'parent' => '','orderby' => 'slug','order' => 'ASC', 'hide_empty' => true,
                'hierarchical' => 1, 'exclude'  => '','include' => '','number' => '',
                'taxonomy' => 'category', 'pad_counts' => false
            );
            $categories = get_categories($args);
            /*--------------------------------------- */
            /* 1ere boucle avec le nombre de criteres */
            /*--------------------------------------- */
            $query_cat='';
            if (isset($instance['nb_critere'])){
                $nbcrit=intval($instance['nb_critere']);
            }
            else {
                $nbcrit=1;
            }
            for ($i = 1; $i <= $nbcrit; $i++) {
                /*------------------------------------------------------------------------------------------------------ */
                /* category : première boucle pour afficher la categorie principale sans les eventuelles sous-categories */
                /*------------------------------------------------------------------------------------------------------ */
                foreach($categories as $category) {
                    if(isset($instance['category'.$i.''])){
                        if ($instance['category'.$i.''] == $category->cat_ID) {
                            /* on teste si la category contient des sous categories en mettant l'id de la category dans child of et hide_empty a false */
                            $cat1_id = $category->cat_ID;
                            $args1 = array(
                                'type' => 'post', 'child_of' => $cat1_id,'parent' => '','orderby' => 'name','order' => 'ASC', 'hide_empty' => false,
                                'hierarchical' => 1, 'exclude'  => '','include' => '','number' => '',
                                'taxonomy' => 'category', 'pad_counts' => false
                            );
                            $sub_categories1 = get_categories($args1);
                            /* si il y a des sous categories */
                            if ($sub_categories1) {
                                /* si le titre de la categorie a bien ete saisi */
                                if ($instance['title_category'.$i.'']!=''){
                                    echo '<ul class="bms-critere-avec-sous-categorie">'.$instance['title_category'.$i.''];
                                }
                                /* si pas de titre saisi on prend le nom de la categorie */
                                else {
                                    echo '<ul class="bms-critere-avec-sous-categorie">'.$category->name;
                                }
                            }
                            /* categorie sans sous categorie */
                            else {
                                echo '<ul class="bms-critere-sans-sous-categorie">
													<li class="bms-lisanssouscategorie">';
                                /* si la categorie sans sous categorie a ete selectionne, cad presente dans l url on permet la suppression de la categorie */ /* si permaliens $urlCat OU sans permalien $_GET  */
                                if (((isset($urlCat['critere'.$i]))&&($urlCat['critere'.$i]!="")&&(get_cat_name($urlCat['critere'.$i])==$category->name))
                                    ||((isset($_GET['critere'.$i]))&&($_GET['critere'.$i]!="")&&(get_cat_name($_GET['critere'.$i])==$category->name))){
                                    echo '<a class="bms-sous-categorie soucat'.$i.'" onclick="del_val_crit(\'critere'.$i.'\',\''.$defaultCat.'\',\''.$searchpermalink.'\');">';
                                }
                                else {
                                    echo '<a class="bms-sous-categorie soucat'.$i.'" onclick="change_val_crit(\'critere'.$i.'\',\''.$category->cat_ID.'\',\''.$default_category.'\');">';
                                }
                                /* si la sous categorie a ete selectionne, cad presente dans l url */ /* si permaliens */
                                if ((isset($urlCat['critere'.$i]))&&($urlCat['critere'.$i]!="")&&($urlCat['critere'.$i]==$category->cat_ID))
                                {
                                    echo '<i class="fa fa-check-circle bms_disablepicto"></i>&nbsp;&nbsp;';
                                }
                                /* si la sous categorie a ete selectionne, cad presente dans l url */ /* si pas permalien */
                                elseif ((isset($_GET['critere'.$i]))&&($_GET['critere'.$i]!="")&&($_GET['critere'.$i]==$category->cat_ID))
                                {
                                    echo '<i class="fa fa-check-circle bms_disablepicto"></i>&nbsp;&nbsp;';
                                }
                                else {
                                    echo '<div class="bms-selecteur-sous-categorie soucat'.$i.'"></div>';
                                }
                                /* si titre saisi on prend le nom de la categorie */
                                if ($instance['title_category'.$i.'']!=''){
                                    echo $instance['title_category'.$i.''].'</a></li>';
                                }
                                /* si pas de titre saisi on prend le nom de la categorie */
                                else {
                                    echo $category->name.'</a></li>';
                                }
                            }
                        }
                    }
                }
                /*------------------------------------------------------------------------ */
                /* category : deuxième boucle pour afficher les eventuelles sous-categories */
                /*------------------------------------------------------------------------ */
                $k=0;
                foreach($categories as $category) {
                    if (isset($instance['category'.$i.''])){
                        if (($instance['category'.$i.''] == $category->category_parent)&&($instance['category'.$i.'']!='')) {
                            /* si la sous categorie a ete selectionne, cad presente dans l url on permet la suppression de la categorie */ /* si permaliens $urlCat OU sans permalien $_GET  */
                            if (((isset($urlCat['critere'.$i]))&&($urlCat['critere'.$i]!="")&&(get_cat_name($urlCat['critere'.$i])==$category->name))
                                ||((isset($_GET['critere'.$i]))&&($_GET['critere'.$i]!="")&&(get_cat_name($_GET['critere'.$i])==$category->name)))
                            {
                                echo '<li class="bms-liavecsouscategorie"><a class="bms-sous-categorie soucat'.$i.$k.'" onclick="del_val_crit(\'critere'.$i.'\',\''.$defaultCat.'\',\''.$searchpermalink.'\');">';
                            }
                            /* sinon on permet la selection */
                            else {
                                echo '<li class="bms-liavecsouscategorie"><a class="bms-sous-categorie soucat'.$i.$k.'" onclick="change_val_crit(\'critere'.$i.'\',\''.$category->cat_ID.'\',\''.$default_category.'\');">';
                            }
                            /* si la sous categorie a ete selectionne, cad presente dans l url */ /* si permaliens */
                            if ((isset($urlCat['critere'.$i]))&&($urlCat['critere'.$i]!="")&&($urlCat['critere'.$i]==$category->cat_ID))
                            {
                                echo '<i class="fa fa-check-circle bms_disablepicto"></i>&nbsp;&nbsp;';
                            }
                            /* si la sous categorie a ete selectionne, cad presente dans l url */ /* si pas permalien */
                            elseif ((isset($_GET['critere'.$i]))&&($_GET['critere'.$i]!="")&&($_GET['critere'.$i]==$category->cat_ID))
                            {
                                echo '<i class="fa fa-check-circle bms_disablepicto"></i>&nbsp;&nbsp;';
                            }
                            else {
                                echo '<div class="bms-selecteur-sous-categorie soucat'.$i.$k.'"></div>';
                            }
                            // suppression  de l'appel de la fonction de le prédiction du nombre de résultats version Lite
                            echo $category->name.'</a></li>';

                            $k++;
                        }
                    }
                }
                echo '</ul>';
            }

            wp_reset_postdata($post);
            echo $after_widget;
        }
        /* fin du si le widget se trouve dans un template beautiful-multiselect-search */
        else {
            _e('You have to put Beautiful Multiselect Search Widget in Beautiful Multiselect Search1 Sidebar and not in another Sidebar. With the Lite Plugin Version, you are limited to 1 BMS Search.','beautifulmultiselectsearch');
            echo ('<br>');
            _e('Don\'t worry, it\'s very easy and fast to modify, go to menu Appearance Widgets and drag and drop the widget in the Beautiful Multiselect Search1 Sidebar.','beautifulmultiselectsearch');
            echo ('<br>');
            echo ('<br>');
            _e('You need more than 1 search or more than 5 criteria in your search and so much more...','beautifulmultiselectsearch');
            echo(' : <a href="');
            echo (cpc_bms_PRO_VERSION_URL);
            echo('" target="_blank">');
            _e('click here to download pro version.','beautifulmultiselectsearch');
            echo('</a>');
            echo ('<br>');

        }
    }
    public function update($new_instance,$old_instance) {
        //*****************************
        // Mise à jour des options ****
        //*****************************
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['default_category'] = strip_tags($new_instance['default_category']);
        $instance['nb_critere'] = strip_tags($new_instance['nb_critere']);
        /* modification version Lite */
        $nb_criteres = 5;
        for ($j = 1; $j <= $nb_criteres; $j++){
            if (isset($new_instance['title_category'.$j.''])){
                $instance['title_category'.$j.''] = strip_tags($new_instance['title_category'.$j.'']);
            }
            if (isset($new_instance['category'.$j.''])) {
                $instance['category'.$j.''] = strip_tags($new_instance['category'.$j.'']);
            }
        }
        $instance['vignette'] = strip_tags($new_instance['vignette']);
        return $instance;
    }
    public function form($instance) {
        //****************************
        // Formulaire des réglages ***
        //****************************
        $defaults = array ('title' => 'Search', 'default_category' => '', 'nb_critere' => 1, 'vignette' => 'none', 'title_category1' => '', 'category1' => '', 'title_category2' => '', 'category2' => '', 'title_category3' => '', 'category3' => '', 'title_category4' => '', 'category4' => '', 'title_category5' => '', 'category5' => '');
        $instance = wp_parse_args($instance, $defaults);
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>">Widget title:</label>
            <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width: 100%;"/>
        </p>
        <label for="<?php echo $this->get_field_id( 'nb_critere' ); ?>">How many main categories do you want to display ? (don't count sub categories)</label>
        <select id="<?php echo $this->get_field_id( 'nb_critere' ); ?>" name="<?php echo $this->get_field_name( 'nb_critere' ); ?>" value="<?php echo $instance['nb_critere']; ?>" class="widget_nb_critere" style="width: 100%;">
            <?php
            for($k=1 ; $k<=5 ; $k++){
                if($instance['nb_critere']==$k){
                    $selected='selected="selected"';
                }
                else{
                    $selected='';
                }
                echo '<option '.$selected.' value="'.$k.'">'.$k.'</option>';
            }
            ?>
        </select>
        <p>
            <label for="<?php echo $this->get_field_id( 'default_category' ); ?>">DEFAULT CATEGORY (used if no category selected - should include all results):</label>
            <select id="<?php echo $this->get_field_id( 'default_category' ); ?>" name="<?php echo $this->get_field_name( 'default_category' ); ?>" value="<?php echo $instance['default_category']; ?>" style="width: 100%;">
                <?php
                if($instance['default_category']=='all'){
                    $selected='selected="selected"';
                }
                else{
                    $selected='';
                }
                echo '<option '.$selected.' value="all">ALL CATEGORIES</option>';
                $selected='';
                foreach((get_categories()) as $cat){
                    /* on affiche que les categories et pas les sous categories */
                    if ($cat->parent==0){

                        if($instance['default_category']==$cat->cat_ID){
                            $selected='selected="selected"';
                        }
                        else{
                            $selected='';
                        }
                        echo '<option '.$selected.' value="'.$cat->cat_ID.'">'.$cat->cat_name.'</option>';
                    }
                }
                ?>
            </select>
        </p>
        <?php
        /* nombre de criteres possibles affichés */
        $nb_crit=$instance['nb_critere'];
        for ($i = 1; $i <= $nb_crit; $i++) { ?>
            <p>
                <label for="<?php echo $this->get_field_id( 'category'.$i.'' ); ?>" class="labelselectcategorie<?php echo $i ;?>">Select main category <?php echo $i ;?>:</label>
                <select class="selectcategorie<?php echo $i ;?>" id="<?php echo $this->get_field_id( 'category'.$i.'' ); ?>" name="<?php echo $this->get_field_name( 'category'.$i.'' ); ?>" value="<?php echo $instance['category'.$i.'']; ?>" style="width: 100%;">
                    <option></option>
                    <?php
                    foreach((get_categories()) as $cat){
                        /* on affiche que les categories et pas les sous categories */
                        if ($cat->parent==0){

                            if($instance['category'.$i.'']==$cat->cat_ID){
                                $selected='selected="selected"';
                            }
                            else{
                                $selected='';
                            }
                            echo '<option '.$selected.' value="'.$cat->cat_ID.'">'.$cat->cat_name.'</option>';
                        }
                    }
                    ?>
                </select>
                <label for="<?php echo $this->get_field_id( 'title_category'.$i.'' ); ?>" class="labeltitlecategorie<?php echo $i ;?>">Title main category <?php echo $i ;?> (category name above if no fill):</label>
                <input type="text" id="<?php echo $this->get_field_id( 'title_category'.$i.'' ); ?>" name="<?php echo $this->get_field_name( 'title_category'.$i.'' ); ?>" value="<?php echo $instance['title_category'.$i.'']; ?>" style="width: 100%;" class="titlecategorie<?php echo $i ;?>"/>
            </p>
            <?php
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'vignette' ); ?>">Thumbnail size:</label>
            <select id="<?php echo $this->get_field_id( 'vignette' ); ?>" name="<?php echo $this->get_field_name( 'vignette' ); ?>" value="<?php echo $instance['vignette']; ?>" style="width: 100%;">
                <option <?php if($instance['vignette']=="none"){echo('selected="selected"');}?> value="none">none</option>
                <option <?php if($instance['vignette']=="thumbnail"){echo('selected="selected"');}?> value="thumbnail">thumbnail</option>
                <option <?php if($instance['vignette']=="medium"){echo('selected="selected"');}?> value="medium">medium</option>
                <option <?php if($instance['vignette']=="large"){echo('selected="selected"');}?> value="large">large</option>
                <option <?php if($instance['vignette']=="full"){echo('selected="selected"');}?> value="full">full</option>
            </select>
        </p>
        <?php
    }
}
//**************************************
// fin de la classe etendue de WP_Widget
//**************************************



if (class_exists("cpc_bms_Widget_Beautiful_Multiselect_Search_Lite")) {
    //*******************************************************************
    // en dehors de la classe fait apparaitre widget dans menu Extensions
    //*******************************************************************
    function cpc_bms_register_beautiful_multiselect_widget_bms() {
        register_widget('cpc_bms_Widget_Beautiful_Multiselect_Search_Lite');
    }
    //***************************************************
    // fait apparaitre widget dans menu apparence/widgets // a activer dans extensions
    //***************************************************
    add_action( 'widgets_init', 'cpc_bms_register_beautiful_multiselect_widget_bms');
}
//***************************************************
// Fonctions
//***************************************************
function cpc_bms_getbmspagetemplatenumber() {
    get_the_ID();
    $pageid = get_the_ID();
    $templatefilename = get_page_template_slug($pageid);
    echo substr($templatefilename,-5,1);
}
//**************************************************************************************
// Recherche et affichage des articles recherchés sur une ou plusieurs categories ******
//**************************************************************************************
function cpc_bms_post_search_beautiful_multiselect($tab_categories_search,$nb_criteres,$default_cat,$page_bms_result,$vignette) {
    $custom_currency="";
    $bms_get_options=get_option('cpc_bms_admin_options');
    $bms_get_aoptions=get_option('cpc_bms_advanced_admin_options');
    $bms_get_textmod=get_option('cpc_bms_admin_text_mod');
    global $post;
    global $wp_rewrite;
    $permal = $wp_rewrite->using_permalinks();
    $pageid = get_the_ID();
    //**************
    // Recherche ***
    //**************
    $arg_categories_and="";
    for($j=1;$j<=$nb_criteres;$j++){
        /* si le critere actuel n'est pas nul */
        if((isset($tab_categories_search['critere'.$j]))&&(($tab_categories_search['critere'.$j])!="")){
            $arg_categories_and.=(sanitize_text_field($tab_categories_search['critere'.$j]));
            /* recherche s'il existe d'autres criteres non nuls apres le critere actuel pour ajouter une virgule apres le critere actuel le cas echeant*/
            $k=$j+1;
            for($k;$k<=$nb_criteres;$k++){
                if((isset($tab_categories_search['critere'.$k]))&&(($tab_categories_search['critere'.$k])!="")){
                    $arg_categories_and.=',';
                    break;
                }
            }
        }
    }
    $tab_categorie_and = explode(",", $arg_categories_and);
    /* valeur par defaut */
    $bmsresultperpage =-1;
    /* valeur par defaut */
    $arg_querystring="";
    /* valeur de la page d'admin */
    if ($arg_categories_and!="") {
        $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
        $the_query = new WP_Query (
            array(
                'category__and' => $tab_categorie_and,
                'posts_per_page' => $bmsresultperpage,
                'paged' => $page_bms_result,
                's' => $arg_querystring,
                'order' => 'DESC',
                'post_type' => 'post'
            )
        );
    }
    else {
        /* categories par default a afficher si pas de critere */
        /* si la categorie par defaut est 'all' on affiche toutes les categories*/
        if ($default_cat=='all'){
            $the_query = new WP_Query (
                array(
                    'posts_per_page' => $bmsresultperpage,
                    'paged' => $page_bms_result,
                    's' => $arg_querystring,
                    'order' => 'DESC',
                    'post_type' => 'post'
                )
            );
        }
        /* sinon on affiche la catégorie par défault */
        else {
            $the_query = new WP_Query (
                array(
                    'cat' => $default_cat,
                    'posts_per_page' => $bmsresultperpage,
                    'paged' => $page_bms_result,
                    's' => $arg_querystring,
                    'order' => 'DESC',
                    'post_type' => 'post'
                )
            );

        }
    }
    //**************
    // Affichage ***
    //**************
    echo '<a id="result-bms"></a><div class="bms-resultat-recherche">';
    if ((($the_query->found_posts)&&(($the_query->found_posts)>1))&&((!isset($bms_get_textmod['result_header']))||($bms_get_textmod['result_header']==""))){
        _e('Search results','beautifulmultiselectsearch');
    }
    elseif ((($the_query->found_posts)&&(($the_query->found_posts)>1))&&((isset($bms_get_textmod['result_header']))||($bms_get_textmod['result_header']!=""))){
        echo ($bms_get_textmod['result_header']);
    }
    elseif ((($the_query->found_posts)&&(($the_query->found_posts)==1))&&((!isset($bms_get_textmod['result_header']))||($bms_get_textmod['result_header']==""))){
        _e('Search result','beautifulmultiselectsearch');
    }
    elseif ((($the_query->found_posts)&&(($the_query->found_posts)==1))&&((isset($bms_get_textmod['result_header']))||($bms_get_textmod['result_header']!=""))){
        echo ($bms_get_textmod['result_header']);
    }
    echo '</div>';

    if($the_query->have_posts()){

        while ($the_query->have_posts()){
            $the_query->the_post();
            $post_id_=get_the_ID();
            echo "<div class='bms-resultposttitle'><a href='";
            the_permalink();
            echo "'>";
            the_title();
            echo "</a></div>";

//            if(!isset($instance['nb_critere'])){
//                $cpc_bms_inst_nb_critere = "none";
//            }
//            else {
//                $cpc_bms_inst_nb_critere = $instance['nb_critere'];
//            }

            if ((has_post_thumbnail())&&($vignette!="none")){
                echo "<a style='border: none;' href='";
                the_permalink();
                echo "'>";
                the_post_thumbnail($vignette);
                echo "</a>";
            }
            echo "<div class='bms-extrait'>";
            /* si l'option swowallpost est cochee dans l'admin */
            if (isset($bms_get_aoptions['showallpost'])&&($bms_get_aoptions['showallpost']=="on")){

                $texte=strip_tags($post->post_content);
                $more_texte="</div>";
                $showallpost=true;
            }
            else {
                /*350 char par defaut */
                if ((isset($bms_get_aoptions['nbchar']))&&($bms_get_aoptions['nbchar']!="")){
                    $nbchar=$bms_get_aoptions['nbchar'];
                    $texte = substr(strip_tags($post->post_content),0,$nbchar);
                }
                else{
                    $texte = substr(strip_tags($post->post_content),0,350);
                }
                $more_texte="...</div>";
                $showallpost=false;
            }
            /* supprime les shortcode entre crochets */
            $texte = preg_replace('#\[(.+)\]#U', '', $texte);
            echo ($texte);
            echo $more_texte;
            /* si on ne montre pas tout le texte du post, affichage texte Read more par defaut ou celui de l'admin s'il est saisi */
            if(!$showallpost){
                echo "<a class='bms-read-more' href='";
                the_permalink();
                echo "'>";
                if (!isset($bms_get_textmod['result_more'])){
                    _e('Read more','beautifulmultiselectsearch');
                }
                elseif (isset($bms_get_textmod['result_more'])){
                    if ($bms_get_textmod['result_more']=="") {
                        _e('Read more','beautifulmultiselectsearch');
                    }
                    elseif ($bms_get_textmod['result_more']!=""){
                        echo ($bms_get_textmod['result_more']);
                    }
                }
                echo "<!--<img class='bms-imgreadmore' src='".cpc_bms_BEAUTIFUL_MULTISELECT_SEARCH_URL."images/read-more.png' align='center' alt=''>--></a>";
            }

        }
        $wpurl=get_bloginfo('wpurl');
        /* si permalien */
        if ($permal==1){
            if ($tab_categories_search!="") {
                $urlrechcat = serialize ($tab_categories_search);
                /* corrige bug safari */
                $urlrechcat = str_replace("{","%7B",$urlrechcat);
                $urlrechcat = str_replace("}","%7D",$urlrechcat);
                $urlrechcat ='/'.$urlrechcat;
            }
            else {
                $urlrechcat="/a:0:%7B%7D";
            }
        }
        /* pas de permalien */
        else {
            if ($tab_categories_search!="") {
                foreach ($tab_categories_search as $key => $value) {
                    $urlrechcat='&'.sanitize_text_field($key).'='.intval($value);
                }
            }
            else {
                $urlrechcat="";
            }
        }
        $pagename = get_query_var('pagename');
        $classabmsresult="";
        $classabmsresultfirstpage="";
        wp_reset_postdata();
    }
    else {
        echo "<div class='bms-noresult'>";
        _e('No result.','beautifulmultiselectsearch');
        echo "</div>";
    }
}


$cpc_bms_objbmswidget = new cpc_bms_Widget_Beautiful_Multiselect_Search_Lite();

register_deactivation_hook( __FILE__, 'flush_rewrite_rules' );
register_activation_hook( __FILE__, 'flush_rewrite_rules'  );


?>