<?php
if (isset($school)) $school = $school[0];
if ($p == md5(Page::$sch[2]) && !in_array(Page::$sch[2],$_SESSION['privileges'])) $isEditable = false;
else if ($p == md5(Page::$sch[1]) && !in_array(Page::$sch[1],$_SESSION['privileges'])) $isEditable = false;
else if ($p == md5(Page::$sch[0])) $isEditable = false;
else $isEditable = true; ?>
<div class="popup" id="popup"></div>
<div id="wrapper">
<form method="post" action="<?php echo base_url() . "index.php/schools/view/" . md5(Page::$sch[0]); ?><?php if (isset($school->urn)) { ?>/<?php echo $school->urn; } ?>" enctype="multipart/form-data" name="form">
<?php if (isset($school) && $isEditable) { ?><input type="hidden" name="urn" value="<?php echo $school->urn; ?>"><?php } ?>
<input type="hidden" name="function" value="<?php if (isset($school)) echo "editSchool"; else echo "createSchool"; ?>">
	<div class="heading_bar rc orange">
		<h1>School Information</h1>
	</div>
	<div id="content" class="rc border_orange">
		<!---<div class="col_fullwidth header_section">
			<h1 class="font_orange" style="font-size:30px;">School Information</h1>
		</div>
		<div class="spacer20"></div>
		---->
		<div class="col_1third left">
			<div class="inner_col rc">
				<h3 class="font_grey"><?php if ($isEditable) if (isset($school)) echo "Edit"; else echo "Add"; ?> School Badge <a onclick="infoPopup('Uploading a School Badge','If you have a School Badge or logo, you can upload it here. For your Badge to look it&rsquo;s best, there are some recommended guidelines.\n&nbsp;\n&#8226;&nbsp;Image must be 300px x 300px\n&#8226;&nbsp;File must be no larger than 1MB\n&#8226;&nbsp;File format must be either .jpg, .png, or .gif');"><i class="fa fa-info-circle" style="cursor:pointer; margin-top:2px;"></i></a></h3>
				<div class="spacer10"></div>
				<div class="sp_logo rc"><img src="<?php echo base_url(); if (isset($school)) echo $school->badge; else echo "imgs/sp_logo_blank.png"; ?>" width="100%"/></div>
				<input name="badge" type="file" class="text_area" style="margin-top:10px; width:100%; overflow:hidden;"<?php if (!$isEditable) echo " DISABLED"; ?> accept="image/png, image/jpeg">

			</div>
			<div class="spacer30"></div>
			<div class="heading_bar rc darkblue">
				<h2>Sponsored By</h2>
			</div>
			<div class="inner_col rc">
				<div class="sp_logo rc"><img src="<?php echo base_url(); ?>imgs/sponsors/pearson-logo-260.png" width="100%"/></div>
			</div>
		</div>
		<div class="col_2third right">
			<div class="col_half left">
				<div class="inner_col rc">
					<div class="form_label">School Name:<font class="font_red">*</font></div>
					<input name="name" type="text" id="" class="text_area" onBlur="isNotEmpty(this);"<?php if (!$isEditable) echo " DISABLED"; ?> value="<?php if (isset($school)) echo $school->schoolName; ?>">
				</div>
			</div>
			<div class="col_half right" style="overflow:visible;">
				<div class="inner_col rc" style="height:110px;">
					<div class="form_label">UKPRN:<font class="font_red">*</font>
						<a onClick="infoPopup('UK Provider Reference Number','The UKPRN is an <bold>8 digit number</bold> allocated to your school by the UK Register of Learning Providers. This information is vital for successful creation of a school in our system. If in doubt, please ask a senior member of staff.');"><i class="fa fa-info-circle text-danger" style="cursor:pointer; font-size:13px;"></i></a>
					</div>
					<div class="col_fullwidth font_red" style="height:0px;" id="urnerror">This UKPRN is already registered. Please try another.</div>
					<?php if (isset($school)) echo "<center style='padding-top:8px;'><font class='font_orange' style='font-size:50px;'>".$school->urn."</font></center>"; ?><input name="urn" type="<?php if (isset($school)) echo "hidden"; else echo "text"; ?>" id="" class="text_area" onBlur="isNotEmpty(this); isUrn(this);"<?php if (!$isEditable) echo " DISABLED"; ?> value="<?php if (isset($school)) echo $school->urn; ?>"<?php if (!isset($userI)) { ?>onInput="$('#urnerror').animate({'height':'0px'}, 500); isEmail(this);"<?php } ?>>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="col_half left">
				<div class="inner_col rc">
					<h3 class="font_grey">School Information</h3>
					<div class="spacer10"></div>
					<div class="col_fullwidth">
						<div class="form_label">Main User:<font class="font_red">*</font> <a onClick="infoPopup('Main User','This sets the default user account for the school. We recommend this be the Headteacher or the School Administrator.');"><i class="fa fa-info-circle text-danger" style="cursor:pointer; font-size:13px;"></i></a></div>
						<select name="userId" class="text_area select_img" style="overflow:hidden;"<?php if (!$isEditable) echo " DISABLED"; ?>>
							<?php
							/* $users = new User();
							$users = $users->getUsers();
							for ($i=0; $i<sizeof($users); $i++) {
								$userType = $users[$i]->getUserType();
								$schoolStaff = $users[$i]->getSchoolStaff();
								if (($userType->getName() == "School Manager" || $userType->getName() == "School Administrator" || $userType->getName() == "Teacher")) {
									if ((unserialize($_SESSION['type'])->getName() == "Edukit Administrator" || unserialize($_SESSION['type'])->getName() == "Edukit Staff") || ($school != null && $users[$i]->getSchoolStaff() != null && $users[$i]->getSchoolStaff()->getSchoolId() == unserialize($_SESSION['role'])->getSchoolId())) {
										echo "<option value='".$users[$i]->getId()."'";
										if ((isset($school) && $school->getUserId() == $users[$i]->getId())) echo " SELECTED";
										echo ">".$users[$i]->getFname()." ".$users[$i]->getLname(). " (".$users[$i]->getUserType()->getName().")</option>";
									}
								}
							} 
							*/
							?>
						</select>
					</div>
					<div class="col_fullwidth">
						<div class="form_label">Contact Number:<font class="font_red">*</font></div>
						<input name="phone" type="text" id="" class="text_area" onBlur="isNotEmpty(this); isPhoneNo(this);"<?php if (!$isEditable) echo " DISABLED"; ?> value="<?php if (isset($school)) echo $school->phone; ?>">
					</div>
					<div class="col_fullwidth">
						<div class="form_label">Enter School Address:<font class="font_red">*</font>
						</div>
						<textarea name="address" id="" rows="5" class="text_area" onBlur="isNotEmpty(this);"<?php if (!$isEditable) echo " DISABLED"; ?>><?php if (isset($school)) echo $school->address; ?></textarea>
					</div>
					<div class="col_fullwidth">
						<div class="form_label">Select a borough:<font class="font_red">*</font></div>
						<select name="boroughId" class="text_area select_img"<?php if (!$isEditable) echo " DISABLED"; ?>>
						<?php 
						/*if (!isset($school)) { ?>
						<option value="">Please select a borough</option>
						<?php }
						$cities = new City();
						$cities = $cities->getCities();
						for ($i=0; $i<sizeof($cities); $i++) {
							echo "<optgroup label='".$cities[$i]->getCity()."'>";
							$boroughs = $cities[$i]->getBoroughs();
							for ($ii=0; $ii<sizeof($boroughs); $ii++) {
								echo "<option value='".$boroughs[$ii]->getId()."'";
								if (isset($school) && $school->getBoroughId() == $boroughs[$ii]->getId()) echo " SELECTED";
								echo ">".$boroughs[$ii]->getBorough()."</option>";
							}
							echo "</optgroup>";
						} */?>
						</select>
					</div>
					<div class="col_fullwidth">
						<div class="form_label">Postcode:<font class="font_red">*</font></div>
						<input name="postcode" type="text" id="" class="text_area" onBlur="isNotEmpty(this); isPostcode(this);"<?php if (!$isEditable) echo " DISABLED"; ?> value="<?php if (isset($school)) echo $school->postcode; ?>">
					</div>
				</div>
			</div>
			<div class="col_half right">
				<div class="inner_col rc">
					<h3 class="font_grey">Further Information</h3>
					<div class="spacer10"></div>
					<div class="col_fullwidth">
						<div class="form_label">Total number of students in school:</div>
						<input name="totalStudents" type="text" id="" class="text_area" onBlur="isPositiveInt(this);"<?php if (!$isEditable) echo " DISABLED"; ?> value="<?php if (isset($school)) echo $school->totalStudents; ?>">
					</div>
					<div class="col_fullwidth">
						<div class="form_label">Total of students on pupil premium:</div>
						<input name="premiumStudents" type="text" id="" class="text_area" onBlur="isPositiveInt(this);"<?php if (!$isEditable) echo " DISABLED"; ?> value="<?php if (isset($school)) echo $school->premiumStudents; ?>">
					</div>
					<div class="col_fullwidth">
						<div class="form_label">Number of students to match:</div>
						<input name="matchStudents" type="text" id="" class="text_area" onBlur="isPositiveInt(this);"<?php if (!$isEditable) echo " DISABLED"; ?> value="<?php if (isset($school)) echo $school->matchStudents; ?>">
					</div>
					<div class="inner_col rc" style="margin-bottom:10px;">
						<div class="col_fullwidth">
							<div class="form_label">Please specify the start time for students in the school</div>
							<select name="startHour" class="text_area select_img" style="width:70px; margin-right:4px;"<?php if (!$isEditable) echo " DISABLED"; ?>>
							<?php if (isset($school)) {
								$start = explode(":",$school->startTime);
								$end = explode(":",$school->finishTime);
							}
							for ($i=0; $i<24; $i++) {
								echo "<option value='";
								if ($i < 10) echo "0";
								echo $i;
								echo "'";
								if (isset($start[0]) && $i == $start[0]) echo " SELECTED";
								else if (!isset($start[0]) && $i == 9) echo " SELECTED";
								echo ">";
								if ($i < 10) echo "0";
								echo $i;
								echo "</option>";
							} ?>
							</select>
							<p style="display: inline; font-size: 30px; line-height: 33px; float: left; margin-right: 5px;">:</p>
							<select name="startMin" class="text_area select_img" style="width:70px;"<?php if (!$isEditable) echo " DISABLED"; ?>>
							<?php for ($i=0; $i<60; $i++) {
								echo "<option value='";
								if ($i < 10) echo "0";
								echo $i;
								echo "'";
								if (isset($start[1]) && $i == $start[1]) echo " SELECTED";
								echo ">";
								if ($i < 10) echo "0";
								echo $i;
								echo "</option>";
							} ?>
							</select>
						</div>
						<div class="col_fullwidth">
							<div class="form_label">Please specify the finish time for students in the school</div>
							<select name="endHour" class="text_area select_img" style="width:70px; margin-right:4px;"<?php if (!$isEditable) echo " DISABLED"; ?>>
							<?php for ($i=0; $i<24; $i++) {
								echo "<option value='";
								if ($i < 10) echo "0";
								echo $i;
								echo "'";
								if (isset($end[0]) && $i == $end[0]) echo " SELECTED";
								else if (!isset($end[0]) && $i == 15) echo " SELECTED";
								echo ">";
								if ($i < 10) echo "0";
								echo $i;
								echo "</option>";
							} ?>
							</select>
							<p style="display: inline; font-size: 30px; line-height: 33px; float: left; margin-right: 5px;">:</p>
							<select name="endMin" class="text_area select_img" style="width:70px;"<?php if (!$isEditable) echo " DISABLED"; ?>>
							<?php for ($i=0; $i<60; $i++) {
								echo "<option value='";
								if ($i < 10) echo "0";
								echo $i;
								echo "'";
								if (isset($end[1]) && $i == $end[1]) echo " SELECTED";
								else if (!isset($end[1]) && $i == 30) echo " SELECTED";
								echo ">";
								if ($i < 10) echo "0";
								echo $i;
								echo "</option>";
							} ?>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="inner_col rc">
				<div class="col_half left">
					<div class="form_label">School MIS Server IP:
						<a onClick="infoPopup('School MIS Server IP','This is the IP address of your school MIS server.');"><i class="fa fa-info-circle text-danger" style="cursor:pointer; font-size:13px;"></i></a>
					</div>
					<input name="serverIP" type="text" id="" class="text_area" onBlur="if (isNotEmpty(this)) isIP(this);"<?php if (!$isEditable) echo " DISABLED"; ?> value="<?php if (isset($school)) echo $school->s_serverIP; ?>">
				</div>
				<div class="col_half right">
					<div class="form_label">School Network Mask:
						<a onClick="infoPopup('School Network Mask','This is the public IP of your school network. This stops people from accessing your network outside of the school network.');"><i class="fa fa-info-circle text-danger" style="cursor:pointer; font-size:13px;"></i></a>
					</div>
					<input name="schoolNetwork" type="text" id="" class="text_area" onBlur="if (isNotEmpty(this)) isNetworkMask(this)"<?php if (!$isEditable) echo " DISABLED"; ?> value="<?php if (isset($school)) echo $school->s_schoolNetwork; ?>">
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="col_fullwidth footer_section">
		<?php if ($isEditable) { ?>
		<input type="button" name="schoolBtn" class="btn darkgreen rc right" value="<?php if (isset($school)) echo "Save"; else echo "Create School"; ?>" style="margin-top:10px;" onClick="formValidate();">
		<?php } ?>
		</div>
	</div>
</form>
</div>
<script>
	function formValidate() {
		var submit = true;
		var focus = "";
		<?php if (!isset($school)) {
			//$schools = new School();
			//$schools = $schools->getSchools();
			//for ($i=0; $i<sizeof($schools); $i++) {
			//	$schoolArr[] = $schools[$i]->getUrn();
			//}
			?>
		var schools = [ '<?php echo implode("','",$schoolArr); ?>' ];
		<?php } else { ?>
		var schools = [];
		<?php } ?>

		<?php if (!isset($school)) { ?>
		if (!isNotEmpty(form.urn) || !isUrn(form.urn) || schools.indexOf(form.urn.value) != -1) {
			if (schools.indexOf(form.urn.value) != -1) $('#urnerror').animate({"height":"60px"}, 500);
			if (focus == "") focus = form.urn;
			form.urn.style.border='1px solid #f05a49';
			submit = false;
		}
		<?php } ?>
		if (!isNotEmpty(form.userId)) {
			if (focus == "") focus = form.userId;
			form.userId.style.border='1px solid #f05a49';
			submit = false;
		}
		if (!isNotEmpty(form.name)) {
			if (focus == "") focus = form.name;
			form.name.style.border='1px solid #f05a49';
			submit = false;
		}
		if (!isNotEmpty(form.phone) || !isPhoneNo(form.phone)) {
			if (focus == "") focus = form.phone;
			form.phone.style.border='1px solid #f05a49';
			submit = false;
		}
		if (!isNotEmpty(form.address)) {
			if (focus == "") focus = form.address;
			form.address.style.border='1px solid #f05a49';
			submit = false;
		}
		if (!isNotEmpty(form.boroughId)) {
			if (focus == "") focus = form.boroughId;
			form.boroughId.style.border='1px solid #f05a49';
			submit = false;
		}
		if (!isNotEmpty(form.postcode) || !isPostcode(form.postcode)) {
			if (focus == "") focus = form.postcode;
			form.postcode.style.border='1px solid #f05a49';
			submit = false;
		}
		if (form.totalStudents.value != "" && !isPositiveInt(form.totalStudents)) {
			if (focus == "") focus = form.totalStudents;
			form.totalStudents.style.border='1px solid #f05a49';
			submit = false;
		}
		if (form.premiumStudents.value != "" && !isPositiveInt(form.premiumStudents)) {
			if (focus == "") focus = form.premiumStudents;
			form.premiumStudents.style.border='1px solid #f05a49';
			submit = false;
		}
		if (form.matchStudents.value != "" && !isPositiveInt(form.matchStudents)) {
			if (focus == "") focus = form.matchStudents;
			form.matchStudents.style.border='1px solid #f05a49';
			submit = false;
		}
		if (form.serverIP.value != "" && !isIP(form.serverIP)) {
			if (focus == "") focus = form.serverIP;
			form.serverIP.style.border='1px solid #f05a49';
			submit = false;
		}
		if (form.schoolNetwork.value != "" && !isNetworkMask(form.schoolNetwork)) {
			if (focus == "") focus = form.schoolNetwork;
			form.schoolNetwork.style.border='1px solid #f05a49';
			submit = false;
		}
		if (focus != "") {
			focus.focus();
			focus = "";
		}
		if (submit) form.submit();
	}

	jQuery(document).ready(function($){	
		style_forms()
	});
</script>