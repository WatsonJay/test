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

	<div class="single_content">
        <ul>
            <div class="single_entry">
		    <?php
            while ( have_posts() ) :
                the_post();?>

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
            </div>
        </ul>
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
