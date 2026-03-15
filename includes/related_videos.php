<?php
/**
 * Related videos template part
 */
?>
<div class="clear"></div>
<ul class="video_list">
<?php 
$args = array(
    'posts_per_page' => 20,
    'orderby'        => 'rand',
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'suppress_filters' => false
);

$rand_posts = get_posts($args);

if ($rand_posts) :
    foreach ($rand_posts as $post) :
        setup_postdata($post);
        ?>
        <li class="video" id="video_<?php the_ID(); ?>">
            <?php getThumb(get_the_ID()); ?>
        </li>
        <?php
    endforeach;
    wp_reset_postdata();
else :
    ?>
    <li>No related videos found.</li>
    <?php
endif;
?>
</ul>
<div class="clear"></div>