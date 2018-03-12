<?php
/*-------------------------------------------*/
/*	Theme setup
/*-------------------------------------------*/
if ( ! function_exists( 'moca_theme_setup' ) ) :
function moca_theme_setup() {
	load_theme_textdomain( 'moca', get_template_directory() . '/languages');
	/*-------------------------------------------*/
	/*	Add default posts and comments RSS feed links to head.
	/*-------------------------------------------*/
	add_theme_support( 'automatic-feed-links' );
	/*-------------------------------------------*/
	/*	manage the document title & custom
	/*-------------------------------------------*/
	add_theme_support( 'title-tag' );
	/*-------------------------------------------*/
	/*	support for Post Thumbnails
	/*-------------------------------------------*/
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'moca_thumb_image', 350, 9999, false );
	add_image_size( 'moca_thumbnail_avatar', 100, 100, true );
	/*-------------------------------------------*/
	/*	Set the default content width.
	/*-------------------------------------------*/
	$GLOBALS['content_width'] = 800;
	/*-------------------------------------------*/
	/*	This theme uses wp_nav_menu() in two locations.
	/*-------------------------------------------*/
	register_nav_menus(
		array(
			'head'    => __( 'Head menu', 'moca' )
		)
	);
	/*-------------------------------------------*/
	/*	Switch default core markup for search form, comment form, and comments
	/*-------------------------------------------*/
	add_theme_support( 'html5',
		array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		)
	);
	/*-------------------------------------------*/
	/*	Add theme support for Custom Logo.
	/*-------------------------------------------*/
	add_theme_support( 'custom-logo',
		array(
			'width'       => 250,
			'height'      => 250,
			'flex-width'  => true,
		)
	);
	/*-------------------------------------------*/
	/*	Add theme support for selective refresh for widgets.
	/*-------------------------------------------*/
	add_theme_support( 'customize-selective-refresh-widgets' );
	/*-------------------------------------------*/
	/*	This theme styles the visual editor to resemble the theme style,
	/*-------------------------------------------*/
	add_editor_style( get_stylesheet_directory_uri() . '/assets/css/editor-style.css' );
	/*-------------------------------------------*/
	/*	Add custom background
	/*-------------------------------------------*/
	$defaults = array(
		'default-color'          => '',
		'default-image'          => '',
		'default-repeat'         => '',
		'default-position-x'     => '',
		'default-attachment'     => '',
		'wp-head-callback'       => '_custom_background_cb',
		'admin-head-callback'    => '',
		'admin-preview-callback' => ''
	);
	add_theme_support( 'custom-background', $defaults );
	/*-------------------------------------------*/
	/*	widget init
	/*-------------------------------------------*/
	function moca_widgets_init() {
		register_sidebar(
			array(
				'name' => esc_html__( 'Side area1', 'moca' ),
				'id' => 'side-widget-area1',
				'before_widget' => '<aside class="widget %2$s" id="%1$s">',
				'after_widget' => '</aside>',
				'before_title' => '<h1 class="widget-title">',
				'after_title' => '</h1>',
			)
		);
		register_sidebar(
			array(
				'name' => esc_html__( 'Side area2', 'moca' ),
				'id' => 'side-widget-area2',
				'before_widget' => '<aside class="widget %2$s" id="%1$s">',
				'after_widget' => '</aside>',
				'before_title' => '<h1 class="widget-title">',
				'after_title' => '</h1>',
			)
		);
		register_sidebar(
			array(
				'name' => esc_html__( 'Side area3', 'moca' ),
				'id' => 'side-widget-area3',
				'before_widget' => '<aside class="widget %2$s" id="%1$s">',
				'after_widget' => '</aside>',
				'before_title' => '<h1 class="widget-title">',
				'after_title' => '</h1>',
			)
		);
		register_sidebar(
			array(
				'name' => esc_html__( 'Footer area1', 'moca' ),
				'id' => 'footer-widget-area1',
				'before_widget' => '<aside class="widget %2$s" id="%1$s">',
				'after_widget' => '</aside>',
				'before_title' => '<h1 class="widget-title">',
				'after_title' => '</h1>',
			)
		);
		register_sidebar(
			array(
				'name' => esc_html__( 'Footer area2', 'moca' ),
				'id' => 'footer-widget-area2',
				'before_widget' => '<aside class="widget %2$s" id="%1$s">',
				'after_widget' => '</aside>',
				'before_title' => '<h1 class="widget-title">',
				'after_title' => '</h1>',
			)
		);
		register_sidebar(
			array(
				'name' => esc_html__( 'Footer area3', 'moca' ),
				'id' => 'footer-widget-area3',
				'before_widget' => '<aside class="widget %2$s" id="%1$s">',
				'after_widget' => '</aside>',
				'before_title' => '<h1 class="widget-title">',
				'after_title' => '</h1>',
			)
		);
	}
	add_action( 'widgets_init', 'moca_widgets_init' );
	/*-------------------------------------------*/
	/*	Load css JS
	/*-------------------------------------------*/
	function moca_add_script() {

		// CSS =====================================
		wp_enqueue_style( 'moca_style', get_template_directory_uri() . '/assets/css/style.css', false );
		wp_enqueue_style( 'moca_font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', false );
		wp_enqueue_style( 'moca_notosans_fonts', '//fonts.googleapis.com/earlyaccess/notosansjapanese.css', false );
		wp_enqueue_style( 'moca_mada_fonts', '//fonts.googleapis.com/css?family=Mada', false );

		// JS =====================================
  	wp_enqueue_script( 'moca_common_js', get_template_directory_uri() . '/assets/js/common.js', array( 'jquery' ), '', false );
  }
	add_action('wp_enqueue_scripts','moca_add_script');
} // end moca_theme_setup

endif;
add_action( 'after_setup_theme', 'moca_theme_setup' );

/*-------------------------------------------*/
/*	Add a pingback url auto-discovery header for singularly identifiable articles.
/*-------------------------------------------*/
function moca_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
	}
}
add_action( 'wp_head', 'moca_pingback_header' );

/*-------------------------------------------*/
/*	Add a admin font
/*-------------------------------------------*/
function moca_load_admin_fonts( $hook ) {
	if ( 'post.php' !== $hook || 'post-new.php' !== $hook ) {
		return;
	}
	wp_enqueue_style( 'moca_notosans_admin_font', '//fonts.googleapis.com/earlyaccess/notosansjapanese.css' );
}
add_action( 'admin_enqueue_scripts', 'moca_load_admin_fonts' );
