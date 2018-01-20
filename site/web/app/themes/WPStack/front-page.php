<div class="inner">
    <!--                <div class="hero-bg">-->
    <!--                    ::before-->
    <!--                    <img class="hero-image" src="dist/images/" />-->
    <!--                </div>-->
    <section class="hero">
        <header>
            <h1>WordPress plugin stacks, hand-curated by <br />designers & developers.</h1>
            <p>Our vetted team of WordPress ninjas have taken the guesswork out of finding the perfect plugins for your <br />WordPress powered blog, portfolio, store, or website.</p><br />
            <button class="special"><span class="btn_icon">👇</span> Find a Stack</button> &nbsp; <button class="not_so_special" href="https://m.me/wpstack"><span class="btn_icon">🙋‍♀️</span> Recommend a Stack</button>
        </header>
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
<div class="popup">
    <div class="overlay">
        <div id="close">
            <p>🙅‍♀️ Close</p>
        </div>
        <div id="chat">
            <h4>👋 Hey there!</h4>
            <p>Know a plugin that belongs in one of these stacks?</p>
            <a href="https://m.me/ryan.dimascio" class="fb-msg-btn" target="_blank"><img src="<?= get_template_directory_uri() . '/dist/images/fb-promoter_messenger.png'; ?>" width="20" class="fb_icon" /> Send to Messenger</a>
        </div>
    </div>
    <div id="ryan">
        <a href="https://twitter.com/ryandmas/" target="_blank"><img src="<?= get_template_directory_uri() . '/dist/images/ryan.jpg'; ?>" width="50" class="ryan" /></a>
    </div>
</div>