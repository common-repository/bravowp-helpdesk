<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


//This function is called from the main page and enqueue css and js
//Will work on administration pages only
function bwhd_globals_includeresources_adminpages() {

	bwhd_systemlog_addentry("FUNCTION","bwhd_globals_includeresources_adminpages","Start");

	//vendors
	wp_enqueue_style( 'bootstrap-css', bwhd_globals()->plugin_httpurl . '/css/vendors/bootstrap.min.css' );
	//wp_enqueue_style( 'bootstrap-theme-css', bwhd_globals()->plugin_httpurl . '/css/vendors/bootstrap-theme.min.css');
	wp_enqueue_style( 'datatable-css', bwhd_globals()->plugin_httpurl . '/css/vendors/datatable.min.css');
	wp_enqueue_style( 'bootstrap-select-css', bwhd_globals()->plugin_httpurl . '/css/vendors/bootstrap-select.min.css');
	wp_enqueue_style( 'font-awesome', bwhd_globals()->plugin_httpurl . '/css/vendors/font-awesome.min.css');
	wp_enqueue_style( 'chartist', bwhd_globals()->plugin_httpurl . '/css/vendors/chartist.min.css');

	$bwhd_css_ver  = date("ymd-Gis", filemtime( bwhd_globals()->plugin_url . 'css/admin-dashboard.css' ));
	wp_enqueue_style( 'bwhd-css', bwhd_globals()->plugin_httpurl . '/css/admin-dashboard.css', array(), $bwhd_css_ver);
	$bwhd_css_bootstrap_ver  = date("ymd-Gis", filemtime( bwhd_globals()->plugin_url . 'css/bootstrap-helper.css' ));
	wp_enqueue_style( 'bootstrap-helper-css', bwhd_globals()->plugin_httpurl . '/css/bootstrap-helper.css', array(), $bwhd_css_bootstrap_ver);

	//scripts vendors
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'bootstrap-js', bwhd_globals()->plugin_httpurl . '/scripts/vendors/bootstrap.min.js');
	wp_enqueue_script( 'datatable-js', bwhd_globals()->plugin_httpurl . '/scripts/vendors/datatable.min.js');
	wp_enqueue_script( 'bootstrap-select-js', bwhd_globals()->plugin_httpurl . '/scripts/vendors/bootstrap-select.min.js');
	wp_enqueue_script( 'chartist-js', bwhd_globals()->plugin_httpurl . '/scripts/vendors/chartist.min.js');

	$common_js_ver  = date("ymd-Gis", filemtime( bwhd_globals()->plugin_url . 'scripts/common.js' ));
	wp_register_script( 'bwhd-common-js', bwhd_globals()->plugin_httpurl . '/scripts/common.js', array(), $common_js_ver, false);
	$dashboard_js_ver  = date("ymd-Gis", filemtime( bwhd_globals()->plugin_url . 'scripts/admin-dashboard.js' ));
	wp_register_script( 'bwhd-admin-js', bwhd_globals()->plugin_httpurl . '/scripts/admin-dashboard.js', array(), $dashboard_js_ver, false);
	$settings_emailtotickets_js_ver  = date("ymd-Gis", filemtime( bwhd_globals()->plugin_url . 'scripts/admin-settings-emailtoticket.js' ));
	wp_register_script( 'bwhd-settings-emailtoticket-js', bwhd_globals()->plugin_httpurl . '/scripts/admin-settings-emailtoticket.js', array(), $settings_emailtotickets_js_ver, false);
	$settings_installwizard_js_ver  = date("ymd-Gis", filemtime( bwhd_globals()->plugin_url . 'scripts/admin-installwizard.js' ));
	wp_register_script( 'bwhd-settings-installwizard-js', bwhd_globals()->plugin_httpurl . '/scripts/admin-installwizard.js', array(), $settings_installwizard_js_ver, false);

	require_once(ABSPATH .'wp-includes/pluggable.php');

	wp_localize_script( 'bwhd-common-js', 'bwhdVars', bwhd_globals_buildarrayconstantsforscripts() );
	wp_enqueue_script( 'bwhd-common-js' ,  bwhd_globals()->plugin_httpurl . '/scripts/common.js', array(), $common_js_ver, false);

	wp_localize_script( 'bwhd-admin-js', 'bwhdVars', bwhd_globals_buildarrayconstantsforscripts() );
	wp_enqueue_script( 'bwhd-admin-js' ,  bwhd_globals()->plugin_httpurl . '/scripts/admin-dashboard.js', array(), $dashboard_js_ver, false);

	wp_localize_script( 'bwhd-settings-emailtoticket-js', 'bwhdVars', bwhd_globals_buildarrayconstantsforscripts() );
	wp_enqueue_script( 'bwhd-settings-emailtoticket-js' ,  bwhd_globals()->plugin_httpurl . '/scripts/admin-settings-emailtoticket.js', array(), $settings_emailtotickets_js_ver, false);

	wp_localize_script( 'bwhd-settings-installwizard-js', 'bwhdVars', bwhd_globals_buildarrayconstantsforscripts() );
	wp_enqueue_script( 'bwhd-settings-installwizard-js' ,  bwhd_globals()->plugin_httpurl . '/scripts/admin-installwizard.js', array(), $settings_installwizard_js_ver, false);

	bwhd_systemlog_addentry("FUNCTION","bwhd_globals_includeresources_adminpages","End");

}



//This function is called from the rendering of the front end page
//Call for front end only
function bwhd_globals_includeresources_frontendpages() {

	bwhd_systemlog_addentry("FUNCTION","bwhd_globals_includeresources_frontendpages","Start");

	//vendors
	wp_enqueue_style( 'bootstrap-css', bwhd_globals()->plugin_httpurl . '/css/vendors/bootstrap.min.css' );
	//wp_enqueue_style( 'bootstrap-theme-css', bwhd_globals()->plugin_httpurl . '/css/vendors/bootstrap-theme.min.css'  );
	wp_enqueue_style( 'datatable-css', bwhd_globals()->plugin_httpurl . '/css/vendors/datatable.min.css'  );
	wp_enqueue_style( 'bootstrap-select-css', bwhd_globals()->plugin_httpurl . '/css/vendors/bootstrap-select.min.css'  );
	wp_enqueue_style( 'font-awesome', bwhd_globals()->plugin_httpurl . '/css/vendors/font-awesome.min.css');

	$bwhd_css_ver  = date("ymd-Gis", filemtime( bwhd_globals()->plugin_url . 'css/frontend.css' ));
	wp_enqueue_style( 'bwhd-css', bwhd_globals()->plugin_httpurl . '/css/frontend.css', array(), $bwhd_css_ver);
	$bwhd_css_bootstrap_ver  = date("ymd-Gis", filemtime( bwhd_globals()->plugin_url . 'css/bootstrap-helper.css' ));
	wp_enqueue_style( 'bootstrap-helper-css', bwhd_globals()->plugin_httpurl . '/css/bootstrap-helper.css', array(), $bwhd_css_bootstrap_ver );

	//scripts vendors
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'bootstrap-js', bwhd_globals()->plugin_httpurl . '/scripts/vendors/bootstrap.min.js');
	wp_enqueue_script( 'datatable-js', bwhd_globals()->plugin_httpurl . '/scripts/vendors/datatable.min.js' );
	wp_enqueue_script( 'bootstrap-select-js', bwhd_globals()->plugin_httpurl . '/scripts/vendors/bootstrap-select.min.js' );

	$dashboard_js_ver  = date("ymd-Gis", filemtime( bwhd_globals()->plugin_url . 'scripts/frontend.js' ));
	wp_register_script( 'bwhd-frontend-js', bwhd_globals()->plugin_httpurl . '/scripts/frontend.js', array(), $dashboard_js_ver, false);

	require_once(ABSPATH .'wp-includes/pluggable.php');
	wp_localize_script( 'bwhd-frontend-js', 'bwhdVars', bwhd_globals_buildarrayconstantsforscripts());
	wp_enqueue_script( 'bwhd-frontend-js', bwhd_globals()->plugin_httpurl . '/scripts/frontend.js', array(), $dashboard_js_ver, false );

	bwhd_systemlog_addentry("FUNCTION","bwhd_globals_includeresources_frontendpages","End");

}


//returns the array that will be passed to javascripts files (constants)
function bwhd_globals_buildarrayconstantsforscripts()
{

	$ajax_nonce = wp_create_nonce( "bwhd" );

	return array('ajaxHandlerUrl' => bwhd_globals()->plugin_httpurl . "/business-logic/ajaxhandler.php",
	'ajaxNonce' => $ajax_nonce,
	'pluginProActive' => bwhd_globals_proversionactive(),
	'wpuserid' => get_current_user_id(),
	'defaultscreenforunregistered' => get_option( "bwhd_defaultscreenforunregistered", "home" )
);

}


?>
