<?php
/**
 * Bat-Max functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Bat-Max
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.5' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function bat_max_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Bat-Max, use a find and replace
		* to change 'bat-max' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'bat-max', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'bat-max' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'bat_max_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'bat_max_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function bat_max_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'bat_max_content_width', 640 );
}
add_action( 'after_setup_theme', 'bat_max_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function bat_max_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'bat-max' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'bat-max' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'bat_max_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function bat_max_scripts() {
	wp_enqueue_style( 'bat-max-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'bat-max-style', 'rtl', 'replace' );

	wp_enqueue_script( 'bat-max-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	wp_enqueue_script( 'bat-max-galleries', get_template_directory_uri() . '/js/galleries.js', array('load_glide'), _S_VERSION, true );

	wp_enqueue_script( 'load_glide', get_template_directory_uri() . '/js/libs/glide.min.js', array(), _S_VERSION, true );

	wp_enqueue_script( 'load_lightbox', get_template_directory_uri() . '/js/libs/fslightbox.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'bat_max_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

// Duplicate post content from original across translation
function cw2b_content_copy( $content ) {    
	if ( isset( $_GET['from_post'] ) ) {
			$my_post = get_post( $_GET['from_post'] );
			if ( $my_post )
					return $my_post->post_content;
	}
	return $content;
}
add_filter( 'default_content', 'cw2b_content_copy' );

// Duplicate post title from original across translation
function cw2b_editor_title( $title ) {    
	if ( isset( $_GET['from_post'] ) ) {
			$my_post = get_post( $_GET['from_post'] );
			if ( $my_post )
					return $my_post->post_title;
	}
	return $title;
}
add_filter( 'default_title', 'cw2b_editor_title' );

function get_language_switcher() {
	$lang = array(
		'dropdown' => false,
		'show_names' => false,
		'show_flags' => true,
		'hide_if_empty' => true,
		'hide_if_not_translation' => false,
		'raw' => true
	);
	$switcher = pll_the_languages( $lang );

	$first= '';
	$second = '';
	$content = '<div id="language-switcher" class="language-switcher"><ul class="language-switcher-list">';
	// var_dump($switcher);
	foreach($switcher as $lang){
		if( $lang['current_lang'] ):
			$first .= '<button class="single-language current">' . $lang['slug'] . '</button>';
		else:
			$second .= '<li class="single-language inactive"><a href="' . $lang['url'] . '">' . $lang['slug'] . '</a></li>';
		endif;

	}

	$content .= $second;
	$content .= '</ul>';
	$content .= $first;
	$content .= '</div>';

	return $content;
}

$languages = pll_languages_list();
foreach($languages as $lang){
	// Register options page.
	$option_page = acf_add_options_page(array(
		'page_title'    => sprintf(__('Ustawienia motywu (%s)', 'bat-max'), $lang),
		'menu_title'    => sprintf(__('Ustawienia motywu (%s)', 'bat-max'), $lang),
		'menu_slug'     => 'bat-max-settings-' . $lang,
		'post_id'       => 'bat-max-settings-' . $lang,
		'capability'    => 'edit_posts',
		'icon_url'      => 'dashicons-admin-home',
		'redirect'      => false,
	));
}

acf_add_options_page(array(
	'page_title'    => __('Galeria'),
	'menu_title'    => __('Galeria'),
	'menu_slug'     => 'bat-max-gallery',
	'post_id'       => 'bat-max-gallery',
	'capability'    => 'edit_posts',
	'icon_url'      => 'dashicons-format-gallery',
	'redirect'      => false,
));

function wpb_add_google_fonts() {    wp_enqueue_style( 'wpb-google-fonts', 'https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap', false );    }        add_action( 'wp_enqueue_scripts', 'wpb_add_google_fonts' ); ?>

<?php 
// Fix a long-standing issue with ACF, where fields sometimes aren't shown
// in previews (ie. from Preview > Open in new tab).
if ( class_exists( 'acf_revisions' ) )
{
	// Reference to ACF's <code>acf_revisions</code> class
	// We need this to target its method, acf_revisions::acf_validate_post_id
	$acf_revs_cls = acf()->revisions;

	// This hook is added the ACF file: includes/revisions.php:36 (in ACF PRO v5.11)
	remove_filter( 'acf/validate_post_id', array( $acf_revs_cls, 'acf_validate_post_id', 10 ) );
}

function get_gallery_with_pagination($items_per_page_setting) {
	if(!$items_per_page_setting) return ['pagination' => null, 'images_array' => null];

	$gallery = get_fields('bat-max-gallery');
	$gallery = $gallery['gallery'];
	$images = array();
	$items_per_page = $items_per_page_setting;
	$total_items = count($gallery);
	$size = 'full'; 
	$total_pages = ceil($total_items / $items_per_page);
	
	if(get_query_var('paged')){
			$current_page = get_query_var('paged');
	}
	elseif (get_query_var('page')) {
			$current_page = get_query_var('page');
	}
	else{
			$current_page = 1;
	}
	$starting_point = (($current_page-1)*$items_per_page);
	
	if($gallery){
			$images = array_slice($gallery,$starting_point,$items_per_page);
	}

	$images_arr = [];

	if(!empty($images)){
		foreach( $images as $image ):
			array_push($images_arr, ['url'=>$image['url'], 'alt'=>$image['alt']]);
		endforeach;
	}
	
	$big = 999999999;
	$pagination = paginate_links(array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'current' => $current_page,
			'total' => $total_pages,
	));

	return ['pagination' => $pagination, 'images_array' => $images_arr];
}

function get_options_fields() {
	$current_language = pll_current_language( 'slug' );
	$options = get_fields('bat-max-settings-'.$current_language);
	return $options;	
}
