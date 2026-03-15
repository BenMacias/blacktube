<?php get_header(); ?>
    
<div class="main">

	<h1>Sorry, no videos matched your criteria</h1><br/>
        <!--Related Videos -->
<?php
// Safely get and validate the sortby parameter
$v_sortby = $_GET['v_sortby'] ?? '';
$allowed_values = ['views', 'date'];
if (!in_array($v_sortby, $allowed_values)) { $v_sortby = ''; }
?>
<div class="headline">
	<h2>Video Suggestions</h2>
	<div class="sorting">
		<a class="btn sub<?php if ($v_sortby == "views") { ?> active<?php } ?>" href="<?php echo site_url(); ?>/?v_sortby=views&amp;v_orderby=desc">Most Viewed</a>
		<a class="btn sub<?php if ($v_sortby != "views") { ?> active<?php } ?>" href="<?php echo site_url(); ?>">Date</a>
	</div>
</div>
 
<?php get_template_part('includes/related_videos'); ?>  
 </div> <!--END main--> 
    
<?php get_footer(); ?>