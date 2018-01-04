<?php
/**
 * Plugin Name: CPT
 * Plugin URI: https://ryan.dimasc.io
 * Description: Custom post types for WP Stack - Plugins, Themes, Deals
 * Version: 1.0
 * Author: Ryan DiMascio
 * Author URI: https://ryandimascio.com
 *  License: GPL2
 */

// Our custom post type function
function create_posttype() {

    register_post_type( 'movies',
        // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Movies' ),
                'singular_name' => __( 'Movie' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'movies'),
        )
    );
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype' );