<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package love
 */

get_header();
?>
                        <span class="post-tags"><?php _e('标签：'); ?><?php the_tags('',  '，', '') ?></span>
                </div><!-------end of single post---------->

	<div class="single_content">
        <ul>
            <div class="single_entry">
		    <?php
            while ( have_posts() ) :
                the_post();?>
                </div><!-- end of copyright -->

			<h3 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

			<?php the_tags('标签：', ', ', ''); ?>

            <?php the_time('Y年n月j日') ?>
            
            <?php the_content(); ?>
            <?php
			the_post_navigation();

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		    endwhile; // End of the loop.
		    ?>
    <?php endif; ?>
            <div class="post_nav">
                <div class="prev_post"><?php previous_post_link( '%link', '上一篇：%title' ) ?></div>
                <div class="next_post"><?php next_post_link( '%link', '下一篇：%title' ) ?></div>
            </div>
        </div>
        <div class="single_entry">
        <?php // If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) :
            comments_template();
        endif;
        ?>
        </div>
    </div>
    </div>
</div><!-- #primary -->
<?php get_footer();?>
