<?php

//for captcha
session_start();

//this function is called to load the ticket details in the edit ticket page
function ajax_frontend_tickets_get() {

	bwhd_systemlog_addentry("FUNCTION","ajax_frontend_tickets_get","Start");

	try
	{

		$param_ticket_id = -1;
		if ( isset( $_POST['ticket_id'] ))
		{
			$param_ticket_id = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['ticket_id']) ));
		}
		$result = bwhd_controllers_tickets_getsingleforeditpagefrontend( $param_ticket_id );
		wp_send_json( $result );

	}

	catch (Exception $e)
	{
		bwhd_systemlog_addentry("ERROR", "ajax_frontend_tickets_get", $e->getMessage());
	}

	bwhd_systemlog_addentry("FUNCTION","ajax_frontend_tickets_get","End");

}


//this function is called to list the ticket for the registered user
function ajax_frontend_tickets_list() {

	bwhd_systemlog_addentry("FUNCTION","ajax_frontend_tickets_list","Start");

	try
	{

		$result = bwhd_controllers_tickets_listforticketslistpage_frontend();
		wp_send_json( $result );

	}

	catch (Exception $e)
	{
		bwhd_systemlog_addentry("ERROR", "ajax_frontend_tickets_list", $e->getMessage());
	}

	bwhd_systemlog_addentry("FUNCTION","ajax_frontend_tickets_list","End");

}


//this function is when a ticket is added via frontend
function ajax_frontend_tickets_insert() {

	bwhd_systemlog_addentry("FUNCTION","ajax_frontend_tickets_insert","Start");

	try
	{


		bwhd_systemlog_addentry("FUNCTION","ajax_frontend_tickets_insert","Start");

		$result_message = "";

		$param_customer_name = "";
		$param_customer_email = "";
		$param_ticket_title = "";
		$param_ticket_problem = "";
		$param_category_id = -1;
		$param_captcha = "";
		$param_woocommerce_productid = 0;
		if ( isset( $_POST['customer_name'] ))
		{
			$param_customer_name = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['customer_name']) ));
		}
		if ( isset( $_POST['customer_email'] ))
		{
			$param_customer_email = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['customer_email']) ));
		}
		if ( isset( $_POST['ticket_title'] ))
		{
			$param_ticket_title = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['ticket_title']) ));
		}
		if ( isset( $_POST['ticket_problem'] ))
		{
			$param_ticket_problem = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['ticket_problem']) ));
		}
		if ( isset( $_POST['category_id'] ))
		{
			$param_category_id = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['category_id']) ));
		}
		if ( isset( $_POST['captcha'] ))
		{
			$param_captcha = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['captcha']) ));
		}
		if ( isset( $_POST['woocommerce_productid'] ))
		{
			$param_woocommerce_productid = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['woocommerce_productid']) ));
		}

		//validation
		if ( is_user_logged_in() == false )
		{
			if ( $param_customer_name == "" )
			{
				wp_send_json( bwhd_ajax_return_reponse(0, "bwhd-frontend-controls-ticketnew-txtcustomername", __("Please type your full name.", "bravowp-helpdesk"), "", "") );
			}
			if ( $param_customer_email == "" )
			{
				wp_send_json( bwhd_ajax_return_reponse(0, "bwhd-frontend-controls-ticketnew-txtcustomeremail", __("Please type your email address.", "bravowp-helpdesk"), "", "") );
			}
		}
		if ( $param_ticket_title == "" )
		{
			wp_send_json( bwhd_ajax_return_reponse(0, "bwhd-frontend-controls-ticketnew-txttickettitle", __("Please enter a Title for this Ticket.", "bravowp-helpdesk"), "", "") );
		}
		if ( $param_ticket_problem == "" )
		{
			wp_send_json( bwhd_ajax_return_reponse(0, "bwhd-frontend-controls-ticketnew-txtticketproblem", __("Please enter a Description for this Ticket.", "bravowp-helpdesk"), "", "") );
		}
		if ( $param_category_id == "" || $param_category_id == "0"  )
		{
			wp_send_json( bwhd_ajax_return_reponse(0, "bwhd-frontend-controls-ticketnew-ddlcategory", __("Please select a Category for this Ticket.", "bravowp-helpdesk"), "", "") );
		}
		if ( $param_captcha == "" && get_option( "bwhd_require_captcha", "no" ) == "yes" )
		{
			wp_send_json( bwhd_ajax_return_reponse(0, "bwhd-frontend-controls-ticketnew-txtcaptcha", __("Please type the value as shown in the image.", "bravowp-helpdesk"), "", "") );
		}
		if ( get_option( "bwhd_require_captcha", "no" ) == "yes" )
		{
			if ( $param_captcha != $_SESSION['bwhd_captcha_newticket'] )
			{
				wp_send_json( bwhd_ajax_return_reponse(0, "bwhd-frontend-controls-ticketnew-txtcaptcha", __("The value you typed and the value shown do not match.", "bravowp-helpdesk"), "", "") );
			}
		}
		//params adjusting
		if ( is_user_logged_in() == true )
		{

			//getting the info for the existing customer
			$customer_info = bwhd_controllers_customers_getsingle( get_current_user_id() );

			$param_customer_name = $customer_info[0]->display_name;
			$param_customer_email = $customer_info[0]->user_email;
		}

		//array to pass to method
		$array_values["ticket_customer_userid"] = get_current_user_id();
		$array_values["ticket_customer_fullname"] = $param_customer_name;
		$array_values["ticket_customer_email"] = $param_customer_email;
		$array_values["ticket_title"] = $param_ticket_title;
		$array_values["ticket_problem"] = $param_ticket_problem;
		$array_values["category_id"] = $param_category_id;
		$array_values["ticket_assigned_userid"] = 0;
		$array_values["ticket_sla_resp_date"] = '';
		$array_values["woocommerce_product_id"] = $param_woocommerce_productid;
		$array_values["ticket_creation_mode"] = 'frontend';


		//controller method
		$new_ticket_id = bwhd_controllers_tickets_insert( $array_values );

		//email notification
		if ( bwhd_globals_proversionactive() )
		{
			//do this if the notification plugin is active
			$notifications_params = array( 'notification_key'=>'newticketconfirmadmin', 'ticket_id'=>$new_ticket_id );
			bwhd_controllers_notifications_sendemail( $notifications_params );
		}
		else
		{
			//else check the default notification Settings
			if ( get_option( "bwhd_emailoncustomerticketcreation", "no" ) == "yes" )
			{

				bwhd_systemlog_addentry("INFO","ajax_frontend_tickets_insert","Sending Default Email");

				//raw email message
				$email_subject_raw = "Ticket: #[ticket_number] - New Ticket Created";
				$email_body_raw = "A new Support Ticket was created: <br><br> Request Title: [ticket_title] <br><br> Number: [ticket_number] ";

				//tokens replacement
				$email_subject = str_replace("[ticket_number]", $new_ticket_id , $email_subject_raw );
				$email_body = str_replace("[ticket_number]", $new_ticket_id , $email_body_raw );
				$email_body = str_replace("[ticket_title]", $param_ticket_title , $email_body );

				//Email header
				$email_headers = array( 'From: Helpdesk <' . get_option( "bwhd_helpdeskemail", "" ) . '>' . "\r\n" , 'Content-Type: text/html; charset=UTF-8' );

				//recipient
				$email_to = get_option( "bwhd_helpdeskemail", "" );

				//Sends the email
				wp_mail( $email_to, $email_subject, $email_body, $email_headers );

			}
		}

		bwhd_systemlog_addentry("FUNCTION","ajax_frontend_tickets_insert","End");

		//response
		wp_send_json( bwhd_ajax_return_reponse(1, "", "", $new_ticket_id, "") );

	}

	catch (Exception $e)
	{
		bwhd_systemlog_addentry("ERROR", "ajax_frontend_tickets_insert", $e->getMessage());
	}

	bwhd_systemlog_addentry("FUNCTION","ajax_frontend_tickets_insert","End");

}




?>
