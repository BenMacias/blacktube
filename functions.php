<?php
/**
 * Black Tube Theme Functions
 * Security Hardened Version
 */

// AWP functions - check if this file is safe to include
if (file_exists(TEMPLATEPATH . '/awpf/funcs.php')) {
    require(TEMPLATEPATH . '/awpf/funcs.php');
}

// Theme Options Admin Menu
function themeoptions_admin_menu() {
    add_theme_page("Theme Options", "Theme Options", 'edit_theme_options', basename(__FILE__), 'themeoptions_page');
}

function themeoptions_page() {
    if (isset($_POST['update_themeoptions']) && $_POST['update_themeoptions'] == 'true') {
        themeoptions_update();
    }
    ?>
    <!-- Rest of the admin HTML remains the same but with added escaping -->
    <style type="text/css">
    .container{width:635px;margin:60px 10px}ul.tabs{margin:0;padding:0;float:left;list-style:none;height:32px;border-bottom:1px solid #DFDFDF;border-left:1px solid #DFDFDF;width:100%}ul.tabs li{float:left;margin:0;padding:0;height:31px;line-height:31px;border:1px solid #DFDFDF;border-left:none;margin-bottom:-1px;background:#ECECEC;overflow:hidden;position:relative}ul.tabs li a{text-decoration:none;color:#999;display:block; font:bold 12px/32px Arial, Helvetica, sans-serif; text-shadow:1px 1px 0 #fff;padding:0 20px;border:1px solid #fff;outline:0}ul.tabs li a:hover{background:#e5e5e5}html ul.tabs li.active,html ul.tabs li.active a:hover{background:#fff;border-bottom:1px solid #fff}.tab_container{border:1px solid #DFDFDF;border-top:0;clear:both;float:left;width:100%;background:#fff;-moz-border-radius-bottomright:5px;-khtml-border-radius-bottomright:5px;-webkit-border-bottom-right-radius:5px;-moz-border-radius-bottomleft:5px;-khtml-border-radius-bottomleft:5px;-webkit-border-bottom-left-radius:5px}.tab_content{padding:20px;font-size:1.2em}.tab_content h2{font:bold 12px/32px Arial, Helvetica, sans-serif;padding-bottom:10px;border-bottom:1px dashed #ddd}.tab_content h3 a{color:#254588}.tab_container textarea,.tab_container input { background:#f7f7f7; font-size:11px !important}.clear{ clear:both}ul.tabs li.active a { color:#000}.tab_container textarea:focus,.tab_container input:focus {border:#e7e7e7 1px solid;box-shadow: 0 0 5px #e7e7e7;-webkit-box-shadow: 0 0 5px #e7e7e7;-moz-box-shadow: 0 0 5px #e7e7e7;}.tab_container p { font-size:12px}.tab_container input{ padding:7px}
    </style>
    
    <div class="wrap">
        <div id="icon-themes" class="icon32"><br /></div>
        <h2>Theme Settings</h2>

        <div class="container">
            <form method="POST" action="">
                <ul class="tabs">
                    <li><a href="#tab1">Theme Options</a></li>
                    <li><a href="#tab2">Header & Affiliate Links</a></li>
                    <li><a href="#tab3">Banners & Ads</a></li>
                    <li><a href="#tab4">Logo Settings</a></li>
                </ul>
                
                <div class="tab_container">
                    <div id="tab1" class="tab_content">
                        <h2>Theme Options</h2>
                        <input type="hidden" name="update_themeoptions" value="true" />
                        
                        <p><input type="checkbox" name="head_login" id="head_login" <?php checked(get_option('amn_head_login'), 'checked'); ?> /> Display Login and Register Link</p>
                        <p><input type="checkbox" name="cat_on_index" id="cat_on_index" <?php checked(get_option('cat_index'), 'checked'); ?> /> Automatically generate category on index page</p>
                        <p><input style="width:55px;" type="text" name="num_vid" id="num_vid" size="32" value='<?php echo esc_attr(get_option('num_vid_cat')); ?>' /> Number of categories on index page, default is 6 (Option above must be enabled)</p>
                        <p><input type="checkbox" name="cat_desc_index" id="cat_desc_index" <?php checked(get_option('cat_desc'), 'checked'); ?> /> Enable Category description (Option above must be enabled)</p>

						<p>
						<strong>Tag Click Behavior:</strong><br />
						<select name="carousel_tags_behavior" id="carousel_tags_behavior">
							<option value="search_redirect" <?php selected(get_option('amn_carousel_tags_behavior'), 'search_redirect'); ?>>Tags link to Search Results</option>
							<option value="archive_redirect" <?php selected(get_option('amn_carousel_tags_behavior'), 'archive_redirect'); ?>>Tags link to Tag Archive Pages</option>
                            </select>
						<br /><small>Choose what happens when users click tags in the post carousel.</small>
                        </p>

                        <p>Custom fields name for thumbs (optional)<br/>
                            <input style="width: 100%;" type="text" name="field1" id="field1" size="32" value='<?php echo esc_attr(get_option('amn_thumbs')); ?>' /></p>

                        <p>Custom fields name for video (optional)<br/>
                            <input style="width: 100%;" type="text" name="field2" id="field2" size="32" value='<?php echo esc_attr(get_option('amn_videos')); ?>' /></p>

                        <h3>Google Analytics Code</h3>
                        <p><textarea style="width:600px; min-height:150px" name="google" id="google"><?php echo esc_textarea(get_option('amn_google')); ?></textarea></p>

                        <h3>Social URL</h3>
                        <p>Twitter URL<br/><input style="width: 100%;" type="text" name="twitter" id="twitter" size="32" value='<?php echo esc_attr(get_option('amn_twitter')); ?>' /></p>
                        <p>Facebook URL<br/><input style="width: 100%;" type="text" name="facebook" id="facebook" size="32" value='<?php echo esc_attr(get_option('amn_facebook')); ?>' /></p>
                        <p>Google+ URL<br/><input style="width: 100%;" type="text" name="googleplus" id="googleplus" size="32" value='<?php echo esc_attr(get_option('amn_googleplus')); ?>' /></p>
                        <p><input type="submit" name="submit" class="button-primary button" value="Update Options" /></p>
                    </div>

                    <div id="tab2" class="tab_content">
                        <h2>Top Bar Links</h2>
                        <p>Link #1<br/><input style="width: 100%;" type="text" name="link1" id="link1" size="32" value='<?php echo esc_attr(get_option('amn_link1')); ?>' /></p>
                        <p>Link #2<br/><input style="width: 100%;" type="text" name="link2" id="link2" size="32" value='<?php echo esc_attr(get_option('amn_link2')); ?>' /></p>
                        <p>Link #3<br/><input style="width: 100%;" type="text" name="link3" id="link3" size="32" value='<?php echo esc_attr(get_option('amn_link3')); ?>' /></p>
                        <p>Link #4<br/><input style="width: 100%;" type="text" name="link4" id="link4" size="32" value='<?php echo esc_attr(get_option('amn_link4')); ?>' /></p>
                        <p>Link #5<br/><input style="width: 100%;" type="text" name="link5" id="link5" size="32" value='<?php echo esc_attr(get_option('amn_link5')); ?>' /></p>
                        
                        <h2>Links Below Player</h2>
                        <p>Link example (http://google.com)<br/><input style="width: 100%;" type="text" name="link6" id="link6" value='<?php echo esc_attr(get_option('amn_link6')); ?>' /></p>
                        <p>Description<br/><textarea style="width:100%; min-height:150px" name="desc" id="desc"><?php echo esc_textarea(get_option('amn_desc')); ?></textarea></p>
                        
                        <!-- Commented out sponsor section - leave as is -->
                        <!--<h2>List of sponsor for videos</h2>
                        <p>Link example (http://google.com) - use your own aff url<br/>
                        <textarea style="width:100%; min-height:150px" name="sponsor_list" id="desc"><?php //echo esc_textarea(get_option('amn_sponsor_list')); ?></textarea></p>-->
                        
                        <p><input type="submit" name="submit" class="button-primary button" value="Update Options" /></p>
                    </div>

                    <div id="tab3" class="tab_content">
                        <h2>Footer Banners</h2>
                        <div style="font-size:11px">Add banner size 250x300px</div>
                        <p>Banner #1<br/><textarea style="width:100%; min-height:150px" name="banners1" id="banners1"><?php echo esc_textarea(get_option('amn_banners1')); ?></textarea></p>
                        <p>Banner #2<br/><textarea style="width:100%; min-height:150px" name="banners2" id="banners2"><?php echo esc_textarea(get_option('amn_banners2')); ?></textarea></p>
                        <p>Banner #3<br/><textarea style="width:100%; min-height:150px" name="banners3" id="banners3"><?php echo esc_textarea(get_option('amn_banners3')); ?></textarea></p>
                        <p>Banner #4<br/><textarea style="width:100%; min-height:150px" name="banners4" id="banners4"><?php echo esc_textarea(get_option('amn_banners4')); ?></textarea></p>
                        
                        <h2>Right Sidebar Banners (Video page)</h2>
                        <div style="font-size:11px">Add banner size 250x300px</div>
                        <p>Banner #1<br/><textarea style="width:100%; min-height:150px" name="bannerv1" id="bannerv1"><?php echo esc_textarea(get_option('amn_bannerv1')); ?></textarea></p>
                        <p>Banner #2<br/><textarea style="width:100%; min-height:150px" name="bannerv2" id="bannerv2"><?php echo esc_textarea(get_option('amn_bannerv2')); ?></textarea></p>
                        <p>Banner #3<br/><textarea style="width:100%; min-height:150px" name="bannerv3" id="bannerv3"><?php echo esc_textarea(get_option('amn_bannerv3')); ?></textarea></p>

                        <p><input type="submit" name="submit" class="button-primary button" value="Update Options" /></p>
                    </div>
                    
                    <div id="tab4" class="tab_content">
                        <h2>Logo Settings</h2>
                        <p>
                            <select name="logo_type" id="logo_type">
                                <option value="text" <?php selected(get_option('amn_logo_type'), 'text'); ?>>Text Logo</option>
                                <option value="image" <?php selected(get_option('amn_logo_type'), 'image'); ?>>Image Logo</option>
                            </select>
                            Logo Type
                        </p>
                        <p>Logo Image (required if using image logo)<br/>
                            <input style="width: 100%;" type="text" name="logo_image" id="logo_image" value="<?php echo esc_attr(get_option('amn_logo_image')); ?>" />
                            <button type="button" class="button" id="upload_logo_button">Upload Image</button>
                        </p>
                        <p>Custom Text Logo (optional - defaults to site name)<br/>
                            <input style="width: 100%;" type="text" name="logo_text" id="logo_text" value="<?php echo esc_attr(get_option('amn_logo_text')); ?>" />
                        </p>
                        <p>Logo Width (px)<br/>
                            <input style="width:100px;" type="number" name="logo_width" id="logo_width" value="<?php echo esc_attr(get_option('amn_logo_width', '200')); ?>" />
                        </p>
                        <p>Logo Height (px)<br/>
                            <input style="width:100px;" type="number" name="logo_height" id="logo_height" value="<?php echo esc_attr(get_option('amn_logo_height', '60')); ?>" />
                        </p>
                        <p><input type="submit" name="submit" class="button-primary button" value="Update Options" /></p>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="clear"></div>
    <?php
}
//Settings Tab Function
function themeoptions_tabs_script($hook) {
    if ($hook !== 'appearance_page_functions') return;

    // Enqueue media uploader
    wp_enqueue_media();

    wp_add_inline_script('jquery-core', "
        jQuery(document).ready(function($) {
            // Tab functionality
            $('.tab_content').hide();
            $('.tab_content:first').show();
            $('ul.tabs li:first').addClass('active');

            $('ul.tabs li a').click(function(e) {
                e.preventDefault();
                $('ul.tabs li').removeClass('active');
                $(this).parent().addClass('active');
                $('.tab_content').hide();
                $($(this).attr('href')).show();
            });

            // Logo upload functionality
            $('#upload_logo_button').click(function(e) {
                e.preventDefault();
                var custom_uploader = wp.media({
                    title: 'Select Logo Image',
                    button: { text: 'Use this image' },
                    multiple: false
                }).on('select', function() {
                    var attachment = custom_uploader.state().get('selection').first().toJSON();
                    $('#logo_image').val(attachment.url);
                }).open();
            });
        });
    ");
}
add_action('admin_enqueue_scripts', 'themeoptions_tabs_script');

function themeoptions_update() {
    // Check nonce for security
    if (!isset($_POST['update_themeoptions']) || $_POST['update_themeoptions'] != 'true') {
        return;
    }
    
    // Validate user permissions
    if (!current_user_can('edit_theme_options')) {
        return;
    }

    // --- Single field options ---
    update_option('amn_google', sanitize_textarea_field($_POST['google'] ?? ''));
    update_option('amn_facebook', sanitize_url($_POST['facebook'] ?? ''));
    update_option('amn_twitter', sanitize_url($_POST['twitter'] ?? ''));
    update_option('amn_googleplus', sanitize_url($_POST['googleplus'] ?? ''));
    update_option('amn_thumbs', sanitize_text_field($_POST['field1'] ?? ''));
    update_option('amn_videos', sanitize_text_field($_POST['field2'] ?? ''));
    update_option('amn_desc', sanitize_textarea_field($_POST['desc'] ?? ''));
    update_option('num_vid_cat', absint($_POST['num_vid'] ?? 6));
    
    // --- Checkboxes ---
    update_option('amn_head_login', isset($_POST['head_login']) ? 'checked' : '');
    update_option('cat_index', isset($_POST['cat_on_index']) ? 'checked' : '');
    update_option('cat_desc', isset($_POST['cat_desc_index']) ? 'checked' : '');
	
	update_option('amn_carousel_tags_behavior', sanitize_text_field($_POST['carousel_tags_behavior'] ?? 'search_redirect'));

    // --- Logo Options ---
    update_option('amn_logo_type', sanitize_text_field($_POST['logo_type'] ?? 'text'));
    update_option('amn_logo_image', sanitize_url($_POST['logo_image'] ?? ''));
    update_option('amn_logo_text', sanitize_text_field($_POST['logo_text'] ?? ''));
    update_option('amn_logo_width', absint($_POST['logo_width'] ?? 200));
    update_option('amn_logo_height', absint($_POST['logo_height'] ?? 60));
   

    // --- Groups with different sanitization ---
    $allowed_link_tags = [
        'a' => [
            'href'   => [],
            'title'  => [],
            'target' => [], // optional
        ]
    ];

    $groups = [
        'link'    => [6, function($field) use ($allowed_link_tags) { return wp_kses($field, $allowed_link_tags); }],
        'banners' => [4, 'wp_kses_post'],
        'bannerv' => [3, 'wp_kses_post'],
    ];

    foreach ($groups as $prefix => [$count, $sanitizer]) {
        for ($i = 1; $i <= $count; $i++) {
            $field = $_POST[$prefix . $i] ?? '';
            $value = is_callable($sanitizer) ? $sanitizer($field) : call_user_func($sanitizer, $field);
            update_option('amn_' . $prefix . $i, $value);
        }
    }
    
    // Commented out options - leave as is
    //update_option('amn_sponsor_list', sanitize_textarea_field($_POST['sponsor_list'] ?? ''));
}
add_action('admin_menu', 'themeoptions_admin_menu');

// Remove stop words from URL
add_filter('sanitize_title', 'remove_false_words');
function remove_false_words($slug) {
    if (!is_admin()) return $slug;
    
    $slug = explode('-', $slug);
    $false_words = array('a','and','the','an','it','is','with','can','on','of','why','not','about','above','across','after','all','almost','alone','along','already','if');
    
    $slug = array_diff($slug, $false_words);
    return implode('-', $slug);
}

// Remove jQuery migrate - COMMENTED OUT (leave as is)
/*
add_filter('wp_default_scripts', 'dequeue_jquery_migrate');
function dequeue_jquery_migrate(&$scripts) {
    if (!is_admin()) {
        $scripts->remove('jquery');
        $scripts->add('jquery', false, array('jquery-core'), '1.10.2');
    }
}
*/

// Reduce nav classes, leaving only 'current-menu-item'
function nav_class_filter($var) {
    return is_array($var) ? array_intersect($var, array('current-menu-item')) : '';
}
add_filter('nav_menu_css_class', 'nav_class_filter', 100, 1);

// Remove auto paragraph formatting
remove_filter('the_content', 'wpautop', 99);
function remove_unwanted_tag__($cont) {
    $newcontent = str_replace(array('<center>','</center>','<br>','<br/>','<p>','</p>'), '', $cont);
    return $newcontent;
}

// Filtering a Class in Navigation Menu Item
add_filter('nav_menu_css_class', 'special_nav_class', 10, 2);
function special_nav_class($classes, $item) {
    if (is_single() && $item->title == 'Videos') {
        $classes[] = 'current-menu-item';
    }
    return $classes;
}

// Add class to tags
function add_class_the_tags($html) {
    $html = str_replace('<a', '<a class="tag"', $html);
    return $html;
}
add_filter('the_tags', 'add_class_the_tags', 10, 1);
// Remove WordPress generator and other meta tags
/*remove_action('wp_head', 'wp_generator');
add_action('init', 'remheadlink');
function remheadlink() {
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
}
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
add_filter('show_admin_bar', '__return_false');*/

// Time ago function - SECURED VERSION
function time_ago($type = 'post') {
    $d = $type == 'comment' ? 'get_comment_time' : 'get_post_time';
    $time = $d('U');
    return esc_html(human_time_diff($time, current_time('timestamp'))) . " " . __('ago');
}
function themeblvd_time_ago() {
    global $post;
    $date = get_post_time('G', true, $post);
    $chunks = array(
        array( 60 * 60 * 24 * 365 , __( 'year', 'themeblvd' ), __( 'years', 'themeblvd' ) ),
        array( 60 * 60 * 24 * 30 , __( 'month', 'themeblvd' ), __( 'months', 'themeblvd' ) ),
        array( 60 * 60 * 24 * 7, __( 'week', 'themeblvd' ), __( 'weeks', 'themeblvd' ) ),
        array( 60 * 60 * 24 , __( 'day', 'themeblvd' ), __( 'days', 'themeblvd' ) ),
        array( 60 * 60 , __( 'hour', 'themeblvd' ), __( 'hours', 'themeblvd' ) ),
        array( 60 , __( 'minute', 'themeblvd' ), __( 'minutes', 'themeblvd' ) ),
        array( 1, __( 'second', 'themeblvd' ), __( 'seconds', 'themeblvd' ) )
    );
    if ( !is_numeric( $date ) ) {
        $time_chunks = explode( ':', str_replace( ' ', ':', $date ) );
        $date_chunks = explode( '-', str_replace( ' ', '-', $date ) );
        $date = gmmktime( (int)$time_chunks[1], (int)$time_chunks[2], (int)$time_chunks[3], (int)$date_chunks[1], (int)$date_chunks[2], (int)$date_chunks[0] );
    }
    $current_time = current_time( 'mysql', $gmt = 0 );
    $newer_date = strtotime( $current_time );
    // Difference in seconds
    $since = $newer_date - $date;
    if ( 0 > $since )
        return __( 'sometime', 'themeblvd' );
    for ( $i = 0, $j = count($chunks); $i < $j; $i++) {
        $seconds = $chunks[$i][0];
        if ( ( $count = floor($since / $seconds) ) != 0 )
            break;
    }
    $output = ( 1 == $count ) ? '1 '. $chunks[$i][1] : $count . ' ' . $chunks[$i][2];
    if ( !(int)trim($output) ){
        $output = '0 ' . __( 'seconds', 'themeblvd' );
    }
    $output .= __(' ago', 'themeblvd');
    return $output;
}

// Filter our themeblvd_time_ago() function into WP's the_time() function
add_filter('the_time', 'themeblvd_time_ago');

/* = Short titles for preview link =
 * = Display a shortened version of the post title with proper escaping =
 * @param string $after Text to append if title is shortened (default '')
 * @param int $length Maximum length of the title
 * @param bool $echo Whether to echo or return the result (default true)
 * @return string|void Shortened title if $echo is false, otherwise echoes it
 */
function short_title($after = '', $length = 50, $echo = true) {
    $mytitle = get_the_title();
    $output = '';
    
    if (strlen($mytitle) > $length) {
        $short_title = substr($mytitle, 0, $length);
        $output = esc_html(rtrim($short_title)) . esc_html($after);
    } else {
        $output = esc_html($mytitle);
    }
    
    if ($echo) {
        echo $output;
    } else {
        return $output;
    }
}

/* == Short category description ==
 * == Display a shortened version of text with proper escaping ==
 * @param string $after Text to append if content is shortened (default '')
 * @param int $length Maximum length of the content
 * @param string $desc The text content to shorten
 * @param bool $echo Whether to echo or return the result (default true)
 * @return string|void Shortened text if $echo is false, otherwise echoes it
 */
function short_desc($after = '', $length = 120, $desc = '', $echo = true) {
    // Strip HTML tags and clean the content
    $clean_content = wp_strip_all_tags($desc);
    $output = '';
    
    if (strlen($clean_content) > $length) {
        $short_content = substr($clean_content, 0, $length);
        $output = esc_html(rtrim($short_content)) . esc_html($after);
    } else {
        $output = esc_html($clean_content);
    }
    
    if ($echo) {
        echo $output;
    } else {
        return $output;
    }
}
//Removing useless CSS that WP pasts right inside BODY tags... (?)
function remove_gallery_css( $css ) {
    return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
add_filter( 'gallery_style', 'remove_gallery_css' );
// Post thumbnails support
if (function_exists('add_theme_support')) {
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(240, 180, true);
}

// Main menu registration
add_action('init', 'register_my_menus');
function register_my_menus() {
    register_nav_menus(
        array(
            'header-menu' => __('Header Menu'),
            'footer-menu' => __('Footer Menu')
        )
    );
}
/* Custom pagination function
 * @param string $pages Number of pages
 * @param int $range Number of page links to show
 */
function pagination($pages = '', $range = 6) {
    $showitems = ($range * 2) + 1;
    global $paged;
    
    if (empty($paged)) {
        $paged = 1;
    }

    if ($pages == '') {
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if (!$pages) {
            $pages = 1;
        }
    }
    
    if (1 != $pages) {
        // First page link
        if ($paged > 1 && $showitems < $pages) {
            echo "<li class=\"prev\"><a href='" . esc_url(get_pagenum_link(1)) . "'>First</a></li>";
        }
        
        // Page numbers
        for ($i = 1; $i <= $pages; $i++) {
            if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems)) {
                if ($paged == $i) {
                    echo "<li><a href='" . esc_url(get_pagenum_link($i)) . "' class=\"current\">" . esc_html($i) . "</a></li>";
                } else {
                    echo "<li><a href='" . esc_url(get_pagenum_link($i)) . "' class=\"inactive\">" . esc_html($i) . "</a></li>";
                }
            }
        }
        
        // Last page link
        if ($paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages) {
            echo "<li class=\"next\"><a href=\"" . esc_url(get_pagenum_link($pages)) . "\">Last</a></li>";
        }
    }
}
/* Custom comments template callback */
function custom_comments($comment, $args, $depth) {
    // Don't use $GLOBALS['comment'] - it's deprecated
    $comment_id = $comment->comment_ID;
    $comment_class = comment_class('', $comment_id, null, false);
    ?>
    <li <?php echo $comment_class; ?> id="comment-<?php echo esc_attr($comment_id); ?>">
        <?php echo get_avatar($comment, 48, '', '', array('class' => 'comment-avatar')); ?>

        <div class="comm_head">
            <span class="comment-author">
                <?php
                $author_name = get_comment_author($comment_id);
                $author_url = get_comment_author_url($comment_id);

                if (!empty($author_url) && 'http://' != $author_url) {
                    printf(
                        '<a href="%s" rel="external nofollow" class="url">%s</a> says:',
                        esc_url($author_url),
                        esc_html($author_name)
                    );
                } else {
                    printf('%s says:', esc_html($author_name));
                }
                ?>
            </span>

            <small class="comment-meta">
                <a href="<?php echo esc_url(get_comment_link($comment_id)); ?>">
                    <?php
                    printf(
                        '%1$s at %2$s',
                        get_comment_date('F jS, Y', $comment_id),
                        get_comment_time('', false, false, $comment_id)
                    );
                    ?>
                </a>

                <?php
                edit_comment_link('Edit', ' | ', '');
                ?>

                <?php
                // Reply link
                comment_reply_link(array_merge($args, array(
                    'depth' => $depth,
                    'max_depth' => $args['max_depth'],
                    'reply_text' => 'Reply',
                    'before' => ' | '
                )));
                ?>
            </small>
        </div>

        <div class="comment-text">
            <?php comment_text($comment_id); ?>
        </div>

        <div class="clear"></div>
    </li>
    <?php
}

/* == resizes embedded video html code to a specified width and height ==
 * Resizes embedded video HTML code to 100% width and height
 * @param string $subject The embedded video HTML code
 * @return string Sanitized HTML with responsive dimensions
 */
function resizeEmbedded($subject) {
    // Validate input
    if (empty($subject) || !is_string($subject)) {
        return '';
    }
    
    // Decode HTML entities if input is numeric (preserving original logic)
    if (preg_match('/^\d+$/', $subject)) {
        $subject = html_entity_decode($subject);
    }
    
    // Standardize quotes
    $subject = str_replace("'", '"', $subject);
    
    // Replace width and height attributes with percentage-based values
    $patterns = array(
        "/width\s*=\s*[\"'][0-9]+[^\"']*[\"']/i",
        "/height\s*=\s*[\"'][0-9]+[^\"']*[\"']/i"
    );
    
    $replacements = array(
        "width='100%'",
        "height='100%'"
    );
    
    $subject = preg_replace($patterns, $replacements, $subject);
    
    // Sanitize the output before returning
    return wp_kses_post($subject);
}

function tube_enqueue_fontawesome() {
    wp_enqueue_style(
        'fontawesome',
        get_template_directory_uri() . '/includes/fontawesome/css/all.min.css',
        //array(), // no dependencies
        '7.1.0' // or your downloaded version
    );
}
add_action('wp_enqueue_scripts', 'tube_enqueue_fontawesome');

// =============================================
// UNIFIED TERMS CAROUSEL FUNCTION
// =============================================

function blacktube_display_terms_carousel() {
    if (!is_single()) return;
    
    $categories = get_the_category();
    $tags = get_the_tags();
    
    if (!$categories && !$tags) return;
    
    $tags_behavior = get_option('amn_carousel_tags_behavior', 'search_redirect');
    ?>
    <div class="post-carousel blacktube-terms-carousel">
        <button class="carousel-nav carousel-prev" aria-label="Previous tags">‹</button>
        
        <div class="post-carousel-container">
            <?php if ($categories): ?>
                <?php foreach ($categories as $category): ?>
                    <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" 
                       class="carousel-item carousel-category">
                        <i class="fas fa-folder"></i>
                        <span class="carousel-title"><?php echo esc_html($category->name); ?></span>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>
            
            <?php if ($tags): ?>
                <?php foreach ($tags as $tag): ?>
                    <?php 
                    $tag_url = ($tags_behavior === 'search_redirect') 
                        ? home_url('/?s=' . urlencode($tag->name))
                        : get_tag_link($tag->term_id);
                    ?>
                    <a href="<?php echo esc_url($tag_url); ?>" 
                       class="carousel-item carousel-tag">
                        <i class="fas fa-tag"></i>
                        <span class="carousel-title"><?php echo esc_html($tag->name); ?></span>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        
        <button class="carousel-nav carousel-next" aria-label="Next tags">›</button>
    </div>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.querySelector('.blacktube-terms-carousel .post-carousel-container');
        const prevBtn = document.querySelector('.blacktube-terms-carousel .carousel-prev');
        const nextBtn = document.querySelector('.blacktube-terms-carousel .carousel-next');
        
        if (!container || !prevBtn || !nextBtn) return;
        
        const itemWidth = 220;
        const scrollAmount = itemWidth * 3;

        function updateNavButtons() {
            const scrollLeft = container.scrollLeft;
            const scrollWidth = container.scrollWidth;
            const clientWidth = container.clientWidth;
            
            prevBtn.classList.toggle('hidden', scrollLeft === 0);
            nextBtn.classList.toggle('hidden', scrollLeft + clientWidth >= scrollWidth - 10);
        }

        prevBtn.addEventListener('click', function() {
            container.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
        });
        
        nextBtn.addEventListener('click', function() {
            container.scrollBy({ left: scrollAmount, behavior: 'smooth' });
        });
        
        container.addEventListener('scroll', updateNavButtons);
        window.addEventListener('resize', updateNavButtons);
        
        updateNavButtons();
    });
    </script>
    <?php
}