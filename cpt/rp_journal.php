<?php
function rp_register_rp_journal() {

	/**
	 * Post Type: Journals.
	 */

	$labels = array(
		"name" => __( "Journals", "twentyseventeen" ),
		"singular_name" => __( "Journal", "twentyseventeen" ),
	);

	$args = array(
		"label" => __( "Journals", "twentyseventeen" ),
		"labels" => $labels,
		"description" => "",
		"public" => false,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "rp_journal", "with_front" => false ),
		"query_var" => true,
		"menu_icon" => "dashicons-clipboard",
		"supports" => array( "title" ),
	);

	register_post_type( "rp_journal", $args );
}

add_action( 'init', 'rp_register_rp_journal' );
