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
<div class="single_content" id="main">
    <div class="main">
        <div>
        <div class="single_entry">
    <?php if(have_posts()): ?>
        <?php while(have_posts()): the_post(); ?>
                <div class="single_post" id="post-<?php the_ID(); ?>">
                     <div class="single-post-title">
                         <h2><?php the_title(); ?></h2>
                    </div>
                    <?php setPostViews(get_the_ID()); ?><!------记录浏览次数--------->
                    <div class="post-info-wrap">
					    <span class="post-info-left">
						    By
						    <?php the_author_posts_link(); ?>
						    | 分类:
						    <?php the_category(', ') ?>
						    | 阅读:
						    <?php echo getPostViews(get_the_ID()); ?>
						    | 评论:
                            <?php comments_popup_link('(0)', '(1)', '(%)'); ?>
					    </span>
                        <span class="post-info-right">
						    <?php edit_post_link('编辑', '<span class="editpost">', '</span>'); ?>
                            <?php _e(' | ') ?>
						    <a class="goto_comment" style="cursor:pointer;">发表评论</a>
					    </span>
                    </div><!--end of post_info_wrap--->
                    <div style="clear:both"></div>
                    <div class="single-entry">
                        <?php the_content(); ?>
                    </div><!---entry end--->
                    <div style="clear:both"></div>
                    <div class="post-end-wrap">
                        <span class="post-tags"><?php _e('标签：'); ?><?php the_tags('',  '，', '') ?></span>
                    </div>
                </div><!-------end of single post---------->

                <div class="copyright">
                    <p>------------------------------文章到这里就结束啦------------------------------</p>
                </div><!-- end of copyright -->

        <?php endwhile; ?>
    <?php else: ?>
        <div id="single-post">
            <a href="<?php bloginfo('url') ?>" title="返回首页"><img src="<?php bloginfo('template_directory'); ?>/images/404.png" alt="Error 404 - Not Found" /></a>
        </div>
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
