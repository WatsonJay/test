<div class="tool">
    <div class="footer-widgets">
        <ul>
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-1') ) : ?>
            <?php endif; ?>
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-2') ) : ?>
            <?php endif; ?>
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-3') ) : ?>
            <?php endif; ?>
        </ul>
    </div>
    <div style="clear-both"></div>
</div>

<footer>
    <p>
        Copyright&nbsp;&copy;&nbsp;2011-<?php echo date("Y"); ?><a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a>
        Powered by <a href="http://wordpress.org/">WordPress.</a> Theme <a href="http://www.nothingistrue.top" title="查看作者网站">love</a> is a free theme designed by <a href="http://www.nothingistrue.top" title="查看作者网站">JayWatson</a></br>
    </p>
    <p>
        <?php
        if (get_option('bottomlink')) {
            echo get_option('bottomlink');
        }
        ?>
    </p>
    <p>
        <?php echo get_option('beian'); ?>
    </p>
    <p>
        <?php
        if (get_option('tongji')) {
            echo get_option('tongji'); ?>
        <?php } ?>
    </p>
</footer>

<?php wp_footer(); ?>
</body>
</html>