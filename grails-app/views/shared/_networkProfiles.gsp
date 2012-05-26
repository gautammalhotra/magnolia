<div class="grid_3 footblock clients">
    <div class="child" style="text-align:center;">
    %{--<h5>${networkProfileTemplateHeader}</h5>--}%

    </div>  
</div>

<div id="follow-us">
    <ul>
       <g:each var="networkProfile" in="${networkProfiles}">
            <li><a  href="${networkProfile?.link}" target="_blank">
                   <img src="${IG.imageLink(image:networkProfile?.image,mime:'image/jpeg')}" title="${networkProfile?.image?.title}" alt="${networkProfile?.image?.altText}"/>
            </a></li>
        </g:each>

    </ul>
  </div>
