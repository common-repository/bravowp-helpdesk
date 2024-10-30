<?php

	//checking wheter to display the "Attachments" tab.
	$attachments_showtab = false;
	if ( bwhd_globals_proversionactive() )
	{

		 if ( get_option( "bwhd_attach_allowcustomers", "no" ) == "yes" )
		 {
				$attachments_showtab = true;
		 }

	}

?>


<div id="bwhd-frontend-controls-ticketedit" class="bwhd-frontend-panel-default" style="display:none;">

	<div class="bwhd-ajax-loader" id="bwhd-frontend-controls-ticketedit-loader" style="display:none;">
	  <img src="<?php echo bwhd_globals()->loadergif_url; ?>" class="bwhd-ajax-loader">
	</div>

	<div class="bwhd-frontend-panel-default-title">
		<?php _e("Review your Support Ticket", "bravowp-helpdesk");?>
	</div>

	<form class="form-horizontal">

		<div class="form-group clearfix no-topbot-margin">
			<label class="contol-label col-md-3"><?php _e("Ticket Number:", "bravowp-helpdesk");?></label>
			<div class="col-sm-9">
				<span id="bwhd-frontend-controls-ticketedit-spanticketid"></span>
			</div>
		</div>

		<div class="form-group clearfix no-topbot-margin">
			<label class="contol-label col-md-3"><?php _e("Opened On:", "bravowp-helpdesk");?></label>
			<div class="col-sm-9">
				<span id="bwhd-frontend-controls-ticketedit-spanopenedon"></span>
			</div>
		</div>

		<div class="form-group clearfix no-topbot-margin">
			<label class="contol-label col-md-3"><?php _e("Ticket Title:", "bravowp-helpdesk");?></label>
			<div class="col-sm-9">
				<span id="bwhd-frontend-controls-ticketedit-spantitle"></span>
			</div>
		</div>

		<div class="form-group clearfix no-topbot-margin">
			<label class="contol-label col-md-3"><?php _e("Ticket Description:", "bravowp-helpdesk");?></label>
			<div class="col-sm-9">
				<span id="bwhd-frontend-controls-ticketedit-spandescription"></span>
			</div>
		</div>

		<div class="form-group clearfix no-topbot-margin">
			<label class="contol-label col-md-3"><?php _e("Status:", "bravowp-helpdesk");?></label>
			<div class="col-sm-9">
				<span id="bwhd-frontend-controls-ticketedit-spanstatus"></span>
			</div>
		</div>

	</form>

	<div style="margin-top:20px;">
		<a class="btn btn-default" onclick="bwhd_frontend_button_editticket_click_goback();"><i class="fa fa-arrow-circle-o-left"></i> <?php _e("Go Back", "bravowp-helpdesk");?></a>
	</div>

	<div class="bwhd-frontend-horizontalsubmenu" style="margin-top:20px;">
		<ul class="menu">
			<li id="bwhd-frontend-horizontalsubmenu-li-details" class="bwhd-frontend-horizontalsubmenu-selecteditem">
				<a onclick="bwhd_admin_ticketsview_submenuclick('details');"><i class="fa fa-envelope-o"></i> <?php _e("Messages", "bravowp-helpdesk");?></a>
			</li>
			<?php
				if ( $attachments_showtab==true )
				{
					?>
						<li id="bwhd-frontend-horizontalsubmenu-li-attachments" class="bwhd-frontend-horizontalsubmenu">
							<a onclick="bwhd_admin_ticketsview_submenuclick('attachments');"><i class="fa fa-upload"></i> <?php _e("Attachmets", "bravowp-helpdesk");?></a>
						</li>
					<?php
				}
			?>
		</ul>
	</div>

	<div class="bwhd-frontend-subpanel" id="bwhd-frontend-horizontalsubmenu-panel-details">

		<div class="bwhd-frontend-subpanel-title">
			<?php _e("Messages for this Ticket", "bravowp-helpdesk");?>
		</div>

		<div style="display:none;" id="bwhd-frontend-controls-ticketedit-listmessagescontainer">
		</div>
		<div style="display:none;margin-top:10px;" id="bwhd-frontend-controls-ticketedit-nomessage" class="alert alert-info"><?php _e("No Messages yet.", "bravowp-helpdesk");?></div>

		<form>

			<div class="form-group">
				<label class="form-label"><?php _e("Add New Message", "bravowp-helpdesk");?></label>
				<textarea id="bwhd-frontend-controls-ticketedit-txtnewmessage" class="form-control" rows="3" style="height:auto !important;"></textarea>
			</div>

			<a class="btn btn-success" onclick="bwhd_frontend_editticket_addmessage();"><i class="fa fa-floppy-o"></i><?php _e("Save Message", "bravowp-helpdesk");?></a>

		</form>

		<div id="bwhd-frontend-ticketeditmessage-validation" class="alert alert-warning text-center" role="alert" style="display:none;margin-top:20px;"><i class="fa fa-exclamation bhwd-alert-redicon"></i><span></span></div>

	</div>

	<div class="bwhd-frontend-subpanel" id="bwhd-frontend-horizontalsubmenu-panel-attachments" style="display:none;">

		<?php

			if (bwhd_globals_proversionactive() ) {

				if ( get_option( "bwhd_attach_allowcustomers", "no" ) == "yes" )
				{
					include( bwhd_globals()->plugin_url . '../bravowp-helpdeskpro/controls/attachments-frontend-listfortickets.php' );
				}

			}

		?>

	</div>




</div>
