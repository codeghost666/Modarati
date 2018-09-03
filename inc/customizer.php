<?php
function tm_customizer_settings($wp_customize) {
	/*
	 * THEME SETTINGS SECTION
	 */
	$wp_customize->add_section(
		'theme_settings_section',
		array(
			'title'     => __('Theme settings', 'modarati'),
			'priority'  => 210,
		)
	);
	/*
	 * END OF THEME SETTINGS SECTION
	 */

	/*
	 * THEME SOCIALS SECTION
	 */
	$wp_customize->add_section(
		'theme_socials',
		array(
		'title'     => __('Social links', 'modarati'),
		'priority'  => 211,
	) );
	/*
	 * END OF THEME SOCIALS SECTION
	 */

	/*
	 * HEADER TEXT
	 */
	$wp_customize->add_setting(
		'text_header',
		array(
			'transport' => 'refresh',
			'type'      => 'option'
		)
	);

	$wp_customize->add_control(
		'text_header',
		array(
			'label'     => 'Text in header',
			'section'   => 'theme_settings_section',
			'settings'  => 'text_header',
			'type'      => 'text',
		)
	);
	/*
	 * END OF HEADER TEXT
	 */

	/*
	 * FOOTER TEXT
	 */
	$wp_customize->add_setting(
		'text_footer',
		array(
			'transport' => 'refresh',
			'type'      => 'option'
		)
	);

	$wp_customize->add_control(
		'text_footer',
		array(
			'label'     => 'Text in footer',
			'section'   => 'theme_settings_section',
			'settings'  => 'text_footer',
			'type'      => 'text',
		)
	);
	/*
	 * END OF FOOTER TEXT
	 */

	/*
	 * Buyers Sign Up title
	 */
	$wp_customize->add_setting(
		'buyers_title_signup',
		array(
			'transport' => 'refresh',
			'type'      => 'option'
		)
	);

	$wp_customize->add_control(
		'buyers_title_signup',
		array(
			'label'     => 'Buyers Sign Up title',
			'section'   => 'theme_settings_section',
			'settings'  => 'buyers_title_signup',
			'type'      => 'text',
		)
	);
	/*
	 * END OF Sign Up title
	 */

	/*
	 * Buyers Sign up TEXT
	 */
	$wp_customize->add_setting(
		'buyers_text_signup',
		array(
			'transport' => 'refresh',
			'type'      => 'option'
		)
	);

	$wp_customize->add_control(
		'buyers_text_signup',
		array(
			'label'     => 'Buyers Sign Up text',
			'section'   => 'theme_settings_section',
			'settings'  => 'buyers_text_signup',
			'type'      => 'textarea',
		)
	);
	/*
	 * END OF Sign Up TEXT
	 */


/*
	 * SELECT TEXT
	 */
	$wp_customize->add_setting(
		'select_text',
		array(
			'transport' => 'refresh',
			'type'      => 'option'
		)
	);

	$wp_customize->add_control(
		'select_text',
		array(
			'label'     => 'Select text',
			'section'   => 'theme_settings_section',
			'settings'  => 'select_text',
			'type'      => 'textarea',
		)
	);
	/*
	 * END OF SELECT TEXT
	 */

///////

/*
	 * Brands Sign Up title
	 */
	$wp_customize->add_setting(
		'brands_title_signup',
		array(
			'transport' => 'refresh',
			'type'      => 'option'
		)
	);

	$wp_customize->add_control(
		'brands_title_signup',
		array(
			'label'     => 'Brands Sign Up title',
			'section'   => 'theme_settings_section',
			'settings'  => 'brands_title_signup',
			'type'      => 'text',
		)
	);
	/*
	 * END OF Brands Sign Up title
	 */

	/*
	 * Brands Sign up TEXT
	 */
	$wp_customize->add_setting(
		'brands_text_signup',
		array(
			'transport' => 'refresh',
			'type'      => 'option'
		)
	);

	$wp_customize->add_control(
		'brands_text_signup',
		array(
			'label'     => 'Brands Sign Up text',
			'section'   => 'theme_settings_section',
			'settings'  => 'brands_text_signup',
			'type'      => 'textarea',
		)
	);
	/*
	 * END OF Brands Sign Up TEXT
	 */

///////

	/*
	 * Contact us title
	 */
	$wp_customize->add_setting(
		'title_contactus',
		array(
			'transport' => 'refresh',
			'type'      => 'option'
		)
	);

	$wp_customize->add_control(
		'title_contactus',
		array(
			'label'     => 'Contact us title',
			'section'   => 'theme_settings_section',
			'settings'  => 'title_contactus',
			'type'      => 'text',
		)
	);
	/*
	 * END OF Contact us title
	 */

	/*
	 * Contact us text
	 */
	$wp_customize->add_setting(
		'text_contactus',
		array(
			'transport' => 'refresh',
			'type'      => 'option'
		)
	);

	$wp_customize->add_control(
		'text_contactus',
		array(
			'label'     => 'Contact us text',
			'section'   => 'theme_settings_section',
			'settings'  => 'text_contactus',
			'type'      => 'textarea',
		)
	);
	/*
	 * END OF Contact us text
	 */

	/*
	 * 404 error text
	 */
	$wp_customize->add_setting(
		'404_error_message_text',
		array(
			'transport' => 'refresh',
			'type'      => 'option'
		)
	);

	$wp_customize->add_control(
		'404_error_message_text',
		array(
			'label'     => '404 Error message',
			'section'   => 'theme_settings_section',
			'settings'  => '404_error_message_text',
			'type'      => 'textarea',
		)
	);
	/*
	 * END OF 404 error text
	 */

	/*
	 * POPUP TITLE
	 */
	$wp_customize->add_setting(
		'popup_title',
		array(
			'transport' => 'refresh',
			'type'      => 'option'
		)
	);

	$wp_customize->add_control(
		'popup_title',
		array(
			'label'     => 'PopUp title',
			'section'   => 'theme_settings_section',
			'settings'  => 'popup_title',
			'type'      => 'text',
		)
	);
	/*
	 * END OF 404 POPUP TITLE
	 */

	/*
	 * POPUP TEXT
	 */
	$wp_customize->add_setting(
		'popup_text',
		array(
			'transport' => 'refresh',
			'type'      => 'option'
		)
	);

	$wp_customize->add_control(
		'popup_text',
		array(
			'label'     => 'PopUp text',
			'section'   => 'theme_settings_section',
			'settings'  => 'popup_text',
			'type'      => 'textarea',
		)
	);
	/*
	 * END OF POPUP TEXT
	 */

	/*
	 * ADMIN EMAIL
	 */
	$wp_customize->add_setting(
		'tm_admin_email',
		array(
			'transport' => 'refresh',
			'type'      => 'option'
		)
	);

	$wp_customize->add_control(
		'tm_admin_email',
		array(
			'label'     => 'Admin Email',
			'section'   => 'theme_settings_section',
			'settings'  => 'tm_admin_email',
			'type'      => 'text',
		)
	);
	/*
	 * END OF ADMIN EMAIL
	 */

	/*
	 * FACEBOOK LINK
	 */
	$wp_customize->add_setting(
		'facebook_link',
		array(
			'transport' => 'refresh',
			'type'      => 'option'
		)
	);

	$wp_customize->add_control(
		'facebook_link',
		array(
			'label'     => 'FaceBook link',
			'section'   => 'theme_socials',
			'settings'  => 'facebook_link',
			'type'      => 'text',
		)
	);
	/*
	 * END OF FACEBOOK LINK
	 */

	/*
	 * TWITTER LINK
	 */
	$wp_customize->add_setting(
		'twitter_link',
		array(
			'transport' => 'refresh',
			'type'      => 'option'
		)
	);

	$wp_customize->add_control(
		'twitter_link',
		array(
			'label'     => 'Twitter link',
			'section'   => 'theme_socials',
			'settings'  => 'twitter_link',
			'type'      => 'text',
		)
	);
	/*
	 * END OF TWITTER LINK
	 */

	/*
	 * LINKEDIN LINK
	 */
	$wp_customize->add_setting(
		'linkedin_link',
		array(
			'transport' => 'refresh',
			'type'      => 'option'
		)
	);

	$wp_customize->add_control(
		'linkedin_link',
		array(
			'label'     => 'LinkedIn link',
			'section'   => 'theme_socials',
			'settings'  => 'linkedin_link',
			'type'      => 'text',
		)
	);
	/*
	 * END OF LINKEDIN LINK
	 */

	/*
	 * INSTAGRAM LINK
	 */
	$wp_customize->add_setting(
		'instagram_link',
		array(
			'transport' => 'refresh',
			'type'      => 'option'
		)
	);

	$wp_customize->add_control(
		'instagram_link',
		array(
			'label'     => 'Instagram link',
			'section'   => 'theme_socials',
			'settings'  => 'instagram_link',
			'type'      => 'text',
		)
	);
	/*
	 * END OF INSTAGRAM LINK
	 */
}

add_action('customize_register', 'tm_customizer_settings');

function sanitize_text($text) {
	return sanitize_text_field($text);
}

