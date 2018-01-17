<?php while (have_posts()) : the_post(); ?>

    <?php $args = array( 'post_type' => 'plugin',
                   'plugin_category' => 'ecommerce',
                   'posts_per_page' => 9,
                   'orderby' => 'date',
                   'order' => 'ASC' );

          $loop = new WP_Query( $args );

    while ( $loop->have_posts() ) : $loop->the_post();

        echo '<article class="tile"><span class="image"><img src="';
        the_post_thumbnail_url();
        echo '" alt="" /></span><a href="';
        the_permalink();
        echo '"><h2 class="tile-title">';
        the_title();
        echo '</h2><div class="tile-content">';
        the_excerpt();
        echo '</div></a></article>';

    endwhile; ?>

<?php endwhile; ?>