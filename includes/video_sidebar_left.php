<ul class="sidebar_video">
    <?php $args = array( 'numberposts' => 4, 'orderby' => 'rand' );
        $rand_posts = get_posts( $args );
        foreach( $rand_posts as $post ) : ?>
        <li id="post-<?php the_ID(); ?>" class="post">
            <?php get_vsl_Thumb(get_the_ID()); ?>
        </li>
    <?php endforeach; ?>
</ul>
<div class="clear"></div>