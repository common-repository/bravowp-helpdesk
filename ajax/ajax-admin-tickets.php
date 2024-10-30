<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}




//this function is called to list tickets and search in the database
function ajax_admin_tickets_list() {

	bwhd_systemlog_addentry("FUNCTION","ajax_admin_tickets_list","Start");

	try
	{

		//reading post values
		$param_status = "%";   //default
		$param_category = "%";   //default
		$param_agent = "%";   //default

		if ( isset( $_POST["ticketstatus"] ))
		{
			if ( $_POST["ticketstatus"] != '0' )
			{
				$param_status = $_POST["ticketstatus"];
			}
		}
		if ( isset( $_POST["ticketcategory"] ))
		{
			if ( $_POST["ticketcategory"] != '0' )
			{
				$param_category = $_POST["ticketcategory"];
			}
		}
		if ( isset( $_POST["ticketagent"] ))
		{
			if ( $_POST["ticketagent"] != '0' )
			{
				$param_agent = $_POST["ticketagent"];
			}
		}


		$paramsForListTickets = array();
		$paramsForListTickets["filter_status_id"] = $param_status;
		$paramsForListTickets["filter_category_id"] = $param_category;
		$paramsForListTickets["filter_agent_assigned_id"] = $param_agent;
		$result = bwhd_controllers_tickets_listforticketslistpage( $paramsForListTickets );
		wp_send_json($result);

	}

	catch (Exception $e)
	{
		bwhd_systemlog_addentry("ERROR", "ajax_admin_tickets_list", $e->getMessage());
	}

	bwhd_systemlog_addentry("FUNCTION","ajax_admin_tickets_list","End");

}



//this function is called to load a single ticket details
function ajax_admin_tickets_getsingle() {

	bwhd_systemlog_addentry("FUNCTION","ajax_admin_tickets_getsingle","Start");

	try
	{

		$param_ticket_id = -1;
		if ( isset( $_POST['ticket_id'] ))
		{
			$param_ticket_id = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['ticket_id']) ));
		}
		$result = bwhd_controllers_tickets_getsingleforticketdetailspage( $param_ticket_id );
		wp_send_json($result);

	}

	catch (Exception $e)
	{
		bwhd_systemlog_addentry("ERROR", "ajax_admin_tickets_getsingle", $e->getMessage());
	}

	bwhd_systemlog_addentry("FUNCTION","ajax_admin_tickets_getsingle","End");

}



//this function is called to save a single ticket detail (update)
function ajax_admin_tickets_save() {

	bwhd_systemlog_addentry("FUNCTION","ajax_admin_tickets_save","Start");

	try
	{

		$param_ticketId = -1;
		if ( isset( $_POST['ticket_id'] ))
		{
			$param_ticketId = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['ticket_id']) ));
		}
		$param_ticketCategoryId = -1;
		if ( isset( $_POST['category_id'] ))
		{
			$param_ticketCategoryId = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['category_id']) ));
		}
		$param_ticketStatusId = -1;
		if ( isset( $_POST['status_id'] ))
		{
			$param_ticketStatusId = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['status_id']) ));
		}
		$param_woocommerce_productId = 0;
		if ( isset( $_POST['woocommerce_productid'] ))
		{
			$param_woocommerce_productId = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['woocommerce_productid']) ));
		}
		$param_priorityId = 0;
		if ( isset( $_POST['priority_id'] ))
		{
			$param_priorityId = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['priority_id']) ));
		}

		$array_values["ticket_id"] = $param_ticketId;
		$array_values["category_id"] = $param_ticketCategoryId;
		$array_values["status_id"] = $param_ticketStatusId;
		$array_values["priority_id"] = $param_priorityId;
		$array_values["woocommerce_product_id"] = $param_woocommerce_productId;

		$array_values["ensure_responded"] = 1;	//indicates to set the ticket as responded in case
		$array_values["check_status_and_closed"] = 1;	//indicates to set the ticket as closed if the given status is closed

		bwhd_controllers_tickets_update( $array_values );

		wp_send_json( bwhd_ajax_return_reponse(1, "", "", "", "") );

	}

	catch (Exception $e)
	{
		bwhd_systemlog_addentry("ERROR", "ajax_admin_tickets_save", $e->getMessage());
	}

	bwhd_systemlog_addentry("FUNCTION","ajax_admin_tickets_save","End");

}



//this function is called to save a single ticket detail (ticket new page)
function ajax_admin_tickets_insert() {

	bwhd_systemlog_addentry("FUNCTION","ajax_admin_tickets_insert","Start");

	try
	{

		$result_message = "";

		$param_customer_type = "";
		if ( isset( $_POST['customer_type'] ))
		{
			$param_customer_type = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['customer_type']) ));
		}
		$param_customer_existing_id = -1;
		if ( isset( $_POST['customer_existing_id'] ))
		{
			$param_customer_existing_id = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['customer_existing_id']) ));
		}
		$param_customer_new_name = "";
		if ( isset( $_POST['customer_new_name'] ))
		{
			$param_customer_new_name = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['customer_new_name']) ));
		}
		$param_customer_new_email = "";
		if ( isset( $_POST['customer_new_email'] ))
		{
			$param_customer_new_email = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['customer_new_email']) ));
		}
		$param_ticket_title = "";
		if ( isset( $_POST['ticket_title'] ))
		{
			$param_ticket_title = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['ticket_title']) ));
		}
		$param_ticket_problem = "";
		if ( isset( $_POST['ticket_problem'] ))
		{
			$param_ticket_problem = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['ticket_problem']) ));
		}
		$param_category_id = -1;
		if ( isset( $_POST['category_id'] ))
		{
			$param_category_id = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['category_id']) ));
		}
		$param_priority_id = -1;
		if ( isset( $_POST['priority_id'] ))
		{
			$param_priority_id = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['priority_id']) ));
		}
		$param_woocommerce_productid = 0;
		if ( isset( $_POST['woocommerce_productid'] ))
		{
			$param_woocommerce_productid = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['woocommerce_productid']) ));
		}

		//validation
		if ( $param_customer_type == "new" )
		{
			if ( $param_customer_new_name == "" )
			{
				wp_send_json( bwhd_ajax_return_reponse(0, "bwhd-admin-contentpane-control-ticketnew-txtcustomername", __("Please type a name for the Customer.", "bravowp-helpdesk"), "", "") );
			}
			if ( $param_customer_new_email == "" )
			{
				wp_send_json( bwhd_ajax_return_reponse(0, "bwhd-admin-contentpane-control-ticketnew-txtcustomeremail", __("Please type an email for the Customer.", "bravowp-helpdesk"), "", "") );
			}
		}
		else
		{

			if ( $param_customer_existing_id == "" || $param_customer_existing_id == "0" )
			{
				wp_send_json( bwhd_ajax_return_reponse(0, "bwhd-admin-contentpane-control-ticketnew-ddlexistingcustomer", __("Please select a Customer.", "bravowp-helpdesk"), "", "") );
			}

		}

		if ( $param_ticket_title == "" )
		{
			wp_send_json( bwhd_ajax_return_reponse(0, "bwhd-admin-contentpane-control-ticketnew-txttitle", __("Please type a title for this Ticket.", "bravowp-helpdesk"), "", "") );
		}
		if ( $param_ticket_problem == "" )
		{
			wp_send_json( bwhd_ajax_return_reponse(0, "bwhd-admin-contentpane-control-ticketnew-txtdescription", __("Please type a description for this Ticket.", "bravowp-helpdesk"), "", "") );
		}
		if ( $param_category_id == "" || $param_category_id == "0" )
		{
			wp_send_json( bwhd_ajax_return_reponse(0, "bwhd-admin-contentpane-control-ticketnew-ddlcategory", __("Please select a Category.", "bravowp-helpdesk"), "", "") );
		}


		//params adjusting
		if ( $param_customer_type == "existing" )
		{

			//getting the info for the existing customer
			$customer_info = bwhd_controllers_customers_getsingle( $param_customer_existing_id );

			$param_customer_new_name = $customer_info[0]->display_name;
			$param_customer_new_email = $customer_info[0]->user_email;

		}

		//array to pass to method
		$array_values["ticket_customer_userid"] = $param_customer_existing_id;
		$array_values["ticket_customer_fullname"] = $param_customer_new_name;
		$array_values["ticket_customer_email"] = $param_customer_new_email;
		$array_values["ticket_title"] = $param_ticket_title;
		$array_values["ticket_problem"] = $param_ticket_problem;
		$array_values["category_id"] = $param_category_id;
		$array_values["priority_id"] = $param_priority_id;
		$array_values["ticket_assigned_userid"] = get_current_user_id();	//when creating a ticket, the assigned agent is the current logged user
		$array_values["ticket_sla_resp_date"] = date('Y-m-d H:i:s');		//when creating a ticket, the response date is now (as the agent has created it)
		$array_values["woocommerce_product_id"] = $param_woocommerce_productid;
		$array_values["ticket_creation_mode"] = 'backend';

		//controller method
		$new_ticket_id = bwhd_controllers_tickets_insert( $array_values );

		//email notification
		if ( bwhd_globals_proversionactive() )
		{
			$notifications_params = array( 'notification_key'=>'newticketconfirmcust', 'ticket_id'=>$new_ticket_id );
			bwhd_controllers_notifications_sendemail( $notifications_params );
		}

		//response
		wp_send_json( bwhd_ajax_return_reponse(1, "", "", $new_ticket_id, "") );

	}

	catch (Exception $e)
	{
		bwhd_systemlog_addentry("ERROR", "ajax_admin_tickets_insert", $e->getMessage());
	}

	bwhd_systemlog_addentry("FUNCTION","ajax_admin_tickets_insert","End");

}






//this function is called to get the counters on the ticketslist page
function ajax_admin_tickets_getcounters() {

	bwhd_systemlog_addentry("FUNCTION","ajax_admin_tickets_getcounters","Start");

	try
	{

		//logging that this function was called
		bwhd_systemlog_addentry("FUNCTION","ajax_admin_tickets_getcounters","Start");

		$counter_myactivetickets = bwhd_controllers_tickets_gettotalassignedtoagent( get_current_user_id() );
		$counter_unassignedtickets = bwhd_controllers_tickets_gettotalopenticket();
		$counter_closedbymetickets = bwhd_controllers_tickets_gettotalclosedticket( get_current_user_id() );

		$result_data = $counter_myactivetickets["Total"] . "-" . $counter_unassignedtickets["Total"] . "-" . $counter_closedbymetickets["Total"];

		wp_send_json( bwhd_ajax_return_reponse(1, "", "", $result_data, "") );

		bwhd_systemlog_addentry("FUNCTION","ajax_admin_tickets_getcounters","End");

	}

	catch (Exception $e)
	{
		bwhd_systemlog_addentry("ERROR", "ajax_admin_tickets_getcounters", $e->getMessage());
	}

	bwhd_systemlog_addentry("FUNCTION","ajax_admin_tickets_getcounters","End");

}



function ajax_admin_tickets_loadopenedvsclosedchart() {

	bwhd_systemlog_addentry("FUNCTION","ajax_admin_tickets_loadopenedvsclosedchart","Start");

	try
	{

		//logging that this function was called
		bwhd_systemlog_addentry("FUNCTION","ajax_admin_tickets_loadopenedvsclosedchart","Start");

		$result = bwhd_controllers_tickets_getopenedvsclosedperdaterange();

		bwhd_systemlog_addentry("FUNCTION","ajax_admin_tickets_loadopenedvsclosedchart","End");

		wp_send_json( bwhd_ajax_return_reponse(1, "", "", $result, "") );

	}

	catch (Exception $e)
	{
		bwhd_systemlog_addentry("ERROR", "ajax_admin_tickets_loadopenedvsclosedchart", $e->getMessage());
	}

	bwhd_systemlog_addentry("FUNCTION","ajax_admin_tickets_loadopenedvsclosedchart","End");


}




?>
