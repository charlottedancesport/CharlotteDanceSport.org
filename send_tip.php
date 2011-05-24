<?php
/**
 * @package WordPress
 * @subpackage Charlotte_DanceSport_Theme
 */
 
// Get User IP Address
function visitorIP() { 
	if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
		$TheIP=$_SERVER['HTTP_X_FORWARDED_FOR'];
	else $TheIP=$_SERVER['REMOTE_ADDR'];
	
	return trim($TheIP);
}


// Contact Form Email Sender
function post_email_to_cds_officer ($senders_name, $senders_email, $message_topic, $message, $city, $country, $country_code, $region, $latitude, $longitude) {
    // append senders IP Address identification
	$senders_IP = visitorIP();
	$message .= "\n\n\n\n--\nThis message was posted from IP address ".$senders_IP.".";
	
	// append senders Country identification
	if(!empty($country) && $country != "Country") $message .= " (".$country;
	if(!empty($city) && $city != "City") $message .= " - ".$city;
	if(!empty($region) && $region != "Region") $message .= ", ".$region.")";
    if(!empty($latitude) && $latitude != "Latitude") $message .= "  lat: ".$latitude." long: ".$longitude;
	
	// email header details
    $headers = "From: $senders_email\n";
	$headers .= "X-Sender: <$senders_email>\n";
	$headers .= "X-Mailer: PHP/".phpversion()."\n";
	
	$message = "Topic: " . $message_topic . "\n\n" . $message;
	
	// Send the beautiful email :)
    $sendMail = mail("charlottedancesport+webform@gmail.com", "Charlotte DanceSport - Message from $senders_name", $message, $headers);
}

// Validate Email Format
function validEmail ($p_email) {
    if(eregi("^[a-z0-9\._-]+@+[a-z0-9\._-]+\.+[a-z]{2,3}$", $p_email)) {
        return TRUE;
    } else {
        return FALSE;
    }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "<? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="<? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Charlotte DanceSport - Dance Tip Suggestion Form</title>
<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
<script src="<? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://www.google.com/jsapi"></script>
<script>google.load("jquery", "1.5.0");// Load jQuery</script>
<script type="text/javascript" src="<?php $PHP_SELF ?>/wp-content/themes/charlotte_dancesport/js/jquery.abetterform.js"></script>
<script type="text/javascript">
function isEmpty( inputStr ) { if ( null === inputStr || "" === inputStr ) { return true; } return false; }

function ajax_email_validation(email)
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
if(httpxml.readyState==4)
{
	document.getElementById("contactus_form_alert_msg").innerHTML=httpxml.responseText;
	/*
	 * If the visitor enters an invalid email address
	 * highlight the form field pink and send focus
	 * to it. Else clear the highlight.
	 */
	if(!isEmpty(httpxml.responseText)){
		try{document.getElementById('senders_email').focus();}catch(e){}
		$(function(){
			$("#senders_email").css({'backgroundColor':'#F0D9D9', 'borderColor':'#E0B4B4'});
		});
	} else {
		$(function(){
			$("#senders_email").css({'backgroundColor':'', 'borderColor':'#CCCCCC'});
		});
	}
}
}
var url="ajax_helper/email_validator.php";
url=url+"?email="+email;
url=url+"&sid="+Math.random();
httpxml.onreadystatechange=stateck;
httpxml.open("GET",url,true);
httpxml.send(null);
}

function validate_contact_form(f){
	var error_message;
	var err = false;
	
	if (f.senders_name.value == "" || f.senders_email.value == "" || f.message.value == ""){
		error_message = "<span class=\"invalid\"><strong>ERROR</strong>: All fields are required!</span>";
		err = true;
	}
	if (!err){
		f.submit();
	} else {
		document.getElementById("contactus_form_alert_msg").innerHTML=error_message;

		try{document.getElementById('senders_name').focus();}catch(e){}
	}
}

/**
 * Set Dance Tip Message textarea character limite to 85.
 */
function limitText(limitField, limitCount, limitNum) {
	if (limitField.value.length > limitNum) {
		limitField.value = limitField.value.substring(0, limitNum);
	} else {
		limitCount.value = limitNum - limitField.value.length;
	}
}
	
/**
 * Creates the Contact Us form
 * Uses JQuery -A Better Form- library to convert hardcorded <div>'s to form elements.
 * Purpose: Fullproof agent to deter form submission SPAM generators
 */
jQuery(document).ready(function () {
	$("#TipSuggestion_Form").abform({
		attributes :'name="TipSuggestion_Form" id="TipSuggestion_Form" action="<?php $PHP_SELF; ?>" method="post"',
		convert :'{senders_name|text|style="width: 200px;height: 15px;border: 3px solid #ccc;padding: 5px;font-family: \'Trebuchet MS\', \'Lucida Grande\', Verdana, Arial, Sans-Serif; font-weight: bold; font-size: 13px;"}{senders_email|text|style="width: 200px;height: 15px;border: 3px solid #ccc;padding: 5px;font-family: \'Trebuchet MS\', \'Lucida Grande\', Verdana, Arial, Sans-Serif; font-weight: bold; font-size: 13px;" onblur="ajax_email_validation(this.value);"}{message|textarea|style="width: 320px;height: 65px;border: 3px solid #ccc;padding: 5px;font-family: \'Trebuchet MS\', \'Lucida Grande\', Verdana, Arial, Sans-Serif; font-weight: bold; font-size: 13px;" onKeyDown="limitText(this,document.getElementById(\'countdown\'),85);" onKeyUp="limitText(this,document.getElementById(\'countdown\'),85);"}{countdown|text| readonly="readonly" size="2" style="border:0px; text-align:right;"}{contact_submit|submit|class="contact_submit absubmit" onclick="validate_contact_form(document.TipSuggestion_Form);"}{myCity|hidden}{myCountry|hidden}{myCountryCode|hidden}{myRegion|hidden}{myLatitude|hidden}{myLongitude|hidden}'
	});

/**
 * Focus the cursor in the Your Name field
 */
	try{$("#senders_name").focus();}catch(e){}

/**
 * Set the clients location Detail (city, country, country code, region, lat & longitude) if available.
 */
	if (google.loader.ClientLocation) {
		if(google.loader.ClientLocation.address.city){
			$("#myCity").val(google.loader.ClientLocation.address.city);
		}
		if(google.loader.ClientLocation.address.country){
			$("#myCountry").val(google.loader.ClientLocation.address.country);
		
		}
		if(google.loader.ClientLocation.address.country_code){
			$("#myCountryCode").val(google.loader.ClientLocation.address.country_code);
		
		}
		if(google.loader.ClientLocation.address.region){
			$("#myRegion").val(google.loader.ClientLocation.address.region);
		
		}
		if(google.loader.ClientLocation.address.latitude){
			$("#myLatitude").val(google.loader.ClientLocation.address.latitude);
		
		}
		if(google.loader.ClientLocation.address.longitude){
			$("#myLongitude").val(google.loader.ClientLocation.address.longitude);
		
		}
	}

});

</script>
</head>

<body style="background:#fff;">
<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	if ($_POST['senders_name'] == '' || $_POST['senders_email'] == '' || $_POST['message'] == '') {
		// a required field was empty
		// reload page with error and saved values;
	} elseif (!validEmail($_POST['senders_email'])) {
		echo '<p>invalid Email</p>';
		// the email address was invalid
	} else { 
		// Present conformation that the message was posted.
?>
    
	<div id="contactus_form_reply">
        <span title="Contact Charlotte DanceSport">Charlotte DanceSport</span>
        <h2><?php echo $_POST['senders_name']; ?>,</h2>
        <p>Thanks for the tip suggestion. It has been sent successfully for moderation by a Charlotte DanceSport officer. An email will be sent to inform you of the tips final approval status. For now keep the dance floor warn!</p>
        <p>Sincerely,</p>
        <p>&nbsp;</p>
        <p>Charlotte DanceSport</p>
        <p><a href="#" onclick="parent.$.fn.colorbox.close();">Close</a></p>
    </div>
    
<?php
		post_email_to_cds_officer ($_POST['senders_name'], 
								   $_POST['senders_email'], 
								   'New dance tip suggestion',
								   $_POST['message'],
								   $_POST['myCity'],
								   $_POST['myCountry'],
								   $_POST['myCountryCode'],
								   $_POST['myRegion'],
								   $_POST['myLatitude'],
								   $_POST['myLongitude']);
	}
} else {
?>
    <div>
        <div id="contactus_form" title="Contact Charlotte DanceSport">
        <span class="cds_logo" title="Contact Charlotte DanceSport">Charlotte DanceSport</span>
        
        <div id="TipSuggestion_Form">
        	<div id="contactus_form_container">
                <div id="contactus_form_alert_msg">&nbsp;</div>
                <label>Your Name:</label>
                <div id="senders_name"></div>
                <label>Your Email:</label>
                <div id="senders_email"></div>
                <label>Dance Tip:</label>
                <div id="message"></div>
                <div style="width: 336px; text-align: right;">
                	<div id="countdown">85</div> characters left.
                </div>
                <div id="myCity">City</div>
                <div id="myCountry">Country</div>
                <div id="myCountryCode">Country Code</div>
                <div id="myRegion">Region</div>
                <div id="myLatitude">Latitude</div>
                <div id="myLongitude">Longitude</div>
                <div style="width:100%;">
                    <div id="contact_submit">Send</div>
                    <a href="#" onclick="parent.$.fn.colorbox.close();">Cancel</a>
                </div>
        	</div>
        </div>
 
        </div>
    </div>
<?php } ?>
</body>
</html>
