<div  id="${id}">Recent Blogs</div>
<ul><g:each var="blog" in="${recentPosts}">
  <li><a href="${blog?.link}">${blog?.title}</a></li>
</g:each></ul>

