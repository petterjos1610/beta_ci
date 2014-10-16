<div class="popup">
	<div id="info_popup">
		<div id="popup_inner" class="border_red rc">
			<div id="popup_close"><a onClick="$('body').removeClass('loading');">Cancel</a></div>
			<div class="heading_bar rc red">
				<h2>Reset password</h2>
			</div>
			<div id="popup_content" class="inner_col rc">
				<div class="col_fullwidth">
					Please note: you are about to reset this account's password. The new password will be sent to the account holder's email address within 24 hours, which they can use to log into their account.
				</div>
				<div class="spacer30"></div>
				<input type="button" class="btn darkgreen rc right" value="Confirm password reset" onClick="resetPassword();">
			</div>
		</div>
	</div>
</div>
<div id="wrapper">
	<div class="heading_bar rc orange">
		<h1><?php if (isset($schStaff)) echo "Edit"; else echo "Add"; ?> Staff Member</h1>
	</div>
	<div id="content" class="rc border_orange" style="">
		<!----<div class="col_fullwidth header_section ">
			<h1 class="font_orange" style="font-size:50px;"><?php if (isset($schStaff)) echo "Edit"; else echo "Add"; ?> Staff Member</h1>
		</div>
		<div class="spacer20"></div>
		---->
		<?php if (isset($schStaff)) { ?>
		<div class="col_fullwidth">
			<input type="button" class="btn darkblue rc right" value="Reset Password" style="margin-bottom:20px;" onClick="$('body').addClass('loading');">
		</div>
		<?php } ?>
		<form name="form" action="?p=<?php echo md5(Page::$stf[0]); ?>" method="POST">
			<input type="hidden" name="function" value="<?php if (isset($schStaff)) echo "editSchoolStaff"; else echo "createSchoolStaff"; ?>">
			<?php if (isset($schStaff)) { ?>
			<input type="hidden" name="userId" value="<?php echo $schStaff->s_userId; ?>">
			<input type="hidden" name="reset" value="0">
			<?php } ?>
			<div class="inner_col rc" style="width:100%; margin-left:auto; margin-right:auto; padding:30px">
			<div class="plain left" style="width:30%; margin-right:4%">
				<div class="form_label">Forename:<font class="font_red">*</font></div>
				<input name="fname" type="text" id="" class="text_area" onBlur="isNotEmpty(this)" value="<?php if (isset($schStaff)) echo $schStaff->fname; ?>">
			</div>
			<div class="plain left" style="width:30%; margin-right:4%">
				<div class="form_label">Surname:<font class="font_red">*</font></div>
				<input name="lname" type="text" id="" class="text_area" onBlur="isNotEmpty(this)" value="<?php if (isset($schStaff)) echo $schStaff->lname; ?>">
			</div>
			<div class="plain left" style="width:30%;">
				<div class="form_label">Display Name:</div>
				<input name="displayName" type="text" id="" class="text_area" value="<?php if (isset($schStaff)) echo $schStaff->s_displayName; ?>">
			</div>
			<div class="col_fullwidth">
			<div class="plain left" style="width:48%">
				<div class="form_label">Email Address:<font class="font_red">*</font></div>
				<input name="email" type="text" id="" class="text_area" onBlur="isNotEmpty(this); isEmail(this);"  value="<?php if (isset($schStaff)) echo $schStaff->email; ?>"<?php if (isset($schStaff)) echo " readonly"; ?>>
			</div>
			<div class="plain right" style="width:48%">
				<div class="form_label">Phone Number:</div>
				<input name="phone" type="text" id="" class="text_area" onBlur="if (this.value != '') isPhoneNo(this);"  value="<?php if (isset($schStaff)) echo $schStaff->s_phone; ?>">
			</div>
			<div class="col_fullwidth">
				<div class="plain left" style="width:48%">
					<div class="form_label">Account Type:<font class="font_red">*</font></div>
					<select name="userTypeId" class="text_area select_img">
						<?php
						/*
							$accounts = new UserType();
							$accounts = $accounts->getUserTypes();
							for ($i=0; $i<sizeof($accounts); $i++) {
								if ($accounts[$i]->getName() == "School Administrator" || $accounts[$i]->getName() == "School Manager" || $accounts[$i]->getName() == "Teacher") {
									if (!isset($_SESSION['role']) || unserialize($_SESSION['type'])->getName() == "School Administrator" || (unserialize($_SESSION['type'])->getName() == "School Manager" && $accounts[$i]->getName() == "School Manager") || (unserialize($_SESSION['type'])->getName() == "Teacher" && $accounts[$i]->getName() == "Teacher")) {
										echo "<option value='".$accounts[$i]->getId()."'";
										if (isset($schStaff) && $schStaff->getUser()->getUserTypeId() == $accounts[$i]->getId()) echo " SELECTED";
										echo ">".$accounts[$i]->getName()."</option>";
									}
								}
							}
							*/
						?>
					</select>
				</div>
				<div class="plain right" style="width:48%">
					<div class="form_label">School:<font class="font_red">*</font></div>
					<select name="urn" class="text_area select_img"<?php if (isset($_SESSION['role'])) echo " readonly"; ?>>
						<?php
						/*
							$schools = new School();
							$schools = $schools->getSchools();
							for ($i=0; $i<sizeof($schools); $i++) {
								if (!isset($_SESSION['role']) || (unserialize($_SESSION['role'])->getSchoolId() == $schools[$i]->getUrn())) {
									echo "<option value='".$schools[$i]->getUrn()."'";
									if (isset($schStaff) && $schStaff->getSchoolId() == $schools[$i]->getUrn()) echo " SELECTED";
									echo ">".$schools[$i]->getSchoolName()."</option>";
								}
							}
						*/
						?>
					</select>
				</div>
			</div>
			<div class="col_fullwidth">
				<div class="plain left" style="width:48%; margin-right:4%">
					<div class="form_label">&nbsp;</div>
					<input id="enable" class="css-checkbox" type="checkbox" name="enabled" value="1"<?php if (isset($schStaff) && $schStaff->enabled) echo " CHECKED"; else if (!isset($schStaff) && !$this->input->post('enabled')) echo " CHECKED"; ?>/>
					<label for="enable" class="css-label">Enable</label>
				</div>
			</div>
		</div>
	</div>
	<div class="col_fullwidth footer_section">
		<input type="submit" class="btn darkgreen rc right" value="<?php if (isset($schStaff)) echo "Save"; else echo "Add Account"; ?>">
	</div>
	</form>
</div>
<script>
	function resetPassword() {
		form.reset.value ='1';
		form.submit();
	}
	jQuery(document).ready(function($) {	
		style_forms();
	});
</script>