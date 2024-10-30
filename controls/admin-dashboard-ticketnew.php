<div id="bwhd-admin-contentpane-control-ticketnew"  class="bwhd-admin-contentpane-control">

	<div class="row">

		<div class="col-md-12">

			<div class="bwhd-admin-contentpane-page-header">

				<div class="bwhd-admin-contentpane-page-header-title"><?php _e("Create New Support Ticket", "bravowp-helpdesk"); ?></div>
				<button class="btn btn-secondary pull-right bwhd-admin-contentpane-page-header-bigbuttons" onclick="bwhd_admin_ticketsnew_goback();">
					<i class="fa fa-arrow-left" aria-hidden="true"></i> <?php _e("Go Back", "bravowp-helpdesk"); ?>
				</button>

			</div>

		</div>

		<div class="clear"></div>

	</div>

	<div class="row">

		<div class="col-md-8">

			<div class="bwhd-admin-contentpane-page-wrapper">

				<div class="bwhd-admin-contentpane-panel bwhd-admin-contentpane-panel-default">

					<div class="bwhd-admin-contentpane-inner-panel">

						<div class="bwhd-admin-contentpane-inner-panel-title"><?php _e("Customer Information", "bravowp-helpdesk"); ?></div>

						<div class="bwhd-admin-contentpane-inner-panel-body">

							<form class="form-horizontal">
								<div class="form-group">
									<label class="col-md-3 control-label bwhd-admin-label-required"><?php _e("Customer type", "bravowp-helpdesk"); ?></label>
									<div class="col-md-9">
										<label class="radio-inline"><input class="radio-input-fix" checked type="radio" value="existing" name="bwhd-admin-contentpane-control-ticketnew-optcustomertype" id="bwhd-admin-contentpane-control-ticketnew-optcustomerexisting"><?php _e("Existing", "bravowp-helpdesk"); ?></label>
										<label class="radio-inline"><input class="radio-input-fix" type="radio" value="new" name="bwhd-admin-contentpane-control-ticketnew-optcustomertype"  id="bwhd-admin-contentpane-control-ticketnew-optcustomernew"><?php _e("New Customer", "bravowp-helpdesk"); ?></label>
									</div>
									<div class="clear"></div>
								</div>
								<div class="form-group" id="bwhd-admin-contentpane-control-ticketnew-customername" style="display:none;">
									<label class="col-md-3 control-label bwhd-admin-label-required"><?php _e("Customer Name", "bravowp-helpdesk"); ?></label>
									<div class="col-md-9">
										<input id="bwhd-admin-contentpane-control-ticketnew-txtcustomername" class="form-control" type="text">
									</div>
									<div class="clear"></div>
								</div>
								<div class="form-group" id="bwhd-admin-contentpane-control-ticketnew-customeremail" style="display:none;">
									<label class="col-md-3 control-label bwhd-admin-label-required"><?php _e("Customer Email", "bravowp-helpdesk"); ?></label>
									<div class="col-md-9">
										<input id="bwhd-admin-contentpane-control-ticketnew-txtcustomeremail" class="form-control" type="text">
									</div>
									<div class="clear"></div>
								</div>
								<div class="form-group" id="bwhd-admin-contentpane-control-ticketnew-customerexisting">
									<label class="col-md-3 control-label bwhd-admin-label-required"><?php _e("Select Customer", "bravowp-helpdesk"); ?></label>
									<div class="col-md-9">
										<select id="bwhd-admin-contentpane-control-ticketnew-ddlexistingcustomer" class="selectpicker">
											<option value="0">(...)</option>
											<?php

											$customer_array = bwhd_controllers_customers_listfordashboardticketcreate();
											foreach( $customer_array as $customer_info )
											{
												echo "<option value='" . $customer_info["id"] . "'>" .$customer_info["display_name"] . "</option>";
											}

											?>
										</select>
									</div>
									<div class="clear"></div>
								</div>
							</form>

						</div>

						<div class="clear" style="height:30px;"></div>

						<div class="bwhd-admin-contentpane-inner-panel-title"><?php _e("Ticket Information", "bravowp-helpdesk"); ?></div>

						<div class="bwhd-admin-contentpane-inner-panel-body">

							<form class="form-horizontal">
								<div class="form-group">
									<label class="col-sm-3 control-label bwhd-admin-label-required"><?php _e("Ticket Title", "bravowp-helpdesk"); ?></label>
									<div class="col-sm-9">
										<input id="bwhd-admin-contentpane-control-ticketnew-txttitle" class="form-control" type="text">
									</div>
									<div class="clear"></div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label bwhd-admin-label-required"><?php _e("Ticket Description", "bravowp-helpdesk"); ?></label>
									<div class="col-md-9">
										<textarea id="bwhd-admin-contentpane-control-ticketnew-txtdescription" class="form-control" rows="3" style="height:auto !important;"></textarea>
									</div>
									<div class="clear"></div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label bwhd-admin-label-required"><?php _e("Ticket Category", "bravowp-helpdesk"); ?></label>
									<div class="col-md-9">
										<select id="bwhd-admin-contentpane-control-ticketnew-ddlcategory" class="selectpicker">
											<option value="0">(...)</option>
											<?php

											$categories_array = bwhd_controllers_categories_list();
											foreach( $categories_array as $categories_info )
											{
												echo "<option value='" . $categories_info["category_id"] . "'>" . $categories_info["category_name"] . "</option>";
											}

											?>
										</select>
									</div>
									<div class="clear"></div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label"><?php _e("Ticket Priority", "bravowp-helpdesk"); ?></label>
									<div class="col-md-9">
										<select id="bwhd-admin-contentpane-control-ticketnew-ddlpriority" class="selectpicker">
											<option value="0">(...)</option>
											<?php

											$priorities_array = bwhd_controllers_priorities_list();
											foreach( $priorities_array as $priorities_info )
											{
												echo "<option value='" . $priorities_info->priority_id . "'>" . $priorities_info->priority_description . "</option>";
											}

											?>
										</select>
									</div>
									<div class="clear"></div>
								</div>
								<?php if ( bwhd_globals_woocommerceactive() && get_option("bwhd_enablewoocommerceintegration", "no") == "yes") { ?>
									<div class="form-group">
										<label class="col-md-3 control-label bwhd-admin-label-required"><?php _e("Ticket Product", "bravowp-helpdesk"); ?></label>
										<div class="col-md-9">
											<select id="bwhd-admin-contentpane-control-ticketnew-ddlproduct" class="selectpicker">
												<option value="0">(...)</option>
												<?php

												$products_array = bwhd_controllers_woocommerce_products_list();
												foreach( $products_array as $product_info )
												{
													echo "<option value='" . $product_info["productId"] . "'>" . $product_info["productDescription"] . "</option>";
												}

												?>
											</select>
										</div>
										<div class="clear"></div>
									</div>
									<?php } ?>
									<div class="form-group">
										<div class="col-md-3">
										</div>
										<div class="col-md-9">
											<a class="btn btn-success" onclick="bwhd_admin_ticketsnew_insertticket();"><i class="fa fa-floppy-o" aria-hidden="true"></i><?php _e("Create Ticket", "bravowp-helpdesk"); ?></a>
										</div>
										<div class="clear"></div>
									</div>

									<div id="bwhd-admin-contentpane-control-ticketnew-validation" class="alert alert-warning text-center" role="alert" style="display:none;"><i class="fa fa-exclamation bhwd-alert-redicon"></i><span></span></div>

								</form>

							</div>

						</div>

					</div>

				</div>

			</div>

		</div>

	</div>
