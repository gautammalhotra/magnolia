<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
        <g:layoutHead />
        <title>${page.title}</title>
        <meta name="description" content="${page.metatag}"/>
        %{--<p:css name="mainLayoutCSSFilesBundled"/> --}%
        %{--<p:javascript src="mainLayoutJSFilesBundled"/>--}%
        %{--<p:favicon src='images/favicon' />--}%
        %{--<p:javascript src="application" />--}%
    </head>
    <body>
    <div id="container">
      <g:render template="/layouts/header"/>
      <div id="wrapper">
        <g:layoutBody />
        <g:render template="/layouts/footer"/>
        <g:render template="/layouts/googleAnalytics"/>
      </div>
    </div>
    </body>
</html>