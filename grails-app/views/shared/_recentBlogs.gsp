<ul><g:each var="blog" in="${recentBlogs}">
  <li><a href="${blog?.link}">${blog?.title}</a></li>
</g:each>
</ul>
