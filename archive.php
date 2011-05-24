<?php
/**
 * @package WordPress
 * @subpackage Charlotte_DanceSport_Theme
 */

get_header(); ?>

	<div id="content" class="narrowcolumn" role="main">
<!--    <div class="gallery">
        <a href="<?php //bloginfo('stylesheet_directory'); ?>/img/cds-logo-login.png" title="CDS Logo" class="thickbox cboxelement" rel="cds-logo"><img src="<?php //bloginfo('stylesheet_directory'); ?>/img/cds-logo-login.png" alt="CDS Logo" title="CDS Logo"></a>
    </div>-->
	<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>
        	<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
            	<div class="post_details">
                	<div class="post_details_wrapper">
                        <div class="date_wrapper">
                            <div class="post_day"><?php the_time('j') ?></div>
                            <div class="month_day_wrapper">
                                <div class="post_month"><?php the_time('M') ?></div>
                                <div class="post_year"><?php the_time('Y') ?></div>
                            </div>
                        </div>
                        <div>
                            <p class="post_by">Posted by:</p>
                            <p class="post_author"><?php the_author();	 ?></p>
                            <p class="post_comments"><?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></p>
                        </div>
                    </div>
                </div>
                <div class="white_left_arrow"></div>
                <div class="entry">
                	<div class="entry_wrapper">
                    <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
					<?php the_content('Read more... &raquo;'); ?>
                    </div>
				</div>
            </div>

<!--
			<div <?php /*post_class() ?> id="post-<?php the_ID(); ?>">
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				<small><?php the_time('F jS, Y') ?> <!-- by <?php the_author() ?> --></small>

				<div class="entry">
					<?php the_content('Read the rest of this entry &raquo;'); ?>
				</div>

				<p class="postmetadata"><?php the_tags('Tags: ', ', ', '<br />'); ?> Posted in <?php the_category(', ') ?> | <?php edit_post_link('Edit', '', ' | '); ?>  <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); */ ?></p>
			</div>
-->

		<?php endwhile; ?>

		<div class="navigation">
			<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
			<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
		</div>

	<?php else : ?>

<!--		<h2 class="center">Not Found</h2>
		<p class="center">Sorry, but you are looking for something that isn't here.</p>
 -->
		<?php //get_search_form(); ?>

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
    
	<?php endif; ?>

	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
