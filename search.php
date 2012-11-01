<?php get_header(); ?>

 <!-- posts  -->
<div id="posts" class="span-16 prepend-1 append-1">
	<?php if (have_posts()) : ?>

		<div class="post">
			<div class="postheader">
				<div class="posttitle">
					<h2>Search results for: <?php the_search_query(); ?></h2>
				</div>
			</div>
		</div>
		<?php while (have_posts()) : the_post(); ?>
	
		<div class="post" id="post-<?php the_ID(); ?>">
			<div class="postheader">
				
					<table><tr><td><div class="posttitle">
					<h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2></div></td><td id="postmeta"><span><?php the_author_link(); ?><br><?php the_time('j F Y'); ?> </span></td><td class="gravatar"><?php if(function_exists("get_avatar")) echo get_avatar(get_the_author_email(), 64); ?></td></tr></table>
			</div>
			<div class="postcontent">
			<?php the_content(__('<br/>Continue reading...')); ?></div>
			<table><tr><td class="posttags"><?php the_tags(__('Tags').': ', ', ', ''); ?></td><td><?php the_category(',') ?></td><td><?php edit_post_link(__('Edit')); ?></td><td id="commentcount"><a href="<?php comments_link(); ?>"><?php echo __('Comments');?> 
						[ <?php comments_number(__('0'), __('1'), __('%')) ?> ]
					</a></td></tr></table></div>
	<?php endwhile; ?>
	
	<div class="navlinks">
		<?php next_posts_link('&laquo; Previous posts') ?> <?php previous_posts_link('Next posts &raquo;') ?><br/><br/>
		<a href="#posts"><img src="<?php bloginfo('template_directory'); ?>/images/backtotopicon.gif" alt="Back to top" />Back to top</a>
	</div>
	
	<?php else : ?>
	
	<div class="post">
		<h2>Not found!</h2>
		<p><?php _e('Sorry, we didn`t find anything according to your request. You were searching for something wrong :)'); ?></p>	
	</div>
		
<?php endif; ?>
</div>
	
<?php get_sidebar(); ?>

<?php get_footer(); ?>