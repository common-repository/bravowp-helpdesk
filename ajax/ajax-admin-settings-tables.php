<?php

if ( ! defined( 'ABSPATH' ) ) {
        exit;
}



function ajax_admin_settings_tables_list() {

        bwhd_systemlog_addentry("FUNCTION","ajax_admin_settings_tables_list","Start");

        try
        {

                $result = array();

                $post_tablekey = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['tablekey']) ));

                if ($post_tablekey == "categories")
                {
                        $result = bwhd_controllers_categories_list();
                }


                wp_send_json( bwhd_ajax_return_reponse(1, "", "", $result, "") );

        }

        catch (Exception $e)
        {
                bwhd_systemlog_addentry("ERROR", "ajax_admin_settings_tables_list", $e->getMessage());
        }

        bwhd_systemlog_addentry("FUNCTION","ajax_admin_settings_tables_list","End");


}


function ajax_admin_settings_tables_get() {

        bwhd_systemlog_addentry("FUNCTION","ajax_admin_settings_tables_get","Start");

        try
        {

                $result = array();

                $post_tablekey = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['tablekey']) ));
                $post_tableitemid = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['tableitemid']) ));

                if ($post_tablekey == "categories")
                {
                        $params = array();
                        $params["category_id"] = $post_tableitemid;
                        $result = bwhd_controllers_categories_get( $params );
                }

                wp_send_json( bwhd_ajax_return_reponse(1, "", "", $result, "") );

        }

        catch (Exception $e)
        {
                bwhd_systemlog_addentry("ERROR", "ajax_admin_settings_tables_get", $e->getMessage());
        }

        bwhd_systemlog_addentry("FUNCTION","ajax_admin_settings_tables_get","End");


}


function ajax_admin_settings_tables_save() {

        bwhd_systemlog_addentry("FUNCTION","ajax_admin_settings_tables_save","Start");

        try
        {

                if (bwhd_demo_is_active() == 1)
                {
                        return 0;
                }

                //json list of fields values
                $post_tablekey = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['tablekey']) ));
                $post_tableitemid = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['tableitemid']) ));
                $post_fieldvalues = json_decode(wp_unslash($_POST['fieldvalues']));


                if ($post_tablekey == "categories")
                {
                        if ($post_tableitemid > 0)
                        {
                                //update
                                $params = array();
                                $params["category_id"] = $post_tableitemid;
                                $params["category_name"] = $post_fieldvalues->category_name;
                                $result = bwhd_controllers_categories_update( $params );
                        }
                        else
                        {
                                //insert
                                $params = array();
                                $params["category_name"] = $post_fieldvalues->category_name;
                                $result = bwhd_controllers_categories_insert( $params );
                        }

                }



                wp_send_json( bwhd_ajax_return_reponse(1, "", "", "ok", "") );

        }

        catch (Exception $e)
        {
                bwhd_systemlog_addentry("ERROR", "ajax_admin_settings_tables_save", $e->getMessage());
        }

        bwhd_systemlog_addentry("FUNCTION","ajax_admin_settings_tables_save","End");


}




function ajax_admin_settings_tables_delete() {

        bwhd_systemlog_addentry("FUNCTION","ajax_admin_settings_tables_delete","Start");

        try
        {

                if (bwhd_demo_is_active() == 1)
                {
                        return 0;
                }

                //json list of fields values
                $post_tablekey = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['tablekey']) ));
                $post_tableitemid = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['tableitemid']) ));


                if ($post_tablekey == "categories")
                {
                        $params["category_id"] = $post_tableitemid;
                        $result = bwhd_controllers_categories_delete( $params );
                }



                wp_send_json( bwhd_ajax_return_reponse(1, "", "", "ok", "") );

        }

        catch (Exception $e)
        {
                bwhd_systemlog_addentry("ERROR", "ajax_admin_settings_tables_delete", $e->getMessage());
        }

        bwhd_systemlog_addentry("FUNCTION","ajax_admin_settings_tables_delete","End");


}


?>
