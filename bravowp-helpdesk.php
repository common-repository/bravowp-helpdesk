<?php

/**
* @package BravoWP-Helpdesk
* @version 2.2.1
*/
/*
Plugin Name: BravoWP's Helpdesk
Plugin URI: http://wordpress.org/plugins/BravoWP-Helpdesk
Description: An Helpdesk plugin for Wordpress
Author: BravoWP.com
Version: 2.2.1
Author URI: http://www.BravoWP.com/
*/


//-------- Including files ----------

//Globals
include('business-logic/globals.php');

//Utils
include('business-logic/utilities.php');
include('utils/log/logger.php');
include('business-logic/install.php');
include('business-logic/demo.php');
include('business-logic/mailboxes.php');

//Controllers
include('controllers/agents-controller.php');
include('controllers/ticket-controller.php');
include('controllers/status-controller.php');
include('controllers/priorities-controller.php');
include('controllers/categories-controller.php');
include('controllers/messages-controller.php');
include('controllers/customers-controller.php');
include('controllers/woocommerce-controller.php');

//Helpers
include('business-logic/resources.php');
include('business-logic/placeholders.php');

//Ajax
include('business-logic/ajaxresponse.php');


//-------- Including files ----------


//-------- Installation/Update --------------

add_action( 'plugins_loaded', 'bwhd_install_dbobjects' );

//-------- Installation/Update --------------

//-------- Hooks ----------

//Adding menu pages in WP dashbaord
add_action( 'admin_menu', 'bwhd_globals_adddashboardpage' );

//attaching CRON functions
add_action('bwhdEmailToTicket', 'bwhd_mailboxes_startmailboxescheckjobfromschedule');


//-------- Hooks ----------


//-------- Short Codes ----------

//Adding menu pages in WP dashbaord
add_shortcode( 'bravowp-helpdesk-frontend', 'bwhd_globals_includefrontendpage' );

//-------- Short Codes ----------


//-------- Adding Languages ----------

load_plugin_textdomain('bravowp-helpdesk', false, dirname(plugin_basename(__FILE__)) . '/languages/');

//-------- Adding Languages ----------


?>
