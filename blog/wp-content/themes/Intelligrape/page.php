<div id="container">
  <?php
/**
 *  * @package WordPress
 *   * @subpackage Default_Theme
 *    */

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
      <div id="content" class="contentblock">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post" id="post-<?php the_ID(); ?>">
		<h2><?php the_title(); ?></h2>
			<div class="entry">
				<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>

				<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

			</div>
		</div>
		<?php endwhile; endif; ?>
	<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
	<p>Written by: 
		<?php the_author_posts_link(); ?>
	</p>


  </div>
    </div>
    <?php get_sidebar(); ?>
    <?php get_footer(); ?>
  </div>
</div>

