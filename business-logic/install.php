<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


function bwhd_install_dbobjects()
{

	//bwhd_systemlog_addentry("FUNCTION","bwhd_install_dbobjects","Start");

	try
	{

		$curent_installed_ver = get_option( "bwhd_db_version" );
		$curent_installed_categoriesdefaults = get_option( "bwhd_db_installed_categoriesdefaults", "no" );

		if ( bwhd_globals()->plugin_version != $curent_installed_ver )
		{

			bwhd_systemlog_addentry("INFO", "bwhd_install_dbobjects", "Database Object Delta function started." );

			global $wpdb;

			$table_name_tickets = $wpdb->prefix . 'bw_helpdesk_tickets';
			$table_name_messages = $wpdb->prefix . 'bw_helpdesk_messages';
			$table_name_notifications = $wpdb->prefix . 'bw_helpdesk_notifications';
			$table_name_attachments = $wpdb->prefix . 'bw_helpdesk_attachments';
			$table_name_categories = $wpdb->prefix . 'bw_helpdesk_categories';

			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

			$charset_collate = $wpdb->get_charset_collate();

			//TABLE Helpdesk Tickets

			$sql = " CREATE TABLE $table_name_tickets (
				ticket_id int(11) NOT NULL AUTO_INCREMENT,
				ticket_title varchar(50) NOT NULL,
				ticket_problem varchar(1000) NOT NULL,
				category_id int(11) DEFAULT NULL,
				priority_id int(11) DEFAULT NULL,
				department_id int(11) DEFAULT NULL,
				customer_contract_id int(11) DEFAULT NULL,
				status_id int(11) DEFAULT NULL,
				ticket_is_closed tinyint(1) NOT NULL,
				ticket_created_date datetime NOT NULL,
				ticket_created_userid int(11) DEFAULT NULL,
				ticket_assigned_userid int(11) DEFAULT NULL,
				ticket_customer_userid int(11) DEFAULT NULL,
				ticket_customer_fullname varchar(100) NULL,
				ticket_customer_email varchar(100) NULL,
				ticket_closed_date datetime DEFAULT NULL,
				ticket_sla_resp_before datetime DEFAULT NULL,
				ticket_sla_solv_before datetime DEFAULT NULL,
				ticket_sla_resp_date datetime DEFAULT NULL,
				ticket_sla_solv_date datetime DEFAULT NULL,
				woocommerce_product_id int(11) DEFAULT NULL,
				ticket_creation_mode varchar(50) NULL,
				PRIMARY KEY  (ticket_id)
			) $charset_collate ";

			dbDelta( $sql );
			if($wpdb->last_error !== ''){
				bwhd_systemlog_addentry("ERROR", "bwhd_install_dbobjects", $wpdb->last_error );
			}
			else {
				bwhd_systemlog_addentry("DEBUG", "bwhd_install_dbobjects", "Succesfully managed bw_helpdesk_tickets" );
			}

			//TABLE Helpdesk Messages

			$sql = " CREATE TABLE $table_name_messages (
				message_id int(11) NOT NULL AUTO_INCREMENT,
				ticket_id int(11) NOT NULL,
				message_date datetime NOT NULL,
				message_text text NOT NULL,
				author_type varchar(50) NOT NULL,
				author_userid int(11) NOT NULL,
				is_private tinyint(1) NOT NULL,
				is_sendemail tinyint(1) NOT NULL,
				PRIMARY KEY  (message_id)
			) $charset_collate ";

			dbDelta( $sql );
			if($wpdb->last_error !== ''){
				bwhd_systemlog_addentry("ERROR", "bwhd_install_dbobjects", $wpdb->last_error );
			}
			else {
				bwhd_systemlog_addentry("DEBUG", "bwhd_install_dbobjects", "Succesfully managed bw_helpdesk_messages" );
			}


			//TABLE Helpdesk Notifications

			$sql = " CREATE TABLE $table_name_notifications (
				notification_key VARCHAR(50) NOT NULL,
				notification_name VARCHAR(50) NOT NULL ,
				notification_eventdescription VARCHAR(500) NOT NULL ,
				notification_subject VARCHAR(500) NOT NULL ,
				notification_body text NOT NULL ,
				notification_is_enabled BOOLEAN NOT NULL ,
				PRIMARY KEY  (notification_key)
			) ";

			dbDelta( $sql );
			if($wpdb->last_error !== ''){
				bwhd_systemlog_addentry("ERROR", "bwhd_install_dbobjects", $wpdb->last_error );
			}
			else {
				bwhd_systemlog_addentry("DEBUG", "bwhd_install_dbobjects", "Succesfully managed bw_helpdesk_notifications" );
			}


			//TABLE Helpdesk Attachments

			$sql = " CREATE TABLE $table_name_attachments (
				attachment_id int(11) NOT NULL AUTO_INCREMENT,
				entity_id int(11) NOT NULL,
				attachment_url VARCHAR(500) NOT NULL ,
				attachment_path VARCHAR(500) NOT NULL ,
				attachment_size int(11) NOT NULL ,
				attachment_filename VARCHAR(500) NULL,
				uploaded_user_id int(11) NULL,
				uploaded_user_type VARCHAR(50) NOT NULL,
				uploaded_date datetime DEFAULT NULL,
				PRIMARY KEY  (attachment_id)
			)  $charset_collate  ";

			dbDelta( $sql );
			if($wpdb->last_error !== ''){
				bwhd_systemlog_addentry("ERROR", "bwhd_install_dbobjects", $wpdb->last_error );
			}
			else {
				bwhd_systemlog_addentry("DEBUG", "bwhd_install_dbobjects", "Succesfully managed bw_helpdesk_attachments" );
			}

			//TABLE Helpdesk Categories

			$sql = " CREATE TABLE $table_name_categories (
				category_id int(11) NOT NULL AUTO_INCREMENT,
				category_name VARCHAR(100) NOT NULL,
				PRIMARY KEY  (category_id)
			)  $charset_collate  ";

			dbDelta( $sql );
			if($wpdb->last_error !== ''){
				bwhd_systemlog_addentry("ERROR", "bwhd_install_dbobjects", $wpdb->last_error );
			}
			else {
				bwhd_systemlog_addentry("DEBUG", "bwhd_install_dbobjects", "Succesfully managed bw_helpdesk_categories" );
			}


			//updating db version option
			update_option( 'bwhd_db_version', bwhd_globals()->plugin_version, '', 'yes'  );


		}


		//to be checked always
		bwhd_install_default_notification_records();

		//to be checked always
		if ($curent_installed_categoriesdefaults == "no")
		{
			bwhd_install_default_categories_records();
		}

	}

	catch (Exception $e)
	{
		bwhd_systemlog_addentry("ERROR", "bwhd_install_dbobjects", $e->getMessage());
	}

	//bwhd_systemlog_addentry("FUNCTION","bwhd_install_dbobjects","End");


}



//This function checks that the defaults notification records are present
function bwhd_install_default_notification_records()
{

	//bwhd_systemlog_addentry("FUNCTION","bwhd_install_default_notification_records","Start");

	try
	{

		if ( bwhd_globals_proversionactive() )
		{

			bwhd_notifications_install_default();

		}

	}

	catch (Exception $e)
	{
		bwhd_systemlog_addentry("ERROR", "bwhd_install_default_notification_records", $e->getMessage());
	}

	//bwhd_systemlog_addentry("FUNCTION","bwhd_install_default_notification_records","End");

}



//This function checks that the defaults categories were installed within the system (released in 2.1.2)
function bwhd_install_default_categories_records()
{

	bwhd_systemlog_addentry("FUNCTION","bwhd_install_default_categories_records","Start");

	try
	{

		//add the 3 insert categories by defaults
		$insert_category_params = array();

		$insert_category_params["category_name"] = __('Pre-Sale Question', "bravowp-helpdesk");
		bwhd_controllers_categories_insert( $insert_category_params );

		$insert_category_params["category_name"] = __('Support on Product', "bravowp-helpdesk");
		bwhd_controllers_categories_insert( $insert_category_params );

		$insert_category_params["category_name"] = __('Generic Enquiry', "bravowp-helpdesk");
		bwhd_controllers_categories_insert( $insert_category_params );

		//updates option to prevent re-creation
		update_option("bwhd_db_installed_categoriesdefaults", "yes");

	}

	catch (Exception $e)
	{
		bwhd_systemlog_addentry("ERROR", "bwhd_install_default_categories_records", $e->getMessage());
	}

	bwhd_systemlog_addentry("FUNCTION","bwhd_install_default_categories_records","End");

}




?>
