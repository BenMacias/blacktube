<?php
/**
 * The template for displaying all single pages
 */
get_header(); ?>

<div class="wrap list page-wrap">
    <div class="mainw page-mainw">
        <?php if (have_posts()) : ?>
            <h1><?php echo esc_html(get_the_title()); ?></h1>
            
            <?php while (have_posts()) : the_post(); ?>
                <div class="single-post" id="post-<?php the_ID(); ?>">
                    <?php the_content(); ?>
                </div>
            <?php endwhile; ?>
            
            <div class="clear"></div>
            
        <?php else : ?>
            <h2>Sorry, no posts matched your criteria</h2>
        <?php endif; ?>
    </div>
</div>

<div class="clear"></div>

<?php get_footer(); ?>