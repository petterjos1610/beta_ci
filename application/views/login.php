<div class="popup">
	<div id="info_popup">
		<div id="popup_inner" class="border_red rc">
			<div id="popup_close"><a onClick="$('body').removeClass('loading');">Close</a></div>
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
<div id="wrapper">
	<div class="login_wrapper rc">
		<div class="login-form-wrap">
			<div class="login-logo"><a href="#" title="edukit"><img src="<?php echo base_url(); ?>imgs/edukit_logo_trans.png" width="230" alt="login-logo"></a></div>
			<?php if (isset($_POST['failed']) && !$_POST['failed']) { ?>
		</div>
		<div class="spacer30"></div>
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
		</div>
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
			<form method="POST" action='<?php echo base_url(); ?>index.php'>
				<input type="hidden" name="function" value="userLogin">
				<div class="col_fullwidth">
					<input class="text_area" type="text" value="<?php if (isset($_COOKIE['rememberme'])) { $user = new User(); $user->load($_COOKIE['rememberme']); echo $user->getEmail(); } else echo "Email"; ?>" name="user" onFocus="javascript:if (this.value=='Email' || this.value=='') { this.value=''; this.style.color='#000000'; }" onBlur="javascript:if (!isEmail(this)) this.focus;">
				</div>
				<div class="col_fullwidth">
					<input class="text_area"  type="text" name="pass" value="Password" onFocus="javascript:if (this.value=='' || this.value == 'Password') { this.value=''; this.style.color='#000000'; this.setAttribute('type','password'); }" onBlur="javascript:if (isEmpty(this,'pass')) this.focus;" >
				</div>
				<div class="col_fullwidth">
					<input id="enable" class="css-checkbox" type="checkbox" name="rememberme" value="1"<?php if (isset($_COOKIE['rememberme'])) echo " checked='checked'"; ?>/>
					<label for="enable" class="css-label">Remember me</label>
				</div>
				<div class="col_fullwidth" style="margin-top:10px; margin-bottom:10px; font-size:11px;">
					<a onClick="$('body').addClass('loading');" href="#">Forgotten your password?</a>&nbsp;
				</div>
				<input class="btn darkgreen grad rc" type="submit" value="Login" id="login" style="width:100%">
			</form>
				<div class="col_fullwidth">
					<div style="width:100%; vertical-align:top; margin-top:40px; margin-left:auto; margin-right:auto;">
						<a href="Edukit_Connector.pdf" target="blank"><img src="<?php echo base_url(); ?>imgs/RapidSSL_SEAL.gif" alt="TheSSLStore.com" border="0" width="34%" valign="middle"/></a>&nbsp;&nbsp;&nbsp;&nbsp;
						<a href="Edukit_Connector.pdf" target="blank"><img src="<?php echo base_url(); ?>imgs/iso.png" alt="TheSSLStore.com" border="0" width="45%" valign="middle"/></a>
					</div>
				</div>
		</div>
		<div class="clickarea rc">
			<h1 style="padding-top: 25px; padding-left: 30px; width: 220px; font-size: 30px; line-height: 30px; font-weight: bold;">The Smart way to get Students the Support they need!</h1>
			<div class="link-tabs" style="margin:0px; padding:0px;">
				<a href="<?php echo base_url(); ?>index.php/register_sp/"; ?>">
				    <div class="login_tab_green rc"> I am a service provider
				        <div class="login_tab_cta_green">Sign Up&nbsp;&nbsp;<i class="fa fa-angle-right"></i>
				        </div>
					</div>
				</a> 
				<a href="http://www.edukit.org.uk/contacts/">
				    <div class="login_tab_orange rc"> I am a school
				        <div class="login_tab_cta_orange">Sign Up&nbsp;&nbsp;<i class="fa fa-angle-right"></i>
				        </div>
					</div>
				</a>
				<a href="http://www.edukit.org.uk/contacts/">
				    <div class="login_tab_blue rc"> I'm just curious
				        <div class="login_tab_cta_blue">Take a look&nbsp;&nbsp;<i class="fa fa-angle-right"></i>
				        </div>
				    </div>
				</a>
			</div>
		<?php } ?>
		</div>
	</div>
</div>
<script>
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
</script>