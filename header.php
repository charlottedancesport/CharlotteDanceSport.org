<?php
/**
 * @package WordPress
 * @subpackage Charlotte_DanceSport_Theme
 */

/* gzip compress all requested pages to speed up site loading */ 
//if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start();

$iPhone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
$iPod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
$Android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");

if ($iPhone == true || $iPod == true || $Android == true)  {
	if( is_page('calendar') ) { header ( "Location: ".thisURL()."/m/cal/" );}
	if( is_page('coaches') ) { header ( "Location: ".thisURL()."/m/coach/" );}
	if( is_page('dances') ) { header ( "Location: ".thisURL()."/m/dance/" );}
	if( is_page('scrapbook') ) { header ( "Location: ".thisURL()."/m/scrap/" );} 
	if( is_page('competitions') ) { header ( "Location: ".thisURL()."/m/comps/" );}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "<? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="<? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="<? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<? // If Safari or IE 5/6 is being used do not gzip scripts or stylesheets
	$Safari = stripos($_SERVER['HTTP_USER_AGENT'],"Safari");
	$IE5 = stripos($_SERVER['HTTP_USER_AGENT'],"MSIE 5");
	$IE6 = stripos($_SERVER['HTTP_USER_AGENT'],"MSIE 6");
?>

<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/js/nivoslider/nivo-slider.css<? echo ($Safari || $IE5 || $IE6) ? "" : ".gz"; ?>" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/js/nivoslider/custom-nivo-slider.css<? echo ($Safari || $IE5 || $IE6) ? "" : ".gz"; ?>" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/stylesheet.css<? echo ($Safari || $IE5 || $IE6) ? "" : ".gz"; ?>" type="text/css" charset="utf-8" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/js/colorbox/colorbox.css<? echo ($Safari || $IE5 || $IE6) ? "" : ".gz"; ?>"  type="text/css" media="screen" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?><? //echo ($Safari || $IE5 || $IE6) ? "" : ".gz"; ?>" type="text/css" media="screen" />
<!--[if gte IE 5]>
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/js/colorbox/colorbox-IE.css<? echo ($Safari || $IE5 || $IE6) ? "" : ".gz"; ?>"  type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/style-IE.css<? //echo ($Safari || $IE5 || $IE6) ? "" : ".gz"; ?>" type="text/css" media="screen" />
<![endif]-->
<link rel="pingback" href="<?php echo str_replace("http:", "https:", get_bloginfo('pingback_url') ); ?>" />
<link rel="icon" type="image/png" href="<?php bloginfo('stylesheet_directory'); ?>/img/favicon.png" />

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
	google.load("jquery", "1.5.0");
</script>

<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/nivoslider/jquery.nivo.slider.pack.js<? echo ($Safari || $IE5 || $IE6) ? "" : ".gz"; ?>"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/Groject.ImageSwitch-min.js<? echo ($Safari || $IE5 || $IE6) ? "" : ".gz"; ?>"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.abetterform-min.js<? echo ($Safari || $IE5 || $IE6) ? "" : ".gz"; ?>"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.autofill-min.js<? echo ($Safari || $IE5 || $IE6) ? "" : ".gz"; ?>"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/colorbox/jquery.colorbox-min.js<? echo ($Safari || $IE5 || $IE6) ? "" : ".gz"; ?>"></script>
<? if( is_page('cdc') ) { ?>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.scrollTo-1.4.2-min.js<? echo ($Safari || $IE5 || $IE6) ? "" : ".gz"; ?>"></script>
<? } ?>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.tools.min.js<? echo ($Safari || $IE5 || $IE6) ? "" : ".gz"; ?>"></script>
<script type="text/javascript">
function ajax_update_alert(color,description)
{
	var httpxml;
	try
	{
		// Firefox, Opera 8.0+, Safari
		httpxml=new XMLHttpRequest();
	}
	catch (e)
	{
		// Internet Explorer
		try
		{
			httpxml=new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch (e)
		{
			try
			{
				httpxml=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e)
			{
				alert("Your browser does not support AJAX!");
				return false;
			}
		}
	}
	function stateck() 
	{
	/* 
	 * When the property readyState is 4 that means the 
	 * response is complete and we can get our data.
	 */
		if(httpxml.readyState==4)
		{
		}
	}
	
	var url="<?php bloginfo('url'); ?>/edit_tools/ajax-update-alert/";
	url=url+"?color="+color+"&description="+description;
	url=url+"&sid="+Math.random();
	httpxml.onreadystatechange=stateck;
	httpxml.open("GET",url,true);
	httpxml.send(null);
}
</script>
<!--script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/functions.js<? //echo ($Safari || $IE5 || $IE6) ? "" : ".gz"; ?>"></script-->
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/functions-min.js<? echo ($Safari || $IE5 || $IE6) ? "" : ".gz"; ?>"></script>

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

<?php wp_head(); ?>

<script type="text/javascript">
/**
 * Google Analytics script for tracking website statistics
 */
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-18982230-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
/**
 * End Google Analytics
 */

/**
 * Get a random dance tip and update on webpage
 *
 * @param none
 */
function get_random_dance_tip()
{
	var httpxml;
	try
	{
		// Firefox, Opera 8.0+, Safari
		httpxml=new XMLHttpRequest();
	}
	catch (e)
	{
		// Internet Explorer
		try
		{
			httpxml=new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch (e)
		{
			try
			{
				httpxml=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e)
			{
				alert("Your browser does not support AJAX!");
				return false;
			}
		}
	}
	function stateck() 
	{
	/* 
	 * When the property readyState is 4 that means the 
	 * response is complete and we can get our data.
	 */
		if(httpxml.readyState==4)
		{
			document.getElementById('dance_tip_text').innerHTML = httpxml.responseText;
		}
	}
	
	var url="<?php bloginfo('url'); ?>/get-dance-tip/";
	httpxml.onreadystatechange=stateck;
	httpxml.open("GET",url,true);
	httpxml.send(null);
}

$(document).ready(function(){
	$('#cdsc_next_tip').click( function() {
		$.ajax({
			url:'/get-cdsc-news-feed/',
			type:"POST",
			dataType:"html",
			statusCode: {
				404: function(){
				}
			},
			success: function(responseText){
				$('#dance_tip_text').text(responseText);
			},
			error: function(){
				alert('error');
			},
			complete: function(){
				
			}
		})
	});
	
	$('#next_tip').click( function () {
		get_random_dance_tip();
	});
});
/**
 * End get random dance tip
 */

<?php if( is_user_logged_in() && $_GET['p']=='true') {?>
/**
 * Display popup to force users logging to for the first time 
 * to change their default password.
 *
 * @param none
 */
$(function(){
	$.colorbox({
		width:425, 
		height:520, 
		scrolling:false, 
		title:"Change Default Password", 
		href:"<?php echo thisURL(); ?>/wp-login.php?action=lostpassword",
		iframe:true,
		onClosed:function(){
		  window.top.location.href="<?php echo thisURL(); ?>/accounts/";
		}
	});
});
/**
 * End default password change
 */
<?php } ?>
</script>

</head>
<body <?php body_class(); ?>>
<div id="top_nav_extension" class="top_nav_ext_absolute"></div>
<div id="green_alerts_banner_extension"></div>
<div id="dance_tips_extension"></div>
<?php if ( is_user_logged_in() ) { ?>
<?php
	$query = "SELECT * FROM cds_alerts WHERE color = 'red' AND archived = 0";
	$select = mysql_query($query) or die("Select from cds_alerts for red alerts failed.");
	$red_alert_on = false;
	
	if ( mysql_num_rows($select) > 0 ) {
		$red_alert_on = true;
		$alert = mysql_fetch_array($select, MYSQL_ASSOC);
	}
 ?>

<div id="red_alerts_banner">
	<input type="text" class="alert_edit_field" style="color:<? echo ($red_alert_on) ? '#000' : '#777'; ?>;" value="<? echo ($red_alert_on) ? $alert['description'] : 'No red alert message currently - Click here to edit (e.g. Thurs Dance Lessons Canceled)'; ?>" name="red_alert" id="red_alert_input" />
  
</div>

<?php 
	
	$query = "SELECT * FROM cds_alerts WHERE color = 'yellow' AND archived = 0";
	$select = mysql_query($query) or die("Select from cds_alerts for yellow alerts failed.");
	$yellow_alert_on = false;
	
	if ( mysql_num_rows($select) > 0 ) {
		$yellow_alert_on = true;
		$alert = mysql_fetch_array($select, MYSQL_ASSOC);
	}
?>

<div id="yellow_alerts_banner" style="bottom:24px;">
	<input type="text" class="alert_edit_field" style="color:<? echo ($yellow_alert_on) ? '#000' : '#AAA'; ?>;" value="<? echo ($yellow_alert_on) ? $alert['description'] : 'No yellow alert message currently - Click here to edit (e.g. CDC 2011 - Competition registration is now open!)'; ?>" name="yellow_alert" id="yellow_alert_input" />
  
</div>

<?php } else { ?>

<?php
	$query = "SELECT * FROM cds_alerts WHERE color = 'red' AND archived = 0";
	$select = mysql_query($query) or die("Select from cds_alerts for red alerts failed.");
	$red_alert_on = false;
	
	if ( mysql_num_rows($select) > 0 ) {
		$red_alert_on = true;
		$alert = mysql_fetch_array($select, MYSQL_ASSOC);
 ?>
<div id="red_alerts_banner" style="color: #000;"><span><? echo $alert['description']; ?></span></div>
<?php 
	}
	
	$query = "SELECT * FROM cds_alerts WHERE color = 'yellow' AND archived = 0";
	$select = mysql_query($query) or die("Select from cds_alerts for yellow alerts failed.");
	
	if ( mysql_num_rows($select) > 0 ) {
		$alert = mysql_fetch_array($select, MYSQL_ASSOC);
?>
<div id="yellow_alerts_banner" style="color: #000; bottom:<? echo ($red_alert_on) ? '24px' : 0; ?>;"><span><? echo $alert['description']; ?></span></div>
<?php } ?>

<? } ?>

<div id="wrapper">

<div id="auto_save" class="yellow_alerts"></div>

<div id="loginbar">
<ul>
	<li>
    	
	<?php if ( is_user_logged_in() ) { 
	global $current_user; 
	get_currentuserinfo();
			
	$query = "SELECT * FROM cds_member WHERE user_id={$current_user->ID}";
	$select = mysql_query($query) or die("Select from cds_member failed.");
	$user = mysql_fetch_array($select, MYSQL_ASSOC);
	}
	?>
		<!--<a>English <small>▼</small></a>-->
    <script type="text/javascript">
        function createDropDown(){

            var source = $("#gtranslate_select");

            var selected = source.find("option[selected=selected]");

            var options = $("option", source);

            

            //$("body").append('<dl id="target" class="dropdown"></dl>')
			
            $("#gtranslate_list").append('<dt><a href="#" style="text-align:center;" class="notranslate">' + selected.text() + 

                '<span class="value notranslate">' + selected.val() + 

                '</span></a></dt>');

            $("#gtranslate_list").append('<dd><ul></ul></dd>');



            options.each(function(){
			//alert('value'+$("#gtranslate_list dd ul").text().search("Select")//);
				if( $("#gtranslate_list dd ul").text().search("Select") !== -1 ) {
					$("#gtranslate_list dd ul").append('<li style="float: left;padding: 0px;margin: 0px;min-width:164px;"><a href="#" class="notranslate" style="text-align:left;"><img class="flag" src="<?php bloginfo('stylesheet_directory'); ?>/img/' + 
					$(this).val().substring(3,5) + '.png" alt="" width="16"/>' + $(this).text() +
					'<span class="value notranslate">' + $(this).val() + '</span></a></li>'); 
				} else {
					$("#gtranslate_list dd ul").append('<li style="float: left;padding: 0px;margin: 0px;min-width:164px;"><a href="#" class="notranslate" style="text-align:left;">' +
					 $(this).text() +
					'<span class="value notranslate">' + $(this).val() + '</span></a></li>');
				}
            });

        }
		
        $(document).ready(function() {

            createDropDown();

            

            $(".dropdown dt a").click(function() {

                $(".dropdown dd ul").toggle();

            });



            $(document).bind('click', function(e) {

                var $clicked = $(e.target);

                if (! $clicked.parents().hasClass("dropdown")) {

                    $(".dropdown dd ul").hide();
					
				}

            });

                        

            $(".dropdown dd ul li a").click(function() {

                var text = $(this).html();

                $(".dropdown dt a").html(text).css("width","");

                $(".dropdown dd ul").hide();

                

                var source = $("#gtranslate_select");

                source.val($(this).find("span.value").html());
				
				source.change();

            });

        });
    </script>

        <!-- GTranslate: http://edo.webmaster.am/gtranslate -->
        <span class="notranslate">
        <select onchange="doGTranslate(this);" class="gtranslate_select" id="gtranslate_select">
            <option value="" selected="selected">Select Language</option>
            <option value="en|sq">Albanian</option>
            <option value="en|ar">Arabic</option>
            <option value="en|be">Belarusian</option>
            <option value="en|zh-CN">Chinese (Simplified)</option>
            <option value="en|zh-TW">Chinese (Traditional)</option>
            <option value="en|cs">Czech</option>
            <option value="en|nl">Dutch</option>
            <option value="en|en">English</option>
            <option value="en|tl">Filipino</option>
            <option value="en|fr">French</option>
            <option value="en|ka">Georgian</option>
            <option value="en|de">German</option>
            <option value="en|iw">Hebrew</option>
            <option value="en|hi">Hindi</option>
            <option value="en|it">Italian</option>
            <option value="en|ja">Japanese</option>
            <option value="en|ko">Korean</option>
            <option value="en|lt">Lithuanian</option>
            <option value="en|ru">Russian</option>
            <option value="en|sr">Serbian</option>
            <option value="en|sk">Slovak</option>
            <option value="en|sl">Slovenian</option>
            <option value="en|es">Spanish</option>
            <option value="en|sv">Swedish</option>
            <option value="en|th">Thai</option>
            <option value="en|tr">Turkish</option>
            <option value="en|uk">Ukrainian</option>
            <option value="en|vi">Vietnamese</option>
        </select>
        </span>
        <script type="text/javascript" src="<?php echo thisURL(); ?>/wp-content/plugins/gtranslate/jquery-translate.js<? echo ($Safari || $IE5 || $IE6) ? "" : ".gz"; ?>"></script>
        <script type="text/javascript">
        /**
         * Google Translate Selection scripts
         */
        //<![CDATA[
        jQuery.noConflict();
        if(jQuery.cookie('glang') && jQuery.cookie('glang') != 'en') jQuery(function($){$('body').translate('en', $.cookie('glang'), {toggle:true, not:'.notranslate'});});
        function doGTranslate(lang_pair) {if(lang_pair.value)lang_pair=lang_pair.value;var lang=lang_pair.split('|')[1];jQuery.cookie('glang', lang, {path: '/'});jQuery(function($){$('body').translate('en', lang, {toggle:true, not:'.notranslate'});});}
        //]]>
        </script>
        
		<? if ( is_user_logged_in() ) { ?>
        
        <div id="name_dropdown" class="name_dropdown">
		  <dt class="name_dropdown_dt"><?php echo $current_user->user_firstname." ".$current_user->user_lastname; ?></dt>
          <dd>
          	<ul>
              <!--li class="user_email"><b><?php echo $current_user->user_email; ?></b></li-->
              <li><a href="<?php echo "https://" . $_SERVER['HTTP_HOST'] . "/accounts/"; ?>">Edit Profile</a></li>
              <li><a class="wp_dashboard" href="<?php echo "https://" . $_SERVER['HTTP_HOST'] . "/wp-admin/"; ?>">CDS Dashboard</a></li>
              <li><?php wp_loginout(thisURL()); ?></li>
            </ul>
          </dd>
        </div>
        <div style="float:right; margin-top: 2px;" class="hidden"><?php wp_loginout(thisURL()); ?></div>
        <div style="float: right; margin-top: 2px;" class="hidden"><a class="wp_dashboard" href="<?php echo "https://" . $_SERVER['HTTP_HOST'] . "/wp-admin/"; ?>">CDS Dashboard</a></div>
        
        <? } else if(!is_page('cdc')) { ?>
        
        <div style="float:right; margin-top: 2px;"><a class="ajaxlogin cboxElement" href="<?php echo "https://" . $_SERVER['HTTP_HOST'] . "/cds-login/"; ?>">Log in</a><!--a class="left_divider" href="https://www.charlottedancesport.org/wp-admin">Login</a--></div>
        
        <? } ?>
        
        <div id="gtranslate_list" class="dropdown"></div>
        
    </li>
    <!--li style="float:right; width:1024px;">
    	<div class="logged_in_username"><b><?php //echo $current_user->user_email; ?></b></div>
    </li-->

    	<!--<div id="google_translate_element"></div>-->

    	<!--<a class="left_divider" href="<?php //echo thisURL(); ?>/wp-login.php?action=register">Register</a>-->
    	<!--<a class="ajaxlogin cboxElement" href="#">Login</a>-->
 
</ul>
</div>


<div id="header">
<?php if ( $user['is_admin'] ) { ?>

	<div id="headerimg">
    	<div class="floating_edit_button" style="margin-top:50px;"><input type="button" value="Edit" name="Edit" class="banner_image_editor" /></div>
        
    	<div id="headerSlide">
        
		<?php get_banner_images();?>
        
        </div>
    	<span class="<? echo ( is_page('cdc') ) ? "cdc_logo" : "cds_logo"; ?>" id="cds_logo"></span>
        <div class="cds_logo_text" <? if( is_page('cdc') ) echo 'style="width:650px; font-size:.9em; margin:10px 0 0 135px;"'; ?>>
			<!--<div class="floating_edit_button" style=" position:absolute; top:55px; left: 400px;"><input type="button" value="Edit" name="Edit" class="logo_text_editor" /></div>-->
            <h1><a href="<?php echo thisURL(); ?>/<? if( is_page('cdc') ) {echo "cdc/";} ?>" class="notranslate"><?php bloginfo('name'); if( is_page('cdc') ) {echo " Challenge 2011";} ?></a></h1>
            <? if( !is_page('cdc') ) { ?><div class="description"><?php bloginfo('description'); ?></div><? } ?>
        </div>            
	</div>
				
<?php } else { ?>

	<div id="headerimg">
    	<div id="headerSlide">
        
        <?php get_banner_images();?>
        
        </div>
    	<a href="<?php echo thisURL(); ?>/<? if( is_page('cdc') ) {echo "cdc/";} ?>" title="Charlotte DanceSport"><span class="<? echo ( is_page('cdc') ) ? "cdc_logo" : "cds_logo"; ?>"></span></a>
         <div class="cds_logo_text" <? if( is_page('cdc') ) echo 'style="width:650px; font-size:.9em; margin:10px 0 0 135px;"'; ?>>
            <h1><a href="<?php echo thisURL(); ?>/<? if( is_page('cdc') ) {echo "cdc/";} ?>" class="notranslate"><?php bloginfo('name'); if( is_page('cdc') ) {echo " Challenge 2011";} ?></a></h1>
            <? if( !is_page('cdc') ) { ?><div class="description"><?php bloginfo('description'); ?></div><? } ?>
        </div>            
	</div>

<?php } ?>

</div>

<?php //get_menubar(); ?>
<div id="top_navigation_wrapper" class="top_nav_absolute">
    <div <?php if ( is_page('cdc') ) echo 'style="width:850px;"'; ?> id="top_navigation">
    
    <?php if ( is_page('cdc') ) { ?>
        
        <ul>
        <li id="cds_nav"><a href="<?php echo thisURL(); ?>/" title="CDS Home">CDS</a><div class="hidden"><small>▲</small></div></li> 
        <li id="schedule_nav"><a href="<?php echo thisURL(); ?>/cdc/?p=concise" title="Schedule">Schedule</a><div class="hidden"><small>▲</small></div></li> 
        <li id="registration_nav"><a href="http://www.o2cm.com/forms/entry.asp?event=chd" title="Registration" target="_blank">Registration</a><div class="hidden"><small>▲</small></div></li>
        <li id="officials_nav"><a href="<?php echo thisURL(); ?>/cdc/?p=officials" title="Officials">Officials</a><div class="hidden"><small>▲</small></div></li>
        <li id="rules_nav"><a href="<?php echo thisURL(); ?>/cdc/?p=rules_fees" title="Fees & Rules">Fees &amp; Rules</a><div class="hidden"><small>▲</small></div></li>
        <li id="housing_nav"><a href="<?php echo thisURL(); ?>/cdc/?p=housing" title="Housing">Housing</a><div class="hidden"><small>▲</small></div></li>
        <li id="sponsors_nav"><a href="<?php echo thisURL(); ?>/cdc/?p=sponsors" title="Sponsors">Sponsors</a><div class="hidden"><small>▲</small></div></li>
        <li id="location_nav"><a href="<?php echo thisURL(); ?>/cdc/?p=dance_locations" title="Dance Locations">Location</a><div class="hidden"><small>▲</small></div></li>
        <li id="cdc_nav"><a href="<?php echo thisURL(); ?>/cdc/" title="Charlotte DanceSport Challenge">CDC 2011</a><div class="hidden"><small>▲</small></div></li> 
        </ul>
        
    <?php } else { ?>
    
		<?php /* if ( $user['is_admin'] ) { ?>
		<div class="floating_edit_button" style="margin-right:32px;"><input type="button" value="Edit" name="Edit" class="top_nav_editor" /></div>
		<?php } */ ?>
    	<!--<a href="<?php //echo thisURL(); ?>" title="CDS Home"><div id="top_nav_home_icon"></div></a>-->
        <ul>
        <li <?php if ( !(is_home() /*|| is_single() || is_search() || is_archive() */) ) { echo 'id="cds_nav"'; ?>><a href="<?php echo thisURL(); ?>/" title="CDS Home">CDS</a><?php } else { ?>>CDS<?php } ?><div <?php echo ( is_home() || is_single() || is_search() || is_archive() ) ? 'class="page_arrow"' : 'class="hidden"'; ?>><small>▲</small></div></li> 
        <li <?php if ( !is_page('calendar') ) { echo 'id="calendar_nav"'; ?>><a href="<?php echo thisURL(); ?>/calendar/" title="Calendar">Calendar</a><?php } else { ?>>Calendar<?php } ?><div <?php echo ( is_page('calendar') ) ? 'class="page_arrow"' : 'class="hidden"'; ?>><small>▲</small></div></li> 
        <li <?php if ( !is_page('coaches') ) { echo 'id="coaches_nav"'; ?>><a href="<?php echo thisURL(); ?>/coaches/" title="Coaches">Coaches</a><?php } else { ?>>Coaches<?php } ?><div <?php echo ( is_page('coaches') ) ? 'class="page_arrow"' : 'class="hidden"'; ?>><small>▲</small></div></li>
        <li <?php if ( !is_page('dances') ) { echo 'id="dances_nav"'; ?>><a href="<?php echo thisURL(); ?>/dances/" title="Dances Taught">Dances Taught</a><?php } else { ?>>Dances Taught<?php } ?><div <?php echo ( is_page('dances') ) ? 'class="page_arrow"' : 'class="hidden"'; ?>><small>▲</small></div></li>
        <li <?php if ( !is_page('cdc') ) { echo 'id="cdc_nav"'; ?>><a href="<?php echo thisURL(); ?>/cdc/" title="Charlotte DanceSport Challenge">CDC 2011</a><?php } else { ?>>CDC 2011<?php } ?><div <?php echo ( is_page('cdc') ) ? 'class="page_arrow"' : 'class="hidden"'; ?>><small>▲</small></div></li> 
<?php /* Commented out for Initial launch.  Will add in future as NEW! features */

if ( $user['is_admin'] ) { ?>
        <li <?php if ( !is_page('scrapbook') ) { echo 'id="scrapbook_nav"'; ?>><a href="<?php echo thisURL(); ?>/scrapbook/" title="Scrapbook">Scrapbook</a><?php } else { ?>>Scrapbook<?php } ?><div <?php echo ( is_page('scrapbook') ) ? 'class="page_arrow"' : 'class="hidden"'; ?>><small>▲</small></div></li>
        <li <?php if ( !is_page('competitions') ) { echo 'id="competitions_nav"'; ?>><a href="<?php echo thisURL(); ?>/competitions/" title="Competitions">Competitions</a><?php } else { ?>>Competitions<?php } ?><div <?php echo ( is_page('competitions') ) ? 'class="page_arrow"' : 'class="hidden"'; ?>><small>▲</small></div></li>
<? } ?>
        </ul>
        
    <?php } ?>
    </div>
</div>

<?php if ( is_page('cdc') ) : 
/**
 * CDC News Feed Bar
 */
?>

<div id="dance_tips_extension_1024">
	<div id="dance_tips">
    	<span id="dance_tip_text"><?php get_cdsc_news_feed(); ?></span>
    	<ul>
          <li id="cdsc_previous_tip"><a></a></li>
          <li id="cdsc_next_tip"><a></a></li>
        </ul>
        
    <?php if ( $user['is_admin'] || $current_user->ID == 6 || $current_user->ID == 5 || $current_user->ID == 3 ) { ?>
		<div class="floating_edit_button"><input type="button" value="Edit" name="Edit" class="cdsc_news_feed_editor" /></div>
	<?php } ?>
    
    </div>
    
</div>

<?php else :
/**
 *  Dance Tips Bar
 */
?>
<div id="dance_tips_extension_1024">
	<div id="dance_tips">
    	<a class="suggest_a_tip_txt cboxElement" href="<? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://www.charlottedancesport.org/wp-content/themes/charlotte_dancesport/send_tip.php">Suggest a tip.</a>
    	<span id="dance_tip_text"><?php get_dance_tip(); ?></span>
    	<ul>
          <li id="previous_tip"><a></a></li>
          <li id="next_tip"><a></a></li>
        </ul>
        
    <?php if ( $user['is_admin'] ) { ?>
		<div class="floating_edit_button"><input type="button" value="Edit" name="Edit" class="dance_tips_editor" /></div>
	<?php } ?>
    
    </div>
    
</div>

<? endif; // End Tip/News Feed Bars ?>

<?php if ( is_page('dances') ) : ?>

<div id="green_alerts_banner_extension_1024">
    
    <div id="dances_banner">
		<?php /*if ( $user['is_admin'] ) { ?>
		<div class="floating_edit_button" style="margin-right:32px;"><input type="button" value="Edit" name="Edit" /></div>
		<?php }*/ ?>
        <div id="dance_banner_placeholder"></div>
        <div class="separator"></div>
        
        <div class="list_container">
        <label for="standard_list">Standard</label>
        <ul class="standard_list">
        	<li><span style="display:none;" class="notranslate">Waltz_(International_Standard)</span>Waltz</li>
            <li><span style="display:none;" class="notranslate">Ballroom_tango</span>Tango</li>
            <li><span style="display:none;" class="notranslate">Foxtrot</span>Foxtrot</li>
            <li><span style="display:none;" class="notranslate">Quickstep</span>Quickstep</li>
            <li><span style="display:none;" class="notranslate">Viennese_Waltz</span>Viennese Waltz</li>
        </ul>
        </div>
        
        <div class="separator"></div>
        
        <div class="list_container">
        <label for="latin_list">Latin</label>
        <ul class="latin_list">
        	<li><span style="display:none;" class="notranslate">Samba_(ballroom_dance)</span>Samba</li>
            <li><span style="display:none;" class="notranslate">Rumba_(dance)</span>Rumba</li>
            <li><span style="display:none;" class="notranslate">Cha-cha-cha_(dance)</span>Cha Cha</li>
            <li><span style="display:none;" class="notranslate">Jive_(dance)</span>Jive</li>
            <li><span style="display:none;" class="notranslate">Pasodoble</span>Paso Doble</li>
        </ul>
        </div>
        
        <div class="separator"></div>
        
        <div class="list_container">
        <label for="fun_list">Fun</label>
        <ul class="fun_list">
        	<li><span style="display:none;" class="notranslate">Bolero</span>Bolero</li>
            <li><span style="display:none;" class="notranslate">Mambo_(dance)</span>Mambo</li>
            <li><span style="display:none;" class="notranslate">Merengue_(dance)</span>Merengue</li>
            <li><span style="display:none;" class="notranslate">Salsa_(dance)</span>Salsa</li>
            <li><span style="display:none;" class="notranslate">Swing_(dance)</span>Swing</li>
        </ul>
        </div>
        
    </div>

</div>

<?php else : ?>

<div id="green_alerts_banner_extension_1024">
    <!-- <a href="<? //echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://www.dance.zsconcepts.com/results/results_list.cgi" target="_blank"> -->
	<?php if ( $user['is_admin'] ) { ?>
	<div class="floating_edit_button" style="margin-right:32px;"><input type="button" value="Edit" name="Edit" class="green_alerts_editor" /></div>
	<?php } ?>	
    
    <? get_green_alert_image(); 
 /*   <a href="<? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://www.dance.zsconcepts.com/results/results_list.cgi" target="_blank">
    <div id="green_alerts_banner" style="color: #fff;"></div>
    </a>*/ ?>
</div>

<?php endif; ?>

<!--div style="display:none;">
	<div id="lightboxLogin">
    	<div id="login_container">
    	<h1><a href="<?php //echo thisURL(); ?>" title="Charlotte DanceSport Log In">Charlotte DanceSport</a></h1>
		<?php //login_with_ajax(); ?>
        </div>
    </div>
</div-->