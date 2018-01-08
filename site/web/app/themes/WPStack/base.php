<?php

use Roots\Sage\Setup;
use Roots\Sage\Wrapper;

?>

<!doctype html>
<html <?php language_attributes(); ?>>
  <?php get_template_part('templates/head'); ?>
  <body id="body" <?php body_class(); ?>>
    <!--[if IE]>
      <div class="alert alert-warning">
        <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'sage'); ?>
      </div>
    <![endif]-->

    <div class="wrapper">

        <?php do_action('get_header');
        get_template_part('templates/header'); ?>

        <nav id="menu">
            <h2>Menu</h2>
            <?php
            if (has_nav_menu('primary_navigation')) :
                wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']);
            endif; ?>
        </nav>

        <div id="main">
            <div class="inner">
                <?php include Wrapper\template_path(); ?>
            </div><!-- /.inner -->

            <?php if (Setup\display_sidebar()) : ?>

          <aside class="sidebar">

            <?php include Wrapper\sidebar_path(); ?>

          </aside><!-- /.sidebar -->

        <?php endif; ?>
      </div><!-- /.main -->

    <?php
      do_action('get_footer');
      get_template_part('templates/footer');
      wp_footer();
    ?>

    </div><!-- /.wrapper -->

  </body>
</html>
