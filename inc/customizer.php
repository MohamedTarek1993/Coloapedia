<?php

/**
 * Coloapedia Theme Customizer
 *
 * @package Coloapedia
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function theme_for_blog_customize_register($wp_customize)
{
	$wp_customize->get_setting('blogname')->transport         = 'postMessage';
	$wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
	$wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

	// Add section
	$wp_customize->add_section('footer_settings', [
		'title' => 'Footer Settings',
		'priority' => 115,
	]);

	// Copyrights
	$wp_customize->add_setting('footer_copy_rights', [
		'default' => '',
	]);
	$wp_customize->add_control('footer_copy_rights', [
		'type' => 'text',
		'section' => 'footer_settings',
		'label' => 'Copyrights Text',
	]);

	// Footer Signature
	$wp_customize->add_setting('footer_signature', [
		'default' => '',
	]);
	$wp_customize->add_control('footer_signature', [
		'type' => 'textarea',
		'section' => 'footer_settings',
		'label' => 'Footer Signature',
	]);


	//footer Background
	$wp_customize->add_setting('footer_background', [
		'default' => '',
	]);
	$wp_customize->add_control(new WP_Customize_Media_Control(
		$wp_customize,
		'footer_background',
		[
			'label' => 'Background Footer',
			'section' => 'footer_settings',
			'mime_type' => 'image',

		]
	));

	   // Footer Color
	   $wp_customize->add_setting('footer_color', [
		'default' => '',
	]);
	$wp_customize->add_control(new WP_Customize_Color_Control(
		$wp_customize,
		'footer_color',
		[
			'label' => 'Footer Color',
			'section' => 'footer_settings',
		]
	));



	if (isset($wp_customize->selective_refresh)) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'theme_for_blog_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'theme_for_blog_customize_partial_blogdescription',
			)
		);
	}
}
add_action('customize_register', 'theme_for_blog_customize_register');

add_action('wp_head', function() {
    echo '<style>.footer{';
    $custom_footer_background = get_theme_mod('footer_background', '');
    if (!empty($custom_footer_background)) {
        echo 'background-image:url('.wp_get_attachment_image_url($custom_footer_background, 'full').');';
    }
    $footer_custom_color = get_theme_mod('footer_color', '');
    if (!empty($footer_custom_color)) {
        echo 'background-color:' . $footer_custom_color . ';';
    }
    echo '}</style>';
}, 99);

function wpc_sanitize_footer_signature($footer_signature)
{
    return wp_kses($footer_signature, [
        'a' => [
            'href' => []
        ]
    ]);
}

function wpc_validate_footer_signature($validity, $footer_signature)
{
    if (mb_strlen($footer_signature) > 100) {
        $validity->add('invalid_footer_signature', 'Footer Signature is too long');
    }
    return $validity;
}
/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function theme_for_blog_customize_partial_blogname()
{
	bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function theme_for_blog_customize_partial_blogdescription()
{
	bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function theme_for_blog_customize_preview_js()
{
	wp_enqueue_script('theme-for-blog-customizer', get_template_directory_uri() . '/js/customizer.js', array('customize-preview'), _S_VERSION, true);
}
add_action('customize_preview_init', 'theme_for_blog_customize_preview_js');
