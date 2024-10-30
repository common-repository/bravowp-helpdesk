<?php


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}




//listing all agents (wp_users) that are involved in tickets activities
function bwhd_controllers_agents_list()
{

	bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_agents_list","Start");

	try
	{

		global $wpdb;

		$query = "SELECT ID, display_name FROM " . $wpdb->prefix . "users WHERE EXISTS ( SELECT ticket_assigned_userid FROM " . $wpdb->prefix . "bw_helpdesk_tickets WHERE ticket_assigned_userid=" . $wpdb->prefix . "users.ID ) ";

		$query = $wpdb->prepare( $query, null );

		bwhd_systemlog_addentry("QUERY","bwhd_controllers_agents_list","Update Query: " . $query);

		$dbrows = $wpdb->get_results( $query , OBJECT );

		$results = array();

		//filling an array and returning only the needed content
		foreach( $dbrows as $row )
		{

			$result_new_row["agent_id"] = $row->ID;
			$result_new_row["agent_name"] = $row->display_name;

			array_push($results, $result_new_row);

		}

		return $results;

	}

	catch (Exception $e)
	{
		bwhd_systemlog_addentry("ERROR", "bwhd_controllers_agents_list", $e->getMessage());
	}

	bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_agents_list","End");

}

?>
