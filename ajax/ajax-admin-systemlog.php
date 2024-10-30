<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function ajax_admin_systemlog_list() {

	bwhd_systemlog_addentry("FUNCTION","ajax_admin_systemlog_list","Start");

	try
	{

		if (bwhd_demo_is_active() == 1)
		{
			return 0;
		}

		$result = bwhd_systemlog_readlogfile();
		wp_send_json( $result );

	}

	catch (Exception $e)
	{
		bwhd_systemlog_addentry("ERROR", "ajax_admin_systemlog_list", $e->getMessage());
	}

	bwhd_systemlog_addentry("FUNCTION","ajax_admin_systemlog_list","End");


}


function ajax_admin_systemlog_clear() {

	bwhd_systemlog_addentry("FUNCTION","ajax_admin_systemlog_clear","Start");

	try
	{

		if (bwhd_demo_is_active() == 1)
		{
			return 0;
		}

		bwhd_systemlog_clearlogfile();
		wp_send_json( bwhd_ajax_return_reponse(1, "", "", null, "") );

	}

	catch (Exception $e)
	{
		bwhd_systemlog_addentry("ERROR", "ajax_admin_systemlog_clear", $e->getMessage());
	}

	bwhd_systemlog_addentry("FUNCTION","ajax_admin_systemlog_clear","End");


}


?>
