<?php


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}



//gets a tickets (admin dashboard)
function bwhd_controllers_tickets_getsingleforeditpagefrontend( $ticket_id )
{

	bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_tickets_getsingleforeditpagefrontend","Start");

	try
	{


		global $wpdb;

		$query = "SELECT * FROM " . $wpdb->prefix . "bw_helpdesk_tickets WHERE ticket_id = %d" ;

		$query = $wpdb->prepare( $query, $ticket_id );

		$dbrows = $wpdb->get_row( $query , OBJECT );

		$result["ticket_id"] = $dbrows->ticket_id;
		$result["ticket_title"] = $dbrows->ticket_title;
		$result["ticket_problem"] = $dbrows->ticket_problem;
		$result["status_id"] = $dbrows->status_id;
		$result["status_description"] = bwhd_controllers_status_returndescription( $dbrows->status_id );
		$result["status_label"] = bwhd_controllers_status_returnlabelclass( $dbrows->status_id );
		$result["ticket_created_date"] = $dbrows->ticket_created_date;
		$result["priority_id"] = $dbrows->priority_id;
		$result["priority_description"] = bwhd_controllers_priorities_returndescription( $dbrows->priority_id );

		return $result;

	}

	catch (Exception $e)
	{
		bwhd_systemlog_addentry("ERROR", "bwhd_controllers_tickets_getsingleforeditpagefrontend", $e->getMessage());
	}

	bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_tickets_getsingleforeditpagefrontend","End");

}


//gets response, solution, and closed status informations for a ticket
function bwhd_controllers_tickets_getresponseandsolutioninfo( $ticket_id )
{

	bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_tickets_getresponseandsolutioninfo","Start");

	try
	{


		global $wpdb;

		$query = "SELECT * FROM " . $wpdb->prefix . "bw_helpdesk_tickets WHERE ticket_id = %d" ;

		$query = $wpdb->prepare( $query, $ticket_id );

		$dbrows = $wpdb->get_row( $query , OBJECT );

		$result["ticket_is_closed"] = $dbrows->ticket_is_closed;
		$result["ticket_closed_date"] = $dbrows->ticket_closed_date;
		$result["ticket_sla_resp_before"] = $dbrows->ticket_sla_resp_before;
		$result["ticket_sla_solv_before"] = $dbrows->ticket_sla_solv_before;
		$result["ticket_sla_resp_date"] = $dbrows->ticket_sla_resp_date;
		$result["ticket_sla_solv_date"] = $dbrows->ticket_sla_solv_date;

		return $result;

	}

	catch (Exception $e)
	{
		bwhd_systemlog_addentry("ERROR", "bwhd_controllers_tickets_getresponseandsolutioninfo", $e->getMessage());
	}

	bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_tickets_getresponseandsolutioninfo","End");

}


//gets the current assigned agent to the ticket. Returns 0 if not assigned
function bwhd_controllers_tickets_getagentassignedinfo( $ticket_id )
{

	bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_tickets_getagentassignedinfo","Start");

	try
	{


		global $wpdb;

		$query = "SELECT IFNULL(ticket_assigned_userid,0) as ticket_assigned_userid FROM " . $wpdb->prefix . "bw_helpdesk_tickets WHERE ticket_id = %d" ;

		$query = $wpdb->prepare( $query, $ticket_id );

		$dbrows = $wpdb->get_row( $query , OBJECT );

		$result["ticket_assigned_userid"] = $dbrows->ticket_assigned_userid;

		return $result;

	}

	catch (Exception $e)
	{
		bwhd_systemlog_addentry("ERROR", "bwhd_controllers_tickets_getagentassignedinfo", $e->getMessage());
	}

	bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_tickets_getagentassignedinfo","End");

}



//gets a tickets (admin dashboard)
function bwhd_controllers_tickets_getsingleforticketdetailspage( $ticket_id )
{

	bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_tickets_getsingleforticketdetailspage","Start");

	try
	{


		global $wpdb;

		$query = "SELECT * FROM " . $wpdb->prefix . "bw_helpdesk_tickets WHERE ticket_id = %d";

		$query = $wpdb->prepare( $query, $ticket_id );

		$dbrows = $wpdb->get_row( $query , OBJECT );

		$result["ticket_id"] = $dbrows->ticket_id;
		$result["ticket_title"] = $dbrows->ticket_title;
		$result["ticket_problem"] = $dbrows->ticket_problem;
		$result["category_id"] = $dbrows->category_id;
		$result["status_id"] = $dbrows->status_id;
		$result["customer_avatar"] = get_avatar( $dbrows->ticket_customer_userid, 48 );
		$result["customer_name"] = $dbrows->ticket_customer_fullname;
		$result["customer_email"] = $dbrows->ticket_customer_email;
		$result["woocommerce_product_id"] = $dbrows->woocommerce_product_id;
		$result["priority_id"] = $dbrows->priority_id;
		$result["priority_description"] = bwhd_controllers_priorities_returndescription( $dbrows->priority_id );

		return $result;

	}

	catch (Exception $e)
	{
		bwhd_systemlog_addentry("ERROR", "bwhd_controllers_tickets_getsingleforticketdetailspage", $e->getMessage());
	}

	bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_tickets_getsingleforticketdetailspage","End");

}


//gets a ticket row to have the info to send in the emails notification
function bwhd_controllers_tickets_getforsendingnotification( $ticket_id )
{

	bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_tickets_getforsendingnotification","Start");

	try
	{


		global $wpdb;

		$query = "SELECT * FROM " . $wpdb->prefix . "bw_helpdesk_tickets WHERE ticket_id = %d";

		$query = $wpdb->prepare( $query, $ticket_id );

		$dbrows = $wpdb->get_row( $query , OBJECT );

		$result["ticket_id"] = $dbrows->ticket_id;
		$result["ticket_title"] = $dbrows->ticket_title;
		$result["ticket_problem"] = $dbrows->ticket_problem;
		$result["category_id"] = $dbrows->category_id;
		$result["status_id"] = $dbrows->status_id;
		$result["customer_avatar"] = get_avatar( $dbrows->ticket_customer_userid, 48 );
		$result["customer_name"] = $dbrows->ticket_customer_fullname;
		$result["customer_email"] = $dbrows->ticket_customer_email;

		return $result;

	}

	catch (Exception $e)
	{
		bwhd_systemlog_addentry("ERROR", "bwhd_controllers_tickets_getforsendingnotification", $e->getMessage());
	}

	bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_tickets_getforsendingnotification","End");

}


//gets a list of tickets for the tickets list page, only the needed fields will be returned
function bwhd_controllers_tickets_listforticketslistpage( $params )
{

	bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_tickets_listforticketslistpage","Start");

	try
	{

		global $wpdb;

		//notes on parameters
		//$params["filter_status_id"] = -1 -> All non-closed tickets
		//$params["filter_status_id"] = -2 -> All unresponded tickets
		//$params["filter_agent_assigned_id"] = -1 -> All unassigned tickets

		$query = "SELECT " . $wpdb->prefix . "bw_helpdesk_tickets.*, IFNULL(" . $wpdb->prefix . "bw_helpdesk_categories.category_name, '') as category_name, IFNULL(" . $wpdb->prefix . "users.display_name, '') as ticket_assigned_userid_text
		FROM " . $wpdb->prefix . "bw_helpdesk_tickets
		LEFT OUTER JOIN " . $wpdb->prefix . "bw_helpdesk_categories ON " . $wpdb->prefix . "bw_helpdesk_tickets.category_id = " . $wpdb->prefix . "bw_helpdesk_categories.category_id
		LEFT OUTER JOIN " . $wpdb->prefix . "users ON " . $wpdb->prefix . "bw_helpdesk_tickets.ticket_assigned_userid = " . $wpdb->prefix . "users.ID
		WHERE
			( status_id LIKE %s OR ( ticket_is_closed=0 AND %s=-1 ) OR ( ticket_sla_resp_date IS NULL AND %s=-2 ) )
			AND
			" . $wpdb->prefix . "bw_helpdesk_tickets.category_id LIKE %s
			AND
			( " . $wpdb->prefix . "bw_helpdesk_tickets.ticket_assigned_userid LIKE %s OR ( IFNULL(" . $wpdb->prefix . "bw_helpdesk_tickets.ticket_assigned_userid,0)=0 AND %s=-1  )  )
			"
		;

		//bwhd_systemlog_addentry("DEBUG","bwhd_controllers_tickets_listforticketslistpage","Query: " . $query);

		$query = $wpdb->prepare( $query, $params["filter_status_id"], $params["filter_status_id"], $params["filter_status_id"], $params["filter_category_id"], $params["filter_agent_assigned_id"], $params["filter_agent_assigned_id"] );

		$dbrows = $wpdb->get_results( $query , OBJECT );

		$results = array();

		//filling an array and returning only the needed content
		foreach( $dbrows as $row )
		{

			$result_new_row["ticket_id"] = $row->ticket_id;
			$result_new_row["ticket_title"] = $row->ticket_title;
			$result_new_row["customer_name"] = $row->ticket_customer_fullname;
			$result_new_row["customer_avatar"] = get_avatar( $row->ticket_customer_userid, 32 );
			$result_new_row["status_description"] = bwhd_controllers_status_returndescription( $row->status_id );
			$result_new_row["status_label"] = bwhd_controllers_status_returnlabelclass( $row->status_id );
			$result_new_row["category_name"] = $row->category_name;
			$result_new_row["ticket_assigned_userid_text"] = $row->ticket_assigned_userid_text;
			$result_new_row["ticket_created_date"] = bwhd_utility_formatdatetime( $row->ticket_created_date );
			$result_new_row["priority_id"] = $row->priority_id;
			$result_new_row["priority_description"] = bwhd_controllers_priorities_returndescription( $row->priority_id );
			$result_new_row["ticket_creation_mode"] = bwhd_controllers_tickets_gethumanreadableticketcreationmode( $row->ticket_creation_mode );

			//replacing the blank assignment agent into with the label "Unassigned"
			if ( $row->ticket_assigned_userid_text == "")
			{
				$result_new_row["ticket_assigned_userid_text"] = __("(unassigned)", "bravowp-helpdesk");
			}

			array_push($results, $result_new_row);

		}

		return $results;

	}

	catch (Exception $e)
	{
		bwhd_systemlog_addentry("ERROR", "bwhd_controllers_tickets_listforticketslistpage", $e->getMessage());
	}

	bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_tickets_listforticketslistpage","End");

}



//gets a list of last 3 created tickets
function bwhd_controllers_tickets_listfordashboardlast5tickets()
{

	bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_tickets_listfordashboardlast5tickets","Start");

	try
	{

		global $wpdb;

		$query = "SELECT * FROM " . $wpdb->prefix . "bw_helpdesk_tickets ORDER BY ticket_created_date DESC LIMIT 3 ";

		$dbrows = $wpdb->get_results( $query , OBJECT );

		$results = array();

		//filling an array and returning only the needed content
		foreach( $dbrows as $row )
		{

			$result_new_row["ticket_id"] = $row->ticket_id;
			$result_new_row["ticket_title"] = bwhd_utility_truncatetext( $row->ticket_title, 40 );
			$result_new_row["customer_name"] = $row->ticket_customer_fullname;
			$result_new_row["customer_email"] = $row->ticket_customer_email;
			$result_new_row["customer_avatar"] = get_avatar( $row->ticket_customer_userid, 32 );
			$result_new_row["status_description"] = bwhd_controllers_status_returndescription( $row->status_id );
			$result_new_row["status_label"] = bwhd_controllers_status_returnlabelclass( $row->status_id );

			array_push($results, $result_new_row);

		}

		return $results;

	}

	catch (Exception $e)
	{
		bwhd_systemlog_addentry("ERROR", "bwhd_controllers_tickets_listfordashboardlast5tickets", $e->getMessage());
	}

	bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_tickets_listfordashboardlast5tickets","End");

}



//gets a list of tickets for the tickets list page on the frond end, only the needed fields will be returned, for the current logged user
function bwhd_controllers_tickets_listforticketslistpage_frontend()
{

	bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_tickets_listforticketslistpage_frontend","Start");

	try
	{


		global $wpdb;

		$query = "SELECT * FROM " . $wpdb->prefix . "bw_helpdesk_tickets WHERE ticket_customer_userid = %d";

		$query = $wpdb->prepare( $query, get_current_user_id() );

		//logs the query text
		bwhd_systemlog_addentry("QUERY","bwhd_controllers_tickets_listforticketslistpage_frontend","Update Query: " . $query);

		$dbrows = $wpdb->get_results( $query , OBJECT );

		$results = array();

		//filling an array and returning only the needed content
		foreach( $dbrows as $row )
		{

			$result_new_row["ticket_id"] = $row->ticket_id;
			$result_new_row["ticket_title"] = $row->ticket_title;
			$result_new_row["status_description"] = bwhd_controllers_status_returndescription( $row->status_id );
			$result_new_row["status_label"] = bwhd_controllers_status_returnlabelclass( $row->status_id );
			$result_new_row["priority_id"] = $row->priority_id;
			$result_new_row["priority_description"] = bwhd_controllers_priorities_returndescription( $row->priority_id );

			array_push($results, $result_new_row);

		}

		//logs the query text
		bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_tickets_listforticketslistpage_frontend", "Finish");

		return $results;

	}

	catch (Exception $e)
	{
		bwhd_systemlog_addentry("ERROR", "bwhd_controllers_tickets_listforticketslistpage_frontend", $e->getMessage());
	}

	bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_tickets_listforticketslistpage_frontend","End");

}


//update a single ticket
//set the param "ensure_responded" to 1, to make sure that the ticket will
//be set as responded after the update
//set the param "check_status_and_closed" to 1, to make sure that the ticket will
//be set as closed if its status is "closed"
function bwhd_controllers_tickets_update( $params )
{

	bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_tickets_update","Start");

	try
	{

		global $wpdb;

		$query = "UPDATE " . $wpdb->prefix . "bw_helpdesk_tickets SET ";

		$query .= " category_id = %s, ";
		$query .= " status_id = %s, ";
		$query .= " woocommerce_product_id = %s, ";
		$query .= " priority_id = %s ";

		$query .= " WHERE ticket_id = %d" ;

		$query = $wpdb->prepare( $query, $params["category_id"], $params["status_id"], $params["woocommerce_product_id"], $params["priority_id"], $params["ticket_id"] );

		//logs the query text
		bwhd_systemlog_addentry("QUERY","bwhd_controllers_tickets_update","Update Query: " . $query);

		$results = $wpdb->query( $query , OBJECT );


		//mark the ticket as responded?
		if ( isset( $params["ensure_responded"] ) )
		{

			if ( $params["ensure_responded"] == 1 )
			{

				$ticket_info = bwhd_controllers_tickets_getresponseandsolutioninfo( $params["ticket_id"] );
				if ( $ticket_info["ticket_sla_resp_date"] == null )
				{

					$query = "UPDATE " . $wpdb->prefix . "bw_helpdesk_tickets SET ";
					$query .= " ticket_sla_resp_date = '" . date('Y-m-d H:i:s') . "' ";
					$query .= " WHERE ticket_id = %d ";

					$query = $wpdb->prepare( $query, $params["ticket_id"] );

					bwhd_systemlog_addentry("QUERY","bwhd_controllers_tickets_update_setresponded","Update Query: " . $query);

					$wpdb->query( $query , OBJECT );

				}

				//if ticket_assigned_userid is null, set this current user as agent
				$ticket_info_assigneddata = bwhd_controllers_tickets_getagentassignedinfo( $params["ticket_id"] );
				if ( $ticket_info_assigneddata["ticket_assigned_userid"] == 0 )
				{

					//this is an unresponded unassigned ticket. Set the current user as new agent to which the ticket is assigned to
					$query = "UPDATE " . $wpdb->prefix . "bw_helpdesk_tickets SET ";
					$query .= " ticket_assigned_userid = %d ";
					$query .= " WHERE ticket_id = %d ";

					$query = $wpdb->prepare( $query, get_current_user_id(), $params["ticket_id"] );

					bwhd_systemlog_addentry("QUERY","bwhd_controllers_tickets_update_setassigned","Update Query: " . $query);

					$wpdb->query( $query , OBJECT );

				}

			}

		}


		//marks the ticket as closed?
		if ( isset( $params["check_status_and_closed"] ) )
		{

			if ( $params["check_status_and_closed"] == 1 )
			{

				if ( $params["status_id"] == 3 )	//3 is the status "closed"
				{

					$ticket_info = bwhd_controllers_tickets_getresponseandsolutioninfo( $params["ticket_id"] );
					if ( $ticket_info["ticket_is_closed"] == 0 )
					{

						$query = "UPDATE " . $wpdb->prefix . "bw_helpdesk_tickets SET ";
						$query .= " ticket_closed_date = '" . date('Y-m-d H:i:s') . "', ";
						$query .= " ticket_is_closed = 1 ";
						$query .= " WHERE ticket_id = %d ";

						$query = $wpdb->prepare( $query, $params["ticket_id"] );

						bwhd_systemlog_addentry("QUERY","bwhd_controllers_tickets_update_setclosed","Update Query: " . $query);

						$wpdb->query( $query , OBJECT );

					}

				}

			}

		}

	}

	catch (Exception $e)
	{
		bwhd_systemlog_addentry("ERROR", "bwhd_controllers_tickets_update", $e->getMessage());
	}

	bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_tickets_update","End");

}



//inserts a ticket
function bwhd_controllers_tickets_insert( $params )
{

	bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_tickets_insert","Start");

	try
	{

		//validating params to defaults
		if ( isset($params["priority_id"]) == false)
		{
			$params["priority_id"] = 0;
		}

		global $wpdb;

		$query = "INSERT INTO " . $wpdb->prefix . "bw_helpdesk_tickets ";
		$query .= " ( ";
		$query .= " ticket_title, ";
		$query .= " ticket_problem, ";
		$query .= " category_id, ";
		$query .= " priority_id, ";
		$query .= " department_id, ";
		$query .= " customer_contract_id, ";
		$query .= " status_id, ";
		$query .= " ticket_is_closed, ";
		$query .= " ticket_created_date, ";
		$query .= " ticket_created_userid, ";
		$query .= " ticket_assigned_userid, ";
		$query .= " ticket_customer_userid, ";
		$query .= " ticket_customer_fullname, ";
		$query .= " ticket_customer_email, ";
		$query .= " ticket_closed_date, ";
		$query .= " ticket_sla_resp_before, ";
		$query .= " ticket_sla_solv_before, ";
		$query .= " ticket_sla_resp_date, ";
		$query .= " ticket_sla_solv_date, ";
		$query .= " woocommerce_product_id, ";
		$query .= " ticket_creation_mode ";
		$query .= " ) ";

		$query .= " VALUES ";

		$query .= " ( ";
		$query .= " %s, ";
		$query .= " %s, ";
		$query .= " %d, ";		//category id
		$query .= " %d, ";		//priority id
		$query .= " " . "0" . ", ";		//department id
		$query .= " " . "0" . ", ";		//customer contract id
		$query .= " " . "1" . ", ";		//default status id (1=open)
		$query .= " " . "0" . ", ";		//is closed (0=no)
		$query .= " '" . date('Y-m-d H:i:s') . "', ";		//created date = current date
		$query .= " " . "0" . ", ";		//created user id
		$query .= " %d, ";		//assigned user id
		$query .= " %d, ";		//customer id
		$query .= " %s, ";
		$query .= " %s, ";
		$query .= " null , ";	//closed date
		$query .= " null , ";	//resp before date
		$query .= " null , ";	//solution before date
		$query .= " %s, ";	//resp date
		$query .= " null,  ";	//solution date
		$query .= " %d,  ";	//product id
		$query .= " %s  ";	//ticket creation mode
		$query .= " ) ";

		$query = $wpdb->prepare( $query,
		$params["ticket_title"],
		$params["ticket_problem"],
		$params["category_id"],
		$params["priority_id"],
		$params["ticket_assigned_userid"],
		$params["ticket_customer_userid"],
		$params["ticket_customer_fullname"],
		$params["ticket_customer_email"],
		$params["ticket_sla_resp_date"],
		$params["woocommerce_product_id"],
		$params["ticket_creation_mode"]
	);

	//logs the query text
	bwhd_systemlog_addentry("QUERY","bwhd_controllers_tickets_insert","Insert Query: " . $query);

	$results = $wpdb->query( $query );
	$lastid = $wpdb->insert_id;

	bwhd_systemlog_addentry("QUERY","bwhd_controllers_tickets_insert","Ticket ID generated: " . $lastid);

	return $lastid;

}

catch (Exception $e)
{
	bwhd_systemlog_addentry("ERROR", "bwhd_controllers_tickets_insert", $e->getMessage());
}

bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_tickets_insert","End");

}




//Gets the total of the tickets assigned to an Agent (not closed tickets)
function bwhd_controllers_tickets_gettotalassignedtoagent( $assigned_user_id )
{

	bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_tickets_gettotalassignedtoagent","Start");

	try
	{


		global $wpdb;

		$query = "SELECT COUNT(*) as Total FROM " . $wpdb->prefix . "bw_helpdesk_tickets WHERE ticket_is_closed = 0 AND ticket_assigned_userid = %d" ;

		$query = $wpdb->prepare( $query, $assigned_user_id );

		$dbrows = $wpdb->get_row( $query , OBJECT );

		$result["Total"] = "$dbrows->Total";

		return $result;

	}

	catch (Exception $e)
	{
		bwhd_systemlog_addentry("ERROR", "bwhd_controllers_tickets_gettotalassignedtoagent", $e->getMessage());
	}

	bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_tickets_gettotalassignedtoagent","End");

}


//Gets the total of the non responsed tickets
function bwhd_controllers_tickets_gettotalopenticket()
{

	bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_tickets_gettotalopenticket","Start");

	try
	{

		global $wpdb;

		$query = "SELECT COUNT(*) as Total FROM " . $wpdb->prefix . "bw_helpdesk_tickets WHERE ticket_is_closed = 0 AND ticket_sla_resp_date IS NULL " ;

		$dbrows = $wpdb->get_row( $query , OBJECT );

		$result["Total"] = $dbrows->Total;

		return $result;

	}

	catch (Exception $e)
	{
		bwhd_systemlog_addentry("ERROR", "bwhd_controllers_tickets_gettotalopenticket", $e->getMessage());
	}

	bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_tickets_gettotalopenticket","End");

}

//Gets the total of closed tickets by an agent
function bwhd_controllers_tickets_gettotalclosedticket( $assigned_user_id )
{

	bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_tickets_gettotalclosedticket","Start");

	try
	{


		global $wpdb;

		$query = "SELECT COUNT(*) as Total FROM " . $wpdb->prefix . "bw_helpdesk_tickets WHERE ticket_is_closed = 1 AND ticket_assigned_userid = %d" ;

		$query = $wpdb->prepare( $query, $assigned_user_id );

		$dbrows = $wpdb->get_row( $query , OBJECT );

		$result["Total"] = $dbrows->Total;

		return $result;

	}

	catch (Exception $e)
	{
		bwhd_systemlog_addentry("ERROR", "bwhd_controllers_tickets_gettotalclosedticket", $e->getMessage());
	}

	bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_tickets_gettotalclosedticket","End");

}



//Gets a list of total of tickets opened and closed for a range of days
function bwhd_controllers_tickets_getopenedvsclosedperdaterange()
{

	bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_tickets_getopenedvsclosedperdaterange","Start");

	try
	{

		bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_tickets_getopenedvsclosedperdaterange", "Start");


		$result_data = "";


		//calculates date range
		$date_up_range_limit = date('Y-m-d', strtotime("+1 days"));
		$date_down_range_limit = date('Y-m-d', strtotime("-10 days"));
		bwhd_systemlog_addentry("INFO","bwhd_controllers_tickets_getopenedvsclosedperdaterange", "Date_up: " . $date_up_range_limit);
		bwhd_systemlog_addentry("INFO","bwhd_controllers_tickets_getopenedvsclosedperdaterange", "Date_down: " . $date_down_range_limit);


		//getting data from DB, all the tickets that were opened and closed in the date range
		global $wpdb;
		$query = "SELECT ticket_created_date, ticket_closed_date FROM " . $wpdb->prefix . "bw_helpdesk_tickets WHERE ticket_closed_date <= %d OR ticket_created_date >= %d " ;

		$query = $wpdb->prepare( $query, $date_up_range_limit, $date_down_range_limit );

		bwhd_systemlog_addentry("FUNCTION","QUERY", $query);

		$dataset  = $wpdb->get_results( $query, ARRAY_A );
		//$debug = var_export($dataset, true);
		//bwhd_systemlog_addentry("FUNCTION","DEBUG DATASET", $debug);


		//building an array of dates between two dates
		$array_of_dates = bwhd_utility_returndatearray( $date_down_range_limit, $date_up_range_limit );
		//var_dump($array_of_dates);

		//cycle the database result table and adds 1 unit to the full dates list of interal array
		foreach ( $dataset as $row )
		{

			if ( is_null($row["ticket_created_date"]) == false)
			{

				if ( bwhd_utility_checkdateinrange( $date_down_range_limit , $date_up_range_limit , $row["ticket_created_date"] ) == true )
				{

					$existing_data_for_date = $array_of_dates[ date_format(  date_create($row["ticket_created_date"]) , "Y-m-d") ];
					$existing_data_for_date["opened"] = $existing_data_for_date["opened"] + 1;
					$array_of_dates[ date_format(date_create($row["ticket_created_date"]) , "Y-m-d") ] = $existing_data_for_date;

				}

			}

			if ( is_null($row["ticket_closed_date"]) == false)
			{

				if ( bwhd_utility_checkdateinrange( $date_down_range_limit , $date_up_range_limit , $row["ticket_closed_date"] ) == true )
				{

					$existing_data_for_date = $array_of_dates[ date_format(  date_create($row["ticket_closed_date"]) , "Y-m-d") ];
					$existing_data_for_date["closed"] = $existing_data_for_date["closed"] + 1;
					$array_of_dates[ date_format(date_create($row["ticket_closed_date"]) , "Y-m-d") ] = $existing_data_for_date;

				}

			}

		}

		//$debug = var_export($array_of_dates, true);
		//bwhd_systemlog_addentry("FUNCTION","DEBUG ARRAY OF DATES", $debug);


		bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_tickets_getopenedvsclosedperdaterange", "Finish");

		return $array_of_dates;

	}

	catch (Exception $e)
	{
		bwhd_systemlog_addentry("ERROR", "bwhd_controllers_tickets_getopenedvsclosedperdaterange", $e->getMessage());
	}

	bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_tickets_getopenedvsclosedperdaterange","End");

}


//Gets a readable ticket creation mode from a key
function bwhd_controllers_tickets_gethumanreadableticketcreationmode( $ticketCreationMode )
{

	if ( $ticketCreationMode==null )
	{
		return "";
	}

	if ( $ticketCreationMode=="" )
	{
		return "";
	}

	if ( $ticketCreationMode=="email" )
	{
		return "Email";
	}

	if ( $ticketCreationMode=="backend" )
	{
		return "Backend Application";
	}

	if ( $ticketCreationMode=="frontend" )
	{
		return "Frontend ";
	}

}

?>
