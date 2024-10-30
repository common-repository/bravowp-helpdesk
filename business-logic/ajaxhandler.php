<?php


        //checking action name
        $actionName = trim($_POST['action']);
        if ($actionName == "" || $actionName == null)
        {
                return "Action name is empty.";
        }

        //tells what type of loading took place
        $loadMode = "";

        if ( $actionName != "ajax_admin_installwizard_finish" && $actionName != "admin_tickets_insert" && $actionName != "ajax_frontend_tickets_insert" && $actionName != "ajax_frontend_tickets_messages_save" && $actionName != "admin_tickets_messages_add" )
        {

                //Light WP
                bwhd_light_wordpress_load();
                $loadMode = "light";

        }
        else
        {

                //normal WP
                require_once( dirname( dirname( dirname( dirname( dirname( __FILE__ ))))) . '/wp-load.php' );
                require_once( dirname( dirname( dirname( dirname( dirname( __FILE__ ))))) . '/wp-config.php' );
                require_once('../ajax/ajax-admin-installwizard.php');
                bwhd_loadlibraries();

                $loadMode = "full";

        }

        bwhd_systemlog_addentry("FUNCTION","ajaxhandler","Function Received: " . $actionName );
        bwhd_systemlog_addentry("FUNCTION","ajaxhandler","LoadMode: " . $loadMode );


        //Typical headers
        header('Content-Type: text/html');
        send_nosniff_header();
        //Disable caching
        header('Cache-Control: no-cache');
        header('Pragma: no-cache');

        //wp ajax security
        check_ajax_referer( 'bwhd', 'security' );


        //response
        $result = "";

        //check user permission
        $HasUserAgentPermission = bwhd_globals_hasuseragentpermissions();


        switch ( $actionName ) {


                //HELPDESK ADMIN
                case "admin_tickets_list":
                if ($HasUserAgentPermission==1)
                {
                        ajax_admin_tickets_list();
                }
                else
                {
                        $result ="not permitted";
                }
                break;

                case "admin_tickets_get":
                if ($HasUserAgentPermission==1)
                {
                        ajax_admin_tickets_getsingle();
                }
                else
                {
                        $result ="not permitted";
                }
                break;

                case "admin_tickets_save":
                if ($HasUserAgentPermission==1)
                {
                        ajax_admin_tickets_save();
                }
                else
                {
                        $result ="not permitted";
                }
                break;

                case "admin_tickets_insert":
                if ($HasUserAgentPermission==1)
                {
                        ajax_admin_tickets_insert();
                }
                else
                {
                        $result ="not permitted";
                }
                break;

                case "admin_tickets_getcounters":
                if ($HasUserAgentPermission==1)
                {
                        ajax_admin_tickets_getcounters();
                }
                else
                {
                        $result ="not permitted";
                }
                break;

                case "admin_tickets_loadchartopenvsclosed":
                if ($HasUserAgentPermission==1)
                {
                        ajax_admin_tickets_loadopenedvsclosedchart();
                }
                else
                {
                        $result ="not permitted";
                }
                break;

                case "admin_tickets_messages_add":
                if ($HasUserAgentPermission==1)
                {
                        ajax_admin_tickets_message_save();
                }
                else
                {
                        $result ="not permitted";
                }
                break;

                case "admin_tickets_messages_list":
                if ($HasUserAgentPermission==1)
                {
                        ajax_admin_tickets_message_load();
                }
                else
                {
                        $result ="not permitted";
                }
                break;

                case "admin_settings_save":
                if ($HasUserAgentPermission==1)
                {
                        ajax_admin_settings_save();
                }
                else
                {
                        $result ="not permitted";
                }
                break;

                case "admin_settings_tables_list":
                if ($HasUserAgentPermission==1)
                {
                        ajax_admin_settings_tables_list();
                }
                else
                {
                        $result ="not permitted";
                }
                break;

                case "admin_settings_tables_get":
                if ($HasUserAgentPermission==1)
                {
                        ajax_admin_settings_tables_get();
                }
                else
                {
                        $result ="not permitted";
                }
                break;

                case "admin_settings_tables_save":
                if ($HasUserAgentPermission==1)
                {
                        ajax_admin_settings_tables_save();
                }
                else
                {
                        $result ="not permitted";
                }
                break;

                case "admin_settings_tables_delete":
                if ($HasUserAgentPermission==1)
                {
                        ajax_admin_settings_tables_delete();
                }
                else
                {
                        $result ="not permitted";
                }
                break;

                case "admin_systemlog_list":
                if ($HasUserAgentPermission==1)
                {
                        ajax_admin_systemlog_list();
                }
                else
                {
                        $result ="not permitted";
                }
                break;

                case "admin_systemlog_clear":
                if ($HasUserAgentPermission==1)
                {
                        ajax_admin_systemlog_clear();
                }
                else
                {
                        $result ="not permitted";
                }
                break;

                case "ajax_admin_settings_emailtoticket_updatesettings":
                if ($HasUserAgentPermission==1)
                {
                        ajax_admin_settings_emailtoticket_updatesettings();
                }
                else
                {
                        $result ="not permitted";
                }
                break;

                case "ajax_admin_settings_emailtoticket_testsettings":
                if ($HasUserAgentPermission==1)
                {
                        bwhd_admin_settings_emailtoticket_test();
                }
                else
                {
                        $result ="not permitted";
                }
                break;



                //INSTALL WIZARD
                case "ajax_admin_installwizard_finish":
                if ($HasUserAgentPermission==1)
                {
                        ajax_admin_installwizard_finish();
                        $result = "ok";
                }
                else
                {
                        $result ="not permitted";
                }
                break;


                //HELPDESK FRONT END
                case "ajax_frontend_tickets_get":
                $result = ajax_frontend_tickets_get();
                break;

                case "ajax_frontend_tickets_list":
                $result = ajax_frontend_tickets_list();
                break;

                case "ajax_frontend_tickets_insert":
                $result = ajax_frontend_tickets_insert();
                break;

                case "ajax_frontend_tickets_messages_load":
                $result = ajax_frontend_tickets_messages_load();
                break;

                case "ajax_frontend_tickets_messages_save":
                $result = ajax_frontend_tickets_messages_save();
                break;



                //HELPDESK NOTIFICATIONS
                case "ajax_notifications_load":
                $result = ajax_notifications_load();
                break;

                case "ajax_notifications_tokens_load":
                $result = ajax_notifications_tokens_load();
                break;

                case "ajax_notifications_get":
                $result = ajax_notifications_get();
                break;

                case "ajax_notifications_save":
                $result = ajax_notifications_save();
                break;



                //HELPDESK ATTACHMENTS
                case "ajax_attachments_list":
                $result = ajax_attachments_list();
                break;

                case "ajax_attachments_settings_save":
                $result = ajax_attachments_settings_save();
                break;


        }

        wp_send_json($result);


        function bwhd_light_wordpress_load()
        {

                //Light WP load
                define('SHORTINIT', true);
                require_once( dirname( dirname( dirname( dirname( dirname( __FILE__ ))))) . '/wp-load.php' );
                require_once( dirname( dirname( dirname( dirname( dirname( __FILE__ ))))) . '/wp-config.php' );
                require_once ABSPATH . WPINC . '/default-constants.php';
                require_once ABSPATH . WPINC . '/formatting.php';
                wp_plugin_directory_constants();
                wp_cookie_constants();

                //08/02/2017 the following line throws error since WP 4.7.0 deprecated session.php. Replaced with another class
                global $wp_version;
                if ( $wp_version >= 4.7 ) 
                {
                        //new classed, after 4.7
                        require_once ABSPATH . WPINC . '/class-wp-session-tokens.php';
                        require_once ABSPATH . WPINC . '/class-wp-user-meta-session-tokens.php';
                }
                else
                {
                        //old include
                        require_once ABSPATH . WPINC . '/session.php';
                }


                require_once ABSPATH . WPINC . '/rest-api.php';
                require_once ABSPATH . WPINC . '/l10n.php';
                require_once ABSPATH . WPINC . '/pluggable.php';
                require_once ABSPATH . WPINC . '/user.php';
                require_once ABSPATH . WPINC . '/meta.php';
                require_once ABSPATH . WPINC . '/class-wp-user.php';
                require_once ABSPATH . WPINC . '/class-wp-role.php';
                require_once ABSPATH . WPINC . '/kses.php';
                require_once ABSPATH . WPINC . '/class-wp-roles.php';
                require_once ABSPATH . WPINC . '/capabilities.php';
                require_once ABSPATH . WPINC . '/link-template.php';
                require_once ABSPATH . WPINC . '/post.php';


                //Light bwhp loading
                include('globals.php');
                include('utilities.php');
                include('mailboxes.php');
                include('../utils/log/logger.php');
                include('../controllers/agents-controller.php');
                include('../controllers/ticket-controller.php');
                include('../controllers/status-controller.php');
                include('../controllers/categories-controller.php');
                include('../controllers/priorities-controller.php');
                include('../controllers/messages-controller.php');
                include('../controllers/customers-controller.php');

                include('../ajax/ajax-admin-settings-tables.php');
                include('../ajax/ajax-admin-installwizard.php');
                include('../ajax/ajax-admin-settings-emailtoticket.php');
                include('../ajax/ajax-admin-settings.php');
                include('../ajax/ajax-admin-systemlog.php');
                include('../ajax/ajax-admin-tickets-messages.php');
                include('../ajax/ajax-admin-tickets.php');
                include('../ajax/ajax-frontend-tickets.php');
                include('../ajax/ajax-frontend-tickets-messages.php');
                include('ajaxresponse.php');
                include('demo.php');


                //optional plugins
                if ( bwhd_globals_proversionactive() )
                {

                        //notifications
                        include(bwhd_globals()->plugin_url_pro . "/controllers/notifications-controller.php");
                        include(bwhd_globals()->plugin_url_pro . "/controllers/notifications-tokens-controller.php");
                        include(bwhd_globals()->plugin_url_pro . "/ajax/ajax-notifications-admin.php");

                        //attachments
                        include(bwhd_globals()->plugin_url_pro . "/controllers/attachments-controller.php");
                        include(bwhd_globals()->plugin_url_pro . "/ajax/ajax-attachments-admin.php");
                        include(bwhd_globals()->plugin_url_pro . "/ajax/ajax-attachments-settings.php");

                }

        }



//this function loads the needed files for helpdesk
function bwhd_loadlibraries()
{

        //Light bwhp loading
        require_once('globals.php');
        require_once('utilities.php');
        require_once('mailboxes.php');
        require_once('../utils/log/logger.php');
        require_once('../controllers/agents-controller.php');
        require_once('../controllers/ticket-controller.php');
        require_once('../controllers/status-controller.php');
        require_once('../controllers/categories-controller.php');
        require_once('../controllers/priorities-controller.php');
        require_once('../controllers/messages-controller.php');
        require_once('../controllers/customers-controller.php');
        require_once('../ajax/ajax-admin-settings-tables.php');
        require_once('../ajax/ajax-admin-installwizard.php');
        require_once('../ajax/ajax-admin-settings-emailtoticket.php');
        require_once('../ajax/ajax-admin-settings.php');
        require_once('../ajax/ajax-admin-systemlog.php');
        require_once('../ajax/ajax-admin-tickets-messages.php');
        require_once('../ajax/ajax-admin-tickets.php');
        require_once('../ajax/ajax-frontend-tickets.php');
        require_once('../ajax/ajax-frontend-tickets-messages.php');
        require_once('ajaxresponse.php');
        require_once('demo.php');

        //optional plugins
        if ( bwhd_globals_proversionactive() )
        {

                //notifications
                require_once(bwhd_globals()->plugin_url_pro . "/controllers/notifications-controller.php");
                require_once(bwhd_globals()->plugin_url_pro . "/controllers/notifications-tokens-controller.php");
                require_once(bwhd_globals()->plugin_url_pro . "/ajax/ajax-notifications-admin.php");

                //attachments
                require_once(bwhd_globals()->plugin_url_pro . "/controllers/attachments-controller.php");
                require_once(bwhd_globals()->plugin_url_pro . "/ajax/ajax-attachments-admin.php");
                require_once(bwhd_globals()->plugin_url_pro . "/ajax/ajax-attachments-settings.php");

        }

}

                                ?>
