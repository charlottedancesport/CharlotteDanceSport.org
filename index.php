<?php
/**
 * @package WordPress
 * @subpackage Charlotte_DanceSport_Theme
 */
 
$iPhone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
$iPod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
$Android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
if ($iPhone == true || $iPod == true || $Android == true)  {
?>

<!-- Display iPhone Web2.0 Application for Charlotte DanceSport! -->
<!--=============================================================-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "<? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="<? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
	<head profile="<? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://gmpg.org/xfn/11">
		<meta content="yes" name="apple-mobile-web-app-capable" />
		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
		<meta content="minimum-scale=1.0, width=device-width, maximum-scale=0.6667, user-scalable=no" name="viewport" />
		<link href="<?php bloginfo('stylesheet_directory'); ?>/css/style-mobile.css" rel="stylesheet" type="text/css" />
		<script src="<?php bloginfo('stylesheet_directory'); ?>/js/functions-mobile.js" type="text/javascript"></script>
		<link rel="apple-touch-icon" href="<?php bloginfo('stylesheet_directory'); ?>/img/homescreen.png"/>
		<link href="<?php bloginfo('stylesheet_directory'); ?>/startup.png" rel="apple-touch-startup-image" />	
		<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
	</head>
	<body>
		<div id="header">
			<div id="cds_logo"></div>
            <p>Charlotte DanceSport</p>
            <p>49er Social &amp; Ballroom Dance Club</p>
		</div>
        
        <div id="content">
    		<ul>
            	<li><a href="<?php thisURL(); ?>/m/news/">News</a></li>
                <li><a href="<?php thisURL(); ?>/m/cal/">Calendar</a></li>
                <li><a href="<?php thisURL(); ?>/m/photos/">Photos</a></li>
                <li><a href="<?php thisURL(); ?>/m/videos/">Videos</a></li>
                <li><a href="<?php thisURL(); ?>/m/follow-share/">Follow Share</a></li>
                <li><a href="<?php thisURL(); ?>/m/membership/">Membership</a></li>
                <li><a href="<?php thisURL(); ?>/m/contact/">Contact us</a></li>
                <li><a href="#">more...</a></li>
            </ul>
        </div>
        <div id="footer">
			<p>View CDS in <b>Mobile</b> | <a href="#">Desktop</a></p>
            <p>&copy; 2010 Charlotte DanceSport</p>
            <p>d/b/a/ 49er Social &amp; Ballroom Dance Club</p>
            <p>@ UNC-Charlotte</p>
        </div>
	</body>
</html>

<?php } else { ?>

<?php get_header(); ?>

	<div id="content" class="narrowcolumn">
    
    <!-- Set the number of post to display per page -->
	<?php if (have_posts()) : query_posts($query_string.'&posts_per_page=5');  ?>

		<?php while (have_posts()) : the_post(); ?>
        	<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
            	<div class="post_details">
                	<div class="post_details_wrapper">
                        <div class="date_wrapper">
                            <div class="post_day"><?php the_time('j') ?></div>
                            <div class="month_day_wrapper">
                                <div class="post_month"><?php the_time('M') ?></div>
                                <div class="post_year"><?php the_time('Y') ?></div>
                            </div>
                        </div>
                        <div>
                        	<p class="post_author_gavator_icon"><?php echo get_avatar( get_the_author_email(), '50' ); ?></p>
                            <p class="post_by">Posted by:</p>
                            <p class="post_author"><?php the_author(); ?></p>
                            <p class="post_comments"><?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></p>
                        </div>
                    </div>
                </div>
                <div class="white_left_arrow"></div>
                <div class="entry">
                	<div class="entry_wrapper">
                    <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
					<?php the_content('Read more... &raquo;'); ?>
                    
                    </div>
                    
				</div>
                <div id="comment_control_links-<?php the_ID(); ?>" class="comment_control_links">
                    <div id="comment_on_this_link-<?php the_ID(); ?>" class="comment_on_this_link"><a>Comment on this</a></div>
                    <div id="what_are_others_saying_link-<?php the_ID(); ?>" class="what_are_others_saying_link"><a>What are others saying?</a></div>
                </div>
               
            </div>

            <ul id="post_commenter-<?php the_ID(); ?>" class="post_commenter">
            <?php /*    <li>
                <div>
                    <div class="whats_on_your_mind"></div>

                    <div class="comment_form_wrapper">
                        <div id="commentform-<?php the_ID(); ?>">
                        
                        <?php if ( is_user_logged_in() ) : ?>
                        
                        <p class="commenting_as">You are commenting as <a href="<?php thisURL(); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Not you? Log out &raquo;</a></p>
                        
                        <?php else : ?>
                        
                        <p><div id="author-<?php the_ID(); ?>"><?php echo esc_attr($comment_author); ?></div>
                        <label for="author-<?php the_ID(); ?>">Name *<span class="required"><?php if ($req) echo "(Required) "; ?></span></label></p>
                        
                        <p><div id="email-<?php the_ID(); ?>"><?php echo esc_attr($comment_author_email); ?></div>
                        <label for="email-<?php the_ID(); ?>">E-mail <span class="required"><?php if ($req) echo "(Required) "; ?>( Will not be published. ) *</span></label></p>
                        
                        <?php endif; ?>
                        
                        <!--<p><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p>-->
                        
                        <p><div id="comment-textarea-<?php the_ID(); ?>"></div></p>
                        
                        <p><div id="submit-<?php the_ID(); ?>">Submit</div><a id="cancel_comments-<?php the_ID(); ?>" class="cancel_comments">Cancel</a>
                        <?php comment_id_fields(); ?>
                        </p>
                        <?php do_action('comment_form', $post->ID); ?>
                        
                        </div>
                    </div>
                    
                    <!-- <? /*
                    <div class="comment_form_wrapper">
                        <form action="<?php thisURL(); ?>/wp-comments-post.php" method="post" id="commentform-<?php the_ID(); ?>" class="commentform">
                        
                        <?php if ( is_user_logged_in() ) : ?>
                        
                        <p class="commenting_as">You are commenting as <a href="<?php thisURL(); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Not you? Log out &raquo;</a></p>
                        
                        <?php else : ?>
                        
                        <p><input type="text" name="author" id="author-<?php the_ID(); ?>" class="author" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
                        <label for="author-<?php the_ID(); ?>">Name *<span class="required"><?php if ($req) echo "(Required) "; ?></span></label></p>
                        
                        <p><input type="text" name="email" id="email-<?php the_ID(); ?>" class="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
                        <label for="email-<?php the_ID(); ?>">E-mail <span class="required"><?php if ($req) echo "(Required) "; ?>( Will not be published. ) *</span></label></p>
                        
                        <?php endif; ?>
                        
                        <!--<p><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p>-->
                        
                        <p><textarea name="comment" id="comment-textarea-<?php the_ID(); ?>" class="comment" rows="4" cols="15"></textarea></p>
                        
                        <p><input name="submit" type="submit" id="submit-<?php the_ID(); ?>" class="submit" value="Submit" /><a id="cancel_comments-<?php the_ID(); ?>" class="cancel_comments">Cancel</a>
                        <?php comment_id_fields(); ?>
                        </p>
                        <?php do_action('comment_form', $post->ID); ?>
                        
                        </form>
                    </div>
					-->
                </div>
                </li> */ ?>
            </ul>
            <ul id="post_comment-<?php the_ID(); ?>" class="post_comment">
            	<li>
                	<div class="what_others_are_saying"><h1>What others are saying</h1></div>
                	<div class="comments_wrapper">
                    	
                  		<?php 
							$comment_array = get_comments( 'post_id='.$post->ID );
							
							if(count($comment_array)) {
						?>
                        
                        <ul class="commentlist">
                        
                        <?php foreach($comment_array as $comment){ ?>
                        	
                            
                            <li id="comment-<?php echo $comment->comment_ID ?>">
                            <div class="one_comment_wrapper">
                              
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
                            </div>
                            </li>
                        	
                        <?php } // end for each comment ?>
                        
                        
                        
                        <?php } else { // this is displayed if there are no comments so far ?>
                        
						<ul class="commentlist">
						
                            <li id="comment-0000000">
                            <div class="one_comment_wrapper">
                              
                            	<div class="comment_details_wrapper">
                                	<div class="post_author_gravatar_icon">
										<?php echo get_avatar( 'charlottedancesport@gmail.com', '80' ); ?>
                                    </div>
                                    <div class="comment_details">
                                        <p class="author"><?php //comment_author_link($comment->comment_ID) ?></p>
                                        <p class="date"><?php //comment_date('F j, Y',$comment->comment_ID) ?></p>
                                        <!--<p class="date"><?php //comment_time('h:i:s',$comment->comment_ID) ?></p>-->
                                    </div>
                                </div>
                                
                                <div class="comment_bubble">
                                    <div class="author_left_arrow"></div>
                                    
                                    <div class="comment_entry_wrapper">
                                        <div class="author_top_bg"></div>
                                        <div class="author_main_bg"><p style="font-size: 1.5em; font-weight:600;">No comments yet! Be the first to comment on this post.</p></div>
                                        <div class="author_base_bg"></div>
                                    </div>
                                </div>
                            </div>
                            </li>
                            
                        <?php } ?>
                        
						</ul>
						
                	</div>
                </li>
            </ul>
			<script type="text/javascript" language="javascript">
			$(document).ready(function () {
				$('#comment_on_this_link-<?php the_ID(); ?>').click(function () {
					$('.post_commenter').empty();
					
					if ($('#post_commenter-<?php the_ID(); ?>').is(":hidden")) {
						$('.post_commenter').slideUp('fast');
						$('.comment_on_this_link a').text('Comment on this');
						$('#post_commenter-<?php the_ID(); ?>').append("<li><div><div class='whats_on_your_mind'></div><div class='comment_form_wrapper'><form id='commentform-<?php the_ID(); ?>' action='<?php thisURL(); ?>/wp-comments-post.php' method='post'><div id='comment_form_alert_msg'><span>&nbsp;</span></div><?php if ( is_user_logged_in() ) : ?><p class='commenting_as'>You are commenting as <a href='<?php thisURL(); ?>/wp-admin/profile.php'><?php echo $user_identity; ?></a>. <a href='<?php echo wp_logout_url(get_permalink()); ?>' title='Log out of this account'>Not you? Log out &raquo;</a></p><?php else : ?><p><input type='text' name='author' id='author' value='<?php echo esc_attr($comment_author); ?>' size='22' tabindex='1' <?php if ($req) echo "aria-required='true'"; ?> /><label for='author'>Name <span class='required'><?php if ($req) echo "(Required) "; ?></span></label></p><p><input type='text' name='email' id='email' value='<?php echo esc_attr($comment_author_email); ?>' size='22' tabindex='2' <?php if ($req) echo "aria-required='true'"; ?> /><label for='email'>E-mail <span class='required'><?php if ($req) echo "(Required) "; ?>(Will not be published.)</span></label></p><?php endif; ?><p><textarea name='comment' id='comment' row='4' cols='15' tabindex='3'></textarea></p><p><input name='submit' type='submit' id='submit' tabindex='4' value='Submit' /><a id='cancel_comments-<?php the_ID(); ?>' class='cancel_comments'>Cancel</a><input type='hidden' name='comment_post_ID' value='<?php the_ID(); ?>' id='comment_post_ID' /><input type='hidden' name='comment_parent' id='comment_parent' value='0' /></p>"+'<?php do_action('comment_form', $post->ID); ?>'+"</form></div></div></li>");
						
						$("#commentform-<?php the_ID(); ?>").addClass("commentform").submit(function () {
							var error_message;
							var err = false;
							
							if (<?php if ( !is_user_logged_in() ) { ?>$('#author').val() == "" || $('#email').val() == "" || <?php } ?> $('#comment').val() == ""){
							error_message = <?php if ( !is_user_logged_in() ) { ?>"ERROR: All fields are required!"<?php } else { ?>"ERROR: Comment field is required!"<?php } ?>;
							err = true;
							}
							if (err){
							$("#comment_form_alert_msg span").text(error_message).addClass("invalid");
							try{$('#author').focus();}catch(e){};
							return false;
							}
							<?php if ( !is_user_logged_in() ) { ?>
							if (!validEmail( $('#email').val() )) {
								$("#comment_form_alert_msg span").text("ERROR: Invalid email!").addClass("invalid");
								try{$('#email').focus();}catch(e){};
								return false;
							}
						 	<?php } ?>
						});
						$("#author").addClass("author");
						$("p > #author").css("margin-top", "0px");
						$("#email").addClass("email");
						$("#comment").addClass("comment");
						$("#submit").addClass("submit");
						
						$('#cancel_comments-<?php the_ID(); ?>').click(function () {
							$('#post_commenter-<?php the_ID(); ?>').slideUp('fast');
							$('#post_commenter-<?php the_ID(); ?>').empty();
							$('#comment_on_this_link-<?php the_ID(); ?> a').text( ($('#comment_on_this_link-<?php the_ID(); ?> a').text() == 'Close comment form') ? 'Comment on this' : 'Close comment form');
						});
					}
					$('#post_commenter-<?php the_ID(); ?>').slideToggle('fast');
					$('#comment_on_this_link-<?php the_ID(); ?> a').text( ($('#comment_on_this_link-<?php the_ID(); ?> a').text() == 'Close comment form') ? 'Comment on this' : 'Close comment form');
				});

			});
			$(document).ready(function () {
				$('#what_are_others_saying_link-<?php the_ID(); ?>').click(function () {
					if ($('#post_comment-<?php the_ID(); ?>').is(":hidden")) {
						$('.post_comment').slideUp('fast');
						$('.what_are_others_saying_link a').text('What are other saying?');
					}
					$('#post_comment-<?php the_ID(); ?>').slideToggle('medium');
					$('#what_are_others_saying_link-<?php the_ID(); ?> a').text( ($('#what_are_others_saying_link-<?php the_ID(); ?> a').text() == 'Close comments') ? 'What are other saying?' : 'Close comments');
				});
			});
			
			
			$(document).ready(function () {
				$('#post-<?php the_ID(); ?>').hover(
					function () {
						//$('#comment_control_links-<?php the_ID(); ?>').slideToggle('fast');
						$('#comment_control_links-<?php the_ID(); ?>').fadeIn(100);
					},
					function () {
						$('#comment_control_links-<?php the_ID(); ?>').fadeOut(100);
					}
				);
			});
			
			/**
			 * Creates the Comment form
			 * Uses JQuery -A Better Form- library to convert hardcorded <div>'s to form elements.
			 * Purpose: Fullproof agent to deter form submission SPAM generators
			 */
			<?php /* jQuery(document).ready(function () {
				$("#commentform-<?php the_ID(); ?>").abform({
					attributes :'id="commentform-<?php the_ID(); ?>" action="<?php thisURL(); ?>/wp-comments-post.php" method="post"',
					convert :'{author|text|size="22" tabindex="1" class="author" <?php if ($req) echo "aria-required=\"true\""; ?>}{email|text|size="22" tabindex="2" class="email" <?php if ($req) echo "aria-required=\"true\""; ?>}{comment|textarea|rows="4" cols="15" tabindex="3" class="comment"}{submit|submit|tabindex="4" class="submit absubmit"}'
				});
				<? /*
				$("#commentform-<?php the_ID(); ?>").addClass("commentform"); //.attr("action","<?php //thisURL(); ?>/wp-comments-post.php");
				$("#author-<?php the_ID(); ?>").attr("name","author");
				$("#email-<?php the_ID(); ?>").attr("name","email");
				$("#comment-textarea-<?php the_ID(); ?>").attr("name","comment");
				$("#submit-<?php the_ID(); ?>").click(function() {
					$("#author-<?php the_ID(); ?>").attr("id","author");
					$("#email-<?php the_ID(); ?>").attr("id","email");
					//$("#comment-textarea-<?php //the_ID(); ?>").attr("id","comment");
				});
				
			}); */ ?>
            </script>
		<?php endwhile; ?>

		<div class="navigation">
			<div class="" style="color: white; text-align: center; line-height: 35px; margin: 15px auto l5px auto; height:35px; width: 670px; float: right;"><?php next_posts_link('&laquo; Older Entries') ?></div>
			<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
		</div>

	<?php else : ?>
    
<!--		<h2 class="center">Not Found</h2>
		<p class="center">Sorry, but you are looking for something that isn't here.</p>
 -->
		<?php //get_search_form(); ?>

		<script type="text/javascript">
        $(document).ready( function() {
            $('.type-page').remove();
            
            /**
             * If flash is not installed display non flash version of tags and categories, 
             * else if Flash is installed & the search return no results display the 
             * tags + categories cloud.
             */
            if (navigator.mimeTypes ["application/x-shockwave-flash"] == undefined) {
                $("#flash_tag_list").remove();
            } else {
                $("#no_flash_tag_list").remove();
            }
        });
        </script>
    
        <div id="content" class="narrowcolumn">
            
            <div style="margin:40px auto auto 60px;">
                <h2 class="no_posts_found">Oopsy! I can't find the webpage you're looking for :(<br />Did you mistype a letter or two?</h2>
                
                <h2 class="select_tag_cat">Try selecting a category or tag to view posts that are related.</h2>
                <ul id="no_flash_tag_list">
                <?php wp_list_categories('show_count=1&title_li=<h2>Categories</h2>'); ?>
                    <li class="tag_cloud">
                    <h2>Tags &amp; Categories Cloud</h2>
                        <ul>
                <?php 
                    //$args = array('taxonomy' => array('post_tag','category')); 
        
                    $tag = wp_tag_cloud( 'format=array' );
                    
                    foreach ($tag as $t) {
                        echo '<li>'.$t.'</li>';
                    }
                ?>
                        </ul>
                    </li>
                </ul>
                
                <ul id="flash_tag_list">
                    <li>
                <?php wp_cumulus_insert(); ?>
                    </li>
                </ul>
    
            </div>
        </div>
    
	<?php endif; ?>

	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>

<?php } ?>
