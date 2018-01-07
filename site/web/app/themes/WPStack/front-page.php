<?php while (have_posts()) : the_post(); ?>
        <?php
            $args = array( 'post_type' => 'bundle', 'posts_per_page' => 3 );
            $loop = new WP_Query( $args );

                while ( $loop->have_posts() ) : $loop->the_post();

                    echo '<article class="style1"><span class="image"><img src="';
                        the_post_thumbnail_url();
                    echo '" alt="" /></span><a href="';
                        the_permalink();
                    echo '"><h2>';
                        the_title();
                    echo '</h2><div class="content"><p class="bundle-description">';
                        the_excerpt();
                    echo '</p></div></a></article>';

                endwhile;
        ?>
<?php endwhile; ?>
