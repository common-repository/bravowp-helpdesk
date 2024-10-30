

//Document load
jQuery(document).ready(function(){

	//loads ticket for this user, at load of page
	bwhd_frontend_loadlisttickets();

	//loading default screen according to settings
	if (  bwhdVars.wpuserid == "0" && bwhdVars.defaultscreenforunregistered == "createticket")
	{
		jQuery("#bwhd_frontend_var_currentzone").text( "ticketnew" );
		bwhd_admin_display_control_zone();
	}

});


//Shows the right control according to the current zone
function bwhd_admin_display_control_zone()
{

	//get the current zone
	currentZone = jQuery("#bwhd_frontend_var_currentzone").text();

	//hides all controls
	bwhd_frontend_hide_allcontrols();

	//shows the right control according to the current zone
	if ( currentZone == "home")
	{
		jQuery("#bwhd-frontend-controls-home").fadeIn('slow');
	}
	if ( currentZone == "ticketnew")
	{
		bwhd_frontend_button_newticket_clear();
		jQuery("#bwhd-frontend-controls-ticketnew").fadeIn('slow');
	}
	if ( currentZone == "ticketedit")
	{
		jQuery("#bwhd-frontend-controls-ticketedit").fadeIn('slow');
	}
	if ( currentZone == "ticketslist")
	{
		jQuery("#bwhd-frontend-controls-ticketslist").fadeIn('slow');
	}
	if ( currentZone == "thanks")
	{
		jQuery("#bwhd-frontend-controls-ticketthanks").fadeIn('slow');
	}

}

//hides all controls in the content pane, called before showing the current control
function bwhd_frontend_hide_allcontrols()
{

	jQuery("#bwhd-frontend-controls-home").hide();
	jQuery("#bwhd-frontend-controls-ticketnew").hide();
	jQuery("#bwhd-frontend-controls-ticketedit").hide();
	jQuery("#bwhd-frontend-controls-ticketslist").hide();
	jQuery("#bwhd-frontend-controls-ticketthanks").hide();


}


//clear all the controls of the new ticket page
function bwhd_frontend_button_newticket_clear()
{

	jQuery("#bwhd-frontend-ticketnew-validation").hide();
	jQuery("#bwhd-frontend-controls-ticketnew-txtcustomername").val('');
	jQuery("#bwhd-frontend-controls-ticketnew-txtcustomeremail").val('');
	jQuery("#bwhd-frontend-controls-ticketnew-txttickettitle").val('');
	jQuery("#bwhd-frontend-controls-ticketnew-txtticketproblem").val('');
	jQuery("#bwhd-frontend-controls-ticketnew-ddlcategory").val('0');
	jQuery("#bwhd-frontend-controls-ticketnew-txtcaptcha").val('');


}


//load tickets list for this user
function bwhd_frontend_loadlisttickets()
{

	jQuery("#bwhd-frontend-controls-ticketlist-loader").show();

	jQuery.ajax
	(
		{
			url : bwhdVars.ajaxHandlerUrl,
			type : 'post',
			dataType: 'json',
			data :
				{
					action : 'ajax_frontend_tickets_list',
					security : bwhdVars.ajaxNonce
				},
			success : function( response )
			{

					if ( response.length > 0 )
					{

						jQuery('#bwhd-frontend-controls-listticketscontainer-table').DataTable(
				    	{
				    		"bDestroy": true,
				    		bFilter: false,
				    		bInfo: false,
				        	data: response,
				        	paging: false,
				        	autoWidth: false,
					        columns:
					        [
					            { "width": "1%", className: "text-center", "orderable": false, data: "ticket_id", render: function ( data, type, full, meta ) { return "<span class='fa fa-pencil bwhd-frontend-datatable-editicon' onclick='bwhd_frontend_button_listtickets_click_edit(" + data + ");'></span>"; } },
					            { "width": "1%", className: "text-center", title: "N", data: "ticket_id", render: function ( data, type, full, meta ) { return "<strong>" + data + "</strong>"; } },
					            { "width": "85%", title: "Title", data: "ticket_title" },
					            { "width": "13%", className: "text-center", title: "Status", data: "status_description", render: function ( data, type, full, meta ) { return "<div class='" + full.status_label + "'>" + data + "</div>" ; } }
					        ],
					        "order": [[ 1, "desc" ]]

				    	}
				    	);

						jQuery("#bwhd-frontend-controls-listticketscontainer-table").show();
						jQuery("#bwhd-frontend-controls-listticketscontainer-noitems").hide();

					}
					else
					{

						jQuery("#bwhd-frontend-controls-listticketscontainer-table").hide();
						jQuery("#bwhd-frontend-controls-listticketscontainer-noitems").show();

					}

					jQuery("#bwhd-frontend-controls-ticketlist-loader").hide();


			}

		}

	);


}


//load ticket details for the edit ticket page
function bwhd_frontend_editticket_load()
{

	value_ticket_id = jQuery("#bwhd_frontend_var_currentticketid").text();

	jQuery("#bwhd-frontend-controls-ticketedit-loader").show();

	jQuery.ajax
	(
		{
			url : bwhdVars.ajaxHandlerUrl,
			type : 'post',
			dataType: 'json',
			data :
				{
					action : 'ajax_frontend_tickets_get',
					security : bwhdVars.ajaxNonce,
					ticket_id : value_ticket_id
				},
			success : function( response )
			{

				jQuery("#bwhd-frontend-controls-ticketedit-spanticketid").text( response.ticket_id );
				jQuery("#bwhd-frontend-controls-ticketedit-spanopenedon").text( response.ticket_created_date );
				jQuery("#bwhd-frontend-controls-ticketedit-spantitle").text( response.ticket_title );
				jQuery("#bwhd-frontend-controls-ticketedit-spandescription").text( response.ticket_problem );
				jQuery("#bwhd-frontend-controls-ticketedit-spanstatus").html( "<div class='" + response.status_label + "'>" + response.status_description + "</div>"  );

				jQuery("#bwhd-frontend-controls-ticketedit-loader").hide();

				//setting the ticket id in the hidden form value of the upload file form
				//it will not throw an error in case of the add on is not installed
				jQuery("#bwhd-frontend-controls-ticketedit-attachments-hiddenuploadticketid").val(value_ticket_id);

			}
		}
	);


}


//load ticket details for the edit ticket page load messages
function bwhd_frontend_editticket_loadmessages()
{

	jQuery("#bwhd-frontend-controls-ticketedit-loader").show();

	//clearing previous validation
	jQuery("#bwhd-frontend-controls-ticketedit-txtnewmessage").removeClass("bwhd-frontend-errorinputborder");
	jQuery("#bwhd-frontend-controls-ticketedit-txtnewmessage").val('');
	jQuery("#bwhd-frontend-ticketeditmessage-validation").hide();
	jQuery("#bwhd-frontend-controls-ticketedit-listmessagescontainer").hide();
	jQuery("#bwhd-frontend-controls-ticketedit-nomessage").hide();

	value_ticket_id = jQuery("#bwhd_frontend_var_currentticketid").text();

	jQuery.ajax
	(
		{
			url : bwhdVars.ajaxHandlerUrl,
			type : 'post',
			dataType: 'json',
			data :
				{
					action : 'ajax_frontend_tickets_messages_load',
					security : bwhdVars.ajaxNonce,
					ticket_id : value_ticket_id
				},
			success : function( response )
			{

				if ( response.length > 0 )
				{

					var htmlContent = "";

					jQuery.each(response, function(index) {

						htmlContent += "<div class='bwhd-frontend-controls-ticketedit-listmessagescontainer-item'>";

						htmlContent += "<div class='col-md-1 no-gutter'>";
						htmlContent += response[index].author_avatar;
						htmlContent += "</div>";

						htmlContent += "<div class='col-md-11 no-gutter'>";
						htmlContent += "<div class='bwhd-frontend-controls-ticketedit-listmessagescontainer-authoranddate'><strong>" + response[index].author_displayname + "</strong> on " + response[index].message_date + "</div>";
						htmlContent += "<div class='clearfix'></div>";
						htmlContent += response[index].message_text;
						htmlContent += "</div>";

						htmlContent += "<div class='clearfix'></div>";

						htmlContent += "</div>";

			        });

			        jQuery("#bwhd-frontend-controls-ticketedit-listmessagescontainer").html( htmlContent );
			        jQuery("#bwhd-frontend-controls-ticketedit-listmessagescontainer").show();

		        }
		        else
		        {

	   				//no items
					jQuery("#bwhd-frontend-controls-ticketedit-nomessage").show();

		        }

		        jQuery("#bwhd-frontend-controls-ticketedit-loader").hide();

			}
		}
	);


}

//Save a new message for this ticket
function bwhd_frontend_editticket_addmessage()
{

	jQuery("#bwhd-frontend-controls-ticketedit-loader").show();
	jQuery("#bwhd-frontend-ticketeditmessage-validation").hide();

	//reading current ticket variable
	value_ticket_id = jQuery("#bwhd_frontend_var_currentticketid").text();

	//reading controls values
	value_message_text = jQuery("#bwhd-frontend-controls-ticketedit-txtnewmessage").val();

	jQuery.ajax
	(
		{
			url : bwhdVars.ajaxHandlerUrl,
			type : 'post',
			dataType: 'json',
			data :
				{
					action : 'ajax_frontend_tickets_messages_save',
					security : bwhdVars.ajaxNonce,
					ticket_id : value_ticket_id,
					message_text : value_message_text
				},
			success : function( response )
			{

				//clearing validation
				jQuery("#bwhd-frontend-controls-ticketedit-txtnewmessage").removeClass("bwhd-frontend-errorinputborder");

				//checking validation
				if (response.success == 1)
				{

					jQuery("#bwhd-frontend-controls-ticketedit-txtnewmessage").val('');
					bwhd_frontend_editticket_loadmessages();

				}
				else
				{
					jQuery("#bwhd-frontend-ticketeditmessage-validation").show();
					jQuery("#bwhd-frontend-ticketeditmessage-validation span").html( response.error_message );
					jQuery("#" + response.error_field_key).addClass("bwhd-frontend-errorinputborder");
					jQuery("#bwhd-frontend-controls-ticketedit-loader").hide();
					return;
				}

			}
		}
	);

}


//called "View Details" button on the list of existing tickets
function bwhd_frontend_button_editticket_click_goback( )
{

	jQuery("#bwhd_frontend_var_currentzone").text( "ticketslist" )
	jQuery("#bwhd_frontend_var_currentticketid").text( "0" )

	bwhd_admin_display_control_zone();

}


//called to switch panels in the subpanels of the ticket edit page
function bwhd_admin_ticketsview_submenuclick( keypanel )
{

	jQuery("#bwhd-frontend-horizontalsubmenu-li-details").removeClass("bwhd-frontend-horizontalsubmenu-selecteditem");
	jQuery("#bwhd-frontend-horizontalsubmenu-li-attachments").removeClass("bwhd-frontend-horizontalsubmenu-selecteditem");


	jQuery("#bwhd-frontend-horizontalsubmenu-panel-details").hide();
	jQuery("#bwhd-frontend-horizontalsubmenu-panel-attachments").hide();

	if ( keypanel == 'details')
	{
		jQuery("#bwhd-frontend-horizontalsubmenu-panel-details").show();
		jQuery("#bwhd-frontend-horizontalsubmenu-li-details").addClass("bwhd-frontend-horizontalsubmenu-selecteditem");
	}
	if ( keypanel == 'attachments')
	{
		jQuery("#bwhd-frontend-horizontalsubmenu-panel-attachments").show();
		jQuery("#bwhd-frontend-horizontalsubmenu-li-attachments").addClass("bwhd-frontend-horizontalsubmenu-selecteditem");
		bwhd_frontend_ticketsview_attachments_loadlist();
	}

}


//called "View Details" button on the list of existing tickets
function bwhd_frontend_button_listtickets_click_edit( ticket_id )
{

	jQuery("#bwhd_frontend_var_currentzone").text( "ticketedit" )
	jQuery("#bwhd_frontend_var_currentticketid").text( ticket_id )

	bwhd_admin_display_control_zone();

	bwhd_frontend_editticket_load();
	bwhd_frontend_editticket_loadmessages();

}


//called on Create New Ticket from the tickets list page
function bwhd_frontend_button_listtickets_click_createnew(  )
{

	jQuery("#bwhd_frontend_var_currentzone").text( "ticketnew" )

	bwhd_admin_display_control_zone();

}

//called on Go Back button in the tickets list page
function bwhd_frontend_button_listtickets_click_cancel(  )
{

	jQuery("#bwhd_frontend_var_currentzone").text( "home" )

	bwhd_admin_display_control_zone();
}



//called on new ticket click
function bwhd_frontend_button_newticket_click()
{

	jQuery("#bwhd_frontend_var_currentzone").text( "ticketnew" )

	bwhd_frontend_clear_ticketnew_form();

	bwhd_admin_display_control_zone();

}


//called on click on "search tickts" from homepage
function bwhd_frontend_button_ticketslist_click()
{


	jQuery("#bwhd_frontend_var_currentzone").text( "ticketslist" )

	bwhd_admin_display_control_zone();

	bwhd_frontend_loadlisttickets();

}

//called on new ticket click cancellation, to return to home
function bwhd_frontend_button_newticket_click_cancel()
{

	jQuery("#bwhd_frontend_var_currentzone").text( "home" )

	bwhd_admin_display_control_zone();

}

//called on new ticket click cancellation, to return to home
function bwhd_frontend_button_newticket_click_save()
{

	jQuery("#bwhd-frontend-controls-ticketnew-loader").show();

	value_customer_name = jQuery("#bwhd-frontend-controls-ticketnew-txtcustomername").val();
	value_customer_email = jQuery("#bwhd-frontend-controls-ticketnew-txtcustomeremail").val();

	value_ticket_title = jQuery("#bwhd-frontend-controls-ticketnew-txttickettitle").val();
	value_ticket_problem = jQuery("#bwhd-frontend-controls-ticketnew-txtticketproblem").val();
	value_category_id = jQuery("#bwhd-frontend-controls-ticketnew-ddlcategory").val();
	value_woocommerce_product_id = jQuery("#bwhd-frontend-controls-ticketnew-ddlproduct").val();

	value_captcha = jQuery("#bwhd-frontend-controls-ticketnew-txtcaptcha").val();

	jQuery.ajax
	(
		{
			url : bwhdVars.ajaxHandlerUrl,
			type : 'post',
			dataType: 'json',
			data :
				{
					action : 'ajax_frontend_tickets_insert',
					security : bwhdVars.ajaxNonce,
					customer_name : value_customer_name,
					customer_email : value_customer_email,
					ticket_title : value_ticket_title,
					ticket_problem : value_ticket_problem,
					category_id : value_category_id,
					captcha : value_captcha,
					woocommerce_productid : value_woocommerce_product_id
				},
			success : function( response )
			{

				jQuery("#bwhd-frontend-ticketnew-validation").hide();
				jQuery("#bwhd-frontend-controls-ticketnew-txtcustomername").removeClass("bwhd-frontend-errorinputborder");
				jQuery("#bwhd-frontend-controls-ticketnew-txtcustomeremail").removeClass("bwhd-frontend-errorinputborder");
				jQuery("#bwhd-frontend-controls-ticketnew-txttickettitle").removeClass("bwhd-frontend-errorinputborder");
				jQuery("#bwhd-frontend-controls-ticketnew-txtticketproblem").removeClass("bwhd-frontend-errorinputborder");
				jQuery("#bwhd-frontend-controls-ticketnew-ddlcategory").removeClass("bwhd-frontend-errorinputborder");
				jQuery("#bwhd-frontend-controls-ticketnew-txtcaptcha").removeClass("bwhd-frontend-errorinputborder");

				//checking validation
				if (response.success == 0)
				{

					jQuery("#bwhd-frontend-ticketnew-validation").show();
					jQuery("#bwhd-frontend-ticketnew-validation span").html( response.error_message );
					jQuery("#" + response.error_field_key).addClass("bwhd-frontend-errorinputborder");
					jQuery("#bwhd-frontend-controls-ticketnew-loader").hide();
					return;

				}

				bwhd_frontend_clear_ticketnew_form();

				//move to thanks page
				jQuery("#bwhd_frontend_var_currentticketid").text( response.extra_data_1 )
				jQuery("#bwhd_frontend_var_currentzone").text( "thanks" )
				jQuery("#bwhd-frontend-controls-ticketthanks-span-tickernumber").text ( response.extra_data_1 );
				bwhd_admin_display_control_zone();

				jQuery("#bwhd-frontend-controls-ticketnew-loader").hide();

			}
		}
	);


}



//This function cleans the new ticket form from its current values
function bwhd_frontend_clear_ticketnew_form()
{

	jQuery("#bwhd-frontend-controls-ticketnew-txtcustomername").val('');
	jQuery("#bwhd-frontend-controls-ticketnew-txtcustomeremail").val('');
	jQuery("#bwhd-frontend-controls-ticketnew-txttickettitle").val('');
	jQuery("#bwhd-frontend-controls-ticketnew-txtticketproblem").val('');
	jQuery("#bwhd-frontend-controls-ticketnew-ddlcategory").val(0);
	jQuery("#bwhd-frontend-controls-ticketnew-txtcaptcha").val('');

}


//Click on "Go Back" on the tickets thanks page
function bwhd_frontend_button_ticketthanks_click_cancel()
{

	jQuery("#bwhd_frontend_var_currentzone").text( "home" )

	bwhd_admin_display_control_zone();

}
