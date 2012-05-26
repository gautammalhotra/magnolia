<div id="testimonialPanel">
  <g:if test="${footerTemplate}">
    <g:render template="/shared/${footerTemplate?.slot1}"/>
    <g:render template="/shared/${footerTemplate?.slot2}"/>
    <g:render template="/shared/${footerTemplate?.slot3}"/>
    %{--<g:render template="/shared/${footerTemplate?.slot4}"/>--}%
  </g:if>
  <g:else>
      %{--<g:render template="/shared/sectionsList"/>--}%
    <div class="box">
      <g:render template="/shared/testimonials"/>
    </div>
    <div class="box boxwithoutbg">
    <g:render template="/shared/news" />
    </div>
  </g:else>
</div>