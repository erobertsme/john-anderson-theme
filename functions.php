<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

require_once('register-types-taxes.php');

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );
         
if ( !function_exists( 'child_theme_configurator_css' ) ):
    function child_theme_configurator_css() {
        wp_enqueue_style( 'chld_thm_cfg_child', trailingslashit( get_stylesheet_directory_uri() ) . 'style.css', array( 'twenty-twenty-one-style','twenty-twenty-one-style','twenty-twenty-one-print-style' ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'child_theme_configurator_css', 10 );

// END ENQUEUE PARENT ACTION

// Disable comments and hide from admin menu and admin bar in functions.php
add_action('admin_init', function () {
    // Redirect any user trying to access comments page
    global $pagenow;
    
    if ($pagenow === 'edit-comments.php') {
        wp_redirect(admin_url());
        exit;
    }

    // Remove comments metabox from dashboard
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');

    // Disable support for comments and trackbacks in post types
    foreach (get_post_types() as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
});

// Close comments on the front-end
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);

// Hide existing comments
add_filter('comments_array', '__return_empty_array', 10, 2);

// Remove comments page in menu
add_action('admin_menu', function () {
    remove_menu_page('edit-comments.php');
});

// Remove comments links from admin bar
add_action('init', function () {
    if (is_admin_bar_showing()) {
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
});

// Remove 5.3+ admin email verification
add_filter( 'admin_email_check_interval', '__return_false' );

// Custome Site Owner role to disallow updating
add_action('after_setup_theme', function (){

  if (!get_option('keokee_roles_created')) {
    $admin_capabilities = get_role('administrator')->capabilities;

    $unwanted_capabilities = [
      'install_plugins' => 1,
      'activate_plugins' => 1,
      'update_plugins' => 1,
      'delete_plugins' => 1,
      'edit_plugins' => 1,
      'install_themes' => 1,
      'update_themes' => 1,
      'delete_themes' => 1,
      'edit_themes' => 1,
      'update_core' => 1,
      'remove_users' => 1,
      'edit_users' => 1,
      'promote_users' => 1,
    ];

    $site_owner_capabilities = array_diff_key($admin_capabilities, $unwanted_capabilities);

    $gravity_forms_capabilities = [
      'gravityforms_edit_forms' => 0,
      'gravityforms_delete_forms' => 0,
      'gravityforms_create_form' => 0,
      'gravityforms_view_entries' => 1,
      'gravityforms_edit_entries' => 0,
      'gravityforms_delete_entries' => 0,
      'gravityforms_view_settings' => 0,
      'gravityforms_edit_settings' => 0,
      'gravityforms_export_entries' => 0,
      'gravityforms_uninstall' => 0,
      'gravityforms_view_entry_notes' => 0,
      'gravityforms_edit_entry_notes' => 0,
      'gravityforms_view_updates' => 0,
      'gravityforms_view_addons' => 0,
      'gravityforms_preview_forms' => 0,
      'gravityforms_system_status' => 0,
      'gravityforms_logging' => 0,
      'gform_full_access' => 1,
    ];

    $site_owner_capabilities = array_merge($site_owner_capabilities, $gravity_forms_capabilities);

    add_role('site_owner', 'Site Owner', $site_owner_capabilities);

    update_option('keokee_roles_created', true);
  };

});

function remove_archive_title( $title ) {
  if ( is_category() ) {
      $title = single_cat_title( '', false );
  } elseif ( is_tag() ) {
      $title = single_tag_title( '', false );
  } elseif ( is_author() ) {
      $title = '<span class="vcard">' . get_the_author() . '</span>';
  } elseif ( is_post_type_archive() ) {
      $title = post_type_archive_title( '', false );
  } elseif ( is_tax() ) {
      $title = single_term_title( '', false );
  }

  return $title;
}

add_filter( 'get_the_archive_title', 'remove_archive_title' );