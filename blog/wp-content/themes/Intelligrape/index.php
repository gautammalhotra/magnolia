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
        <?php while (have_posts()) : the_post(); ?>
        <div <?php post_class() ?> id="post-<?php the_ID(); ?>">
          <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
            <?php the_title(); ?>
            </a></h2>
          <div class="date">
            <?php include (TEMPLATEPATH . '/authorhead.php'); ?>
            on <?php the_time('F jS, Y') ?>
          </div>
          <div class="entry">
            <?php the_content('Read the rest of this entry &raquo;'); ?>
          </div>
          <div class="tag">
            <?php the_tags('<strong>Tags:</strong> ', ', '); ?>
          </div>
          <div class="tag"><strong> Posted under </strong>
            <?php the_category(', ') ?>
          </div>
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
            <?php next_posts_link('&laquo; Older Entries') ?>
          </div>
          <div class="alignright">
            <?php previous_posts_link('Newer Entries &raquo;') ?>
          </div>
        </div>
        <?php else : ?>
        <h2 class="center">Not Found</h2>
        <p class="center">Sorry, but you are looking for something that isn't here.</p>
        <?php get_search_form(); ?>
        <?php endif; ?>
      </div>
    </div>
    <?php get_sidebar(); ?>
    <?php get_footer(); ?>
  </div>
</div>
