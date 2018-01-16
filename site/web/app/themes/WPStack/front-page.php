<div class="inner">
    <!--                <div class="hero-bg">-->
    <!--                    ::before-->
    <!--                    <img class="hero-image" src="dist/images/" />-->
    <!--                </div>-->
    <section class="hero">
        <header>
            <h1>WordPress plugin stacks, hand-curated by <br />designers & developers.</h1>
            <p>Our vetted team of WordPress experts have taken the guesswork out of finding the perfect plugins for your <br />WordPress powered blog, portfolio, store, or website.</p><br />
            <button class="special"><span class="btn_icon">👇</span> Find a Stack</button> &nbsp; <button href="https://m.me/wpstack"><span class="btn_icon">🤖</span> Chat</button>
        </header>
        <div class="stack"></div>
    </section>
    <section id="bundles" class="tiles">
        <?php while (have_posts()) : the_post(); ?>
            <?php
            $args = array( 'post_type' => 'bundle', 'posts_per_page' => 9, 'orderby' => 'date', 'order' => 'ASC' );
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
    </section>
    <section id="plugins" class="cards">

    </section>
</div>