<?php
/*
function readBanner($filename)
{		
	$path = TEMPLATEPATH . '/' . $filename;
	if ( file_exists( $path ) )		
		print file_get_contents($path);
}
*/
// Widget Settings

if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Sidebar',
		'before_widget' => '<div id="%1$s" class="sidebarbox">', 
	'after_widget' => '</div>', 
	'before_title' => '<h3>', 
	'after_title' => '</h3>', 
	));
	
function widget_webdemar_search() {
?>
    	<div class="sidebarbox">
			<h3>Search</h3>
				<div class="searchform">
					<form method="get" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
						<input type="text" name="s" id="search" />	
						<input type="hidden" id="search-submit" value="Search" />		
					</form>
				</div>
		</div>
	
<?php
}

if ( function_exists('register_sidebar_widget') )
    register_sidebar_widget(__('Search'), 'widget_webdemar_search');

function theme_comment($comment,$args,$depth)
{$GLOBALS['comment'] = $comment;
	?> 
		  
<div class="commentbox" id="comment-<?php comment_ID() ?>">
			<?php if ($comment->comment_approved == '0') : ?>
				<em>Your comment is awaiting moderation.</em>
		    <?php endif; ?>
        
        <?php if($depth==1){?>
              <div class="comment-meta">
                <?}else{?>
              <div class="comment-meta-lit"><?}?>
		
        <div class="avatar"><?php if($depth==1)echo get_avatar( $comment, 64 );else echo get_avatar( $comment, 40 );?></div>
          <div class="name">
          <strong><?php comment_author_link(); ?></strong></div>
          <div class="data"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a>
          </div>
          <div class="edit"><?php edit_comment_link(__('(Edit)'),'  ','') ?></div><?php if(function_exists('useragent_output_custom'))
				{?><div class="useragent"><?
				  useragent_output_custom();
          ?></div><?
				}
				  ?></div>

			<div class="commenttext" style="margin:0;">
            	<?php comment_text(); ?>
            </div>

      <div class="reply">
         <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
      </div>


		</div><?
}
?>