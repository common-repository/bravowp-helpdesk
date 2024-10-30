<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


//returns 1 if it is running in demo mode
function bwhd_demo_is_active()
{

	try
	{

		if ( defined('BRAVOWP_HELPDESK_DEMO') )
		{
		        return 1;
		}
		else
		{
		        return 0;
		}

	}

	catch (Exception $e)
	{
		bwhd_systemlog_addentry("ERROR", "bwhd_demo_is_active", $e->getMessage());
	}

}

//returns 1 if the demo page must be allowed to administrator option
function bwhd_demo_forceadmincapabilities()
{

	try
	{

		if ( defined('BRAVOWP_HELPDESK_DEMO_FORCEADMINACCESSLEVEL') )
		{
		        return 1;
		}
		else
		{
		        return 0;
		}

	}

	catch (Exception $e)
	{
		bwhd_systemlog_addentry("ERROR", "bwhd_demo_forceadmincapabilities", $e->getMessage());
	}

}


?>
