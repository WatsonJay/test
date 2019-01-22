<?php if (function_exists('wp_list_comments')) : ?>

<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments">这篇文章受到密码保护，请输入密码后查看</p>
	<?php
		return;
	}
?>

<!-- You can start editing here. -->
<?php if ('open' == $post->comment_status) : ?>

<div class="respond-area">

<div id="respond">

	<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
	<p>你还没有登录，请<a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">登录</a> 留言。</p>
	<?php else : ?>

	<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

	<?php if ( $user_ID ) : ?>

					<?php 
						global $wpdb;
						$user_temple= $wpdb->get_row("SELECT * FROM $wpdb->users WHERE ID = $user_ID", ARRAY_A);  //从数据库中取得ID为登录ID的一行，并组成数列
						$respond_display_name = $user_temple['display_name']; //从数列中得到colum为display_name的值，并且显示。
						$temple_email=$user_temple['user_email'];
						echo '<div class="respond-avatar">'.my_avatar($temple_email,36,'').'</div>';						
					?>
					<div class="respond-welcome">
						<?php printf( __('您已登录 %s.'), '<a href="' . get_option('siteurl') . '/wp-admin/profile.php">' . $user_identity . '</a>' ); ?> <a href="<?php echo wp_logout_url( get_permalink() ); ?>" title="<?php _e('退出'); ?>"><?php _e('退出 &raquo;'); ?></a>
						</br>
						<?php _e('欢迎回来'); ?>
					</div>

	<?php elseif ( '' != $comment_author ): ?>

				<?php if($_COOKIE["comment_author_" . COOKIEHASH]!=""){
						echo '<div class="respond-avatar">'.my_avatar($_COOKIE["comment_author_email_" . COOKIEHASH],36,'').'</div>';
					}
				?>
	
				<div class="respond-welcome">
				
					<?php printf(__('欢迎回来 <strong>%s</strong>'), $comment_author); ?>
					
					<a href="javascript:toggleCommentAuthorInfo();" id="toggle-comment-author-info">
						<?php _e(' | 展开↓'); ?>
					</a>
						<script type="text/javascript" charset="utf-8">
						//<![CDATA[
							var changeMsg = "<?php echo  esc_js( __(' | 展开↓') ); ?>";
							var closeMsg = "<?php echo esc_js( __(' | 关闭↑') ); ?>";
							
							function toggleCommentAuthorInfo() {
								jQuery('#comment-author-info').slideToggle('slow', function(){
									if ( jQuery('#comment-author-info').css('display') == 'none' ) {
										jQuery('#toggle-comment-author-info').text(changeMsg);
									} else {
										jQuery('#toggle-comment-author-info').text(closeMsg);
									}
								});
							}

							jQuery(document).ready(function(){
								jQuery('#comment-author-info').hide();
							});
						//]]>
						</script>
						
					<div style="clear:both"></div>
				</div><!---没有登录时的欢迎信息--->
			<?php endif; ?>

<div style="clear:both"></div>
			
			<?php if ( ! $user_ID ): ?>
				<div id="comment-author-info">
					<p>
						<input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
						<label for="author"><small>名字 <?php if ($req) echo "(必须填写)"; ?></small></label>
						</br>
						<input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
						<label for="email"><small>邮箱 亲~不会公开显示哦~ <?php if ($req) echo "(必须填写)"; ?><a href="http://en.gravatar.com" title="申请头像" target="_blank">点此申请头像</a></small></label>
						</br>
						<input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
						<label for="url"><small>个人站点</small></label>
					</p>
				</div>
	<?php endif; ?>

<div style="clear:both"></div>

	<?php include('smiley.php'); ?>

	<p><textarea name="comment" id="comment" cols="100%" rows="10" tabindex="4" onkeydown="if(event.ctrlKey&&event.keyCode==13){document.getElementById('submit').click();return false};"></textarea></p>

<div style="clear:both"></div>

	<input name="submit" type="submit" id="submit" tabindex="5" value="" />
	<?php cancel_comment_reply_link(' '); ?>
	<input type="checkbox" name="comment_mail_notify" id="comment_mail_notify" value="comment_mail_notify" checked="checked" title="当有回复时邮件通知(仅当填写邮箱有效时)" style="line-height:14px;width:14px;height:14px;margin-right:8px;margin-top:4px;" /><span>有人回复时通知我。</span>
	<div style="clear:both;"></div>
	<div class="QapTcha"></div>

<div style="clear:both"></div>
	<?php do_action('comment_form', $post->ID); ?>
	<?php comment_id_fields(); ?> 
	</form>

<div style="clear:both"></div>

	<?php endif; // If registration required and not logged in ?>
</div>
	<?php if ( $ping_count ) : ?>
		<div id="trackbacks-list" class="comments">
			<h3><?php printf($ping_count > 1 ? '%d Trackbacks' : '1 Trackback', $ping_count) ?></h3>
			<ol>
				<?php foreach ( $comments as $comment ) : ?>
				<?php if ( get_comment_type() != "comment" ) : ?>
					<li id="comment-<?php comment_ID() ?>">
					<?php comment_author_link(); ?>
				<?php if ($comment->comment_approved == '0') echo('<i>Your trackback is awaiting moderation.</i>\n'); ?>
					</li>
				<?php endif ?>
				<?php endforeach; ?>
			</ol>
		</div>
	<?php endif; ?>
	<?php endif; ?>
<?php endif; ?>

</div><!---respond-area-->



<!------以下是评论部分-------------->
<?php if ( have_comments() ) : ?>
	
	<div class="comments-nav-wrap">
		<span class="comments-title"><?php comments_number('等你来发言', '有1位朋友评论此文', '有%位朋友评论此文' );?></span>
		<span id="comments-nav">
			<?php paginate_comments_links('prev_text=上一页&next_text=下一页');?>
		</span>
	</div> <!---如果有评论才显示此区域--->
	
	<ol id="commentlist">
		<?php wp_list_comments(); ?>
	</ol>

	<div class="bottom-comments-nav-wrap">
		<span id="comments-nav">
			<?php paginate_comments_links('prev_text=上一页&next_text=下一页');?>
		</span>
		
		<span class="bottom-act">
			<a class="goto_post" style="cursor:pointer" >返回文章</a>
			<?php _e('|  '); ?>
			<a class="goto_comment" style="cursor:pointer" >查看评论</a>
			<?php _e('|  '); ?>
			<a class="expand_all_cmt" style="cursor:pointer">展开/收缩全部评论</a>
		</span>
	</div>

 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ('open' == $post->comment_status) : ?>
		<!-- If comments are open, but there are no comments. -->
		<span class="no-comment-title">出租沙发~</span>
		
	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="nocomments">此留言已关闭。</p>
	<?php endif; ?>
<?php endif; ?>