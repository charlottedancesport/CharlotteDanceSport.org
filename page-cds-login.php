<?php
/**
 * @package WordPress
 * @subpackage Charlotte_DanceSport_Theme
 */
 
/* For SSL sercurity for login always */
if ( !isset($_SERVER['HTTPS']) ) { header( "Location: https://".$_SERVER['HTTP_HOST']."/cds-login/" ); }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "<? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="<? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="<? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/js/colorbox/colorbox.css<? echo ($Safari || $IE5 || $IE6) ? "" : ".gz"; ?>" type="text/css" media="screen" />
<style type="text/css">
body {
    color: #333333;
    font-family: 'Lucida Grande',Verdana,Arial,Sans-Serif;
    font-size: 62.5%;
}
#login_container h1{
	padding-top:0px;
	}
#login_container h1 a{
	background: transparent url('<?php bloginfo('stylesheet_directory'); ?>/img/cds-logo-login.png') no-repeat top center;
	width:326px;
	height:67px;
	text-indent:-9999px;
	overflow:hidden;
	padding-bottom:15px;
	display:block;
	}	
#login_container{
	width:350px;
	vertical-align: middle;
	text-align: center;
	padding-left:15px;
}

#LoginWithAjax_Remember{
	padding-top: 20px;
	padding-left: 25px;
	width:295px;
	}

</style>
<!--[if gte IE 5]>
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/js/colorbox/colorbox-IE.css<? echo ($Safari || $IE5 || $IE6) ? "" : ".gz"; ?>"  type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/style-IE.css<? echo ($Safari || $IE5 || $IE6) ? "" : ".gz"; ?>" type="text/css" media="screen" />
<![endif]-->
<link rel="icon" type="image/png" href="<?php bloginfo('stylesheet_directory'); ?>/img/favicon.png" />
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
	google.load("jquery", "1.5.0");
</script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/colorbox/jquery.colorbox-min.js<? echo ($Safari || $IE5 || $IE6) ? "" : ".gz"; ?>"></script>
<script>
$(document).ready( function() {
	$('#lwa_user_login').focus();
	$('#LoginWithAjax_Links_Remember').click( function() {
		window.top.location.href="<?php echo thisURL(); ?>/wp-login.php?action=lostpassword"
	});
	/*
	 * Extra login form check.  If the form is submitted empty return a message to the user
	 */
	$('#lwa_wp-submit').submit( function () {
		if ($('#lwa_user_login').val() === "" && $('#lwa_user_pass').val() === "") {
			$('#LoginWithAjax_Status').text("Please enter your e-mail and password.");
		}
	});

});
</script>
<?php wp_head(); ?>
</head>
<body style="background:#fff;">
<div>
	<div id="lightboxLogin">
    	<div id="login_container">
    	<h1><a href="<?php echo thisURL(); ?>" title="Charlotte DanceSport Log In">Charlotte DanceSport</a></h1>
		<?php login_with_ajax(); ?>
        </div>
    </div>
</div>
</body>
</html>
