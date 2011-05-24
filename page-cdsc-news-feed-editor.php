<?php
/**
 * @package WordPress
 * @subpackage Charlotte_DanceSport_Theme
 */
 
if ( !is_user_logged_in() ) header("Location: http://www.charlottedancesportchallenge.org");

global $current_user; 
get_currentuserinfo();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "<? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="<? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="<? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="robots" content="noindex">

<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/style-editors.css" type="text/css" media="screen" />
<link rel="icon" type="image/png" href="<?php bloginfo('stylesheet_directory'); ?>/img/favicon.png" />

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
	google.load("jquery", "1.5.0");
	google.load("jqueryui", "1");
</script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.autofill-min.js"></script>
<script type="text/javascript">

/**
 * Convert from 24 to 12 hour clock 
 *
 * @param hour is the value (0-24)
 */
function convert24To12Clock(hour) {	
	return (hour>12 || hour==0) ? Math.abs(hour-12) :  hour;  
}
		
/**
 * Get from AM / PM for time 
 *
 * @param hour is the value (0-24)
 */
function getAMPM(hour) {	
	return (hour>=12) ? 'PM': 'AM';  
}

/**
 * Adds a leading zero to a single-digit number.  Used for displaying dates.
 */
function padNumber(num) {
  if (num <= 9) {
	return "0" + num;
  }
  return num;
}

/**
 * Add new news feed to database
 *
 * @param {string} news_feed is the text for the feed 
 *  {integer} user_id is the wordpress user id for the currently logged in user.
 */
function ajax_add_new_cdc_news_feed(news_feed, user_id)
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
	if(httpxml.status == 200){
		$(document).ready( function () {
			$('#dance_tip_list ul').empty();
			$('#dance_tip_list ul').html(httpxml.responseText);
			$('#dance_tip_list li span').css('float','left').css('margin','0px 5px 0px 5px');
			/* 
			 * Display a border around news feed text when mouse hovers over it
			 */
			$('#dance_tip_list li').addClass("dance_tip_li");
			$('#dance_tip_list li').hover(
				function() {
					$(this).addClass("dance_tip_li_hover");
					$(this).removeClass("dance_tip_li");
				},
				function() {
					$(this).addClass("dance_tip_li");
					$(this).removeClass("dance_tip_li_hover");
				}
			);
			
			// When a tip's checkbox is clicked
			
			$("#current_home input[type=checkbox]").click(function() {
				// If a checkbox is check for a news feed make appropriate edit buttons enabled.
				if( $(this).is(":checked") ) {
					$('#current_container .delete').attr("disabled", false);
					$(this).parents("li:eq(0)").addClass("yellow_highlighter");
				} 
				else { 
					if( $('#current_home input:checked').size() == 0 ) {
						$('#current_container .delete').attr("disabled", true);
					}
					
					$(this).parents("li:eq(0)").removeClass("yellow_highlighter");
				}
				// If all checkbox are check, check the select all checkbox. Uncheck also as needed.
				if( $("#current_home input[type=checkbox]").size() == $('#current_home input:checked').size() ) {
					$('#current_container .select_all').attr("checked", true);
				} else {
					$('#current_container .select_all').attr("checked", false);
				}
			});
			
		});
	}
}
}

var url="<?php bloginfo('url'); ?>/edit_tools/ajax-add-new-cdc-news-feed/";
url=url+"?news_feed="+news_feed+"&submitter_id="+user_id;
url=url+"&sid="+Math.random();
httpxml.onreadystatechange=stateck;
httpxml.open("GET",url,true);
httpxml.send(null);
}


/**
 * Delete selected news feeds
 *
 * @param {string} news_feed is the text for the tip 
 *  {integer} user_id is the wordpress user id for the currently logged in user.
 */
function ajax_delete_cdc_news_feed(feed_id)
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

var url="<?php bloginfo('url'); ?>/edit_tools/ajax-delete-cdc-news-feed/";
url=url+"?feed_id="+feed_id;
url=url+"&sid="+Math.random();
httpxml.onreadystatechange=stateck;
httpxml.open("GET",url,true);
httpxml.send(null);
}


/*
 * JQuery Effects
 */
$(document).ready( function() {
	// Get current date / time
	var d = new Date();
	
	/*
	 * Display a border around cdc news feed text when mouse hovers over it
	 */
	$('#dance_tip_list li').addClass("dance_tip_li");
	$('#dance_tip_list li').hover(
		function() {
			$(this).addClass("dance_tip_li_hover");
			$(this).removeClass("dance_tip_li");
		},
		function() {
			$(this).addClass("dance_tip_li");
			$(this).removeClass("dance_tip_li_hover");
		}
	);
	
	/*
	 * Select all cdc news feeds checkboxes
	 */
	$('#current_container .select_all').click( function() {
		if( $(this).is(":checked") ) {
			$('#current_container .delete').attr("disabled", false);
			$("#current_home input[type=checkbox]").each( function() {
				$(this).attr("checked", true);
				$(this).parents("li").addClass("yellow_highlighter");
				
			});
		} else {
			$('#current_container .delete').attr("disabled", true);
			$("#current_home input[type=checkbox]").each( function() { 
				$(this).attr("checked", false);
				$(this).parents("li").removeClass("yellow_highlighter");
				
			});
		}
	});
	
	/*
	 * Delect selected tip(s)
	 */
	$('#current_container .delete').click( function () {
		if(confirm("This action is permanent. Are you sure you want to do this?")){
			$("#current_home input:checked").each( function() {
				
				var thisID=$(this).attr("id");
								
				// Disable the edit buttons
				$('#current_container .delete').attr("disabled", true);
				
				// Uncheck select all for safe measure
				$('#current_container .select_all').attr("checked", false);
				
				ajax_delete_cdc_news_feed(thisID);
				
				// Display a notice to the users that the tip has been deleted for 2 seconds
				$("#changes_saved_alert").html("Deleted "+ d.getMonth() +"/"+ d.getDate() +"/"+ d.getFullYear() +" "+ convert24To12Clock( d.getHours() ) +":"+ padNumber( d.getMinutes() ) +":"+ padNumber( d.getSeconds() ) +" "+ getAMPM( d.getHours() ) +" by <?php echo $current_user->display_name; ?>");
				$("#changes_saved_alert").fadeIn(100).delay(2000).fadeOut(100);
				
				// Fade out the tip and remove from the DOM
				$(this).parents("li:eq(0)").fadeOut(300, function() { $(this).remove()});
			});
		}
	});
	
	/*
	 * When hovering over "Add a new tip" input field highlight the background
	 */
	$('#add_tip_input').hover(
		function() {
			$(this).addClass("yellow_highlighter");
		},
		function() {
			$(this).removeClass("yellow_highlighter");
		}
	);
	
	// Add the new tip with ajax when user hits enter/return or presses the 'Add' button
	
	$("#add_tip_input").keypress(
		/*
		 *  - Check if Enter keys is pressed. If so add new tip with ajax.
		 * param: theEvent - the pasted event
		 */
		function(event)
		{
			var charCode = (event.which) ? event.which : event.keyCode;
			if (charCode == 13) {
				if( $(this).val() == "" || $(this).val() == null ) {
				} else {
					ajax_add_new_cdc_news_feed( $(this).val(), <? echo (is_user_logged_in()) ? $current_user->ID : "0"; ?> );
					$(this).val("");
					$(this).blur();
					$("#changes_saved_alert").html("Saved "+ d.getMonth() +"/"+ d.getDate() +"/"+ d.getFullYear() +" "+ convert24To12Clock( d.getHours() ) +":"+ padNumber( d.getMinutes() ) +":"+ padNumber( d.getSeconds() ) +" "+ getAMPM( d.getHours() ) +" by <?php echo $current_user->display_name; ?>");
					$("#changes_saved_alert").fadeIn(100).delay(2000).fadeOut(100);
					return true;
				}
			} else {
				return true; // Allow key characters to be entered in input field.
			}
		}
	);
	
	// When a tip's checkbox is clicked
	
	$("#current_home input[type=checkbox]").click(function() {
		// If a checkbox is check for a cdc news feed make appropriate edit buttons enabled.
		if( $(this).is(":checked") ) {
			$('#current_container .delete').attr("disabled", false);
			$(this).parents("li:eq(0)").addClass("yellow_highlighter");
		} 
		else { 
			if( $('#current_home input:checked').size() == 0 ) {
				$('#current_container .delete').attr("disabled", true);
			}
			
			$(this).parents("li:eq(0)").removeClass("yellow_highlighter");
		}
		// If all checkbox are check, check the select all checkbox. Uncheck also as needed.
		if( $("#current_home input[type=checkbox]").size() == $('#current_home input:checked').size() ) {
			$('#current_container .select_all').attr("checked", true);
		} else {
			$('#current_container .select_all').attr("checked", false);
		}
	});
			
	// Place the words 'What are you seeking?' in the search input box
		
	$('#add_tip_input').autofill({
		value: '',
		defaultBackgroundImage: 'url(<? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://'+document.domain+'/wp-content/themes/charlotte_dancesport/img/cds_add_tip_placeholder.png)',
		activeBackgroundImage: ''
	});
});
</script>

</head>

<body>
	<div id="content" style="width:600px;" role="main">

		<div id="header" style="width:660px;">
			<div id="logo_and_text_container" style="width:600px;">
				<span class="cds_logo"></span>
				<h2><?php the_title(); ?></h2>
			</div>
		</div>
        
		<div class="cookie_crumb" style="width:600px;"><p><a href="">Edit</a> &gt; News Feeds</p></div>

		<div id="yellow_alerts" class="hidden"></div>
 
		<div id="current_container" style="width:550px;" class="edit_tool_content">
        
            <div class="edit_toolbar">
            	<input type="checkbox" value="select_all" name="select_all" class="select_all" />
                <!--<input type="button" value="Add Tip" name="add_tip" class="add_tip" />-->
                <input type="button" value="Delete" name="delete" class="delete" disabled="disabled" />
            </div>
            
            <div id="changes_saved_container" style="width:600px;height:20px; margin: 0px;"><div id="changes_saved_alert" class="hidden" style="float:none; margin: 0px auto 0px auto;">Saved</div></div>
<?php
		/**
		 * Display current news feeds
		 */
		$query = "SELECT * FROM cdsc_news_feed ORDER BY feed_id DESC";
	  
		$select = mysql_query($query) or die("SELECT for cdc news feed failed");
?>
			<div id="current_home" style="margin-bottom:30px; border-bottom: 1px solid #ccc; padding-bottom: 30px;">
<!--
            /**
             * Add new tip
             */
-->
				<div class="section_divider">Add New Tip</div>
                
                <div class="add_tip_container">
                    <input type="text" name="add_tip_input" id="add_tip_input" />
                    <!--<input type="button" value="Add" name="add_btn" id="add_btn" />-->
                </div>
                
            	<div class="section_divider">Current Tips</div>
<?php
		if( mysql_num_rows($select) != 0 ) {
			echo '<div id="dance_tip_list" class="dance_tip_list"><ul>';
			while($row = mysql_fetch_array( $select )) {
				echo '<li><span><input type="checkbox" id="'.$row['feed_id'].'" /></span>'.$row['title'].'</li>';
			}
			echo '</ul></div>';
		} else { echo '<div style="width: 550px; float: left;"><div class="no_images">No news feeds are currently displaying :-p</div></div>'; }
?>
			</div>
		</div>
	</div>
</body>
</html>