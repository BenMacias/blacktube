<?php
/**
 * The template for displaying single posts
 */
get_header(); ?>

<!-- ADD CAROUSEL HERE - RIGHT ABOVE VIDEO PLAYER -->
<?php blacktube_display_terms_carousel(); ?>

<div class="wrap list wl-video">
    <div class="mainw mainw-video">
        <div class="main-single l200 r300">

            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                
                <div class="video_player">
                    <?php
                    //$video_source = '';
                    $video_option = getEmbedVideo(get_the_ID());
                    ?>
                </div>

                <?php if (get_option('amn_link6')) : ?>
                <div class="sponsor">
                    <div class="link">
                        <div class="sponsor-buttons">
                            <a href="<?php echo esc_url(get_option('amn_link6')); ?>" class="sBtn">
                                Full Hd 1080<br/>
                                Watch HD Version<span>HD</span>
                            </a>
                            <a href="<?php echo esc_url(get_option('amn_link6')); ?>" class="sBtn spon">
                                Download Video<br/>
                                MP4, Mov, WMv...<span></span>
                            </a>
                        </div>
                        <?php if (get_option('amn_desc')) : ?>
                        <a href="<?php echo esc_url(get_option('amn_link6')); ?>" class="spon_desc">
                            <?php echo esc_html(get_option('amn_desc')); ?>
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>

                <h1 class="post_title">
                    <?php the_title(); ?>
                    <?php 
                    $custom_cat = get_post_meta(get_the_ID(), 'custom_post_cat_select', true);
                    if (!empty($custom_cat)) {
                        echo esc_html($custom_cat);
                    }
                    ?>
                </h1>

                <div class="description">
                    <div class="description_video">
                        <?php the_content(); ?>
                    </div>

                    <div class="description_views">
						<!--<i class="fa-solid fa-eye"></i>-->
                        <p><?php 
                            $views = get_post_meta(get_the_ID(), 'post_views_count', true);
								echo esc_html($views ? number_format_i18n($views) : '0');
							setPostViews(get_the_ID());
                        ?> views</p>
                        <span>Published <?php the_time(get_option('date_format') . ' ' . get_option('time_format')); ?></span>
                    </div>
                </div>

                <div class="description">
                    <div class="tags">
                        <button class="bn sub add_comment">Add Comments</button>
                    </div>
                </div>

                <div class="clear"></div>
                
                <?php comments_template(); ?>
                
                <div class="clear"></div>

            <?php endwhile; else: ?>
                <h2>Sorry, no videos matched your criteria</h2>
            <?php endif; ?>

        </div> <!--END main-->
    </div>   <!--END mainw-->

    <div class="right_box">
        <?php for ($i = 1; $i <= 3; $i++): ?>
            <?php if ($banner = get_option('amn_bannerv' . $i)): ?>
                <div class="right_ads" id="adsbox<?php echo $i; ?>">
                    <?php echo $banner; // Assuming this contains HTML for ads ?>
                </div>
            <?php endif; ?>
        <?php endfor; ?>
    </div>

    <div class="left">
        <?php get_template_part('includes/video_sidebar_left'); ?>
    </div>

</div>

<div class="wrap list wl-related">
    <div class="mainw mainw-related">
        <!--Related Videos -->
        <div class="headline">
            <h2>Related Videos</h2>
            <div class="sorting">
                <?php
                $v_sortby = $_GET['v_sortby'] ?? '';
                $allowed_values = ['views', 'date'];
                if (!in_array($v_sortby, $allowed_values)) {
                    $v_sortby = '';
                }
                ?>
                <a class="bn sub<?php echo ($v_sortby == "views") ? ' active' : ''; ?>" href="?v_sortby=views&amp;v_orderby=desc">Most Viewed Videos</a>
                <a class="bn sub<?php echo ($v_sortby != "views") ? ' active' : ''; ?>" href="<?php echo esc_url(home_url()); ?>">Date</a>
            </div>
        </div>
        
        <?php get_template_part('includes/related_videos'); // Fixed typo: releated -> related ?>
        <!--END Related Videos -->
    </div>
</div>

<?php get_footer(); ?>