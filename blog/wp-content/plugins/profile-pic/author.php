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
          Subscribe via E-Mail:
          <input type="text" name="email" value="Email-Id" onfocus="if(this.value=='Email-Id')this.value='';"onblur="if(this.value=='')this.value='Email-Id';" style="width: 140px;" class="textbox">
          <input type="hidden" name="uri" value="IntelligrapeBlog">
          <input type="hidden" value="en_US" name="loc">
          <input type="submit" value="Subscribe" class="button">
        </form>
      </div>
      <div id="search">
        <form action="/blog/" id="searchform" method="get" role="search">
          <label for="s" class="screen-reader-text">Search for:</label>
          <input type="text" id="s" name="s" value="" class="textbox">
          <input type="submit" value="Search" id="searchsubmit" class="button">
        </form>
      </div>
    </div>
    <div class="innerblocks leftPanel">
      <div id="content" class="contentblock">
<!-- This sets the $curauth variable -->
    <?php
    if(isset($_GET['author_name'])) :
        $curauth = get_userdatabylogin($author_name);
    else :
        $curauth = get_userdata(intval($author));
    endif;
    ?>
    
    <div class="clearfix">
    <?php $atts = array('callmethod' => 'shortcode', 'userid' => $authid); echo profilepic_gui_printprofile($atts); ?>
    <div id="profilepic_profile" >
        <h2><?php echo $curauth->nickname; ?></h2>
        <p><a href="<?php echo $curauth->user_url;?>"><?php echo $curauth->user_url;?></a></p>
        <p><?php echo $curauth->description;?></p>
       <h3>Posts by <?php echo $curauth->nickname; ?>:</h3>
      </div>
   
    </div>
    
    <ul>
<!-- The Loop -->
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <li>
        <div <?php post_class() ?> id="post-<?php the_ID(); ?>">
            <h2> <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link: <?php the_title(); ?>"><?php the_title(); ?></a></h2>
            <div class="date"><?php the_time('d M Y'); ?> in <?php the_category('&');?></div>
            <div class="entry">
            <?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>
            </div>
        </div>
        </li>
    <?php endwhile; else: ?>
        <p><?php _e('No posts by this author.'); ?></p>
    <?php endif; ?>
<!-- End Loop -->
    </ul>
</div>
  </div>
   <?php get_sidebar(); ?>
    <?php get_footer(); ?>
    </div>
     </div>


