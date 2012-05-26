<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<script type="text/javascript" src="/js/jquery-1.3.1.min.js"></script>
<script type="text/javascript" src="/js/lightbox.js"></script>
<script type="text/javascript">
 // $(function(){
	//	 $('div.post').wrap('<div class="outer"></div>');        
	//	$('div.post').corner("round 10px").parent().css('padding', '2px').corner("round 10px")
	//	    });
  
  </script>
<link type="image/x-icon" href="/images/favicon.ico" rel="shortcut icon">


<style type="text/css" media="screen">

<?php
// Checks to see whether it needs a sidebar or not
if ( !empty($withcomments) && !is_single() ) {
?>
	#page { background: url("<?php bloginfo('stylesheet_directory'); ?>/images/kubrickbg-<?php bloginfo('text_direction'); ?>.jpg") repeat-y top; border: none; }
<?php } else { // No sidebar ?>
	#page { background: url("<?php bloginfo('stylesheet_directory'); ?>/images/kubrickbgwide.jpg") repeat-y top; border: none; }
<?php } ?>

</style>

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

<?php wp_head(); ?>
</head>
<body>
<div id="header">
  <div id="logo"><a href="/"><img border="0" alt="Intelligrape" title="Groovy and Grails Offshore and Outsourced Development Company in India" src="/images/logo.png"></a></div>
  <div id="right-header">
    <div id="follow-us">
      <ul>
        <li><a target="_blank" href="http://twitter.com/IntelliGrape" rel="nofollow"> <img alt="twitter" title="Follow us on Twitter" src="/image/showImage/21?mime=image%2Fjpeg/&gt;}"> </a></li>
        <li><a target="_blank" href="http://www.linkedin.com/companies/246617/IntelliGrape%20Software" rel="nofollow"> <img alt="linkedin" title="Follow us on LinkedIn" src="/image/showImage/22?mime=image%2Fjpeg/&gt;}"> </a></li>
        <li><a target="_blank" href="http://www.facebook.com/#!/pages/Delhi/IntelliGrape-Software/66949766692?ref=ts" rel="nofollow"> <img alt="Facebook" title="Follow Us on Facebook" src="/image/showImage/23?mime=image%2Fjpeg/&gt;}"> </a></li>
        <li><a target="_blank" href="/blog/feed/"> <img alt="RSS Feed" title="RSS" src="/image/showImage/39?mime=image%2Fjpeg/&gt;}"> </a></li>
      </ul>
    </div>
    <div id="dropdown">
      <ul class="dropdown">
        <li> <a title="Contact Us for Grails Development" href="/contact.html"><span>Contact</span></a> </li>
        <li> <a class="current" title="Groovy Grails Blog" uri="/blog" href="/blog"><span>Blog</span></a> </li>
        <li> <a title="Services" href="/Grails-Development.html"><span>Services</span></a>
          <ul>
            <li><a title="Groovy Programming" href="/Groovy-Development.html"><span>Groovy Development</span></a></li>
            <li><a title="Grails Development" href="/Grails-Development.html"><span>Grails Development</span></a>
              <ul>
                <li><a title="Grails Web Application Development" href="/Grails-Web-Application-Development.html"><span>Grails Web Application Development</span></a></li>
                <li><a title="Application Migration To Grails" href="/Application-Migration-To-Grails-Framework.html"><span>Application Migration to Grails Framework</span></a></li>
                <li><a title="Application Reengineering" href="/Application-Reengineering-Service.html"><span>Application Reengineering Service</span></a></li>
                <li><a title="Grails Off-shore Product Development" href="/Grails-Offshore-Product-Development.html"><span>Offshore Product Development in Grails</span></a></li>
                <li><a title="Outsourcing Grails Web Development" href="/Grails-Development-Outsourcing-Service.html"><span>Grails Development Outsourcing Service</span></a></li>
                <li><a title="Integration of Spring application with Grails" href="/Spring+application+integration+with+Grails.html"><span>Spring App Integration With Grails</span></a></li>
                <li><a title="Grails Development with Ajax &amp; jQuery" href="/Grails+Development+With+Ajax+%26+jQuery.html"><span>Grails with Ajax and jQuery</span></a></li>
                <li><a title="Flex Development with Grails" href="/Grails+Flex+Development.html"><span>Flex development with Grails</span></a></li>
                <li><a title="Grails App on Amazon EC2" href="/Grails+App+Deployment+on+Amazon+EC2.html"><span>Grails App Deployment on Amazon Ec2</span></a></li>
                <li><a title="Grails App Deployment on GAE" href="/Grails+Application+Deployment+on+Google+App+Engine.html"><span>Grails App Deployment on GAE</span></a></li>
              </ul>
            </li>
            <li><a title="Groovy Grails Training" href="/Groovy-Grails-Training.html"><span>Groovy and Grails Training</span></a></li>
          </ul>
        </li>
        <li> <a title="Grails Developers and Contractors" href="/grails-developers.html"><span>Company</span></a>
          <ul >
            <li><a title="Grails Developers Contractors" href="/grails-developers.html"><span>Our Team</span></a></li>
            <li><a title="IntelliGrape's Technology Stack" href="/technology.html"><span>Our Technology Stack</span></a></li>
            <li><a title="Our Tool-Kit for Distributed Agile" href="/tools-for-offshore-agile-development.html"><span>Our Tool-Kit for Distributed Agile</span></a></li>
            <li><a title="Our Plugins" href="/grails-plugins.html"><span>Our Plugins</span></a></li>
            <li><a title="Grails Development following Agile Methodologies" href="/Grails+With+Agile+Methodologies.html"><span>How We Work</span></a></li><li>
            <a title="Outsourcing Grails Development" href="/Grails-Development-Outsourcing.html"><span>Why us for Grails Development</span></a></li>
        
        </li>
        <li> <a title="Grails Development Company" href="/" class=""><span>Home</span></a> </li>
      </ul>
      <script type="text/javascript">
      jQuery(function(){
        jQuery("ul.dropdown li").hover(function(){
          jQuery(this).addClass("hover");
          jQuery('ul:first',this).css('visibility', 'visible');
        }, function(){
          jQuery(this).removeClass("hover");
          jQuery('ul:first',this).css('visibility', 'hidden');
        });
        jQuery("ul.dropdown li ul li:has(ul)").find("a:first").append(" &raquo;");
      });
   </script>
    </div>
  </div>
</div>
