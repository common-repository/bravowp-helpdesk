<div id="bwhd-admin-contentpane-control-ticketslist"  class="bwhd-admin-contentpane-control">

	<!-- Title white bar -->
	<div class="row">

		<div class="col-md-12">

			<div class="bwhd-admin-contentpane-page-header">

				<div class="bwhd-admin-contentpane-page-header-title"><?php _e("Support Tickets", "bravowp-helpdesk"); ?></div>
				<a class="btn btn-success pull-right bwhd-admin-contentpane-page-header-bigbuttons" onclick="bwhd_admin_ticketslist_newticketclick();">
					<i class="fa fa-file-text"></i> <?php _e("Create Ticket", "bravowp-helpdesk"); ?>
				</a>

			</div>

		</div>

		<div class="clear"></div>

	</div>
	<!-- Title white bar -->

	<!-- Main Conainer -->
	<div class="row">

		<!-- Tickets list panel -->
		<div class="col-md-9">

			<div class="bwhd-admin-contentpane-page-wrapper" style="padding-right:0px;">

				<div class="bwhd-admin-contentpane-panel bwhd-admin-contentpane-panel-default">

					<div class="bwhd-admin-contentpane-panel-title">
						<?php _e("Tickets List", "bravowp-helpdesk"); ?>
					</div>

					<div id="bwhd_admin_rightpane_ticketslist_filterscontainer">

						<div style="float:left;margin-right:20px;">
							<div><?php _e("Search", "bravowp-helpdesk"); ?></div>
							<div class="clear"></div>
							<div id="bwhd_admin_rightpane_ticketslist_filterscontainer_placeholder_tx_search"><input type="text"  class="bwhd-admin-common-input"></input></div>
						</div>

						<div style="float:left;margin-right:20px;">
							<div><?php _e("Status", "bravowp-helpdesk"); ?></div>
							<div class="clear"></div>
							<select id="bwhd_admin_rightpane_ticketslist_filterscontainer_dd_status" onchange="bwhd_admin_ticketslist_load();" class="bwhd-admin-common-input">
								<option value="0" ><?php _e("(Include All)", "bravowp-helpdesk") ?></option>
								<option value="-1"><?php _e("- Active -", "bravowp-helpdesk") ?></option>
								<option value="-2"><?php _e("- Unresponded -", "bravowp-helpdesk") ?></option>
								<?php
									$listStatus = bwhd_controllers_status_list();
									foreach( $listStatus as $statusInfo )
									{
										echo "<option value='" . $statusInfo->status_id. "'>" . $statusInfo->status_description . "</option>";
									}
								?>
							</select>
						</div>

						<div style="float:left;margin-right:20px;">
							<div><?php _e("Category", "bravowp-helpdesk"); ?></div>
							<div class="clear"></div>
							<select id="bwhd_admin_rightpane_ticketslist_filterscontainer_dd_category" onchange="bwhd_admin_ticketslist_load();" class="bwhd-admin-common-input">
								<option value="0"><?php _e("(Include All)", "bravowp-helpdesk") ?></option>
								<?php
									$listCategories = bwhd_controllers_categories_list();
									foreach( $listCategories as $categoryInfo )
									{
										echo "<option value='" . $categoryInfo["category_id"] . "'>" . $categoryInfo["category_name"] . "</option>";
									}
								?>
							</select>
						</div>

						<div style="float:left;">
							<div><?php _e("Agent", "bravowp-helpdesk"); ?></div>
							<div class="clear"></div>
							<select id="bwhd_admin_rightpane_ticketslist_filterscontainer_dd_agent" onchange="bwhd_admin_ticketslist_load();" class="bwhd-admin-common-input">
								<option value="0"><?php _e("(Include All)", "bravowp-helpdesk") ?></option>
								<option value="-1"><?php _e("- Unassigned -", "bravowp-helpdesk") ?></option>
								<?php
									$listAgents = bwhd_controllers_agents_list();
									foreach( $listAgents as $AgentInfo )
									{
										echo "<option value='" . $AgentInfo["agent_id"] . "'>" . $AgentInfo["agent_name"] . "</option>";
									}
								?>
							</select>
						</div>

						<div class="clear"></div>

					</div>

					<table id="bwhd_admin_rightpane_ticketslist_table" class="display" cellspacing="0" width="100%"></table>

				</div>

			</div>

		</div>
		<!-- Tickets list panel -->

		<!-- Right widgets panel -->
		<div class="col-md-3 no-gutter-left">

			<div class="bwhd-admin-contentpane-page-wrapper" style="padding-left:0px;">

				<!-- counters and quick search -->
				<div class="bwhd-admin-contentpane-panel bwhd-admin-contentpane-panel-default">

					<div class="bwhd-admin-contentpane-panel-title">
						<?php _e("Quick Tickets Searches", "bravowp-helpdesk"); ?>
					</div>

					<div class="row">

						<div class="col-md-7"><?php _e("Assigned to Me:", "bravowp-helpdesk"); ?></div>
						<div class="col-md-3"><div class="bwhd-admin-ticketslist-counter"><span id="bwhd-admin-ticketslist-counter-span-assignedtome">0</span></div></div>
						<div class="col-md-2 no-gutter-left"><div class="btn btn-success bwhd-admin-ticketslist-counter-button" onclick="bwhd_admin_ticketslist_quicksearchesclick('assigned_to_me');"><span class="fa fa-search" style='margin-right:0px;'></span></div></div>

						<div class="col-md-7"><?php _e("Unresponded Tickets:", "bravowp-helpdesk"); ?></div>
						<div class="col-md-3"><div class="bwhd-admin-ticketslist-counter"><span id="bwhd-admin-ticketslist-counter-span-unassigned">0</span></div></div>
						<div class="col-md-2 no-gutter-left"><div class="btn btn-success bwhd-admin-ticketslist-counter-button" onclick="bwhd_admin_ticketslist_quicksearchesclick('unresponded');"><span class="fa fa-search" style='margin-right:0px;'></span></div></div>

						<div class="col-md-7"><?php _e("Closed by Me:", "bravowp-helpdesk"); ?></div>
						<div class="col-md-3"><div class="bwhd-admin-ticketslist-counter"><span id="bwhd-admin-ticketslist-counter-span-closedbyme">0</span></div></div>
						<div class="col-md-2 no-gutter-left"><div class="btn btn-success bwhd-admin-ticketslist-counter-button" onclick="bwhd_admin_ticketslist_quicksearchesclick('closed_by_me');"><span class="fa fa-search" style='margin-right:0px;'></span></div></div>

						<div class="clear"></div>

					</div>

				</div>
				<!-- counters and quick search -->

				<!-- open and closed ticket chart -->
				<div id="bwhd-admin-ticketslist-panel-chart" class="bwhd-admin-contentpane-panel bwhd-admin-contentpane-panel-default bwhd-admin-contentpane-panel-default-minheight" style="margin-top:10px;">

					<div class="bwhd-admin-contentpane-inner-panel-title"><?php _e("Opened Tickets vs Closed Tickets", "bravowp-helpdesk"); ?></div>

					<div class="clearfix"></div>

					<div id="bwhd-admin-ticketslist-chart-openvsclosed" class="ct-chart ct-major-eleventh" style="display:none;"></div>
					<div id="bwhd-admin-ticketslist-chart-openvsclosed-nodata" style="display:none; height: 200px;padding-top: 50px;"><?php echo bwhd_placeholders_dashboardchartnodata() ?></div>

					<div style="font-size:75%;margin-left: 10px;margin-top: 20px;">
						<i class="fa fa-square" style="color:#4cae4c"></i> <?php _e("Created Tickets", "bravowp-helpdesk"); ?>
						&nbsp;&nbsp;&nbsp;
						<i class="fa fa-square" style="color:#999999"></i> <?php _e("Closed Tickets", "bravowp-helpdesk"); ?>
					</div>

				</div>
				<!-- open and closed ticket chart -->

			</div>

		</div>
		<!-- Right widgets panel -->

	</div>
	<!-- Main Conainer -->

</div>
