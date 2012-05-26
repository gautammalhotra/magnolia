<div id="testimonial" >
<div class="heading">Testimonials</div>
<g:each var="testimonialInstance" in="${testimonials}">
  <p>
      %{--<p:image src="leftcot.png" />--}%
    ${testimonialInstance?.quote}
    <g:if test="${testimonialInstance?.client}">
      <strong>- ${testimonialInstance?.client}</strong>
      <g:if test="${testimonialInstance?.image}">
        <img src="${IG.imageLink(image:testimonialInstance?.image)}" alt="${testimonialInstance?.image?.altText}"/>
      </g:if>
    </g:if>
     %{--<p:image src="rightcot.png" /> --}%
  </p>
</g:each>
</div>
