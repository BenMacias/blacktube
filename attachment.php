<?php
/**
 * The template for displaying attachment pages
 */
get_header(); ?>

<div class="main">
    <div class="content">
        <div class="posts">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <?php
                $post_parent_id = wp_get_post_parent_id(get_the_ID());
                $parent_title = $post_parent_id ? get_the_title($post_parent_id) : '';
                ?>
                
                <h2 class="post-title">
                    <?php 
                    if ($parent_title) {
                        echo esc_html($parent_title) . ' &raquo; ';
                    }
                    echo esc_html(get_the_title());
                    ?>
                </h2>
                
                <div class="post-date">
                    Added <?php the_time('F j, Y'); ?> at <?php the_time('g:i a'); ?>
                </div>
                
                <div class="single-post">
                    <?php if (wp_attachment_is_image(get_the_ID())) : ?>
                        <div class="attachment-navigation">
                            <div class="previous-link"><?php previous_image_link(false, '&laquo; previous image'); ?>&nbsp;</div>
                            <div class="back-to-gallery">
                                <?php if ($post_parent_id) : ?>
                                    <a href="<?php echo esc_url(get_permalink($post_parent_id)); ?>">back to video</a>
                                <?php endif; ?>
                            </div>
                            <div class="next-link"><?php next_image_link(false, 'next image &raquo;'); ?></div>
                        </div>
                        
                        <div class="clear"></div>
                        
                        <div class="attachment-image">
                            <a href="<?php echo esc_url(wp_get_attachment_url()); ?>">
                                <img src="<?php echo esc_url(wp_get_attachment_url()); ?>" 
                                     alt="<?php echo esc_attr(get_the_title()); ?>" />
                            </a>
                        </div>
                    <?php endif; ?>
                    
                    <div class="clear"></div>
                </div>
                
                <?php comments_template(); ?>
                
                <h2 class="post-title">Related videos</h2>
                
                <?php
                // Related videos - preserve main loop post data
                $related_args = array(
                    'posts_per_page' => 6,
                    'orderby' => 'rand',
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'post__not_in' => array(get_the_ID()), // Exclude current attachment
                    'suppress_filters' => false
                );
                
                $related_posts = get_posts($related_args);
                
                if ($related_posts) :
                    foreach ($related_posts as $related_post) :
                        setup_postdata($related_post);
                        ?>
                        <div class="post" id="post-<?php the_ID(); ?>">
                            <a href="<?php echo esc_url(get_permalink()); ?>" title="<?php echo esc_attr(get_the_title()); ?>">
                                <?php 
                                if (has_post_thumbnail()) {
                                    the_post_thumbnail(array(240, 180), array(
                                        'alt' => esc_attr(get_the_title()),
                                        'title' => ''
                                    ));
                                }
                                ?>
                            </a>
                            
                            <?php 
                            $duration = get_post_meta(get_the_ID(), 'duration', true);
                            if (!empty($duration)) : 
                            ?>
                                <div class="duration"><?php echo esc_html($duration); ?></div>
                            <?php endif; ?>
                            
                            <div class="link">
                                <a href="<?php echo esc_url(get_permalink()); ?>">
                                    <?php 
                                    // Fallback if short_title function doesn't exist
                                    if (function_exists('short_title')) {
                                        short_title('...', '34');
                                    } else {
                                        echo esc_html(wp_trim_words(get_the_title(), 5, '...'));
                                    }
                                    ?>
                                </a>
                            </div>
                            
                            <span>Added: <?php the_time('F j, Y'); ?> at <?php the_time('g:i a'); ?></span>
                            <span><?php the_tags('Tags: ', ', ', ''); ?></span>
                        </div>
                        <?php
                    endforeach;
                    wp_reset_postdata(); // CRITICAL: Restore main loop
                endif;
                ?>
                
                <div class="clear"></div>
                
            <?php endwhile; else: ?>
                <h2>Sorry, no posts matched your criteria</h2>
            <?php endif; ?>
            
            <div class="clear"></div>
        </div>
        
        <?php get_sidebar('left'); ?>
    </div>
    
    <?php get_sidebar('right'); ?>
    <div class="clear"></div>
</div>

<?php get_footer(); ?>