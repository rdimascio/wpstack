<?php
/**
 * Plugin Name: CPT
 * Plugin URI: https://blog.dimasc.io/wp/cpt
 * Description: Custom post types for WP Stack: Plugins, Themes, Bundles, Deals.
 * Version: 1.0
 * Author: Ryan DiMascio
 * Author URI: https://ryandimascio.com
 *  License: GPL2
 */


// ============= PLUGINS ============= //


// Create Plugin Post Type

function plugin_post_type() {

    $labels = array(
        'name' => 'Plugins',
        'singular_name' => 'Plugin',
        'add_new' => 'Add New Plugin',
        'add_new_item' => 'Add New Plugin',
        'edit_item' => 'Edit Plugin',
        'new_item' => 'New Plugin',
        'all_items' => 'All Plugins',
        'view_item' => 'View Plugin',
        'search_items' => 'Search Plugins',
        'not_found' =>  'No Plugins Found',
        'not_found_in_trash' => 'No Plugins found in Trash',
        'parent_item_colon' => '',
        'menu_name' => 'Plugins',
    );

    register_post_type( 'plugin', array(
            'labels' => $labels,
            'has_archive' => true,
            'has_rest' => true,
            'public' => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'can_export'          => true,
            'publicly_queryable'  => true,
            'menu_icon'           => 'dashicons-plus-alt',
            'menu_position' => 5,
            'description' => 'WordPress repository plugins for bundles',
            'supports' => array( 'title', 'editor', 'revisions', 'excerpt', 'custom-fields', 'thumbnail', 'page-attributes' ),
            'taxonomies' => array( 'plugin_tag', 'plugin_category' ),
            'exclude_from_search' => false,
            'capability_type' => 'post',
            'rewrite' => array( 'slug' => 'plugins' ),
        )
    );
}

add_action( 'init', 'plugin_post_type' );


// Edit Plugin Post Type Title Text

function plugin_title_text( $title ) {
    $screen = get_current_screen();

    if  ( 'plugin' == $screen->post_type ) {
        $title = 'Enter name of the plugin here';
    }

    return $title;
}

add_filter( 'enter_title_here', 'plugin_title_text' );


// Create Plugin Post Type Categories

function plugin_categories() {

    $labels = array(
        'name'              => _x( 'Plugin Categories', 'taxonomy general name' ),
        'singular_name'     => _x( 'Plugin Category', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Plugin Categories' ),
        'all_items'         => __( 'All Plugin Categories' ),
        'parent_item'       => __( 'Parent Plugin Category' ),
        'parent_item_colon' => __( 'Parent Plugin Category:' ),
        'edit_item'         => __( 'Edit Plugin Category' ),
        'update_item'       => __( 'Update Plugin Category' ),
        'add_new_item'      => __( 'Add New Plugin Category' ),
        'new_item_name'     => __( 'New Plugin Category' ),
        'menu_name'         => __( 'Plugin Categories' ),
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
    );

    register_taxonomy( 'plugin_category', 'plugin', $args );
}

add_action( 'init', 'plugin_categories', 0 );


// Create Plugin Post Type Tags

function plugin_tags() {

    $labels = array(
        'name'              => _x( 'Plugin Tags', 'taxonomy general name' ),
        'singular_name'     => _x( 'Plugin Tag', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Plugin Tags' ),
        'all_items'         => __( 'All Plugin Tags' ),
        'parent_item'       => __( 'Parent Plugin Tag' ),
        'parent_item_colon' => __( 'Parent Plugin Tag:' ),
        'edit_item'         => __( 'Edit Plugin Tag' ),
        'update_item'       => __( 'Update Plugin Tag' ),
        'add_new_item'      => __( 'Add New Plugin Tag' ),
        'new_item_name'     => __( 'New Plugin Tag' ),
        'menu_name'         => __( 'Plugin Tags' ),
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
    );

    register_taxonomy( 'plugin_tag', 'plugin', $args );
}

add_action( 'init', 'plugin_tags', 0 );


// Edit Plugin Post Type Messages

function plugin_messages( $messages ) {

    global $post, $post_ID;

    $messages['plugin'] = array(
        0 => '',
        1 => sprintf( __('Plugin updated. <a href="%s">View plugin</a>'), esc_url( get_permalink($post_ID) ) ),
        2 => __('Custom field updated.'),
        3 => __('Custom field deleted.'),
        4 => __('Plugin updated.'),
        5 => isset($_GET['revision']) ? sprintf( __('Plugin restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
        6 => sprintf( __('Plugin published. <a href="%s">View plugin</a>'), esc_url( get_permalink($post_ID) ) ),
        7 => __('Plugin saved.'),
        8 => sprintf( __('Plugin submitted. <a target="_blank" href="%s">Preview plugin</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
        9 => sprintf( __('Plugin scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview plugin</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
        10 => sprintf( __('Plugin draft updated. <a target="_blank" href="%s">Preview plugin</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    );

    return $messages;
}

add_filter( 'post_updated_messages', 'plugin_messages' );


// Edit Plugin Post Type Bulk Messages

function plugin_bulk_messages( $bulk_messages, $bulk_counts ) {

    $bulk_messages['plugin'] = array(
        'updated'   => _n( "%s plugin updated.", "%s plugins updated.", $bulk_counts["updated"] ),
        'locked'    => _n( "%s plugin not updated, somebody is editing it.", "%s plugins not updated, somebody is editing them.", $bulk_counts["locked"] ),
        'deleted'   => _n( "%s plugin permanently deleted.", "%s plugins permanently deleted.", $bulk_counts["deleted"] ),
        'trashed'   => _n( "%s plugin moved to the Trash.", "%s plugins moved to the Trash.", $bulk_counts["trashed"] ),
        'untrashed' => _n( "%s plugin restored from the Trash.", "%s plugins restored from the Trash.", $bulk_counts["untrashed"] ),
    );

    return $bulk_messages;
}

add_filter( 'bulk_post_updated_messages', 'plugin_bulk_messages', 10, 2 );


// Edit Plugin Post Type Help Text

function plugin_help() {

    $screen = get_current_screen();

    if ( 'plugin' != $screen->post_type )
        return;

    $args = [
        'id'      => 'plugin_help',
        'title'   => 'Plugin Help',
        'content' => '<h3>Plugins</h3><p>Deals for entrepreneurs.</p>',
    ];

    $screen->add_help_tab( $args );
}

add_action('admin_head', 'plugin_help' );



// ============= THEMES ============= //



// Create Theme Post Type

function theme_post_type() {

    $labels = array(
        'name' => 'Themes',
        'singular_name' => 'Theme',
        'add_new' => 'Add New Theme',
        'add_new_item' => 'Add New Theme',
        'edit_item' => 'Edit Theme',
        'new_item' => 'New Theme',
        'all_items' => 'All Themes',
        'view_item' => 'View Theme',
        'search_items' => 'Search Themes',
        'not_found' =>  'No Themes Found',
        'not_found_in_trash' => 'No Themes found in Trash',
        'parent_item_colon' => '',
        'menu_name' => 'Themes',
    );

    register_post_type( 'theme', array(
            'labels' => $labels,
            'has_archive' => true,
            'has_rest' => true,
            'public' => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'can_export'          => true,
            'publicly_queryable'  => true,
            'menu_icon'           => 'dashicons-star-filled',
            'menu_position' => 6,
            'description' => 'WordPress repository themes',
            'supports' => array( 'title', 'editor', 'revisions', 'excerpt', 'custom-fields', 'thumbnail','page-attributes' ),
            'taxonomies' => array( 'theme_tag', 'theme_category' ),
            'exclude_from_search' => false,
            'capability_type' => 'post',
            'rewrite' => array( 'slug' => 'themes' ),
        )
    );
}

add_action( 'init', 'theme_post_type' );


// Create Theme Post Type Categories

function theme_categories() {

    $labels = array(
        'name'              => _x( 'Theme Categories', 'taxonomy general name' ),
        'singular_name'     => _x( 'Theme Category', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Theme Categories' ),
        'all_items'         => __( 'All Theme Categories' ),
        'parent_item'       => __( 'Parent Theme Category' ),
        'parent_item_colon' => __( 'Parent Theme Category:' ),
        'edit_item'         => __( 'Edit Theme Category' ),
        'update_item'       => __( 'Update Theme Category' ),
        'add_new_item'      => __( 'Add New Theme Category' ),
        'new_item_name'     => __( 'New Theme Category' ),
        'menu_name'         => __( 'Theme Categories' ),
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
    );

    register_taxonomy( 'theme_category', 'theme', $args );
}

add_action( 'init', 'theme_categories', 0 );


// Create Theme Post Type Tags

function theme_tags() {

    $labels = array(
        'name'              => _x( 'Theme Tags', 'taxonomy general name' ),
        'singular_name'     => _x( 'Theme Tag', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Theme Tags' ),
        'all_items'         => __( 'All Theme Tags' ),
        'parent_item'       => __( 'Parent Theme Tag' ),
        'parent_item_colon' => __( 'Parent Theme Tag:' ),
        'edit_item'         => __( 'Edit Theme Tag' ),
        'update_item'       => __( 'Update Theme Tag' ),
        'add_new_item'      => __( 'Add New Theme Tag' ),
        'new_item_name'     => __( 'New Theme Tag' ),
        'menu_name'         => __( 'Theme Tags' ),
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
    );

    register_taxonomy( 'theme_tag', 'theme', $args );
}

add_action( 'init', 'theme_tags', 0 );


// Edit Theme Post Type Messages

function theme_messages( $messages ) {

    global $post, $post_ID;
    $link = esc_url( get_permalink($post_ID) );

    $messages['theme'] = array(
        0 => '',
        1 => sprintf( __('Theme updated. <a href="%s">View theme</a>'), $link ),
        2 => __('Custom field updated.'),
        3 => __('Custom field deleted.'),
        4 => __('Theme updated.'),
        5 => isset($_GET['revision']) ? sprintf( __('Theme restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
        6 => sprintf( __('Theme published. <a href="%s">View theme</a>'), $link ),
        7 => __('Theme saved.'),
        8 => sprintf( __('Theme submitted. <a target="_blank" href="%s">Preview theme</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
        9 => sprintf( __('Theme scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview theme</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), $link ),
        10 => sprintf( __('Theme draft updated. <a target="_blank" href="%s">Preview theme</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    );

    return $messages;
}

add_filter( 'post_updated_messages', 'theme_messages' );


// Edit Theme Post Type Help Text

function theme_help() {

    $screen = get_current_screen();

    if ( 'theme' != $screen->post_type )
        return;

    $args = [
        'id'      => 'theme_help',
        'title'   => 'Theme Help',
        'content' => '<h3>Themes</h3><p>Deals for entrepreneurs.</p>',
    ];

    $screen->add_help_tab( $args );
}

add_action('admin_head', 'theme_help' );



// ============= BUNDLES ============= //



// Create Bundle Post Type

function bundle_post_type() {

    $labels = array(
        'name'               => 'Bundles',
        'singular_name'      => 'Bundle',
        'add_new'            => 'Add New Bundle',
        'add_new_item'       => 'Add New Bundle',
        'edit_item'          => 'Edit Bundle',
        'new_item'           => 'New Bundle',
        'all_items'          => 'All Bundles',
        'view_item'          => 'View Bundle',
        'search_items'       => 'Search Bundles',
        'not_found'          =>  'No Bundles Found',
        'not_found_in_trash' => 'No Bundles found in Trash',
        'parent_item_colon'  => '',
        'menu_name'          => 'Bundles',
    );

    register_post_type( 'bundle', array(
            'labels'              => $labels,
            'has_archive'         => true,
            'has_rest'            => true,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'can_export'          => true,
            'publicly_queryable'  => true,
            'menu_icon'           => 'dashicons-portfolio',
            'menu_position'       => 7,
            'description'         => 'Bundles of WordPress plugins to improve new user experience',
            'supports'            => array( 'title', 'editor', 'revisions', 'excerpt', 'custom-fields', 'thumbnail','page-attributes' ),
            'taxonomies'          => array( 'bundle_tag', 'bundle_category' ),
            'exclude_from_search' => false,
            'capability_type'     => 'post',
            'rewrite'             => array( 'slug' => 'bundles' ),
        )
    );
}

add_action( 'init', 'bundle_post_type' );


// Create Bundle Post Type Categories

function bundle_categories() {

    $labels = array(
        'name'              => _x( 'Bundle Categories', 'taxonomy general name' ),
        'singular_name'     => _x( 'Bundle Category', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Bundle Categories' ),
        'all_items'         => __( 'All Bundle Categories' ),
        'parent_item'       => __( 'Parent Bundle Category' ),
        'parent_item_colon' => __( 'Parent Bundle Category:' ),
        'edit_item'         => __( 'Edit Bundle Category' ),
        'update_item'       => __( 'Update Bundle Category' ),
        'add_new_item'      => __( 'Add New Bundle Category' ),
        'new_item_name'     => __( 'New Bundle Category' ),
        'menu_name'         => __( 'Bundle Categories' ),
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
    );

    register_taxonomy( 'bundle_category', 'bundle', $args );
}

add_action( 'init', 'bundle_categories', 0 );


// Create Bundle Post Type Tags

function bundle_tags() {

    $labels = array(
        'name'              => _x( 'Bundle Tags', 'taxonomy general name' ),
        'singular_name'     => _x( 'Bundle Tag', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Bundle Tags' ),
        'all_items'         => __( 'All Bundle Tags' ),
        'parent_item'       => __( 'Parent Bundle Tag' ),
        'parent_item_colon' => __( 'Parent Bundle Tag:' ),
        'edit_item'         => __( 'Edit Bundle Tag' ),
        'update_item'       => __( 'Update Bundle Tag' ),
        'add_new_item'      => __( 'Add New Bundle Tag' ),
        'new_item_name'     => __( 'New Bundle Tag' ),
        'menu_name'         => __( 'Bundle Tags' ),
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
    );

    register_taxonomy( 'bundle_tag', 'bundle', $args );
}

add_action( 'init', 'bundle_tags', 0 );


// Edit Bundle Post Type Messages

function bundle_messages( $messages ) {

    global $post, $post_ID;
    $link = esc_url( get_permalink($post_ID) );

    $messages['bundle'] = array(
        0 => '',
        1 => sprintf( __('Bundle updated. <a href="%s">View bundle</a>'), $link ),
        2 => __('Custom field updated.'),
        3 => __('Custom field deleted.'),
        4 => __('Bundle updated.'),
        5 => isset($_GET['revision']) ? sprintf( __('Bundle restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
        6 => sprintf( __('Bundle published. <a href="%s">View bundle</a>'), $link ),
        7 => __('Bundle saved.'),
        8 => sprintf( __('Bundle submitted. <a target="_blank" href="%s">Preview bundle</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
        9 => sprintf( __('Bundle scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview bundle</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), $link ),
        10 => sprintf( __('Bundle draft updated. <a target="_blank" href="%s">Preview bundle</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    );

    return $messages;
}

add_filter( 'post_updated_messages', 'bundle_messages' );


// Edit Bundle Post Type Help Text

function bundle_help() {
    $screen = get_current_screen();

    if ( 'bundle' != $screen->post_type )
        return;

    $args = [
        'id'      => 'bundle_help',
        'title'   => 'Bundle Help',
        'content' => '<h3>Bundles</h3><p>Deals for entrepreneurs.</p>',
    ];

    $screen->add_help_tab( $args );
}

add_action('admin_head', 'bundle_help');


// Add Bundles to Main Homepage Query

function add_bundles_to_homepage( $query ) {
    if ( is_home() && $query->is_main_query() ) {
        $query->set( 'post_type', array( 'post', 'bundle' ) );
    }
    return $query;
}

add_action( 'pre_get_posts', 'add_bundles_to_homepage' );



// ============= DEALS ============= //



// Create Deal Post Type

function deal_post_type() {

    $labels = array(
        'name'               => 'Deals',
        'singular_name'      => 'Deal',
        'add_new'            => 'Add New Deal',
        'add_new_item'       => 'Add New Deal',
        'edit_item'          => 'Edit Deal',
        'new_item'           => 'New Deal',
        'all_items'          => 'All Deals',
        'view_item'          => 'View Deal',
        'search_items'       => 'Search Deals',
        'not_found'          =>  'No Deals Found',
        'not_found_in_trash' => 'No Deals found in Trash',
        'parent_item_colon'  => '',
        'menu_name'          => 'Deals',
    );

    register_post_type( 'deal', array(
            'labels' => $labels,
            'has_archive'         => true,
            'has_rest'            => true,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'can_export'          => true,
            'publicly_queryable'  => true,
            'menu_icon'           => 'dashicons-megaphone',
            'menu_position'       => 8,
            'supports'            => array( 'title', 'editor', 'excerpt', 'custom-fields', 'thumbnail','page-attributes' ),
            'taxonomies'          => array( 'deal_tag', 'deal_category' ),
            'exclude_from_search' => false,
            'capability_type'     => 'post',
            'rewrite'             => array( 'slug' => 'deals' )
        )
    );
}

add_action( 'init', 'deal_post_type' );


// Create Deal Post Type Categories

function deal_categories() {

    $labels = array(
        'name'              => _x( 'Deal Categories', 'taxonomy general name' ),
        'singular_name'     => _x( 'Deal Category', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Deal Categories' ),
        'all_items'         => __( 'All Deal Categories' ),
        'parent_item'       => __( 'Parent Deal Category' ),
        'parent_item_colon' => __( 'Parent Deal Category:' ),
        'edit_item'         => __( 'Edit Deal Category' ),
        'update_item'       => __( 'Update Deal Category' ),
        'add_new_item'      => __( 'Add New Deal Category' ),
        'new_item_name'     => __( 'New Deal Category' ),
        'menu_name'         => __( 'Deal Categories' )
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
    );

    register_taxonomy( 'deal_category', 'deal', $args );
}

add_action( 'init', 'deal_categories', 0 );


// Create Deal Post Type Tags

function deal_tags() {

    $labels = array(
        'name'              => _x( 'Deal Tags', 'taxonomy general name' ),
        'singular_name'     => _x( 'Deal Tag', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Deal Tags' ),
        'all_items'         => __( 'All Deal Tags' ),
        'parent_item'       => __( 'Parent Deal Tag' ),
        'parent_item_colon' => __( 'Parent Deal Tag:' ),
        'edit_item'         => __( 'Edit Deal Tag' ),
        'update_item'       => __( 'Update Deal Tag' ),
        'add_new_item'      => __( 'Add New Deal Tag' ),
        'new_item_name'     => __( 'New Deal Tag' ),
        'menu_name'         => __( 'Deal Tags' ),
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
    );

    register_taxonomy( 'deal_tag', 'deal', $args );
}

add_action( 'init', 'deal_tags', 0 );


// Edit Deal Post Type Messages

function deal_messages( $messages ) {

    global $post, $post_ID;

    $messages['deal'] = array(
        0 => '',
        1 => sprintf( __('Deal updated. <a href="%s">View deal</a>'), esc_url( get_permalink($post_ID) ) ),
        2 => __('Custom field updated.'),
        3 => __('Custom field deleted.'),
        4 => __('Deal updated.'),
        5 => isset($_GET['revision']) ? sprintf( __('Deal restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
        6 => sprintf( __('Deal published. <a href="%s">View deal</a>'), esc_url( get_permalink($post_ID) ) ),
        7 => __('Deal saved.'),
        8 => sprintf( __('Deal submitted. <a target="_blank" href="%s">Preview deal</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
        9 => sprintf( __('Deal scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview bundle</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
        10 => sprintf( __('Deal draft updated. <a target="_blank" href="%s">Preview deal</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    );

    return $messages;
}

add_filter( 'post_updated_messages', 'deal_messages' );


// Edit Deal Post Type Help Text

function deal_help() {
    $screen = get_current_screen();

    if ( 'deal' != $screen->post_type )
        return;

    $args = [
        'id'      => 'deal_help',
        'title'   => 'Deal Help',
        'content' => '<h3>Product Deals</h3><p>Deals for entrepreneurs.</p>',
    ];

    $screen->add_help_tab( $args );
}

add_action('admin_head', 'deal_help');
