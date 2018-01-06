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
            'public' => true,
            'menu_position' => 6,
            'supports' => array( 'title', 'editor', 'excerpt', 'custom-fields', 'thumbnail','page-attributes' ),
            'taxonomies' => array( 'post_tag', 'category' ),
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


// Edit Theme Post Type Messages

function theme_messages( $messages ) {

    global $post, $post_ID;

    $messages['theme'] = array(
        0 => '',
        1 => sprintf( __('Theme updated. <a href="%s">View theme</a>'), esc_url( get_permalink($post_ID) ) ),
        2 => __('Custom field updated.'),
        3 => __('Custom field deleted.'),
        4 => __('Theme updated.'),
        5 => isset($_GET['revision']) ? sprintf( __('Theme restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
        6 => sprintf( __('Theme published. <a href="%s">View theme</a>'), esc_url( get_permalink($post_ID) ) ),
        7 => __('Theme saved.'),
        8 => sprintf( __('Theme submitted. <a target="_blank" href="%s">Preview theme</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
        9 => sprintf( __('Theme scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview theme</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
        10 => sprintf( __('Theme draft updated. <a target="_blank" href="%s">Preview theme</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    );

    return $messages;
}

add_filter( 'post_updated_messages', 'theme_messages' );


// Edit Theme Post Type Help Text

function theme_help( $contextual_help, $screen_id, $screen ) {

    if ( 'theme' == $screen->id ) {

        $contextual_help = '<h2>Themes</h2>
    <p>Themes show the details of the items that we sell on the website. You can see a list of them on this page in reverse chronological order - the latest one we added is first.</p> 
    <p>You can view/edit the details of each theme by clicking on its name, or you can perform bulk actions using the dropdown menu and selecting multiple items.</p>';

    } elseif ( 'edit-themes' == $screen->id ) {

        $contextual_help = '<h2>Editing themes</h2>
    <p>This page allows you to view/modify theme details. Please make sure to fill out the available boxes with the appropriate details (product image, price, brand) and <strong>not</strong> add these details to the product description.</p>';

    }

    return $contextual_help;
}

add_action( 'contextual_help', 'theme_help', 10, 3 );



// ============= BUNDLES ============= //



// Create Bundle Post Type

function bundle_post_type() {

    $labels = array(
        'name' => 'Bundles',
        'singular_name' => 'Bundle',
        'add_new' => 'Add New Bundle',
        'add_new_item' => 'Add New Bundle',
        'edit_item' => 'Edit Bundle',
        'new_item' => 'New Bundle',
        'all_items' => 'All Bundles',
        'view_item' => 'View Bundle',
        'search_items' => 'Search Bundles',
        'not_found' =>  'No Bundles Found',
        'not_found_in_trash' => 'No Bundles found in Trash',
        'parent_item_colon' => '',
        'menu_name' => 'Bundles',
    );

    register_post_type( 'bundle', array(
            'labels' => $labels,
            'has_archive' => true,
            'public' => true,
            'menu_position' => 7,
            'supports' => array( 'title', 'editor', 'excerpt', 'custom-fields', 'thumbnail','page-attributes' ),
            'taxonomies' => array( 'post_tag', 'category' ),
            'exclude_from_search' => false,
            'capability_type' => 'post',
            'rewrite' => array( 'slug' => 'bundles' ),
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


// Edit Bundle Post Type Messages

function bundle_messages( $messages ) {

    global $post, $post_ID;

    $messages['bundle'] = array(
        0 => '',
        1 => sprintf( __('Bundle updated. <a href="%s">View bundle</a>'), esc_url( get_permalink($post_ID) ) ),
        2 => __('Custom field updated.'),
        3 => __('Custom field deleted.'),
        4 => __('Bundle updated.'),
        5 => isset($_GET['revision']) ? sprintf( __('Bundle restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
        6 => sprintf( __('Theme published. <a href="%s">View bundle</a>'), esc_url( get_permalink($post_ID) ) ),
        7 => __('Bundle saved.'),
        8 => sprintf( __('Bundle submitted. <a target="_blank" href="%s">Preview bundle</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
        9 => sprintf( __('Bundle scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview bundle</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
        10 => sprintf( __('Bundle draft updated. <a target="_blank" href="%s">Preview bundle</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    );

    return $messages;
}

add_filter( 'post_updated_messages', 'bundle_messages' );


// Edit Bundle Post Type Help Text

function bundle_help( $contextual_help, $screen_id, $screen ) {

    if ( 'bundle' == $screen->id ) {

        $contextual_help = '<h2>Bundles</h2>
    <p>Bundles show the details of the items that we sell on the website. You can see a list of them on this page in reverse chronological order - the latest one we added is first.</p> 
    <p>You can view/edit the details of each bundle by clicking on its name, or you can perform bulk actions using the dropdown menu and selecting multiple items.</p>';

    } elseif ( 'edit-bundles' == $screen->id ) {

        $contextual_help = '<h2>Editing bundles</h2>
    <p>This page allows you to view/modify bundle details. Please make sure to fill out the available boxes with the appropriate details (product image, price, brand) and <strong>not</strong> add these details to the product description.</p>';

    }

    return $contextual_help;
}

add_action( 'contextual_help', 'bundle_help', 10, 3 );



// ============= DEALS ============= //



// Create Deal Post Type

function deal_post_type() {

    $labels = array(
        'name' => 'Deals',
        'singular_name' => 'Deal',
        'add_new' => 'Add New Deal',
        'add_new_item' => 'Add New Deal',
        'edit_item' => 'Edit Deal',
        'new_item' => 'New Deal',
        'all_items' => 'All Deals',
        'view_item' => 'View Deal',
        'search_items' => 'Search Deals',
        'not_found' =>  'No Deals Found',
        'not_found_in_trash' => 'No Deals found in Trash',
        'parent_item_colon' => '',
        'menu_name' => 'Deals',
    );

    register_post_type( 'deal', array(
            'labels' => $labels,
            'has_archive' => true,
            'public' => true,
            'menu_position' => 8,
            'supports' => array( 'title', 'editor', 'excerpt', 'custom-fields', 'thumbnail','page-attributes' ),
            'taxonomies' => array( 'post_tag', 'category' ),
            'exclude_from_search' => false,
            'capability_type' => 'post',
            'rewrite' => array( 'slug' => 'deals' ),
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
        'menu_name'         => __( 'Deal Categories' ),
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
    );

    register_taxonomy( 'deal_category', 'deal', $args );
}

add_action( 'init', 'deal_categories', 0 );


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
        6 => sprintf( __('Theme published. <a href="%s">View deal</a>'), esc_url( get_permalink($post_ID) ) ),
        7 => __('Deal saved.'),
        8 => sprintf( __('Deal submitted. <a target="_blank" href="%s">Preview deal</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
        9 => sprintf( __('Deal scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview bundle</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
        10 => sprintf( __('Deal draft updated. <a target="_blank" href="%s">Preview deal</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    );

    return $messages;
}

add_filter( 'post_updated_messages', 'deal_messages' );


// Edit Deal Post Type Help Text

function deal_help( $contextual_help, $screen_id, $screen ) {

    if ( 'deal' == $screen->id ) {

        $contextual_help = '<h2>Deals</h2>
    <p>Deals show the details of the items that we sell on the website. You can see a list of them on this page in reverse chronological order - the latest one we added is first.</p> 
    <p>You can view/edit the details of each deal by clicking on its name, or you can perform bulk actions using the dropdown menu and selecting multiple items.</p>';

    } elseif ( 'edit-deals' == $screen->id ) {

        $contextual_help = '<h2>Editing deals</h2>
    <p>This page allows you to view/modify deal details. Please make sure to fill out the available boxes with the appropriate details (product image, price, brand) and <strong>not</strong> add these details to the product description.</p>';

    }

    return $contextual_help;
}

add_action( 'contextual_help', 'deal_help', 10, 3 );
