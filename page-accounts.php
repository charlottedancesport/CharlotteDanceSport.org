<?php
/**
 * @package WordPress
 * @subpackage Charlotte_DanceSport_Theme
 */
session_start();
session_register("club_member");

/**
 * Include Classes
 */
include('classes.php');

/* Visitors can not view the accounts page if they are not currently logged in */
if ( !is_user_logged_in() ) { header("Location: http://" . $_SERVER['HTTP_HOST']); }

/* For SSL sercurity for user account managment page */
if ( !isset($_SERVER['HTTPS']) ) { header( "Location: https://".$_SERVER['HTTP_HOST']."/accounts/" ); }

/* Get Wordpress current user */
if ( is_user_logged_in() ) { 
	global $current_user; 
	get_currentuserinfo();
}

/**
 * Create a cds_member object for the current user +
 * a session variables for sharing between pages
 */
$_SESSION['club_member'] = new cds_member($current_user->ID, $current_user->user_firstname, $current_user->user_lastname);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "<? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="<? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="<? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
<style type="text/css" media="all">@import url("<?php bloginfo('stylesheet_directory'); ?>/css/accounts.css");</style>
<!--[if gte IE 5]>
<style type="text/css">
.light_dimmer{
	background: transparent;
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#88000000,endColorstr=#88000000); /*AARRGGBB*/
	zoom: 1;
    z-index: 1000!important;
	}
</style>
<![endif]-->
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">google.load("jquery", "1.5.0");</script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/accounts.js"></script>
</head>

<body>

<div class="wrapper">
    
	<div id="content" class="narrowcolumn" role="main">
    
		<a href="<?php echo preg_replace('/:443/', '', preg_replace('/(ftp|http|https):\/\//i', "http://", thisURL()) ); ?>" class="notranslate"><span class="cds_logo" id="cds_logo"></span></a>
        
        <div class="cds_logo_text">
            <h1><a href="<?php echo preg_replace('/:443/', '', preg_replace('/(ftp|http|https):\/\//i', "http://", thisURL()) ); ?>" class="notranslate"><?php bloginfo('name'); ?></a></h1>
            <div class="description"><?php bloginfo('description'); ?></div>
        </div>        
    
    	<div class="a-g">Click on the parts of your profile you want to edit.</div>
    
        <div class="a-h">
        
            <div class="a-e"><span>Profile</span></div>
            
            <div class="post_author_gravatar_icon">
                <?php echo get_avatar( $_SESSION['club_member']->get_email_address(), '200' ); ?>
            </div>
         
            <div class="a-j"><p>We use Gravatars for profile photos. <a href="http://en.gravatar.com/site/signup/<?php echo urlencode($current_user->user_email); ?>" target="_blank">Setup your Gravatar today!</a></p></div>
        
        </div>
        
        <div class="a-m">
        
            <div class="a-e">
                <span id="full_name">
                <?php 
                    echo (!isEmpty( $_SESSION['club_member']->get_first_name() )) ? '<span id="first_name">'.$_SESSION['club_member']->get_first_name().'</span>' : '<span id="first_name" class="a-f">First</span>'; 
                    echo (!isEmpty( $_SESSION['club_member']->get_last_name() )) ? '<span id="last_name">'.$_SESSION['club_member']->get_last_name().'</span>' : '<span id="last_name" class="a-f">Last</span>'; 
                ?>
                </span>
            </div>
            
            <div class="a-d">
            
                <div class="a-a">
                    <h2 class="a-b">Introduction</h2>
                    <div class="a-c"><?php echo (!isEmpty( $_SESSION['club_member']->get_introduction() )) ? '<span id="introduction" class="a-c-a">'.$_SESSION['club_member']->get_introduction().'</span>' : '<span id="introduction">Give a brief intro of yourself and your dance background</span>';  ?></div>
                </div>
                <div class="a-a">
                    <h2 class="a-b">Member status</h2>
                    <div class="a-c">
					<?php 
					$level = $_SESSION['club_member']->get_dance_level();
					$is_officer = $_SESSION['club_member']->is_officer();
					$is_student = $_SESSION['club_member']->is_student();
					
					if($is_officer) $status .= $_SESSION['club_member']->get_officer_title() . ", ";
					if(!isEmpty($level)) $status .= $level . " Team Member, ";
					if($is_student) $status .= "Student";
					if(substr($status, -2) == ", ") { $status = substr($status, 0, -2); }
					
					if(!isEmpty( $status )) {
						echo '<span id="member_status" class="a-c-a">'.$status.'</span>';
					} else {
						echo '<span id="member_status">For example: Club Teasurer, Bronse Team member, non student, etc.</span>';
					}
					?></div>
                </div>
                <div class="a-a">
                    <h2 class="a-b">Dance level(s)</h2>
                    <div class="a-c">
					<?php 
					$levels = $_SESSION['club_member']->get_levels_competing_in();
					
					if(!isEmpty( $levels )) {
						echo '<span id="dance_level" class="a-c-a">' . str_replace("|",", ",$levels) . '</span>';
					} else { ?>
					<span id="dance_level">What level(s) do you currently compete at?</span>
					<?php } ?>
                    </div>
                </div>
                <div class="a-a">
                    <h2 class="a-b">Comps I've attended</h2>
                    
					<?php 
					$comps_attended = $_SESSION['club_member']->get_comps_attended();
					
					echo (!empty( $comps_attended )) ? '<div id="ca">'.$comps_attended.'</div>' : '<div id="ca" class="a-c"><span id="comps_attended">For example: CDC 2010, USA Dance Nationals 2009</span></div>';
					?>
                </div>
                <div class="a-a">
                    <h2 class="a-b">Email</h2>
                    <div class="a-c"><?php echo (!isEmpty( $_SESSION['club_member']->get_email_address() )) ? '<span id="email_address" class="a-c-a">'.$_SESSION['club_member']->get_email_address().'</span>' : '<span id="email_address">Enter your email address.</span>' ?></div>
                </div>
                <div class="a-a">
                    <h2 class="a-b">Facebook URL</h2>
                    <div class="a-c"><?php echo (!isEmpty( $_SESSION['club_member']->get_facebook_url() )) ? '<span id="facebook_url" class="a-c-a"><a href="'.((strpos($_SESSION['club_member']->get_facebook_url(), "://") === false) ? "http://".$_SESSION['club_member']->get_facebook_url() : $_SESSION['club_member']->get_facebook_url()).'" target="_blank">'.$_SESSION['club_member']->get_facebook_url().'</a></span>' : '<span id="facebook_url">Allow friends to connect with you via your Facebook profile page.</span>'; ?></div>
                </div>
                <div class="a-a">
                    <h2 class="a-b">Personal URL</h2>
                    <div class="a-c"><?php echo (!isEmpty( $_SESSION['club_member']->get_personal_url() )) ? '<span id="personal_url" class="a-c-a"><a href="'.((strpos($_SESSION['club_member']->get_personal_url(), "://") === false) ? "http://".$_SESSION['club_member']->get_personal_url() : $_SESSION['club_member']->get_personal_url()).'" target="_blank">'.$_SESSION['club_member']->get_personal_url().'</a></span>' : '<span id="personal_url">Have a personal portfolio website?</span>'; ?></div>
                </div>
        	</div>
        </div>
	</div>
    <div class="footer">
        <div id="credits">
            <p>&copy; 2010 <span class="notranslate">Charlotte DanceSport</span></p>
            <p>d/b/a/ 49er Social &amp; Ballroom Dance Club</p>
            <p><span class="notranslate">@ UNC-Charlotte</span></p>
            <p><a href="<?php bloginfo('stylesheet_directory'); ?>/privacy/" target="_blank">Privacy</a></p>
        </div>
    </div>
    
    <div class="light_dimmer hidden"></div>
    <div class="update_form hidden"></div>
</div>
</body>
</html>