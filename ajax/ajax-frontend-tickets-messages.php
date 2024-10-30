<?php


//this function is called to load the messages edit ticket page
function ajax_frontend_tickets_messages_load() {

	bwhd_systemlog_addentry("FUNCTION","ajax_frontend_tickets_messages_load","Start");

	try
	{

		$param_ticket_id = -1;
		if ( isset( $_POST['ticket_id'] ))
		{
			$param_ticket_id = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['ticket_id']) ));
		}
		$result = bwhd_controllers_messages_listforticketsviewpagefrontend( $param_ticket_id );
		wp_send_json( $result );

	}

	catch (Exception $e)
	{
		bwhd_systemlog_addentry("ERROR", "ajax_frontend_tickets_messages_load", $e->getMessage());
	}

	bwhd_systemlog_addentry("FUNCTION","ajax_frontend_tickets_messages_load","End");

}


//this function is called to save a new message to a ticket
function ajax_frontend_tickets_messages_save() {

	bwhd_systemlog_addentry("FUNCTION","ajax_frontend_tickets_messages_save","Start");

	try
	{

		$param_ticketId = -1;
		$param_messageText = "";
		if ( isset( $_POST['ticket_id'] ))
		{
			$param_ticketId = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['ticket_id']) ));
		}
		if ( isset( $_POST['message_text'] ))
		{
			$param_messageText = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['message_text']) ));
		}
		$param_authorType = "customer";
		$param_isPrivate = 0;
		$param_isEmail = 1;

		//validation
		if ( $param_messageText == "" )
		{
			wp_send_json( bwhd_ajax_return_reponse(0, "bwhd-frontend-controls-ticketedit-txtnewmessage", __("Please type your message.", "bravowp-helpdesk"), "", "") );
		}

		$array_values["author_type"] = $param_authorType;
		$array_values["author_userid"] = get_current_user_id();
		$array_values["is_private"] = $param_isPrivate;
		$array_values["is_sendemail"] = $param_isEmail;
		$array_values["message_date"] = current_time('mysql');
		$array_values["message_text"] = $param_messageText;
		$array_values["ticket_id"] = $param_ticketId;

		bwhd_controllers_messages_insert( $array_values );

		if ( bwhd_globals_proversionactive() )
		{
			$notifications_params = array( 'notification_key'=>'newmessagefromcustomer', 'ticket_id'=>$param_ticketId, 'message'=>$param_messageText );
			bwhd_controllers_notifications_sendemail( $notifications_params );
		}

		wp_send_json( bwhd_ajax_return_reponse(1, "", "", "", "") );

	}

	catch (Exception $e)
	{
		bwhd_systemlog_addentry("ERROR", "ajax_frontend_tickets_messages_save", $e->getMessage());
	}

	bwhd_systemlog_addentry("FUNCTION","ajax_frontend_tickets_messages_save","End");

}


?>
