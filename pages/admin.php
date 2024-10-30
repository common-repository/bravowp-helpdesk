<div class="bwhd container bwhd-admin-container">

<?php

$showInstallWizard = get_option( "bwhd_doInstallWizard", "yes" );

if ( $showInstallWizard == "yes" )
{
        include( $globals->plugin_url . "/controls/admin-installwizard.php" );
        exit;
}

if (bwhd_demo_is_active() == 1)
{

        ?>

        <div class="alert alert-warning text-center">
                <?php _e("This is an online Public Demo. Some of the functions are not available.", "bravowp-helpdesk") ?>
                <br>
                <?php _e("Please use a mature behaviour, thank you!", "bravowp-helpdesk") ?>
        </div>

        <?php

}

?>

        <div class="bwhd-ajax-loader" id="bwhd-admin-dashboard-loader" style="display:none;">
                <img src="<?php echo bwhd_globals()->loadergif_url; ?>" class="bwhd-ajax-loader">
        </div>

        <?php include( $globals->plugin_url . "/controls/admin-dashboard-topbar.php" ); ?>

        <div class="row">
                <div class="col-md-12">
                        <div class="bwhd-admin-contentpane">


                                <?php include( $globals->plugin_url . "/controls/admin-dashboard-ticketslist.php" ); ?>
                                <?php include( $globals->plugin_url . "/controls/admin-dashboard-ticketview.php" ); ?>
                                <?php include( $globals->plugin_url . "/controls/admin-dashboard-ticketnew.php" ); ?>
                                <?php include( $globals->plugin_url . "/controls/admin-dashboard-settings.php" ); ?>

                                <div class="clear"></div>

                        </div>
                </div>
        </div>

        <div class="clear"></div>

        <div id="bwhd-admin-footer">

                <div class="row">

                        <div class="col-md-12">

                                <?php _e("BravoWP Helpdesk - Documentation & Support: <a href='http://www.bravowp.com' target='_blank'>www.bravowp.com</a> - Wordpress plugin page: <a href='https://it.wordpress.org/plugins/bravowp-helpdesk/' target='_blank'>click here</a>", "bravowp-helpdesk"); ?>

                        </div>

                        <div class="clear"></div>

                </div>

        </div>

</div>