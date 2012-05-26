<ul class="galleryDetails">
    <div>
        <h2 style="margin-top: 30px;text-align: center">Top Stories</h2>
    </div>
    <g:each in="${teasers}" var="teaser" status="i">
        <li style="border-bottom: 1px solid #C7C7C7;clear: both;margin-bottom: 20px;margin-top: -4px;padding: 20px 20px 20px">
            <ul>
                <li>
                    <h2><a href="${teaser.articleUrl}" style="color: #222222;">${teaser.title}</a></h2>
                    <br/>

                    <p><strong><a href="${teaser.articleUrl}" style="color: #222222;">${teaser.subHeading}</a>
                    </strong> : <a
                            href="${teaser.articleUrl}" style="color: #222222;">${teaser.shortTeaser}</a> <span
                            class="tag">${teaser.numberOfComment}</span></p>
                </li>
            </ul>
        </li>
    </g:each>
</ul>
