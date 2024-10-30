
//Document load
jQuery(document).ready(function(){

	bwhd_admin_settings_emailtoticket_showhideoptionsforservice();

});

//Called on button click to save the settings for emails to ticket system
function bwhd_admin_settings_emailtoticket_save( )
{

	jQuery("#bwhd-admin-dashboard-loader").show();

	value_enableEmailFetching = jQuery("#bwhd-admin-contentpane-control-settings-emailtoticket-dd-enable").val();
	value_servicetype = jQuery("#bwhd-admin-contentpane-control-settings-emailtoticket-dd-servertype").val();
	value_username = jQuery("#bwhd-admin-contentpane-control-settings-emailtoticket-tx-username").val();
	value_password = jQuery("#bwhd-admin-contentpane-control-settings-emailtoticket-tx_password").val();
	value_server = jQuery("#bwhd-admin-contentpane-control-settings-emailtoticket-tx-server").val();
	value_port = jQuery("#bwhd-admin-contentpane-control-settings-emailtoticket-tx-port").val();

	jQuery.ajax
	(
		{
			url : bwhdVars.ajaxHandlerUrl,
			type : 'post',
			dataType: 'json',
			data :
			{
				action : 'ajax_admin_settings_emailtoticket_updatesettings',
				security : bwhdVars.ajaxNonce,
				enableEmailFetching : value_enableEmailFetching,
				username : value_username,
				password : value_password,
				server : value_server,
				port : value_port,
				serviceType : value_servicetype
			},
			success : function( response )
			{

				jQuery("#bwhd-admin-contentpane-control-settings-emailtoticket-saved-success").show();
				jQuery("#bwhd-admin-dashboard-loader").hide();

			}
		}
	);

}

//Called on button click to test the settings
function bwhd_admin_settings_emailtoticket_test( )
{

	jQuery("#bwhd-admin-dashboard-loader").show();
	jQuery("#bwhd-admin-contentpane-control-settings-emailtoticket-saved-success").hide();
	jQuery("#bwhd-admin-contentpane-control-settings-emailtoticket-div_logresult").hide();

	jQuery.ajax
	(
		{
			url : bwhdVars.ajaxHandlerUrl,
			type : 'post',
			dataType: 'json',
			data :
			{
				action : 'ajax_admin_settings_emailtoticket_testsettings',
				security : bwhdVars.ajaxNonce
			},
			success : function( response )
			{

				if ( response != null)
				{
					jQuery("#bwhd-admin-contentpane-control-settings-emailtoticket-div_logresult").html( response.extra_data_2  );
					jQuery("#bwhd-admin-contentpane-control-settings-emailtoticket-div_logresult").show();
				}
				else
				{
					jQuery("#bwhd-admin-contentpane-control-settings-emailtoticket-div_logresult").html( "Error: Generic Connection Problem"  );
					jQuery("#bwhd-admin-contentpane-control-settings-emailtoticket-div_logresult").show();
				}

				jQuery("#bwhd-admin-dashboard-loader").hide();

			}
		}
	);

}


//this function shows or hides some options according to the service type dropdown
function bwhd_admin_settings_emailtoticket_showhideoptionsforservice()
{

	if (jQuery("#bwhd-admin-contentpane-control-settings-emailtoticket-dd-servertype").val() == "custom")
	{
		jQuery("#bwhd-admin-contentpane-control-settings-emailtoticket-server-div").show();
		jQuery("#bwhd-admin-contentpane-control-settings-emailtoticket-port-div").show();
		jQuery("#bwhd-admin-contentpane-control-settings-emailtoticket-dd-servertype_infogmailbutton").hide();
	}
	if (jQuery("#bwhd-admin-contentpane-control-settings-emailtoticket-dd-servertype").val() == "gmail")
	{
		jQuery("#bwhd-admin-contentpane-control-settings-emailtoticket-server-div").hide();
		jQuery("#bwhd-admin-contentpane-control-settings-emailtoticket-port-div").hide();
		jQuery("#bwhd-admin-contentpane-control-settings-emailtoticket-dd-servertype_infogmailbutton").show();
	}


}


//opens the modal for gmail infos
function bwhd_admin_settings_emailtoticket_opengmailhelpmodal()
{

	jQuery("#bwhd-admin-settings-emailtoticket-modalinfogmail").modal();

}
