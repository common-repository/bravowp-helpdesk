<div class="row">

        <div class="col-md-12" style="margin-top:20px;">
                <?php _e("In this section you can configure BravoWP Helpdesk to check an email box at your preferred time interval, and convert any email that is found to a new Helpdesk Ticket. You will find the created Ticket in the Tickets list page.", "bravowp-helpdesk"); ?>
                <div class="clear" style="height:20px;"></div>
        </div>

        <div class="col-md-8">

                <div class="bwhd-admin-contentpane-panel bwhd-admin-contentpane-panel-default">

                        <div class="bwhd-admin-contentpane-inner-panel">

                                <div class="bwhd-admin-contentpane-inner-panel-title"><?php _e("Mailbox Check Settings", "bravowp-helpdesk"); ?></div>

                                <div class="bwhd-admin-contentpane-inner-panel-body">

                                        <div class="form-group bwhd-admin-settings-group">

                                                <label class="col-sm-4 control-label bwhd-admin-setting-label"><?php _e("Enable Email Fetching?", "bravowp-helpdesk"); ?></label>

                                                <div class="col-sm-8">
                                                        <select class="form-control form-control-force-auto-width" id="bwhd-admin-contentpane-control-settings-emailtoticket-dd-enable" >
                                                                <option value="no" <?php if ( get_option( "bwhd_emailtoticket_enabled", "no" ) == "no" ) { echo "selected"; } ?>> <?php _e("Off", "bravowp-helpdesk"); ?></option>
                                                                <option value="yes_tenminutes" <?php if ( get_option( "bwhd_emailtoticket_enabled", "no" ) == "yes_tenminutes" ) { echo "selected"; } ?>> <?php _e("Every 10 Minutes", "bravowp-helpdesk"); ?></option>
                                                                <option value="yes_onehour" <?php if ( get_option( "bwhd_emailtoticket_enabled", "no" ) == "yes_onehour" ) { echo "selected"; } ?>> <?php _e("Every Hour", "bravowp-helpdesk"); ?></option>
                                                                <option value="yes_threehours" <?php if ( get_option( "bwhd_emailtoticket_enabled", "no" ) == "yes_threehours" ) { echo "selected"; } ?>> <?php _e("Every 3 Hours", "bravowp-helpdesk"); ?></option>
                                                                <option value="yes_oneday" <?php if ( get_option( "bwhd_emailtoticket_enabled", "no" ) == "yes_oneday" ) { echo "selected"; } ?>> <?php _e("Once per Day", "bravowp-helpdesk"); ?></option>
                                                        </select>
                                                </div>

                                                <div class="clear"></div>

                                        </div>

                                        <div class="form-group bwhd-admin-settings-group">

                                                <label class="col-sm-4 control-label bwhd-admin-setting-label"><?php _e("Service Type", "bravowp-helpdesk"); ?></label>

                                                <div class="col-sm-8">
                                                        <select class="form-control form-control-force-auto-width" id="bwhd-admin-contentpane-control-settings-emailtoticket-dd-servertype" onchange="bwhd_admin_settings_emailtoticket_showhideoptionsforservice()" >
                                                                <option value="custom" <?php if ( get_option( "bwhd_emailtoticket_servicetype", "custom" ) == "custom" ) { echo "selected"; } ?>> <?php _e("Other Email Providers", "bravowp-helpdesk"); ?></option>
                                                                <option value="gmail" <?php if ( get_option( "bwhd_emailtoticket_servicetype", "custom" ) == "gmail" ) { echo "selected"; } ?>> <?php _e("Gmail by Google", "bravowp-helpdesk"); ?></option>
                                                        </select>
                                                        <div id="bwhd-admin-contentpane-control-settings-emailtoticket-dd-servertype_infogmailbutton"><i class="fa fa-info" style="color:red;"></i>&nbsp;<span style="font-size:10px;"><?php _e("Note on connecting to Gmail Service, <a onclick='bwhd_admin_settings_emailtoticket_opengmailhelpmodal();'>click here</a>", "bravowp-helpdesk"); ?></span></div>
                                                </div>

                                                <div class="clear"></div>

                                        </div>

                                        <div class="form-group bwhd-admin-settings-group">

                                                <label class="col-sm-4 control-label bwhd-admin-setting-label"><?php _e("Username", "bravowp-helpdesk"); ?></label>

                                                <div class="col-sm-8">
                                                        <input class="form-control form-control-force-auto-width" type="text" id="bwhd-admin-contentpane-control-settings-emailtoticket-tx-username" value="<?php echo get_option( "bwhd_emailtoticket_username", "" ); ?>" ></input>
                                                </div>

                                                <div class="clear"></div>

                                        </div>

                                        <div class="form-group bwhd-admin-settings-group">

                                                <label class="col-sm-4 control-label bwhd-admin-setting-label"><?php _e("Password", "bravowp-helpdesk"); ?></label>

                                                <div class="col-sm-8">
                                                        <input class="form-control form-control-force-auto-width" type="password" id="bwhd-admin-contentpane-control-settings-emailtoticket-tx_password" value="<?php echo get_option( "bwhd_emailtoticket_password", "" ); ?>" ></input>
                                                </div>

                                                <div class="clear"></div>

                                        </div>

                                        <div class="form-group bwhd-admin-settings-group" id="bwhd-admin-contentpane-control-settings-emailtoticket-server-div">

                                                <label class="col-sm-4 control-label bwhd-admin-setting-label"><?php _e("Server", "bravowp-helpdesk"); ?></label>

                                                <div class="col-sm-8">
                                                        <input class="form-control form-control-force-auto-width" type="text" id="bwhd-admin-contentpane-control-settings-emailtoticket-tx-server" value="<?php echo get_option( "bwhd_emailtoticket_server", "" ); ?>" ></input>
                                                </div>

                                                <div class="clear"></div>

                                        </div>

                                        <div class="form-group bwhd-admin-settings-group" id="bwhd-admin-contentpane-control-settings-emailtoticket-port-div">

                                                <label class="col-sm-4 control-label bwhd-admin-setting-label"><?php _e("Port", "bravowp-helpdesk"); ?></label>

                                                <div class="col-sm-8">
                                                        <input class="form-control form-control-force-auto-width" type="text" id="bwhd-admin-contentpane-control-settings-emailtoticket-tx-port" value="<?php echo get_option( "bwhd_emailtoticket_port", "" ); ?>" ></input>
                                                </div>

                                                <div class="clear"></div>

                                        </div>

                                        <div class="clear"></div>



                                        <?php
                                        if (bwhd_demo_is_active() == 1)
                                        {

                                                ?>

                                                <div class="alert alert-warning text-center">
                                                        <?php _e("Editing these Settings is denied in Public Demo.", "bravowp-helpdesk") ?>
                                                </div>

                                                <?php

                                        }
                                        else
                                        {

                                                ?>

                                                <a class="btn btn-success" onclick="bwhd_admin_settings_emailtoticket_save();"><i class="fa fa-floppy-o" aria-hidden="true"></i><?php _e("Save Email To Ticket Settings", "bravowp-helpdesk"); ?></a>

                                                <?php

                                        }
                                        ?>

                                        <div class="clear"></div>

                                        <div id="bwhd-admin-contentpane-control-settings-emailtoticket-saved-success" class="alert alert-success text-center" style="margin-top: 20px;display:none;" role="alert">
                                                <span>Ticket Properties were updated.</span>
                                        </div>

                                </div>

                        </div>

                </div>

        </div>

        <div class="col-md-4">

                <div class="bwhd-admin-contentpane-panel bwhd-admin-contentpane-panel-default">

                        <div class="bwhd-admin-contentpane-inner-panel">

                                <div class="bwhd-admin-contentpane-inner-panel-title"><?php _e("Email Fetching Test", "bravowp-helpdesk"); ?></div>

                                <div class="bwhd-admin-contentpane-inner-panel-body">

                                        <a class="btn btn-success" onclick="bwhd_admin_settings_emailtoticket_test();"><i class="fa fa-floppy-o" aria-hidden="true"></i><?php _e("Test Settings", "bravowp-helpdesk"); ?></a>

                                        <div class="clear"></div>

                                        <div id="bwhd-admin-contentpane-control-settings-emailtoticket-div_logresult">
                                        </div>

                                        <div class="clear"></div>

                                </div>

                        </div>

                </div>

        </div>

</div>

<div id="bwhd-admin-settings-emailtoticket-modalinfogmail" class="modal fade">

        <div class="modal-dialog" style="width: 60%;">

                <div class="modal-content">

                        <div class="modal-header">
                                <button class="close" type="button" data-dismiss="modal">×</button>
                                <h4 class="modal-title"><?php _e("Information on using GMail", "bravowp-helpdesk") ?></h4>
                        </div>

                        <div class="modal-body">

                                <div class="row">

                                        <div class="col-md-12">

                                                <?php _e("If you are trying to connect to your Gmail account to transform the unread emails into Support Ticket, please note that you might receive an access denial by Google's policies. To allow access to your Gmail, you should enable applications to connect to it. Please follow this guide:", "bravowp-helpdesk") ?>
                                                <br><br>
                                                <a class="btn btn-success" href="https://support.google.com/accounts/answer/6010255?hl=en" target="new"><?php _e("Allow access to your Gmail tutorial", "bravowp-helpdesk") ?></a>

                                        </div>

                                        <div class="clear"></div>

                                </div>


                        </div>

                        <div class="modal-footer">

                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                        <i class="fa fa-arrow-left" aria-hidden="true"></i><?php _e("Got it", "bravowp-helpdesk") ?>
                                </button>

                        </div>

                </div>

        </div>

</div>
