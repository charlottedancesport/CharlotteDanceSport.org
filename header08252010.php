<?php
/**
 * @package WordPress
 * @subpackage Charlotte_DanceSport_Theme
 */
 

$iPhone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
$iPod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
$Android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");

if ($iPhone == true || $iPod == true || $Android == true)  {
	if( is_page('calendar') ) { header ( "Location: http://".$_SERVER['HTTP_HOST']."/m/cal/" );}
	if( is_page('coaches') ) { header ( "Location: http://".$_SERVER['HTTP_HOST']."/m/coach/" );}
	if( is_page('dances') ) { header ( "Location: http://".$_SERVER['HTTP_HOST']."/m/dance/" );}
	if( is_page('scrapbook') ) { header ( "Location: http://".$_SERVER['HTTP_HOST']."/m/scrap/" );} 
	if( is_page('competitions') ) { header ( "Location: http://".$_SERVER['HTTP_HOST']."/m/comps/" );}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/js/fileuploader/fileuploader.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/js/nivoslider/nivo-slider.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/js/nivoslider/custom-nivo-slider.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/stylesheet.css" type="text/css" charset="utf-8" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/js/colorbox/colorbox.css"  type="text/css" media="screen" />
<!--[if gte IE 5]>
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/js/colorbox/colorbox-IE.css"  type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/style-IE.css" type="text/css" media="screen" />
    
<![endif]-->
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="icon" type="image/png" href="<?php bloginfo('stylesheet_directory'); ?>/img/favicon.png" />

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
	google.load("jquery", "1.4.2");
</script>

<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/fileuploader/fileuploader-min.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/nivoslider/jquery.nivo.slider.pack.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/Groject.ImageSwitch-min.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.abetterform-min.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.autofill-min.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/colorbox/jquery.colorbox-min.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.tools.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/functions.js"></script>
<script src="http://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

<?php wp_head(); ?>


</head>
<body <?php body_class(); ?>>
<div id="top_nav_extension" class="top_nav_ext_absolute"></div>
<div id="green_alerts_banner_extension"></div>
<div id="wrapper">
<div id="yellow_alerts_banner" style="display:none;"><p>Yellow Alerts Display Block</p></div>
<div id="red_alerts_banner" style="display:none;"><p>Red Alerts Display Block</p></div>

<div id="loginbar">
<ul>
	<li>
    	
	<?php if ( is_user_logged_in() ) { 
	global $current_user; 
	get_currentuserinfo();
			
	$query = "SELECT * FROM cds_member WHERE user_id={$current_user->ID}";
	$select = mysql_query($query) or die("Select from cds_member failed.");
	$user = mysql_fetch_array($select, MYSQL_ASSOC);
	?>
		<a>English <small>▼</small></a>
    	<?php //if ( $user['is_admin'] ) { ?>
    	<a class="wp_dashboard left_divider" href="<?php echo "https://" . $_SERVER['HTTP_HOST'] . "/wp-admin/"; ?>">CDS Dashboard</a>
        <?php // } ?>
		<?php wp_loginout(thisURL()); ?>
        <div class="logged_in_username"><b><?php echo $current_user->user_email; ?></b></div>
    </li>
    <?php } else { /*?>
    	<!--<div id="google_translate_element"></div>-->

    	<a class="left_divider" href="<?php thisURL(); ?>/wp-login.php?action=register">Register</a>
    	<a class="ajaxlogin cboxElement" href="#">Login</a>
    </li>
    <?php */} ?>
</ul>
</div>


<div id="header">
<?php if ( $user['is_admin'] ) { ?>
	
	<div id="banner_img_uploader">		
		<noscript>			
			<p>Please enable JavaScript to use file uploader.</p>
			<!-- or put a simple form for upload here -->
		</noscript>         
	</div>
    
    <script>        
        function createUploader(){            
            var uploader = new qq.FileUploader({
                element: document.getElementById('banner_img_uploader'),
                action: './php.php',
				allowedExtensions: ['jpg', 'jpeg', 'png', 'gif'],
				sizeLimit: 0
            });           
        }
        
        // in your app create uploader as soon as the DOM is ready
        // don't wait for the window to load  
        window.onload = createUploader;     
    </script>    
<!--	<div id="preview"></div>
    <div id="banner_img_uploader">
    	<form id="img_uploader" name="img_uploader">
        <input type="file" id="image_selected" multiple="true" onchange="select_banner_image(this.files)" />
        </form>
        
        <form id="upload_img" name="upload_img">
        <input type="button" value="Upload" onclick="sendFiles()" />
        </form>
    </div> -->
				
<?php } else { ?>

	<div id="headerimg">
    	<div id="headerSlide">
        
        <?php get_banner_images("wp-content/themes/charlotte_dancesport/banner_images");?>
        
        </div>
    	<a href="<?php echo get_option('home'); ?>/" title="Charlotte DanceSport"><span class="cds_logo"></span></a>
        <div class="cds_logo_text">
            <h1><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a></h1>
            <div class="description"><?php bloginfo('description'); ?></div>
        </div>            
	</div>

<?php } ?>

</div>

<?php //get_menubar(); ?>
<div id="top_navigation_wrapper" class="top_nav_absolute">
    <div id="top_navigation">
    	<!--<a href="<?php //thisURL(); ?>" title="CDS Home"><div id="top_nav_home_icon"></div></a>-->
        <ul>
        <li <?php if ( !(is_home() || is_single() || is_search() || is_archive()) ) { echo 'id="cds_nav"'; ?>><a href="<?php thisURL(); ?>/" title="CDS Home">CDS</a><?php } else { ?>>CDS<?php } ?><div <?php echo ( is_home() || is_single() || is_search() || is_archive() ) ? 'class="page_arrow"' : 'class="hidden"'; ?>><small>▲</small></div></li> 
        <li <?php if ( !is_page('calendar') ) { echo 'id="calendar_nav"'; ?>><a href="<?php thisURL(); ?>/calendar/" title="Calendar">Calendar</a><?php } else { ?>>Calendar<?php } ?><div <?php echo ( is_page('calendar') ) ? 'class="page_arrow"' : 'class="hidden"'; ?>><small>▲</small></div></li> 
        <li <?php if ( !is_page('coaches') ) { echo 'id="coaches_nav"'; ?>><a href="<?php thisURL(); ?>/coaches/" title="Coaches">Coaches</a><?php } else { ?>>Coaches<?php } ?><div <?php echo ( is_page('coaches') ) ? 'class="page_arrow"' : 'class="hidden"'; ?>><small>▲</small></div></li>
        <li <?php if ( !is_page('dances') ) { echo 'id="dances_nav"'; ?>><a href="<?php thisURL(); ?>/dances/" title="Dances Taught">Dances Taught</a><?php } else { ?>>Dances Taught<?php } ?><div <?php echo ( is_page('dances') ) ? 'class="page_arrow"' : 'class="hidden"'; ?>><small>▲</small></div></li>
        <li <?php if ( !is_page('scrapbook') ) { echo 'id="scrapbook_nav"'; ?>><a href="<?php thisURL(); ?>/scrapbook/" title="Scrapbook">Scrapbook</a><?php } else { ?>>Scrapbook<?php } ?><div <?php echo ( is_page('scrapbook') ) ? 'class="page_arrow"' : 'class="hidden"'; ?>><small>▲</small></div></li>
        <li <?php if ( !is_page('competitions') ) { echo 'id="competitions_nav"'; ?>><a href="<?php thisURL(); ?>/competitions/" title="Competitions">Competitions</a><?php } else { ?>>Competitions<?php } ?><div <?php echo ( is_page('competitions') ) ? 'class="page_arrow"' : 'class="hidden"'; ?>><small>▲</small></div></li>  
        </ul>
    </div>
</div>

<?php if ( is_page('dances') ) : ?>

<div id="green_alerts_banner_extension_1024">
    
    <div id="dances_banner">
        <div id="dance_banner_placeholder"></div>
        <div class="separator"></div>
        
        <div class="list_container">
        <label for="standard_list">Standard</label>
        <ul class="standard_list">
        	<li>Waltz</li>
            <li>Tango</li>
            <li>Foxtrot</li>
            <li>Quickstep</li>
            <li>Viennese Waltz</li>
        </ul>
        </div>
        
        <div class="separator"></div>
        
        <div class="list_container">
        <label for="latin_list">Latin</label>
        <ul class="latin_list">
        	<li>Samba</li>
            <li>Rumba</li>
            <li>Cha Cha</li>
            <li>Jive</li>
            <li>Paso Doble</li>
        </ul>
        </div>
        
        <div class="separator"></div>
        
        <div class="list_container">
        <label for="fun_list">Fun</label>
        <ul class="fun_list">
        	<li>Bolero</li>
            <li>Mambo</li>
            <li>Merengue</li>
            <li>Salsa</li>
            <li>Swing</li>
        </ul>
        </div>
        
    </div>

</div>

<?php else : ?>

<div id="green_alerts_banner_extension_1024">
    <a href="http://www.dance.zsconcepts.com/results/results_list.cgi" target="_blank">
    <div id="green_alerts_banner" style="display:; color: #fff;"></div>
    </a>
</div>

<?php endif; ?>

<div style="display:none;">
	<div id="lightboxLogin">
    	<div id="login_container">
    	<h1><a href="<?php thisURL(); ?>" title="Charlotte DanceSport Log In">Charlotte DanceSport</a></h1>
		<?php login_with_ajax(); ?>
        </div>
    </div>
</div>