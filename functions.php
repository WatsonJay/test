<?php
$boy=0;
$girl=0;
// 启用菜单管理功能.
 register_nav_menus(
     array(
         'nav' => __( 'Primary', 'test' ),
         'footer' => __( 'Footer Menu', 'test' ),
         'social' => __( 'Social Links Menu', 'test' ),
     )
 );

/*显示文章浏览次数*/
// function to display number of posts.
function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count.'';
}

// function to count views.
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
//end-----------------------------

/*微博式显示方式 XX分钟前*/
function time_diff( $time_type ){
    switch( $time_type ){
        case 'comment':    //如果是评论的时间
            $time_diff = current_time('timestamp') - get_comment_time('U');
            if($time_diff <= 300){
                echo ('刚刚');
            }else{
                if( $time_diff >= 300 && $time_diff <= 604800 ){  //七天之内
                    echo human_time_diff(get_comment_time('U'), current_time('timestamp')).'之前';    //显示格式 OOXX 之前
                }else{
                    printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time());    //显示格式 X年X月X日 OOXX 时
                }
            }
            break;
        case 'post';    //如果是日志的时间
            $time_diff = current_time('timestamp') - get_the_time('U');
            if($time_diff <= 300){
                echo ('刚刚');
            }else{
                if( $time_diff >= 300 && $time_diff <= 604800 ){  //七天之内
                    echo human_time_diff(get_the_time('U'), current_time('timestamp')).'之前';    //显示格式 OOXX 之前
                }else{
                    the_time('Y.m.d');    //显示格式 XX.XX.XX
                }
            }
            break;
    }
}
//END-----------------------------------

/*后台设置*/
function my_love_options() {
    add_theme_page("主题设置", "主题设置", 'administrator', basename(__FILE__), 'my_love_form');
    add_action( 'admin_init', 'register_mysettings' );
}
/*注册设置*/
function register_mysettings() {
    //register our settings
    register_setting( 'heart-settings', 'description');
    register_setting( 'heart-settings', 'keywords');
    register_setting( 'heart-settings', 'notice');
    register_setting( 'heart-settings', 'boyid');
    register_setting( 'heart-settings', 'girlid');
    register_setting( 'heart-settings', 'show_cat');
    register_setting( 'heart-settings', 'lovepic');
    register_setting( 'heart-settings', 'lovetime');
    register_setting( 'heart-settings', 'beian');
    register_setting( 'heart-settings', 'feed');
    register_setting( 'heart-settings', 'tongji');
    register_setting( 'heart-settings', 'bottomlink');
}
/*创建后台表格*/
function my_love_form(){
    global $themename;
    if ( $_REQUEST['settings-updated'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' 设置已保存。</strong></p></div>';
    ?>
    <style>
        fieldset {border: 1px solid #DDDDDD;border-radius: 5px 5px 5px 5px;margin: 5px 0 10px;padding: 0 15px;}
        fieldset legend {font-size: 14px;padding: 0 5px;}
    </style>
    <div class="icon32" id="icon-themes"><br></div>
    <h2>Heart Options</h2>
    <form method="post" action="options.php">
        <?php settings_fields('heart-settings'); ?>
        <fieldset>
            <legend>基础设置</legend>
            <table class="form-table">
                <tbody>
                <tr valign="top">
                    <th scope="row">SEO优化：
                        <br/>
                        <small style="font-weight:normal;">meta标签设置</small></th>
                    <td>
                        <div align="left">
                            关键词keywords 「以英文逗号隔开，建议不超过100字包括字符」<br />
                            <input type="text" style="width:50em;" name="keywords" value="<?php echo get_option('keywords'); ?>" />
                            <br /><br />
                            描述description 「建议不超过150字包括符号」<br />
                            <input type="text" style="width:50em;" name="description" value="<?php echo get_option('description'); ?>" />
                        </div></td>
                </tr>
                </tbody>
            </table>

            <table class="form-table">
                <tbody>
                <tr valign="top">
                    <th scope="row">公告设置：</th>
                    <br/>
                    <small style="font-weight:normal;"><?php _e('HTML enabled', 'heart'); ?></small></th>
                    <td>
                        <textarea style="width:50em; height:8em;" name="notice"><?php echo get_option('notice'); ?></textarea></td>
                </tr>
                </tbody>
            </table>
        </fieldset>
        <fieldset>
            <legend>情侣设置</legend>
            <table class="form-table">
                <tbody>
                <tr valign="top">
                    <th scope="row">男孩:</th>
                    <td>
                        <input type="text" style="width:30em;" name="boyid" value="<?php echo get_option('boyid'); ?>" />
                        <br/>
                        <span style="color:#666;">请输入男方作者的ID,仅支持数字</span>
                    </td>
                </tr>
                </tbody>
            </table>

            <table class="form-table">
                <tbody>
                <tr valign="top">
                    <th scope="row">女孩:</th>
                    <td>
                        <input type="text" style="width:30em;" name="girlid" value="<?php echo get_option('girlid'); ?>" />
                        <br/>
                        <span style="color:#666;">请输入女孩作者的ID,仅支持数字</span>
                    </td>
                </tr>
                </tbody>
            </table>

            <table class="form-table">
                <tbody>
                <tr valign="top">
                    <th scope="row">相爱时间：</th>
                    <td>
                        <input type="text" style="width:30em;" name="lovetime" value="<?php echo get_option('lovetime'); ?>" />
                        <br/>
                        <span style="color:#666;">请以[<span style="color:red">2011-01-01 00:00:00</span>]这种格式填写,不带"[]".</span>
                    </td>
                </tr>
                </tbody>
            </table>

            <table class="form-table">
                <tbody>
                <tr valign="top">
                    <th scope="row">照片墙显示的分类：</th>
                    <td>
                        <input type="text" style="width:30em;" name="show_cat" value="<?php echo get_option('show_cat'); ?>" /></td>
                </tr>
                </tbody>
            </table>

            <table class="form-table">
                <tbody>
                <tr valign="top">
                    <th scope="row">情侣合照</th>
                    <td>
                        <input type="text" style="width:30em;" name="lovepic" value="<?php echo get_option('lovepic'); ?>" />
                        <br/>
                        <span style="color:#666;">请加入你们合照的图片地址.大小是94*94,PNG,JPG都可以.</span>
                    </td>
                </tr>
                </tbody>
            </table>
        </fieldset>
        <fieldset>
            <legend>推广设置</legend>
            <table class="form-table">
                <tbody>
                <tr valign="top">
                    <th scope="row">Feed地址：</th>
                    <td>
                        <input type="text" style="width:30em;" name="feed" value="<?php echo get_option('feed'); ?>" /></td>
                </tr>
                </tbody>
            </table>

            <table class="form-table">
                <tbody>
                <tr valign="top">
                    <th scope="row">底部链接：</th>
                    <td>
                        <textarea style="width:50em; height:8em;" name="bottomlink"><?php echo get_option('bottomlink'); ?></textarea></td>
                </tr>
                </tbody>
            </table>

            <table class="form-table">
                <tbody>
                <tr valign="top">
                    <th scope="row">备案信息：</th>
                    <td>
                        <input type="text" style="width:30em;" name="beian" value="<?php echo get_option('beian'); ?>" /></td>
                </tr>
                </tbody>
            </table>

            <table class="form-table">
                <tbody>
                <tr valign="top">
                    <th scope="row">统计代码：</th>
                    <td>
                        <textarea style="width:50em; height:8em;" name="tongji"><?php echo get_option('tongji'); ?></textarea></td>
                </tr>
                </tbody>
            </table>

            <p class="submit"><input type="submit" value="<?php _e('Save Changes') ?>" name="save" id="button-primary" /></p>
        </fieldset>
    </form>

    <?php
}
add_action('admin_menu', 'my_love_options');
//END----------------------------------

/*页码导航*/
function wpdx_paging_nav_boy($who,$pageOtherSide,$pageNow){
    global $wp_query;
    $published_posts=count_user_posts(get_option('boyid'), 'post', false);
    $posts_per_page = get_option('posts_per_page');
    $page_number_max = ceil($published_posts / $posts_per_page);
    $big = 999999999; // 需要一个不太可能的整数
    $pagination_links_boy = paginate_links( array(
        'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        'format' => '/page/%#%',
        'current' => $pageNow,
        'total' => $page_number_max,
        'add_args'=>array("pagedType" => $who,"otherSidePagedNum"=> $pageOtherSide)
    ) );

    echo $pagination_links_boy;
}

/*页码导航*/
function wpdx_paging_nav_girl($who,$pageOtherSide,$pageNow){
    global $wp_query;
    $published_posts=count_user_posts(get_option('girlid'), 'post', false);
    $posts_per_page = get_option('posts_per_page');
    $page_number_max = ceil($published_posts / $posts_per_page);
    $big = 999999999; // 需要一个不太可能的整数
    $pagination_links_girl = paginate_links( array(
        'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        'format' => '/page/%#%',
        'current' => $pageNow,
        'total' => $page_number_max,
        'add_args'=>array("pagedType" => $who,"otherSidePagedNum"=> $pageOtherSide)
    ) );

    echo $pagination_links_girl;
}

//END-----------------------------

// 添加特色图像功能
add_theme_support('post-thumbnails');
set_post_thumbnail_size(300, 430, true); // 图片宽度与高度

//END-----------------------------

//注册小工具栏
register_sidebar(array(
    'name' => '位于页脚的小工具一',
    'id' => 'footer-1',
    'description' => '第一个小工具区域',
    'before_widget' => '<div id="%1$s" class="%2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2>',
    'after_title' => '</h2>',
));

register_sidebar(array(
    'name' => '位于页脚的小工具二',
    'id' => 'footer-2',
    'description' => '第二个小工具区域',
    'before_widget' => '<div id="%1$s" class="%2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2>',
    'after_title' => '</h2>',
));

register_sidebar(array(
    'name' => '位于页脚的小工具三',
    'id' => 'footer-3',
    'description' => '第三个小工具区域',
    'before_widget' => '<div id="%1$s" class="%2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2>',
    'after_title' => '</h2>',
));
//END-----------------------------
 ?>


