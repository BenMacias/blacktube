<?php
/**
 * Theme style switcher - securely handle style changes
 *
 * Disable/delete this file as you planned. The security risks outweigh the functionality benefits. Modern approaches (WordPress Customizer or CSS variables) are much safer and more maintainable.
 * This is probably the most dangerous file in your theme due to the complete lack of security measures! 🔥
 */

// Only process if it's a GET request
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    
    // Validate and sanitize the input
    $allowed_styles = ['red', 'pink', 'blue', 'green', 'dark']; // Add allowed styles
    $requested_style = $_GET['style_css'] ?? '';
    
    // Check if it's a valid style option
    if (in_array($requested_style, $allowed_styles)) {
        // Set cookie for 10 hours - secure settings
        setcookie(
            "style_css", 
            'style.' . $requested_style, 
            time() + 36000, 
            "/", 
            "", 
            false, // secure - set to true if using HTTPS
            true   // httponly - prevents JS access
        );
    } else {
        // Invalid style requested - clear the cookie
        setcookie("style_css", '', time() - 36000, "/", "", false, true);
    }
    
    // Safe redirect - fallback to home page if referer is suspicious
    $redirect_url = $_SERVER['HTTP_REFERER'] ?? home_url();
    
    // Validate the redirect URL to prevent open redirect attacks
    if (filter_var($redirect_url, FILTER_VALIDATE_URL)) {
        $site_host = parse_url(home_url(), PHP_URL_HOST);
        $redirect_host = parse_url($redirect_url, PHP_URL_HOST);
        
        // Only redirect to same domain
        if ($redirect_host === $site_host) {
            wp_safe_redirect($redirect_url);
            exit;
        }
    }
    
    // Fallback safe redirect
    wp_safe_redirect(home_url());
    exit;
}

// If not GET request, redirect home
wp_safe_redirect(home_url());
exit;
?>