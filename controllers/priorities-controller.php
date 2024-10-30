<?php


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


//gets a list of priorities for tickets
function bwhd_controllers_priorities_list()
{

	bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_priorities_list","Start");

	try
	{

		$array_return = array();

		$priority_info = new stdClass();
		$priority_info->priority_id = '1';
		$priority_info->priority_description = __('Low', "bravowp-helpdesk");
		array_push($array_return, $priority_info);

		$priority_info = new stdClass();
		$priority_info->priority_id = '2';
		$priority_info->priority_description = __('Normal', "bravowp-helpdesk");
		array_push($array_return, $priority_info);

		$priority_info = new stdClass();
		$priority_info->priority_id = '3';
		$priority_info->priority_description = __('Urgent', "bravowp-helpdesk");
		array_push($array_return, $priority_info);

		return $array_return;

	}

	catch (Exception $e)
	{
		bwhd_systemlog_addentry("ERROR", "bwhd_controllers_priorities_list", $e->getMessage());
	}

	bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_priorities_list","End");

}


function bwhd_controllers_priorities_returndescription( $priority_id )
{

	bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_priorities_returndescription","Start");

	try
	{

		$result = "";

		//getting statuses
		$priorities_list = bwhd_controllers_priorities_list();
		foreach( $priorities_list as $priority_info )
		{
			if ( $priority_info->priority_id == $priority_id )
			{
				return $priority_info->priority_description;
			}
		}

	}

	catch (Exception $e)
	{
		bwhd_systemlog_addentry("ERROR", "bwhd_controllers_priorities_returndescription", $e->getMessage());
	}

	bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_priorities_returndescription","End");


}

?>
