<?php
/**
 * Functions and definitions.
 *
 * @link https://livecomposerplugin.com/themes/
 *
 * @package LC Blank
 */

// Delcare Header/Footer compatibility.
define('BASE', get_bloginfo('url')); /* Função para trazer a Base URL */
define('BASE_TEMA', get_bloginfo('template_directory')); /* Função para trazer a Base para diretório */
define('ASSETS', get_bloginfo('template_directory').'/assets/build'); /* Função para trazer a Base para diretório */
define('GOOGLE_API', 'AIzaSyC2ajSRT4DopIeOi3z49jxUHgK4pWMFQbs'); /* Função para trazer a Base para diretório */

$home = get_page_by_path('home');
$configuracoes = get_page_by_path('configuracoes');
$GLOBALS['contato'] = get_page_by_path('contato');
$GLOBALS['campos']['contato'] = get_fields($GLOBALS['contato']->ID);
$GLOBALS['campos']['home'] = get_fields($home->ID);
$GLOBALS['campos']['config'] = get_fields($configuracoes->ID);

//var_dump($GLOBALS['campos']['config']);

function my_acf_google_map_api( $api ){
	
	$api['key'] = GOOGLE_API;
	
	return $api;
	
}

add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

include('api/functions.php');


// Content Width ( WP requires it and LC uses is to figure out the wrapper width ).
if ( ! isset( $content_width ) ) {
	$content_width = 1180;
}

if ( ! function_exists( 'lct_theme_setup' ) ) {

	/**
	 * Basic theme setup.
	 */
	function lct_theme_setup() {

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Enable Post Thumbnails ( Featured Image ).
		add_theme_support( 'post-thumbnails' );

		// Enable support for HTML5 markup.
		add_theme_support( 'html5', array( 'comment-list', 'search-form', 'comment-form' ) );

		add_image_size( 'noticia-thumb', 250, 250, true );
		add_image_size( 'noticia-thumb-large', 500, 425, true );

	}
} add_action( 'after_setup_theme', 'lct_theme_setup' );

/**
 * Load JS and CSS files.
 */
function load_scripts() {

	wp_enqueue_style( 'style', get_stylesheet_uri(), array(), '1.0' );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'vendors', get_template_directory_uri() . '/assets/build/js/vendors.min.js', array(), '20151215', true );
	wp_enqueue_script( 'general', get_template_directory_uri() . '/assets/build/js/general.js', array(), '20151215', true );
	wp_register_script( 'markerclusterer', 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js', '', '', true );
	wp_register_script( 'google-maps', 'https://maps.googleapis.com/maps/api/js?key='.GOOGLE_API.'&callback=init', '', '', true );
	wp_enqueue_script( 'destaques', get_template_directory_uri() . '/assets/build/js/elements/destaques-slider.js', array(), '20151215', true );
	wp_enqueue_script( 'list-horizontal', get_template_directory_uri() . '/assets/build/js/elements/list-horizontal.js', array(), '20151215', true );
	wp_register_script( 'imoveis', get_template_directory_uri() . '/assets/build/js/pages/imoveis.js', array(), '20151215', true );
	wp_register_script( 'imovel-detalhe', get_template_directory_uri() . '/assets/build/js/pages/imovel-detalhe.js', array(), '20151215', true );

	global $wp_query;
	$query = get_queried_object();

	parse_str($_SERVER['QUERY_STRING'], $output);

	wp_localize_script('imoveis', 'ajaxapi', array (
		'ajaxurl' => admin_url ('admin-ajax.php'),
		'query_vars' => json_encode( $wp_query->query ),
		'query' => json_encode($query),
		'get' => $_GET,
		'post' => $_POST,
		'google_api' => GOOGLE_API,
		'assets' => ASSETS
		
	));
} add_action( 'wp_enqueue_scripts', 'load_scripts' );





function register_my_menu() {
	register_nav_menu('menu-principal',__( 'Menu Principal' ));
	register_nav_menu('menu-secundário',__( 'Menu Secundário' ));
	register_nav_menu('menu-institucional',__( 'Menu Institucional' ));
	register_nav_menu('menu-idioma',__( 'Menu Idioma' ));
  }
add_action( 'init', 'register_my_menu' );