//Document load
jQuery(document).ready(function(){

	bwhd_admin_installwizard_showpanel();

});

function bwhd_admin_installwizard_movenext()
{

	if ( bwhd_globalbag.zone_installwizard == 'start' )
	{
		bwhd_globalbag.zone_installwizard = 'frontend';
	}
	else if ( bwhd_globalbag.zone_installwizard == 'frontend' )
	{

		//validation
		jQuery("#bwhd-admin-installwizard-panel1-frontend-tx-nameofhelpdeskpage-validator").hide();
		if ( jQuery("#bwhd-admin-installwizard-panel1-frontend-tx-nameofhelpdeskpage").val() == '' )
		{
			jQuery("#bwhd-admin-installwizard-panel1-frontend-tx-nameofhelpdeskpage-validator").show();
			return;
		}

		bwhd_globalbag.zone_installwizard = 'emailaddress';

	}
	else if ( bwhd_globalbag.zone_installwizard == 'emailaddress' )
	{

		//validation
		jQuery("#bwhd-admin-installwizard-panel2-emailaddress-tx-emailaddress-validator").hide();
		if ( bwhd_common_isValidEmailAddress( jQuery("#bwhd-admin-installwizard-panel2-emailaddress-tx-emailaddress").val() ) == false )
		{
			jQuery("#bwhd-admin-installwizard-panel2-emailaddress-tx-emailaddress-validator").show();
			return;
		}

		bwhd_globalbag.zone_installwizard = 'ecommerce';
	}
	else if ( bwhd_globalbag.zone_installwizard == 'ecommerce' )
	{
		bwhd_globalbag.zone_installwizard = 'emailfetch';
	}
	else if ( bwhd_globalbag.zone_installwizard == 'emailfetch' )
	{
		bwhd_globalbag.zone_installwizard = 'finish';
	}

	bwhd_admin_installwizard_showpanel();

}

function bwhd_admin_installwizard_moveback()
{

	if ( bwhd_globalbag.zone_installwizard == 'frontend' )
	{
		bwhd_globalbag.zone_installwizard = 'start'
	}
	else if ( bwhd_globalbag.zone_installwizard == 'emailaddress' )
	{
		bwhd_globalbag.zone_installwizard = 'frontend'
	}
	else if ( bwhd_globalbag.zone_installwizard == 'ecommerce' )
	{
		bwhd_globalbag.zone_installwizard = 'emailaddress'
	}
	else if ( bwhd_globalbag.zone_installwizard == 'emailfetch' )
	{
		bwhd_globalbag.zone_installwizard = 'ecommerce'
	}
	else if ( bwhd_globalbag.zone_installwizard == 'finish' )
	{
		bwhd_globalbag.zone_installwizard = 'emailfetch'
	}
	bwhd_admin_installwizard_showpanel();

}

function bwhd_admin_installwizard_showpanel()
{

	jQuery("#bwhd-admin-installwizard-panel0-start").hide();
	jQuery("#bwhd-admin-installwizard-panel1-fronend").hide();
	jQuery("#bwhd-admin-installwizard-panel2-emailaddress").hide();
	jQuery("#bwhd-admin-installwizard-panel3-ecommerce").hide();
	jQuery("#bwhd-admin-installwizard-panel4-emailfetch").hide();
	jQuery("#bwhd-admin-installwizard-panel5-finish").hide();

	jQuery("#bwhd-admin-installwizard-btnstart").hide();
	jQuery("#bwhd-admin-installwizard-btnforward").hide();
	jQuery("#bwhd-admin-installwizard-btnbackward").hide();
	jQuery("#bwhd-admin-installwizard-btnfinalize").hide();

	if ( bwhd_globalbag.zone_installwizard == 'start' )
	{
		jQuery("#bwhd-admin-installwizard-btnstart").fadeIn(800);
		jQuery("#bwhd-admin-installwizard-panel0-start").fadeIn(800);
		jQuery("#bwhd-admin-installwizard-btnforward").hide();
		jQuery("#bwhd-admin-installwizard-btnbackward").hide();
		jQuery("#bwhd-admin-installwizard-progressbar").html("15%");
		jQuery("#bwhd-admin-installwizard-progressbar").css("width","15%");
	}

	if ( bwhd_globalbag.zone_installwizard == 'frontend' )
	{
		jQuery("#bwhd-admin-installwizard-btnstart").hide();
		jQuery("#bwhd-admin-installwizard-panel1-fronend").fadeIn(800);
		jQuery("#bwhd-admin-installwizard-btnforward").fadeIn(800);
		jQuery("#bwhd-admin-installwizard-btnbackward").fadeIn(800);
		jQuery("#bwhd-admin-installwizard-progressbar").html("25%");
		jQuery("#bwhd-admin-installwizard-progressbar").css("width","25%");
	}

	if ( bwhd_globalbag.zone_installwizard == 'emailaddress' )
	{
		jQuery("#bwhd-admin-installwizard-btnstart").hide();
		jQuery("#bwhd-admin-installwizard-panel2-emailaddress").fadeIn(800);
		jQuery("#bwhd-admin-installwizard-btnforward").fadeIn(800);
		jQuery("#bwhd-admin-installwizard-btnbackward").fadeIn(800);
		jQuery("#bwhd-admin-installwizard-progressbar").html("40%");
		jQuery("#bwhd-admin-installwizard-progressbar").css("width","40%");
	}

	if ( bwhd_globalbag.zone_installwizard == 'ecommerce' )
	{
		jQuery("#bwhd-admin-installwizard-btnstart").hide();
		jQuery("#bwhd-admin-installwizard-panel3-ecommerce").fadeIn(800);
		jQuery("#bwhd-admin-installwizard-btnforward").fadeIn(800);
		jQuery("#bwhd-admin-installwizard-btnbackward").fadeIn(800);
		jQuery("#bwhd-admin-installwizard-progressbar").html("60%");
		jQuery("#bwhd-admin-installwizard-progressbar").css("width","60%");
	}

	if ( bwhd_globalbag.zone_installwizard == 'emailfetch' )
	{
		jQuery("#bwhd-admin-installwizard-btnstart").hide();
		jQuery("#bwhd-admin-installwizard-panel4-emailfetch").fadeIn(800);
		jQuery("#bwhd-admin-installwizard-btnforward").fadeIn(800);
		jQuery("#bwhd-admin-installwizard-btnbackward").fadeIn(800);
		jQuery("#bwhd-admin-installwizard-progressbar").html("80%");
		jQuery("#bwhd-admin-installwizard-progressbar").css("width","80%");
	}

	if ( bwhd_globalbag.zone_installwizard == 'finish' )
	{
		jQuery("#bwhd-admin-installwizard-btnstart").hide();
		jQuery("#bwhd-admin-installwizard-panel5-finish").fadeIn(800);
		jQuery("#bwhd-admin-installwizard-btnfinalize").fadeIn(800);
		jQuery("#bwhd-admin-installwizard-btnbackward").fadeIn(800);
		jQuery("#bwhd-admin-installwizard-progressbar").html("100%");
		jQuery("#bwhd-admin-installwizard-progressbar").css("width","100%");
	}

}

function bwhd_admin_installwizard_usehelpdeskddchange()
{

	if ( jQuery("#bwhd-admin-installwizard-panel1-frontend-dd-usefrontend").val() == "yes" )
	{

		jQuery("#bwhd-admin-installwizard-panel1-frontend-field-createnewpageforhelpdesk").show();
		jQuery("#bwhd-admin-installwizard-panel1-frontend-field-allowunregisteredusers").show();
		jQuery("#bwhd-admin-installwizard-panel1-frontend-field-nameofhelpdeskpage").show();

	}
	else
	{

		jQuery("#bwhd-admin-installwizard-panel1-frontend-field-createnewpageforhelpdesk").hide();
		jQuery("#bwhd-admin-installwizard-panel1-frontend-field-allowunregisteredusers").hide();
		jQuery("#bwhd-admin-installwizard-panel1-frontend-field-nameofhelpdeskpage").hide();

	}


}

function bwhd_admin_installwizard_update()
{

	//saving options
	jQuery.ajax
	(
		{
			url : bwhdVars.ajaxHandlerUrl,
			type : 'post',
			dataType: 'json',
			data :
			{
				action : 'ajax_admin_installwizard_finish',
				security : bwhdVars.ajaxNonce,
				panel1_usefrontend : jQuery("#bwhd-admin-installwizard-panel1-frontend-dd-usefrontend").val(),
				panel1_createnewpage :	jQuery("#bwhd-admin-installwizard-panel1-frontend-dd-createnewpage").val(),
				panel1_nameofpage : jQuery("#bwhd-admin-installwizard-panel1-frontend-tx-nameofhelpdeskpage").val(),
				panel1_allowunregistered : jQuery("#bwhd-admin-installwizard-panel1-frontend-dd-allowunregistered").val(),
				panel2_emailaddress : jQuery("#bwhd-admin-installwizard-panel2-emailaddress-tx-emailaddress").val(),
				panel3_useecommerce : jQuery("#bwhd-admin-installwizard-panel3-ecommerce-dd-use").val()

			},
			success : function( response )
			{

				window.location.reload(false);

			}
		}
	);

}
