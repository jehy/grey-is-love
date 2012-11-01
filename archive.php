<?php get_header(); ?>

 <!-- posts  -->
<div id="posts" class="span-16 prepend-1 append-1">
	<?php if (have_posts()) : ?>

	<?php while (have_posts()) : the_post(); ?>
	
		<div class="post" id="post-<?php the_ID(); ?>">
			<div class="postheader">
				<div class="posttitle">
					<h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
<?php the_time('j F Y, H:m:i'); ?><br>
<?if(function_exists('the_music'))the_music()?></div><div  class="gravatar"><?php true_avatar(); ?></div>
			</div>
			<div class="postcontent">
			<?php the_content(__('<br/>Continue reading...')); ?></div>
      <div class="postmeta">
			<div class="posttags"><?php the_tags(__('Tags').': ', ', ', ''); ?></div><?php/* the_category(',')*/ ?><div class="editlink"><?php edit_post_link(__('Edit')); ?></td></div><div id="commentcount"><a href="<?php comments_link(); ?>"><?php echo __('Comments');?> 
						[ <?php comments_number(__('0'), __('1'), __('%')) ?> ]
					</a></div></div>
      </div>
		<?php comments_template(); ?>
	<?php endwhile; ?>	
	
	<div class="navlinks">
<?php if(function_exists('wp_pagenavi')) wp_pagenavi();
elseif(function_exists('wp_page_numbers')) wp_page_numbers();
else
{	  
	next_posts_link('&laquo; Previous posts');
	previous_posts_link('Next posts &raquo;');
}?><br/><br/>
		<a href="#posts"><img src="<?php bloginfo('template_directory'); ?>/images/backtotopicon.gif" alt="Back to top" />Back to top</a>
	</div>
	
	<?php else : ?>
	
	<div class="post">
		<h2>Not found!</h2>
		<p><?php _e('Sorry, this page does not exist.'); ?></p>
		<?php include (TEMPLATEPATH . "/searchform.php"); ?>	
	</div>
		
<?php endif; ?>
</div>
	
<?php get_sidebar(); ?>

<?php get_footer(); ?>