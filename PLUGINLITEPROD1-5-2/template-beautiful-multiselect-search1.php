<?php /**
Template Name: beautiful multiselect search1
*
* This template is used to display beautiful multiselect search with sidebar
* la page de recherche utilise ce template Beautiful_Multiselect_Search pour l'affichage
*
*/
get_header();
?>
<!-- BEGIN #primary -->
<div id="primary" class="site-content-bms">
	<!-- BEGIN #content -->
    <div id="content" role="main" class="content-bmssearch">
		<!-- BEGIN .wrap-beautiful-multiselect-search -->
		<div class="wrap-beautiful-multiselect-search">
            <?php
//            recupere les données saisies dans le widget bms
            $cpc_bms_widget_object = new cpc_bms_Widget_Beautiful_Multiselect_Search_Lite();
            $cpc_bms_widget_settings = $cpc_bms_widget_object->get_settings();
            $cpc_bms_sidebarwidget =get_option('sidebars_widgets');
            if (isset ($cpc_bms_sidebarwidget['cpc_bms_search1-sidebar'])&&!empty($cpc_bms_sidebarwidget['cpc_bms_search1-sidebar'])) {
                $cpc_bms_idwidgetwithinsidebar= explode('search-lite-',sanitize_text_field($cpc_bms_sidebarwidget['cpc_bms_search1-sidebar'][0]));
                $cpc_bms_idwidgetwithinsidebar=$cpc_bms_idwidgetwithinsidebar[1];
                $cpc_bms_widget_settings=$cpc_bms_widget_settings[$cpc_bms_idwidgetwithinsidebar];
            }
            ?>
                <!-- BEGIN .row -->
                <div class="ligne-bms">
                    <!-- BEGIN .bms-search-wrap .columns -->
                    <div class="bms-search-wrap">
                        <?php
                        if ( is_active_sidebar( 'cpc_bms_search1-sidebar' ) && (sizeof($cpc_bms_sidebarwidget['cpc_bms_search1-sidebar'])==1)) {
                            dynamic_sidebar( 'cpc_bms_search1-sidebar' );
                        }
                        else if (sizeof($cpc_bms_sidebarwidget['cpc_bms_search1-sidebar'])>=2){
                            _e('Beautiful Multiselect Widget');
                            cpc_bms_getbmspagetemplatenumber();
                            _e(' has more than 1 Beautiful Multiselect Search Lite Widget.');
                            echo ('<br><br>');
                            _e('Please go to the Appearance/Widgets Menu and keep only 1 Beautiful Multiselect Search Lite Widget; delete the others.');
                        }else {
                            _e('Beautiful Multiselect Widget');
                            cpc_bms_getbmspagetemplatenumber();
                            _e(' sidebar is empty.');
                            echo ('<br><br>');
                            _e('Please go to the Appearance/Widgets Menu, then drag and drop a \'Beautiful Multiselect Lite Widget \' in the Beautiful Multiselect Search');
                            cpc_bms_getbmspagetemplatenumber();
                            _e(' Sidebar','beautifulmultiselectsearch');
                        }
                        ?>
                    <!-- END .bms-search-wrap .columns -->
                    </div>
                    <!-- BEGIN .bms-result-wrap .columns -->
                    <div class="bms-result-wrap">
                            <?php
                            $cpc_bms_urlCat="";
                            $cpc_bms_defaultCat="";
                            $cpc_bms_pageBMSResult="";
                            $cpc_bms_tab_criteres="";
                            if (isset($cpc_bms_widget_settings['vignette'])&&$cpc_bms_widget_settings['vignette']!=""){
                                $cpc_bms_vignette=$cpc_bms_widget_settings['vignette'];
                            }else {
                                $cpc_bms_vignette="none";
                            }
                            $cpc_bms_permal = $wp_rewrite->using_permalinks();
                            /* si permaliens et on a effectué une recherche */
                            if (($cpc_bms_permal==1)&&(strpos($_SERVER['REQUEST_URI'], "cpc_bms_searchr"))){
                                if (isset($wp_query->query_vars['cpc_bms_url_cat'])){
                                    $cpc_bms_urlCat = urldecode($wp_query->query_vars['cpc_bms_url_cat']);
                                }
                                $cpc_bms_tab_criteres=unserialize($cpc_bms_urlCat);
                            }
                            /* si pas de permaliens */
                            else {
                                for ($i = 1; $i <= 5; $i++) {
                                    if ((isset($_GET['critere'.$i]))&&($_GET['critere'.$i]!="")){
                                        $cpc_bms_tab_criteres['critere'.$i]=intval($_GET['critere'.$i]);
                                    }
                                }
                            }
                            if(isset($cpc_bms_widget_settings['default_category'])){
                                /* a l'arrivee sur la page nous n'avons pas encore la categorie par défaut dans l'url alors on utilise la variable renseignee dans le widget */
                                if ($cpc_bms_widget_settings['default_category']!="all"){
                                    $cpc_bms_defaultCat=intval($cpc_bms_widget_settings['default_category']);
                                }else {
                                    $cpc_bms_defaultCat="all";
                                }
                            }else {
                                $cpc_bms_defaultCat="all";
                            }
                            if(isset($cpc_bms_widget_settings['nb_critere'])){
                                $bmsnbcritere = intval($cpc_bms_widget_settings['nb_critere']);
                            }else {
                                $bmsnbcritere = 1;
                            }
                            /* affichage du resultat de recherche dans la page */
                            cpc_bms_post_search_beautiful_multiselect($cpc_bms_tab_criteres,$bmsnbcritere,$cpc_bms_defaultCat,$cpc_bms_pageBMSResult,$cpc_bms_vignette);
                            ?>

                        <!-- END .bms-result-wrap .columns -->
                    </div>

                <!-- END .row -->
                </div>

		<!-- END .wrap-beautiful-multiselect-search -->
		</div>
	<!-- END #content -->
    </div>
<!-- END #primary -->
</div>
<?php get_footer();?>