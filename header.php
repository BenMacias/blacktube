<?php
/**
 * The header for our theme
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    
    <title><?php
    // Modernized title logic
    if (is_category()) {
        echo esc_html(wp_title('', false));
    } elseif (function_exists('is_tag') && is_tag()) {
        echo esc_html('Search for ' . single_tag_title('', false));
    } elseif (is_page() || is_single()) {
        echo esc_html(wp_title('', false));
    } elseif (is_search()) {
        echo esc_html('Search for ' . get_search_query());
    } elseif (is_404()) {
        echo esc_html('Not Found');
    } else {
        echo esc_html(get_bloginfo('name'));
    }
    ?></title>

    <?php
    // Meta descriptions
    if (is_home()) { ?>
        <meta name="description" content="<?php echo esc_attr(get_bloginfo('description')); ?>" />
    <?php } elseif (is_search()) { ?>
        <meta name="description" content="<?php echo esc_attr('Search results for: ' . get_search_query()); ?>" />
    <?php } elseif (is_tag()) { ?>
        <meta name="description" content="<?php echo esc_attr('Content tagged: ' . single_tag_title('', false)); ?>" />
    <?php } elseif (is_page()) { ?>
        <meta name="description" content="<?php 
            $desc = wp_strip_all_tags(get_the_content());
            $desc = wp_trim_words($desc, 25);
            echo esc_attr($desc);
        ?>" />
    <?php } elseif (is_category()) { ?>
        <meta name="description" content="<?php echo esc_attr(strip_tags(category_description())); ?>" />
    <?php } ?>

    <?php if (is_paged()) { ?>
        <meta name='robots' content='noindex,follow' />
    <?php } ?>
   
    <link rel="stylesheet" href="<?php echo esc_url(get_template_directory_uri() . '/' . 'style.css'); ?>" />
    <link rel="alternate" type="application/rss+xml" title="<?php echo esc_attr(get_bloginfo('name')); ?> RSS Feed" href="<?php echo esc_url(get_bloginfo('rss2_url')); ?>" />
    
    <?php wp_head(); ?>
    
    <?php
    // Google Analytics/Header code
    $google_code = get_option('amn_google');
    if (!empty($google_code)) {
        echo $google_code;
    }
    ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open();

// Detect if we're on a single post or page
$is_single_context = is_single() || is_page(); ?>

<div class="wrap cf">
        <div id="header_wrap" class="cf">
            <div id="header_bar" class="cf">
                <div id="header_left">
                    <div class="menu_toggle js_sidemenu" id="headerMenuToggle" data-expand-id="mobile_layout">
                        <em class="menu_toggle_icon">☰</em>
                    </div>
                    <div class="logo" id="logo_wrap">
                        <a href="<?php echo esc_url(home_url()); ?>" id="site_logo" title="<?php echo esc_attr(get_bloginfo('name')); ?>">
                            <?php
                            $logo_type = get_option('amn_logo_type', 'text');
                            $logo_image = get_option('amn_logo_image');
                            $logo_text = get_option('amn_logo_text', get_bloginfo('name'));
                            $logo_width = get_option('amn_logo_width', 200);
                            $logo_height = get_option('amn_logo_height', 60);
                            
                            if ($logo_type === 'image' && !empty($logo_image)) {
                                echo '<img src="' . esc_url($logo_image) . '" alt="' . esc_attr($logo_text) . '" width="' . esc_attr($logo_width) . '" height="' . esc_attr($logo_height) . '" />';
                            } else {
                                echo '<span class="logo-text">' . esc_html($logo_text) . '</span>';
                            }
                            ?>
                        </a>
                    </div>
                </div>

                <div id="header_middle">
                    <div id="header_search">
                        <div id="search_form_wrapper">
                            <form action="<?php echo esc_url(home_url('/')); ?>" method="get" id="main-search-form" class="header_search_form">
                                <input type="text" name="s" id="header_search_field" value="<?php echo esc_attr(get_search_query()); ?>" placeholder="Search..." />
                                <button type="submit" id="header_search_button">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path d="M10 2a8 8 0 105.293 14.293l4.707 4.707 1.414-1.414-4.707-4.707A8 8 0 0010 2zm0 2a6 6 0 110 12A6 6 0 0110 4z"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div id="header_right">
                    <!-- You can add user menu, buttons, etc. here later -->
                </div>
            </div>
        </div>

<nav class="vertical-sidebar collapsed" id="verticalSidebar">
    <div class="sidebar-content">
        <!-- Main Navigation -->
        <div class="sidebar-section">
            <ul class="sidebar-menu">
                <li class="menu-item active">
                    <a href="<?php echo esc_url(home_url()); ?>">
                        <span class="menu-icon"><i class="fa-solid fa-house"></i></span>
                        <span class="menu-text">Home</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#">
                        <span class="menu-icon"><i class="fa-solid fa-fire"></i></span>
                        <span class="menu-text">Trending</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#">
                        <span class="menu-icon">📺</span>
                        <span class="menu-text">Subscriptions</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#">
                        <span class="menu-icon">📚</span>
                        <span class="menu-text">Library</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Categories Section -->
        <div class="sidebar-section">
            <h3 class="section-title">CATEGORIES</h3>
            <ul class="sidebar-menu">
                <?php
                $categories = get_categories(array(
                    'orderby' => 'name',
                    'order' => 'ASC',
                    'number' => 8,
                    'hide_empty' => true
                ));
                
                foreach ($categories as $category) {
                    echo '<li class="menu-item">';
                    echo '<a href="' . esc_url(get_category_link($category->term_id)) . '">';
                    echo '<span class="menu-icon">🎬</span>';
                    echo '<span class="menu-text">' . esc_html($category->name) . '</span>';
                    echo '</a>';
                    echo '</li>';
                }
                ?>
                <li class="menu-item">
                    <a href="<?php echo esc_url(home_url('/categories/')); ?>">
                        <span class="menu-icon">🔍</span>
                        <span class="menu-text">Browse All</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Channels Section -->
        <div class="sidebar-section">
            <h3 class="section-title">POPULAR CHANNELS</h3>
            <ul class="sidebar-menu">
                <li class="menu-item">
                    <a href="#">
                        <span class="menu-icon">👤</span>
                        <span class="menu-text">Channel One</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#">
                        <span class="menu-icon">👤</span>
                        <span class="menu-text">Movie Central</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#">
                        <span class="menu-icon">👤</span>
                        <span class="menu-text">TV Shows</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Bottom Section -->
        <div class="sidebar-section">
            <ul class="sidebar-menu">
                <li class="menu-item">
                    <a href="#">
                        <span class="menu-icon">⚙️</span>
                        <span class="menu-text">Settings</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#">
                        <span class="menu-icon">❓</span>
                        <span class="menu-text">Help</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Collapse Toggle -->
        <div class="sidebar-footer">
            <button class="collapse-toggle" id="collapseToggle">
                <span class="collapse-icon">‹</span>
                <span class="collapse-text">Collapse</span>
            </button>
        </div>
    </div>
</nav>

<!-- Mobile Overlay -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>
		
        <button id="pull" aria-label="Mobile menu"><span><?php echo esc_html(get_bloginfo('name')); ?></span></button>
		
    <?php
    // Display post carousel on appropriate pages
    if (is_front_page() || is_home() || is_category() || is_tag() || is_search()) {
        // Include the carousel functionality
        $carousel_file = get_template_directory() . '/carousel.php';
        if (file_exists($carousel_file)) {
            include_once($carousel_file);
            display_post_carousel();
        }
    }
    ?>