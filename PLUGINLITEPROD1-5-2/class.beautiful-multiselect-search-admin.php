<?php
/* Classe cpc_bms_Beautiful_Multiselect_Search_Admin */
class cpc_bms_Beautiful_Multiselect_Search_Admin {
   public function __construct() {
       $this->bms_templater= new cpc_bms_PageTemplater();
   }  
	function cpc_bms_init_BMS_admin(){
		global $bms_admin_settings_page;
		/* Ajoute menu principal du plugin */
		$bms_admin_settings_page = add_menu_page( 'BM Search settings', 'BM Search', 'manage_options', 'cpc_bms_beautifulmultiselectsearchlite_menu_page', array('cpc_bms_Beautiful_Multiselect_Search_Admin','display_BMS_menu_page'),cpc_bms_BEAUTIFUL_MULTISELECT_SEARCH_URL.'images/picto-menu-left-bms-plugin.png');
    }
	static function display_BMS_menu_page(){
		$bmsadminpage='adminbms_default';
		if ((isset($_GET['p']))&&($_GET['p']!="")){$bmsadminpage = sanitize_text_field($_GET['p']);}
		if ($bmsadminpage=='adminbms_default'){$bmsadmindefaultmenu="selected";}else {$bmsadmindefaultmenu="";}
		if ($bmsadminpage=='adminbms_options'){$bmsadminoptionsmenu="selected";}else {$bmsadminoptionsmenu="";} 
		if ($bmsadminpage=='advancedadminbms_options'){$bmsaadminaoptionstmenu="selected";}else {$bmsaadminaoptionstmenu="";} 
		if ($bmsadminpage=='adminbms_text'){$bmsadmintext="selected";}else {$bmsadmintext="";} 
		if ($bmsadminpage=='adminbms_ecommerce'){$bmsadminecommercemenu="selected";}else {$bmsadminecommercemenu="";} 
		if ($bmsadminpage=='adminbms_faq'){$bmsadminfaqmenu="selected";}else {$bmsadminfaqmenu="";} 
		?>
		<div class="bmsadminmenu">
			<ul class="ulbmsadminmenu">
				<li class="libmsadminmenu">
					<a class="abmsadminmenu <?php echo $bmsadmindefaultmenu;?>" href="?page=cpc_bms_beautifulmultiselectsearchlite_menu_page&p=adminbms_default"><?php _e('Add BMS Search','beautifulmultiselectsearch'); ?></a>
				</li>
				<li class="libmsadminmenu">
					<a class="abmsadminmenu <?php echo $bmsadminoptionsmenu;?>" href="?page=cpc_bms_beautifulmultiselectsearchlite_menu_page&p=adminbms_options"><?php _e('Colors and Themes','beautifulmultiselectsearch'); ?></a>
				</li>
				<li class="libmsadminmenu">
					<a class="abmsadminmenu <?php echo $bmsaadminaoptionstmenu;?>" href="?page=cpc_bms_beautifulmultiselectsearchlite_menu_page&p=advancedadminbms_options"><?php _e('Advanced Options','beautifulmultiselectsearch'); ?></a>
				</li>
				<li class="libmsadminmenu">
					<a class="abmsadminmenu <?php echo $bmsadmintext;?>" href="?page=cpc_bms_beautifulmultiselectsearchlite_menu_page&p=adminbms_text"><?php _e('Text Modifications','beautifulmultiselectsearch'); ?></a>
				</li>

				<li class="libmsadminmenu">
					<a class="abmsadminmenu <?php echo $bmsadminfaqmenu;?>" href="?page=cpc_bms_beautifulmultiselectsearchlite_menu_page&p=adminbms_faq"><?php _e('FAQ','beautifulmultiselectsearch'); ?></a>
				</li>
			</ul>
		</div>
		<?php 
		switch ($bmsadminpage) {
			case 'adminbms_options' :
				require_once( cpc_bms_BEAUTIFUL_MULTISELECT_SEARCH_DIR . 'admintemplate/admin-options-theme-array.php' );
				require_once( cpc_bms_BEAUTIFUL_MULTISELECT_SEARCH_DIR . 'admintemplate/admin-page-template-options.php' ); 
			break;
			case 'advancedadminbms_options' :
				require_once( cpc_bms_BEAUTIFUL_MULTISELECT_SEARCH_DIR . 'admintemplate/admin-options-advanced-array.php' );
				require_once( cpc_bms_BEAUTIFUL_MULTISELECT_SEARCH_DIR . 'admintemplate/advancedadmin-page-template-options.php' ); 
			break;
			case 'adminbms_text' :
				require_once( cpc_bms_BEAUTIFUL_MULTISELECT_SEARCH_DIR . 'admintemplate/admin-page-template-text.php' ); 
			break;
			case 'adminbms_faq' :
				require_once( cpc_bms_BEAUTIFUL_MULTISELECT_SEARCH_DIR . 'admintemplate/admin-page-template-faq.php' ); 
			break;
			default :
				require_once( cpc_bms_BEAUTIFUL_MULTISELECT_SEARCH_DIR . 'admintemplate/admin-page-template-default.php' ); 
			break;
		}
	}
	function cpc_bms_add_BMS_admin_header($hook) {
		/* charge les scripts uniquement si on est sur la page d'admin settings bms */
		global $bms_admin_settings_page;
		if( $hook != $bms_admin_settings_page ) return;
		wp_register_style( 'css_bms_admin-beautifulmultiselectsearch-css', cpc_bms_BEAUTIFUL_MULTISELECT_SEARCH_URL.'css/adminbeautifulmultiselectsearch.css');
		wp_enqueue_style( 'css_bms_admin-beautifulmultiselectsearch-css' );
		wp_register_script(
			'css_bms_admin-beautifulmultiselectsearch-js',cpc_bms_BEAUTIFUL_MULTISELECT_SEARCH_URL.'js/adminbeautifulmultiselectsearch.js');
		wp_enqueue_script(
			'css_bms_admin-beautifulmultiselectsearch-js',cpc_bms_BEAUTIFUL_MULTISELECT_SEARCH_URL.'js/adminbeautifulmultiselectsearch.js',array( 'jquery' ));
	}
	/*---------------------------------------------------------------------*/
	/* creation des sidebar et template de recherche et pages de recherche */
	/*---------------------------------------------------------------------*/
	// en fonction du nombre indiqué dans l'option nb_bmsearch
	function cpc_bms_add_BMS_sidebar_and_template() {
		/* creation des sidebar */
		for ($i = 1; $i <= get_option('cpc_bms_nb_bmsearch','1'); $i++) {
			register_sidebar(array(
				'name'=> __( "Beautiful Multiselect Search".$i.""),
				'id' => 'cpc_bms_search'.$i.'-sidebar',
				'before_widget'=>'<div id="%1$s" class="widget %2$s">',
				'after_widget'=>'</div>',
				'before_title'=>'<h6>',
				'after_title'=>'</h6>'
			));
		}
		/* creation des templates de recherche qui utiliseront les sidebar créés préalablement */
		$nb_bms_template_to_create = $np_pagebms = get_option('cpc_bms_nb_bmsearch');
		$this->bms_templater-> cpc_bms_add_beautifulmultiselectsearch_template(1);

		/* creation des pages de recherche qui utiliseront les templates créés préalablement */
		$pages = get_pages();
		/* ajout initialisation searchtemp*/
		// suppression boucle avec le nombre de pages bms a creer avec le template bms template-beautiful-multiselect-searchX.php version Light
			$trouvepage=false;
			/* boucle pour balayer toutes les pages et vérifier l'existence d'une page avec le template template-beautiful-multiselect-searchX.php */
			foreach ($pages as $pagecourante) {
				$id_bmspage = $pagecourante->ID;
                /* si template de la page comme par template-beautiful-multiselect-search*/
				$searchtemp="template-beautiful-multiselect-search1.php";
				if ((get_page_template_slug($id_bmspage))==$searchtemp){
					$trouvepage=true;
				}
			}
			/* si la page avec le template-beautiful-multiselect-search1.php n'existe pas déjà, on l'a crée avec le template associé */
			if (!$trouvepage) {
			    if (!isset($searchtemp)){$searchtemp="template-beautiful-multiselect-search1.php";}
				$my_post = array(
					'post_type'	  => 'page',
					'post_title'    => 'Beautiful Multiselect Search1',
					'post_content'  => '',
					'post_status'   => 'publish',
					'post_author'   => 1,
					'page_template'  => 'template-beautiful-multiselect-search1.php'
				);
				// Insert the post into the database
				wp_insert_post( $my_post );
			}

	}
	/*--------------------------------------------------------------------*/
	/* met à null toutes les options renseignées depuis la page "Options" */
	/*--------------------------------------------------------------------*/
	static function cpc_bms_reset_admin_options () {
		$bmsadminoptions = get_option("cpc_bms_admin_options");
			if (!empty($bmsadminoptions)) {
				foreach ($bmsadminoptions as $key => $option)
					$bmsoptionsarray[$key] = $option;
		}
		foreach ($bmsoptionsarray as $cle => $valeur){
			$bmsoptions[$cle]='';
			update_option( 'cpc_bms_admin_options', $bmsoptions);
		}
	}
	/*-----------------------------------------------------------------------------*/
	/* met à null toutes les options renseignées depuis la page "Advanced Options" */
	/*-----------------------------------------------------------------------------*/
	static function cpc_bms_reset_advanced_admin_options () {
		$bmsadminoptions = get_option("cpc_bms_advanced_admin_options");
			if (!empty($bmsadminoptions)) {
				foreach ($bmsadminoptions as $key => $option)
					$bmsoptionsarray[$key] = $option;
		}
		foreach ($bmsoptionsarray as $cle => $valeur){
			$bmsoptions[$cle]='';
			update_option( 'cpc_bms_advanced_admin_options', $bmsoptions);
		}
	}
	/*-------------------------------------------------------------------------------*/
	/* met à null toutes les options renseignées depuis la page "Text Modifications" */
	/*-------------------------------------------------------------------------------*/
	static function cpc_bms_reset_text_modifications () {
		$bmsadminoptions = get_option("cpc_bms_admin_text_mod");
			if (!empty($bmsadminoptions)) {
				foreach ($bmsadminoptions as $key => $option)
					$bmsoptionsarray[$key] = $option;
		}
		foreach ($bmsoptionsarray as $cle => $valeur){
			$bmsoptions[$cle]='';
			update_option( 'cpc_bms_admin_text_mod', $bmsoptions);
		}
	}
	function cpc_bms_initbmsactivation () {
		$minimaltheme = array (
			"crosscolor"  => "Grey",
			"crosscolorhover" => "Dark Grey",
			"selectorhovercolor"  => "#f2f2f2",
			"selectorcolor"  => "",
			"titletexte" => "",
			"titleborder"  => "#c6c6c6",
			"maincategorytexte" => "",
			"titleselectedcriteretexte"  => "",
			"selectedcriteretexte" => "",
			"criteretexte"  => "",
			"selectedcriteretextehover" => "",
			"selectedcriterehovercolor"  => "#e5e5e5",
			"selectedcriterebordercolor"  => "#c6c6c6",
			"cancelselectedcriteretexte" => "",
			"cancelselectedcriterebg" => "",
			"cancelselectedcritereborder" => "#c6c6c6",
			"critereborder" => "#c6c6c6",
			"selectorhoverbordercolor" => "#c6c6c6",
			"bulletsquare" => "yes",
			"bulletcircle" => "",
			"bulletsize" => "10",
			"qmcolor" => "Black",
			"noqm" => "",
			"qmbg" => "#c1c1c1",
			"qmradius" => "50",
			"qmsdx" => "2",
			"qmsdy" => "2",
			"qmsdcolor" => "#656565",
			"qmsd" => "on",
			"qmmt" => "10",
			"qmsdbdcolor" =>"",
			"fulltextpicto" =>"",
			"disablecritpicto" =>""
			
		);
		$minimalbmscss = array (
			"widthsearchwrap"  => "30",
			"widthresultwrap" => "65",
			"mtopbmswrap"  => "",
			"mtopbmswrap_unit"  => "px",
			"mbottombmswrap"  => "",
			"mbottombmswrap_unit"  => "px",
			"mrightbmswrap"  => "",
			"mrightbmswrap_unit"  => "px",
			"mleftbmswrap"  => "",
			"mleftbmswrap_unit"  => "px",
			"ptopbmswrap"  => "",
			"ptopbmswrap_unit"  => "px",
			"bmssearchwrapfloat"  => "left",
			"showallpost" =>"",
			"nbchar" =>"350"	
		);
		$textmodificationbmsfront = array (
			"search_selection"  => "",
			"search_erase" => "",
			"result_header"  => "",
			"result_more"  => "",
			"search_gfontname"  => "",
			"search_fontsize"  => "",
			"search_fontweight"  => "",
			"result_pagination"  => ""
		);
		/* initialisation des options */
			update_option( 'cpc_bms_admin_options', $minimaltheme);
			update_option( 'cpc_bms_advanced_admin_options', $minimalbmscss);
			update_option( 'cpc_bms_admin_text_mod', $textmodificationbmsfront);

			flush_rewrite_rules(true);
	}
	/*------------------------------------------------------------------------*/
	/* chargement de groupes d'options predefinies qui constituent un thême   */
	/*------------------------------------------------------------------------*/
	static function cpc_bms_loadbmstheme ($theme,$bmsoption) {
		if ($theme) {
			$bms_options= $theme;
			update_option( $bmsoption, $bms_options);
		}	
	}	
}
/*-----------------------------------------------*/
/* Fin classe Beautiful_Multiselect_Search_Admin */
/*-----------------------------------------------*/

if (class_exists("cpc_bms_Beautiful_Multiselect_Search_Admin")) {
	$inst_BMS_Admin = new cpc_bms_Beautiful_Multiselect_Search_Admin();
}
if (isset($inst_BMS_Admin)){
	/*---------------------------------------*/
	/* ajout menu d'administration du plugin */
	/*---------------------------------------*/
	add_action( 'admin_menu', array($inst_BMS_Admin,'cpc_bms_init_BMS_admin') );
	/*-------------------------------------------------------------------------*/
	/* ajout des fichiers css et js dans le header pour la page de settings BMS */
	/*-------------------------------------------------------------------------*/
	if (isset($_GET['page'])){
		if ($_GET['page']=='cpc_bms_beautifulmultiselectsearchlite_menu_page'){
			add_action('admin_enqueue_scripts',array($inst_BMS_Admin,'cpc_bms_add_BMS_admin_header'));
		}
	}
	/*-----------------------------------------------*/
	/* creation des sidebar et template de recherche */
	/*-----------------------------------------------*/
	add_action( 'widgets_init', array($inst_BMS_Admin,'cpc_bms_add_BMS_sidebar_and_template') );

}
?>