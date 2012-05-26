<div id="employee">

  
  <h5 class="teamHeader">${employees[0]?.team} Team</h5>
 <ul>
   <g:each var="employee" in="${employees}">
     <li class="clearfix">
        <img src="${IG.imageLink(image:employee.image)}"
                title="${employee.image.title}" alt="${employee.image.altText}" class="portfolioimage" width="109px" height="109px" />

            <span class="teamhead">${employee.name}
            <g:if test="${employee.designation}" >
              - ${employee.designation}
            </g:if>
            </span>${employee.description}

        </li>

</g:each>
 </ul>
</div>

