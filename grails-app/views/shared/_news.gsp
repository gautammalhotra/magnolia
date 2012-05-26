<div id="news">
    <div class="heading">News</div>
    <div>
        <ul>
            <g:each var="news" in="${newsList}">
                <g:if test="${news?.heading && news?.link}">
                    <li><a href="${news?.link}" rel="nofollow">${news?.heading}</a></li>
                </g:if>
                <g:if test="${news?.text}">
                    <li>${news?.text}</li>
                </g:if>
            </g:each>
        </ul>
    </div>
</div>