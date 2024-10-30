<?php

if ( ! defined( 'ABSPATH' ) ) {
        exit;
}

function ajax_admin_settings_emailtoticket_updatesettings() {

        if (bwhd_demo_is_active() == 1)
        {
                wp_send_json("demoonly");
        }

        bwhd_systemlog_addentry("FUNCTION","ajax_admin_settings_emailtoticket_updatesettings","Start");

        require_once ABSPATH . WPINC . '/cron.php';

        try
        {

                $result = "ok";

                //reading posts values
                $post_enableEmailFetching = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['enableEmailFetching']) ));
                $post_username = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['username']) ));
                $post_password = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['password']) ));
                $post_server = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['server']) ));
                $post_port = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['port']) ));
                $post_serviceType = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['serviceType']) ));

                //updating WP options
                update_option( 'bwhd_emailtoticket_enabled', $post_enableEmailFetching, '', 'yes'  );
                update_option( 'bwhd_emailtoticket_username', $post_username, '', 'yes'  );
                update_option( 'bwhd_emailtoticket_password', $post_password, '', 'yes'  );
                update_option( 'bwhd_emailtoticket_server', $post_server, '', 'yes'  );
                update_option( 'bwhd_emailtoticket_port', $post_port, '', 'yes'  );
                update_option( 'bwhd_emailtoticket_servicetype', $post_serviceType, '', 'yes'  );

                //setting up the CRON item if needed
                if ( $post_enableEmailFetching != 'no' )
                {
                        //ensure the job is removed before
                        wp_clear_scheduled_hook('bwhdEmailToTicket');
                        //add scheduled job
                        if ( !wp_next_scheduled('bwhd_emailtoticket') )
                        {
                                if ( $post_enableEmailFetching == "yes_tenminutes" )
                                {
                                        wp_schedule_event(time(), 'bwhd_globals_scheduletimes_tenminutes', 'bwhdEmailToTicket');
                                }
                                if ( $post_enableEmailFetching == "yes_onehour" )
                                {
                                        wp_schedule_event(time(), 'bwhd_globals_scheduletimes_onehour', 'bwhdEmailToTicket');
                                }
                                if ( $post_enableEmailFetching == "yes_threehours" )
                                {
                                        wp_schedule_event(time(), 'bwhd_globals_scheduletimes_threehours', 'bwhdEmailToTicket');
                                }
                                if ( $post_enableEmailFetching == "yes_oneday" )
                                {
                                        wp_schedule_event(time(), 'bwhd_globals_scheduletimes_oneday', 'bwhdEmailToTicket');
                                }
                        }
                }
                else
                {
                        //remove the scheduled job
                        wp_clear_scheduled_hook('bwhdEmailToTicket');
                }


                wp_send_json( bwhd_ajax_return_reponse(1, "", "", $result, "") );

        }

        catch (Exception $e)
        {
                bwhd_systemlog_addentry("ERROR", "ajax_admin_settings_emailtoticket_updatesettings", $e->getMessage());
        }

        bwhd_systemlog_addentry("FUNCTION","ajax_admin_settings_emailtoticket_updatesettings","End");


}


function bwhd_admin_settings_emailtoticket_test() {

        bwhd_systemlog_addentry("FUNCTION","bwhd_admin_settings_emailtoticket_test","Start");

        try
        {

                $result = "ok";

                $params = array();
                $params["testmode"] = 1;
                $htmlResult = bwhd_mailboxes_startmailboxescheckjob( $params );

                wp_send_json( bwhd_ajax_return_reponse(1, "", "", $result, $htmlResult) );

        }

        catch (Exception $e)
        {
                bwhd_systemlog_addentry("ERROR", "bwhd_admin_settings_emailtoticket_test", $e->getMessage());
        }

        bwhd_systemlog_addentry("FUNCTION","bwhd_admin_settings_emailtoticket_test","End");


}



?>
