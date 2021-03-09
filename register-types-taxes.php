<?php
function register_tribes() {

/**
 * Post Type: Tribes.
 */

$labels = [
  "name" => __( "Tribes", "custom-post-type-ui" ),
  "singular_name" => __( "Tribe", "custom-post-type-ui" ),
  "all_items" => __( "All Tribe Posts", "custom-post-type-ui" ),
  "add_new" => __( "New Tribe Post", "custom-post-type-ui" ),
  "add_new_item" => __( "New Tribe Post", "custom-post-type-ui" ),
  "name_admin_bar" => __( "Tribe Post", "custom-post-type-ui" ),
];

$args = [
  "label" => __( "Tribes", "custom-post-type-ui" ),
  "labels" => $labels,
  "description" => "",
  "public" => true,
  "publicly_queryable" => true,
  "show_ui" => true,
  "show_in_rest" => true,
  "rest_base" => "tribe",
  "rest_controller_class" => "WP_REST_Posts_Controller",
  "has_archive" => true,
  "show_in_menu" => true,
  "show_in_nav_menus" => true,
  "delete_with_user" => false,
  "exclude_from_search" => false,
  "capability_type" => "post",
  "map_meta_cap" => true,
  "hierarchical" => false,
  "rewrite" => [ "slug" => "tribe", "with_front" => true ],
  "query_var" => false,
  "menu_icon" => "dashicons-groups",
  "supports" => [ "title", "editor", "thumbnail", "custom-fields" ],
  "taxonomies" => [ "post_tag", "tribes", "tribe_category" ],
];

register_post_type( "tribe", $args );
}

add_action( 'init', 'register_tribes' );


function register_tribe_taxonomies() {

	/**
	 * Taxonomy: Tribes.
	 */

	$labels = [
		"name" => __( "Tribes", "custom-post-type-ui" ),
		"singular_name" => __( "Tribe", "custom-post-type-ui" ),
	];

	$args = [
		"label" => __( "Tribes", "custom-post-type-ui" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => false,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'tribes', 'with_front' => true, ],
		"show_admin_column" => true,
		"show_in_rest" => true,
		"rest_base" => "tribes",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => true,
		"meta_box_cb" => false,
			];
	register_taxonomy( "tribes", [ "tribe" ], $args );

	/**
	 * Taxonomy: Tribe Categories.
	 */

	$labels = [
		"name" => __( "Tribe Categories", "custom-post-type-ui" ),
		"singular_name" => __( "Tribe Category", "custom-post-type-ui" ),
		"menu_name" => __( "Tribe Category", "custom-post-type-ui" ),
		"all_items" => __( "All Tribe Categories", "custom-post-type-ui" ),
		"edit_item" => __( "Edit Tribe Category", "custom-post-type-ui" ),
		"view_item" => __( "View Tribe Category", "custom-post-type-ui" ),
		"update_item" => __( "Update Tribe Category name", "custom-post-type-ui" ),
		"add_new_item" => __( "Add new Tribe Category", "custom-post-type-ui" ),
		"new_item_name" => __( "New Tribe Category name", "custom-post-type-ui" ),
		"parent_item" => __( "Parent Tribe Category", "custom-post-type-ui" ),
		"parent_item_colon" => __( "Parent Tribe Category:", "custom-post-type-ui" ),
		"search_items" => __( "Search Tribe Categories", "custom-post-type-ui" ),
		"popular_items" => __( "Popular Tribe Categories", "custom-post-type-ui" ),
		"separate_items_with_commas" => __( "Separate Tribe Category with commas", "custom-post-type-ui" ),
		"add_or_remove_items" => __( "Add or remove Tribe Category", "custom-post-type-ui" ),
		"choose_from_most_used" => __( "Choose from the most used Tribe Categories", "custom-post-type-ui" ),
		"not_found" => __( "No Tribe Category found", "custom-post-type-ui" ),
		"no_terms" => __( "No Tribe Category", "custom-post-type-ui" ),
		"items_list_navigation" => __( "Tribe Category list navigation", "custom-post-type-ui" ),
		"items_list" => __( "Tribe Category list", "custom-post-type-ui" ),
		"back_to_items" => __( "Back to Tribe Categories", "custom-post-type-ui" ),
	];

	$args = [
		"label" => __( "Tribe Categories", "custom-post-type-ui" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => false,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'cat', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"rest_base" => "cat",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		"meta_box_cb" => false,
			];
	register_taxonomy( "tribe_category", [ "tribe" ], $args );
}
add_action( 'init', 'register_tribe_taxonomies' );