<div id="bwhd-admin-contentpane-control-ticketview-events">

	<div class="row">

		<div class="col-md-12">

			<div class="bwhd-admin-contentpane-panel" style="padding-top:40px;">

				<div class="bwhd-admin-contentpane-inner-panel-body">

					<div id="bwhd-admin-contentpane-ticketmessages-list"></div>
					<span id="bwhd-admin-contentpane-ticketmessages-listnodata" class="bwhd-admin-contentpane-greyedtext"><?php _e("No messages yet.", "bravowp-helpdesk"); ?></span>

					<div class="bwhd-admin-contentpane-inner-panel-title" style="margin-top:25px;"><?php _e("ADD MESSAGE", "bravowp-helpdesk"); ?></div>

					<div class="bwhd-admin-contentpane-inner-panel-body">

						<form>
							<div class="form-group">
								<label class="form-label bwhd-admin-label-required"><?php _e("Message:", "bravowp-helpdesk"); ?></label>
								<textarea id="bwhd-admin-contentpane-control-ticketview-messages-txtmessage" class="form-control" rows="3" style="height:auto !important;"></textarea>
							</div>
							<a class="btn btn-success" onclick="bwhd_admin_ticketsview_addmessage();"><i class="fa fa-floppy-o" aria-hidden="true"></i><?php _e("Save Message", "bravowp-helpdesk"); ?></a>
							<div id="bwhd-admin-contentpane-control-newmessage-validation" class="alert alert-warning text-center" role="alert" style="display:none;margin-top:20px;"><i class="fa fa-exclamation bhwd-alert-redicon"></i><span></span></div>
						</form>

					</div>


				</div>

			</div>

		</div>

	</div>

	<div class="clear"></div>

</div>
