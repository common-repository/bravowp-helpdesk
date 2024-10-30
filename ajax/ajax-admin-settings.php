<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

//this function is called to save the generic settings
function ajax_admin_settings_save() {

	bwhd_systemlog_addentry("FUNCTION","ajax_admin_settings_save","Start");

	try
	{

		if (bwhd_demo_is_active() == 1)
		{
			return 0;
		}

		$post_allowunregistered = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['allowticketunregistered']) ));
		$post_defaultscreenforunregistered = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['defaultscreenforunregistered']) ));
		$post_requirecaptcha = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['require_captcha']) ));
		$post_log_enable = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['enablelog']) ));
		$post_helpdeskemail = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['helpdeskemail']) ));
		$post_emailoncustomerticketcreation = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['emailoncustomerticketcreation']) ));
		$post_enablewoocommerceintegration = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['enablewoocommerceintegration']) ));

		//bwhd_log_addentry( "INFO", "Form Submit: Settings Generic Update", "Saving bwhd_allowticketunregistered:" . $setting_allowunregistered );
		update_option( "bwhd_allowticketunregistered", $post_allowunregistered, "yes" );

		//bwhd_log_addentry( "INFO", "Form Submit: Settings Generic Update", "Saving bwhd_allowticketunregistered:" . $setting_allowunregistered );
		update_option( "bwhd_defaultscreenforunregistered", $post_defaultscreenforunregistered, "yes" );

		//bwhd_log_addentry( "INFO", "Form Submit: Settings Generic Update", "Saving bwhd_allowticketunregistered:" . $setting_allowunregistered );
		update_option( "bwhd_enablewoocommerceintegration", $post_enablewoocommerceintegration, "yes" );

		//bwhd_log_addentry( "INFO", "Form Submit: Settings Generic Update", "Saving bwhd_require_captcha:" . $setting_requirecaptcha );
		update_option( "bwhd_require_captcha", $post_requirecaptcha, "yes" );

		//bwhd_log_addentry( "INFO", "Form Submit: Settings Generic Update", "Saving bwhd_log_enable:" . $setting_log_enable );
		update_option( "bwhd_log_enable", $post_log_enable, "yes" );

		//bwhd_log_addentry( "INFO", "Form Submit: Settings Generic Update", "Saving bwhd_helpdeskemail:" . $setting_log_helpdeskemail );
		update_option( "bwhd_helpdeskemail", $post_helpdeskemail, "yes" );

		update_option( "bwhd_emailoncustomerticketcreation", $post_emailoncustomerticketcreation, "yes" );

		bwhd_systemlog_addentry("FUNCTION","ajax_admin_settings_save","End");

	}

	catch (Exception $e)
	{
		bwhd_systemlog_addentry("ERROR", "ajax_admin_settings_save", $e->getMessage());
	}

	bwhd_systemlog_addentry("FUNCTION","ajax_admin_settings_save","End");

}


?>
