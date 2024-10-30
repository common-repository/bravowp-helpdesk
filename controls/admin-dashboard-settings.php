
<div id="bwhd-admin-contentpane-control-settings"  class="bwhd-admin-contentpane-control">

	<div class="row">

		<div class="col-md-12">

			<div class="bwhd-admin-contentpane-page-header">

				<div class="bwhd-admin-contentpane-page-header-title"><?php _e("Helpdesk Settings", "bravowp-helpdesk"); ?></div>

			</div>
		</div>

		<div class="clear"></div>

	</div>

	<div class="bwhd-admin-contentpane-page-wrapper">

		<div class="row">

			<div class="col-md-12">

				<div class="bwhd-admin-contentpane-horizontalsubmenu">

					<ul class="menu" id="bwhd-admin-contentpane-horizontalsubmenu-settings">

						<li id="bwhd-admin-contentpane-horizontalsubmenu-settings-li-details" class="bwhd-admin-contentpane-horizontalsubmenu-selecteditem" onclick="bwhd_admin_settings_menuclick('general');">
							<a><i class="fa fa-cogs"></i> <?php _e("General", "bravowp-helpdesk"); ?></a>
						</li>
						<li id="bwhd-admin-contentpane-horizontalsubmenu-settings-li-tables" onclick="bwhd_admin_settings_menuclick('tables');">
							<a><i class="fa fa-table"></i> <?php _e("Tables", "bravowp-helpdesk"); ?></a>
						</li>
						<li id="bwhd-admin-contentpane-horizontalsubmenu-settings-li-notifications" onclick="bwhd_admin_settings_menuclick('notifications');">
							<a><i class="fa fa-envelope-o"></i> <?php _e("Notifications", "bravowp-helpdesk"); ?></a>
						</li>
						<li id="bwhd-admin-contentpane-horizontalsubmenu-settings-li-attachments" onclick="bwhd_admin_settings_menuclick('attachments');">
							<a><i class="fa fa-upload"></i> <?php _e("Attachments", "bravowp-helpdesk"); ?></a>
						</li>
						<li id="bwhd-admin-contentpane-horizontalsubmenu-settings-li-emailtoticket" onclick="bwhd_admin_settings_menuclick('emailtoticket');">
							<a><i class="fa fa-send-o"></i> <?php _e("Email To Tickets", "bravowp-helpdesk"); ?></a>
						</li>
						<li id="bwhd-admin-contentpane-horizontalsubmenu-settings-li-system" onclick="bwhd_admin_settings_menuclick('system');">
							<a><i class="fa fa-television"></i> <?php _e("System", "bravowp-helpdesk"); ?></a>
						</li>
						<li id="bwhd-admin-contentpane-horizontalsubmenu-settings-li-about" onclick="bwhd_admin_settings_menuclick('about');">
							<a><i class="fa fa-info-circle"></i> <?php _e("About", "bravowp-helpdesk"); ?></a>
						</li>

					</ul>

				</div>

			</div>

			<div class="clear"></div>

		</div>


		<div id="bwhd-admin-settingspanel-general" class="bwhd-admin-contentpane-panel bwhd-admin-contentpane-panel-default">

			<form class="form-horizontal">

				<div class="form-group bwhd-admin-settings-group">
					<label class="col-sm-2 control-label bwhd-admin-setting-label"><?php _e("Allow UnRegistered User to create Tickets?", "bravowp-helpdesk"); ?></label>
					<div class="col-sm-5">
						<select class="form-control form-control-force-auto-width" id="bwhd-admin-contentpane-control-settings-allowticketunregistered" >
							<option value="no" <?php if ( get_option( "bwhd_allowticketunregistered", "no" ) == "no" ) { echo "selected"; } ?>><?php _e("No", "bravowp-helpdesk"); ?></option>
							<option value="yes"<?php if ( get_option( "bwhd_allowticketunregistered", "no" ) == "yes" ) { echo "selected"; } ?>><?php _e("Yes", "bravowp-helpdesk"); ?></option>
						</select>
					</div>
					<div class="col-sm-5">
						<?php _e("Use this settings to restrict the use of front-end Helpdesk to registered users only. Default: No.", "bravowp-helpdesk"); ?>
					</div>
					<div class="clear"></div>
				</div>

				<div class="form-group bwhd-admin-settings-group">
					<label class="col-sm-2 control-label bwhd-admin-setting-label"><?php _e("Default screen for Unregistered Users?", "bravowp-helpdesk"); ?></label>
					<div class="col-sm-5">
						<select class="form-control form-control-force-auto-width" id="bwhd-admin-contentpane-control-settings-defaultscreenforunregistered" >
							<option value="home" <?php if ( get_option( "bwhd_defaultscreenforunregistered", "home" ) == "home" ) { echo "selected"; } ?>><?php _e("Main Page", "bravowp-helpdesk"); ?></option>
							<option value="createticket"<?php if ( get_option( "bwhd_defaultscreenforunregistered", "home" ) == "createticket" ) { echo "selected"; } ?>><?php _e("Create Ticket", "bravowp-helpdesk"); ?></option>
						</select>
					</div>
					<div class="col-sm-5">
						<?php _e("If Unregistered Users can create Tickets, this option define the first panel that is shown when they access the helpdesk front-end. Default: Main Page.", "bravowp-helpdesk"); ?>
					</div>
					<div class="clear"></div>
				</div>

				<div class="form-group bwhd-admin-settings-group">
					<label class="col-sm-2 control-label bwhd-admin-setting-label"><?php _e("Require CAPTCHA on Ticket Creation?", "bravowp-helpdesk"); ?></label>
					<div class="col-sm-5">
						<select class="form-control form-control-force-auto-width" id="bwhd-admin-contentpane-control-settings-requirecaptcha" >
							<option value="no" <?php if ( get_option( "bwhd_require_captcha", "no" ) == "no" ) { echo "selected"; } ?>><?php _e("No", "bravowp-helpdesk"); ?></option>
							<option value="yes"<?php if ( get_option( "bwhd_require_captcha", "no" ) == "yes" ) { echo "selected"; } ?>><?php _e("Yes", "bravowp-helpdesk"); ?></option>
						</select>
					</div>
					<div class="col-sm-5">
						<?php _e("Set this yes to require a CAPTCHA validation when users create new Support Tickets. Default: No.", "bravowp-helpdesk"); ?>
					</div>
					<div class="clear"></div>
				</div>

				<div class="form-group bwhd-admin-settings-group">
					<label class="col-sm-2 control-label bwhd-admin-setting-label"><?php _e("Helpdesk Email", "bravowp-helpdesk"); ?></label>
					<div class="col-sm-5">
						<input type='text' id="bwhd-admin-contentpane-control-settings-helpdeskemail" class="form-control form-control-force-auto-width" style="width:80%;" value="<?php echo get_option( "bwhd_helpdeskemail", "" ); ?>" ></input>
					</div>
					<div class="col-sm-5">
						<?php _e("The email address that will be notified when Customer create Support Tickets. Note: this email address is used as sender and recipient when 'Email Notification Extension' is installed and activated.", "bravowp-helpdesk"); ?>
					</div>
					<div class="clear"></div>
				</div>

				<div class="form-group bwhd-admin-settings-group">
					<label class="col-sm-2 control-label bwhd-admin-setting-label"><?php _e("Email on Customer Ticket Creation?", "bravowp-helpdesk"); ?></label>
					<div class="col-sm-5">
						<select class="form-control form-control-force-auto-width" id="bwhd-admin-contentpane-control-settings-emailoncustomerticketcreation" >
							<option value="no" <?php if ( get_option( "bwhd_emailoncustomerticketcreation", "no" ) == "no" ) { echo "selected"; } ?>><?php _e("No", "bravowp-helpdesk"); ?></option>
							<option value="yes"<?php if ( get_option( "bwhd_emailoncustomerticketcreation", "no" ) == "yes" ) { echo "selected"; } ?>><?php _e("Yes", "bravowp-helpdesk"); ?></option>
						</select>
					</div>
					<div class="col-sm-5">
						<?php _e("If enabled, the Helpdesk will send an email when a Customer creates a Support Ticket. Note that this setting is ignored if 'Email Notification Extension' is installed and active.", "bravowp-helpdesk"); ?>
					</div>
					<div class="clear"></div>
				</div>

				<div class="form-group bwhd-admin-settings-group">
					<label class="col-sm-2 control-label bwhd-admin-setting-label"><?php _e("Enable WooCommerce Integration?", "bravowp-helpdesk"); ?></label>
					<div class="col-sm-5">
						<select class="form-control form-control-force-auto-width" id="bwhd-admin-contentpane-control-settings-enablewoocommerceintegration" >
							<option value="no" <?php if ( get_option( "bwhd_enablewoocommerceintegration", "no" ) == "no" ) { echo "selected"; } ?>><?php _e("No", "bravowp-helpdesk"); ?></option>
							<option value="yes"<?php if ( get_option( "bwhd_enablewoocommerceintegration", "no" ) == "yes" ) { echo "selected"; } ?>><?php _e("Yes", "bravowp-helpdesk"); ?></option>
						</select>
					</div>
					<div class="col-sm-5">
						<?php _e("If enabled, and if WooCommerce plugin is installed and active, will display drop downs allowing to relate each Support Ticket to a WooCommerce product in your Store. Default: no.", "bravowp-helpdesk"); ?>
					</div>
					<div class="clear"></div>
				</div>

				<div class="form-group bwhd-admin-settings-group">
					<label class="col-sm-2 control-label bwhd-admin-setting-label"><?php _e("Enable System Events Log?", "bravowp-helpdesk"); ?></label>
					<div class="col-sm-5">
						<select class="form-control form-control-force-auto-width" id="bwhd-admin-contentpane-control-settings-enableeventslog" >
							<option value="no" <?php if ( get_option( "bwhd_log_enable", "no" ) == "no" ) { echo "selected"; } ?>><?php _e("Do not log events", "bravowp-helpdesk"); ?></option>
							<option value="yes_errors"<?php if ( get_option( "bwhd_log_enable", "no" ) == "yes_errors" ) { echo "selected"; } ?>><?php _e("Yes, Only Errors", "bravowp-helpdesk"); ?></option>
							<option value="yes_debug"<?php if ( get_option( "bwhd_log_enable", "no" ) == "yes_debug" ) { echo "selected"; } ?>><?php _e("Yes, Full Debug Mode", "bravowp-helpdesk"); ?></option>
						</select>
					</div>
					<div class="col-sm-5">
						<?php _e("Enable the logging of system activity only for debug purpouses or in case of errors.", "bravowp-helpdesk"); ?>
					</div>
					<div class="clear"></div>
				</div>

				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">

						<?php
						if (bwhd_demo_is_active() == 1)
						{

						        ?>

						        <div class="alert alert-warning text-center" style="width:200px;">
						                <?php _e("Saving Settings is denied in Public Demo.", "bravowp-helpdesk") ?>
						        </div>

						        <?php

						}
						else
						{

							?>

						        <a class="btn btn-success" onclick="bwhd_admin_settings_save();"><i class="fa fa-floppy-o" aria-hidden="true"></i><?php _e("Save Generic Settings", "bravowp-helpdesk"); ?></a>

						        <?php

						}
						?>

					</div>
					<div class="clear"></div>
				</div>

			</form>

			<div class="clear"></div>

		</div>


		<div id="bwhd-admin-settingspanel-notifications" class="bwhd-admin-contentpane-panel bwhd-admin-contentpane-panel-default"  style="display:none;">

			<?php
			if ( bwhd_globals_proversionactive() ) {

				include( bwhd_globals()->plugin_url_pro . '/controls/notifications-settings-list.php' );
				include( bwhd_globals()->plugin_url_pro . '/controls/notifications-settings-edit.php' );

			}
			else
			{

				echo bwhd_placeholders_addonavailable();

			}
			?>

			<div class="clear"></div>

		</div>

		<div id="bwhd-admin-settingspanel-attachments" class="bwhd-admin-contentpane-panel bwhd-admin-contentpane-panel-default"  style="display:none;">

			<?php
			if ( bwhd_globals_proversionactive() ) {

				include( bwhd_globals()->plugin_url_pro . '/controls/attachments-settings.php' );

			}
			else
			{

				echo bwhd_placeholders_addonavailable();

			}
			?>

			<div class="clear"></div>

		</div>

		<div id="bwhd-admin-settingspanel-emailtoticket" class="bwhd-admin-contentpane-panel bwhd-admin-contentpane-panel-default"  style="display:none;">

			<?php

				include( bwhd_globals()->plugin_url . '/controls/admin-settings-emailtoticket.php' );

			?>

			<div class="clear"></div>

		</div>

		<div id="bwhd-admin-settingspanel-tables" class="bwhd-admin-contentpane-panel bwhd-admin-contentpane-panel-default"  style="display:none;">

			<div class="row">

				<div class="col-md-4">

					<div class="bwhd-admin-settings-about-subtitle">
						<?php _e("Available Table Types", "bravowp-helpdesk"); ?>
					</div>
					<div class="clear"></div>
					<div class="bwhd-admin-settings-tables-type" id="bwhd_admin_settings_tables_type_categories" onclick="bwhd_admin_settings_tables_tableclick('categories');"><i class="fa fa-table"></i>&nbsp;&nbsp;<?php _e("Ticket Categories", "bravowp-helpdesk"); ?></div>
				</div>

				<div class="col-md-8">

					<div id="">

						<div id="bwhd-admin-settingspanel-tables-startmessage" class="alert alert-info">
							<?php _e("Click on a table name in the left pane.", "bravowp-helpdesk"); ?>
						</div>

						<div id="bwhd-admin-settingspanel-tables-listitemscontainer" style="display:none;">

							<table id="bwhd-admin-settingspanel-tables-listitemstable" class="display" cellspacing="0" width="100%"></table>
							<div class="clear" style="height:15px;"></div>

							<?php
							if (bwhd_demo_is_active() == 1)
							{

								?>

								<div class="alert alert-warning text-center">
									<?php _e("Editing Tables is denied in Public Demo. The buttons will be visible, but the saving of the changes will be blocked.", "bravowp-helpdesk") ?>
								</div>

								<?php

							}
							else
							{

								?>

								<button type="button" class="btn btn-success" onclick="bwhd_admin_settings_tables_openmodal(-1);">
									<i class="fa fa-plus" aria-hidden="true"></i><?php _e("Create New", "bravowp-helpdesk") ?>
								</button>

								<?php

							}
							?>


						</div>

					</div>

				</div>

			</div>

			<div class="clear"></div>

		</div>

		<div id="bwhd-admin-settingspanel-system" class="bwhd-admin-contentpane-panel bwhd-admin-contentpane-panel-default"  style="display:none;">

			<?php
			if (bwhd_demo_is_active() == 1)
			{

				?>

				<div class="alert alert-warning text-center">
					<?php _e("Viewing of the System Log is denied in Public Demo.", "bravowp-helpdesk") ?>
				</div>

				<?php

			}
			else
			{

				?>

				<div class="row">
					<div class="col-sm-12">
						<a class="btn btn-success" onclick="bwhd_admin_settings_loadeventslog();"><i class="fa fa-television"></i><?php _e("Load Events Log", "bravowp-helpdesk"); ?></a>
						<a class="btn btn-success" onclick="bwhd_admin_settings_cleareventslog();"><i class="fa fa-trash"></i><?php _e("Clear Events Log", "bravowp-helpdesk"); ?></a>
					</div>
				</div>
				<div class="clear"></div>

				<div id='bwhd-admin-settingspanel-system-eventslogplaceholder' style="height:300px;overflow-y:scroll;margin-top:5px;display:none;">

				</div>
				<div class="clear"></div>

				<?php

			}
			?>


		</div>

		<div id="bwhd-admin-settingspanel-about" class="bwhd-admin-contentpane-panel bwhd-admin-contentpane-panel-default"  style="display:none;">

			<div class="row">

				<div class="col-sm-4">
					<div class="bwhd-admin-settings-about-panel">
						<div class="bwhd-admin-settings-about-subtitle"><?php _e("Professional Edition!", "bravowp-helpdesk") ?></div>
						<img src="<?php echo bwhd_globals()->plugin_httpurl; ?>/images/upgrade.png" style="width:180px;height:180px;">
						<div class="clear" style="margin-top: 20px; height:50px;">
							<?php _e("Get all the professional functions unlocked, upgrade now!","bravowp-helpdesk") ?>
						</div>
						<div class="clear" style="height:20px;"></div>
						<a href="http://www.bravowp.com/downloads/wordpress-helpdesk-plugin/" target="blank" class="btn btn-success"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i><?php _e("Upgrade to PRO!","bravowp-helpdesk") ?></a>
					</div>
				</div>

				<div class="col-sm-4">
					<div class="bwhd-admin-settings-about-panel">
						<div class="bwhd-admin-settings-about-subtitle"><?php _e("Help & Support", "bravowp-helpdesk") ?></div>
						<img src="<?php echo bwhd_globals()->plugin_httpurl; ?>/images/askforhelp.png" style="width:180px;height:180px;">
						<div class="clear" style="margin-top: 20px; height:50px;">
							<?php _e("Read the Helpdesk documentation on this page. Also, use the Contact Us page on our website in case you need support.","bravowp-helpdesk") ?>
						</div>
						<div class="clear" style="height:20px;"></div>
						<a href="http://www.bravowp.com/bravowp-helpdesk-plugin-documentation/" target="blank" class="btn btn-success"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i><?php _e("Read Documentation","bravowp-helpdesk") ?></a>
					</div>
				</div>

				<div class="col-sm-4">
					<div class="bwhd-admin-settings-about-panel">
						<div class="bwhd-admin-settings-about-subtitle"><?php _e("Rate Us!", "bravowp-helpdesk") ?></div>
						<img src="<?php echo bwhd_globals()->plugin_httpurl; ?>/images/rate5stars.jpg" style="width:180px;height:180px;">
						<div class="clear" style="margin-top: 20px; height:50px;">
							<?php _e("The more the plugin gets popular, the more resources and motivation we will have to keep adding new features. Thank you in advance!","bravowp-helpdesk") ?>
						</div>
						<div class="clear" style="height:20px;"></div>
						<a href="https://wordpress.org/plugins/bravowp-helpdesk/" target="blank" class="btn btn-success"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i><?php _e("Go to Wordpress.org","bravowp-helpdesk") ?></a>
					</div>
				</div>

			</div>

			<div class="clear"></div>

		</div>

		<div class="clear"></div>

	</div>

	<div id="bwhd-admin-settings-table-modalcategory" class="modal fade">

		<div class="modal-dialog" style="width: 60%;">

			<div class="modal-content">

				<div class="modal-header">
					<button class="close" type="button" data-dismiss="modal">×</button>
					<h4 class="modal-title"><?php _e("Add / Edit Category", "bravowp-helpdesk") ?></h4>
				</div>

				<div class="modal-body">

					<div class="row">

						<div class="col-md-12">

							<span><?php _e("Category Name", "bravowp-helpdesk") ?></span>
							<input type="text" class="form-control" id="bwhd-admin-settings-table-modalcategory-tx-name"></input>

						</div>

						<div class="clear"></div>

					</div>


				</div>

				<div class="modal-footer">

					<button type="button" class="btn btn-secondary" data-dismiss="modal">
						<i class="fa fa-arrow-left" aria-hidden="true"></i><?php _e("Cancel", "bravowp-helpdesk") ?>
					</button>
					<button type="button" class="btn btn-success" onclick='bwhd_admin_settings_tables_savemodal();'>
						<i class="fa fa-floppy-o" aria-hidden="true"></i><?php _e("Save Changes", "bravowp-helpdesk") ?>
					</button>

				</div>

			</div>

		</div>

	</div>

</div>
