<?php


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


//gets a list of statuses for tickets
function bwhd_controllers_status_list()
{

	bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_status_list","Start");

	try
	{

		$array_return = array();

		$status_info = new stdClass();
		$status_info->status_id = '1';
		$status_info->status_description = __('Open', "bravowp-helpdesk");
		$status_info->status_color = 'green';
		array_push($array_return, $status_info);

		$status_info = new stdClass();
		$status_info->status_id = '2';
		$status_info->status_description = __('Work in Progress', "bravowp-helpdesk");
		$status_info->status_color = 'blue';
		array_push($array_return, $status_info);

		$status_info = new stdClass();
		$status_info->status_id = '3';
		$status_info->status_description = __('Closed', "bravowp-helpdesk");
		$status_info->status_color = 'grey';
		array_push($array_return, $status_info);

		return $array_return;

	}

	catch (Exception $e)
	{
		bwhd_systemlog_addentry("ERROR", "bwhd_controllers_status_list", $e->getMessage());
	}

	bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_status_list","End");

}


function bwhd_controllers_status_returndescription( $status_id )
{

	bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_status_returndescription","Start");

	try
	{

		$result = "";

		//getting statuses
		$statuses_list = bwhd_controllers_status_list();
		foreach( $statuses_list as $status_info )
		{
			if ( $status_info->status_id == $status_id )
			{
				return $status_info->status_description;
			}
		}

	}

	catch (Exception $e)
	{
		bwhd_systemlog_addentry("ERROR", "bwhd_controllers_status_returndescription", $e->getMessage());
	}

	bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_status_returndescription","End");


}


function bwhd_controllers_status_returnlabelclass( $status_id )
{

	bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_status_returnlabelclass","Start");

	try
	{

		$result = "";

		//getting statuses
		$statuses_list = bwhd_controllers_status_list();
		foreach( $statuses_list as $status_info )
		{
			if ( $status_info->status_id == $status_id )
			{
				$result = $status_info->status_color;
			}
		}

		//checking for problems
		if ( $result == "")
		{
			//bwhd_log_addentry( "<<WARNING>>", "Tickets Statuses", "Retrieving label class from status code: " . $status_code . ". Status not found!" );
		}

		if ( $result == "grey" )
		{
			return "label label-default";
		}
		if ( $result == "blue" )
		{
			return "label label-primary";
		}
		if ( $result == "green" )
		{
			return "label label-success";
		}
		if ( $result == "azure" )
		{
			return "label label-info";
		}
		if ( $result == "yellow" )
		{
			return "label label-warning";
		}
		if ( $result == "red" )
		{
			return "label label-danger";
		}

		return $result;

	}

	catch (Exception $e)
	{
		bwhd_systemlog_addentry("ERROR", "bwhd_controllers_status_returnlabelclass", $e->getMessage());
	}

	bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_status_returnlabelclass","End");

}



?>
