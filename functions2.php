<?
class Walker_Category2 extends Walker {

  var $tree_type = 'category';

  var $db_fields = array ('parent' => 'parent', 'id' => 'term_id');

  function start_lvl(&$output, $depth, $args) {
    if ( 'list' != $args['style'] )
      return;

    $indent = str_repeat("\t", $depth);
    $class='children';
    if($args['ulclass'])
      $class=$args['ulclass'];
    $output .= $indent.'<ul class="'.$class.'">'."\n";
  }

  function end_lvl(&$output, $depth, $args) {
    if ( 'list' != $args['style'] )
      return;

    $indent = str_repeat("\t", $depth);
    $output .= "$indent</ul>\n";
  }

  function start_el(&$output, $category, $depth, $args) {
    extract($args);

    $cat_name = esc_attr( $category->name);
    $cat_name = apply_filters( 'list_cats', $cat_name, $category );
    $link = '<a href="' . get_category_link( $category->term_id ) . '" ';
    if ( $use_desc_for_title == 0 || empty($category->description) )
      $link .= 'title="' . sprintf(__( 'View all posts filed under %s' ), $cat_name) . '"';
    else
      $link .= 'title="' . esc_attr( strip_tags( apply_filters( 'category_description', $category->description, $category ) ) ) . '"';
    $link .= '>';
    $link .= $cat_name . '</a>';

    if ( (! empty($feed_image)) || (! empty($feed)) ) {
      $link .= ' ';

      if ( empty($feed_image) )
        $link .= '(';

      $link .= '<a href="' . get_category_feed_link($category->term_id, $feed_type) . '"';

      if ( empty($feed) )
        $alt = ' alt="' . sprintf(__( 'Feed for all posts filed under %s' ), $cat_name ) . '"';
      else {
        $title = ' title="' . $feed . '"';
        $alt = ' alt="' . $feed . '"';
        $name = $feed;
        $link .= $title;
      }

      $link .= '>';

      if ( empty($feed_image) )
        $link .= $name;
      else
        $link .= "<img src='$feed_image'$alt$title" . ' />';
      $link .= '</a>';
      if ( empty($feed_image) )
        $link .= ')';
    }

    if ( isset($show_count) && $show_count )
      $link .= ' (' . intval($category->count) . ')';

    if ( isset($show_date) && $show_date ) {
      $link .= ' ' . gmdate('Y-m-d', $category->last_update_timestamp);
    }

    if ( isset($current_category) && $current_category )
      $_current_category = get_category( $current_category );

    if ( 'list' == $args['style'] ) {
      $output .= "\t<li";
      $class = 'cat-item cat-item-'.$category->term_id;
      if ( isset($current_category) && $current_category && ($category->term_id == $current_category) )
        $class .=  ' current-cat';
      elseif ( isset($_current_category) && $_current_category && ($category->term_id == $_current_category->parent) )
        $class .=  ' current-cat-parent';
      if($args['liclass'])
        $class=$args['liclass'];
      $output .=  ' class="'.$class.'"';
      $output .= ">$link\n";
    } else {
      $output .= "\t$link<br />\n";
    }
  }
  function end_el(&$output, $page, $depth, $args) {
    if ( 'list' != $args['style'] )
      return;

    $output .= "</li>\n";
  }

}



function wp_list_categories2( $args = '' ) {
  $defaults = array(
    'show_option_all' => '', 'orderby' => 'name',
    'order' => 'ASC', 'show_last_update' => 0,
    'style' => 'list', 'show_count' => 0,
    'hide_empty' => 1, 'use_desc_for_title' => 1,
    'child_of' => 0, 'feed' => '', 'feed_type' => '',
    'feed_image' => '', 'exclude' => '', 'exclude_tree' => '', 'current_category' => 0,
    'hierarchical' => true, 'title_li' => __( 'Categories' ),
    'echo' => 1, 'depth' => 0,'liclass'=>'categories','aclass'=>'','ulclass'=>''
  );

  $r = wp_parse_args( $args, $defaults );

  if ( !isset( $r['pad_counts'] ) && $r['show_count'] && $r['hierarchical'] ) {
    $r['pad_counts'] = true;
  }

  if ( isset( $r['show_date'] ) ) {
    $r['include_last_update_time'] = $r['show_date'];
  }

  if ( true == $r['hierarchical'] ) {
    $r['exclude_tree'] = $r['exclude'];
    $r['exclude'] = '';
  }
  extract( $r );
  $categories = get_categories( $r );
  $output = '';
  if ( $title_li && 'list' == $style )
      $output = '<li class="'.$r['liclass'].'"><a href="#" class="' . $r['aclass'] . '">' . $r['title_li'] . '</a><ul class="'.$r['ulclass'].'">';

  if ( empty( $categories ) ) {
    if ( 'list' == $style )
      $output .= '<li class="'.$r['liclass'].'">' . __( "No categories" ) . '</li>';
    else
      $output .= __( "No categories" );
  } else {
    global $wp_query;

    if( !empty( $show_option_all ) )
      if ( 'list' == $style )
        $output .= '<li class="'.$r['liclass'].'"><a class="'.$r['aclass'].'" href="' .  get_bloginfo( 'url' )  . '">' . $show_option_all . '</a></li>';
      else
        $output .= '<a href="' .  get_bloginfo( 'url' )  . '">' . $show_option_all . '</a>';

    if ( empty( $r['current_category'] ) && is_category() )
      $r['current_category'] = $wp_query->get_queried_object_id();

    if ( $hierarchical )
      $depth = $r['depth'];
    else
      $depth = -1; // Flat.
    $walker=new Walker_Category2;
    $output.=$walker->walk($categories,$depth,$r);
  }

  if ( $title_li && 'list' == $style )
    $output .= '</ul></li>';

  $output = apply_filters( 'wp_list_categories', $output );
  if ( $echo )
    echo $output;
  else
    return $output;
}
  ?>