<?php
/**
 * Plugin Name: CPT
 * Plugin URI: https://blog.dimasc.io/wp/cpt
 * Description: Custom post types for WP Stack - Plugins, Themes, Deals
 * Version: 1.0
 * Author: Ryan DiMascio
 * Author URI: https://ryandimascio.com
 *  License: GPL2
 */

// Our custom post type function
function create_posttype() {

    register_post_type( 'plugins',
        // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Plugins' ),
                'singular_name' => __( 'Plugin' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'plugins'),
        )
    );

    register_post_type( 'themes',
        // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Themes' ),
                'singular_name' => __( 'Theme' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'themes'),
        )
    );

    register_post_type( 'bundles',
        // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Bundles' ),
                'singular_name' => __( 'Bundle' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'bundles'),
        )
    );

    register_post_type( 'deals',
        // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Deals' ),
                'singular_name' => __( 'Deal' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'deals'),
        )
    );
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype' );