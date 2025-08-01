<?php
/**
 * Basic initialization for Mynote theme
 *
 * @author Terry Lin
 * @link https://terryl.in/
 *
 * @package WordPress
 * @subpackage Mynote
 * @since 1.0.0
 * @version 2.0.0
 */

if ( ! function_exists( 'mynote_setup_theme' ) ) {

	function mynote_setup_theme() {

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Add Thumbnail Theme Support.
		add_theme_support( 'post-thumbnails' );

		// Enables post and comment RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Custom Thumbnail Size call using the_post_thumbnail( 'mynote-thumbnail' ); .
		add_image_size( 'mynote-thumbnail', 360, 240, true );
		add_image_size( 'mynote-medium', 600, 400, true );

		// Localisation Support.
		load_theme_textdomain( 'mynote', get_template_directory() . '/languages' );

		// Add excerpt to page.
		add_post_type_support( 'page', 'excerpt' );

		// Add custom background support.
		$background_args = array(
			'default-color'          => '',
			'default-image'          => '',
			'default-repeat'         => 'repeat',
			'default-position-x'     => 'left',
			'default-position-y'     => 'top',
			'default-size'           => 'auto',
			'default-attachment'     => 'scroll',
			'wp-head-callback'       => '_custom_background_cb',
			'admin-head-callback'    => '',
			'admin-preview-callback' => '',
		);
		add_theme_support( 'custom-background', $background_args );

		// Add theme support for Custom Header
		$header_args = array(
			'default-image'          => '',
			'width'                  => 1920,
			'height'                 => 640,
			'flex-width'             => false,
			'flex-height'            => false,
			'uploads'                => true,
			'random-default'         => false,
			'header-text'            => true,
			'default-text-color'     => 'ffffff',
			'wp-head-callback'       => '_custom_background_cb',
			'admin-head-callback'    => '',
			'admin-preview-callback' => '',
			'video'                  => false,
			'video-active-callback'  => '',
		);
		add_theme_support( 'custom-header', $header_args );

		// Add theme support for Custom Logo.
		$logo_args = array(
			'height'     => 60,
			'width'      => 180,
			'flex-width' => true,
		);
		add_theme_support( 'custom-logo', $logo_args );

		add_theme_support(
			'woocommerce',
			array(
				'thumbnail_image_width' => 150,
				'single_image_width'    => 300,
				'product_grid'          => array(
					'default_rows'    => 3,
					'min_rows'        => 2,
					'max_rows'        => 8,
					'default_columns' => 4,
					'min_columns'     => 2,
					'max_columns'     => 5,
				),
			)
		);
	}

	add_editor_style( 'editor-style.css' );
}

/**
 * Add scripts
 */
function mynote_header_scripts() {
	if ( 'wp-login.php' !== $GLOBALS['pagenow'] && ! is_admin() ) {
		wp_register_script( 'bootstrap', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.bundle.min.js', array( 'jquery' ), '4.6.2' );
		wp_enqueue_script( 'bootstrap' );
	}
}

/**
 * Add styles
 */
function mynote_styles() {
	wp_register_style( 'bootstrap', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/css/bootstrap.min.css', array(), '4.6.2', 'all' );
	wp_enqueue_style( 'bootstrap' );

	wp_register_style( 'fontawesome', get_template_directory_uri() . '/assets/css/fontawesome-all.min.css', array(), '5.1.0', 'all' );
	wp_enqueue_style( 'fontawesome' );

	wp_register_style( 'mynote-font-roboto', 'https://fonts.googleapis.com/css?family=Roboto:300,400', array(), '1.0', 'all' );
	wp_enqueue_style( 'mynote-font-roboto' );

	wp_register_style( 'mynote', get_template_directory_uri() . '/style.css', array(), '2.0.3', 'all' );
	wp_enqueue_style( 'mynote' );
}

/**
 * Enqueue the javascript that performs in-link comment reply fanciness
 *
 * @return void
 */
function mynote_enqueue_comment_reply() {
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

/**
 * Register mynote Navigation
 *
 * @return void
 */
function mynote_register_mynote_menu() {
	register_nav_menus(
		array(
			'header-menu'  => __( 'Header Menu', 'mynote' ),
			'sidebar-menu' => __( 'Sidebar Menu', 'mynote' ),
			'footer-menu'  => __( 'Footer Menu', 'mynote' ),
			'social'       => __( 'Social Links Menu', 'mynote' ),
		)
	);
}

/**
 * Register widget area.
 */
function mynote_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Sidebar', 'mynote' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your sidebar on blog posts.', 'mynote' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer', 'mynote' ),
			'id'            => 'sidebar-2',
			'description'   => __( 'Add widgets here to appear in your footer.', 'mynote' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s col-lg col-md-4 col-sm-12">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Sticky Sidebar', 'mynote' ),
			'id'            => 'sidebar-3',
			'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'mynote' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Homepage Middle', 'mynote' ),
			'id'            => 'sidebar-4',
			'description'   => __( 'Add widgets here to appear in your homepage middle section.', 'mynote' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s col-lg col-md-4 col-sm-12">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Homepage Intro', 'mynote' ),
			'id'            => 'sidebar-5',
			'description'   => __( 'Add widgets here to appear in your homepage intro section.', 'mynote' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s my-2 col-lg-12">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Homepage Sidebar', 'mynote' ),
			'id'            => 'sidebar-6',
			'description'   => __( 'Add widgets here to appear in your sidebar on homepage.', 'mynote' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Archive Sidebar', 'mynote' ),
			'id'            => 'sidebar-7',
			'description'   => __( 'Add widgets here to appear in your sidebar on archive pages.', 'mynote' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_widget( 'Mynote_Widget_Toc' );
}

// I still don't know why should I put this line to ignore theme-check warning.
if ( ! isset( $content_width ) ) {
	$content_width = 900;
}

if ( ! function_exists( 'wp_body_open' ) ) {
	/**
	 * Added for backwards compatibility to support WordPress versions prior to 5.2.0.
	 *
	 * @since WP 5.2.0
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}

/**
 * Customizer additions.
 */
if ( function_exists( 'is_customize_preview' ) && is_customize_preview() ) {
	require get_parent_theme_file_path( '/inc/customizer.php' );
}

/**
 * Implement the Custom Header feature.
 */
require get_parent_theme_file_path( '/inc/customize-css.php' );

/**
 * Custom Walker_Nav_Menu for Mynote theme header menu.
 */
require get_parent_theme_file_path( '/inc/classes/navbar/class-mynote-walker.php' );

/**
 * Sticky TOC widget for single post.
 */
require get_parent_theme_file_path( '/inc/classes/widgets/class-mynote-widget-toc.php' );

/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path( '/inc/template-tags.php' );

/**
 * Additional features to allow styling of the templates.
 */
require get_parent_theme_file_path( '/inc/template-functions.php' );

/**
 * Social icon functions.
 */
require get_parent_theme_file_path( '/inc/icon-functions.php' );

/**
 * Mynote template functions for hooks.
 */
require get_parent_theme_file_path( '/inc/template-hook-functions.php' );

/**
 * Hooks for Mynote theme.
 */
require get_parent_theme_file_path( '/inc/template-hooks.php' );

// Disable auto-sizes to fix bug that WordPress 671 added.
add_filter( 'wp_img_tag_add_auto_sizes', '__return_false' );
