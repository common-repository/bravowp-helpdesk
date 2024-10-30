//global bag for varaibles
var bwhd_globalbag = {};
bwhd_globalbag.zone_main = 'ticketslist';
bwhd_globalbag.ticket_currentid = '0';
bwhd_globalbag.zone_ticket = 'events';
bwhd_globalbag.zone_settings = 'general';
bwhd_globalbag.zone_settings_notificationeditkey = '';
bwhd_globalbag.zone_settings_tabletoedit = '';
bwhd_globalbag.zone_settings_tableiditem = 0;
bwhd_globalbag.zone_installwizard = 'start';


//Document load
jQuery(document).ready(function(){

	bwhd_admin_menu_click( bwhd_globalbag.zone_main );

	jQuery("#bwhd-admin-contentpane-control-ticketnew-optcustomerexisting").change(function () {
		bwhd_admin_ticketsview_switchcustomermode();
	});

	jQuery("#bwhd-admin-contentpane-control-ticketnew-optcustomernew").change(function () {
		bwhd_admin_ticketsview_switchcustomermode();
	});



});



//Called on menu click
function bwhd_admin_menu_click( menuKey )
{

	//sets the current zone
	bwhd_globalbag.zone_main = menuKey;

	//remove the "active" status from the menu items
	jQuery(".bwhd-admin-menupane li").removeClass("bwhd-admin-leftpane-menu-active-li");

	//shows the right control
	bwhd_admin_display_control_zone();

	if ( currentZone == "ticketslist")
	{
		jQuery("#bwhd-admin-leftpane-menu-supporttickets").addClass("bwhd-admin-leftpane-menu-active-li");
		bwhd_admin_ticketslist_loadcounters();
		bwhd_admin_ticketslist_loadopenedvsclosedchart();
		bwhd_admin_ticketslist_load();
	}
	if ( currentZone == "settings")
	{
		jQuery("#bwhd-admin-leftpane-menu-settings").addClass("bwhd-admin-leftpane-menu-active-li");
	}

}



//Shows the right control according to the current zone
function bwhd_admin_display_control_zone()
{

	//get the current zone
	currentZone = bwhd_globalbag.zone_main;

	//hides all controls
	bwhd_admin_hide_allcontrols();

	//shows the right controlo according to the current zone
	if ( currentZone == "dashboard")
	{
		jQuery("#bwhd-admin-contentpane-control-dashboard").show();
	}
	if ( currentZone == "ticketslist")
	{
		jQuery("#bwhd-admin-contentpane-control-ticketslist").show();
	}
	if ( currentZone == "ticketview")
	{
		jQuery("#bwhd-admin-contentpane-control-ticketview").show();
	}
	if ( currentZone == "ticketnew")
	{
		bwhd_admin_ticketsnew_clearcontent();
		jQuery("#bwhd-admin-contentpane-control-ticketnew").show();
	}
	if ( currentZone == "settings")
	{
		jQuery("#bwhd-admin-contentpane-control-settings").show();
	}
	if ( currentZone == "about")
	{
		jQuery("#bwhd-admin-contentpane-control-about").show();
	}
	if ( currentZone == "help")
	{
		jQuery("#bwhd-admin-contentpane-control-help").show();
	}

}


//hides all controls in the content pane, called before showing the current control
function bwhd_admin_hide_allcontrols()
{

	jQuery("#bwhd-admin-contentpane-control-dashboard").hide();
	jQuery("#bwhd-admin-contentpane-control-ticketslist").hide();
	jQuery("#bwhd-admin-contentpane-control-ticketview").hide();
	jQuery("#bwhd-admin-contentpane-control-ticketnew").hide();
	jQuery("#bwhd-admin-contentpane-control-settings").hide();
	jQuery("#bwhd-admin-contentpane-control-about").hide();
	jQuery("#bwhd-admin-contentpane-control-help").hide();

}


//goes back to tickets list from the ticket new page
function bwhd_admin_ticketsnew_goback()
{
	bwhd_admin_menu_click("ticketslist");
}

//goes back to tickets list from the ticket view page
function bwhd_admin_ticketsview_goback()
{
	bwhd_admin_menu_click("ticketslist");
}

//loads the tickets list in the tickets list section
function bwhd_admin_ticketslist_load()
{

	jQuery("#bwhd-admin-dashboard-loader").show();

	jQuery.ajax
	(
		{
			url : bwhdVars.ajaxHandlerUrl,
			type : 'post',
			dataType: 'json',
			data :
			{
				action : 'admin_tickets_list',
				security : bwhdVars.ajaxNonce,
				ticketstatus: jQuery("#bwhd_admin_rightpane_ticketslist_filterscontainer_dd_status").val(),
				ticketcategory: jQuery("#bwhd_admin_rightpane_ticketslist_filterscontainer_dd_category").val(),
				ticketagent: jQuery("#bwhd_admin_rightpane_ticketslist_filterscontainer_dd_agent").val()
			},
			success : function( response )
			{

				jQuery('#bwhd_admin_rightpane_ticketslist_table').DataTable(
					{
						"bDestroy": true,
						data: response,
						"bLengthChange": false,
						"iDisplayLength": 6,
						columns:
						[

							{ "width": "5%", className: "text-center", title: "N", data: "ticket_id", render: function ( data, type, full, meta ) { return "<div class='bwhd-admin-ticketslist-number'>" + data + "</div>"; } },
							{ "width": "50%", title: "Ticket & Customer", data: "ticket_title", render: function ( data, type, full, meta ) { return "<div class='bwhd-admin-ticketslist-avatar'>" + full.customer_avatar + "</div>  <div> <div>" + full.ticket_title + "</div> <div> <div class='bwhd-admin-ticketslist-customerlabel'>by " + full.customer_name + " on " + full.ticket_created_date + ", via " + full.ticket_creation_mode + "</div>  </div>"; } },
							{ "width": "40%", title: "Details", data: "category_name", render: function ( data, type, full, meta ) { return "<div class='row bwhd-admin-ticketslist-detailspane'>  <div class='col-md-2'>Status:</div><div class='col-md-10'> <div class='" + full.status_label + "'>" + full.status_description + "</div> </div>   <div class='col-md-2'>Cat.:</div><div class='col-md-10'> " + full.category_name + "&nbsp;</div>     <div class='col-md-2'>Agent:</div><div class='col-md-10'> " + full.ticket_assigned_userid_text + "</div>    </div>" ; } },
							{ "width": "2%", title: "Edit", className: "text-center", "orderable": false, data: "ticket_id", render: function ( data, type, full, meta ) { return "<div class='btn btn-success bwhd-admin-ticketslist-buttonedit' onclick='bwhd_admin_ticketslist_editticketclick(" + data + ");'><span style='margin-right:0px;' class='fa fa-pencil'></span></div>"; } }
						],
						"order": [[ 0, "desc" ]]
					}
				);

				//moving the search filter into the filter bar
				jQuery("#bwhd_admin_rightpane_ticketslist_filterscontainer_placeholder_tx_search").html('');
				jQuery("#bwhd_admin_rightpane_ticketslist_table_filter input").appendTo( jQuery("#bwhd_admin_rightpane_ticketslist_filterscontainer_placeholder_tx_search") );
				jQuery("#bwhd_admin_rightpane_ticketslist_table_filter input").appendTo( jQuery("#bwhd_admin_rightpane_ticketslist_filterscontainer_placeholder_tx_search") );
				jQuery("#bwhd_admin_rightpane_ticketslist_filterscontainer_placeholder_tx_search input").addClass("bwhd-admin-common-input");
				jQuery("#bwhd_admin_rightpane_ticketslist_table_filter").html('');

				jQuery("#bwhd-admin-dashboard-loader").hide();

			}
		}
	);


}




//Called on click of the edit icon in the table of tickets
function bwhd_admin_ticketslist_editticketclick( ticket_id)
{

	//setting the variable on the ticket id that was clicked
	bwhd_globalbag.ticket_currentid = ticket_id;

	//change current zone
	bwhd_globalbag.zone_main = "ticketview";
	bwhd_admin_display_control_zone();

	//settint title of this section
	jQuery("#bwhd_admin_rightpane_page_header_title_number").text(" #" + ticket_id );
	jQuery("#bwhd_admin_rightpane_page_header_title_span").text("Ticket Details");

	//sets the first tab (events) as active
	bwhd_admin_ticketsview_submenuclick("events");

	//load details data
	bwhd_admin_ticketsview_loadsingleticket();

}


//Click on the New Ticket button on the Tickets List page
function bwhd_admin_ticketslist_newticketclick()
{

	//setting the variable on the ticket id that was clicked
	bwhd_globalbag.ticket_currentid = "0";

	//change current zone
	bwhd_globalbag.zone_main = "ticketnew";
	bwhd_admin_display_control_zone();

	//sets the first tab (details) as active
	bwhd_admin_ticketsview_submenuclick("details");

}


//Quick tickets searches clicks
//searchtype can have these values: "assigned_to_me", "unresponded", "closed_by_me"
function bwhd_admin_ticketslist_quicksearchesclick( searchtype )
{

	//sets the filters according to the search type
	if (searchtype=='assigned_to_me')
	{
		jQuery("#bwhd_admin_rightpane_ticketslist_filterscontainer_placeholder_tx_search input").val('');
		jQuery("#bwhd_admin_rightpane_ticketslist_filterscontainer_dd_status").val('-1');	//active
		jQuery("#bwhd_admin_rightpane_ticketslist_filterscontainer_dd_category").val('0');	//reset
		jQuery("#bwhd_admin_rightpane_ticketslist_filterscontainer_dd_agent").val( bwhdVars.wpuserid );	//myself
	}

	if (searchtype=='unresponded')
	{
		jQuery("#bwhd_admin_rightpane_ticketslist_filterscontainer_placeholder_tx_search input").val('');
		jQuery("#bwhd_admin_rightpane_ticketslist_filterscontainer_dd_status").val('-2');	//unresponded
		jQuery("#bwhd_admin_rightpane_ticketslist_filterscontainer_dd_category").val('0');	//reset
		jQuery("#bwhd_admin_rightpane_ticketslist_filterscontainer_dd_agent").val('0');	//reset
	}

	if (searchtype=='closed_by_me')
	{
		jQuery("#bwhd_admin_rightpane_ticketslist_filterscontainer_placeholder_tx_search input").val('');
		jQuery("#bwhd_admin_rightpane_ticketslist_filterscontainer_dd_status").val('3');	//closed
		jQuery("#bwhd_admin_rightpane_ticketslist_filterscontainer_dd_category").val('0');	//reset
		jQuery("#bwhd_admin_rightpane_ticketslist_filterscontainer_dd_agent").val( bwhdVars.wpuserid );	//myself
	}

	//reloades the tickets list
	bwhd_admin_ticketslist_load();

}


//Called on ticket view page submenu click
function bwhd_admin_ticketsview_submenuclick( subMenuKey )
{

	//sets the current ticket zone
	bwhd_globalbag.zone_ticket = subMenuKey;

	//removes the selection class from all tabs of submenu
	jQuery("#bwhd-admin-contentpane-horizontalsubmenu-ticketview .menu li").removeClass("bwhd-admin-contentpane-horizontalsubmenu-selecteditem");

	//hides all panels of tickets view page content
	jQuery("#bwhd-admin-contentpane-control-ticketview-events").hide();
	jQuery("#bwhd-admin-contentpane-control-ticketview-attachments").hide();
	jQuery("#bwhd-admin-contentpane-control-ticketview-tasks").hide();

	//sets the selected menu
	if ( subMenuKey == "events" )
	{
		jQuery("#bwhd-admin-contentpane-horizontalsubmenu-li-events").addClass("bwhd-admin-contentpane-horizontalsubmenu-selecteditem");
		jQuery("#bwhd-admin-contentpane-control-ticketview-events").show();
		bwhd_admin_ticketsview_listmessages();
	}
	if ( subMenuKey == "attachments" )
	{
		jQuery("#bwhd-admin-contentpane-horizontalsubmenu-li-attachments").addClass("bwhd-admin-contentpane-horizontalsubmenu-selecteditem");
		jQuery("#bwhd-admin-contentpane-control-ticketview-attachments").show();
		if ( bwhdVars.pluginProActive == "1")
		{
			bwhd_admin_ticketsview_attachments_loadlist();
		}
	}
	if ( subMenuKey == "tasks" )
	{
		jQuery("#bwhd-admin-contentpane-horizontalsubmenu-li-tasks").addClass("bwhd-admin-contentpane-horizontalsubmenu-selecteditem");
		jQuery("#bwhd-admin-contentpane-control-ticketview-tasks").show();
	}

}



//Loads an existing ticket detail in the details pages, taking the id from the current ticket variable
function bwhd_admin_ticketsview_loadsingleticket()
{

	jQuery("#bwhd-admin-dashboard-loader").show();
	jQuery("#bwhd-admin-contentpane-control-saveticket-validation").hide();
	jQuery("#bwhd-admin-contentpane-control-saveticket-success").hide();
	jQuery("#bwhd-admin-contentpane-control-createticket-confirm").hide();


	//reading current ticket variable
	currentTicketId = bwhd_globalbag.ticket_currentid;

	//setting the ticket id in the hidden form value of the upload file form
	//it will not throw an error in case of the add on is not installed
	jQuery("#bwhd-admin-contentpane-control-ticketview-attachments-hiddenuploadticketid").val(currentTicketId);

	jQuery.ajax
	(
		{
			url : bwhdVars.ajaxHandlerUrl,
			type : 'post',
			dataType: 'json',
			data :
			{
				action : 'admin_tickets_get',
				security : bwhdVars.ajaxNonce,
				ticket_id : currentTicketId
			},
			success : function( response )
			{

				//binding data
				jQuery("#bwhd-admin-contentpane-control-ticketview-details-spantitle").html( response.ticket_title );
				jQuery("#bwhd-admin-contentpane-control-ticketview-details-spandescription").html( response.ticket_problem );
				jQuery("#bwhd-admin-contentpane-control-ticketview-details-ddlstatus").val( response.status_id );
				jQuery("#bwhd-admin-contentpane-control-ticketview-details-ddlcategory").val( response.category_id );
				jQuery("#bwhd-admin-contentpane-control-ticketview-details-ddlpriority").val( response.priority_id );
				jQuery("#bwhd-admin-contentpane-control-ticketview-details-ddlproduct").val( response.woocommerce_product_id );
				jQuery('.selectpicker').selectpicker('render');
				jQuery("#bwhd-admin-contentpane-control-ticketview-details-lblcustomername").text( response.customer_name );
				jQuery("#bwhd-admin-contentpane-control-ticketview-details-lblcustomeremail").text( response.customer_email );
				jQuery("#bwhd-admin-contentpane-control-ticketview-details-divcustomeravatar").html( response.customer_avatar );

				jQuery("#bwhd-admin-dashboard-loader").hide();

			}
		}
	);

}




//Save a ticket details page to the database (update only)
function bwhd_admin_ticketsview_savesingleticket()
{

	jQuery("#bwhd-admin-dashboard-loader").show();

	//reading current ticket variable
	currentTicketId = bwhd_globalbag.ticket_currentid;

	//reading controls values
	value_status_id = jQuery("#bwhd-admin-contentpane-control-ticketview-details-ddlstatus").val();
	value_category_id = jQuery("#bwhd-admin-contentpane-control-ticketview-details-ddlcategory").val();
	value_priority_id = jQuery("#bwhd-admin-contentpane-control-ticketview-details-ddlpriority").val();
	value_woocommerce_product_id = jQuery("#bwhd-admin-contentpane-control-ticketview-details-ddlproduct").val();

	jQuery.ajax
	(
		{
			url : bwhdVars.ajaxHandlerUrl,
			type : 'post',
			dataType: 'json',
			data :
			{
				action : 'admin_tickets_save',
				security : bwhdVars.ajaxNonce,
				ticket_id : currentTicketId,
				status_id : value_status_id,
				category_id : value_category_id,
				priority_id : value_priority_id,
				woocommerce_productid : value_woocommerce_product_id
			},
			success : function( response )
			{

				jQuery("#bwhd-admin-contentpane-control-saveticket-validation").hide();

				jQuery("#bwhd-admin-contentpane-control-saveticket-success").show();
				jQuery("#bwhd-admin-dashboard-loader").hide();

			}
		}
	);

}


//putting defaults to the add new ticket form
function bwhd_admin_ticketsnew_clearcontent()
{

	jQuery("#bwhd-admin-contentpane-control-ticketnew-optcustomerexisting").attr("checked", "");
	jQuery('#bwhd-admin-contentpane-control-ticketnew-customername').hide();
	jQuery('#bwhd-admin-contentpane-control-ticketnew-customeremail').hide();
	jQuery('#bwhd-admin-contentpane-control-ticketnew-customerexisting').show();
	jQuery("#bwhd-admin-contentpane-control-ticketnew-ddlexistingcustomer").val(0);
	jQuery('#bwhd-admin-contentpane-control-ticketnew-txtcustomername').val('');
	jQuery('#bwhd-admin-contentpane-control-ticketnew-txtcustomeremail').val('');
	jQuery('#bwhd-admin-contentpane-control-ticketnew-txttitle').val('');
	jQuery('#bwhd-admin-contentpane-control-ticketnew-txtdescription').val('');
	jQuery('#bwhd-admin-contentpane-control-ticketnew-ddlcategory').val(0);
	jQuery('#bwhd-admin-contentpane-control-ticketnew-ddlpriority').val(0);
	jQuery("#bwhd-admin-contentpane-control-ticketnew-validation").hide();
	jQuery("#bwhd-admin-contentpane-control-ticketnew-ddlproduct").val(0);

}


//Save a ticket details page to the database (ticket NEW page)
function bwhd_admin_ticketsnew_insertticket()
{

	jQuery("#bwhd-admin-dashboard-loader").show();

	//reading controls values
	if ( jQuery("#bwhd-admin-contentpane-control-ticketnew-optcustomerexisting").is(":checked") )
	{
		value_customer_type = "existing";
	}
	else
	{
		value_customer_type = "new";
	}

	value_customer_existing_id = jQuery("#bwhd-admin-contentpane-control-ticketnew-ddlexistingcustomer").val();
	value_customer_new_name = jQuery("#bwhd-admin-contentpane-control-ticketnew-txtcustomername").val();
	value_customer_new_email = jQuery("#bwhd-admin-contentpane-control-ticketnew-txtcustomeremail").val();

	value_ticket_title = jQuery("#bwhd-admin-contentpane-control-ticketnew-txttitle").val();
	value_ticket_problem = jQuery("#bwhd-admin-contentpane-control-ticketnew-txtdescription").val();
	value_category_id = jQuery("#bwhd-admin-contentpane-control-ticketnew-ddlcategory").val();
	value_priority_id = jQuery("#bwhd-admin-contentpane-control-ticketnew-ddlpriority").val();
	value_woocommerce_product_id = jQuery("#bwhd-admin-contentpane-control-ticketnew-ddlproduct").val();

	jQuery.ajax
	(
		{
			url : bwhdVars.ajaxHandlerUrl,
			type : 'post',
			dataType: 'json',
			data :
			{
				action : 'admin_tickets_insert',
				security : bwhdVars.ajaxNonce,
				customer_type : value_customer_type,
				customer_existing_id : value_customer_existing_id,
				customer_new_name : value_customer_new_name,
				customer_new_email : value_customer_new_email,
				ticket_title : value_ticket_title,
				ticket_problem : value_ticket_problem,
				category_id : value_category_id,
				priority_id : value_priority_id,
				woocommerce_productid : value_woocommerce_product_id
			},
			success : function( response )
			{

				jQuery("#bwhd-admin-contentpane-control-ticketnew-validation").hide();
				jQuery("#bwhd-admin-contentpane-control-ticketnew-txtcustomername").removeClass("bwhd-admin-errorinputborder");
				jQuery("#bwhd-admin-contentpane-control-ticketnew-txtcustomeremail").removeClass("bwhd-admin-errorinputborder");
				jQuery("#bwhd-admin-contentpane-control-ticketnew-txttitle").removeClass("bwhd-admin-errorinputborder");
				jQuery("#bwhd-admin-contentpane-control-ticketnew-txtdescription").removeClass("bwhd-admin-errorinputborder");

				//checking validation
				if (response.success == 0)
				{

					jQuery("#bwhd-admin-contentpane-control-ticketnew-validation").show();
					jQuery("#bwhd-admin-contentpane-control-ticketnew-validation span").html( response.error_message );
					jQuery("#" + response.error_field_key).addClass("bwhd-admin-errorinputborder");
					jQuery("#bwhd-admin-dashboard-loader").hide();
					return;

				}

				bwhd_admin_ticketsnew_clearcontent();

				bwhd_admin_ticketslist_editticketclick( response.extra_data_1 );
				jQuery("#bwhd-admin-contentpane-control-createticket-confirm").show();

				jQuery("#bwhd-admin-dashboard-loader").hide();

			}
		}
	);

}




//Save a new message for this ticket
function bwhd_admin_ticketsview_addmessage()
{

	jQuery("#bwhd-admin-dashboard-loader").show();
	jQuery("#bwhd-admin-contentpane-control-newmessage-validation").hide();

	//reading current ticket variable
	currentTicketId = bwhd_globalbag.ticket_currentid;

	//reading controls values
	value_message_text = jQuery("#bwhd-admin-contentpane-control-ticketview-messages-txtmessage").val();
	value_is_private = false;
	value_is_sendemail = false;

	jQuery.ajax
	(
		{
			url : bwhdVars.ajaxHandlerUrl,
			type : 'post',
			dataType: 'json',
			data :
			{
				action : 'admin_tickets_messages_add',
				security : bwhdVars.ajaxNonce,
				ticket_id : currentTicketId,
				message_text : value_message_text,
				author_type : 'agent',
				is_private : value_is_private,
				is_sendemail : value_is_sendemail
			},
			success : function( response )
			{

				jQuery("#bwhd-admin-contentpane-control-ticketview-messages-txtmessage").removeClass("bwhd-admin-errorinputborder");

				//checking validation
				if (response.success == 0)
				{

					jQuery("#bwhd-admin-contentpane-control-newmessage-validation").show();
					jQuery("#bwhd-admin-contentpane-control-newmessage-validation span").html( response.error_message );
					jQuery("#" + response.error_field_key).addClass("bwhd-admin-errorinputborder");
					jQuery("#bwhd-admin-dashboard-loader").hide();
					return;

				}

				jQuery("#bwhd-admin-contentpane-control-ticketview-messages-txtmessage").val('');
				bwhd_admin_ticketsview_listmessages();

				jQuery("#bwhd-admin-dashboard-loader").hide();

			}
		}
	);

}





//List the messages for a ticket
function bwhd_admin_ticketsview_listmessages()
{

	jQuery("#bwhd-admin-dashboard-loader").show();
	jQuery("#bwhd-admin-contentpane-control-ticketview-messages-txtmessage").removeClass("bwhd-admin-errorinputborder");
	jQuery("#bwhd-admin-contentpane-control-newmessage-validation").hide();

	//reading current ticket variable
	currentTicketId = bwhd_globalbag.ticket_currentid;

	jQuery.ajax
	(
		{
			url : bwhdVars.ajaxHandlerUrl,
			type : 'post',
			dataType: 'json',
			data :
			{
				action : 'admin_tickets_messages_list',
				security : bwhdVars.ajaxNonce,
				ticket_id : currentTicketId
			},
			success : function( response )
			{


				if ( response.length > 0 )
				{

					jQuery("#bwhd-admin-contentpane-ticketmessages-listnodata").hide();

					var htmlContent = "";

					jQuery.each(response, function(index) {

						htmlContent += "<div class='bwhd-admin-contentpane-ticketmessages-message'>"

						if ( response[index].is_my_message == true )
						{

							htmlContent += "<div class='col-md-2'></div>";
							htmlContent += "<div class='col-md-9 no-gutter text-right'>";
							htmlContent += "<span class='bwhd-admin-contentpane-ticketmessages-message-text '><span class='bwhd-admin-contentpane-ticketmessages-message-date'><span style='font-size:12px;'><strong>" + response[index].author_userid_text + "</strong></span> on " + response[index].message_date + "</span>" + response[index].message_text + "</span>";
							htmlContent += "</div>";
							htmlContent += "<div class='col-md-1 no-gutter-right' style='margin-top:5px;text-align:right;'>";
							htmlContent += response[index].author_avatar;
							htmlContent += "</div>";

						}
						else
						{

							htmlContent += "<div class='col-md-1 no-gutter' style='margin-top:5px;'>";
							htmlContent += response[index].author_avatar;
							htmlContent += "</div>";
							htmlContent += "<div class='col-md-9 no-gutter-left'>";
							htmlContent += "<span class='bwhd-admin-contentpane-ticketmessages-message-text bwhd-admin-contentpane-ticketmessages-message-text-blue'><span class='bwhd-admin-contentpane-ticketmessages-message-date'><span style='font-size:12px;'><strong>" + response[index].author_userid_text + "</strong></span> on " + response[index].message_date + "</span>" + response[index].message_text + "</span>";
							htmlContent += "</div>";
							htmlContent += "<div class='col-md-2'></div>";

						}

						htmlContent += "</div>";

						htmlContent += "<div class='clear' style='height:20px;'></div>";

					});

					jQuery("#bwhd-admin-contentpane-ticketmessages-list").html( htmlContent );


				}
				else
				{

					jQuery("#bwhd-admin-contentpane-ticketmessages-list").html( '' );
					jQuery("#bwhd-admin-contentpane-ticketmessages-listnodata").show();

				}

				jQuery("#bwhd-admin-dashboard-loader").hide();

			}
		}
	);

}



//Switch between customers modes in dashboard creation ticket
function bwhd_admin_ticketsview_switchcustomermode()
{

	if ( jQuery("#bwhd-admin-contentpane-control-ticketnew-optcustomerexisting").attr("checked") )
	{

		jQuery('#bwhd-admin-contentpane-control-ticketnew-customername').hide();
		jQuery('#bwhd-admin-contentpane-control-ticketnew-customeremail').hide();
		jQuery('#bwhd-admin-contentpane-control-ticketnew-customerexisting').show();

	}
	else
	{

		jQuery('#bwhd-admin-contentpane-control-ticketnew-customername').show();
		jQuery('#bwhd-admin-contentpane-control-ticketnew-customeremail').show();
		jQuery('#bwhd-admin-contentpane-control-ticketnew-customerexisting').hide();

	}


}





//Handles the clicks menu from settings sub menu
function bwhd_admin_settings_menuclick( menuKey )
{

	//sets the current zone
	bwhd_globalbag.zone_settings = menuKey;

	//remove the "active" status from the menu items
	jQuery("#bwhd-admin-contentpane-horizontalsubmenu-settings li").removeClass("bwhd-admin-contentpane-horizontalsubmenu-selecteditem");

	//hiding panels
	jQuery("#bwhd-admin-settingspanel-general").hide();
	jQuery("#bwhd-admin-settingspanel-tables").hide();
	jQuery("#bwhd-admin-settingspanel-notifications").hide();
	jQuery("#bwhd-admin-settingspanel-attachments").hide();
	jQuery("#bwhd-admin-settingspanel-system").hide();
	jQuery("#bwhd-admin-settingspanel-about").hide();
	jQuery("#bwhd-admin-settingspanel-emailtoticket").hide();

	//executes the default action after button click, if any
	if ( menuKey == "general")
	{
		jQuery("#bwhd-admin-contentpane-horizontalsubmenu-settings-li-details").addClass("bwhd-admin-contentpane-horizontalsubmenu-selecteditem");
		jQuery("#bwhd-admin-settingspanel-general").show();
	}
	if ( menuKey == "tables")
	{

		jQuery("#bwhd-admin-contentpane-horizontalsubmenu-settings-li-tables").addClass("bwhd-admin-contentpane-horizontalsubmenu-selecteditem");
		jQuery("#bwhd-admin-settingspanel-tables").show();
		bwhd_admin_settings_tables_tableclick('categories');

	}
	if ( menuKey == "notifications")
	{

		jQuery("#bwhd-admin-contentpane-horizontalsubmenu-settings-li-notifications").addClass("bwhd-admin-contentpane-horizontalsubmenu-selecteditem");
		jQuery("#bwhd-admin-settingspanel-notifications").show();
		if ( bwhdVars.pluginProActive == "1")
		{
			bwhd_notifications_settings_list_load();
		}

	}
	if ( menuKey == "attachments")
	{

		jQuery("#bwhd-admin-contentpane-horizontalsubmenu-settings-li-attachments").addClass("bwhd-admin-contentpane-horizontalsubmenu-selecteditem");
		jQuery("#bwhd-admin-settingspanel-attachments").show();

	}
	if ( menuKey == "system")
	{

		jQuery("#bwhd-admin-contentpane-horizontalsubmenu-settings-li-system").addClass("bwhd-admin-contentpane-horizontalsubmenu-selecteditem");
		jQuery("#bwhd-admin-settingspanel-system").show();

	}
	if ( menuKey == "emailtoticket")
	{

		jQuery("#bwhd-admin-contentpane-horizontalsubmenu-settings-li-emailtoticket").addClass("bwhd-admin-contentpane-horizontalsubmenu-selecteditem");
		jQuery("#bwhd-admin-settingspanel-emailtoticket").show();

	}
	if ( menuKey == "about")
	{

		jQuery("#bwhd-admin-contentpane-horizontalsubmenu-settings-li-about").addClass("bwhd-admin-contentpane-horizontalsubmenu-selecteditem");
		jQuery("#bwhd-admin-settingspanel-about").show();

	}

}

//Save a new message for this ticket
function bwhd_admin_settings_save()
{

	jQuery("#bwhd-admin-dashboard-loader").show();

	value_allowticketunregistered = jQuery("#bwhd-admin-contentpane-control-settings-allowticketunregistered").val();
	value_defaultscreenforunregistered = jQuery("#bwhd-admin-contentpane-control-settings-defaultscreenforunregistered").val();
	value_enablewoocommerceintegration = jQuery("#bwhd-admin-contentpane-control-settings-enablewoocommerceintegration").val();
	value_require_captcha = jQuery("#bwhd-admin-contentpane-control-settings-requirecaptcha").val();
	value_enablelog = jQuery("#bwhd-admin-contentpane-control-settings-enableeventslog").val();
	value_helpdeskemail = jQuery("#bwhd-admin-contentpane-control-settings-helpdeskemail").val();
	value_emailoncustomerticketcreation = jQuery("#bwhd-admin-contentpane-control-settings-emailoncustomerticketcreation").val();

	jQuery.ajax
	(
		{
			url : bwhdVars.ajaxHandlerUrl,
			type : 'post',
			dataType: 'json',
			data :
			{
				action : 'admin_settings_save',
				security : bwhdVars.ajaxNonce,
				allowticketunregistered : value_allowticketunregistered,
				defaultscreenforunregistered : value_defaultscreenforunregistered,
				require_captcha : value_require_captcha,
				enablelog : value_enablelog,
				helpdeskemail : value_helpdeskemail,
				emailoncustomerticketcreation : value_emailoncustomerticketcreation,
				enablewoocommerceintegration : value_enablewoocommerceintegration
			},
			success : function( response )
			{

				window.location.reload(false);
				jQuery("#bwhd-admin-dashboard-loader").hide();

			}
		}
	);

}



//occurs in the settings table page when a table name is clicked
function bwhd_admin_settings_tables_tableclick( tablekey )
{

	//saving in the global bag
	bwhd_globalbag.zone_settings_tabletoedit = tablekey;

	//remove the selected attribute to all tables Types
	jQuery("#bwhd_admin_settings_tables_type_categories").removeClass("bwhd-admin-settings-tables-typeselected");

	if (tablekey=="categories")
	{
		jQuery("#bwhd_admin_settings_tables_type_categories").addClass("bwhd-admin-settings-tables-typeselected");
	}

	//loading the items list
	bwhd_admin_settings_tables_loaditems();


}

//loads the list of items for the table selected
function bwhd_admin_settings_tables_loaditems( )
{

	//reading from global bag
	tablekey = bwhd_globalbag.zone_settings_tabletoedit;

	jQuery("#bwhd-admin-dashboard-loader").show();

	jQuery.ajax
	(
		{
			url : bwhdVars.ajaxHandlerUrl,
			type : 'post',
			dataType: 'json',
			data :
			{
				action : 'admin_settings_tables_list',
				security : bwhdVars.ajaxNonce,
				tablekey : tablekey
			},
			success : function( response )
			{

				if (tablekey == 'categories')
				{

					jQuery("#bwhd-admin-settingspanel-tables-listitemscontainer").show();
					jQuery("#bwhd-admin-settingspanel-tables-startmessage").hide();
					jQuery('#bwhd-admin-settingspanel-tables-listitemstable').DataTable(
						{
							"bDestroy": true,
							"paging":   false,
							"ordering": false,
							"info":     false,
							"filter":     false,
							data: response.extra_data_1,
							columns:
							[
								{ width: "96%", title: "Category Name", data: "category_name" },
								{ width: "2%", className: "text-center", "orderable": false, data: "category_id", render: function ( data, type, full, meta ) { return "<span class='fa fa-pencil bwhd-admin-contentpane-datatable-editicon' onclick='bwhd_admin_settings_tables_openmodal(" + data + ");'></span>"; } },
								{ width: "2%", className: "text-center", "orderable": false, data: "category_id", render: function ( data, type, full, meta ) { return "<span class='fa fa-trash-o bwhd-admin-contentpane-datatable-editicon' onclick='bwhd_admin_settings_tables_delete(" + data + ");'></span>"; } }


							]

						}
					);
					var table = jQuery('#bwhd-admin-settingspanel-tables-listitemstable').DataTable();
					table.draw();


				}

				jQuery("#bwhd-admin-dashboard-loader").hide();

			}
		}
	);

}

//opens the modal window to add or edit a table item
function bwhd_admin_settings_tables_openmodal( tableitemid )
{

	jQuery("#bwhd-admin-dashboard-loader").show();

	//saves the selected tableitemid to edit, or 0 in case we add
	bwhd_globalbag.zone_settings_tableiditem = tableitemid;

	//clear input controls
	jQuery("#bwhd-admin-settings-table-modalcategory-tx-name").val('');

	if (tableitemid > 0)
	{
		jQuery.ajax
		(
			{
				url : bwhdVars.ajaxHandlerUrl,
				type : 'post',
				dataType: 'json',
				data :
				{
					action : 'admin_settings_tables_get',
					security : bwhdVars.ajaxNonce,
					tablekey : bwhd_globalbag.zone_settings_tabletoedit,
					tableitemid: bwhd_globalbag.zone_settings_tableiditem
				},
				success : function( response )
				{

					if (tablekey == 'categories')
					{

						jQuery("#bwhd-admin-settings-table-modalcategory-tx-name").val(response.extra_data_1.category_name);

						jQuery("#bwhd-admin-settings-table-modalcategory").modal();

					}

					jQuery("#bwhd-admin-dashboard-loader").hide();

				}
			}
		);
	}
	else
	{
		//insert mode modal
		jQuery("#bwhd-admin-settings-table-modalcategory").modal();
		jQuery("#bwhd-admin-dashboard-loader").hide();

	}



}


//save the modal content to table item
function bwhd_admin_settings_tables_savemodal()
{

	jQuery("#bwhd-admin-dashboard-loader").show();

	var fieldvaluestosend = {};

	if (tablekey == 'categories')
	{

		fieldvaluestosend["category_name"] = jQuery("#bwhd-admin-settings-table-modalcategory-tx-name").val();

	}

	jQuery.ajax
	(
		{
			url : bwhdVars.ajaxHandlerUrl,
			type : 'post',
			dataType: 'json',
			data :
			{
				action : 'admin_settings_tables_save',
				security : bwhdVars.ajaxNonce,
				tablekey : bwhd_globalbag.zone_settings_tabletoedit,
				tableitemid: bwhd_globalbag.zone_settings_tableiditem,
				fieldvalues: JSON.stringify(fieldvaluestosend)
			},
			success : function( response )
			{

				jQuery("#bwhd-admin-settings-table-modalcategory").modal('hide');
				bwhd_admin_settings_tables_loaditems();
				jQuery("#bwhd-admin-dashboard-loader").hide();

			}
		}
	);

}


//delete a table item
function bwhd_admin_settings_tables_delete(tableitemid)
{

	var result = confirm("Do you really want to delete this table item?");
	if (result) {

		jQuery("#bwhd-admin-dashboard-loader").show();

		jQuery.ajax
		(
			{
				url : bwhdVars.ajaxHandlerUrl,
				type : 'post',
				dataType: 'json',
				data :
				{
					action : 'admin_settings_tables_delete',
					security : bwhdVars.ajaxNonce,
					tablekey : bwhd_globalbag.zone_settings_tabletoedit,
					tableitemid: tableitemid
				},
				success : function( response )
				{

					bwhd_admin_settings_tables_loaditems();
					jQuery("#bwhd-admin-dashboard-loader").hide();

				}
			}
		);
	}

}




function bwhd_admin_dashboard_newticketclick()
{

	//setting the variable on the ticket id that was clicked
	bwhd_globalbag.ticket_currentid = "0";

	//change current zone
	bwhd_admin_menu_click( "ticketslist" );
	bwhd_globalbag.zone_main = "ticketnew";
	bwhd_admin_display_control_zone();

	//sets the first tab (details) as active
	bwhd_admin_ticketsview_submenuclick("details");

}

function bwhd_admin_ticketslist_loadcounters()
{

	jQuery("#bwhd-admin-dashboard-loader").show();

	jQuery.ajax
	(
		{
			url : bwhdVars.ajaxHandlerUrl,
			type : 'post',
			dataType: 'json',
			data :
			{
				action : 'admin_tickets_getcounters',
				security : bwhdVars.ajaxNonce
			},
			success : function( response )
			{

				var datacounters = response.extra_data_1.split("-");

				jQuery("#bwhd-admin-ticketslist-counter-span-assignedtome").text(datacounters[0]);
				jQuery("#bwhd-admin-ticketslist-counter-span-unassigned").text(datacounters[1]);
				jQuery("#bwhd-admin-ticketslist-counter-span-closedbyme").text(datacounters[2]);

			}
		}
	);


}

function bwhd_admin_ticketslist_loadopenedvsclosedchart()
{

	if ( jQuery("#bwhd-admin-ticketslist-panel-chart").length > 0 )
	{

		jQuery("#bwhd-admin-dashboard-loader").show();

		jQuery.ajax
		(
			{
				url : bwhdVars.ajaxHandlerUrl,
				type : 'post',
				dataType: 'json',
				data :
				{
					action : 'admin_tickets_loadchartopenvsclosed',
					security : bwhdVars.ajaxNonce
				},
				success : function( response )
				{


					if ( response.extra_data_1 != "" )
					{


						var days = [];
						var opened = [];
						var closed = [];
						jQuery.each(response.extra_data_1, function(index)
						{

							if ( response.extra_data_1[index].opened > 0 || response.extra_data_1[index].closed > 0)
							{
								days.push( response.extra_data_1[index].date );
								opened.push( response.extra_data_1[index].opened );
								closed.push( response.extra_data_1[index].closed );
							}

						}
					);

					var data = {
						labels: days,
						series: [ opened, closed ]
					};
					new Chartist.Bar('#bwhd-admin-ticketslist-chart-openvsclosed', data, {axisX: {position: 'start'}, axisY: {position: 'end', onlyInteger: true} });

					jQuery("#bwhd-admin-ticketslist-chart-openvsclosed").show();
					jQuery("#bwhd-admin-ticketslist-chart-openvsclosed-nodata").hide();


				}
				else
				{

					jQuery("#bwhd-admin-ticketslist-chart-openvsclosed").hide();
					jQuery("#bwhd-admin-ticketslist-chart-openvsclosed-nodata").show();

				}



			}

		});

	}


}



function bwhd_admin_settings_loadeventslog()
{

	jQuery("#bwhd-admin-dashboard-loader").show();

	jQuery.ajax
	(
		{
			url : bwhdVars.ajaxHandlerUrl,
			type : 'post',
			dataType: 'json',
			data :
			{
				action : 'admin_systemlog_list',
				security : bwhdVars.ajaxNonce
			},
			success : function( response )
			{

				jQuery("#bwhd-admin-settingspanel-system-eventslogplaceholder").html('');
				jQuery("#bwhd-admin-settingspanel-system-eventslogplaceholder").append( "<table id='bwhd-admin-settingspanel-system-eventslog-table' class='display' cellspacing='0' width='100%'></table>" );

				logscolumnsArray = [];

				var ColumnDate = new Object();
				ColumnDate.render = function ( data, type, full, meta ) { return "<span style='white-space: nowrap;color:" + full.TextColor + "'>" + full.Date + "</span>"; };
				ColumnDate.title = "Date";
				ColumnDate.width = "120px";
				logscolumnsArray.push(ColumnDate);
				var ColumnMethod = new Object();
				ColumnMethod.render = function ( data, type, full, meta ) { return "<span style='color:" + full.TextColor + "'>" + full.Method + "</span>"; };
				ColumnMethod.title = "Method";
				logscolumnsArray.push(ColumnMethod);
				var ColumnEventText = new Object();
				ColumnEventText.render = function ( data, type, full, meta ) { return "<span style='color:" + full.TextColor + "'>" + full.EventText + "</span>"; };
				ColumnEventText.title = "Event Details";
				logscolumnsArray.push(ColumnEventText);

				//sets datatable
				jQuery('#bwhd-admin-settingspanel-system-eventslog-table').DataTable(
					{
						"bDestroy": true,
						data: response,
						columns: logscolumnsArray,
						"bLengthChange": false,
						"bSort" : false,
						"bPaginate": false,
						"bFilter": false,
						"bInfo": false,
					}
				);

				jQuery("#bwhd-admin-settingspanel-system-eventslogplaceholder").show();
				jQuery("#bwhd-admin-dashboard-loader").hide();

			}

		}
	);

}


function bwhd_admin_settings_cleareventslog()
{

	jQuery("#bwhd-admin-dashboard-loader").show();

	jQuery.ajax
	(
		{
			url : bwhdVars.ajaxHandlerUrl,
			type : 'post',
			dataType: 'json',
			data :
			{
				action : 'admin_systemlog_clear',
				security : bwhdVars.ajaxNonce
			},
			success : function( response )
			{
				bwhd_admin_settings_loadeventslog();
			}

		}
	);

}
