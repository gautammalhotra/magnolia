<%@ page contentType="text/html;charset=UTF-8" %>
<%@ taglib prefix="cms" uri="http://magnolia-cms.com/taglib/templating-components/cms" %>
<%@ taglib prefix="cmsfn" uri="http://magnolia-cms.com/taglib/templating-components/cmsfn" %>

<html>
<head>
    <title>${content.title}</title>
    <meta name="layout" content="main"/>
    <meta name="keywords" content="${content?.metaKeywords}"/>
    <meta name="description" content="${content?.metaDescription}"/>
    <cms:init/>
</head>

<body>
   <cms:area name="articleArea"/>
</body>
</html