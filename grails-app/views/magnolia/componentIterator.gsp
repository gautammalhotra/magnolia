<%@ page contentType="text/html;charset=UTF-8" %>
<%@ taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core" %>
<%@ taglib prefix="cms" uri="http://magnolia-cms.com/taglib/templating-components/cms" %>

<div class="span8 alert-info">
    <g:each in="${components}" var="component">
        <cms:component content="${component}"/>
    </g:each>
</div>
