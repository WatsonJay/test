<?php get_header(); ?>

<div class="main-content">
    <div class="photowall">
        <ul class="wall_a">
            <li><img src="<?php bloginfo('template_url');?>/images/p01.jpg">
                </a></li>
            <li><img src="<?php bloginfo('template_url');?>/images/p02.jpg">
                </a></li>
            <li><img src="<?php bloginfo('template_url');?>/images/p03.jpg">
                </a></li>
            <li>
                <div class="timer">
                    <p class="text_timerGo">
                        <b id="d"></b> 天 <b id="h"></b> 小时
                        <b id="m"></b> 分 <b id="s"></b> 秒
                    </p>
                </div>
            </li>
            <li><img src="<?php bloginfo('template_url');?>/images/p04.jpg">
                </a></li>
            <li>
                <p class="text_timer">我们已经在一起了</p>
            </li>
            <li><img src="<?php bloginfo('template_url');?>/images/p05.jpg">
                </a></li>
            <li><img src="<?php bloginfo('template_url');?>/images/p06.jpg">
                </a></li>
        </ul>
        <script>
            timer();
            setInterval(timer, 1000);
        </script>
    </div>
    <div class="content">
        <ul>
            <div class="content_boy" id="content_boy">
                <?php
                $pagedType = ($_GET["pagedType"])?$_GET["pagedType"]:"";
                $pageNow = ($pagedType=="male")?get_query_var('paged'):$_GET["otherSidePagedNum"];
                $pageOtherSide = ($pagedType=="male")?$_GET["otherSidePagedNum"]:get_query_var('paged');
                if ($pageNow==0):
                    $pageNow=1;
                endif;
                if ($pageOtherSide==0):
                    $pageOtherSide=1;
                endif;
                query_posts('author='.get_option('boyid'). '&paged=' . $pageNow);
                ?>
                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); $ashu_i++;?>
                        <ul><span class="boy_photo"><a href="/"><img src="<?php bloginfo('template_url');?>/images/boy.jpg"></a></span>
                            <div class="entry">
                                <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="阅读 <?php the_title_attribute(); ?>">
                                    <?php the_title(); ?>
                                </a></h2>
                                <?php if($ashu_i==1):
                                    the_content("[阅读全文]");
                                else:
                                    the_excerpt();
                                endif;?>
                                By
                                <?php the_author_posts_link(); ?>
                                | 分类:
                                <?php the_category(', ') ?>
                                | 阅读:
                                <?php echo getPostViews(get_the_ID()); ?>
                                | 评论:
                                <?php comments_popup_link('(0)', '(1)', '(%)'); ?>
                            </div>
                        </ul>
                    <?php endwhile; ?>
                    <?php wp_reset_query(); ?>

                <div class="nav-blue">
                    <?php if(function_exists('wpdx_paging_nav_boy')) wpdx_paging_nav_boy("male",$pageOtherSide,$pageNow); ?>
                </div>

                <?php else :
		            if ( is_category() )
		            { // If this is a category archive
			            printf("<h2 class='center'>Sorry, but there aren't any posts in the %s category yet.</h2>", single_cat_title('',false));
		            } else if ( is_date() )
		            { // If this is a date archive
			            echo("<h2>Sorry, but there aren't any posts with this date.</h2>");
		            } else if ( is_author() )
		            { // If this is a category archive
			            $userdata = get_userdatabylogin(get_query_var('author_name'));
			            printf("<div class='post boy'><h2>就这么多文章啦！</h2></div>", $userdata->display_name);
		            } else {
			            echo("<div class='content_boy'><h2>这里什么都没有！</h2></div>");
		            }
		            endif;?>
            </div>
            <div class="content_girl" id="content_girl">
                <?php
                $pagedType = ($_GET["pagedType"])?$_GET["pagedType"]:"";
                $pageNew = ($pagedType=="female")?get_query_var('paged'):$_GET["otherSidePagedNum"];
                $pageOtherSide = ($pagedType=="female")?$_GET["otherSidePagedNum"]:get_query_var('paged');
                if ($pageNew==0):
                    $pageNew=1;
                endif;
                if ($pageOtherSide==0):
                    $pageOtherSide=1;
                endif;
                query_posts('author='.get_option('girlid'). '&paged=' . $pageNew);
                ?>
                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); $ashu_b++;?>
                        <ul><span class="girl_photo"><a href="/"><img src="<?php bloginfo('template_url');?>/images/girl.jpg"></a></span>
                            <div class="entry-girl">
                                <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="阅读 <?php the_title_attribute(); ?>">
                                        <?php the_title(); ?>
                                    </a></h2>
                                <?php if($ashu_b==1):
                                    the_content("[阅读全文]");
                                else:
                                    the_excerpt();
                                endif;?>
                                By
                                <?php the_author_posts_link(); ?>
                                | 分类:
                                <?php the_category(', ') ?>
                                | 阅读:
                                <?php echo getPostViews(get_the_ID()); ?>
                                | 评论:
                                <?php comments_popup_link('(0)', '(1)', '(%)'); ?>
                            </div>
                        </ul>
                    <?php endwhile; ?>
                    <?php wp_reset_query(); ?>

                    <div class="nav-blue">
                        <?php if(function_exists('wpdx_paging_nav_girl')) wpdx_paging_nav_girl("female",strval($pageOtherSide),strval($pageNew)); ?>
                    </div>
                <?php else :
                    if ( is_category() )
                    { // If this is a category archive
                        printf("<h2 class='center'>Sorry, but there aren't any posts in the %s category yet.</h2>", single_cat_title('',false));
                    } else if ( is_date() )
                    { // If this is a date archive
                        echo("<h2>Sorry, but there aren't any posts with this date.</h2>");
                    } else if ( is_author() )
                    { // If this is a category archive
                        $userdata = get_userdatabylogin(get_query_var('author_name'));
                        printf("<div class='post boy'><h2>就这么多文章啦！</h2></div>", $userdata->display_name);
                    } else {
                        echo("<div class='content_boy'><h2>这里什么都没有！</h2></div>");
                    }

                endif;?>
            </div>
        </ul>
    </div>
    <div class="blog">
        <?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $args = array(
                'showposts' => 3,
                'cat' => get_option('show_cat')
            );
            query_posts($args);?>
        <?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); $ashu_c++?>
            <figure>
                <a href="<?php the_permalink() ?>" rel="bookmark" title="阅读 <?php the_title_attribute(); ?>">
                <?php
                    if (has_post_thumbnail()) {
                        // 显示特色图像
                        the_post_thumbnail();
                    } else {
                        // 设置特色图像
                        $attachments = get_posts(array(
                            'post_type' => 'attachment',
                            'post_mime_type'=>'image',
                            'posts_per_page' => 0,
                            'post_parent' => $post->ID,
                            'order'=>'ASC'
                        ));
                        if ($attachments) {
                            foreach ($attachments as $attachment) {
                                set_post_thumbnail($post->ID, $attachment->ID);
                                break;
                            }
                            // 显示特色图像
                            the_post_thumbnail();
                        }
                    } ?>
                </a>
                <h3>
                    <a href="<?php the_permalink() ?>" rel="bookmark" title="阅读 <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                </h3>
                <figcaption><?php the_excerpt("[阅读全文]");?></figcaption>
            </figure>
            <?php endwhile;
            if ($ashu_c<3):
                while ($ashu_c<3):$ashu_c++?>
                         <figure> <a href=""><img src="<?php bloginfo('template_url');?>/images/t01.jpg"></a>
                            <h3><a href="">暂时没有文章，随便写写</a></h3>
                          <figcaption>这里还可以放一篇。</figcaption>
                        </figure>
                <?php endwhile;
            endif;
        else: ?>
            <figure> <a href=""><img src="<?php bloginfo('template_url');?>/images/t01.jpg"></a>
                <h3><a href="">暂时没有文章，随便写写</a></h3>
                <figcaption>一个叫小肥仔的男孩。</figcaption>
            </figure>
            <figure> <a href=""><img src="<?php bloginfo('template_url');?>/images/t02.jpg"></a>
                <h3><a href="">暂时没有文章，随便写写</a></h3>
                <figcaption>非常爱着。</figcaption>
            </figure>
            <figure> <a href=""><img src="<?php bloginfo('template_url');?>/images/t03.jpg"></a>
                <h3><a href="">暂时没有文章，随便写写</a></h3>
                <figcaption>那个像仙女一样叫做霄霄的女孩。</figcaption>
            </figure>
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>