<%@ page import="org.codehaus.groovy.grails.commons.ConfigurationHolder as CH" %>
<g:if test="${!hideNews}">
    <g:render template="/shared/footerTemplate"/>
</g:if>
<div id="footer">
    <ul>
        <li>
            <label>Running on   <a href="http://aws.amazon.com" target="_blank" rel="nofollow"><img
                    align="absmiddle" src="${resource(dir:'images',file:'amazon.png')}"/></a>
            </label> <label>Powered by  <a href="http://www.grails.org" target="_blank" rel="nofollow">
            <img border="0" align="absmiddle" src="${resource(dir:'images',file:'grails.png')}"/></a></label>
        </li>
        <li>
            <p>Copyright © 2008 - 2010 Intelligrape Software  Pvt Ltd. All Rights Reserved.</p>
        </li>
    </ul>
</div>