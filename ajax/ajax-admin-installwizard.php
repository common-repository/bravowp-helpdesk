<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

//this function is called to finalize the installation wizard
function ajax_admin_installwizard_finish() {



	bwhd_systemlog_addentry("FUNCTION","ajax_admin_installwizard_finish","Start");

	try
	{

		if (bwhd_demo_is_active() == 1)
		{
			return 0;
		}

		$post_panel1_usefrontend = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['panel1_usefrontend']) ));
		$post_panel1_createnewpage = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['panel1_createnewpage']) ));
		$post_panel1_nameofpage = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['panel1_nameofpage']) ));
		$post_panel1_allowunregistered = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['panel1_allowunregistered']) ));
		$post_panel2_emailaddress = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['panel2_emailaddress']) ));
		$post_panel3_useecommerce = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['panel3_useecommerce']) ));

		if ( $post_panel1_usefrontend == "yes" )
		{
			if ( $post_panel1_createnewpage == "yes" )
			{

				//create page
				$post_id = wp_insert_post(
				array(
					'comment_status'  => 'closed',
					'ping_status'   => 'closed',
					'post_author'   => get_current_user_id(),
					'post_name'   => "helpdesk",
					'post_title'    => $post_panel1_nameofpage,
					'post_status'   => 'publish',
					'post_type'   => 'page',
					'post_content'  =>  '[bravowp-helpdesk-frontend]'
				));

			}
		}

		update_option( "bwhd_allowticketunregistered", $post_panel1_allowunregistered, "yes" );
		update_option( "bwhd_helpdeskemail", $post_panel2_emailaddress, "yes" );
		update_option( "bwhd_enablewoocommerceintegration", $post_panel3_useecommerce, "yes" );

		update_option( "bwhd_doInstallWizard", "no", "yes" );

		bwhd_systemlog_addentry("FUNCTION","ajax_admin_installwizard_finish","End");

	}

	catch (Exception $e)
	{
		bwhd_systemlog_addentry("ERROR", "ajax_admin_installwizard_finish", $e->getMessage());
	}

	bwhd_systemlog_addentry("FUNCTION","ajax_admin_installwizard_finish","End");

}


?>
