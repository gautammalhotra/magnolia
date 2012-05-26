<div id="container">
<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header(); ?>








<div id="wrapper">
    <div id="wrappertop" class="clearfix">
      <div id="email">
          <form onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=IntelligrapeBlog', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true" target="popupwindow" method="post" action="http://feedburner.google.com/fb/a/mailverify">
           <label  class="screen-reader-text">Subscribe via E-Mail:</label>
            <input type="text" name="email" value="Email-Id" onfocus="if(this.value=='Email-Id')this.value='';"onblur="if(this.value=='')this.value='Email-Id';" style="width: 140px;" class="textbox">
            <input type="hidden" name="uri" value="IntelligrapeBlog">
            <input type="hidden" value="en_US" name="loc">
            <input type="submit" value="Subscribe" class="button">
          </form>
      </div>
      <div id="search">
        <form action="/blog/" id="searchform" method="get" role="search">
            <label class="screen-reader-text">Search for:</label>
            <input type="text" id="s" name="s" value="" class="textbox">
            <input type="submit" value="Search" id="searchsubmit" class="button">
        </form>
      </div>
    </div>
    <div class="innerblocks leftPanel">
      <div id="content" >

	<?php if (have_posts()) : ?>

		<h2 class="pagetitle">Search Results</h2>

		<div class="navigation">
			<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
			<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
		</div>


		<?php while (have_posts()) : the_post(); ?>

			<div <?php post_class() ?>>
				<h3 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
				<div class="date">
            <?php include (TEMPLATEPATH . '/authorhead.php'); ?>
            on <?php the_time('F jS, Y') ?>
          </div>

				 <div class="tag"><?php the_tags('Tags: ', ', ', '<br />'); ?></div>
                 <div class="tag">Posted in <?php the_category(', ') ?> </div>
                  <div class="clearfix">
           <div class="rightbox">
             <?php  edit_post_link('Edit', '', ' | '); ?>
              <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?>
            </div>
           </div>
			</div>

		<?php endwhile; ?>

		<div class="navigation">
			<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
			<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
		</div>

	<?php else : ?>

		<h2 class="center">No posts found. Try a different search?</h2>
		<?php get_search_form(); ?>

	<?php endif; ?>

	</div>
    </div>
    <?php get_sidebar(); ?>
    <?php get_footer(); ?>
  </div>
</div>
