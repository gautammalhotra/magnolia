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
        <label class="screen-reader-text">Subscribe via E-Mail:</label>
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
        <?php  if (have_posts()) : while (have_posts()) : the_post(); ?>
       <div class="navigation">
          <div class="alignleft">
            <?php // previous_post_link('&laquo; %link') ?>
          </div>
          <div class="alignright">
            <?php // next_post_link('%link &raquo;') ?>
          </div>
        </div>
        <div <?php post_class() ?> id="post-<?php the_ID(); ?>">
          <h2>
            <?php the_title(); ?>
          </h2>
          <div class="date"> <?php include (TEMPLATEPATH . '/authorhead.php'); ?></div>
          <div class="entry">
            <?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>
            <?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
            <?php the_tags( ' <div class="tag">Tags: ', ', ', '</div>'); ?>
            <div class="tag"> <small> This entry was posted
              <?php /* This is commented, because it requires a little adjusting sometimes.
							You'll need to download this plugin, and follow the instructions:
							http://binarybonsai.com/archives/2004/08/17/time-since-plugin/ */
							/* $entry_datetime = abs(strtotime($post->post_date) - (60*120)); echo time_since($entry_datetime); echo ' ago'; */ ?>
              
            
           
            on <?php the_time('F jS, Y') ?>
         
              at
              <?php the_time() ?>
              and is filed under
              <?php the_category(', ') ?>
              .
              You can follow any responses to this entry through the
              <?php post_comments_feed_link('RSS 2.0'); ?>
              feed.
              <?php if (('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
							// Both Comments and Pings are open ?>
              You can <a href="#respond">leave a response</a>, or <a href="<?php trackback_url(); ?>" rel="trackback">trackback</a> from your own site.
              <?php } elseif (!('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
							// Only Pings are Open ?>
              Responses are currently closed, but you can <a href="<?php trackback_url(); ?> " rel="trackback">trackback</a> from your own site.
              <?php } elseif (('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
							// Comments are open, Pings are not ?>
              You can skip to the end and leave a response. Pinging is currently not allowed.
              <?php } elseif (!('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
							// Neither Comments, nor Pings are open ?>
              Both comments and pings are currently closed.
              <?php } edit_post_link('Edit this entry','','.'); ?>
              </small> </div>
          </div>
        </div>
        <?php comments_template(); ?>
        <?php endwhile; else: ?>
        <p>Sorry, no posts matched your criteria.</p>
        <?php endif; ?>
      </div>
    </div>
    <?php get_sidebar(); ?>
    <?php get_footer(); ?>
  </div>
</div>
