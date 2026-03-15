<?php
/**
 * The template for displaying archive pages
 */
get_header(); ?>

<div class="main">
    <div class="content">
        <div class="posts">
            <?php if (have_posts()) : ?>
                <h2 class="page-title">
                    <a href="<?php echo esc_url(home_url('/')); ?>"><?php echo esc_html(get_bloginfo('name')); ?></a>
                    <?php 
                    // Display archive title
                    if (is_day()) {
                        printf(esc_html__('Daily Archives: %s', 'textdomain'), get_the_date());
                    } elseif (is_month()) {
                        printf(esc_html__('Monthly Archives: %s', 'textdomain'), get_the_date('F Y'));
                    } elseif (is_year()) {
                        printf(esc_html__('Yearly Archives: %s', 'textdomain'), get_the_date('Y'));
                    } else {
                        echo esc_html(get_the_archive_title());
                    }
                    ?>
                </h2>
                
                <?php while (have_posts()) : the_post(); ?>
					<li class="video" id="video_<?php the_ID(); ?>">
						<?php getThumb(get_the_ID()); ?>
                        <span>Added: <?php the_time('F j, Y'); ?> at <?php the_time('g:i a'); ?></span>
                        <span><?php the_tags('Tags: ', ', ', ''); ?></span>
					</li>
                <?php endwhile; ?>
                
                <div class="clear"></div>
                
                <div class="paginator">
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
                </div>
                
                <div class="clear"></div>
                
            <?php else : ?>
                <h2>Sorry, no posts matched your criteria</h2>
            <?php endif; ?>
        </div>
        
        <?php get_sidebar('left'); ?>
    </div>
    
    <?php get_sidebar('right'); ?>
    <div class="clear"></div>
</div>

<?php get_footer(); ?>