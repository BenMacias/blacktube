<?php get_header(); ?>
<div class="main">
	<?php if(have_posts()) { ?>
	<?php
		// 1. Get the value with a safe default
		$v_sortby = $_GET['v_sortby'] ?? 'date';
		
		// 2. Define what values are allowed
		$allowed_sort_options = ['date', 'views'];
		
		// 3. Validate the input. If it's not allowed, revert to default.
		if (!in_array($v_sortby, $allowed_sort_options)) {
		    $v_sortby = 'date';
		}
		?>
	<div class="headline">
		<?php if ($v_sortby === "views") { ?>
		<h2>Most Viewed</h2>
		<?php } else { ?>
		<h2>New Videos</h2>
		<?php } ?>
		<div class="sorting">
			<a class="btn sub<?php if ($v_sortby === "views") { ?> active <?php } ?>" href="<?php echo site_url(); ?>/?v_sortby=views&amp;v_orderby=desc">Most Viewed</a>
			<a class="btn sub<?php if ($v_sortby === "date") { ?> active <?php } ?>" href="<?php echo site_url(); ?>">Newest</a>
		</div>
	</div>
	<div class="video_block">
		<ul class="video_list">
			<?php while (have_posts()) : the_post(); ?>
			<li class="video" id="video_<?php the_ID(); ?>">
				<?php getThumb(get_the_ID()); ?>
			</li>
			<?php endwhile; ?>
		</ul>
		<?php } else { ?>
		<h2>Sorry, no videos matched your criteria</h2>
		<?php } ?>
	</div>
	<!--Pagination-->               
	<ul class="pagination">
		<?php 
			// Check if $additional_loop exists and has the property, otherwise use the main query
			if (function_exists("pagination")) {
			    if (isset($additional_loop) && is_object($additional_loop) && property_exists($additional_loop, 'max_num_pages')) {
			  		    pagination($additional_loop->max_num_pages);
			    } else {
			        global $wp_query;
			        pagination($wp_query->max_num_pages);
			    }
			} ?>
	</ul>
	<!--END Pagination--> 
	<?php if(is_home() && !is_paged() && get_option('cat_index') == 'checked') { get_template_part('includes/latest_category');} ?>  
</div>
<!--END main-->       
<?php get_footer(); ?>