<?php
/**
 * The comments template
 */

// Prevent direct access - more secure method
if (!defined('ABSPATH')) {
    exit;
}

// Check if post is password protected
if (post_password_required()) {
    echo '<p>This post is password protected. Enter the password to view comments.</p>';
    return;
}

$comments_count = get_comments_number();
?>

<?php if (comments_open()) : ?>
    <?php if (have_comments()) : ?>
        <ol class="comment-list" id="comments">
            <?php 
            wp_list_comments(array(
                'callback' => 'custom_comments',
                'style' => 'ol',
                'short_ping' => true
            )); 
            ?>
        </ol>
        
        <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
            <div class="comments-paginator">
                <?php paginate_comments_links(array(
                    'prev_text' => 'Previous', 
                    'next_text' => 'Next'
                )); ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>
    
    <div class="comments" id="comment">
        <?php 
        $commenter = wp_get_current_commenter();
        $req = get_option('require_name_email');
        $aria_req = ($req ? " aria-required='true'" : '');
        $required_text = sprintf(' ' . __('Required fields are marked %s'), '<span class="required">*</span>');
        
        $fields = array(
            'author' => '<input class="input-text" id="author" name="author" type="text" placeholder="Your Name" value="' . esc_attr($commenter['comment_author']) . '"' . $aria_req . ' />',
            'email' => '<input class="input-text" id="email" name="email" type="text" placeholder="E-mail" value="' . esc_attr($commenter['comment_author_email']) . '"' . $aria_req . ' />',
        );
        
        $args = array(
            'title_reply' => 'Leave a Comment',
            'title_reply_to' => 'Leave a Reply to %s',
            'cancel_reply_link' => 'Cancel Reply',
            'label_submit' => 'Add Comment',
            'comment_field' => '<textarea class="input-textarea" id="comment" name="comment" placeholder="Your comment..." aria-required="true"></textarea>',
            'must_log_in' => '<p class="must-log-in">You must be <a href="' . esc_url(wp_login_url(get_permalink())) . '">logged in</a> to post a comment.</p>',
            'logged_in_as' => '<p class="logged-in-as">' . sprintf(__('Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>'), admin_url('profile.php'), $user_identity, wp_logout_url(get_permalink())) . '</p>',
            'comment_notes_before' => '<p class="comment-notes">Your email address will not be published.</p>',
            'fields' => apply_filters('comment_form_default_fields', $fields),
        );
        
        comment_form($args);
        ?>
    </div>
<?php else : ?>
    <p class="comments-closed">Comments are closed.</p>
<?php endif; ?>

<div class="clear"></div>