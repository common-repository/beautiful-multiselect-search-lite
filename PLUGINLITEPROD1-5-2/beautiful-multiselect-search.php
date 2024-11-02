<?php
/*
 * Plugin Name: Beautiful Multiselect Search Lite
 * Description: This Plugin, responsive and completely customizable, enables you to easily create (no code required) automatically a <strong>multiselect Post Search Page based</strong> only on Wordpress <strong>Posts</strong> and Wordpress <strong>Categories</strong>. Our <strong>faceted search</strong> allows users to explore a collection of posts by applying <strong>multiple filters</strong> (category or subcategory).
 * Author: <a href="http://www.100p100digital.com/" target="blank" >100% DIGITAL</a> - Franck MELCARE
 * Version: 1.5.2
 */
define( 'cpc_bms_BEAUTIFUL_MULTISELECT_SEARCH_VERSION', 'Lite' );
define( 'cpc_bms_BEAUTIFUL_MULTISELECT_SEARCH_URL', plugin_dir_url( __FILE__ ) );
define( 'cpc_bms_BEAUTIFUL_MULTISELECT_SEARCH_DIR', plugin_dir_path( __FILE__ ) );
define( 'cpc_bms_PRO_VERSION_URL', 'http://www.100p100digital.com/en/beautiful-multiselect-search-plugin-2/' );
require_once( cpc_bms_BEAUTIFUL_MULTISELECT_SEARCH_DIR . 'class.beautiful-multiselect-search-widget.php' );
require_once( cpc_bms_BEAUTIFUL_MULTISELECT_SEARCH_DIR . 'class.beautiful-multiselect-search-template.php' );
require_once( cpc_bms_BEAUTIFUL_MULTISELECT_SEARCH_DIR . 'class.beautiful-multiselect-search-admin.php' );
require_once( cpc_bms_BEAUTIFUL_MULTISELECT_SEARCH_DIR . 'css/bms-admin-options-head.php' );
function cpc_bms_beautiful_multiselect_search_scripts() {
    if ( is_page_template( 'template-beautiful-multiselect-search1.php' ) ) {
        wp_enqueue_script( 'jquery');
        wp_enqueue_script( 'jquery-color');
        wp_enqueue_script('cpc_bms_beautifulmultiselectsearch-js',plugins_url( '/js/beautifulmultiselectsearch.js' , __FILE__ ),array( 'jquery' ));
        wp_enqueue_style( 'cpc_bms_font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css' );
        wp_register_script( 'cpc_bms_serialize', plugins_url( '/js/serialize.js' , __FILE__ ));
        wp_enqueue_script( 'cpc_bms_serialize', plugins_url( '/js/serialize.js' , __FILE__ ),true);
        wp_register_style( 'cpc_bms_beautifulmultiselectsearch-css', plugins_url('/css/beautifulmultiselectsearch.css', __FILE__) );
        wp_enqueue_style( 'cpc_bms_beautifulmultiselectsearch-css' );
        global $wp_rewrite;
        $usingperma = $wp_rewrite->using_permalinks();
        $site_info = array(
            'wpurl' => get_bloginfo('wpurl'),
            'slugpagename' =>  basename(get_permalink()),
            'sitepermalink' => get_permalink(),
            'pagetemplateid' => get_the_ID(),
            'usingpermalink' => $usingperma );
        wp_localize_script( 'cpc_bms_beautifulmultiselectsearch-js', 'site_info', $site_info );
        $bms_get_options=get_option('cpc_bms_admin_options');
        $bms_get_aoptions=get_option('cpc_bms_advanced_admin_options');
        $bms_get_textmod=get_option('cpc_bms_admin_text_mod');
        if (isset($bms_get_options['selectorhovercolor'])){$js_selectorhovercolor=$bms_get_options['selectorhovercolor'];}else{$js_selectorhovercolor="";}
        if (isset($bms_get_options['selectorcolor'])){$js_selectorcolor=$bms_get_options['selectorcolor'];}else{$js_selectorcolor="";}
        if (isset($bms_get_options['selectedcriterehovercolor'])){$js_selectedcriterehovercolor=$bms_get_options['selectedcriterehovercolor'];}else{$js_selectedcriterehovercolor="";}
        if (isset($bms_get_options['crosscolorhover'])){$js_crosscolorhover=$bms_get_options['crosscolorhover'];}else{$js_crosscolorhover="";}
        if (isset($bms_get_options['crosscolor'])){$js_crosscolor=$bms_get_options['crosscolor'];}else{$js_crosscolor="";}
        if (isset($bms_get_options['critereborder'])){$js_critereborder=$bms_get_options['critereborder'];}else{$js_critereborder="";}
        if (isset($bms_get_options['selectorhoverbordercolor'])){$js_selectorhoverbordercolor=$bms_get_options['selectorhoverbordercolor'];}else{$js_selectorhoverbordercolor="";}
        $admin_info = array(
            'bmscolorselectorhover' => $js_selectorhovercolor,
            'bmscolorselector' => $js_selectorcolor,
            'bmsselectedcriterehovercolor' => $js_selectedcriterehovercolor,
            'bmscrosscolorhover' => $js_crosscolorhover,
            'bmscrosscolor' => $js_crosscolor,
            'bmsselecteurbordercolor' => $js_critereborder,
            'bmsselecteurhoverbordercolor' => $js_selectorhoverbordercolor,
            'bmsurl' => cpc_bms_BEAUTIFUL_MULTISELECT_SEARCH_URL );
        wp_localize_script( 'cpc_bms_beautifulmultiselectsearch-js', 'admin_info', $admin_info );
    }
}
add_action( 'wp_enqueue_scripts', 'cpc_bms_beautiful_multiselect_search_scripts' );
function cpc_bms_enqueue_color_picker( $hook_suffix ) {
    // first check that $hook_suffix is appropriate for your admin page
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'cpc_bms-wp-color-picker', plugins_url('/js/adminbeautifulmultiselectsearch.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
}
add_action( 'admin_enqueue_scripts', 'cpc_bms_enqueue_color_picker' );
add_action( 'plugins_loaded', 'cpc_bms_search_load_textdomain' );
function cpc_bms_search_load_textdomain() {
  load_plugin_textdomain( 'beautifulmultiselectsearch', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
}
if (class_exists("cpc_bms_Beautiful_Multiselect_Search_Admin")) {
    $instBMSADMIN = new cpc_bms_Beautiful_Multiselect_Search_Admin();
}





/*  à l'activation du plugin */
register_activation_hook( __FILE__, array($instBMSADMIN,'cpc_bms_initbmsactivation'));

/* à la désactivation du plugin */
register_deactivation_hook( __FILE__, array($instBMSADMIN,'cpc_bms_reset_admin_options') );
register_deactivation_hook( __FILE__, array($instBMSADMIN,'cpc_bms_reset_advanced_admin_options') );
?>