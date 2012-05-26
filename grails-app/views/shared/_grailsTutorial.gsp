<div class="portfolio">
    <h5 class="teamHeader">
        <g:link controller="ig" action="grailsTutorial" params="[url: grailsTutorial.url]">
            ${grailsTutorial.title}
        </g:link>
    </h5>
    %{--<IG:trim body="${grailsTutorial.description}"/>--}%
    <g:link controller="ig" action="grailsTutorial" params="[url: grailsTutorial.url]">
        read more...
    </g:link>
</div>
