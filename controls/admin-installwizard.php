
<div id="bwhd-admin-installwizard-topbar">

        <img src="<?php echo bwhd_globals()->headerpng_url; ?>" style="height:25px;margin-top: 8px;float:left;">

        <div class="progress" style="width:200px;float:right;margin-right:10px;margin-top:10px;">
                <div class="progress-bar-success" id="bwhd-admin-installwizard-progressbar">
                </div>
        </div>

        <div style="float:right;margin-top:10px;font-size:90%;margin-right:10px;"><?php _e("Installation Progress:", "bravowp-helpdesk"); ?></div>

</div>

<div id="bwhd-admin-installwizard">

        <div id="bwhd-admin-installwizard-panel0-start" >
                <div class="bwhd-admin-installwizard-title"><?php _e("Welcome to BravoWP Helpdesk", "bravowp-helpdesk"); ?></div>
                <img src="<?php echo bwhd_globals()->plugin_httpurl; ?>/images/helpdesklogo.png" style="height: 196px;">
                <div style="margin-top:30px;"><?php _e("Thank you for installing BravoWP Helpdesk! We hope you enjoy our work.", "bravowp-helpdesk"); ?></div>
                <div><?php _e("This wizard will guide you through the installation and first configuration of your Helpdesk. You can change all of these settings also at a later time.", "bravowp-helpdesk"); ?></div>
        </div>

        <div id="bwhd-admin-installwizard-panel1-fronend">

                <div class="bwhd-admin-installwizard-title"><?php _e("Helpdesk for your Customers", "bravowp-helpdesk"); ?></div>
                <div style="margin-top:30px;"><?php _e("In this section you can configure the front-end part of this plugin, which is, the form that will be available to your customers on your website. With this front-end, your visitors will be able to create new support tickets and, if registered users, to manage their existing tickets.", "bravowp-helpdesk"); ?></div>

                <form class="form-horizontal">

                        <div class="form-group" style="margin-top:30px;">
                                <?php _e("Allow Customers to open Support Tickets?", "bravowp-helpdesk"); ?>
                                <select class="form-control form-control-force-auto-width" id="bwhd-admin-installwizard-panel1-frontend-dd-usefrontend" style="text-align:center;margin:auto;margin-top:10px;" onchange="bwhd_admin_installwizard_usehelpdeskddchange()" >
                                        <option value="yes" selected="selected"> <?php _e("Yes", "bravowp-helpdesk"); ?> </option>
                                        <option value="no"> <?php _e("No", "bravowp-helpdesk"); ?> </option>
                                </select>
                                <div class="clear"></div>
                        </div>

                        <div class="form-group" style="margin-top:30px;" id="bwhd-admin-installwizard-panel1-frontend-field-createnewpageforhelpdesk">
                                <?php _e("Create New Page for Helpdesk Front-end?", "bravowp-helpdesk"); ?>
                                <select class="form-control form-control-force-auto-width" id="bwhd-admin-installwizard-panel1-frontend-dd-createnewpage" style="text-align:center;margin:auto;margin-top:10px;" >
                                        <option value="yes" selected="selected"> <?php _e("Yes", "bravowp-helpdesk"); ?> </option>
                                        <option value="no"> <?php _e("No", "bravowp-helpdesk"); ?> </option>
                                </select>
                                <div class="clear"></div>
                        </div>

                        <div class="form-group" style="margin-top:30px;" id="bwhd-admin-installwizard-panel1-frontend-field-nameofhelpdeskpage">
                                <?php _e("Name of the page for Helpdesk Front-end?", "bravowp-helpdesk"); ?>
                                <input value="Helpdesk" type="text" class="form-control form-control-force-auto-width" id="bwhd-admin-installwizard-panel1-frontend-tx-nameofhelpdeskpage" style="text-align:center;margin:auto;margin-top:10px;" >
                                </input>
                                <div class="clear"></div>
                                <div id="bwhd-admin-installwizard-panel1-frontend-tx-nameofhelpdeskpage-validator" style="margin-top:10px;display:none;" class="alert alert-warning"><?php _e("Please type a name for the new page.", "bravowp-helpdesk"); ?></div>
                                <div class="clear"></div>
                        </div>

                        <div class="form-group" style="margin-top:30px;" id="bwhd-admin-installwizard-panel1-frontend-field-allowunregisteredusers">
                                <?php _e("Allow Unregistered Users to open Support Tickets?", "bravowp-helpdesk"); ?>
                                <select class="form-control form-control-force-auto-width" id="bwhd-admin-installwizard-panel1-frontend-dd-allowunregistered" style="text-align:center;margin:auto;margin-top:10px;" >
                                        <option value="yes"> <?php _e("Yes", "bravowp-helpdesk"); ?> </option>
                                        <option value="no" selected="selected"> <?php _e("No", "bravowp-helpdesk"); ?> </option>
                                </select>
                                <div class="clear"></div>
                        </div>

                </form>

        </div>

        <div id="bwhd-admin-installwizard-panel2-emailaddress">

                <div class="bwhd-admin-installwizard-title"><?php _e("Helpdesk Email Address", "bravowp-helpdesk"); ?></div>
                <div style="margin-top:30px;"><?php _e("Please type the email address that will be used as 'Sender' for Helpdesk email notifications. Note: this must not necesarily match the email that you may use for Email-To-Ticket process.", "bravowp-helpdesk"); ?></div>

                <form class="form-horizontal">

                        <div class="form-group" style="margin-top:30px;">
                                <?php _e("Email Address for Helpdesk", "bravowp-helpdesk"); ?>
                                <input value="support@yourcompany.com" type="text" class="form-control form-control-force-auto-width" id="bwhd-admin-installwizard-panel2-emailaddress-tx-emailaddress" style="text-align:center;margin:auto;margin-top:10px;width:300px !important;" >
                                </input>
                                <div class="clear"></div>
                                <div id="bwhd-admin-installwizard-panel2-emailaddress-tx-emailaddress-validator" style="margin-top:10px;display:none;" class="alert alert-warning"><?php _e("Please type a valid email address.", "bravowp-helpdesk"); ?></div>
                                <div class="clear"></div>
                        </div>

                </form>

        </div>

        <div id="bwhd-admin-installwizard-panel3-ecommerce">

                <div class="bwhd-admin-installwizard-title"><?php _e("Connect to Ecommerce", "bravowp-helpdesk"); ?></div>
                <div style="margin-top:30px;"><?php _e("BravoWP Helpdesk integrates with your e-commerce plugins and can link Support Tickets to your Products.", "bravowp-helpdesk"); ?></div>

                <form class="form-horizontal">

                        <div class="form-group" style="margin-top:30px;">
                                <?php _e("Display Products dropdown when creating/editing Tickets?", "bravowp-helpdesk"); ?>

                                <?php
                                        if ( bwhd_globals_woocommerceactive() == true )
                                        {
                                ?>

                                <select class="form-control form-control-force-auto-width" id="bwhd-admin-installwizard-panel3-ecommerce-dd-use" style="text-align:center;margin:auto;margin-top:10px;" >
                                        <option value="yes" selected="selected"> <?php _e("Yes, read Products from my WooCommerce Shop", "bravowp-helpdesk"); ?> </option>
                                        <option value="no"> <?php _e("No, thank you", "bravowp-helpdesk"); ?> </option>
                                </select>
                                <div class="clear"></div>

                                <?php
                                        }
                                        else
                                        {
                                ?>

                                <select class="form-control form-control-force-auto-width" id="bwhd-admin-installwizard-panel3-ecommerce-dd-use" style="text-align:center;margin:auto;margin-top:10px;" >
                                        <option value="no"> <?php _e("No, I do not use E-Commerce plugins at the moment", "bravowp-helpdesk"); ?> </option>
                                </select>
                                <div class="clear"></div>

                                <?php
                                        }
                                ?>

                        </div>

                </form>

        </div>

        <div id="bwhd-admin-installwizard-panel4-emailfetch">

                <div class="bwhd-admin-installwizard-title"><?php _e("Email to Tickets", "bravowp-helpdesk"); ?></div>
                <div style="margin-top:30px;"><?php _e("BravoWp Helpdesk can check an email address at regular intervals and convert the existing emails into Support Tickets. This way, your customer can write to an email address (for example support@mycompany.com) and Helpdesk Agents will see a new Support Ticket automatically.", "bravowp-helpdesk"); ?></div>

                <div class="alert alert-info" style="margin-top:30px;"><?php _e("The Email Fetch system is turned off by default. Please go to 'Settings' page after installation to setup this process.", "bravowp-helpdesk"); ?></div>

        </div>

        <div id="bwhd-admin-installwizard-panel5-finish">

                <div class="bwhd-admin-installwizard-title"><?php _e("All Done!", "bravowp-helpdesk"); ?></div>
                <div style="margin-top:30px;"><?php _e("Congratulations! You are now ready to use your new Helpdesk System. Click on the button below to finalize your installation!", "bravowp-helpdesk"); ?></div>

        </div>

        <div class="bwhd-admin-installwizard-buttonspanel">
                <a onclick="bwhd_admin_installwizard_moveback()" id="bwhd-admin-installwizard-btnbackward" href="#" class="btn btn-default"><?php _e("Go Back", "bravowp-helpdesk"); ?></a>
                <a onclick="bwhd_admin_installwizard_movenext()" id="bwhd-admin-installwizard-btnforward" href="#" class="btn btn-success"><?php _e("Next", "bravowp-helpdesk"); ?></a>
                <a onclick="bwhd_admin_installwizard_movenext()" id="bwhd-admin-installwizard-btnstart" href="#" class="btn btn-success"><?php _e("Start Installation", "bravowp-helpdesk"); ?></a>
                <a onclick="bwhd_admin_installwizard_update()" id="bwhd-admin-installwizard-btnfinalize" href="#" class="btn btn-success"><?php _e("Finish Installation", "bravowp-helpdesk"); ?></a>
        </div>

</div>
