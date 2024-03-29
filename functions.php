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

add_filter( 'http_request_host_is_external', '__return_true' );
add_action( 'pre_get_posts', 'front_page' );

function front_page( $query ) 
{
    if ( $query->is_main_query() && is_front_page() && $query->is_home() ) 
    {
		$query->set( 'category_name', 'comercio' );
		$query->set( 'cat', 2);
		$query->is_page = 0;
        $query->is_singular = 0;
        $query->is_archive = 1;
	}

	if ($query->is_page('blog')) {
		$query->is_archive = 1;
	}
	
    return $query;
}

function redirect_comercio()
{
    if ( is_category( 'comercio' ) ) {
        $url = site_url();
        wp_safe_redirect( $url, 301 );
        exit();
    }
}
add_action( 'template_redirect', 'redirect_comercio' );

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
	wp_register_script( 'markerclusterer', 'https://cdnjs.cloudflare.com/ajax/libs/js-marker-clusterer/1.0.0/markerclusterer_compiled.js', '', '', true );
	// wp_register_script( 'markerclusterer', 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js', '', '', true );
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
	register_nav_menu('menu-rodape',__( 'Menu Rodapé' ));
  }
add_action( 'init', 'register_my_menu' );

function display_last_updated_date() {
	$original_time = get_the_time('U');
	$modified_time = get_the_modified_time('U');
		$updated_time = get_the_modified_time(get_option( 'time_format' ));
		$updated_day = get_the_modified_time(get_option( 'date_format' ));
		$modified_content .= '<p class="last-modified">Última atualização: '. $updated_day . ' as '. $updated_time .'</p>';

	//$modified_content .= $content;
	echo $modified_content;
}
//add_filter( 'the_content', 'display_last_updated_date' );