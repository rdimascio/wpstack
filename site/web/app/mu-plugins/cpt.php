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
            'public' => true,
            'menu_position' => 5,
            'supports' => array( 'title', 'editor', 'excerpt', 'custom-fields', 'thumbnail','page-attributes' ),
            'taxonomies' => array( 'post_tag', 'category' ),
            'exclude_from_search' => false,
            'capability_type' => 'post',
            'rewrite' => array( 'slug' => 'plugins' ),
        )
    );
}

add_action( 'init', 'plugin_post_type' );


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


// Edit Plugin Post Type Help Text

function plugin_help( $contextual_help, $screen_id, $screen ) {

    if ( 'plugin' == $screen->id ) {

        $contextual_help = '<h2>Plugins</h2>
    <p>Plugins show the details of the items that we sell on the website. You can see a list of them on this page in reverse chronological order - the latest one we added is first.</p> 
    <p>You can view/edit the details of each plugin by clicking on its name, or you can perform bulk actions using the dropdown menu and selecting multiple items.</p>';

    } elseif ( 'edit-plugin' == $screen->id ) {

        $contextual_help = '<h2>Editing plugins</h2>
    <p>This page allows you to view/modify plugin details. Please make sure to fill out the available boxes with the appropriate details (product image, price, brand) and <strong>not</strong> add these details to the product description.</p>';

    }

    return $contextual_help;
}

add_action( 'contextual_help', 'plugin_help', 10, 3 );


