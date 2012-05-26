<%@ page import="org.codehaus.groovy.grails.commons.ConfigurationHolder as CH" %>
<div id="navi">
  <ul>
    <g:each var="section" in="${sections}">
      <g:if test="${!section?.name?.equalsIgnoreCase('blog')}">
        <li>
            <IG:generateLink section="${section}"/>
         <IG:siteSubSections section="${section}"/>
        </li>
      </g:if>
    </g:each>
  </ul>
</div>

