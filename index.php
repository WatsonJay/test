<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">

    <title><?php bloginfo('name'); ?><?php wp_title(); ?></title>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats please -->

    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
    <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
    <link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
    <link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <script src="<?php bloginfo('template_url'); ?>/js/myjs.js"></script>
    <script src="<?php bloginfo('template_url'); ?>/js/modernizr.js"></script>
    <?php wp_get_archives('type=monthly&format=link'); ?>
    <?php //comments_popup_script(); // off by default?>
</head>
<body>
<header>
    <div class="quotes">
        <p></p>
        <div class="title-text">记录・回忆</div>
        <div class="flower-boy">
            <img src="<?php bloginfo('template_url');?>/images/flower.jpg">
            <p><?php echo get_the_author_meta('display_name',get_option('boyid')); ?></p>
        </div>
        <div class="photo-text">&</div>
        <div class="flower">
            <img src="<?php bloginfo('template_url');?>/images/flower.jpg">
            <p>小仙女</p>
        </div>
    </div>
    <!--nav begin-->
    <div id="nav">
        <ul>
            <?php echo str_replace("</ul></div>", "", preg_replace("{<div[^>]*><ul[^>]*>}", "", wp_nav_menu(array('theme_location' => 'nav', 'echo' => false)) )); ?>
        </ul>
    </div>
    <!--nav end-->
</header>
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
        <figure> <a href="/"><img src="<?php bloginfo('template_url');?>/images/t01.jpg"></a>
            <p><a href="/">愿有人陪你一起颠沛流离</a></p>
            <figcaption>有一天晚上我收到朋友的邮件，他问我怎样可以最快地摆脱寂寞，我想了想不知道应该怎么回答他，因为我从来没有摆脱过这个问题，我只能去习惯它，就像习惯身体的一部分。</figcaption>
        </figure>
        <figure> <a href="/"><img src="<?php bloginfo('template_url');?>/images/t02.jpg"></a>
            <p><a href="/">你要去相信，没有到不了的明天</a></p>
            <figcaption>不管你现在是一个人走在异乡的街道上始终没有找到一丝归属感，还是你在跟朋友们一起吃饭开心地笑着的时候闪过一丝落寞。</figcaption>
        </figure>
        <figure> <a href="/"><img src="<?php bloginfo('template_url');?>/images/t03.jpg"></a>
            <p><a href="/">美丽的茧</a></p>
            <figcaption>让世界拥有它的脚步，让我保有我的茧。当溃烂已极的心灵再不想做一丝一毫的思索时，就让我静静回到我的茧内，以回忆为睡榻，以悲哀为覆被，这是我唯一的美丽。</figcaption>
        </figure>
    </div>
</div>
</body>
</html>