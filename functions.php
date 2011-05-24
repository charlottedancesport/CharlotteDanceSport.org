<?php
/**
 * @package WordPress
 * @subpackage Charlotte_DanceSport_Theme
 */

/**
 * Add new dance tip to db
 * @param: $tip - the string of text for the tip
 */
function add_dance_tip($tip, $description, $dances, $category, $submitter_id){
	// use the globle WordPress Database
	global $wpdb;
	
	//add the new dance tip
	$wpdb->query("INSERT INTO cds_dance_tips (title, description, dances, dance_category, officer_id) VALUES ('{$tip}', '{$description}', '{$dances}', '{$category}', '{$submitter_id}')");
	/*
	$wpdb->show_errors();
	$wpdb->print_error();
	*/
}

/**
 * Add new cdc news feed to db
 * @param: $feed - the string of text for the tip
 * $ubmitter_id - id of the submitting user.
 */
function add_cdc_news_feed($feed, $submitter_id){
	// use the globle WordPress Database
	global $wpdb;
	
	//add the new cdc news feed
	$wpdb->query("INSERT INTO cdsc_news_feed (title) VALUES ('{$feed}')");
	/*
	$wpdb->show_errors();
	$wpdb->print_error();
	*/
}

/**
 * Update function for the yellow and red alerts
 */
function update_alert($color, $description){
	// use the globle WordPress Database
	global $wpdb;
	
	//update the alerts
	$wpdb->query("UPDATE cds_alerts SET archived=1 WHERE archived=0 AND color='{$color}'");

	if ($description !== null && $description !== 'null') { $wpdb->query("INSERT INTO cds_alerts (color, description, archived) VALUES ('{$color}','{$description}',0)"); }
 
}

/**
 * Return a dance tip randomly from the database
 */
function get_dance_tip() {
	// use the globle WordPress Database
	global $wpdb;
	
	// store total number of tips in the database
	$count = $wpdb->get_results( "SELECT COUNT(*) as total FROM cds_dance_tips" );
	
	//select the random tip and echo it out to the calling file.
	$random_number = mt_rand(0,$count[0]->total-1);
	$tip = $wpdb->get_results( "SELECT title FROM cds_dance_tips LIMIT {$random_number},1" );
	echo $tip[0]->title;
}

/**
 * Return a random CDSC news feed from the database
 */
function get_cdsc_news_feed() {
	// use the globle WordPress Database
	global $wpdb;
	
	// store total number of news feed in the database
	$count = $wpdb->get_results( "SELECT COUNT(*) as total FROM cdsc_news_feed" );
	
	//select the random news feed and echo it out to the calling file.
	$random_number = mt_rand(0,$count[0]->total-1);
	$feed = $wpdb->get_results( "SELECT title FROM cdsc_news_feed LIMIT {$random_number},1" );
	echo $feed[0]->title;
}

/**
 * Return array of filenames for a specified system directory
 * 
 * @param: dir_path - the relative path string to the directory.
 * Meaning if the full path to your target directory is is 
 * http://www.mysite.com/subDir1/subDir2/targetDir then the
 * relative path will be "subDir1/subDir2/targetDir".
 */
 
function get_directory_listing($dir_path) {
	
	//using the opendir function
	$dir_handle = @opendir($dir_path) or die("Unable to open $dir_path");
	
	$filename = NULL;
	//running the while loop
	while ($file = readdir($dir_handle)) 
	{
	   if($file!='.' && $file!='..' && preg_match("/\.[A-Za-z][A-Za-z0-9]{2,3}$/", $file)) 
	   	$filename[] = $file;
	}

	//closing the directory
	closedir($dir_handle);
	
	// return the array of filenames in the directory ^_^
	return $filename;
}

/**
 * Get the banner images and add markeup to display them.
 *
 * @param: dir_path - the relative path string to the directory.
 * Meaning if the full path to your target directory is is 
 * http://www.mysite.com/subDir1/subDir2/targetDir then the
 * relative path will be "subDir1/subDir2/targetDir".
 */
function get_banner_images() {
	// get array of filenames
	//$filename = get_directory_listing($dir_path);
	
	// Loop over each filename, append markup and display
/*	foreach( $filename as $fn) {
		if($fn!='.' && $fn!='..' && preg_match("/\.[A-Za-z][A-Za-z0-9]{2,3}$/", $fn)) 
			echo "<img src=\"".thisURL()."/wp-content/themes/charlotte_dancesport/banner_images/".$fn."\" alt=\"\" title=\"\" />";
	}*/
	
	// Get banner images that should currently be displayed from database.
	global $wpdb;
	$photo = $wpdb->get_results( "SELECT filename FROM banner_slides WHERE approved=1 AND archived=0 AND (forever=1 OR (start_date <= NOW() && end_date >= NOW()))" );
	
	foreach ($photo as $p) {
		echo "<img src=\"".thisURL()."/wp-content/themes/charlotte_dancesport/banner_images/".$p->filename."\" alt=\"\" title=\"\" width=\"960\" height=\"280\" />";
	}
	
	//$wpdb->show_errors();
	//$wpdb->print_error();
}


/**
 * Get the green alert image and add markeup to display it.
 */
function get_green_alert_image() {
	global $wpdb;
	$photo = $wpdb->get_results( "SELECT filename, url FROM cds_green_alert_banners WHERE archived=0 AND (forever=1 OR (start_date <= NOW() && end_date >= NOW()))" );
	

	
	foreach ($photo as $p) {
		echo "<style type=\"text/css\">
		#green_alerts_banner {
		background: url('".thisURL()."/wp-content/themes/charlotte_dancesport/green_alert_images/".$p->filename."') no-repeat 50% 50%;
		z-index: 100;
		height: 168px;
		}
		</style>";
		
		if (!empty($p->url)) echo "<a href=\"".$p->url."\" target=\"_blank\">";
		
		echo "<div id=\"green_alerts_banner\" style=\"color: #fff;\"></div>";
		/*<img src=\"".thisURL()."/wp-content/themes/charlotte_dancesport/green_alert_images/".$p->filename."\" alt=\"\" title=\"\" />*/
		
		if (!empty($p->url)) echo "</a>";
	}

	//$wpdb->show_errors();
	//$wpdb->print_error();
}

/**
 * Get current page Domain name
 *
 */
function thisURL() {
	$s = empty($_SERVER["HTTPS"]) ? "" : ($_SERVER["HTTPS"] == "on") ? "s" : "";
	$protocol = strleft(strtolower($_SERVER["SERVER_PROTOCOL"]), "/").$s;
	$port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]);
	return $protocol."://".ereg_replace("/(.+)", "", $_SERVER['SERVER_NAME'].$port.$_SERVER['REQUEST_URI']);
}

/**
 * Get current page URL
 *
 */
function CurrentPageURL() {
	$pageURL = $_SERVER['HTTPS'] == 'on' ? 'https://' : 'http://';
	$pageURL .= $_SERVER['SERVER_PORT'] != '80' ? $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"] : $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
	return $pageURL;
}

function strleft($s1, $s2) {
	$values = substr($s1, 0, strpos($s1, $s2));
	return  $values;
}
/* End get current URL */


/**
 * Load the top horizonal menubar.
 *
 *
 */
function get_menubar( $name = null ) {
 	do_action( 'get_menubar', $name );

	$templates = array();
	if ( isset($name) )
		$templates[] = "menubar-{$name}.php";

	$templates[] = "menubar.php";
	
	if ('' == locate_template($templates, true))
		load_template( get_theme_root() . '/default/menubar.php');
}

/**
 * Load social networking links.
 *
 */
function get_social_network_links() {
	echo '<!-- Social Networking -->
<script type="text/javascript">
	(function() {
		var s = document.createElement(\'SCRIPT\'), s1 = document.getElementsByTagName(\'SCRIPT\')[0];
		s.type = \'text/javascript\';
		s.src = \'http://widgets.digg.com/buttons.js\';
		s1.parentNode.insertBefore(s, s1);
	})();
</script>
<div id="social_network_group">
<a href="https://www.facebook.com/group.php?gid=2206779566&ref=ts" class="buttonfixed" title="Become a Fan on Facebook" style="top:42px;" target="_blank"><div class="face2">Facebook Button</div></a>
<a href="" class="buttonfixed" title="Subscribe to our YouTube Channel" style="top:72px;"><div class="you2">YouTube Button</div></a>
<a href="';
	bloginfo('rss2_url');
	echo '" class="buttonfixed" title="Syndicate this site using RSS" style="top:102px;"><div class="feed2">RSS Feed Button</div></a>
<a href="https://www.twitter.com/49erDanceSport" class="buttonfixed" title="Follow us on Twitter" style="top:132px;" target="_blank"><div class="twit2">Twitter Button</div></a>
<a href="http://digg.com/submit?url='.rawurlencode(thisURL());
	echo '" class="buttonfixed" title="Digg us" style="top:162px;"><div class="reddit2">Digg Button</div></a>
<a href="http://delicious.com/save?v=5&noui&jump=close&url='.rawurlencode(thisURL());
	echo '&title=';
	echo rawurlencode(bloginfo('name'));
	echo '" class="buttonfixed" title="Make us a Delicious bookmark" style="top:192px;" target="_blank"><div class="deli2">Delicious Button</div></a>
<a href="https://www.google.com/buzz/post?url='.rawurlencode(thisURL());
	echo '" class="buttonfixed" title="Share on Google Buzz" style="top:222px;" target="_blank"><div class="buzz2">Google Buzz Button</div></a>
</div>
<!-- End Social Networking -->
';
}

/**
 *isEmpty - Check if value/variable/property is empty 
 */
function isEmpty($value){
	return ($value === "" || $value === NULL);
}
?>