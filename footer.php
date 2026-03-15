<?php
/**
 * The template for displaying the footer
 */
?>

<?php for ($i = 1; $i <= 4; $i++): ?>
    <?php if ($banner = get_option('amn_banners' . $i)): ?>
        <div class="ads">
            <div class="adsholder" id="adbox<?php echo $i; ?>">
                <?php echo $banner; // Note: If this contains user HTML, it may need escaping ?>
            </div>
        </div>
    <?php endif; ?>
<?php endfor; ?>


<div id="footer">
    <?php wp_nav_menu(array(
        'theme_location' => 'footer-menu', 
        'container' => 'div', // Changed from 'footer-menu' to standard container
        'container_class' => 'footer-menu-container',
        'menu_class' => 'footer_m',
        'fallback_cb' => false // This prevents automatic page listing
    )); ?>
    
    <p class="f3">© <?php echo date('Y'); ?> <?php echo esc_html(get_bloginfo('name')); ?></p>
</div>

<div class="loader"></div>

<?php wp_footer(); ?>

</body>
</html>