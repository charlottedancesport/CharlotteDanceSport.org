<?php
/**
 * @package WordPress
 * @subpackage Charlotte_DanceSport_Theme
 */
?>
  
    <div id="footer">
        <div id="credits">
            <p>
                Powered by
                <a href="<? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://wordpress.org/" target="_blank"><span class="notranslate">WordPress</span></a>
                
                <!--<br /><a href="<?php //bloginfo('rss2_url'); ?>">Entries (RSS)</a>
                and <a href="<?php // bloginfo('comments_rss2_url'); ?>">Comments (RSS)</a>.
                 <?php //echo get_num_queries(); ?> queries. <?php //timer_stop(1); ?> seconds. -->
            </p>
            <p>&copy; Copyright 2010 <span class="notranslate">Charlotte DanceSport</span></p>
            <p>d/b/a/ 49er Social &amp; Ballroom Dance Club</p>
            <p><span class="notranslate">@ UNC-Charlotte</span></p>
            <p>Banner photos courteous of Linara Axanova</p>
            <p>All rights reserved.</p>
            <p><a href="<?php bloginfo('stylesheet_directory'); ?>/privacy/">Privacy</a> | <a class="contactus cboxElement" href="<?php bloginfo('stylesheet_directory'); ?>/send_email.php">Contact Us</a></p>
        </div>
    </div>
    <div id="jsSourceFinal" style="display:none;"></div>
</div>

<?php wp_footer(); ?>

</body>
</html>