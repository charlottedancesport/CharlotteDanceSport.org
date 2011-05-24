<?php
/**
 * @package WordPress
 * @subpackage Charlotte_DanceSport_Theme
 */
 
$browser = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
if ($browser == true)  {
?>

<!-- Display iPhone Web2.0 Application for Charlotte DanceSport! -->
<!--=============================================================-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "<? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="<? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
	<head profile="<? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://gmpg.org/xfn/11">
		<meta content="yes" name="apple-mobile-web-app-capable" />
		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
		<meta content="minimum-scale=1.0, width=device-width, maximum-scale=0.6667, user-scalable=no" name="viewport" />
		<link href="<?php bloginfo('stylesheet_directory'); ?>/css/style.css" rel="stylesheet" type="text/css" />
		<script src="<?php bloginfo('stylesheet_directory'); ?>/javascript/functions.js" type="text/javascript"></script>
		<link rel="apple-touch-icon" href="<?php bloginfo('stylesheet_directory'); ?>/homescreen.png"/>
		<link href="<?php bloginfo('stylesheet_directory'); ?>/startup.png" rel="apple-touch-startup-image" />	
		<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
	</head>
	<body>
		<div id="topbar">
			<div id="title">CDS iPhone Web 2.0 Test - "Hello World :->"</div>
		</div>
		<form method="post">
			<div id="content">
		<ul class="pageitem">
			<li class="bigfield"><input placeholder="Name" name="name" type="text" /></li>
			<li class="bigfield">
			<input placeholder="Password" name="passw" type="password" /></li>
		</ul>
				<span class="graytitle">Gender</span>
				<ul class="pageitem">
					<li class="radiobutton">
						<span class="name">Male</span>
						<input name="gender" type="radio" value="M" />
					</li>
					<li class="radiobutton">
						<span class="name">Female</span>
						<input name="gender" type="radio" value="F" />
					</li>
				</ul>
				<span class="graytitle">Favorite Foods</span>
				<ul class="pageitem">
					<li class="checkbox">
						<span class="name">Steak</span>
						<input name="steak" type="checkbox" />
					</li>
					<li class="checkbox">
						<span class="name">Pizza</span>
						<input name="pizza" type="checkbox" />
					</li>
					<li class="checkbox">
						<span class="name">Chicken</span>
						<input name="chicken" type="checkbox" />
					</li>
				</ul>
				<ul class="pageitem">
				<li class="textbox">
				<textarea name="quote" rows="5" cols="15">Enter your favorite quote!</textarea>
				</li>
				</ul>
				<span class="graytitle">Level of Education</span>
				<ul class="pageitem">
				<li class="select">
				<select name="education">
				<option value="Jr.High">Jr.High</option>
				<option value="HighSchool">HighSchool</option>
				<option value="College">College</option>
				</select>
				<span class="arrow"></ span>
				</li>
				</ul>
				<ul class="pageitem">				
							<li class="button">
			<input name="Submit" type="submit" value="Submit" />
			</li>
			</ul>
			</div>
			<div id="footer">
	<a href="<? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://iwebkit.net">Powered by iWebKit</a>
	</div>
	</body>
</html>

<?php } else { ?>

<?php get_header(); ?>

	<div id="content" class="narrowcolumn">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    
        	<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
            	<div class="post_details">
                	<div class="post_details_wrapper">
                        <div class="date_wrapper">
                            <div class="post_day"><?php the_time('j') ?></div>
                            <div class="month_day_wrapper">
                                <div class="post_month"><?php the_time('F') ?></div>
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
                    <div id="what_others_are_saying-<?php the_ID(); ?>" class="what_others_are_saying"><a>What are others saying?</a></div>
                </div>
               
            </div>

<? /*
		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<h2><?php the_title(); ?></h2>

			<div class="entry">
				<?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>

				<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
				<?php the_tags( '<p>Tags: ', ', ', '</p>'); ?>

				<p class="postmetadata alt">
					<small>
						This entry was posted
						<?php /* This is commented, because it requires a little adjusting sometimes.
							You'll need to download this plugin, and follow the instructions:
							http://binarybonsai.com/wordpress/time-since/ */
							/* $entry_datetime = abs(strtotime($post->post_date) - (60*120)); echo time_since($entry_datetime); echo ' ago'; / ?>
						on <?php the_time('l, F jS, Y') ?> at <?php the_time() ?>
						and is filed under <?php the_category(', ') ?>.
						You can follow any responses to this entry through the <?php post_comments_feed_link('RSS 2.0'); ?> feed.

						<?php if ( comments_open() && pings_open() ) {
							// Both Comments and Pings are open ?>
							You can <a href="#respond">leave a response</a>, or <a href="<?php trackback_url(); ?>" rel="trackback">trackback</a> from your own site.

						<?php } elseif ( !comments_open() && pings_open() ) {
							// Only Pings are Open ?>
							Responses are currently closed, but you can <a href="<?php trackback_url(); ?> " rel="trackback">trackback</a> from your own site.

						<?php } elseif ( comments_open() && !pings_open() ) {
							// Comments are open, Pings are not ?>
							You can skip to the end and leave a response. Pinging is currently not allowed.

						<?php } elseif ( !comments_open() && !pings_open() ) {
							// Neither Comments, nor Pings are open ?>
							Both comments and pings are currently closed.

						<?php } edit_post_link('Edit this entry','','.'); ?>

					</small>
				</p>

			</div>
		</div>
*/ ?>

	<?php comments_template(); ?>

	<?php endwhile; else: ?>

		<p>Sorry, no posts matched your criteria.</p>

<?php endif; ?>

	</div>
    
<?php get_sidebar(); ?>

<?php get_footer(); ?>

<?php } ?>