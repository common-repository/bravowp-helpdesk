<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

//Returns an array of dates between two dates
function bwhd_utility_returndatearray( $strDateFrom, $strDateTo )
{

	bwhd_systemlog_addentry("FUNCTION","bwhd_utility_returndatearray","Start");

	try
	{

		$aryRange=array();

		$iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2), substr($strDateFrom,8,2),substr($strDateFrom,0,4));
		$iDateTo=mktime(1,0,0,substr($strDateTo,5,2), substr($strDateTo,8,2),substr($strDateTo,0,4));

		if ($iDateTo>=$iDateFrom)
		{
			$aryRange[ date('Y-m-d',$iDateFrom) ] = array( "opened"=>0, "closed"=>0, "date"=>date('m/d',$iDateFrom) );
			while ($iDateFrom<$iDateTo)
			{
				$iDateFrom+=86400; // add 24 hours
				$aryRange[ date('Y-m-d',$iDateFrom) ] = array( "opened"=>0, "closed"=>0, "date"=>date('m/d',$iDateFrom));
			}
		}
		return $aryRange;

	}

	catch (Exception $e)
	{
		bwhd_systemlog_addentry("ERROR", "bwhd_utility_returndatearray", $e->getMessage());
	}

	bwhd_systemlog_addentry("FUNCTION","bwhd_utility_returndatearray","End");
}


function bwhd_utility_checkdateinrange( $start_date, $end_date, $my_date)
{

	bwhd_systemlog_addentry("FUNCTION","bwhd_utility_checkdateinrange","Start");

	try
	{

		// Convert to timestamp
		$start_ts = strtotime($start_date);
		$end_ts = strtotime($end_date);
		$user_ts = strtotime($my_date);

		// Check that user date is between start & end
		return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));

	}

	catch (Exception $e)
	{
		bwhd_systemlog_addentry("ERROR", "bwhd_utility_checkdateinrange", $e->getMessage());
	}

	bwhd_systemlog_addentry("FUNCTION","bwhd_utility_checkdateinrange","End");

}


//Used to truncate a long text and add "..."
function bwhd_utility_truncatetext( $text, $lenght )
{

	bwhd_systemlog_addentry("FUNCTION","bwhd_utility_truncatetext","Start");

	try
	{

		return strlen($text) > $lenght ? substr($text,0,$lenght)."..." : $text;

	}

	catch (Exception $e)
	{
		bwhd_systemlog_addentry("ERROR", "bwhd_utility_truncatetext", $e->getMessage());
	}

	bwhd_systemlog_addentry("FUNCTION","bwhd_utility_truncatetext","End");

}

//formats a generic date
function bwhd_utility_formatdatetime( $date )
{

	bwhd_systemlog_addentry("FUNCTION","bwhd_utility_formatdatetime","Start");

	try
	{

		$date = date_create( $date );
		return $date->format('d/m/y g:i A');

	}

	catch (Exception $e)
	{
		bwhd_systemlog_addentry("ERROR", "bwhd_utility_formatdatetime", $e->getMessage());
	}

	bwhd_systemlog_addentry("FUNCTION","bwhd_utility_formatdatetime","End");

}




?>
