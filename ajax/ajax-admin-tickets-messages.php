<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}



//this function is called to load a list of ticket's messages
function ajax_admin_tickets_message_load() {

	bwhd_systemlog_addentry("FUNCTION","ajax_admin_tickets_message_load","Start");

	try
	{

		$param_ticketId = -1;
		if ( isset( $_POST['ticket_id'] ))
		{
			$param_ticketId = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['ticket_id']) ));
		}
		$result = bwhd_controllers_messages_listforticketsviewpagedashboard( $param_ticketId );
		wp_send_json($result);

	}

	catch (Exception $e)
	{
		bwhd_systemlog_addentry("ERROR", "ajax_admin_tickets_message_load", $e->getMessage());
	}

	bwhd_systemlog_addentry("FUNCTION","ajax_admin_tickets_message_load","End");

}


//this function is called to save a new message to a ticket
function ajax_admin_tickets_message_save() {

	bwhd_systemlog_addentry("FUNCTION","ajax_admin_tickets_message_save","Start");

	try
	{

		$param_ticketId = -1;
		if ( isset( $_POST['ticket_id'] ))
		{
			$param_ticketId = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['ticket_id']) ));
		}
		$param_messageText = -1;
		if ( isset( $_POST['message_text'] ))
		{
			$param_messageText = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['message_text']) ));
		}
		$param_authorType = -1;
		if ( isset( $_POST['author_type'] ))
		{
			$param_authorType = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['author_type']) ));
		}
		$param_isPrivate = -1;
		if ( isset( $_POST['is_private'] ))
		{
			$param_isPrivate = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['is_private']) ));
		}
		$param_isEmail = -1;
		if ( isset( $_POST['is_sendemail'] ))
		{
			$param_isEmail = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['is_sendemail']) ));
		}

		if ( $param_messageText == "" )
		{
			wp_send_json( bwhd_ajax_return_reponse(0, "bwhd-admin-contentpane-control-ticketview-messages-txtmessage", __("Please type a Message.", "bravowp-helpdesk"), "", "") );
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
			$notifications_params = array( 'notification_key'=>'newmessagefromadmin', 'ticket_id'=>$param_ticketId, 'message'=>$param_messageText);
			bwhd_controllers_notifications_sendemail( $notifications_params );
		}

		wp_send_json("ok");

	}

	catch (Exception $e)
	{
		bwhd_systemlog_addentry("ERROR", "ajax_admin_tickets_message_save", $e->getMessage());
	}

	bwhd_systemlog_addentry("FUNCTION","ajax_admin_tickets_message_save","End");

}


?>
