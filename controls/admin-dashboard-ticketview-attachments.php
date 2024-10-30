<div id="bwhd-admin-contentpane-control-ticketview-attachments">

	<div class="row">

		<div class="col-md-12 col-lg-12">

			<div class="bwhd-admin-contentpane-panel">

				<div class="bwhd-admin-contentpane-inner-panel-title"><?php _e("Attachments", "bravowp-helpdesk"); ?></div>

				<div class="bwhd-admin-contentpane-inner-panel-body">

					<?php if ( bwhd_globals_proversionactive() ) {

						include( bwhd_globals()->plugin_url . '../bravowp-helpdeskpro/controls/attachments-admin-listforticket.php' );

					} else { ?>

						<?php echo bwhd_placeholders_addonavailable() ?>

					<?php } ?>

				</div>

			</div>

		</div>

		<div class="clearfix"></div>

	</div>

</div>
