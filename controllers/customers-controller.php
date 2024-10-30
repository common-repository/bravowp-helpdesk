<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


//gets all fields from customer table
function bwhd_controllers_customers_getsingle( $customer_id )
{

	bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_customers_getsingle","Start");

	try
	{

		//logging that this function was called
		bwhd_systemlog_addentry("FUNCTION", "bwhd_controllers_customers_getsingle", "Start");

		global $wpdb;

		$query = "SELECT $wpdb->users.* FROM $wpdb->users WHERE ID = %d ";

		$query = $wpdb->prepare( $query, $customer_id );

		bwhd_systemlog_addentry("QUERY", "bwhd_controllers_customers_getsingle", $query);

		$dbrows = $wpdb->get_results( $query , OBJECT );

		bwhd_systemlog_addentry("RESULT", "bwhd_controllers_customers_getsingle", "Result contains: " . count( $dbrows ) );

		return $dbrows;

	}

	catch (Exception $e)
	{
		bwhd_systemlog_addentry("ERROR", "bwhd_controllers_customers_getsingle", $e->getMessage());
	}

	bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_customers_getsingle","End");

}



//getting a list of customers for the admin dropdown list
function bwhd_controllers_customers_listfordashboardticketcreate()
{

	bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_customers_listfordashboardticketcreate","Start");

	try
	{

		if (bwhd_demo_is_active() == 0)
		{

			//logging that this function was called
			bwhd_systemlog_addentry("FUNCTION", "bwhd_controllers_customers_listfordashboardticketcreate", "Start");

			global $wpdb;

			$query = "SELECT $wpdb->users.* FROM $wpdb->users WHERE $wpdb->users.user_status = 0 ORDER BY $wpdb->users.display_name ";

			$query = $wpdb->prepare( $query, null  );

			bwhd_systemlog_addentry("QUERY", "bwhd_controllers_customers_listfordashboardticketcreate", $query);

			$dbrows = $wpdb->get_results( $query , OBJECT );

			$results = array();

			//filling an array and returning only the needed content
			foreach( $dbrows as $row )
			{

				$result_new_row["id"] =  $row->ID ;
				$result_new_row["display_name"] =  $row->display_name ;

				array_push($results, $result_new_row);

			}

			bwhd_systemlog_addentry("RESULT", "bwhd_controllers_customers_listfordashboardticketcreate", "Result contains: " . count($query) );

			return $results;

		}
		else
		{

			$results = array();

			$result_customer1 = array();
			$result_customer1["id"] =  25 ;
			$result_customer1["display_name"] =  "Brian Mitchel";

			$result_customer2 = array();
			$result_customer2["id"] =  26 ;
			$result_customer2["display_name"] =  "Samantha Powel";

			$result_customer3 = array();
			$result_customer3["id"] =  27 ;
			$result_customer3["display_name"] =  "Paul Smith";

			array_push($results, $result_customer1);
			array_push($results, $result_customer2);
			array_push($results, $result_customer3);

			return $results;

		}

	}

	catch (Exception $e)
	{
		bwhd_systemlog_addentry("ERROR", "bwhd_controllers_customers_listfordashboardticketcreate", $e->getMessage());
	}

	bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_customers_listfordashboardticketcreate","End");

}



?>
