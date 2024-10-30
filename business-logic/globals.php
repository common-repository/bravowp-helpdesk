<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}




//defines the globals scope and consts used in the plugin
function bwhd_globals()
{

	//do not put this function under try..catch(), and any logging functions.

	//usage example:
	//echo bwhd_globals()->plugin_version;

	static $bwhd_globals_bag;

	if ( !isset ( $bwhd_globals_bag ) )
	{

		$bwhd_globals_bag = new stdClass();

		$bwhd_globals_bag -> plugin_version = "2.2.1";

		$mainPluginFile = dirname(dirname(__FILE__)) . '/bravowp-helpdesk.php';
		$bwhd_globals_bag -> plugin_url = plugin_dir_path($mainPluginFile);

		$bwhd_globals_bag -> plugin_httpurl = plugins_url() . '/bravowp-helpdesk';
		$bwhd_globals_bag -> plugin_httpurl_pro = plugins_url() . '/bravowp-helpdeskpro';

		$bwhd_globals_bag -> loadergif_url = plugins_url() . '/bravowp-helpdesk/images/loader.gif';
		$bwhd_globals_bag -> headerpng_url = plugins_url() . '/bravowp-helpdesk/images/header.png';

		$bwhd_globals_bag -> plugin_url_pro = WP_PLUGIN_DIR . '/bravowp-helpdeskpro';

		$bwhd_globals_bag -> uploadhandler_url = plugins_url() . '/bravowp-helpdeskpro/business-logic/filesupload-handler.php';
		$bwhd_globals_bag -> uploadhandler_url_public = plugins_url() . '/bravowp-helpdeskpro/business-logic/filesupload-handler-public.php';


	}

	return $bwhd_globals_bag;



}





//Adding menu page in Wordpress Dashboard, on WP hook (main .php file)
function bwhd_globals_adddashboardpage() {

	$capabilityName = 'manage_options'; //default

	if (bwhd_demo_is_active() == 1)
	{
		if (bwhd_demo_forceadmincapabilities() == 0)
		{
			$capabilityName = 'bravowp_helpdesk_demo';
		}
	}

	$my_page = add_menu_page( 'Helpdesk', 'BWP Helpdesk', $capabilityName, 'bwhd_helpdesk', 'bwhd_globals_adddashboardpage_callback', plugin_dir_url( __FILE__ ) . '../images/dashboard-icon.png', 73 );
	add_action( 'load-' . $my_page, 'bwhd_globals_includeresources_adminpages' );

}
function bwhd_globals_adddashboardpage_callback() {

	$globals = bwhd_globals();
	include( $globals->plugin_url . "/pages/admin.php" );

}




//Includes front end page for short code
function bwhd_globals_includefrontendpage(){

	$globals = bwhd_globals();
	ob_start();
	include($globals->plugin_url . "/pages/frontend.php");
	$content = ob_get_clean();
	return $content;

}




//This checks for a plugin to be installed, returns false if not.
function bwhd_globals_proversionactive()
{

	//bwhd_systemlog_addentry("FUNCTION","bwhd_globals_proversionactive","Start");

	try
	{

		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );


		if ( is_plugin_active( "bravowp-helpdeskpro/bravowp-helpdeskpro.php" ) )
		{

			return true;

		}

		return false;

	}

	catch (Exception $e)
	{
		bwhd_systemlog_addentry("ERROR", "bwhd_globals_proversionactive", $e->getMessage());
	}

	//bwhd_systemlog_addentry("FUNCTION","bwhd_globals_proversionactive","End");

}



//This checks if the woocommerce plugin is installed or not
function bwhd_globals_woocommerceactive()
{

	bwhd_systemlog_addentry("FUNCTION","bwhd_globals_woocommerceactive","Start");

	try
	{

		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );


		if ( is_plugin_active( "woocommerce/woocommerce.php" ) )
		{

			return true;

		}

		return false;

	}

	catch (Exception $e)
	{
		bwhd_systemlog_addentry("ERROR", "bwhd_globals_woocommerceactive", $e->getMessage());
	}

	bwhd_systemlog_addentry("FUNCTION","bwhd_globals_woocommerceactive","End");

}



//Returns 1 if the current user has the specified capability
function bwhd_globals_hasuseragentpermissions() {

	$capabilityName = 'manage_options'; //default

	if (bwhd_demo_is_active() == 1)
	{
		if (bwhd_demo_forceadmincapabilities() == 0)
		{
			$capabilityName = 'bravowp_helpdesk_demo';
		}
	}

	//checks this capability for this current user
	if ( current_user_can( $capabilityName ) )
	{
		return 1;
	}
	else
	{
		return 0;
	}

}


//cron items
function bwhd_globals_scheduletimes( $schedules ) {

    $schedules['bwhd_globals_scheduletimes_tenminutes'] = array(
            'interval'  => 600,
            'display'   => 'Every 10 Minutes'
    );
    $schedules['bwhd_globals_scheduletimes_onehour'] = array(
	    'interval'  => 3600,
	    'display'   => 'Every Hour'
    );
    $schedules['bwhd_globals_scheduletimes_threehours'] = array(
	    'interval'  => 10800,
	    'display'   => 'Every 3 Hours'
    );
    $schedules['bwhd_globals_scheduletimes_oneday'] = array(
	    'interval'  => 86400,
	    'display'   => 'Every Day'
    );

    return $schedules;
}
add_filter( 'cron_schedules', 'bwhd_globals_scheduletimes' );




?>
