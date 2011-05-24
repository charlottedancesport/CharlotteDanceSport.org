<?php
/**
 * @package WordPress
 * @subpackage Charlotte_DanceSport_Theme
 */

if ( !is_user_logged_in() ) header("Location: http://www.charlottedancesport.org");

if( $_SERVER['REQUEST_METHOD'] == 'POST') {
     
$session_data = unserialize($_POST['post_data']);

//$results = $_POST['results'];
$post_data = str_replace("%2F", "/", $_POST['post_data']);
$post_data = str_replace("+", " ", $post_data);
$data = explode("&", $post_data);

if (is_array($data) ) {
        foreach ( $data as $d ) {
                list($key[], $value[]) = explode("=", $d);
                /*$query = "INSERT INTO banner_slides (path,filename,title,approved,recommendations,archived,start_date,end_date,adjudicator_id) VALUES ()";
                $select = mysql_query($query) or die("Select from cds_member failed.");
                $user = mysql_fetch_array($select, MYSQL_ASSOC);
*/
        }
        for ($i=0; $i < count($key); $i++) {
                switch (substr($key[$i], 0, -2)) {
                        case "filename":
                          $filename[substr($key[$i], -1)] = $value[$i];
                        break;

                        case "title":
                          $title[substr($key[$i], -1)] = $value[$i];
                        break;

                        case "start_date":
                          $start_date[substr($key[$i], -1)] = $value[$i];
                        break;

                        case "end_date":
                          $end_date[substr($key[$i], -1)] = $value[$i];
                        break;

                        case "forever":
                          $forever[substr($key[$i], -1)] = $value[$i];
                        break;

                        case "adjudicat":
                          $adjudicator = $value[$i];
                        break;

                        default:
                        break;
                }
        }
	$tmpPath = "wp-content/themes/charlotte_dancesport/uploads/";
	$path = "wp-content/themes/charlotte_dancesport/banner_images/";
	$msg = '{';

        for($i=0; $i < count($filename); $i++) {
                $query = "INSERT INTO banner_slides (path,filename,title,approved,recommendations,archived,start_date,end_date,forever,adjudicator_id) 
                          VALUES ('{$path}', '{$filename[$i]}', '";
                $query .= (isset($title[$i])) ? $title[$i] : "Unknown artist";
                $query .= "' , 1, 0, 0, ";
                $query .= (isset($start_date[$i]) && $start_date[$i]!='' && $start_date[$i]!=null) ? "'".convert_date($start_date[$i])."'" : "NOW()";
                $query .= ", ";
                $query .= (isset($end_date[$i]) && $end_date[$i]!='' && $end_date[$i]!=null) ? "'".convert_date($end_date[$i])."'" : "NOW()";
                $query .= ", ";
                $query .= (isset($forever[$i]) && $forever[$i] == 'on') ? "1" : "0";
                $query .= ", {$adjudicator})";
                $insert = mysql_query($query) or die("INSERT into banner_slides failed :( boo hoo!");
		if( $insert == true ) {
		  if( !rename($tmpPath . $filename[$i], $path . $filename[$i]) ) {
		    $msg .= '"msg":"Oopsy >.< the image '.$filename[$i].' could not be moved to the banner_images folder.","err":"true"';
	 	  } else {
		    $msg .= '"msg":"The photo move to banner_images/ was successful","err":"false"';
		  }
		 // $url = explode("?",CurrentPathURL());
		 // header('Location: '. $url[0] . '?msg=1');
		} else { $msg .= '"msg":"insert failed","err":"true"'; }
        }
	$msg .= '}';
	echo $msg;
} 
} else {
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "<? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="<? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="<? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="robots" content="noindex">

<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/style-editors.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/uploadify.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/jquery-ui-1.8.4.custom.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/js/colorbox/colorbox.css"  type="text/css" media="screen" />
<link rel="icon" type="image/png" href="<?php bloginfo('stylesheet_directory'); ?>/img/favicon.png" />

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
	google.load("jquery", "1.5.0");
	google.load("jqueryui", "1");
</script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/swfobject.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.uploadify.v2.1.0.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/colorbox/jquery.colorbox-min.js"></script>
<script type="text/javascript">

/**
 * Auto update/save selected photos details for photos being made current
 *
 * @param {interger} imageID is the banner_slide_id of the photo to be removed
 *  from the wordpress database
 *  {string} photographer is the name over the owner of the image
 *  {string} start_date is when the image is scheduled to begin displaying
 *  {string} end_date is when the image is scheduled to stop displaying
 *  {boolean} forever true or false if image is display forever or not, respectively
 */
function ajax_update_photo_details(imageID, photographer, start_date, end_date, forever)
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

var url="<?php bloginfo('url'); ?>/edit_tools/ajax-update-photo-details/";
url=url+"?imageID="+imageID+"&photographer="+photographer+"&start_date="+start_date+"&end_date="+end_date+"&forever="+forever;
url=url+"&sid="+Math.random();
httpxml.onreadystatechange=stateck;
httpxml.open("GET",url,true);
httpxml.send(null);
}


/**
 * Removes/deletes selected photos from the queue in the /uploads folders
 *
 * @param {interger} imageID is the banner_slide_id of the photo to be removed
 *  from the wordpress database
 */
function ajax_delete_photo_from_db(imageID)
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

var url="<?php bloginfo('url'); ?>/edit_tools/uploads-trash-collector/";
url=url+"?imageID="+imageID;
url=url+"&sid="+Math.random();
httpxml.onreadystatechange=stateck;
httpxml.open("GET",url,true);
httpxml.send(null);
}

/**
 * Removes/deletes selected photos from the queue in the /uploads folders
 *
 * @param {string} path is the relative path to the photo
 * @param {string} fileName is the name of the photo to be removed
 */
function ajax_delete_photo(path,fileName)
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

var url="<?php bloginfo('stylesheet_directory'); ?>/ajax_helper/uploads-trash-collector.php";
url=url+"?path="+path+"&fileName="+fileName;
url=url+"&sid="+Math.random();
httpxml.onreadystatechange=stateck;
httpxml.open("GET",url,true);
httpxml.send(null);
}

/**
 * Removes/archive selected banner photos
 *
 * @param {interger} imageID is the banner_slide_id of the photo to be removed
 *  from the wordpress database
 */
function ajax_archive_photo(imageID)
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

var url="<?php bloginfo('url'); ?>/edit_tools/ajax-photo-archiver/";
url=url+"?imageID="+imageID;
url=url+"&sid="+Math.random();
httpxml.onreadystatechange=stateck;
httpxml.open("GET",url,true);
httpxml.send(null);
}

/**
 * Removes/archive selected banner photos
 *
 * @param {interger} imageID is the banner_slide_id of the photo to be removed
 *  from the wordpress database
 */
function ajax_unarchive_photo(imageID)
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

var url="<?php bloginfo('url'); ?>/edit_tools/ajax-photo-unarchiver/";
url=url+"?imageID="+imageID;
url=url+"&sid="+Math.random();
httpxml.onreadystatechange=stateck;
httpxml.open("GET",url,true);
httpxml.send(null);
}

/**
 * validate_photo_details() - check that required form fields are not empty
 */
$(document).ready(function() {
	$("#photo_details").submit( function() {
		var tempData = null;
		$(this).find('input').each( function() {
			// Initialize - removed any yellow highlights on form elements
			$(this).removeClass("yellow_highlighter");
			$("#yellow_alerts").addClass("hidden");
			
			if( ($(this).attr('id')).match("title") != null && 
				($(this).val() == "" || $(this).val() == null) ) {
				
				$(this).addClass("yellow_highlighter");
			
			}
			
			if( ($(this).attr('id')).match("forever") != null && 
				 $(this).is(':checked') == false ) {
				
				var pattern = new RegExp('[0-9]');
				var num = pattern.exec( $(this).attr('id') );
				
				if( $("#start_date-"+num).val() == "" || $("#start_date-"+num).val() == null ) {
					$("#start_date-"+num).addClass("yellow_highlighter");
				}
				if( $("#end_date-"+num).val() == "" || $("#end_date-"+num).val() == null ) {
					$("#end_date-"+num).addClass("yellow_highlighter");
				}
			}

		});
		
		var empty_fields = $(this).find('.yellow_highlighter').length;
		if( empty_fields > 0 ) {
			$("#yellow_alerts").removeClass("hidden").text("Well, it looks like you missed "+empty_fields+" fields. Remember to read the fine print!");
			return false;
		} else {
			var post_data = $(this).serialize();
			$.post("<?php echo str_replace('?edit=upload&step=2','', CurrentPageURL()); ?>", {"post_data":post_data},
				function(data){
				  window.location = "<?php echo str_replace('?edit=upload&step=2','', CurrentPageURL()); ?>/?step=3";
				});
			return false;	
		}

	});
	
	$(".title").keypress(
                /*
                 *  - Check if alpha numeric character keys are pressed. If so place in form field.
                 * param: theEvent - the pasted event
                 * returns: true - allowing the alpha numeric key character to be entered into the form field.
                 *                      false - do not allow the character to be entered into the form field. 
                 */
                function(event)
                {
                        var charCode = (event.which) ? event.which : event.keyCode;
                        if (charCode > 32 && (charCode < 48 || charCode > 57) && (charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122) )
                                return false; // Do not allow the key character to be entered. 
                        
                        return true; // Allow alpha numeric key characters to be entered only.
                }
 	);
});


$(document).ready(function (){
	/*
	 * Hover functionality for Banner Photos Editor tabs.
	 */
	$(".tab").hover(
		function () {
			$(this).addClass("hover_tab");
			$(this).find("a").css("color", "#fff");
		}, 
		function () {
			$(this).removeClass("hover_tab");
			$(this).find("a").css("color", "#777");
		}
	).click( function () {
		window.location = $(this).children("a").attr("href");
	});
	
	/*
	 */
	$('#upload_files').click( function() {
		$('#uploadify').uploadifyUpload();
	});
});


/**
 * Convert date for date picker input fields
 *
 * @param {string} d is the date time in YYYY-MM-DD HH:MM:SS format
 * returns date in MM/DD/YYYY format 
 */
function convert_date(d) {
	var str = d.split(" ",1);
	str = str[0].split("-");
	return str[1] + "/" + str[2] + "/" + str[0];
}

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
</script>
</head>

<body>
	<div id="content" role="main">

		<div id="header">
			<div id="logo_and_text_container">
				<span class="cds_logo"></span>
				<h2><?php the_title(); ?></h2>
			</div>
			<div id="nav_tabs_container">
				<ul>
					<li><?php if ($_GET['edit'] <> 'current' && isset($_GET['edit'])) { ?><div class="tab"><a href="?edit=current">Current</a></div><?php } else { ?><div class="current_tab">Current</div><?php } ?></li>
					<li><?php if ($_GET['edit'] <> 'requested') { ?><div class="tab"><a href="?edit=requested">Requested</a></div><?php } else { ?><div class="current_tab">Requested</div><?php } ?></li>
					<li><?php if ($_GET['edit'] <> 'archive') { ?><div class="tab"><a href="?edit=archive">Archive</a></div><?php } else { ?><div class="current_tab">Archive</div><?php } ?></li>
					<li class="upload"><?php if ($_GET['edit'] <> 'upload') { ?><div class="tab"><a href="?edit=upload&step=1">Upload</a></div><?php } else { ?><div class="current_tab">Upload</div><?php } ?></li>
				</ul>
			</div>
		</div>
        
<?php /* if($_GET['edit'] == NULL || $_GET['edit'] == "") { ?>		
		<div id="yellow_alerts" <?php if($_GET['step']!=3) { ?>class="hidden"<?php } ?>>Your newly uploaded banner photo setup is complete! - <a href="?edit=current" style="font-size:.7em;">View current photos</a></div>
        
 		<div><p>This main page</p></div>
<?php } */ ?>

<?php
switch ($_GET['edit']) {
	case 'upload':
		$filename = get_directory_listing('wp-content/themes/charlotte_dancesport/uploads');
?>

		<div class="cookie_crumb"><p><a href="">Edit</a> &gt; Upload photos</p></div>

<?php
		if ( count($filename)>0 && $_GET['step']!=2) {		
?>

		<div id="yellow_alerts">You have <?php echo count($filename); ?> incomplete banner photo upload<?php if (count($filename) > 1) echo "s";?>! - <a href="?edit=upload&step=2" style="font-size:.7em;">Complete now</a></div>

<?php
		} else {
?>

		<div id="yellow_alerts" class="hidden"></div>

<?php   } ?>

		<div id="upload_container">
			<div class="header_box"><p>Upload Photos</p></div>
			<div class="details_box">
            
            <?php
			switch ($_GET['step']) {
				case 1:
			?>
            
				<p class="bold">STEP 1 - Select photos to upload</p>
				<ul>
				  <li>Photos must be 960x280 pixels.</li>
				  <li>File size can be up to 1 MB.</li>
				  <li>Accept images formats: JPG &amp; GIF.</li>
				</ul>
	
				<div id="upload_queue_container">
					<div id="fileQueue" class="uploadifyQueue"></div>
					<div class="uploadify_controls">
						<div class="browse_btn"><input type="file" name="uploadify" id="uploadify" /></div>
                        <div class="clear_queue"><a href="javascript:jQuery('#uploadify').uploadifyClearQueue()">Clear queue</a></div>
					</div>
				</div>
				
                <div id="upload_files_btn_container">
                    <!--<a href="javascript:jQuery('#uploadify').uploadifyUpload();">Upload files</a>-->
                    <input type="button" value="Upload files" id="upload_files" name="upload_files" />
                </div>
                
                <div id="continue_link_container"><a href="?edit=upload&step=2">Continue &gt;&gt;</a></div>
				<script type="text/javascript">
                $(document).ready(function() {
                    $("#uploadify").uploadify({
                        'uploader'  	 : '<?php bloginfo('stylesheet_directory'); ?>/js/uploadify.swf',
                        'script'         : '<?php bloginfo('stylesheet_directory'); ?>/js/uploadify.php',
                        'cancelImg'      : '<?php bloginfo('stylesheet_directory'); ?>/img/cancel.png',
                        'folder'         : '../../wp-content/themes/charlotte_dancesport/uploads',
                        'queueID'        : 'fileQueue',
                        'queueSizeLimit' : 10,
                        'simUploadLimit' : 1,
                        'auto'           : false,
                        'multi'          : true,
                        'fileDesc'       : '*.jpeg;*.jpg;*.gif',
                        'fileExt'        : '*.jpeg;*.jpg;*.gif',
                        'sizeLimit'      : 1000000,
                        'buttonText'     : '',
                        'buttonImg'      : '<?php bloginfo('stylesheet_directory'); ?>/img/browse_btn.png',
                        'rollover'       : true,
                        'width'          : 110,
                        'height'         : 26,
                        'vmode'          : 'transparent'
                    });
					$('#uploadify').focusout( function () {
						$('#uplaod_files').attr("disabled", ( $('#fileQueue').is(":empty") ) ? true:false);
					});
					
					
						$('#uplaod_files').attr("disabled", ( $('#fileQueue').is(":empty") ) ? true:false);
					
                });
                </script>  
                              
            <?php    
                break;
				
				case 2:
				$filename = get_directory_listing("wp-content/themes/charlotte_dancesport/uploads");
				
				if ($filename <> NULL) {
			?>
            	
            	<p class="bold">STEP 2 - Add photo details</p>
				<ul>
				  <li>Give credit where credit is due.</li>
				  <li>Select how long to display the photo.</li>
				  <li><small style="color:#999;">* All fields are required!</small></li>
				</ul>
                <form id="photo_details" > <!-- action="<?php //echo str_replace("?".$_SERVER['QUERY_STRING'], "", CurrentPageURL()); ?>" method="post"> -->
            <?php
					/* Added by Lance Newby 8/31/2010 - Store new banner image data in MySQL DB */
					if ( is_user_logged_in() ) { 
						global $current_user; 
						get_currentuserinfo();
						$query = "SELECT * FROM cds_member WHERE user_id={$current_user->ID}";
						$select = mysql_query($query) or die("Select from cds_member failed.");
						$user = mysql_fetch_array($select, MYSQL_ASSOC);
					}
			
					$counter = 0;
					// Loop over each filename, append markup and display
					foreach( $filename as $fn) {
						if($fn!='.' && $fn!='..' && preg_match("/\.[A-Za-z][A-Za-z0-9]{2,3}$/", $fn)) {
			?>
	        <input type="hidden" value="<?php echo $fn; ?>" id="filename-<?php echo $counter; ?>" name="filename-<?php echo $counter; ?>" class="filename" />
                <div id="photo-<?php echo $counter; ?>" class="photo_details">
                    <div><a href="<?php bloginfo('stylesheet_directory'); ?>/uploads/<?php echo $fn; ?>" rel="banner_image" alt="<?php echo $fn; ?>" title="<?php echo $fn; ?>"><?php echo $fn; ?></a></div>
                    <label for="title-<?php echo $counter; ?>">Photographer</label>
                    <input type="text" id="title-<?php echo $counter; ?>" name="title-<?php echo $counter; ?>" class="title" />
                    <span id="duration-<?php echo $counter; ?>">
                    <label for="start_date-<?php echo $counter; ?>">Duration</label>
                    <input type="text" id="start_date-<?php echo $counter; ?>" name="start_date-<?php echo $counter; ?>" size="9" /> to 
                    <input type="text" id="end_date-<?php echo $counter; ?>" name="end_date-<?php echo $counter; ?>" size="9" />
                    </span>
                    <input type="checkbox" id="forever-<?php echo $counter; ?>" name="forever-<?php echo $counter; ?>" />
                    <label for="forever-<?php echo $counter; ?>">forever</label>
                    <span id="remove-<?php echo $counter; ?>" class="remove_link">remove</span>
                </div>
                <script type="text/javascript" language="javascript">
                $(document).ready(function() {
                    $("#start_date-<?php echo $counter; ?>").datepicker({inline: true});
                    $("#end_date-<?php echo $counter; ?>").datepicker({inline: true});
                    $("#forever-<?php echo $counter; ?>").click( function() {
                        if( $(this).attr("checked") ) {
                            $("#duration-<?php echo $counter; ?>").fadeOut(100);
                        } else {
                            $("#duration-<?php echo $counter; ?>").fadeIn(100);
                        }
                    });
                    $("a[rel='banner_image']").colorbox({width:400, transition:"fade"});
                    $("#remove-<?php echo $counter; ?>").click( function() {
                        ajax_delete_photo("../uploads", "<?php echo $fn; ?>");
                        $("#photo-<?php echo $counter; ?>").addClass("photoRemoval").fadeOut(1000, function() { $(this).remove()});
                    });
					
					$("#cancel").click( function () {
						$("a[rel='banner_image']").each( function () {
							ajax_delete_photo("../uploads", $(this).attr("alt"));
                        	$(this).parents("photo_details").addClass("photoRemoval").fadeOut(1000, function() { $(this).remove()});
							window.location = "?edit=upload&step=1";
						});
					});
                });
                
                </script>
			<?php
						$counter++;
						}
					}
			?>
                    <div class="submission_btns">
                        <input type="submit" value="Submit details" id="submit_details" name="submit_details" />
                        <input type="button" value="Done" id="done" name="done" />
                        <input type="button" value="Cancel" id="cancel" name="cancel" />
                    </div>
                    <input type="hidden" value="<?php echo (is_user_logged_in()) ? $current_user->ID : "0"; ?>" id="adjudicator" name="adjudicator" />		    	      		<input type="hidden" value="3" id="step" name="step" />
	       	    </form>
            <?php
			} else {
			?>
            	<p>No banner image uploads are pending.</p>
            <?php
				}
                break;
								
				default:
				break;
			}
			?>
            
			</div>
		</div>		
<?php	
	break;
	
	case 'requested':
?>
		<div id="requested_container" class="cookie_crumb"><p><a href="">Edit</a> &gt; Top requested banner photos</p></div>
        <div class="edit_tool_content">
            <div class="edit_toolbar">
                <input type="checkbox" value="select_all" name="select_all" class="select_all" disabled="disabled" />
                <input type="button" value="Approve & Download" name="approve_and_download" class="approve_and_download" disabled="disabled" />
                <input type="button" value="Reject" name="reject" class="reject" disabled="disabled" />
                <label for="aprroved">View:</label>
                <input type="button" value="Approved" name="approved" class="approved" id="approved" disabled="disabled" />
                <input type="button" value="Rejected" name="rejected" class="rejected" disabled="disabled" />
            </div>
            
            <div id="current_home">
            	<div class="no_images"><strong>Coming soon!</strong> Visitors will be able to request photos from the CharlotteDanceSport.org scrapbook for displaying in the rotating banner images.</div>
            </div>
            
        </div>

<?php
	break;
	
	case 'current':
	case NULL:
	case '':
?>
		<script type="text/javascript" language="javascript">
		
        $(document).ready(function() {
		
			var prior_photographer;
			var prior_start_date;
			var prior_end_date;
			
            $('#current_container .upload_image').click( function () {
				window.location = "?edit=upload&step=1";
			});
			$('#current_container .edit').click( function () {

				$('.cookie_crumb p').html('<a href="">Edit</a> &gt; <a href="?edit=current">Current banner photos</a> &gt; Editor');
				$(this).attr("disabled",true);
				$('#current_container .select_all').attr("disabled", true);
				$('#current_container .remove_and_archive').attr("disabled", true);
				$('#current_container .delete').attr("disabled", true);
				$("#current_home").addClass("hidden");
				$('#current_editor').removeClass("hidden");
				$(".edit_buttons").removeClass("hidden");
				$("#save").attr("disabled",true);
				// Open the photo details editor DIV container
				
				$("#current_home input:checked").each( function() {
					
					var thisID=$(this).attr("id");
					var src=$(this).parents(".single_img_container").find("img").attr("src");
					var filename=$(this).parents(".single_img_container").find(".filename strong").text();
					var photographer=$(this).parents(".single_img_container").find("input[name=photographer]").val();
					var forever=$(this).parents(".single_img_container").find("input[name=forever]").val();
					var start_date=$(this).parents(".single_img_container").find("input[name=start_date]").val();
					var end_date=$(this).parents(".single_img_container").find("input[name=end_date]").val();
							
					if( forever == 0 ) {
						var photo_elements;
						$(".details_box").append(''
							+'<div id="photo-'+thisID+'" class="photo_edit photo_details">'
								+'<div class="filename_div"><a href="'+src+'" rel="banner_image" alt="'+filename+'" title="'+filename+'">'+filename+'</a></div>'
								+'<label for="title-'+thisID+'" id="photographer_lbl-'+thisID+'">Photographer</label>'
								+'<input type="text" id="title-'+thisID+'" name="title-'+thisID+'" value="'+photographer+'" class="title" />'
								+'<span id="duration-'+thisID+'" class="duration_span">'
								+'<label for="start_date-'+thisID+'" class="duration_lbl">Duration</label>'
								+'<input type="text" id="start_date-'+thisID+'" name="start_date-'+thisID+'" value="'+convert_date(start_date)+'" size="9" /> to '
								+'<input type="text" id="end_date-'+thisID+'" name="end_date-'+thisID+'" value="'+convert_date(end_date)+'" size="9" />'
								+'</span>'
								+'<input type="checkbox" id="forever-'+thisID+'" name="forever-'+thisID+'>" />'
								+'<label for="forever-'+thisID+'">forever</label>'
								+'<span id="remove-'+thisID+'" class="remove_link">delete</span>'
							+'</div>');
							
						$("#start_date-"+thisID).datepicker({inline: true});
						$("#end_date-"+thisID).datepicker({inline: true});
						
						
						
						
						
						
						// Check that the start and end date are a valid interval
						$("#start_date-"+thisID).focusout( function() {
							if( $(this).val() > $("#end_date-"+thisID).val() && $("#end_date-"+thisID).val() != "" ) {
								$(this).addClass("yellow_highlighter");
								$("#end_date-"+thisID).addClass("yellow_highlighter");
								$("#changes_saved_alert").html("The duration is invalid unless you discovered time travel!");
							} else {						
								var new_photographer=$("#title-"+thisID).val();
								var new_start_date=$("#start_date-"+thisID).val();
								var new_end_date=$("#end_date-"+thisID).val();
								var new_forever;
								var d = new Date();
								
								if($("#forever-"+thisID).attr("checked")) {new_forever=1;} else {new_forever=0;}
								
								// Update photo details in DB with AJAX
								ajax_update_photo_details(thisID, new_photographer, new_start_date, new_end_date, new_forever);
								
								$("#changes_saved_alert").html("Saved "+ d.getMonth() +"/"+ d.getDate() +"/"+ d.getFullYear() +" "+ convert24To12Clock( d.getHours() ) +":"+ padNumber( d.getMinutes() ) +":"+ padNumber( d.getSeconds() ) +" "+ getAMPM( d.getHours() ) +" by <?php echo $current_user->display_name; ?>");
								$("#changes_saved_alert").fadeIn(100).delay(2000).fadeOut(100);
							}
						});
						$("#end_date-"+thisID).focusout( function() {
							if( $(this).val() < $("#start_date-"+thisID).val() && $("#start_date-"+thisID).val() != "" ) {
								$(this).addClass("yellow_highlighter");
								$("#start_date-"+thisID).addClass("yellow_highlighter");
								$("#changes_saved_alert").html("The duration is invalid unless you discovered time travel!");
							} else {						
								var new_photographer=$("#title-"+thisID).val();
								var new_start_date=$("#start_date-"+thisID).val();
								var new_end_date=$("#end_date-"+thisID).val();
								var new_forever;
								var d = new Date();
								
								if($("#forever-"+thisID).attr("checked")) {new_forever=1;} else {new_forever=0;}
								
								// Update photo details in DB with AJAX
								ajax_update_photo_details(thisID, new_photographer, new_start_date, new_end_date, new_forever);
								
								$("#changes_saved_alert").html("Saved "+ d.getMonth() +"/"+ d.getDate() +"/"+ d.getFullYear() +" "+ convert24To12Clock( d.getHours() ) +":"+ padNumber( d.getMinutes() ) +":"+ padNumber( d.getSeconds() ) +" "+ getAMPM( d.getHours() ) +" by <?php echo $current_user->display_name; ?>");
								$("#changes_saved_alert").fadeIn(100).delay(2000).fadeOut(100);
							}
						});
						
						$("#forever-"+thisID).click( function() {
							var new_photographer=$("#title-"+thisID).val();
							var new_start_date=$("#start_date-"+thisID).val();
							var new_end_date=$("#end_date-"+thisID).val();
							var new_forever;
							var d = new Date();
							
							if( $(this).attr("checked") ) {
								new_forever=1;
								$("#duration-"+thisID).fadeOut(100);
							} else {
								new_forever=0;
								$("#duration-"+thisID).fadeIn(100);
							}
							
							// Update photo details in DB with AJAX
							ajax_update_photo_details(thisID, new_photographer, new_start_date, new_end_date, new_forever);
							
							$("#changes_saved_alert").html("Saved "+ d.getMonth() +"/"+ d.getDate() +"/"+ d.getFullYear() +" "+ convert24To12Clock( d.getHours() ) +":"+ padNumber( d.getMinutes() ) +":"+ padNumber( d.getSeconds() ) +" "+ getAMPM( d.getHours() ) +" by <?php echo $current_user->display_name; ?>");
							$("#changes_saved_alert").fadeIn(100).delay(2000).fadeOut(100);
						});
						$("a[rel='banner_image']").colorbox({width:400, transition:"fade"});
						
						// A little css view formatting
						$("#photographer-lbl-"+thisID).addClass("photographer_lbl");

						$("#remove-"+thisID).click( function() {
							ajax_delete_photo("../banner_images",filename);
							ajax_delete_photo("../thumbs",filename);
							ajax_delete_photo_from_db(thisID);
							$("#photo-"+thisID).addClass("photoRemoval").fadeOut(1000, function() { $(this).remove()});
						});

					} else {
						$(".details_box").append(''
							+'<div id="photo-'+thisID+'" class="photo_edit photo_details">'
								+'<div class="filename_div"><a href="'+src+'" rel="banner_image" alt="'+filename+'" title="'+filename+'">'+filename+'</a></div>'
								+'<label for="title-'+thisID+'" id="photographer_lbl-'+thisID+'">Photographer</label>'
								+'<input type="text" id="title-'+thisID+'" name="title-'+thisID+'" value="'+photographer+'" class="title" />'
								+'<span id="duration-'+thisID+'" style="display: none;" class="duration_span">'
								+'<label for="start_date-'+thisID+'" class="duration_lbl">Duration</label>'
								+'<input type="text" id="start_date-'+thisID+'" name="start_date-'+thisID+'" value="'+convert_date(start_date)+'" size="9" /> '
								+'<label for="end_date">to</label> '
								+'<input type="text" id="end_date-'+thisID+'" name="end_date-'+thisID+'" value="'+convert_date(end_date)+'" size="9" />'
								+'</span>'
								+'<input type="checkbox" id="forever-'+thisID+'" name="forever-'+thisID+'>" checked="checked" />'
								+'<label for="forever-'+thisID+'">forever</label>'
								+'<span id="remove-'+thisID+'" class="remove_link">delete</span>'
							+'</div>');
						
						$("#start_date-"+thisID).datepicker({inline: true});
						$("#end_date-"+thisID).datepicker({inline: true});
						
						
						
						
						
						// Check that the start and end date are a valid interval
						$("#start_date-"+thisID).focusout( function() {
							if( $(this).val() > $("#end_date-"+thisID).val() && $("#end_date-"+thisID).val() != "" ) {
								$(this).addClass("yellow_highlighter");
								$("#end_date-"+thisID).addClass("yellow_highlighter");
								$("#changes_saved_alert").html("The duration is invalid unless you discovered time travel!");
							} else {						
								var new_photographer=$("#title-"+thisID).val();
								var new_start_date=$("#start_date-"+thisID).val();
								var new_end_date=$("#end_date-"+thisID).val();
								var new_forever;
								var d = new Date();
								
								if($("#forever-"+thisID).attr("checked")) {new_forever=1;} else {new_forever=0;}
								
								// Update photo details in DB with AJAX
								ajax_update_photo_details(thisID, new_photographer, new_start_date, new_end_date, new_forever);
								$("#changes_saved_alert").html("Saved "+ d.getMonth() +"/"+ d.getDate() +"/"+ d.getFullYear() +" "+ convert24To12Clock( d.getHours() ) +":"+ padNumber( d.getMinutes() ) +":"+ padNumber( d.getSeconds() ) +" "+ getAMPM( d.getHours() ) +" by <?php echo $current_user->display_name; ?>");
								$("#changes_saved_alert").fadeIn(100).delay(2000).fadeOut(100);
							}
						});
						$("#end_date-"+thisID).focusout( function() {
							if( $(this).val() < $("#start_date-"+thisID).val() && $("#start_date-"+thisID).val() != "" ) {
								$(this).addClass("yellow_highlighter");
								$("#start_date-"+thisID).addClass("yellow_highlighter");
								$("#changes_saved_alert").html("The duration is invalid unless you discovered time travel!");
							} else {						
								var new_photographer=$("#title-"+thisID).val();
								var new_start_date=$("#start_date-"+thisID).val();
								var new_end_date=$("#end_date-"+thisID).val();
								var new_forever;
								var d = new Date();
								
								if($("#forever-"+thisID).attr("checked")) {new_forever=1;} else {new_forever=0;}
								
								// Update photo details in DB with AJAX
								ajax_update_photo_details(thisID, new_photographer, new_start_date, new_end_date, new_forever);
								
								$("#changes_saved_alert").html("Saved "+ d.getMonth() +"/"+ d.getDate() +"/"+ d.getFullYear() +" "+ convert24To12Clock( d.getHours() ) +":"+ padNumber( d.getMinutes() ) +":"+ padNumber( d.getSeconds() ) +" "+ getAMPM( d.getHours() ) +" by <?php echo $current_user->display_name; ?>");
								$("#changes_saved_alert").fadeIn(100).delay(2000).fadeOut(100);
							}
						});
						
						$("#forever-"+thisID).click( function() {
							var new_photographer=$("#title-"+thisID).val();
							var new_start_date=$("#start_date-"+thisID).val();
							var new_end_date=$("#end_date-"+thisID).val();
							var new_forever;
							var d = new Date();
							
							if( $(this).attr("checked") ) {
								new_forever=1;
								$("#duration-"+thisID).fadeOut(100);
							} else {
								new_forever=0;
								$("#duration-"+thisID).fadeIn(100);
							}
							
							// Update photo details in DB with AJAX
							ajax_update_photo_details(thisID, new_photographer, new_start_date, new_end_date, new_forever);
							
							$("#changes_saved_alert").html("Saved "+ d.getMonth() +"/"+ d.getDate() +"/"+ d.getFullYear() +" "+ convert24To12Clock( d.getHours() ) +":"+ padNumber( d.getMinutes() ) +":"+ padNumber( d.getSeconds() ) +" "+ getAMPM( d.getHours() ) +" by <?php echo $current_user->display_name; ?>");
							$("#changes_saved_alert").fadeIn(100).delay(2000).fadeOut(100);
						});
						$("a[rel='banner_image']").colorbox({width:400, transition:"fade"});
						
						// A little css view formatting
						$("#photographer-lbl-"+thisID).addClass("photographer_lbl");
						
						$("#remove-"+thisID).click( function() {
							ajax_delete_photo("../banner_images",filename);
							ajax_delete_photo("../thumbs",filename);
							ajax_delete_photo_from_db(thisID);
							$("#photo-"+thisID).addClass("photoRemoval").fadeOut(1000, function() { $(this).remove()});
						});
					}

				});
				
			});
			
			$('#current_container .remove_and_archive').click( function () {
				$("input:checked").each( function() {
					
					var thisID=$(this).attr("id");
					
					// Disable the edit buttons
					$('#current_container .edit').attr("disabled", true);
					$('#current_container .select_all').attr("checked", false);
					$('#current_container .remove_and_archive').attr("disabled", true);
					$('#current_container .delete').attr("disabled", true);
						
					ajax_archive_photo(thisID);
					$(this).parents(".single_img_container").fadeOut(300, function() { $(this).remove()});
				});
			});
			
			/*
			 * Delete button handler - deletes the selected image file(s) and detail(s) from mysql database 
			 */
			$('#current_container .delete').click( function () {
				if(confirm("This action is permanent. Are you sure you want to do this?")){
					$("#current_home input:checked").each( function() {
						
						var thisID=$(this).attr("id");
						var filename=$(this).parents(".single_img_container").find(".filename strong").text();
						
						// Disable the edit buttons
						$('#current_container .edit').attr("disabled", true);
						$('#current_container .remove_and_archive').attr("disabled", true);
						$('#current_container .delete').attr("disabled", true);
						
						// Uncheck select all for save measure
						$('#current_container .select_all').attr("checked", false);
					
						ajax_delete_photo("../banner_images",filename);
						ajax_delete_photo("../thumbs",filename);
						ajax_delete_photo_from_db(thisID);
						$(this).parents(".single_img_container").fadeOut(300, function() { $(this).remove()});
					});
				}
			});
			
			/*
			 * Done Button handler - reloads the current webpage
			 */
			$(".done").click( function () {
				// Check to make sure that all data has been saved for each photo.
				/*$("#current_home .duration_lbl").each( function() {
					var thisID = ($(this).attr("for")).split("-",1);;
					var new_photographer=$("#title-"+thisID).val();
					var new_start_date=$("#start_date-"+thisID).val();
					var new_end_date=$("#end_date-"+thisID).val();
					var new_forever;
					
					if($("#forever-"+thisID).attr("checked")) {new_forever=1;} else {new_forever=0;}
					
					if( new_photograhper != prior_photogrpher || new_start_date != prior_start_date || new_end_date != prior_end_date ) {
						confirm ("There are some unsaved changes. Continue without saving?") window.location = "<? CurrentPageURL(); ?>";
						// Update photo details in DB with AJAX
						//ajax_update_photo_details(thisID, new_photographer, new_start_date, new_end_date, new_forever);
					} 
				});
				if( found < 0 ) */
				window.location = "<? CurrentPageURL(); ?>";
			});
			$("#current_home input[type=checkbox]").click(function() {
			   	// If a checkbox is check for a banner image make appropriate edit buttons enabled.
			   	if( $(this).is(":checked") ) {
					$('#current_container .edit').attr("disabled", false);
					$('#current_container .remove_and_archive').attr("disabled", false);
					$('#current_container .delete').attr("disabled", false);
					$(this).parents(".single_img_container").children(".image_details_container").addClass("yellow_highlighter").addClass("yellow_highlighter_img_details");
				} 
				else { 
					if( $('#current_home input:checked').size() == 0 ) {
						$('#current_container .edit').attr("disabled", true);
						$('#current_container .remove_and_archive').attr("disabled", true);
						$('#current_container .delete').attr("disabled", true);
					}
					
					$(this).parents(".single_img_container").children(".image_details_container").removeClass("yellow_highlighter").removeClass("yellow_highlighter_img_details");
				}
				// If all checkbox are check, check the select all checkbox. Uncheck also as needed.
				if( $("#current_home input[type=checkbox]").size() == $('#current_home input:checked').size() ) {
					$('#current_container .select_all').attr("checked", true);
				} else {
					$('#current_container .select_all').attr("checked", false);
				}
			});
			
			/*
			 * Disable select all check box if not images are currently in the archive
			 */
			if( $("#current_home input[type=checkbox]").size() == 0 ) $('#current_container .select_all').attr("disabled", true);
			
			/*
			 * Click handler for each displayed archive image
			 * - When image is click check the corresponding checkbox and add yellow highlight
			 */
			$('#current_container img').click(function () {
				var cbox = $(this).parent().find("input[type=checkbox]");
				if( cbox.is(":checked") ) {
					cbox.attr("checked",false);
					if( cbox.parents('#current_container').find("input:checked").size() == 0 ) {
						cbox.parents('#current_container').find(".edit").attr("disabled", true);
						cbox.parents('#current_container').find(".remove_and_archive").attr("disabled", true);
						cbox.parents('#current_container').find(".delete").attr("disabled", true);
					}
						
					$(this).parents(".single_img_container").children(".image_details_container").removeClass("yellow_highlighter").removeClass("yellow_highlighter_img_details");
				} else {
					cbox.attr("checked",true);
					cbox.parents('#current_container').find(".edit").attr("disabled", false);
					cbox.parents('#current_container').find(".remove_and_archive").attr("disabled", false);
					cbox.parents('#current_container').find(".delete").attr("disabled", false);
					cbox.parents(".single_img_container").children(".image_details_container").addClass("yellow_highlighter").addClass("yellow_highlighter_img_details");
				}
				
				// If all checkbox are check, check the select all checkbox. Uncheck also as needed.
				if( $("#current_home input[type=checkbox]").size() == $('#current_home input:checked').size() ) {
					$('#current_container .select_all').attr("checked", true);
				} else {
					$('#current_container .select_all').attr("checked", false);
				}
			});
			
			$('#current_container .select_all').click( function() {
				if( $(this).is(":checked") ) {
					$('#current_container .edit').attr("disabled", false);
					$('#current_container .remove_and_archive').attr("disabled", false);
					$('#current_container .delete').attr("disabled", false);
					$("#current_home input[type=checkbox]").each( function() {
						$(this).attr("checked", true);
						$(this).parents(".single_img_container").find(".image_details_container").addClass("yellow_highlighter").addClass("yellow_highlighter_img_details");
						
					});
				} else {
					$('#current_container .edit').attr("disabled", true);
					$('#current_container .remove_and_archive').attr("disabled", true);
					$('#current_container .delete').attr("disabled", true);
					$("#current_home input[type=checkbox]").each( function() { 
						$(this).attr("checked", false);
						$(this).parents(".single_img_container").find(".image_details_container").removeClass("yellow_highlighter").removeClass("yellow_highlighter_img_details");
						
					});
				}
			});
        });
        

        </script>
		<div class="cookie_crumb"><p><a href="">Edit</a> &gt; Current banner photos</p></div>
        
		<div id="current_container" class="edit_tool_content">
        
            <div class="edit_toolbar">
            	<input type="checkbox" value="select_all" name="select_all" class="select_all" />
                <input type="button" value="Edit" name="edit" class="edit" disabled="disabled" />
                <input type="button" value="Remove & Archive" name="remove_and_archive" class="remove_and_archive" disabled="disabled" />
                <input type="button" value="Delete" name="delete" class="delete" disabled="disabled" />
                <label for="upload_image">Add new:</label>
                <input type="button" value="Upload Image" name="uplaad_image" class="upload_image" />
                <span class="edit_buttons hidden">
                    <label for="saved"></label>
                    <input type="button" value="Save" name="save" class="save" id="save" disabled="disabled" />
                    <Input type="button" value="Done" name="done" class="done" />
                </span>
            </div>
<?php
	  /**
	   * Images that are scheduled to display now
	   */
	  $query = "SELECT title as photographer, banner_slide_id as id, filename, forever, start_date, DATE_FORMAT(start_date,'%m/%e/%Y') as startDate, end_date, DATE_FORMAT(end_date,'%m/%e/%Y') as endDate FROM banner_slides WHERE approved=1 AND archived=0 AND (forever=1 OR (start_date <= NOW() && end_date >= NOW()))";
	  $select = mysql_query($query) or die("SELECT for banner images marked to display failed");
?>
			<div id="current_home">
            <div class="section_divider">Displaying now</div>
<?php
	if( mysql_num_rows($select) != 0 ) {
	  while($row = mysql_fetch_array( $select )) {
	    echo '<div class="single_img_container"><img src="';
	    	bloginfo('stylesheet_directory');
	    echo '/thumbs/'.$row["filename"].'" /><div class="checkbox_container"><input type="checkbox" id="'.$row['id'].'" /></div><div class="image_details_container"><p style="float: left; width:230px;" class="filename"><strong>'.$row["filename"].'</strong></p><p style="float: left; width:230px;">Displaying</p>';
		echo ($row["forever"]) ? '<p style="float: left; width: 230px;">Always showing.</p></div>' : '<p style="float:left; width:105px;">Start: '.$row['startDate'].'</p><p style="float:left;">End: '.$row['endDate'].'</p></div>';
		echo '<input type="hidden" value="'.$row['photographer'].'" name="photographer" />';
		echo '<input type="hidden" value="'.$row['forever'].'" name="forever" />';
		echo '<input type="hidden" value="'.$row['start_date'].'" name="start_date" />';
		echo '<input type="hidden" value="'.$row['end_date'].'" name="end_date" />';
		echo '</div>';
	  }
	 } else { echo '<div style="width: 550px; float: left;"><div class="no_images">No images are currently displaying :-p</div></div>'; }
	 
	  /**
	   * Images that are scheduled to display in the future
	   */
	  $query = "SELECT title as photographer, banner_slide_id as id, filename, forever, start_date, DATE_FORMAT(start_date,'%m/%e/%Y') as startDate, end_date, DATE_FORMAT(end_date,'%m/%e/%Y') as endDate FROM banner_slides WHERE approved=1 AND archived=0 AND forever=0 AND (start_date > NOW() && end_date > NOW())";
	  $select = mysql_query($query) or die("SELECT for banner images marked to display in the future failed");
?>
			<div class="section_divider">Displaying in the future</div>
<?php
	if( mysql_num_rows($select) != 0 ) {
	  while($row = mysql_fetch_array( $select )) {
	    echo '<div class="single_img_container"><img src="';
	    	bloginfo('stylesheet_directory');
	    echo '/thumbs/'.$row["filename"].'" /><div class="checkbox_container"><input type="checkbox" id="'.$row['id'].'" /></div><div class="image_details_container"><p style="float: left; width:230px;" class="filename"><strong>'.$row["filename"].'</strong></p><p style="float: left; width:230px;">Displaying</p>';
		echo ($row["forever"]) ? '<p style="float: left; width: 230px;">Always showing.</p></div>' : '<p style="float:left; width:105px;">Start: '.$row['startDate'].'</p><p style="float:left;">End: '.$row['endDate'].'</p></div>';
		echo '<input type="hidden" value="'.$row['photographer'].'" name="photographer" />';
		echo '<input type="hidden" value="'.$row['forever'].'" name="forever" />';
		echo '<input type="hidden" value="'.$row['start_date'].'" name="start_date" />';
		echo '<input type="hidden" value="'.$row['end_date'].'" name="end_date" />';
		echo '</div>';
	  }
	 } else { echo '<div style="width: 550px; float: left;"><div class="no_images">No images are scheduled for future displaying :-p</div></div>'; }
?>
			</div>
            <div id="current_editor" class="hidden">
            	<div id="changes_saved_container"><div id="changes_saved_alert" class="hidden">Saved</div></div>
           		<div id="upload_container" style="margin-left:0px;">
                    <div class="header_box"><p>Update photo details</p></div>
                    <div class="details_box"></div>
				</div>
            </div>
            
		</div>
<?php
	break;
	
	case 'archive':
		global $current_user; 
		get_currentuserinfo();
?>
		<script type="text/javascript" language="javascript">

        $(document).ready(function() {
			$('#archive_container .make_current').click( function () {
				$('.cookie_crumb p').html('<a href="">Edit</a> &gt; <a href="?edit=archive">Add from archive</a> &gt; Add photo duration');
				$('#current_home').addClass("hidden");
				$('#current_editor').removeClass("hidden");
				$('#archive_container .select_all').attr("disabled", true);
				$('#archive_container .make_current').attr("disabled", true);
				$('#archive_container .delete').attr("disabled", true);
				$(".edit_buttons").removeClass("hidden");
				
				// Append form element for editing the duration of the selected banner images to make current.
				$(".details_box").append('<form id="photo_details">');					
				$("#current_home input:checked").each( function() {
					
					var thisID=$(this).attr("id");
					$(this).parents(".single_img_container").addClass("hidden");
					var src=$(this).parents(".single_img_container").find("img").attr("src");
					var filename=$(this).parents(".single_img_container").find(".filename strong").text();
					var photographer=$(this).parents(".single_img_container").find("input[name=photographer]").val();
					var forever=$(this).parents(".single_img_container").find("input[name=forever]").val();
					var start_date=$(this).parents(".single_img_container").find("input[name=start_date]").val();
					var end_date=$(this).parents(".single_img_container").find("input[name=end_date]").val();
					
					ajax_unarchive_photo(thisID);
							
					if( forever == 0 ) {
						var photo_elements;
						$("#photo_details").append(''
							+'<div id="photo-'+thisID+'" class="photo_edit photo_details">'
								+'<div class="filename_div"><a href="'+src+'" rel="banner_image" alt="'+filename+'" title="'+filename+'">'+filename+'</a></div>'
								+'<label for="title-'+thisID+'" id="photographer_lbl-'+thisID+'">Photographer: </label>'
								+'<span class="title">'+photographer+'</span>'
								+'<input type="hidden" class="title" name="title-'+thisID+'" id="title-'+thisID+'" value="'+photographer+'">'
								+'<span id="duration-'+thisID+'" class="duration_span">'
								+'<label for="start_date-'+thisID+'" class="duration_lbl">Duration</label>'
								+'<input type="text" id="start_date-'+thisID+'" name="start_date-'+thisID+'" value="'+convert_date(start_date)+'" size="9" /> '
								+'<label for="end_date">to</label> '
								+'<input type="text" id="end_date-'+thisID+'" name="end_date-'+thisID+'" value="'+convert_date(end_date)+'" size="9" />'
								+'</span>'
								+'<input type="checkbox" id="forever-'+thisID+'" name="forever-'+thisID+'>" />'
								+'<label for="forever-'+thisID+'">forever</label>'
							+'</div>');
							
						// Display date picker when start and end date fields are click
						$("#start_date-"+thisID).datepicker({inline: true});
						$("#end_date-"+thisID).datepicker({inline: true});
						
						// Check that the start and end date are a valid interval
						$("#start_date-"+thisID).focusout( function() {
							if( $(this).val() > $("#end_date-"+thisID).val() && $("#end_date-"+thisID).val() != "" ) {
								$(this).addClass("yellow_highlighter");
								$("#end_date-"+thisID).addClass("yellow_highlighter");
								$("#changes_saved_alert").html("The duration is invalid unless you discovered time travel!");
							} else {						
								var new_photographer=$("#title-"+thisID).val();
								var new_start_date=$("#start_date-"+thisID).val();
								var new_end_date=$("#end_date-"+thisID).val();
								var new_forever;
								var d = new Date();
								
								if($("#forever-"+thisID).attr("checked")) {new_forever=1;} else {new_forever=0;}
								
								// Update photo details in DB with AJAX
								ajax_update_photo_details(thisID, new_photographer, new_start_date, new_end_date, new_forever);
								
								$("#changes_saved_alert").html("Saved "+ d.getMonth() +"/"+ d.getDate() +"/"+ d.getFullYear() +" "+ convert24To12Clock( d.getHours() ) +":"+ padNumber( d.getMinutes() ) +":"+ padNumber( d.getSeconds() ) +" "+ getAMPM( d.getHours() ) +" by <?php echo $current_user->display_name; ?>");
								$("#changes_saved_alert").fadeIn(100).delay(2000).fadeOut(100);
							}
						});
						$("#end_date-"+thisID).focusout( function() {
							if( $(this).val() < $("#start_date-"+thisID).val() && $("#start_date-"+thisID).val() != "" ) {
								$(this).addClass("yellow_highlighter");
								$("#start_date-"+thisID).addClass("yellow_highlighter");
								$("#changes_saved_alert").html("The duration is invalid unless you discovered time travel!");
							} else {						
								var new_photographer=$("#title-"+thisID).val();
								var new_start_date=$("#start_date-"+thisID).val();
								var new_end_date=$("#end_date-"+thisID).val();
								var new_forever;
								var d = new Date();
								
								if($("#forever-"+thisID).attr("checked")) {new_forever=1;} else {new_forever=0;}
								
								// Update photo details in DB with AJAX
								ajax_update_photo_details(thisID, new_photographer, new_start_date, new_end_date, new_forever);
								
								$("#changes_saved_alert").html("Saved "+ d.getMonth() +"/"+ d.getDate() +"/"+ d.getFullYear() +" "+ convert24To12Clock( d.getHours() ) +":"+ padNumber( d.getMinutes() ) +":"+ padNumber( d.getSeconds() ) +" "+ getAMPM( d.getHours() ) +" by <?php echo $current_user->display_name; ?>");
								$("#changes_saved_alert").fadeIn(100).delay(2000).fadeOut(100);
							}
						});
						
						$("#forever-"+thisID).click( function() {
							var new_photographer=$("#title-"+thisID).val();
							var new_start_date=$("#start_date-"+thisID).val();
							var new_end_date=$("#end_date-"+thisID).val();
							var new_forever;
							var d = new Date();
							
							if( $(this).attr("checked") ) {
								new_forever=1;
								$("#duration-"+thisID).fadeOut(100);
							} else {
								new_forever=0;
								$("#duration-"+thisID).fadeIn(100);
							}
							
							// Update photo details in DB with AJAX
							ajax_update_photo_details(thisID, new_photographer, new_start_date, new_end_date, new_forever);
							
							$("#changes_saved_alert").html("Saved "+ d.getMonth() +"/"+ d.getDate() +"/"+ d.getFullYear() +" "+ convert24To12Clock( d.getHours() ) +":"+ padNumber( d.getMinutes() ) +":"+ padNumber( d.getSeconds() ) +" "+ getAMPM( d.getHours() ) +" by <?php echo $current_user->display_name; ?>");
							$("#changes_saved_alert").fadeIn(100).delay(2000).fadeOut(100);
						});
						$("a[rel='banner_image']").colorbox({width:400, transition:"fade"});
						
						// A little css view formatting
						$("#photographer-lbl-"+thisID).addClass("photographer_lbl");
					} else {
						$("#photo_details").append(''
							+'<div id="photo-'+thisID+'" class="photo_edit photo_details">'
								+'<div class="filename_div"><a href="'+src+'" rel="banner_image" alt="'+filename+'" title="'+filename+'">'+filename+'</a></div>'
								+'<label for="title-'+thisID+'" id="photographer_lbl-'+thisID+'">Photographer: </label>'
								+'<span class="title">'+photographer+'</span>'
								+'<input type="hidden" class="title" name="title-'+thisID+'" id="title-'+thisID+'" value="'+photographer+'">'
								+'<span id="duration-'+thisID+'" style="display: none;" class="duration_span">'
								+'<label for="start_date-'+thisID+'" class="duration_lbl">Duration</label>'
								+'<input type="text" id="start_date-'+thisID+'" name="start_date-'+thisID+'" value="'+convert_date(start_date)+'" size="9" /> '
								+'<label for="end_date">to</label> '
								+'<input type="text" id="end_date-'+thisID+'" name="end_date-'+thisID+'" value="'+convert_date(end_date)+'" size="9" />'
								+'</span>'
								+'<input type="checkbox" id="forever-'+thisID+'" name="forever-'+thisID+'>" checked="checked" />'
								+'<label for="forever-'+thisID+'">forever</label>'
							+'</div>');
						
						// Display date picker when start and end date fields are click
						$("#start_date-"+thisID).datepicker({inline: true});
						$("#end_date-"+thisID).datepicker({inline: true});
						
						// Check that the start and end date are a valid interval
						$("#start_date-"+thisID).focusout( function() {
							if( $(this).val() > $("#end_date-"+thisID).val() && $("#end_date-"+thisID).val() != "" ) {
								$(this).addClass("yellow_highlighter");
								$("#end_date-"+thisID).addClass("yellow_highlighter");
								$("#changes_saved_alert").html("The duration is invalid unless you discovered time travel!");
							} else {						
								var new_photographer=$("#title-"+thisID).val();
								var new_start_date=$("#start_date-"+thisID).val();
								var new_end_date=$("#end_date-"+thisID).val();
								var new_forever;
								var d = new Date();
								
								if($("#forever-"+thisID).attr("checked")) {new_forever=1;} else {new_forever=0;}
								
								// Update photo details in DB with AJAX
								ajax_update_photo_details(thisID, new_photographer, new_start_date, new_end_date, new_forever);
								$("#changes_saved_alert").html("Saved "+ d.getMonth() +"/"+ d.getDate() +"/"+ d.getFullYear() +" "+ convert24To12Clock( d.getHours() ) +":"+ padNumber( d.getMinutes() ) +":"+ padNumber( d.getSeconds() ) +" "+ getAMPM( d.getHours() ) +" by <?php echo $current_user->display_name; ?>");
								$("#changes_saved_alert").fadeIn(100).delay(2000).fadeOut(100);
							}
						});
						$("#end_date-"+thisID).focusout( function() {
							if( $(this).val() < $("#start_date-"+thisID).val() && $("#start_date-"+thisID).val() != "" ) {
								$(this).addClass("yellow_highlighter");
								$("#start_date-"+thisID).addClass("yellow_highlighter");
								$("#changes_saved_alert").html("The duration is invalid unless you discovered time travel!");
							} else {						
								var new_photographer=$("#title-"+thisID).val();
								var new_start_date=$("#start_date-"+thisID).val();
								var new_end_date=$("#end_date-"+thisID).val();
								var new_forever;
								var d = new Date();
								
								if($("#forever-"+thisID).attr("checked")) {new_forever=1;} else {new_forever=0;}
								
								// Update photo details in DB with AJAX
								ajax_update_photo_details(thisID, new_photographer, new_start_date, new_end_date, new_forever);
								
								$("#changes_saved_alert").html("Saved "+ d.getMonth() +"/"+ d.getDate() +"/"+ d.getFullYear() +" "+ convert24To12Clock( d.getHours() ) +":"+ padNumber( d.getMinutes() ) +":"+ padNumber( d.getSeconds() ) +" "+ getAMPM( d.getHours() ) +" by <?php echo $current_user->display_name; ?>");
								$("#changes_saved_alert").fadeIn(100).delay(2000).fadeOut(100);
							}
						});
						
						$("#forever-"+thisID).click( function() {
							var new_photographer=$("#title-"+thisID).val();
							var new_start_date=$("#start_date-"+thisID).val();
							var new_end_date=$("#end_date-"+thisID).val();
							var new_forever;
							var d = new Date();
							
							if( $(this).attr("checked") ) {
								new_forever=1;
								$("#duration-"+thisID).fadeOut(100);
							} else {
								new_forever=0;
								$("#duration-"+thisID).fadeIn(100);
							}
							
							// Update photo details in DB with AJAX
							ajax_update_photo_details(thisID, new_photographer, new_start_date, new_end_date, new_forever);
							
							$("#changes_saved_alert").html("Saved "+ d.getMonth() +"/"+ d.getDate() +"/"+ d.getFullYear() +" "+ convert24To12Clock( d.getHours() ) +":"+ padNumber( d.getMinutes() ) +":"+ padNumber( d.getSeconds() ) +" "+ getAMPM( d.getHours() ) +" by <?php echo $current_user->display_name; ?>");
							$("#changes_saved_alert").fadeIn(100).delay(2000).fadeOut(100);
						});
						$("a[rel='banner_image']").colorbox({width:400, transition:"fade"});
						
						// A little css view formatting
						$("#photographer-lbl-"+thisID).addClass("photographer_lbl");
					}
				});
			});
			$(".details_box").append('</form>');
			
			$("#current_home input[type=checkbox]").click(function() {
			   	// If a checkbox is check for a banner image make appropriate edit buttons enabled.
			   	if( $(this).is(":checked") ) {
					$('#archive_container .make_current').attr("disabled", false);
					$('#archive_container .delete').attr("disabled", false);
					$(this).parents(".single_img_container").children(".image_details_container").addClass("yellow_highlighter").addClass("yellow_highlighter_img_details");
				}
				else { 
					if( $('#current_home input:checked').size() == 0 ) {
						$('#archive_container .make_current').attr("disabled", true);
						$('#archive_container .delete').attr("disabled", true);
					}
					
					$(this).parents(".single_img_container").children(".image_details_container").removeClass("yellow_highlighter").removeClass("yellow_highlighter_img_details");
				}
				
				// If all checkbox are check, check the select all checkbox. Uncheck also as needed.
				if( $("#current_home input[type=checkbox]").size() == $('#current_home input:checked').size() ) {
					$('#archive_container .select_all').attr("checked", true);
				} else {
					$('#archive_container .select_all').attr("checked", false);
				} 
			});
			
			/*
			 * Disable select all check box if not images are currently in the archive
			 */
			if( $("#current_home input[type=checkbox]").size() == 0 ) $('#archive_container .select_all').attr("disabled", true);
			
			/*
			 * Click handler for each displayed archive image
			 * - When image is click check the corresponding checkbox and add yellow highlight
			 */
			$('#archive_container img').click(function () {
				var cbox = $(this).parent().find("input[type=checkbox]");
				if( cbox.is(":checked") ) {
					cbox.attr("checked",false);
					if( cbox.parents('#current_home').find("input:checked").size() == 0 ) {
						cbox.parents('#archive_container').find(".make_current").attr("disabled", true);
						cbox.parents('#archive_container').find(".delete").attr("disabled", true);
					}
						
					$(this).parents(".single_img_container").children(".image_details_container").removeClass("yellow_highlighter").removeClass("yellow_highlighter_img_details");
				} else {
					cbox.attr("checked",true);
					cbox.parents('#archive_container').find(".make_current").attr("disabled", false);
					cbox.parents('#archive_container').find(".delete").attr("disabled", false);
					cbox.parents(".single_img_container").children(".image_details_container").addClass("yellow_highlighter").addClass("yellow_highlighter_img_details");
				}
				
				// If all checkbox are check, check the select all checkbox. Uncheck also as needed.
				if( $("#current_home input[type=checkbox]").size() == $('#current_home input:checked').size() ) {
					$('#archive_container .select_all').attr("checked", true);
				} else {
					$('#archive_container .select_all').attr("checked", false);
				}
			});
			
			/*
			 * Delete button handler - deletes the selected image file(s) and detail(s) from mysql database 
			 */
			$('#archive_container .delete').click( function () {
				if(confirm("This action is permanent. Are you sure you want to do this?")){
					$("#current_home input:checked").each( function() {
						
						var thisID=$(this).attr("id");
						var filename=$(this).parents(".single_img_container").find(".filename strong").text();
						
						// Disable the edit buttons
						$('#archive_container .make_current').attr("disabled", true);
						$('#archive_container .delete').attr("disabled", true);
						
						// Uncheck select all for save measure
						$('#archive_container .select_all').attr("checked", false);
					
						ajax_delete_photo("../banner_images",filename);
						ajax_delete_photo("../thumbs",filename);
						ajax_delete_photo_from_db(thisID);
						$(this).parents(".single_img_container").fadeOut(300, function() { $(this).remove()});
					});
				}
			});
			
			/*
			 * Done Button click handler - reloads the current webpage
			 */
			$(".done").click( function () {
				window.location = "<? CurrentPageURL(); ?>";
			});
					
			$('#archive_container .cancel').click( function () {
				$(".photo_details").each( function() {
					
					var thisID=($(this).attr("id").split("-"))[1];
					
					// Disable the edit buttons
					$('#archive_container .select_all').attr("disabled", false);
					$('#archive_container .select_all').attr("checked", false);
					$('#archive_container .make_current').attr("disabled", true);
					$('#archive_container .delete').attr("disabled", true);
						
					ajax_archive_photo(thisID);
					
					$('.edit_buttons').addClass("hidden");
					$('.details_box').empty();
					$('#current_home').removeClass("hidden");
					$('#current_editor').addClass("hidden");
					$("#current_home input[type=checkbox]").each( function() {
						$(this).parents(".single_img_container").removeClass("hidden");
						if( $(this).attr("checked") ) {
							$(this).attr("checked", false);
							$(this).parents(".single_img_container").find(".image_details_container").removeClass("yellow_highlighter").removeClass("yellow_highlighter_img_details");
						}
					});
					$('.cookie_crumb p').html('<a href="">Edit</a> &gt; <a href="?edit=archive">Add from archive</a>');
				});
			});
			
			$('#archive_container .select_all').click( function() {
				if( $(this).is(":checked") ) {
					$('#archive_container .make_current').attr("disabled", false);
					$('#archive_container .delete').attr("disabled", false);
					$("#current_home input[type=checkbox]").each( function() {
						$(this).attr("checked", true);
						$(this).parents(".single_img_container").find(".image_details_container").addClass("yellow_highlighter").addClass("yellow_highlighter_img_details");
						
					});
				} else {
					$('#archive_container .make_current').attr("disabled", true);
					$('#archive_container .delete').attr("disabled", true);
					$("#current_home input[type=checkbox]").each( function() { 
						$(this).attr("checked", false);
						$(this).parents(".single_img_container").find(".image_details_container").removeClass("yellow_highlighter").removeClass("yellow_highlighter_img_details");
						
					});
				}
			});
			
        });
        
        </script>
		<div class="cookie_crumb"><p><a href="">Edit</a> &gt; <a href="?edit=archive">Add from archive</a></p></div>
        
        <div id="archive_container" class="edit_tool_content">
            <div class="edit_toolbar">
                <input type="checkbox" value="select_all" name="select_all" class="select_all" />
                <input type="button" value="Make current" name="make_current" class="make_current" disabled="disabled" />
                <input type="button" value="Delete" name="delete" class="delete" disabled="disabled" />
                <span class="edit_buttons hidden">
                    <label for="saved"></label>
                    <input type="button" value="Save" name="save" class="save" id="save" disabled="disabled" />
                    <Input type="button" value="Done" name="done" class="done" />
                    <input type="button" value="Cancel" name="cancel" class="cancel" />
                </span>
            </div>
            
<?php
		$query = "SELECT title as photographer, banner_slide_id as id, filename, forever, start_date, DATE_FORMAT(start_date,'%m/%e/%Y') as startDate, end_date, DATE_FORMAT(end_date,'%m/%e/%Y') as endDate FROM banner_slides WHERE approved=1 AND archived=1";
		$select = mysql_query($query) or die("SELECT for banner images marked as archived failed");
?>
			<div id="current_home">
<?php
	  if( mysql_num_rows($select) != 0 ) {
		  while($row = mysql_fetch_array( $select )) {
			echo '<div class="single_img_container"><img src="';
				bloginfo('stylesheet_directory');
			echo '/thumbs/'.$row["filename"].'" /><div class="checkbox_container"><input type="checkbox" id="'.$row['id'].'" /></div><div class="image_details_container"><p style="float: left; width:230px;" class="filename"><strong>'.$row["filename"].'</strong></p><p style="float: left; width:230px;">Displaying</p>';
			echo ($row["forever"]) ? '<p style="float: left; width: 230px;">Always showing.</p></div>' : '<p style="float:left; width:105px;">Start: '.$row['startDate'].'</p><p style="float:left;">End: '.$row['endDate'].'</p></div>';
			echo '<input type="hidden" value="'.$row['photographer'].'" name="photographer" />';
			echo '<input type="hidden" value="'.$row['forever'].'" name="forever" />';
			echo '<input type="hidden" value="'.$row['start_date'].'" name="start_date" />';
			echo '<input type="hidden" value="'.$row['end_date'].'" name="end_date" />';
			echo '</div>';
		  }
	  } else { echo '<div class="no_images">Currently there are no banner images archived :-p</div>'; }
?>
			</div>
            
            <div id="current_editor" class="hidden">
            	<div id="changes_saved_container"><div id="changes_saved_alert" class="hidden">Saved</div></div>
           		<div id="upload_container" style="margin-left:0px; margin-top:0px;">
                    <div class="header_box"><p>Add photo display duration</p></div>
                    <div class="details_box"></div>
				</div>
            </div>
		</div>
<?php
        
	break;
	
	default:
	break;
?>
<?php } ?> 	
	</div>
</body>
</html>

<?php 
}

function convert_date($d) {
  list($day, $month, $year) = explode("/", $d);
  return $year . "-" . $day . "-" . $month . " " . date("h:i:s");
}


?>
