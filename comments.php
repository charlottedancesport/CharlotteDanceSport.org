<?php
/**
 * @package WordPress
 * @subpackage Charlotte_DanceSport_Theme
 */

// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments">This post is password protected. Enter the password to view comments.</p>
	<?php
		return;
	}
?>

<!-- You can start editing here. -->
<?php if ( have_comments() ) : ?>
<ul id="post_comment" class="post_comment_visible">
    <li>
        <div class="what_others_are_saying"><h1>What others are saying</h1></div>
        <div class="comments_wrapper">
            
            <?php 
                $comment_array = get_comments( 'post_id='.$post->ID );
                
                if(count($comment_array)) {
            ?>
            
            <ol class="commentlist">
            
            <?php foreach($comment_array as $comment){ ?>
                <div class="one_comment_wrapper">
                
                <li id="comment-<?php echo $comment->comment_ID ?>">
                  
                    <div class="comment_details_wrapper">
                        <div class="post_author_gravatar_icon">
                            <?php echo get_avatar( get_comment_author_email($comment->comment_ID), '80' ); ?>
                        </div>
                        <div class="comment_details">
                            <p class="author"><?php comment_author_link($comment->comment_ID) ?></p>
                            <p class="date"><?php comment_date('F j, Y',$comment->comment_ID) ?></p>
                            <!--<p class="date"><?php //comment_time('h:i:s',$comment->comment_ID) ?></p>-->
                        </div>
                    </div>
                    
                    <div class="comment_bubble">
                        <div class="<?php echo (get_the_author_meta("ID") == $comment->user_id) ? "author_left_arrow" : "left_arrow"; ?>"></div>
                        
                        <div class="comment_entry_wrapper">
                            <div class="<?php echo (get_the_author_meta("ID") == $comment->user_id) ? "author_top_bg" : "top_bg"; ?>"></div>
                            <div class="<?php echo (get_the_author_meta("ID") == $comment->user_id) ? "author_main_bg" : "main_bg"; ?>"><p><?php echo ($comment->comment_approved == 1) ? $comment->comment_content : "<em>Your comment is awaiting moderation.</em>"; ?></p></div>
                            <div class="<?php echo (get_the_author_meta("ID") == $comment->user_id) ? "author_base_bg" : "base_bg"; ?>"></div>
                        </div>
                    </div>
               
                </li>
                
                </div>
            <?php } // end for each comment ?>
            
            </ol>
            
            <?php } else { // this is displayed if there are no comments so far ?>
            
                <p>No comments yet.</p>
                
            <?php } ?>
            
        </div>
    </li>
</ul>
<? /*	<h3 id="comments"><?php comments_number('No Responses', 'One Response', '% Responses' );?> to &#8220;<?php the_title(); ?>&#8221;</h3>

	<div class="navigation">
		<div class="alignleft"><?php previous_comments_link() ?></div>
		<div class="alignright"><?php next_comments_link() ?></div>
	</div>

	<ol class="commentlist">
	<?php wp_list_comments(); ?>
	</ol>

	<div class="navigation">
		<div class="alignleft"><?php previous_comments_link() ?></div>
		<div class="alignright"><?php next_comments_link() ?></div>
	</div>
*/ ?>
 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="nocomments">Comments are closed.</p>

	<?php endif; ?>
<?php endif; ?>


<?php if ( comments_open() ) : ?>

<div id="respond">

<? 
/*<h3><?php comment_form_title( 'Leave a Reply', 'Leave a Reply to %s' ); ?></h3>

<div class="cancel-comment-reply">
	<small><?php cancel_comment_reply_link(); ?></small>
</div>
*/ 
?>

<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
<p>You must be <a href="<?php echo wp_login_url( get_permalink() ); ?>">logged in</a> to post a comment.</p>
<?php else : ?>
<ul id="post_commenter" class="post_commenter_visible">
    <li>
        <div>
            <div class="whats_on_your_mind"></div>

            <div class="comment_form_wrapper">
                <div id="commentform">
                
                <?php if ( is_user_logged_in() ) : ?>
                
                <p class="commenting_as margintop20px">You are commenting as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Not you? Log out &raquo;</a></p>
                
                <?php else : ?>
                
                <p><div id="author"><?php echo esc_attr($comment_author); ?></div>
                <label for="author">Name <span class="required"><?php //if ($req) echo "(Required) "; ?></span></label></p>
                
                <p><div id="email"><?php echo esc_attr($comment_author_email); ?></div>
                <label for="email">E-mail <span class="required"><?php //if ($req) echo "(Required) "; ?>(Will not be published.)</span></label></p>
                
                <?php endif; ?>
                
                <!--<p><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p>-->
                
                <p><div id="comment"></div></p>
                
                <p><div id="submit">Submit</div>
                <?php comment_id_fields(); ?>
                </p>
                <?php do_action('comment_form', $post->ID); ?>
                
                </div>
            </div>
        </div>
    </li>
</ul>
<?php /*
<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<?php if ( is_user_logged_in() ) : ?>

<p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out &raquo;</a></p>

<?php else : ?>

<p><input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
<label for="author"><small>Name <?php if ($req) echo "(required)"; ?></small></label></p>

<p><input type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
<label for="email"><small>Mail (will not be published) <?php if ($req) echo "(required)"; ?></small></label></p>

<p><input type="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="22" tabindex="3" />
<label for="url"><small>Website</small></label></p>

<?php endif; ?>

<!--<p><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p>-->

<p><textarea name="comment" id="comment" cols="58" rows="10" tabindex="4"></textarea></p>

<p><input name="submit" type="submit" id="submit" tabindex="5" value="Submit Comment" />
<?php comment_id_fields(); ?>
</p>
<?php do_action('comment_form', $post->ID); ?>

</form> 
*/ ?>
<script type="text/javascript" language="javascript">
/**
 * Creates the Comment form
 * Uses JQuery -A Better Form- library to convert hardcorded <div>'s to form elements.
 * Purpose: Fullproof agent to deter form submission SPAM generators
 */
jQuery(document).ready(function () {
    $("#commentform").abform({
        attributes :'name="commentform" id="commentform" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post"',
        convert :'{author|text|size="22" tabindex="1" class="author" <?php if ($req) echo "aria-required=\"true\""; ?>}{email|text|size="22" tabindex="2" class="email" <?php if ($req) echo "aria-required=\"true\""; ?>}{comment|textarea|rows="4" cols="15" tabindex="3" class="comment"}{submit|submit|tabindex="4" class="submit absubmit"}'
    });
	
	$("#commentform").addClass("commentform"); //.attr("action","<?php //echo get_option('siteurl'); ?>/wp-comments-post.php");
	$("#author").addClass("author");
	$("#email").addClass("email");
	$("#comment").addClass("comment");
	$("#submit").addClass("submit");
});
</script>
<?php endif; // If registration required and not logged in ?>
</div>

<?php endif; // if you delete this the sky will fall on your head ?>
