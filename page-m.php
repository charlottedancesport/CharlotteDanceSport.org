<?php
/**
 * @package WordPress
 * @subpackage Charlotte_DanceSport_Theme
 */
?>

<!-- Display iPhone Web2.0 Application for Charlotte DanceSport! -->
<!--=============================================================-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
	<head profile="http://gmpg.org/xfn/11">
		<meta content="yes" name="apple-mobile-web-app-capable" />
		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
		<meta content="minimum-scale=1.0, width=device-width, maximum-scale=0.6667, user-scalable=no" name="viewport" />
		<link href="<?php bloginfo('stylesheet_directory'); ?>/css/style.css" rel="stylesheet" type="text/css" />
		<script src="<?php bloginfo('stylesheet_directory'); ?>/javascript/functions.js" type="text/javascript"></script>
		<link rel="apple-touch-icon" href="<?php bloginfo('stylesheet_directory'); ?>/homescreen.png"/>
		<link href="<?php bloginfo('stylesheet_directory'); ?>/startup.png" rel="apple-touch-startup-image" />	
		<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
	</head>
	<body>
		<div id="topbar">
			<div id="title">CDS iPhone Web 2.0 Test - "Hello World :->"</div>
		</div>
		<form method="post">
			<div id="content">
		<ul class="pageitem">
			<li class="bigfield"><input placeholder="Name" name="name" type="text" /></li>
			<li class="bigfield">
			<input placeholder="Password" name="passw" type="password" /></li>
		</ul>
				<span class="graytitle">Gender</span>
				<ul class="pageitem">
					<li class="radiobutton">
						<span class="name">Male</span>
						<input name="gender" type="radio" value="M" />
					</li>
					<li class="radiobutton">
						<span class="name">Female</span>
						<input name="gender" type="radio" value="F" />
					</li>
				</ul>
				<span class="graytitle">Favorite Foods</span>
				<ul class="pageitem">
					<li class="checkbox">
						<span class="name">Steak</span>
						<input name="steak" type="checkbox" />
					</li>
					<li class="checkbox">
						<span class="name">Pizza</span>
						<input name="pizza" type="checkbox" />
					</li>
					<li class="checkbox">
						<span class="name">Chicken</span>
						<input name="chicken" type="checkbox" />
					</li>
				</ul>
				<ul class="pageitem">
				<li class="textbox">
				<textarea name="quote" rows="5" cols="15">Enter your favorite quote!</textarea>
				</li>
				</ul>
				<span class="graytitle">Level of Education</span>
				<ul class="pageitem">
				<li class="select">
				<select name="education">
				<option value="Jr.High">Jr.High</option>
				<option value="HighSchool">HighSchool</option>
				<option value="College">College</option>
				</select>
				<span class="arrow"></ span>
				</li>
				</ul>
				<ul class="pageitem">				
							<li class="button">
			<input name="Submit" type="submit" value="Submit" />
			</li>
			</ul>
			</div>
			<div id="footer">
	<a href="http://iwebkit.net">Powered by iWebKit</a>
	</div>
	</body>
</html>
