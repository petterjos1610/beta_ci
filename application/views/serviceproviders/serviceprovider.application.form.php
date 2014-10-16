<div class="popup">
	<div id="info_popup">
		<div id="popup_inner" class="border_red rc">
			<div id="popup_close"><a onClick="$('body').removeClass('showPop');">Close</a></div>
			<div class="heading_bar rc red">
				<h2>Request a new password</h2>
			</div>
			<div id="popup_content" class="inner_col rc">
				<form method="post" action="index.php" name="form2">
					<input type="hidden" name="function" value="forgottenpass">
					<div class="col_half left">
						<div class="form_label">First name:<font class="font_red">*</font></div>
						<input type="text" class="text_area" name="fname" value="" onInput="isNotEmpty(this);">
					</div>
					<div class="col_half right">
						<div class="form_label">Surname:<font class="font_red">*</font></div>
						<input type="text" class="text_area" name="lname" value="" onInput="isNotEmpty(this);">
					</div>
					<div class="col_half left">
						<div class="form_label">Email:<font class="font_red">*</font></div>
						<input type="text" class="text_area" name="email" value="" onInput="isEmail(this);">
					</div>
					<div class="col_half right" style="text-align:right; margin-top:30px;">
						<input type="button" class="btn green" value="Request password" onClick="checkForgotten()">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="wrapper">
	<div class="logo"><a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>" title="Edukit"><img src="<?php echo base_url(); ?>imgs/edukit_logo_<?php if ($_SERVER['SERVER_NAME'] == "test.edukit.org.uk") echo "test"; else if ($_SERVER['SERVER_NAME'] == "dev.edukit.org.uk") echo "dev"; else echo "trans"; ?>.png" alt="logo"></a>
	</div>
	<?php if (isset($_POST['failed']) && !$_POST['failed']) { ?>
	<div class="col_fullwidth">
		<h1 style="color:#278bc3">Password Request Successful</h1>
		<div class="spacer20"></div>
		Please look in the following email inbox for the newly generated password:<br><br>
		<?php echo $_POST['email']; ?><br><br>
		Please note that this automated email may have been moved to your junk folder. You should add Edukit to your email contacts to prevent this from happening in future.<br><br>
		Thanks<br>
		Edukit Team
	</div>
	<div class="spacer20"></div>
	<div class="col_half right" style="text-align:right;">
		<a href="?"><input type="button" class="btn green" value="Log in"></a>
	</div>
	<?php } else if (isset($_POST['failed']) && $_POST['failed']) { ?>
	<div class="spacer30"></div>
	<div class="col_fullwidth">
		<h1 style="color:#278bc3">Could not find user</h1>
		<div class="spacer20"></div>
		Unfortunately we could not find the associated user account for the user details you entered<br><br>
		Please check the information you entered and try again.<br><br>
		Thanks<br>
		Edukit Team
	</div>
	<div class="spacer20"></div>
	<div class="col_half right" style="text-align:right;">
		<a href="?"><input type="button" class="btn green" value="Try again"></a>
	</div>
	<?php } else { ?>
	<div class="right-menuBar">
		<ul>
			<li style="min-width:220px;"><a href="#">Already registered with EduKit?&nbsp;<i class="fa fa-chevron-down right"></i></a>
				<ul>
					<li><a onClick="$('body').addClass('showPop');" href="#">Resend my password</a></li>
					<li><a href="<?php echo base_url(); ?>" style="width:179px;">Log me in</a></li>
				</ul>
			</li>
		</ul>
	</div>
</div>
<div class="clearfix"></div>
<div id="wrapper">
	<div class="heading_bar rc darkgreen">
		<h1>Welcome to Edukit! <a onclick="infoPopup('Service Provider Information','Please provide full details of your organisation, completing all fields in order as you go. We&rsquo;ll fill in any areas we can.');"><i class="fa fa-info-circle font_white" style="cursor:pointer; font-size:19px; float:right; margin-top:4px;"></i></a></h1>
	</div>
	<form name="form">
	<div id="content" class="rc border_green">
	    <div class="col_fullwidth" id="helpIntro">
	    	<?php if (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') === false) { ?>
	    	<div class="inner_col_red rc">
                <p style="float:right; width: 815px;"><strong>Hey - it looks like you are not using Google Chrome. If so, then this registration form may not work in your browser. Please copy and paste this URL into the address bar in Chrome, or <a href="http://www.google.com/intl/en_uk/chrome/browser/" target="blank">click here first if you need to download it.</a></strong></p>
                <a href="http://www.google.com/intl/en_uk/chrome/browser/" target="blank"><img src="<?php echo base_url(); ?>imgs/chrome_icon.png" style="float:left; height:45px; width: 45px;" /></a>
	    	</div>
	    	<?php } ?>
	        <div class="inner_col rc">
	        	<h2 class="font_darkgreen">I'm new here... Help me to find my information</h2>
				<div class="spacer30"></div>
				<div class="right" style="position:relative; width:200px; height:200px; margin-left:30px; margin-top:55px; right:0px;">
					<img src="<?php echo base_url(); ?>imgs/selfassess_icon.png" width="167px" height="167px">
				</div>
	    	    <p>You are just a few short steps away from registering on our database, which will soon be accessible to schools across London. Registration is FREE and takes approx 15mins per programme. To get started you'll need:</p>
	    	    <br />
                <p>- Your charity or company registration number</p>
                <p>- At least one educational professional who we can contact who can vouch for your programme</p>
                <br />
                <p>Should you have any problems at all, please contact our team from 9.30 to 5.30 on <b>020 3191 9696</b> or <b>0800 814 9696</b>.</p>
                <p>All feedback is welcome - we'd love to hear from you.</p>
                <br />
                <p>Thanks,</p>
                <p>Team EduKit</p>
	    	</div>
	    	<div class="inner_col_red rc">
                <p>PLEASE NOTE: At this point we are only covering schools based in Greater London (i.e. one of the 33 London boroughs), so please only register if you help schools in this area.</p>
	    	</div>
	    </div>
		<div id="finder" style="overflow:hidden;">
			<div class="col_fullwidth">
				<div class="form_label">I am a:</div>
				<select name="orgOpt" id="orgOpt" class="text_area select_img" onChange="showNumber(); form.number.value='';">
					<option value="" disabled selected>Select your organisation type</option>
					<option value="company">Registered Company</option>
					<option value="charity">Registered Charity</option>
				</select>
			</div>
			<div id="number" class="col_fullwidth" style="height:0px;">
				<div class="form_label" id="numberLabel"></div>
				<input type="text" value="" name="number" class="text_area" onInput="showSubmit()">
			</div>
		</div>
		<div id="btn" class="col_fullwidth" style="height:0px;">
			<input type="button" value="Ok, let's find me" onClick="formValidate()" class="btn darkgreen right">
		</div>
		<div id="confirm" class="col_fullwidth" style="height:0px;"></div>
		<div class="col_fullwidth" id="cancel"><a href="http://www.edukit.org.uk/contacts/"><input type="button" class="btn grey left" value="Cancel"></a></div>
	</div>
	</form>
</div>
<div class="modal"></div>
<?php } ?>
<script language="javascript" type="text/javascript">
	$('input').keypress(function(event){
		var enterOkClass =  jQuery(this).attr('class');
		if (event.which == 13 && enterOkClass != 'enterSubmit') {
			event.preventDefault();
			formValidate();
			return false;   
		}
	});

	function showNumber() {
		$( '#helpIntro' ).animate({ "height": "0px" }, 500);
		$( '#btn' ).animate({ "height": "0px" }, 500);
		if (form.orgOpt.value != "") {
			$( "#number" ).animate({ "height": "90px" }, 500 );
			$( '#confirm' ).animate({ "height": "0px" }, 500);
			if (form.orgOpt.value == "company") $('#numberLabel').text('What is your registered company number?:');
			else $('#numberLabel').text('What is your registered charity number?:');
		}
	}

	function showSubmit() {
		$( '#confirm' ).animate({ "height": "0px" }, 500);
		if ( (form.orgOpt.value == "company" && isCompanyNo(form.number)) || (form.orgOpt.value == "charity" && isCharityNo(form.number)) ) {
			$( "#btn" ).animate({ "height": "50px" }, 500 );
		} else if ($('#btn').css("height") != "0px") $( "#btn" ).animate({ "height": "0px" }, 500 );
	}

	function formValidate() {
		var submit = true;
		var focus = "";
		if (form.orgOpt.value == "") {
			if (focus == "") focus = form.orgOpt;
			form.orgOpt.style.border='1px solid #f05a49';
			submit = false;
		}
		if (form.number == "" && (!isCompanyNo(form.number) || !isCharityNo(form.number))) {
			if (focus == "") focus = form.number;
			form.number.style.border='1px solid #f05a49';
			submit = false;
		}
		if (focus != "") {
			focus.focus()
			focus = "";
		}
		if (submit) {
			if (form.orgOpt.value == "company" && (form.number.value.length == 5 || form.number.value.length == 7)) form.number.value = '0'+form.number.value;
			$('body').addClass("loading");
			$.post("<?php echo base_url(); ?>index.php/register_sp/findme/",{ orgOpt:form.orgOpt.value, number:form.number.value }, function (data) {
				console.log(data);
				$( '#confirm' ).html( data ).show();
				$('body').removeClass("loading");
			});
			showNumber();
		}
	}

	function accountInfo() {
			$( '#number' ).attr("type","hidden");
			$( '#orgOpt' ).attr("type","hidden");
			$( '#finder' ).animate({ "height":"0px" }, 500 );
			$( '#itsme' ).animate({ "height":"0px" }, 500 );
			$('#name').attr("readonly",true);
			$('#regdate').attr("readonly",true);
			$('#contact').attr("readonly",true);
			$('#address').attr("readonly",true);
			$('#email').attr("readonly",true);
			$('#postcode').attr("readonly",true);
			$('#web').attr("readonly",true);
			$('#updateInfo').animate({ "height":"0px" }, 500);
			$('#confirm').animate({ "height":"+=370px" }, 500);
			$('#userInfo').animate({ "height":"400px" }, 500);
	}

	function accountCheck() {
		if (isEmail(form.userEmail) && isEmail(form.userEmailConfirm) && form.userFname.value != "" && form.userLname.value != "" && isPhoneNo(form.phone)) {
			$( '#nextbtn' ).animate({ "height":"40px" }, 500 );
		}
	}

	function accountSubmit() {
		<?php 
		/*
		$users = new User();
		$users = $users->getUsers();
		for ($i=0; $i<sizeof($users); $i++) {
			$userArr[] = strtolower($users[$i]->getEmail());
		}
		*/
		?>
		var users = [ '<?php //echo implode("','",$userArr); ?>' ];
		var focus = "";
		var submit = true;
		if (form.userEmail.value == "" || !isEmail(form.userEmail) || users.indexOf(form.userEmail.value.toLowerCase()) != -1) {
			if (users.indexOf(form.userEmail.value) != -1) $('#emailerror').animate({"height":"30px"}, 500);
			if (focus == "") focus = form.userEmail;
			form.userEmail.style.border='1px solid #f05a49';
			submit = false;
				
		}
		if (form.userEmailConfirm.value == "" || !isEmail(form.userEmailConfirm)) {
			if (focus == "") focus = form.userEmailConfirm;
			form.userEmailConfirm.style.border='1px solid #f05a49';
			submit = false;
		}
		if (form.userEmail.value.toLowerCase() != form.userEmailConfirm.value.toLowerCase()) {
			if (focus == "") focus = form.userEmail;
			form.userEmail.style.border='1px solid #f05a49';
			form.userEmailConfirm.style.border='1px solid #f05a49';
			submit = false;
		}
		if (form.userFname.value == "") {
			if (focus == "") focus = form.userFname;
			form.userFname.style.border='1px solid #f05a49';
			submit = false;
		}
		if (form.userLname.value == "") {
			if (focus == "") focus = form.userLname;
			form.userLname.style.border='1px solid #f05a49';
			submit = false;
		}
		if (form.phone.value != "" && !isPhoneNo(form.phone)) {
			if (focus == "") focus = form.phone;
			form.phone.style.border='1px solid #f05a49';
			submit = false;
		}
		if (focus != "") focus.focus();
		if (submit) {
			$('body').addClass("loading");
			$( '#regdate' ).removeAttr("readonly");
			$.post("<?php echo base_url(); ?>index.php/register_sp/checklist",{orgOpt:form.orgOpt.value, number:form.number.value, name:form.name.value, regdate:form.regdate.value, contact:form.contact.value, phone:form.phone.value, address:form.address.value, postcode:form.postcode.value, website:form.web.value, userEmail:form.userEmail.value, userFname:form.userFname.value, userLname:form.userLname.value }, function (data) {
				$( '#confirm' ).html( data ).show();
				$('body').removeClass("loading");
			});
		}
	}

	function formSubmit() {
		var submit = true;
		var focus = "";
		if (form.safeguard.value == "") {
			if (focus == "") focus = form.safeguard;
			submit = false;
		}
		if (form.referee.value == "") {
			if (focus == "") focus = form.referee;
			submit = false;
		}
		if (form.insurance.value == "") {
			if (focus == "") focus = form.insurance;
			submit = false;
		}
		if (form.honesty.value == "") {
			if (focus == "") focus = form.honesty;
			submit = false;
		}
		if (submit) {
			$('body').addClass("loading");
			$.post("<?php echo base_url(); ?>/index.php/register_sp/submit",{ orgOpt:form.orgOpt.value, number:form.number.value, name:form.name.value, regdate:form.regdate.value, contact:form.contact.value, phone:form.phone.value, address:form.address.value, postcode:form.postcode.value, website:form.website.value, userEmail:form.userEmail.value, userFname:form.userFname.value, userLname:form.userLname.value, safeguard:$('input[name="safeguard"]:checked').val(), referee:$('input[name="referee"]:checked').val(), insurance:$('input[name="insurance"]:checked').val(), honesty:$('input[name="honesty"]:checked').val() }, function (data) {
				$('#cancel').hide();
				$( '#confirm' ).html( data ).show();
				$('body').removeClass("loading");
			});
		} //else $('#error').animate({ "height":"40px" }, 500);
	}

	function checkForgotten() {
		var submit = true;
		var focus = "";
		if (form2.fname.value == "") {
			if (focus == "") focus = form2.fname;
			form2.fname.style.border='1px solid #f05a49';
			submit = false;
		}
		if (form2.lname.value == "") {
			if (focus == "") focus = form2.lname;
			form2.lname.style.border='1px solid #f05a49';
			submit = false;
		}
		if (form2.email.value == "" || !isEmail(form2.email)) {
			if (focus == "") focus = form2.email;
			form2.email.style.border='1px solid #f05a49';
			submit = false;
		}
		if (focus != "") focus.focus();
		if (submit) form2.submit();
	}

	jQuery(document).ready(function($){
		style_forms();
	});
</script>