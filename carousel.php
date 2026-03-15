<?php
/**
 * Post Carousel for Black Tube Theme
 */

function get_carousel_posts() {
    if (is_front_page() || is_home()) {
        // Front page - top posts by likes (using comment count as proxy for likes)
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => 15, // Increased for better auto-scroll
            'meta_key' => '_post_likes',
            'orderby' => 'meta_value_num',
            'order' => 'DESC',
            'meta_query' => array(
                array(
                    'key' => '_post_likes',
                    'compare' => 'EXISTS'
                )
            )
        );
    } elseif (is_category() || is_tag() || is_search()) {
        // Category, tag, search pages - top posts by views
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => 15, // Increased for better auto-scroll
            'meta_key' => 'post_views_count',
            'orderby' => 'meta_value_num',
            'order' => 'DESC',
            'meta_query' => array(
                array(
                    'key' => 'post_views_count',
                    'compare' => 'EXISTS'
                )
            )
        );
        
        // Add category filter
        if (is_category()) {
            $args['cat'] = get_queried_object_id();
        }
        
        // Add tag filter
        if (is_tag()) {
            $args['tag_id'] = get_queried_object_id();
        }
        
        // Add search filter
        if (is_search()) {
            $args['s'] = get_search_query();
        }
    } else {
        return array(); // Don't show carousel on other pages
    }
    
    // Fallback if no posts with likes/views found
    $posts = get_posts($args);
    if (empty($posts)) {
        $args['orderby'] = 'date';
        $args['order'] = 'DESC';
        unset($args['meta_key']);
        unset($args['meta_query']);
        $posts = get_posts($args);
    }
    
    return $posts;
}

function display_post_carousel() {
    $posts = get_carousel_posts();
    
    if (empty($posts)) {
        return;
    }
    ?>
    <div class="post-carousel">
        <button class="carousel-nav carousel-prev" aria-label="Previous posts">‹</button>
        
        <div class="post-carousel-container">
            <?php foreach ($posts as $post): ?>
                <a href="<?php echo esc_url(get_permalink($post->ID)); ?>" class="carousel-item">
                    <span class="carousel-fire-icon">🔥</span>
                    <span class="carousel-title"><?php echo esc_html($post->post_title); ?></span>
                </a>
            <?php endforeach; ?>
        </div>
        
        <button class="carousel-nav carousel-next" aria-label="Next posts">›</button>
    </div>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.querySelector('.post-carousel:not(.blacktube-terms-carousel) .post-carousel-container');
        const prevBtn = document.querySelector('.post-carousel:not(.blacktube-terms-carousel) .carousel-prev');
        const nextBtn = document.querySelector('.post-carousel:not(.blacktube-terms-carousel) .carousel-next');
        
        if (!container || !prevBtn || !nextBtn) return;
        
        const itemWidth = 220;
        const scrollAmount = itemWidth * 3;
        let autoScrollInterval;
        let isPaused = false;

        function updateNavButtons() {
            const scrollLeft = container.scrollLeft;
            const scrollWidth = container.scrollWidth;
            const clientWidth = container.clientWidth;
            
            prevBtn.classList.toggle('hidden', scrollLeft === 0);
            nextBtn.classList.toggle('hidden', scrollLeft + clientWidth >= scrollWidth - 10);
        }

        function scrollToNext() {
            const scrollLeft = container.scrollLeft;
            const scrollWidth = container.scrollWidth;
            const clientWidth = container.clientWidth;
            
            if (scrollLeft + clientWidth >= scrollWidth - 10) {
                container.scrollTo({ left: 0, behavior: 'smooth' });
            } else {
                container.scrollBy({ left: scrollAmount, behavior: 'smooth' });
            }
        }

        function startAutoScroll() {
            autoScrollInterval = setInterval(() => {
                if (!isPaused) {
                    scrollToNext();
                }
            }, 5000);
        }

        function stopAutoScroll() {
            clearInterval(autoScrollInterval);
        }

        container.addEventListener('mouseenter', () => {
            isPaused = true;
        });

        container.addEventListener('mouseleave', () => {
            isPaused = false;
        });

        prevBtn.addEventListener('click', function() {
            container.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
            stopAutoScroll();
            setTimeout(startAutoScroll, 10000);
        });
        
        nextBtn.addEventListener('click', function() {
            scrollToNext();
            stopAutoScroll();
            setTimeout(startAutoScroll, 10000);
        });
        
        container.addEventListener('scroll', updateNavButtons);
        window.addEventListener('resize', updateNavButtons);
        
        updateNavButtons();
        startAutoScroll();

        window.addEventListener('beforeunload', stopAutoScroll);
    });
    </script>
    <?php
}
?>