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
            <p><?php echo get_the_author_meta('display_name',get_option('girlid')); ?></p>
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
<!--head end-->