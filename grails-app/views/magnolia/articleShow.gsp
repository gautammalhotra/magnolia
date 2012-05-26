<div style="float: left;padding: 0 30px 0 20px">
    <div>
        <g:if test="${content.mainArticleImage}">
            <img src="${mgnlmedia.resImage(content: content.mainArticleImage, resolution: "466x269")}"/>
        </g:if>
    </div>
    <div>
        <h2>${content?.articleHeading}</h2>
        <br/>

        <br/>

        ${content?.articleBody}
        <br/>
        ${content?.articleAuthor}
        <br/>
        ${content?.articleShortTeaser}
        <br/>
        ${content?.articleShortHeading}
        <br/>
    </div>
    By: ${content?.articleAuthor}
</div>





