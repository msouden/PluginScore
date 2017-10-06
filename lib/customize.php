<?php

/**
 * Customizer additions.
 *
 * @package pluginscore Pro
 * @author  StudioPress
 * @link    http://my.studiopress.com/themes/pluginscore/
 * @license GPL2-0+
 */

/**
 * Get default accent color for Customizer.
 *
 * Abstracted here since at least two functions use it.
 *
 * @since 1.0.0
 *
 * @return string Hex color code for accent color.
 */
 
function pluginscore_customizer_get_default_accent_color() {
	return '#e85555';
}

add_action( 'customize_register', 'pluginscore_customizer_register' );
/**
 * Register settings and controls with the Customizer.
 *
 * @since 1.0.0
 * 
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function pluginscore_customizer_register() {

	global $wp_customize;

	$wp_customize->add_section( 'pluginscore-image', array(
		'title'          => __( 'Front Page Image', 'pluginscore' ),
		'description'    => __( '<p>Use the default image or personalize your site by uploading your own image for the front page 1 widget background.</p><p>The default image is <strong>1600 x 1050 pixels</strong>.</p>', 'pluginscore' ),
		'priority'       => 75,
	) );

	$wp_customize->add_setting( 'pluginscore-front-image', array(
		'default'  => sprintf( '%s/images/front-page-1.jpg', get_stylesheet_directory_uri() ),
		'type'     => 'option',
	) );
	 
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'front-background-image',
			array(
				'label'       => __( 'Front Image Upload', 'pluginscore' ),
				'section'     => 'pluginscore-image',
				'settings'    => 'pluginscore-front-image',
			)
		)
	);

	$wp_customize->add_setting(
		'pluginscore_accent_color',
		array(
			'default'           => pluginscore_customizer_get_default_accent_color(),
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'pluginscore_accent_color',
			array(
				'description' => __( 'Change the default color for button hover and the footer widget background.', 'pluginscore' ),
			    'label'       => __( 'Accent Color', 'pluginscore' ),
			    'section'     => 'colors',
			    'settings'    => 'pluginscore_accent_color',
			)
		)
	);

    //* Add front page setting to the Customizer
    $wp_customize->add_section( 'pluginscore_journal_section', array(
        'title'    => __( 'Front Page Content Settings', 'pluginscore' ),
        'description' => __( 'Choose if you would like to display the content section below widget sections on the front page.', 'pluginscore' ),
        'priority' => 75.01,
    ));

    //* Add front page setting to the Customizer
    $wp_customize->add_setting( 'pluginscore_journal_setting', array(
        'default'           => 'true',
        'capability'        => 'edit_theme_options',
        'type'              => 'option',
    ));

    $wp_customize->add_control( new WP_Customize_Control( 
        $wp_customize, 'pluginscore_journal_control', array(
			'label'       => __( 'Front Page Content Section Display', 'pluginscore' ),
			'description' => __( 'Show or Hide the content section. The section will display on the front page by default.', 'pluginscore' ),
			'section'     => 'pluginscore_journal_section',
			'settings'    => 'pluginscore_journal_setting',
			'type'        => 'select',
			'choices'     => array(                    
				'false'   => __( 'Hide content section', 'pluginscore' ),
				'true'    => __( 'Show content section', 'pluginscore' ),
			),
        ))
	);
	
    $wp_customize->add_setting( 'pluginscore_journal_text', array(
		'default'           => __( 'Our Journal', 'pluginscore' ),
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'wp_kses_post',
		'type'              => 'option',
    ));

    $wp_customize->add_control( new WP_Customize_Control( 
        $wp_customize, 'pluginscore_journal_text_control', array(
			'label'      => __( 'Journal Section Heading Text', 'pluginscore' ),
			'description' => __( 'Choose the heading text you would like to display above posts on the front page.<br /><br />This text will show when displaying posts and using widgets on the front page.', 'pluginscore' ),
			'section'    => 'pluginscore_journal_section',
			'settings'   => 'pluginscore_journal_text',
			'type'       => 'text',
		))
	);

}
