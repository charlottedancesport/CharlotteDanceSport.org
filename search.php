<?php
/**
 * @package WordPress
 * @subpackage Charlotte_DanceSport_Theme
 */

get_header(); ?>

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

	<div id="content" class="narrowcolumn" role="main">

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
                        	<p class="post_author_gavator_icon"><?php echo get_avatar( get_the_author_email(), '50' ); ?></p>
                            <p class="post_by">Posted by:</p>
                            <p class="post_author"><?php the_author(); ?></p>
                            <p class="post_comments"><?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></p>
                        </div>
                    </div>
                </div>
                <div class="white_left_arrow"></div>
                <div class="entry">
                	<div class="entry_wrapper">
                    <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
					<?php //the_content('Read more... &raquo;'); ?>
                    
                    <p class="postmetadata"><?php the_tags('Tags: ', ', ', '<br />'); ?> Posted in <?php the_category(', ') ?> | <?php edit_post_link('Edit', '', ' | '); ?>  <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></p>
                    
                    </div>
                    
				</div>
                
            </div>

<? /*
			<div <?php post_class() ?>>
				<h3 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
				<small><?php the_time('l, F jS, Y') ?></small>

				<p class="postmetadata"><?php the_tags('Tags: ', ', ', '<br />'); ?> Posted in <?php the_category(', ') ?> | <?php edit_post_link('Edit', '', ' | '); ?>  <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></p>
			</div>
*/ ?>
		<?php endwhile; ?>

	<?php else : ?>
		<div style="margin:40px auto auto 60px;">
            <h2 class="no_posts_found">No posts found. Try a different search?</h2>
            
            <h2 class="select_tag_cat">Select a category or tag to view posts that are related.</h2>
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
	<?php endif; ?>

	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
