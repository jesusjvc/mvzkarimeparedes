<?php

/**
 * Genesis Sample.
 *
 * This file adds functions to the Genesis Sample Theme.
 *
 * @package Genesis Sample
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://www.studiopress.com/
 */

// Starts the engine.
require_once get_template_directory() . '/lib/init.php';

// Sets up the Theme.
require_once get_stylesheet_directory() . '/lib/theme-defaults.php';

add_action('after_setup_theme', 'genesis_sample_localization_setup');
/**
 * Sets localization (do not remove).
 *
 * @since 1.0.0
 */
function genesis_sample_localization_setup()
{

	load_child_theme_textdomain(genesis_get_theme_handle(), get_stylesheet_directory() . '/languages');
}

// Adds helper functions.
require_once get_stylesheet_directory() . '/lib/helper-functions.php';

// Adds image upload and color select to Customizer.
require_once get_stylesheet_directory() . '/lib/customize.php';

// Includes Customizer CSS.
require_once get_stylesheet_directory() . '/lib/output.php';

// Adds WooCommerce support.
require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-setup.php';

// Adds the required WooCommerce styles and Customizer CSS.
require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-output.php';

// Adds the Genesis Connect WooCommerce notice.
require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-notice.php';

add_action('after_setup_theme', 'genesis_child_gutenberg_support');
/**
 * Adds Gutenberg opt-in features and styling.
 *
 * @since 2.7.0
 */
function genesis_child_gutenberg_support()
{ // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound -- using same in all child themes to allow action to be unhooked.
	require_once get_stylesheet_directory() . '/lib/gutenberg/init.php';
}

// Registers the responsive menus.
if (function_exists('genesis_register_responsive_menus')) {
	genesis_register_responsive_menus(genesis_get_config('responsive-menus'));
}

add_action('wp_enqueue_scripts', 'genesis_sample_enqueue_scripts_styles');
/**
 * Enqueues scripts and styles.
 *
 * @since 1.0.0
 */
function genesis_sample_enqueue_scripts_styles()
{

	$appearance = genesis_get_config('appearance');

	wp_enqueue_style( // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion -- see https://core.trac.wordpress.org/ticket/49742
		genesis_get_theme_handle() . '-fonts',
		$appearance['fonts-url'],
		[],
		null
	);

	wp_enqueue_style('dashicons');

	if (genesis_is_amp()) {
		wp_enqueue_style(
			genesis_get_theme_handle() . '-amp',
			get_stylesheet_directory_uri() . '/lib/amp/amp.css',
			[genesis_get_theme_handle()],
			genesis_get_theme_version()
		);
	}
}

add_filter('body_class', 'genesis_sample_body_classes');
/**
 * Add additional classes to the body element.
 *
 * @since 3.4.1
 *
 * @param array $classes Classes array.
 * @return array $classes Updated class array.
 */
function genesis_sample_body_classes($classes)
{

	if (!genesis_is_amp()) {
		// Add 'no-js' class to the body class values.
		$classes[] = 'no-js';
	}
	return $classes;
}

add_action('genesis_before', 'genesis_sample_js_nojs_script', 1);
/**
 * Echo the script that changes 'no-js' class to 'js'.
 *
 * @since 3.4.1
 */
function genesis_sample_js_nojs_script()
{

	if (genesis_is_amp()) {
		return;
	}

?>
	<script>
		//<![CDATA[
		(function() {
			var c = document.body.classList;
			c.remove('no-js');
			c.add('js');
		})();
		//]]>
	</script>
<?php
}

add_filter('wp_resource_hints', 'genesis_sample_resource_hints', 10, 2);
/**
 * Add preconnect for Google Fonts.
 *
 * @since 3.4.1
 *
 * @param array  $urls          URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed.
 * @return array URLs to print for resource hints.
 */
function genesis_sample_resource_hints($urls, $relation_type)
{

	if (wp_style_is(genesis_get_theme_handle() . '-fonts', 'queue') && 'preconnect' === $relation_type) {
		$urls[] = [
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		];
	}

	return $urls;
}

add_action('after_setup_theme', 'genesis_sample_theme_support', 9);
/**
 * Add desired theme supports.
 *
 * See config file at `config/theme-supports.php`.
 *
 * @since 3.0.0
 */
function genesis_sample_theme_support()
{

	$theme_supports = genesis_get_config('theme-supports');

	foreach ($theme_supports as $feature => $args) {
		add_theme_support($feature, $args);
	}
}

add_action('after_setup_theme', 'genesis_sample_post_type_support', 9);
/**
 * Add desired post type supports.
 *
 * See config file at `config/post-type-supports.php`.
 *
 * @since 3.0.0
 */
function genesis_sample_post_type_support()
{

	$post_type_supports = genesis_get_config('post-type-supports');

	foreach ($post_type_supports as $post_type => $args) {
		add_post_type_support($post_type, $args);
	}
}

// Adds image sizes.
add_image_size('sidebar-featured', 75, 75, true);
add_image_size('genesis-singular-images', 702, 526, true);

// Removes header right widget area.
unregister_sidebar('header-right');

// Removes secondary sidebar.
unregister_sidebar('sidebar-alt');

// Removes site layouts.
genesis_unregister_layout('content-sidebar-sidebar');
genesis_unregister_layout('sidebar-content-sidebar');
genesis_unregister_layout('sidebar-sidebar-content');

// Repositions primary navigation menu.
remove_action('genesis_after_header', 'genesis_do_nav');
add_action('genesis_header', 'genesis_do_nav', 12);

// Repositions the secondary navigation menu.
remove_action('genesis_after_header', 'genesis_do_subnav');
add_action('genesis_footer', 'genesis_do_subnav', 10);

add_filter('wp_nav_menu_args', 'genesis_sample_secondary_menu_args');
/**
 * Reduces secondary navigation menu to one level depth.
 *
 * @since 2.2.3
 *
 * @param array $args Original menu options.
 * @return array Menu options with depth set to 1.
 */
function genesis_sample_secondary_menu_args($args)
{

	if ('secondary' === $args['theme_location']) {
		$args['depth'] = 1;
	}

	return $args;
}

add_filter('genesis_author_box_gravatar_size', 'genesis_sample_author_box_gravatar');
/**
 * Modifies size of the Gravatar in the author box.
 *
 * @since 2.2.3
 *
 * @param int $size Original icon size.
 * @return int Modified icon size.
 */
function genesis_sample_author_box_gravatar($size)
{

	return 90;
}


add_filter('genesis_comment_list_args', 'genesis_sample_comments_gravatar');
/**
 * Modifies size of the Gravatar in the entry comments.
 *
 * @since 2.2.3
 *
 * @param array $args Gravatar settings.
 * @return array Gravatar settings with modified size.
 */
function genesis_sample_comments_gravatar($args)
{

	$args['avatar_size'] = 60;
	return $args;
}


// -------------------------------------------------------
// Estilos CSS y Scripts
// -------------------------------------------------------

function esbrillante_styles()
{

	wp_enqueue_style('base', get_stylesheet_directory_uri() . '/assets/css/base.css', false);

	wp_enqueue_script('scrollreveal', 'https://unpkg.com/scrollreveal@4.0.0/dist/scrollreveal.min.js', array('jquery'), '1.0', true);
	wp_enqueue_script('modernizr', get_stylesheet_directory_uri() . '/assets/js/modernizr-webp.js', array('jquery'), '1.0', true);
	wp_enqueue_script('main_js', get_stylesheet_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0', true);

	if (is_front_page()) {
		wp_enqueue_style('homepage', get_stylesheet_directory_uri() . '/assets/css/homepage.css', false);
	} else {
		global $post;

		if (is_page(array($post->post_name))) {
			wp_enqueue_style($post->post_name, get_stylesheet_directory_uri() . '/assets/css/' . $post->post_name . '.css', false);
		}
	}

	if (is_404()) {
		wp_enqueue_style('404-esbrillante', get_stylesheet_directory_uri() . '/assets/css/404.css', false);
	}

	if (is_single() ||  is_home()) {		
		wp_enqueue_style('blog', get_stylesheet_directory_uri() . '/assets/css/blog.css', false);
	} else {
		// Quitar estilos del blog
		wp_dequeue_style('wp-block-library');
		wp_deregister_style('wp-block-library');
		wp_deregister_style('classic-theme-styles');
		wp_deregister_style('wd-widget-recent-post-comments');

		//Desactivar styles de wordpress sólo para usuarios no logeados
		if ( !is_user_logged_in() ) {
			wp_deregister_style('dashicons');
		}
	}
}

add_action('wp_enqueue_scripts', 'esbrillante_styles', 10);


/* ==========================================================================
   FUNCIONES PARA HEADER & FOOTER PERSONALIZADO 
   ========================================================================== */


//Eliminar bloque de HEADER DEFAULT
//remove_action( 'genesis_header', 'genesis_header_markup_open', 5 );
remove_action('genesis_header', 'genesis_do_header');
//remove_action( 'genesis_header', 'genesis_header_markup_close', 15 );

//Eliminar los créditos del footer
//remove_action('genesis_footer', 'genesis_footer_markup_open', 5);
remove_action('genesis_footer', 'genesis_do_footer');
//remove_action('genesis_footer', 'genesis_footer_markup_close', 15);


// Personalizar header en Genesis
add_action('genesis_header', 'bld_personalizar_header');

function bld_personalizar_header()
{
	include 'header-page.php';
}

// Personalizar pie de página en Genesis
add_action('genesis_footer', 'bld_personalizar_footer');

function bld_personalizar_footer()
{
	include 'footer-page.php';
}



/* ==========================================================================
   FUNCIONES PARA PERMITIR SUBIR IMÁGENES WEBP EN MEDIOS
   ========================================================================== */

   function webp_upload_mimes($existing_mimes) {
    $existing_mimes['webp'] = 'image/webp';
    return $existing_mimes;
}
add_filter('mime_types', 'webp_upload_mimes');


// Desactivar avisos de correo de actualización automática.

add_filter( 'auto_core_update_send_email', '__return_false' );
add_filter( 'auto_theme_update_send_email', '__return_false' );
add_filter( 'auto_plugin_update_send_email', '__return_false' );