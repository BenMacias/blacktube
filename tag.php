<?php
/**
 * The template for displaying tag archive pages
 */
get_header(); ?>

<div class="main">

    <?php if (have_posts()) : ?>
    <?php
    // Safely get and validate the v_sortby parameter
    $v_sortby = $_GET['v_sortby'] ?? '';
    $allowed_values = ['views', 'date'];
    if (!in_array($v_sortby, $allowed_values)) {
        $v_sortby = '';
    }
    ?>
    
    <div class="headline">
        <?php if ($v_sortby == "views") : ?>
            <h2>Most Viewed Videos</h2>
        <?php else : ?>
            <h2>Search Results for <span class="tag-title"><?php echo esc_html(single_tag_title('', false)); ?></span></h2>
        <?php endif; ?>
        
        <div class="sorting">
            <a class="btn sub<?php echo ($v_sortby == "views") ? ' active' : ''; ?>" href="?v_sortby=views&amp;v_orderby=desc">Most Viewed</a>
            <a class="btn sub<?php echo ($v_sortby != "views") ? ' active' : ''; ?>" href="<?php echo esc_url(get_tag_link(get_queried_object_id())); ?>">Date</a>
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
    </div>

    <?php else : ?>
        <h2>Sorry, no videos matched your criteria</h2>
    <?php endif; ?>

    <!-- Pagination -->
    <ul class="pagination">
        <?php 
        global $wp_query;
        if (function_exists("pagination")) {
            pagination($wp_query->max_num_pages);
        } elseif (function_exists("the_posts_pagination")) {
            the_posts_pagination(array(
                'mid_size' => 2,
                'prev_text' => __('&laquo; Previous'),
                'next_text' => __('Next &raquo;'),
            ));
        }
        ?>
    </ul>
    <!-- END Pagination -->

    <?php 
    if (is_home() && !is_paged() && get_option('cat_index') == 'checked') {
        get_template_part('includes/latest_category');
    }
    ?>
</div> <!--END main-->

<?php get_footer(); ?>