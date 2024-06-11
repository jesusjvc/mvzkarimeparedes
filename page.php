<?php

// Checar si usa elementor el sitio Web o es con Código
// Si detecta que elementor está habilitado se desactiva el modo código

$elementor = did_action( 'elementor/loaded' );

if(!$elementor){

	//Se cambia a modo Full Width
	add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

	// Remueve el Site Inner
	add_filter( 'genesis_markup_site-inner', '__return_null' );


	//remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );


	remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

	//add_filter( 'the_content', 'echo_content', 90 );
	function echo_content($content){
		global $post;
		$content = get_template_part('html/pages/page', $post->post_name);
		return $content;
	}

}


genesis();