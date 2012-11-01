
<div id="sidebar" class="span-5 append-1 last">
	<div id="wrapbox">
	
		<?/*
include('style.inc');
include('functions2.php');<div class="sidebarbox">
			<h3>Categories</h3>
			<ul class="cssMenu" style="text-indent: 0px;">
          <?php wp_list_categories2('hide_empty=0&style=list&hierarchical=true&show_count=1&liclass=cssMenui&aclass=cssMenui&&echo=1');
      ?>
			</ul>
		</div>*/?>
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>		
		
		<div class="sidebarbox">			
			<ul class="pages"><?php wp_list_pages('title_li=<h3>' . __('Pages') . '</h3>' ); ?></ul>
		</div>
		
		<div class="sidebarbox">
			<h3>Archives</h3>
			<ul>
				<?php wp_get_archives('type=monthly'); ?>
			</ul>
		</div>
		
		<div class="sidebarbox">
			<h3>Categories</h3>
			<ul>
				<?php wp_list_cats(); ?>
			</ul>
		</div>
		
		<div class="sidebarbox">
			<h3>Blogroll</h3>
			<ul>
				<?php get_links('-1', '<li>', '</li>', '', 0, 'name', 0, 0, -1, 0); ?>
			</ul>
		</div>
		
		<div class="sidebarbox">
			<h3>Meta</h3>
			<ul>
				<li><?php wp_loginout(); ?></li>
				<li><a href="feed:<?php bloginfo('rss2_url'); ?>" title="<?php _e('Syndicate this site using RSS'); ?>">Site Feed</a></li>
				<li><a href="feed:<?php bloginfo('comments_rss2_url'); ?>" title="<?php _e('The latest comments to all posts in RSS'); ?>">Comments Feed</a></li>
				<?php wp_meta(); ?>
			</ul>
		</div>
		
		<?php endif; ?>
	</div>
</div>