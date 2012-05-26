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
          <label  class="screen-reader-text">Search for:</label>
          <input type="text" id="s" name="s" value="" class="textbox">
          <input type="submit" value="Search" id="searchsubmit" class="button">
        </form>
      </div>
    </div>
    <div class="innerblocks leftPanel">
      <div id="content" class="contentblock">
    <?php if (have_posts()) : ?>
    <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
    <?php /* If this is a category archive */ if (is_category()) { ?>
    <h2 class="pagetitle">Archive for the &#8216;
      <?php single_cat_title(); ?>
      &#8217; Category</h2>
    <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
    <h2 class="pagetitle">Posts Tagged &#8216;
      <?php single_tag_title(); ?>
      &#8217;</h2>
    <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
    <h2 class="pagetitle">Archive for
      <?php the_time('F jS, Y'); ?>
    </h2>
    <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
    <h2 class="pagetitle">Archive for
      <?php the_time('F, Y'); ?>
    </h2>
    <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
    <h2 class="pagetitle">Archive for
      <?php the_time('Y'); ?>
    </h2>
    <?php /* If this is an author archive */ } elseif (is_author()) { ?>
    <h2 class="pagetitle">Author Archive</h2>
    <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
      <h2 class="pagetitle">Blog Archives</h2>
      <?php } ?>
<!--    <div class="navigation">
      <div class="alignleft">
        <?php // next_posts_link('&laquo; Older Entries') ?>
      </div>
      <div class="alignright">
        <?php // previous_posts_link('Newer Entries &raquo;') ?>
      </div>
    </div>-->
    <?php while (have_posts()) : the_post(); ?>
    <div <?php post_class() ?>>
      <h3 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
        <?php the_title(); ?>
        </a></h3>
     <div class="date">
            <?php include (TEMPLATEPATH . '/authorhead.php'); ?>
            on <?php the_time('F jS, Y') ?>
          </div>
      <div class="entry">
        <?php the_content() ?>
      </div>
      <div class="tag">
        <?php the_tags('Tags: ', ', ', '<br />'); ?></div>
        <div class="tag"> Posted in
        <?php the_category(', ') ?> </div>
         <div class="clearfix">
           <div class="rightbox">
             <?php  edit_post_link('Edit', '', ' | '); ?>
              <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?>
            </div>
           </div>
        
    </div>
    <?php endwhile; ?>
 <div class="navigation">
      <div class="alignleft">
        <?php  next_posts_link('&laquo; Older Entries') ?>
      </div>
      <div class="alignright">
        <?php  previous_posts_link('Newer Entries &raquo;') ?>
      </div>
    </div>
    <?php else :

		if ( is_category() ) { // If this is a category archive
			printf("<h2 class='center'>Sorry, but there aren't any posts in the %s category yet.</h2>", single_cat_title('',false));
		} else if ( is_date() ) { // If this is a date archive
			echo("<h2>Sorry, but there aren't any posts with this date.</h2>");
		} else if ( is_author() ) { // If this is a category archive
			$userdata = get_userdatabylogin(get_query_var('author_name'));
			printf("<h2 class='center'>Sorry, but there aren't any posts by %s yet.</h2>", $userdata->display_name);
		} else {
			echo("<h2 class='center'>No posts found.</h2>");
		}
		get_search_form();

	endif;
?>
  </div>
    </div>
    <?php get_sidebar(); ?>
    <?php get_footer(); ?>
  </div>
</div>
