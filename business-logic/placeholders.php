<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


//Used to display the "no data because no addon"
function bwhd_placeholders_nodatanoaddon()
{

	bwhd_systemlog_addentry("FUNCTION","bwhd_placeholders_nodatanoaddon","Start");

	return __("No data (add on not installed)", "bravowp-helpdesk");

	bwhd_systemlog_addentry("FUNCTION","bwhd_placeholders_nodatanoaddon","End");

}


//Used in admin dashboard to render the "coming soon" panel
// function bwhd_placeholders_comingsoonpanel()
// {
//
// 	bwhd_systemlog_addentry("FUNCTION","bwhd_placeholders_comingsoonpanel","Start");
//
//
// 	$content = "";
//
// 	$content .= "<div class='text-center'>";
// 	$content .= "	<i class='fa fa-clock-o' style='font-size: 70px;color:#adadad !important;'></i>";
// 	$content .= "	<div class='clear'></div>";
// 	$content .= "	<span style='font-size:20px;margin-top:10px;display:block;'>" . __("Coming Soon!", "bravowp-helpdesk") . "</span>";
// 	$content .= "	<div class='clear'></div>";
// 	$content .= "	<span style='color:#adadad !important;margin-top:10px;display:block;'>" . __("This feature will be soon ready. Please check www.bravowp.com for more information.", "bravowp-helpdesk") . "</span>";
// 	$content .= "	<div class='clear'></div>";
// 	$content .= "</div>";
//
// 	return $content;
//
// 	bwhd_systemlog_addentry("FUNCTION","bwhd_placeholders_comingsoonpanel","End");
//
// }


//Used to display the "feature available as add-on"
function bwhd_placeholders_addonavailable()
{

	bwhd_systemlog_addentry("FUNCTION","bwhd_placeholders_addonavailable","Start");

	$content = "";

	$content .= "<div class='text-center'>";
	$content .= "	<i class='fa fa-download' style='font-size: 50px;color:#adadad !important;'></i>";
	$content .= "	<div class='clear'></div>";
	$content .= "	<span style='font-size:20px;margin-top:10px;display:block;'>" . __("Go Professional!", "bravowp-helpdesk") . "</span>";
	$content .= "	<div class='clear'></div>";
	$content .= "	<span style='color:#adadad !important;margin-top:10px;display:block;'>" . __("This feature is available with the Professional Edition. Please visit www.bravowp.com for more information.", "bravowp-helpdesk") . "</span>";
	$content .= "	<a class='btn btn-success' style='margin-top:15px;' href='http://www.bravowp.com/downloads/wordpress-helpdesk-plugin/' target='new'><i class='fa fa-arrow-circle-o-right'></i>Get Professional Edition!</a>";
	$content .= "	<div class='clear'></div>";
	$content .= "</div>";

	return $content;

	bwhd_systemlog_addentry("FUNCTION","bwhd_placeholders_addonavailable","End");

}

//Used in admin dashboard chart to render the "no data" panel
function bwhd_placeholders_dashboardchartnodata()
{

	bwhd_systemlog_addentry("FUNCTION","bwhd_placeholders_dashboardchartnodata","Start");

	$content = "";

	$content .= "<div class='text-center'>";
	$content .= "	<i class='fa fa-clock-o' style='font-size: 30px;color:#adadad !important;'></i>";
	$content .= "	<div class='clear'></div>";
	$content .= "	<span style='font-size:14px;margin-top:10px;display:block;'>" . __("No data to show at this time.", "bravowp-helpdesk") . "</span>";
	$content .= "	<div class='clear'></div>";
	$content .= "</div>";

	return $content;

	bwhd_systemlog_addentry("FUNCTION","bwhd_placeholders_dashboardchartnodata","End");

}


//Used in admin dashboard last 5 tickets to render the "no data" panel
function bwhd_placeholders_dashboardlastfiveticketsnodata()
{

	bwhd_systemlog_addentry("FUNCTION","bwhd_placeholders_dashboardlastfiveticketsnodata","Start");

	$content = "";

	$content .= "<div class='text-center'>";
	$content .= "	<i class='fa fa-clock-o' style='font-size: 30px;color:#adadad !important;'></i>";
	$content .= "	<div class='clear'></div>";
	$content .= "	<span style='font-size:14px;margin-top:10px;display:block;'>" . __("No data to show at this time.", "bravowp-helpdesk") . "</span>";
	$content .= "	<div class='clear'></div>";
	$content .= "</div>";

	return $content;

	bwhd_systemlog_addentry("FUNCTION","bwhd_placeholders_dashboardlastfiveticketsnodata","End");

}





?>
