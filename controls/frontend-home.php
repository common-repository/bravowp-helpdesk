<div id="bwhd-frontend-controls-home" class="bwhd-frontend-panel-default">

	<div class="bwhd-frontend-panel-default-title">
		<?php _e("Welcome to our Support Page!", "bravowp-helpdesk"); ?>
	</div>

	<?php

		if ( is_user_logged_in() || get_option( "bwhd_allowticketunregistered", "no" ) == "yes" )

		{

			?>

				<span class="bwhd-frontend-span-margin-bottom">

					<?php

						if ( is_user_logged_in() == true )
						{
							_e("Welcome to our Helpdesk. If you have a problem, a question or a request for help, you can create a New Support Ticket by clicking on the following button. You can review your existing Support Tickets by clicking on the 'Search Ticket' button.", "bravowp-helpdesk");
						}
						else
						{
							_e("Welcome to our Helpdesk. If you have a problem, a question or a request for help, you can create a New Support Ticket by clicking on the following button.", "bravowp-helpdesk");
						}

					?>

				</span>

				<div>

					<div class=" bwhd-frontend-bigbutton text-center" onclick="bwhd_frontend_button_newticket_click();">
						<img class="bwhd-frontend-bigbutton-icon" src="<?php echo bwhd_globals()->plugin_httpurl; ?>/images/addticket.png">
						<div class="clearfix bwhd-frontend-bigbutton-text" ><?php _e("Create Ticket", "bravowp-helpdesk"); ?></div>
					</div>

					<?php
					if ( is_user_logged_in() == true )

						{

					?>

						<div class=" bwhd-frontend-bigbutton text-center" onclick="bwhd_frontend_button_ticketslist_click();">
							<img class="bwhd-frontend-bigbutton-icon"src="<?php echo bwhd_globals()->plugin_httpurl; ?>/images/searchtickets.png">
							<div class="clearfix bwhd-frontend-bigbutton-text"><?php _e("Search Tickets", "bravowp-helpdesk"); ?></div>
						</div>

					<?php

						}

					?>

					<div class="clearfix"></div>

				</div>

			<?php

		}
		else
		{

			?>

				<p><?php _e("Our Helpdesk is dedicated to our Registered users.", "bravowp-helpdesk"); ?></p>
				<p><?php _e("Please ", "bravowp-helpdesk");?> <a href="<?php echo wp_login_url( get_permalink() ); ?>" title="Login"><?php _e("Login", "bravowp-helpdesk");?></a> <?php _e("or", "bravowp-helpdesk");?> <a href="<?php echo wp_registration_url( get_permalink() ); ?>" title="Register"><?php _e("Register", "bravowp-helpdesk");?></a> <?php _e("to our website. Thank you!", "bravowp-helpdesk");?></p>

			<?php

		}

	?>

</div>
