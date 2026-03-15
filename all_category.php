<?php
/**
 * Template Name: All Categories
 * Description: A Page Template displaying all categories
 */
get_header(); ?>

<div class="main">
    <div class="headline">
        <h2>Categories</h2>
        <div class="sorting">
            <?php
            // Safely get and validate the v_sortby parameter
            $v_sortby = $_GET['v_sortby'] ?? '';
            $allowed_values = ['views', 'date'];
            if (!in_array($v_sortby, $allowed_values)) {
                $v_sortby = '';
            }
            ?>
            <a class="btn sub<?php echo ($v_sortby == "views") ? ' active' : ''; ?>" href="?v_sortby=views&amp;v_orderby=desc">Most Viewed</a>
            <a class="btn sub<?php echo ($v_sortby != "views") ? ' active' : ''; ?>" href="<?php echo esc_url(home_url('/')); ?>">Date</a>
        </div>
    </div>

    <ul class="latestVideos">
    <?php
    $cat_args = array(
        'orderby' => 'name',
        'order' => 'ASC',
        'hide_empty' => true, // Only show categories with posts
        'parent' => 0 // Only top-level categories
    );
    
    $categories = get_categories($cat_args);
    
    foreach ($categories as $category) {
        echo '<li>';
        echo '<h3><a href="' . esc_url(get_category_link($category->term_id)) . '" title="' . esc_attr__('View all videos in', 'textdomain') . ' ' . esc_attr($category->name) . '">' . esc_html($category->name) . '</a></h3>';
        
        echo '<a href="' . esc_url(get_category_link($category->term_id)) . '" title="' . esc_attr__('View all videos in', 'textdomain') . ' ' . esc_attr($category->name) . '">';
        
        // Get latest post in category
        $post_args = array(
            'posts_per_page' => 1,
            'category__in' => array($category->term_id),
            'post_status' => 'publish',
            'suppress_filters' => false
        );
        
        $posts = get_posts($post_args);
        
        if ($posts) {
            $post = $posts[0];
            setup_postdata($post);
            ?>
            <div class="thumbnail">
                <?php
                if (has_post_thumbnail()) {
                    echo get_the_post_thumbnail($post->ID, 'thumbnail', array('alt' => esc_attr(get_the_title())));
                } else {
                    $thumb_meta = get_post_meta($post->ID, get_option('amn_thumbs'), true);
                    $thumb_url = '';
                    
                    if (is_array($thumb_meta)) {
                        $thumb_url = $thumb_meta[0] ?? '';
                    } else {
                        $thumb_url = $thumb_meta;
                    }
                    
                    if (!empty($thumb_url)) {
                        echo '<img src="' . esc_url($thumb_url) . '" alt="' . esc_attr(get_the_title()) . '" />';
                    } else {
                        // Fallback image
                        echo '<img src="' . esc_url(get_template_directory_uri() . '/img/placeholder.jpg') . '" alt="' . esc_attr($category->name) . '" />';
                    }
                }
                ?>
            </div>
            <?php
            wp_reset_postdata(); // Critical after setup_postdata
        } else {
            // No posts in category - show placeholder
            echo '<div class="thumbnail">';
            echo '<img src="' . esc_url(get_template_directory_uri() . '/img/placeholder.jpg') . '" alt="' . esc_attr($category->name) . '" />';
            echo '</div>';
        }
        
        echo '</a>';
        
        // Category description
        if (get_option('cat_desc') == 'checked') {
            $description = category_description($category->term_id);
            if (!empty($description)) {
                if (function_exists('short_desc')) {
                    short_desc('...', '120', $description);
                } else {
                    echo '<div class="category-desc">' . wp_kses_post(wp_trim_words($description, 20, '...')) . '</div>';
                }
            }
        }
        
        echo '<div class="buttons"><a class="btn" href="' . esc_url(get_category_link($category->term_id)) . '">View all ' . intval($category->count) . ' videos in ' . esc_html($category->name) . '</a></div>';
        echo '</li>';
    }
    ?>
    </ul>

    <!-- Mobile categories list (simplified) -->
    <ul class="latestVideos mobileCat">
    <?php
    foreach ($categories as $category) {
        echo '<li>';
        echo '<h3><a href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . ' (' . intval($category->count) . ')</a></h3>';
        echo '</li>';
    }
    ?>
    </ul>
</div> <!--END main-->

<?php get_footer(); ?>