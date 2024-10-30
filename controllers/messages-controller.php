<?php


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


//update a single ticket
function bwhd_controllers_messages_insert( $params )
{

	bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_messages_insert","Start");

	try
	{

		global $wpdb;

		$query = "INSERT INTO " . $wpdb->prefix . "bw_helpdesk_messages ";
		$query .= " ( ";
		$query .= " author_type, ";
		$query .= " author_userid, ";
		$query .= " is_private, ";
		$query .= " is_sendemail, ";
		$query .= " message_date, ";
		$query .= " message_text, ";
		$query .= " ticket_id ";
		$query .= " ) ";

		$query .= " VALUES ";

		$query .= " ( ";
		$query .= " %s, ";
		$query .= " %d, ";
		$query .= " %d, ";
		$query .= " %d, ";
		$query .= " %s, ";
		$query .= " %s, ";
		$query .= " %d ";
		$query .= " ) ";

		$query = $wpdb->prepare(
		$query,
		$params["author_type"],
		$params["author_userid"],
		$params["is_private"],
		$params["is_sendemail"],
		$params["message_date"],
		$params["message_text"],
		$params["ticket_id"]
	);

	//logs the query text
	bwhd_systemlog_addentry("QUERY","bwhd_controllers_messages_insert","Update Query: " . $query);

	$results = $wpdb->query( $query , OBJECT );

}

catch (Exception $e)
{
	bwhd_systemlog_addentry("ERROR", "bwhd_controllers_messages_insert", $e->getMessage());
}

bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_messages_insert","End");


}


//gets a list of messages for the dashboard agent side of ticket view details
function bwhd_controllers_messages_listforticketsviewpagedashboard( $ticket_id )
{

	bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_messages_listforticketsviewpagedashboard","Start");

	try
	{

		global $wpdb;

		$query = "SELECT " . $wpdb->prefix . "bw_helpdesk_messages .*, " . $wpdb->prefix . "users.display_name AS author_userid_text
			  FROM " . $wpdb->prefix . "bw_helpdesk_messages
			  LEFT OUTER JOIN " . $wpdb->prefix . "users ON " . $wpdb->prefix . "bw_helpdesk_messages.author_userid = " . $wpdb->prefix . "users.ID
			  WHERE ticket_id = %d
			  ORDER BY message_date ";

		$query = $wpdb->prepare( $query, $ticket_id );

		$dbrows = $wpdb->get_results( $query , OBJECT );

		$results = array();

		//filling an array and returning only the needed content
		foreach( $dbrows as $row )
		{

			$result_new_row["message_text"] = $row->message_text;
			$result_new_row["is_private"] = $row->is_private;
			$result_new_row["message_date"] = bwhd_utility_formatdatetime( $row->message_date );
			$result_new_row["author_userid"] = $row->author_userid;
			$result_new_row["author_userid_text"] = $row->author_userid_text;
			$result_new_row["is_my_message"] = ( $row->author_userid == get_current_user_id() );
			$result_new_row["author_avatar"] = get_avatar( $row->author_userid, 32 );

			array_push($results, $result_new_row);

		}

		return $results;

	}

	catch (Exception $e)
	{
		bwhd_systemlog_addentry("ERROR", "bwhd_controllers_messages_listforticketsviewpagedashboard", $e->getMessage());
	}

	bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_messages_listforticketsviewpagedashboard","End");

}



//gets a list of messages for the front end part of view ticket details
function bwhd_controllers_messages_listforticketsviewpagefrontend( $ticket_id )
{

	bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_messages_listforticketsviewpagefrontend","Start");

	try
	{

		global $wpdb;

		$query = "SELECT * FROM " . $wpdb->prefix . "bw_helpdesk_messages WHERE ticket_id = %d AND is_private=0 ORDER BY message_date ";

		$query = $wpdb->prepare( $query, $ticket_id );

		$dbrows = $wpdb->get_results( $query , OBJECT );

		$results = array();

		//filling an array and returning only the needed content
		foreach( $dbrows as $row )
		{

			$result_new_row["message_text"] = $row->message_text;
			$result_new_row["message_date"] = bwhd_utility_formatdatetime( $row->message_date );
			$result_new_row["author_userid"] = $row->author_userid;
			$result_new_row["is_my_message"] = ( $row->author_userid == get_current_user_id() );
			$result_new_row["author_avatar"] = get_avatar( $row->author_userid, 32 );
			if ( $row->author_type == "customer")
			{
				$result_new_row["author_displayname"] = "Me";
			}
			if ( $row->author_type == "agent")
			{
				$agent_info = get_userdata( $row->author_userid );
				$result_new_row["author_displayname"] = $agent_info->display_name;
			}

			array_push($results, $result_new_row);

		}

		return $results;

	}

	catch (Exception $e)
	{
		bwhd_systemlog_addentry("ERROR", "bwhd_controllers_messages_listforticketsviewpagefrontend", $e->getMessage());
	}

	bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_messages_listforticketsviewpagefrontend","End");

}



?>
