<style type="text/css">
div.error {
    display: inline;
    color: red;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 11px;
}

</style>
%{--<p:css name="mainLayoutCSSFilesBundled"/>--}%
%{--<p:javascript src="mainLayoutJSFilesBundled"/>--}%
%{--<p:javascript src="jquery.validate"/>--}%

<div id="note">
    <g:if test="${flash.message}">
        ${flash.message}
    </g:if>
    <g:else>
        <div class="error"></div>
        <g:hasErrors bean="${cmd?.errors}">
            <div class="notification_error">
                <g:renderErrors bean="${cmd}"/>
            </div>
        </g:hasErrors>
    </g:else>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $.validator.addMethod('nameReqd', function (value) {
            return ($('#name').val() != 'Name');
        });

        $.validator.addMethod('subjReqd', function (value) {
            return ($('#subject').val() != 'Subject');
        });

        $("#submitButton").bind('click', function () {
            sendContactUsData();
        });

        jQuery("#contactUsForm").validate({
            errorLabelContainer:$("#contactUsmessage"),
            rules:{
                message:{
                    required:true,
                    minlength:15
                }
            }
        });
    });

    function sendContactUsData() {
        $("#ajaxMessage").hide();
        if ($('#contactUsForm').validate().form()) {
            $("#submitButton").attr('value', 'Sending Message ...');
            $("#submitButton").attr('disabled', 'disabled');
            $.post("${createLink(controller:"ig", action:"sendMail")}", $("#contactUsForm").serialize(), function (data) {
                $("#contactUsForm").each(function () {
                    this.reset();
                });
                alert(data);
                $("#submitButton").attr('value', 'Send Message');
                $("#submitButton").attr('disabled', '');
            });
        }
    }
</script>


<div id="${boxCssId}">
    <div class="contactHeading">CONTACT EXPERTS</div>

    <div class="contactFields">

        <form id="contactUsForm" name="contactUsForm">
            <ul>
                <div id="contactUsmessage">
                    <label id='nameLabel' for="name" class="error" style="display: block;" generated="true"></label>
                    <label for="email" class="error" style="display: block;" generated="true"></label>
                    <label id='subjectLabel' for="subject" class="error" generated="true"
                           style="display: block;"></label>
                    <label for="message" class="error" generated="true" style="display: block"></label>
                </div>

                <li class="take" style="line-height:22px;"><div
                        style="font-size:12px;">Take a free trial of 15 days. We are excited to know about your dream project:</div>
                </li>
                <li><span class="fields">
                    <input class="textboxField1 nameReqd textOnly" type="text" title="*Please enter your name"
                           name="name"
                           value="${cmd?.name ?: 'Name'}" onfocus="if (this.value == 'Name')this.value = '';"
                           onblur="if (this.value == '')this.value = 'Name';" id="name"/><br/>
                </span>
                </li>
                <li><span class="fields">
                    <input class="textboxField1" type="text" title="Please enter your Company name"
                           name="company"
                           value="${cmd?.company ?: 'Company'}"
                           onfocus="if (this.value == 'Company')this.value = '';"
                           onblur="if (this.value == '')this.value = 'Company';" id="company"/><br/>
                </span>
                </li>
                <li><span class="fields">
                    <input class="textboxField1 required email"
                           type="text"
                           name="email"
                           title="*Please enter your Email-Id<br/>"
                           value="${cmd?.email ?: 'E-Mail'}"
                           onfocus="if (this.value == 'E-Mail')this.value = '';"
                           onblur="if (this.value == '')this.value = 'E-Mail';" id="email"/><br/>
                </span>
                </li>
                <li><span class="fields">
                    <input class="textboxField1 textOnly subjReqd"
                           title="*Please enter the subject<br/>"
                           type="text"
                           name="subject"
                           value="${cmd?.subject ?: 'Subject'}"
                           onfocus="if (this.value == 'Subject')this.value = '';"
                           onblur="if (this.value == '')this.value = 'Subject';" id="subject"/><br/>
                </span>
                    <input type="hidden" name="pageTrack" value="${request.forwardURI}"/>
                </li>
                <li><span class="fields">
                    <textarea class="textboxArea"
                              title="*Please enter your comment. It should have atleaset 15 characters<br/>"
                              onfocus="if (this.value == 'Comments')this.value = '';"
                              onblur="if (this.value == '')this.value = 'Comments';" name="message" rows="5"
                              id="message">${cmd?.message ?: 'Comments'}</textarea><br/>
                </span>
                </li>
                <li>
                    <label>&nbsp;</label>
                    <input class="contactMeBtn" type="button" name="submit" value="Send Message" id="submitButton"/>
                </li>
                <li>
                    <span>* We value your privacy</span>
                </li>
            </ul>
        </form>
    </div>

</div>

<div id="backgroundPopup"></div>

