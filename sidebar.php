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
			<?php if ( is_user_logged_in() ) { ?>
            
            <li id="cds_labs"><h2>CDS Labs</h2><div class="cds_labs_icon"></div>
                <ul>
                    <li><a href="#">Dance Recipes</a></li>
                    <li><a href="<?php bloginfo('url'); ?>/accounts/">Member Profiles</a></li>
                    <li><a class="score_card" href="https://forms.netsuite.com/app/site/hosting/scriptlet.nl?script=25&deploy=1&compid=911791&h=42a9f15e58a47015727d" target="_blank" >Your Score Cards</a></li>
                </ul>
            </li>
            
            <div class="sidebar_divider"></div>
            <?php } ?>
            
            <li id="about_cds"><h2>About CDS</h2>
                <ul>
                	<li class="membership_dues"><a>Membership Dues</a>
                    	<ul class="membership_submenu">
                        	<li><a alt="Social dance lessons." title="Social dance lessons." href="<?php bloginfo('stylesheet_directory'); ?>/membership_dues_social.html" rel="member_dues">Social Dance Club</a></li>
                            <li><a alt="Newcomer Team dues." title="Newcomer Team dues." href="<?php bloginfo('stylesheet_directory'); ?>/membership_dues_newcomer.html" rel="member_dues">Newcomer Team</a></li>
                            <li><a alt="Bronze Team dues." title="Bronze Team dues." href="<?php bloginfo('stylesheet_directory'); ?>/membership_dues_bronze.html" rel="member_dues">Bronze Team</a></li>
                            <li><a alt="Silver Team dues." title="Silver Team dues." href="<?php bloginfo('stylesheet_directory'); ?>/membership_dues_silver.html" rel="member_dues">Silver Team</a></li>
                            <!--<li><a alt="Gold/Novice and beyond!" title="Gold/Novice and beyond!" href="<?php //bloginfo('stylesheet_directory'); ?>/membership_dues.html" rel="member_dues">Gold/Novice +</a></li>-->
                        </ul>
                    </li>
                    <!--<li><a href="#">Officers</a></li>-->
                    <li><a class="contactus cboxElement" href="<?php bloginfo('stylesheet_directory'); ?>/send_email.php">Contact CDS</a></li>
                    <li><a class="donate_to_cds" href="https://giving.uncc.edu/default.asp?id=2">Donate to CDS</a></li>
                </ul>
            </li>
            
            <div class="sidebar_divider"></div>
            
			<li id="dance_locations"><h2>Dance Locations</h2>
                <ul>
                    <li><a href="<? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://cone.uncc.edu/meetingspaces" target="_blank">Cone Center | Lucas Ballroom</a></li>
                    <li><a href="<? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://www.recservices.uncc.edu/facilities_sac.htm" target="_blank">SAC | Aerobics Room</a></li>
                </ul>
            </li>
			
			<?php /* Remove for initial launch
            <li id="dance_locations"><h2>Dance Locations</h2>
                <ul>
                    <li><a href="<?php bloginfo('stylesheet_directory'); ?>/img/lucas_room.jpg" rel="locations">Cone Center | Lucas Ballroom</a></li>
                    <li><a href="<?php bloginfo('stylesheet_directory'); ?>/img/aerobics_room.jpg" rel="locations">SAC | Aerobics Room</a></li>
                </ul>
            </li>
            */ ?>
            <div class="sidebar_divider"></div>
            
			<?php wp_list_categories('show_count=1&title_li=<h2>Categories</h2>'); ?>
            
            <div class="sidebar_divider"></div>
            
			<li id="archives"><h2>Archives</h2>
				<ul>
				<?php wp_get_archives('type=monthly'); ?>
				</ul>
			</li>
            <?php endif; ?>
		</ul>

	</div>
    
