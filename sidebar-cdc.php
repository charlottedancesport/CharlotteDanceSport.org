<?php
/**
 * @package WordPress
 * @subpackage Charlotte_DanceSport_Theme
 */
?>

<?php get_social_network_links(); ?>

	<div id="sidebar">
		<ul>
			<?php 	/* Widgetized sidebar, if you have the plugin installed. */
					if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>
            <li>
                <?php get_search_form(); ?>
            </li>

			<!-- Author information is disabled per default. Uncomment and fill in your details if you want to use it.
			<li><h2>Author</h2>
			<p>A little something about you, the author. Nothing lengthy, just an overview.</p>
			</li>
			-->

			<?php if ( is_404() || is_category() || is_day() || is_month() ||
						is_year() || is_search() || is_paged() ) {
			?> <li>

			<?php /* If this is a 404 page */ if (is_404()) { ?>
			<?php /* If this is a category archive */ } elseif (is_category()) { ?>
			<p>You are currently browsing the archives for the <?php single_cat_title(''); ?> category.</p>

			<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
			<p>You are currently browsing the <a href="<?php bloginfo('url'); ?>/"><?php bloginfo('name'); ?></a> blog archives
			for the day <?php the_time('l, F jS, Y'); ?>.</p>

			<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
			<p>You are currently browsing the <a href="<?php bloginfo('url'); ?>/"><?php bloginfo('name'); ?></a> blog archives
			for <?php the_time('F, Y'); ?>.</p>

			<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
			<p>You are currently browsing the <a href="<?php bloginfo('url'); ?>/"><?php bloginfo('name'); ?></a> blog archives
			for the year <?php the_time('Y'); ?>.</p>

			<?php /* If this is a search result */ } elseif (is_search()) { ?>
			<p>You have searched the <a href="<?php bloginfo('url'); ?>/"><?php bloginfo('name'); ?></a> blog archives
			for <strong>'<?php the_search_query(); ?>'</strong>.</p>

			<?php /* If this set is paginated */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
			<p>You are currently browsing the <a href="<?php bloginfo('url'); ?>/"><?php bloginfo('name'); ?></a> blog archives.</p>

			<?php } ?>

			</li>
		<?php }?>
		</ul>
        
        <div class="search_sidebar_divider"></div>
        
		<ul>
            
            <li id="schedule" class="categories"><h2>Schedule</h2>
              <ul>
                <li><a id="concise_schedule" style="cursor:pointer;">Concise</a></li>
                <li><a id="detailed_schedule" style="cursor:pointer;">Detailed</a></li>
              </ul>
            </li>
            <li id="registration" class="categories"><h2>Registration</h2>
              <ul>
                <li><a href="http://www.o2cm.com/forms/entry.asp?event=chd" target="_blank">Online registration</a></li>
                <li><a href="http://www.o2cm.com/forms/entrylist.asp?event=chd" target="_blank">View entries</a></li>
              </ul>
            </li>
            <li id="officials"><h2 style="cursor:pointer;">Officials</h2></li>
            <li id="rules_fees"><h2 style="cursor:pointer;">Fees &amp; Rules</h2></li>
            <li id="housing"><h2 style="cursor:pointer;">Housing</h2></li>
            <li id="sponsors"><h2 style="cursor:pointer;">Sponsors</h2></li>
            <!--li id="pictures"><h2 style="cursor:pointer;">Pictures</h2></li-->
            <li id="dance_locations" style="cursor:pointer;"><h2>Location</h2>
                <ul style="display:none;">
                    <li><a href="<? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://cone.uncc.edu/meetingspaces" target="_blank">Cone Center | Lucas Ballroom</a></li>
                </ul>
            </li>
            <li id="contact_us"><a class="contactus cboxElement" style="text-decoration:none;" href="<?php bloginfo('stylesheet_directory'); ?>/send_email.php?type=cdc"><h2>Contact Us</h2></a></li>
            
            <div class="sidebar_divider"></div>
			
            <?php endif; ?>
		</ul>

	</div>
    
