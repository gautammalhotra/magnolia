<ul class="adminNavlist" style="background-color:#F5F9FC;">
    <li><img src="${createLinkTo(dir:'images',file:'logo.jpg')}" alt="intelligrape" /></li>
    <li style="vertical-align: top; float: right; margin-top: -100px;">Welcome ${session?.user} | <a href="${createLink(controller:'admin', action:'logout')}"> Logout</a></li>
</ul>

    <ul class="adminNavlist" style="background-color:#F5F9FC;">
    <li title="Edit home page"><g:link class="list" controller="homePageTemplate" action="show" id="1">Home Page</g:link>&nbsp;&nbsp;|</li>
    <li title="Edit info templates"><g:link class="list" controller="IGInfoTemplate" action="list">Ig Info Template</g:link>&nbsp;&nbsp;|</li>
    <li title="Edit Team page"><g:link class="list" controller="teamPage" action="show" id="1">Team Page</g:link>&nbsp;&nbsp;|</li>
    <li title="Add/Edit Employee details"><g:link class="list" controller="employee" action="list">Team Members</g:link>&nbsp;&nbsp;|</li>
    <li title="Add/Edit general page like why us?"><g:link class="list" controller="generalPage" action="list">General Page</g:link>&nbsp;&nbsp;|</li>
    %{--<li title="Edit info templates on the home page"><g:link class="list" controller="iGInfoTemplate" action="list">IG Info Template</g:link>&nbsp;&nbsp; |</li>--}%
    <li title="Add/delete Image"><g:link class="list" controller="image" action="list">Image</g:link>&nbsp;&nbsp;|</li>
    <li title="Add/delete image to the slideShow"><g:link class="list" controller="slideShowImage" action="list">Slide Show Image</g:link>&nbsp;&nbsp;|</li>
    <li title="Update network profiles like twitter"><g:link class="list" controller="networkProfile" action="list">Network Profile</g:link>&nbsp;&nbsp;|</li>
    <li title="Update News"><g:link class="list" controller="news" action="list">News</g:link>&nbsp;&nbsp;|</li>
    <li title="Add/Edit Sections like company, why us?"><g:link class="list" controller="section" action="list">Section</g:link>&nbsp;&nbsp;|</li>
    <li title="Add/Edit Slideshow"><g:link class="list" controller="slideShow" action="list">Slide Show</g:link>&nbsp;&nbsp;|</li>
    %{--<li title="Update recent blog image on the home page"><g:link class="list" controller="recentBlogTemplate" action="list">Recent Blog Template</g:link>&nbsp;&nbsp;|</li>--}%
    <li title="Edit testimonial"><g:link class="list" controller="testimonial" action="list">Testimonial</g:link>&nbsp;&nbsp;|</li>
    <li title="Edit Footer templates header"><g:link class="list" controller="footerTemplateHeader" action="list">Footer Template Header</g:link></li>&nbsp;&nbsp;|</li>
    <li title="Edit Case Studies Page"><g:link class="list" controller="caseStudiesPage" action="list">Case Studies Page</g:link>&nbsp;&nbsp;|</li>
    <li title="Edit Case Study"><g:link class="list" controller="caseStudy" action="list">Case Study</g:link>&nbsp;&nbsp;|</li>
    <li title="Edit Grails Tutorials Page"><g:link class="list" controller="grailsTutorialPage" action="list">Grails Tutorials Page</g:link>&nbsp;&nbsp;|</li>
    <li title="Edit Grails Tutorial"><g:link class="list" controller="grailsTutorial">Grails Tutorials</g:link>&nbsp;&nbsp;|</li>
    <li title="Add/Edit Plugins"><g:link class="list" controller="plugin">Plugins</g:link> </li>
    <li title="Add/Edit Technologies/Tools"><g:link class="list" controller="techAndTool">Tools and Technologies</g:link></li>
    <li title="Edit Footer Template"><g:link class="list" controller="footerTemplate" action="list">Footer Template</g:link>&nbsp;&nbsp;|</li>
    <li title="Logout"><g:link class="list" action="logout" controller="admin">Logout</g:link></li>
</ul>
