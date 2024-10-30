<div id="bwhd-admin-contentpane-control-ticketview"  class="bwhd-admin-contentpane-control">

        <div class="row">

                <div class="col-md-12">

                        <div class="bwhd-admin-contentpane-page-header">

                                <div class="bwhd-admin-contentpane-page-header-title">
                                        <span class="bwhd-admin-ticketslist-number-viewticketpage"><span id="bwhd_admin_rightpane_page_header_title_number"></span></span>
                                        <span id="bwhd_admin_rightpane_page_header_title_span"></span>
                                </div>
                                <button class="btn btn-secondary pull-right bwhd-admin-contentpane-page-header-bigbuttons" onclick="bwhd_admin_ticketsview_goback();">
                                        <i class="fa fa-arrow-left" aria-hidden="true"></i> <?php _e("Go Back", "bravowp-helpdesk"); ?>
                                </button>

                        </div>

                </div>

                <div class="clear"></div>

        </div>

        <div class="row">

                <!-- main panel -->
                <div class="col-md-7">

                        <div class="bwhd-admin-contentpane-page-wrapper" style="padding-right:0px;">

                                <div class="bwhd-admin-contentpane-panel bwhd-admin-contentpane-panel-default">

                                        <div class="bwhd-admin-contentpane-panel-title">
                                                <?php _e("Support Ticket Details", "bravowp-helpdesk"); ?>
                                        </div>

                                        <!-- title and description -->
                                        <div class="row">

                                                <div class="col-md-3">
                                                        <span style="font-weight:bold;color:#58666e;"><?php _e("Ticket Title:", "bravowp-helpdesk"); ?></span>
                                                </div>
                                                <div class="col-md-9">
                                                        <span id="bwhd-admin-contentpane-control-ticketview-details-spantitle"></span>
                                                </div>

                                                <div style="height:30px;"></div>

                                                <div class="col-md-3">
                                                        <span style="font-weight:bold;color:#58666e;"><?php _e("Ticket Description:", "bravowp-helpdesk"); ?></span>
                                                </div>
                                                <div class="col-md-9">
                                                        <span id="bwhd-admin-contentpane-control-ticketview-details-spandescription"></span>
                                                </div>

                                        </div>
                                        <!--title and description  -->

                                        <div class="clear"></div>

                                        <!-- tabs bar -->
                                        <div class="row">

                                                <div class="col-md-12">

                                                        <div id="bwhd-admin-contentpane-horizontalsubmenu-ticketview" class="bwhd-admin-contentpane-horizontalsubmenu" style="margin-top:25px;">
                                                                <ul class="menu">
                                                                        <li id="bwhd-admin-contentpane-horizontalsubmenu-li-events">
                                                                                <a onclick="bwhd_admin_ticketsview_submenuclick('events');"><i class="fa fa-envelope-o"></i> <?php _e("Messages & Events", "bravowp-helpdesk"); ?></a>
                                                                        </li>
                                                                        <li id="bwhd-admin-contentpane-horizontalsubmenu-li-attachments">
                                                                                <a onclick="bwhd_admin_ticketsview_submenuclick('attachments');"><i class="fa fa-upload"></i> <?php _e("Attachments", "bravowp-helpdesk"); ?></a>
                                                                        </li>
                                                                </ul>
                                                        </div>

                                                </div>

                                        </div>
                                        <!-- tabs bar -->

                                        <!-- right panel content -->
                                        <?php include( $globals->plugin_url . "/controls/admin-dashboard-ticketview-events.php" ); ?>
                                        <?php include( $globals->plugin_url . "/controls/admin-dashboard-ticketview-attachments.php" ); ?>
                                        <!-- right panel content -->

                                        <div class="clear"></div>

                                </div>

                        </div>

                </div>
                <!-- main panel -->

                <!-- left pane widgets -->
                <div class="col-md-5  no-gutter-left">


                        <div class="bwhd-admin-contentpane-page-wrapper" style="padding-left:0px;">

                                <!-- customer panel -->
                                <div class="bwhd-admin-contentpane-panel bwhd-admin-contentpane-panel-default">

                                        <div class="bwhd-admin-contentpane-panel-title">
                                                <?php _e("Customer Info", "bravowp-helpdesk"); ?>
                                        </div>

                                        <div class="row">
                                                <div class="col-md-2" id="bwhd-admin-contentpane-control-ticketview-details-divcustomeravatar" style="min-width:52px;">
                                                </div>
                                                <div class="col-md-10">
                                                        <span class="clearfix" id="bwhd-admin-contentpane-control-ticketview-details-lblcustomername"></span>
                                                        <span id="bwhd-admin-contentpane-control-ticketview-details-lblcustomeremail"></span>
                                                </div>
                                        </div>

                                        <div class="clear"></div>

                                </div>
                                <!-- customer panel -->

                                <!-- tickets properties -->
                                <div class="bwhd-admin-contentpane-panel bwhd-admin-contentpane-panel-default" style="margin-top:10px;">

                                        <div class="bwhd-admin-contentpane-panel-title">
                                                <?php _e("Tickets Properties", "bravowp-helpdesk"); ?>
                                        </div>


                                        <div class="row">
                                                <div class="col-md-6 form-group">
                                                        <label class="form-label bwhd-admin-label-required"><?php _e("Ticket Status", "bravowp-helpdesk"); ?></label>
                                                        <div class="clear"></div>
                                                        <select id="bwhd-admin-contentpane-control-ticketview-details-ddlstatus" class="form-control" >
                                                                <?php

                                                                $status_array = bwhd_controllers_status_list();
                                                                foreach( $status_array as $status_info )
                                                                {
                                                                        echo "<option value='" . $status_info->status_id . "'>" . $status_info->status_description . "</option>";
                                                                }

                                                                ?>
                                                        </select>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                        <label class="form-label bwhd-admin-label-required"><?php _e("Ticket Category", "bravowp-helpdesk"); ?></label>
                                                        <div class="clear"></div>
                                                        <select id="bwhd-admin-contentpane-control-ticketview-details-ddlcategory" class="form-control">
                                                                <?php

                                                                $categories_array = bwhd_controllers_categories_list();
                                                                foreach( $categories_array as $categories_info )
                                                                {
                                                                        echo "<option value='" . $categories_info["category_id"] . "'>" . $categories_info["category_name"] . "</option>";
                                                                }

                                                                ?>
                                                        </select>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                        <label class="form-label"><?php _e("Ticket Priority", "bravowp-helpdesk"); ?></label>
                                                        <div class="clear"></div>
                                                        <select id="bwhd-admin-contentpane-control-ticketview-details-ddlpriority" class="form-control">
                                                                <?php

                                                                $priorities_array = bwhd_controllers_priorities_list();
                                                                foreach( $priorities_array as $priorities_info )
                                                                {
                                                                        echo "<option value='" . $priorities_info->priority_id . "'>" . $priorities_info->priority_description . "</option>";
                                                                }

                                                                ?>
                                                        </select>
                                                </div>
                                                <?php if ( bwhd_globals_woocommerceactive() && get_option("bwhd_enablewoocommerceintegration", "no") == "yes") { ?>
                                                <div class="col-md-6 form-group">
                                                        <label class="form-label"><?php _e("Product", "bravowp-helpdesk"); ?></label>
                                                        <div class="clear"></div>
                                                        <select id="bwhd-admin-contentpane-control-ticketview-details-ddlproduct" class="form-control">
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
                                                <?php } ?>
                                        </div>
                                        <div class="row">
                                                <div class="col-md-12">
                                                        <a class="btn btn-success" onclick="bwhd_admin_ticketsview_savesingleticket();"><i class="fa fa-floppy-o" aria-hidden="true"></i><?php _e("Save Ticket Properties", "bravowp-helpdesk"); ?></a>
                                                        <div id="bwhd-admin-contentpane-control-saveticket-validation" class="alert alert-warning text-center" role="alert" style="display:none;margin-top:20px;"><i class="fa fa-exclamation bhwd-alert-redicon"></i><span></span></div>
                                                        <div id="bwhd-admin-contentpane-control-saveticket-success" class="alert alert-success text-center" role="alert" style="display:none;margin-top:20px;"><span><?php _e("Ticket Properties were updated", "bravowp-helpdesk"); ?>.</span></div>
                                                </div>
                                        </div>

                                        <div class="clear"></div>

                                </div>
                                <!-- tickets properties -->

                        </div>


                </div>
                <!-- left pane widgets -->

        </div>

</div>
