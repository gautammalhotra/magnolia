<script type="text/javascript">
    $(document).ready(function () {

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
                $("#submitButton").attr('value', 'PlEASE CONTACT ME');
                $("#submitButton").attr('disabled', '');
                alert(data);
            });
        }
    }
</script>


<div id="langingRightPanel">
    <div class="blogHeading" id="igTemplate4">CONTACT EXPERTS</div>

    <div id="contactFields">

        <form name="contactUsForm" id="contactUsForm">
            <ul>
                <div id="contactUsmessage">
                    <label id='nameLabel' for="name" class="error" style="display: block;" generated="true"></label>
                    <label for="email" class="error" style="display: block;" generated="true"></label>
                    <label id='subjectLabel' for="subject" class="error" generated="true"
                           style="display: block;"></label>
                    <label for="message" class="error" generated="true" style="display: block"></label>
                </div>
                <li class="take" style="line-height:22px;"><p
                        style="font-size:15px;color: #fff">Take a free trial of 15 days. We are excited to know about your dream project:</p>
                </li>
                <li><span class="label">Name</span>
                    <span class="fields"><input type="text" id="name" placeholder="" value="" name="name"
                                                title="Please enter your name"
                                                class="textboxField required"/>
                    </span>
                </li>
                <li>
                    <span class="label">Company</span>
                    <span class="fields"><input type="text" id="company" placeholder="" value=""
                                                name="company" title="Please enter your Company name"
                                                class="textboxField"/></span>
                </li>
                <li>
                    <span class="label">Email</span>
                    <span class="fields"><input type="text" id="email" placeholder="" value=""
                                                title="Please enter your email address&lt;br/&gt;"
                                                name="email"
                                                class="textboxField required email"/></span>
                </li>
                <li>
                    <span class="label">Subject</span>
                    <span class="fields"><input type="text" id="subject" placeholder="" value=""
                                                name="subject" title="Please enter the subject&lt;br/&gt;"
                                                class="textboxField required"></span>
                    <input type="hidden" name="pageTrack" value="${request.forwardURI}"/>

                </li>
                <li>
                    <span class="label">Comments</span>
                    <span class="fields"><textarea id="message" rows="5" name="message" placeholder=""
                                                   title="Please enter your comment. It should have atleaset 15 characters&lt;br/&gt;"
                                                   class="textboxArea"></textarea></span>
                </li>
                <li>
                    <span class="label">&nbsp;</span>
                    <span class="fields"><input type="button" id="submitButton" value="PlEASE CONTACT ME"
                                                name="submit" class="contactMeBtn"></span>
                </li>
                <li>
                    <span class="label">&nbsp;</span> <span class="fields">We value your privacy</span>
                </li>
            </ul>
        </form>

    </div>

</div>