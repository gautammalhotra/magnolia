 <div id="leftmenu">
    <ul>
        <g:each var="section" in="${siblingSections.sort{it.displayOrder}}">
            <li id="${section.id}">
                <IG:generateLink section="${section}"/>
            </li>
        </g:each>
    </ul>
</div>
 <script type="text/javascript">
    jQuery(document).ready(function(){
      jQuery('a[href*="${navUrl}"]').addClass('select');
    });
 </script>