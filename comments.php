<?php // Do not delete these lines
	if (isset($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.'); ?></p>
	<?php
		return;
	}
?>

	<?php if ($comments) { ?>
<div class="allcomments">
	<b><?php comments_number(__('No Comments'), __('1 Comment'), __('% Comments')); ?> to '<?php the_title(); ?>'</b>
  <ul class="commentlist">
    <?php wp_list_comments('type=all&callback=theme_comment&style=ul'); ?>
  </ul>
<div class="navigation">
  <?php if(function_exists('wp_commentnavi')) wp_commentnavi();
  else{ ?>
  <div class="alignleft"><?php previous_comments_link() ?></div>
  <div class="alignright"><?php next_comments_link() ?></div>
  <?}?>
<?if(function_exists('show_manual_subscription_form'))show_manual_subscription_form();?>
</div>
</div>
<?php } else { // this is displayed if there are no comments so far ?>

	<?php if ('open' == $post->comment_status) {?>
		<!-- If comments are open, but there are no comments. -->

	 <?php } else { // comments are closed ?>
		<!-- If comments are closed. -->
		<div class="allcomments"><p class="nocomments"><?php _e('Comments are closed.'); ?></p></div>

	<?php } ?>
<?php } ?>


<?php if ('open' == $post->comment_status) {?>
<div id="respond" class="allcomments" style="margin-top:0;">
  <h3><?php comment_form_title( __('Leave a Reply'), __('Leave a Reply for %s') ); ?></h3>
  <div id="cancel-comment-reply">
	  <small><?php cancel_comment_reply_link() ?></small>
  </div>

<?php if ( get_option('comment_registration') && !$user_ID ) { ?>
<p><?php printf(__('You must be <a href="%s">logged in</a> to post a comment.'), get_option('siteurl') . '/wp-login.php?redirect_to=' . urlencode(get_permalink())); ?></p>
<?php }else { ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<?php if ( $user_ID ) {?>

<p><?php printf(__('Logged in as <a href="%1$s">%2$s</a>.'), get_option('siteurl') . '/wp-admin/profile.php', $user_identity); ?> <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e('Log out of this account'); ?>"><?php _e('Log out &raquo;'); ?></a></p>

<?php }else {?>

<p><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
<label for="author"><small><?php _e('Name'); ?> <?php if ($req) _e("(required)", "kubrick"); ?></small></label></p>

<p><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
<label for="email"><small><?php _e('Mail (will not be published)'); ?> <?php if ($req) _e("(required)", "kubrick"); ?></small></label></p>

<p><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
<label for="url"><small><?php _e('Website'); ?></small></label></p>

<?php } ?>

<!--<p><small><?php printf(__('<strong>XHTML:</strong> You can use these tags: <code>%s</code>'), allowed_tags()); ?></small></p>-->

<?php do_action('comment_form', $post->ID); ?>
<?php comment_id_fields(); ?>
<p><textarea name="comment" id="comment" cols="100%" rows="10" tabindex="4"></textarea></p>

<p><input name="submit" type="submit" id="submit" tabindex="5" value="<?php _e('Submit Comment'); ?>" />
</p>

</form>

<?php } // If registration required and not logged in ?>
</div><?php } ?>

<?php if ('closed' == $post->comment_status) {?>
<div class="allcomments">Comments closed.<br>
Please use <a href="http://jehy.ru/mail.en.html" rel="nofollow">contact form</a> if you need smth.<br><br>
Комментарии закрыты.<br>
Используйте <a href="http://jehy.ru/mail.html" rel="nofollow">форму обратной связи</a>, если что-то нужно.</div>
<?}?>