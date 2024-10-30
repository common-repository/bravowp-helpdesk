<?php

//Loading client resources, like style sheets and scripts
bwhd_globals_includeresources_frontendpages();

//08/02/2017
//adds support for redirect after registration, included only when front end is included and rendered
function bwhd_registration_redirect(){
    wp_redirect( get_permalink() );
    exit;
}
add_filter( 'registration_redirect', 'bwhd_registration_redirect' );

?>


<div class="bwhd">

	<?php include( $globals->plugin_url . "/controls/frontend-home.php" ); ?>
	<?php include( $globals->plugin_url . "/controls/frontend-ticketnew.php" ); ?>
	<?php include( $globals->plugin_url . "/controls/frontend-ticketedit.php" ); ?>
	<?php include( $globals->plugin_url . "/controls/frontend-ticketslist.php" ); ?>
	<?php include( $globals->plugin_url . "/controls/frontend-ticketthanks.php" ); ?>

</div>

<div class="clear"></div>

<div style="display:none;">
	Zone:<span id="bwhd_frontend_var_currentzone">dashboard</span>
	&nbsp;&nbsp;||&nbsp;&nbsp;
	CurrentTicketId:<span id="bwhd_frontend_var_currentticketid">0</span>
</div>
