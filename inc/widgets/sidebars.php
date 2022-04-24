

<?php

/**
 * Coloapedia Theme sidebars
 *
 * Add postMessage support for site title and description for the sidebars widgets.

 * @package Coloapedia
 */

if (!function_exists('theme_for_blog_widgets_init')) {
	function theme_for_blog_widgets_init()
	{
		register_sidebar(
			array(
				'name'          => 'Sidebar Blog',
				'id'            => 'sidebar-blog',
				'description'   => 'Belongs To Blog Sidebar',
				'class'         => 'blog-sidebar',
				'before_widget' => '<div id="%1$s" class="widget">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);

		register_sidebars( 3, [
			'name'          => 'Footer Area (%d)',
			'id'            => 'footer-area',
			'description'   => 'Belongs To Footer Area',
			'class'         => 'footer-area',
			'before_widget' => '<div id="%1$s" class="widget">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',

		]);


	} //end function


	add_action('widgets_init', 'theme_for_blog_widgets_init');
} //end if condition
?>