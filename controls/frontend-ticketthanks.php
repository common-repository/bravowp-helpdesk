<div id="bwhd-frontend-controls-ticketthanks" class="bwhd-frontend-panel-default" style="display:none;">

	<div class="bwhd-frontend-panel-default-title">
		<?php _e("Support Ticket received!", "bravowp-helpdesk");?>
	</div>
	
	<span class="bwhd-frontend-span-margin-bottom">

		<?php _e("Thank you, we received your request! Our Support Agents will operate on your Ticket as soon as possible. No further action is needed from your side; please hold on and await our response.", "bravowp-helpdesk");?>
		<br>
		<br>
		<?php _e("Your Ticket Number is:", "bravowp-helpdesk");?> <span id="bwhd-frontend-controls-ticketthanks-span-tickernumber"></span>		

	</span>

	<div class="form-group">
		<a class="btn btn-success" onclick="bwhd_frontend_button_ticketthanks_click_cancel();"><i class="fa fa-arrow-circle-o-left"></i> <?php _e("Go Home", "bravowp-helpdesk");?></a>
	</div>

	<div id="bwhd-frontend-ticketnew-validation" class="alert alert-warning text-center" role="alert" style="display:none;"><i class="fa fa-exclamation bhwd-alert-redicon"></i><span></span></div>

</div>