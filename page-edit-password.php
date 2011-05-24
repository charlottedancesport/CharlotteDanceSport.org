<?php
/**
 * @package WordPress
 * @subpackage Charlotte_DanceSport_Theme
 */

if ( !is_user_logged_in() ) header("Location: http://" . $_SERVER['HTTP_HOST']);
if (!isset($_SERVER['HTTPS'])) header("Location: ".str_replace("http","https", CurrentPageURL()))
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "<? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="<? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="<? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="robots" content="noindex">
<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
<link rel="icon" type="image/png" href="<?php bloginfo('stylesheet_directory'); ?>/img/favicon.png" />

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
	google.load("jquery", "1.5.0");
</script>
</head>

<body>
	<div id="content" class="narrowcolumn" role="main">Your password has expired
	<label for="new_pwd">New password</label>
    <input type="password" id="new_pwd" />
    <label for="retype_new_pwd">Retype new password</label>
    <input type="password" id="retype_new_pwd" />
	</div>
</body>
</html>