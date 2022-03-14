<?php

class CarlosIIICommit_shortcode
{

    public function CarlosIIICommit_shortcode_init()
    {
        function CarlosIIICommit_shortcode($atts, $content = null)
        {

            $numeroCommit = get_option('CarlosIIICommit_options_nCommits');

            if (!($numeroCommit)) {
                $numeroCommit = 5;
            }

            $atts = shortcode_atts( array(
                'n_commits' => $numeroCommit,
            ), $atts );

            $query = new WP_Query( array( 'post_type' => 'Commit' , 'posts_per_page' => $atts['n_commits']) );
            ob_start();
            if ( $query->have_posts() ) : ?>
                <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                    <div>
                        <h5><?php the_title(); ?></h5>
                        <p><?php the_content(); ?></p>
                    </div>
                <?php endwhile; wp_reset_postdata(); ?>
                <!-- show pagination here -->
            <?php else : ?>
                <!-- show 404 error here -->
            <?php endif; ?>
<?php
            $content = ob_get_contents ();
            ob_end_clean();
            return $content;
        }
        add_shortcode('CarlosIIICommit', 'CarlosIIICommit_shortcode');
    }

}