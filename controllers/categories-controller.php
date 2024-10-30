<?php


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


//inserts a ticket category
function bwhd_controllers_categories_insert( $params )
{

	bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_categories_insert","Start");

	try
	{

		global $wpdb;

		$query = "INSERT INTO " . $wpdb->prefix . "bw_helpdesk_categories ";
		$query .= " ( ";
		$query .= " category_name ";
		$query .= " ) ";

		$query .= " VALUES ";

		$query .= " ( ";
		$query .= " %s ";
		$query .= " ) ";

		$query = $wpdb->prepare(
		$query,
		$params["category_name"]	);

		//logs the query text
		bwhd_systemlog_addentry("QUERY","bwhd_controllers_categories_insert","Update Query: " . $query);

		$results = $wpdb->query( $query , OBJECT );

	}

	catch (Exception $e)
	{
		bwhd_systemlog_addentry("ERROR", "bwhd_controllers_categories_insert", $e->getMessage());
	}

	bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_categories_insert","End");


}


//updates a ticket category
function bwhd_controllers_categories_update( $params )
{

	bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_categories_update","Start");

	try
	{

		global $wpdb;

		$query = "UPDATE " . $wpdb->prefix . "bw_helpdesk_categories ";
		$query .= " SET ";
		$query .= " category_name = %s ";
		$query .= " WHERE category_id = %d ";

		$query = $wpdb->prepare(
		$query,
		$params["category_name"],
		$params["category_id"]);

		//logs the query text
		bwhd_systemlog_addentry("QUERY","bwhd_controllers_categories_update","Update Query: " . $query);

		$results = $wpdb->query( $query , OBJECT );

	}

	catch (Exception $e)
	{
		bwhd_systemlog_addentry("ERROR", "bwhd_controllers_categories_update", $e->getMessage());
	}

	bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_categories_update","End");


}

//gets a list of categories for tickets
function bwhd_controllers_categories_list()
{

	bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_categories_list","Start");

	try
	{

		global $wpdb;

		$query = "SELECT * FROM " . $wpdb->prefix . "bw_helpdesk_categories ";

		//$query = $wpdb->prepare( $query, null  );

		bwhd_systemlog_addentry("QUERY","bwhd_controllers_categories_list","Update Query: " . $query);

		$dbrows = $wpdb->get_results( $query , OBJECT );

		$results = array();

		//filling an array and returning only the needed content
		foreach( $dbrows as $row )
		{

			$result_new_row["category_id"] = $row->category_id;
			$result_new_row["category_name"] = $row->category_name;

			array_push($results, $result_new_row);

		}

		return $results;

	}

	catch (Exception $e)
	{
		bwhd_systemlog_addentry("ERROR", "bwhd_controllers_categories_list", $e->getMessage());
	}

	bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_categories_list","End");

}



//gets a single category id
function bwhd_controllers_categories_get( $params )
{

	bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_categories_get","Start");

	try
	{

		global $wpdb;

		$query = "SELECT * FROM " . $wpdb->prefix . "bw_helpdesk_categories WHERE category_id=%d ";

		$query = $wpdb->prepare( $query, $params["category_id"] );

		bwhd_systemlog_addentry("QUERY","bwhd_controllers_categories_get","Update Query: " . $query);

		$dbrows = $wpdb->get_row( $query , OBJECT );

		$results = array();
		$results["category_id"] = $dbrows->category_id;
		$results["category_name"] = $dbrows->category_name;

		return $results;

	}

	catch (Exception $e)
	{
		bwhd_systemlog_addentry("ERROR", "bwhd_controllers_categories_get", $e->getMessage());
	}

	bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_categories_get","End");

}


//deletes a ticket category
function bwhd_controllers_categories_delete( $params )
{

	bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_categories_delete","Start");

	try
	{

		global $wpdb;

		$query = "DELETE FROM " . $wpdb->prefix . "bw_helpdesk_categories ";
		$query .= " WHERE category_id = %d ";

		$query = $wpdb->prepare(
		$query,
		$params["category_id"]);

		//logs the query text
		bwhd_systemlog_addentry("QUERY","bwhd_controllers_categories_delete","Update Query: " . $query);

		$results = $wpdb->query( $query , OBJECT );

	}

	catch (Exception $e)
	{
		bwhd_systemlog_addentry("ERROR", "bwhd_controllers_categories_delete", $e->getMessage());
	}

	bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_categories_delete","End");


}



?>
