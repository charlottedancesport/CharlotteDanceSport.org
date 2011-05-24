<html>
<head>
<meta content="yes" name="apple-mobile-web-app-capable" />
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta content="minimum-scale=1.0, width=device-width, maximum-scale=0.6667, user-scalable=no" name="viewport" />
<link href="<?php bloginfo('stylesheet_directory'); ?>/css/style-mobile.css" rel="stylesheet" type="text/css" />
<link rel="apple-touch-icon" href="<?php bloginfo('stylesheet_directory'); ?>/img/homescreen.png"/>
<link href="<?php bloginfo('stylesheet_directory'); ?>/startup.png" rel="apple-touch-startup-image" />
<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
	google.load("jquery", "1.4.2");
</script>
<script src="<?php bloginfo('stylesheet_directory'); ?>/js/functions-mobile.js" type="text/javascript"></script>
</head>
<body>
<div id="header">
	<div>Charlotte DanceSport</div>
    <ul>
    	<li><span>News</span></li>
        <li><a href="<?php thisURL(); ?>/m/cal/">Calendar</a></li>
        <li><a href="<?php thisURL(); ?>/m/photos/">Photos</a></li>
        <li><a href="#">more</a></li>
    </ul>
    <div><span><a href="<?php thisURL(); ?>/m/">Home</a></span></div>
</div>
<div id="content">
	
</div>
        <div id="footer">
	    <p>View CDS in <b>Mobile</b> | <a href="">Desktop</a></p>
            <p>&copy; 2010 Charlotte DanceSport</p>
            <p>d/b/a/ 49er Social &amp; Ballroom Dance Club</p>
            <p>@ UNC-Charlotte</p>
        </div>
</body>
</html>
