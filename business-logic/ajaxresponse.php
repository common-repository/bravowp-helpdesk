<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function bwhd_ajax_return_reponse( $success , $error_field_key, $error_message, $extra_data_1, $extra_data_2 ) {

	$return = array(
		'success'	=> $success,
		'error_field_key'		=> $error_field_key,
		'error_message'		=> $error_message,
		'extra_data_1'		=> $extra_data_1,
		'extra_data_2'		=> $extra_data_2
	);

	return $return;

}


?>
