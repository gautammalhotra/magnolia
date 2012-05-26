<div id="right-header">
 <g:render template="/shared/networkProfiles" />
    <div id="dropdown">
    <ul class="dropdown">

        <li>
            <a href="/contact.html" title="Contact Us for Grails Development"><span>Contact</span></a>

        </li>

        <li>
            <a href="/blog" uri="/blog" title="Groovy Grails Blog"><span>Blog</span></a>

        </li>

        <li class="">
            <a href="/Grails-Development.html" title="Services"><span>Services</span></a>
            <ul class="sub_menu" style="visibility: hidden; "><li><a href="/Grails-Development.html" title="Grails Application Development Service"><span>Grails Development</span> » </a><ul class="sub_menu"><li><a href="/Grails-Web-Application-Development.html" title="Grails Web Application Development"><span>Grails Web Application Development</span></a></li><li><a href="/Grails-Offshore-Product-Development.html" title="Grails Off-shore Product Development"><span>Offshore Product Development in Grails</span></a></li><li><a href="/Grails-Development-Outsourcing-Service.html" title="Outsourcing Grails Web Development"><span>Grails Development Outsourcing Service</span></a></li><li><a href="/Application-Reengineering-Service.html" title="Application Reengineering"><span>Application Reengineering Service</span></a></li><li><a href="/Grails+App+Deployment+on+Amazon+EC2.html" title="Grails App on Amazon EC2"><span>Grails App Deployment on Amazon Ec2</span></a></li><li><a href="/Application-Migration-To-Grails-Framework.html" title="Application Migration To Grails"><span>Application Migration to Grails Framework</span></a></li><li><a href="/Grails-Development-With-Ajax-jQuery.html" title="Grails Development with Ajax &amp; jQuery"><span>Grails with Ajax and jQuery</span></a></li><li><a href="/Spring-application-integration-with-Grails.html" title="Integration of Spring application with Grails"><span>Spring App Integration With Grails</span></a></li><li><a href="/Grails-Flex-Development.html" title="Flex Development with Grails"><span>Flex development with Grails</span></a></li><li><a href="/Grails-App-Deployment-on-Google-App-Engine.html" title="Grails App Deployment on GAE"><span>Grails App Deployment on GAE</span></a></li></ul></li><li><a href="/Groovy-Development.html" title="Groovy Programming"><span>Groovy Development</span></a></li><li><a href="/Groovy-Grails-Training.html" title="Groovy Grails Training"><span>Groovy and Grails Training</span></a></li><li><a href="/PhoneGap-Development.html" title="PhoneGap Development"><span>PhoneGap Development</span></a></li></ul>
        </li>

        <li class="">
            <a href="/grails-developers.html" title="Grails Developers and Contractors"><span>Company</span></a>
            <ul class="sub_menu" style="visibility: hidden; "><li><a href="/grails-developers.html" title="Grails Developers Contractors"><span>Our Team</span></a></li><li><a href="/technology.html" title="IntelliGrape's Technology Stack"><span>Our Technology Stack</span></a></li><li><a href="/tools-for-offshore-agile-development.html" title="Our Tool-Kit for Distributed Agile"><span>Our Tool-Kit for Distributed Agile</span></a></li><li><a href="/grails-plugins.html" title="Our Plugins"><span>Our Plugins</span></a></li><li><a href="/Grails+With+Agile+Methodologies.html" title="Grails Development following Agile Methodologies"><span>How We Work</span></a></li><li><a href="/Why-IntelliGrape-For-Grails-Development.html" title="Outsourcing Grails Development"><span>Why us for Grails Development</span></a></li></ul>
        </li>

        <li class="">
            <a href="/" title="Grails Development Company" class="current"><span>Home</span></a>

        </li>

    </ul>
    <script type="text/javascript">
        jQuery(document).ready(function(){
      var navUrl = "home";
            if(navUrl == 'home'){
                jQuery("ul.dropdown>li>a:last").addClass("current");
            }
            else{
                jQuery("ul.dropdown>li>a[href*='"+navUrl+"']").addClass("current");
            }
    });
      jQuery(function(){
        jQuery("ul.dropdown li").hover(function(){
          jQuery(this).addClass("hover");
          jQuery('ul:first',this).css('visibility', 'visible');
        }, function(){
          jQuery(this).removeClass("hover");
          jQuery('ul:first',this).css('visibility', 'hidden');
        });
        jQuery("ul.dropdown li ul li:has(ul)").find("a:first").append(" &raquo; ");
      });
    </script>
  </div>
</div>
