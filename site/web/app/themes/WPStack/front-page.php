<?php while (have_posts()) : the_post(); ?>
    <div class="bundle-loop col-lg-12 col-md-12 col-sm-12 text-center">

        <?php
            $args = array( 'post_type' => 'bundle', 'posts_per_page' => 3 );
            $loop = new WP_Query( $args );

                while ( $loop->have_posts() ) : $loop->the_post();

                    echo '<a href="';
                        the_permalink();
                    echo '"><div class="bundle"><h2 class="bundle-title">';
                        the_title();
                    echo '</h2><p class="bundle-description">';
                        the_content();
                    echo '</p></div></a>';

                endwhile;
        ?>

    </div></a>
<?php endwhile; ?>
