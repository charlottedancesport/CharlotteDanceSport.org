<?php
/**
 * @package WordPress
 * @subpackage Charlotte_DanceSport_Theme
 */
get_header();
?>
	<script type="text/javascript">
    $(document).ready( function() {
        $('.type-page').remove();
        
        /**
         * If flash is not installed display non flash version of tags and categories, 
         * else if Flash is installed & the search return no results display the 
         * tags + categories cloud.
         */
        if (navigator.mimeTypes ["application/x-shockwave-flash"] == undefined) {
            $("#flash_tag_list").remove();
        } else {
            $("#no_flash_tag_list").remove();
        }
    });
    </script>

	<div id="content" class="narrowcolumn">
        
		<div style="margin:40px auto auto 60px;">
            <h2 class="no_posts_found">Oopsy! I can't find the webpage you're looking for :(<br />Did you mistype a letter or two?</h2>
            
            <h2 class="select_tag_cat">Try selecting a category or tag to view posts that are related.</h2>
            <ul id="no_flash_tag_list">
            <?php wp_list_categories('show_count=1&title_li=<h2>Categories</h2>'); ?>
                <li class="tag_cloud">
                <h2>Tags &amp; Categories Cloud</h2>
                    <ul>
            <?php 
                //$args = array('taxonomy' => array('post_tag','category')); 
    
                $tag = wp_tag_cloud( 'format=array' );
                
                foreach ($tag as $t) {
                    echo '<li>'.$t.'</li>';
                }
            ?>
                    </ul>
                </li>
            </ul>
            
            <ul id="flash_tag_list">
                <li>
            <?php wp_cumulus_insert(); ?>
                </li>
            </ul>

		</div>
	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>