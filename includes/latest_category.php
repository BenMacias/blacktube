<ul class="latestVideos">
<?php
if(get_option('num_vid_cat') !=""){
	$num = get_option('num_vid_cat');
}else{
	$num = 6;
}
$cat_args = array(
  'orderby' => 'name',
  'order' => 'ASC',
  'number' => $num,
  'child_of' => 0,
  'show_count' => 1
);
$categories =   get_categories($cat_args);
foreach($categories as $category) {
    echo '<li>';
    echo '<h3><a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "View all videos in %s" ), $category->name ) . '" ' . '>' . $category->name.'</a></h3>';


     $post_args = array(
      'numberposts' => 1,
      'category' => $category->term_id
    );
    $posts = get_posts($post_args);
	echo '<div>';
	foreach($posts as $post) {
	?>
		<div class="thumbnail">
        <a class="thumb" href="<?php the_permalink(); ?>">
        <?php if ( has_post_thumbnail() ) { echo the_post_thumbnail();}else{ ?><img src="<?php bloginfo('template_directory'); ?>/img/pixel.png" data-src="<?php echo get_post_meta($post->ID, get_option('amn_thumbs'), true); ?>" alt="<?php the_title(); ?>" /><?php } ?>
        </a></div>
	<?php
	}
	echo '</div>';
	if(get_option('cat_desc') == 'checked') {echo short_desc('...', '120',category_description( $category->term_id ));}
	echo '<div class="buttons"><a class="btn" href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "View all videos in %s" ), $category->name ) . '" ' . '>Tümü '.$category->count.' videos in ' . $category->name.'</a></div>';
	echo '</li>';
}
?>
</ul>