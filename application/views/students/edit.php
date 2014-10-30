<?php //print_r($student); ?>
<div class="popup" id="popup"></div>

<div id="wrapper">
<form name="form" method="POST" action="<?php echo base_url() . "index.php/students/edit/" . md5(Page::$stu[0]); ?>">
	<input type="hidden" name="function" value="<?php if (isset($student)) echo "editStudent"; else echo "createStudent"; ?>">
	<div class="heading_bar rc orange">
		<h1><?php if (isset($student)) echo "Edit"; else "Create"; ?> Student Profile</h1>
	</div>
	<div id="content" class="rc border_orange">
			<div class="inner_col rc" style="padding-top:10px; padding-bottom:0px;">
				<h3 class="font_grey">Student Information</h3>
				<div class="spacer20"></div>
				<div class="col_half left">
					<div class="col_half left">
						<div class="form_label">Forename:<font class="font_red">*</font></div>
						<input name="fname" type="text" class="text_area" onBlur="isNotEmpty(this);" tabIndex="1" value="<?php if (isset($student)) echo $student->fname; ?>">
					</div>
					<div class="col_half right">
						<div class="form_label">Surname:<font class="font_red">*</font></div>
						<input name="lname" type="text" id="" class="text_area" onBlur="isNotEmpty(this);" tabIndex="2" value="<?php if (isset($student)) echo $student->lname; ?>">
					</div>
					<div class="clearfix"></div>
					
					<div class="plain vert_space" style="overflow:hidden;">
						<div class="form_label label_inline">Gender:<font class="font_red">*</font></div>
						<div style="position:relative; left:12px; padding-bottom:15px;">
							<input type="radio" name="gender" id="male" class="css-checkbox" value="male"<?php if (isset($student) && $student->s_male) echo " CHECKED"; ?>/>
							<label for="male" class="css-label" tabIndex="3">Male</label>&nbsp;&nbsp;
							<input type="radio" name="gender" id="female" class="css-checkbox" value="female"<?php if (isset($student) && $student->s_female) echo " CHECKED"; ?>/>
							<label for="female" class="css-label" tabIndex="4">Female</label>
						</div>
					</div>
					<div class="plain vert_space" style="margin-top:15px;">
						<div class="form_label label_inline">D.O.B:<font class="font_red">*</font></div>
						<div class="plain" style="padding-left:10px; margin-left:2px; display:inline-block;">
						<select name="dobDay" class="text_area select_img" style="width:90px;" onBlur="isNotEmpty(this);" tabIndex="6">
						<option value="" SELECTED DISABLED>Day</option>
						<?php
						if (isset($student)) $studentDob = explode("-",$student->s_dob);
						for ($i=1; $i<32; $i++ ) {
							echo "<option value='$i'";
							if (isset($studentDob) && $i == $studentDob[2]) echo " SELECTED";
							echo ">$i</option>";
						} ?>
						</select>
						</div>
						<div class="plain" style="display:inline-block;">
						<select name="dobMonth" class="text_area select_img"  style="width:90px;" onBlur="isNotEmpty(this);" tabIndex="7">
						<option value="" SELECTED DISABLED>Month</option>
						<?php for ($i=1; $i<13; $i++ ) {
							echo "<option value='$i'";
							if (isset($studentDob) && $i == $studentDob[1]) echo " SELECTED";
							echo ">$i</option>";
						} ?>
						</select>
						</div>
						<div class="plain" style="display:inline-block;">
						<select name="dobYear" class="text_area select_img"  style="width:90px;" onBlur="isNotEmpty(this);" tabIndex="8">
						<option value="" SELECTED DISABLED>Year</option>
						<?php for ($i=date("Y")-11; $i>date("Y")-20; $i-- ) {
							echo "<option value='$i'";
							if (isset($studentDob) && $i == $studentDob[0]) echo " SELECTED";
							echo ">$i</option>";
						} ?>
						</select>
						</div>
					</div>
					<!---<div class="plain vert_space">
						<div class="form_label label_inline">Year:</div>
						<input name="" type="text" id="" class="text_area input_inline">
					</div>---->
					<div class="col_half left">
						<div class="form_label">Ethnic Background:<font class="font_red">*</font></div>
						<select name="ethnicityId" id="" class="text_area select_img" onBlur="isNotEmpty(this);" tabIndex="10" style="overflow:hidden">
							<option value="" SELECTED DISABLED>Choose ethnicity</option>
							<?php 
							/*
							$ethnicities = new Ethnicity();
							$ethnicities = $ethnicities->getEthnicities();
							for ($i=0; $i<sizeof($ethnicities); $i++) {
								echo "<option value='".$ethnicities[$i]->getId()."'";
								if (isset($student) && $student->getEthnicityId() == $ethnicities[$i]->getId()) echo " SELECTED";
								echo ">".$ethnicities[$i]->getEthnicity()."</option>";
							}
							*/
							?>
						</select>
					</div>
					<div class="col_half right">
						<div class="form_label">Religious Affiliation:<font class="font_red">*</font></div>
						<select name="religionId" id="" class="text_area select_img" onBlur="isNotEmpty(this);" tabIndex="11" style="overflow:hidden">
						<option value="" SELECTED DISABLED>Choose religion</option>
						<?php
						/*
						$religions = new Religion();
						$religions = $religions->getReligions();
						for ($i=0; $i<sizeof($religions); $i++) {
							echo "<option value='".$religions[$i]->getId()."'";
							if (isset($student) && $student->getReligionId() == $religions[$i]->getId()) echo " SELECTED";
							echo ">".$religions[$i]->getReligion()."</option>";
						}
						*/
						?>
						</select>
					</div>
				</div>
				<div class="col_half right">
					
					<div class="plain vert_space">
						<div class="form_label">Email:</div>
						<input name="email" type="text" id="" class="text_area" onBlur="if (this.value != '') isEmail(this);" tabIndex="5" value="<?php if (isset($student)) echo $student->email; ?>">
					</div>
					<div class="plain vert_space">
						<div class="form_label label_inline">Pastoral:<font class="font_red">*</font>
							<a onClick="infoPopup('Pastoral Teacher','This is the teacher in charge of updating the student&rsquo;s progress.');"><i class="fa fa-info-circle text-danger" style="cursor:pointer; font-size:13px;"></i></a>
						</div>
						<div class="plain">
							<select name="teacherId" id="" class="text_area select_img" onBlur="isNotEmpty(this);" tabIndex="9">
								<option value="">Choose pastorial teacher</option>
								<?php
								/*
									$schStaff = new SchoolStaff();
									$schStaff = $schStaff->getStaff();
									for ($i=0; $i<sizeof($schStaff); $i++) {
										if (!isset($_SESSION['role']) || (isset($_SESSION['role']) && unserialize($_SESSION['role'])->getSchoolId() == $schStaff[$i]->getSchoolId())) {
											echo "<option value='".$schStaff[$i]->getUserId()."'";
											if (isset($student) && $student->getTeacherId() == $schStaff[$i]->getUserId()) echo " SELECTED";
											echo ">".$schStaff[$i]->getDisplayName()."</option>";
										}
									}
								*/
								?>
							</select>
						</div>
					</div>
					<div class="plain vert_space"><div class="form_label label_inline">School:<font class="font_red">*</font></div>
						<div class="plain">
							<select name="urn" id="" class="text_area select_img" onBlur="isNotEmpty(this);" tabIndex="12">
								<?php if (!isset($_SESSION['role'])) { ?><option value="">Choose school</option><?php } ?>
								<?php
								/*
									$schools = new School();
									$schools = $schools->getSchools();
									for ($i=0; $i<sizeof($schools); $i++) {
										if (!isset($_SESSION['role']) || (unserialize($_SESSION['role'])->getSchoolId() == $schools[$i]->getUrn())) {
											echo "<option value='".$schools[$i]->getUrn()."'";
											if (isset($student) && $student->getSchoolId() == $schools[$i]->getUrn()) echo " SELECTED";
											echo ">".$schools[$i]->getSchoolName()."</option>";
										}
									}
								*/
								?>
							</select>
						</div>
					</div>
					<div class="plain vert_space">
						<div class="plain" style="overflow:hidden; margin-top:35px;">
							<input name="active" id="active" class="css-checkbox" type="checkbox" value="1"<?php if (!isset($student) || (isset($student) && $student->enabled)) echo " CHECKED"; ?>/>
								<label for="active" class="css-label">Active</label>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="expandable" style="margin-top:20px;">
					<div class="expandable_title rc red" style="margin-bottom:20px;">
						<h2>Sensitive Information</h2>
					</div>
					<div class="expandable_content" style="padding:0">
						<div class="col_half left" style="height:140px;">
							<div class="plain vert_space">
								<div class="form_label label_inline">UPN:<font class="font_red">*</font>
									<a onClick="infoPopup('UPN','Thirteen characters long, the Unique Pupil Number is a number that identifies each pupil in England uniquely. It is intended to remain with them throughout their school career regardless of any change in school or LA.');"><i class="fa fa-info-circle text-danger" style="cursor:pointer; font-size:13px;"></i></a>
								</div>
								<?php if (isset($student)) echo $student->s_upn; ?><input name="upn" type="<?php if (isset($student)) echo "hidden"; else echo "text"; ?>" id="" class="text_area input_inline" onBlur="isNotEmpty(this); isUpn(this);" tabIndex="13" value="<?php if (isset($student)) echo $student->s_upn; ?>">
							</div>
							<!---<div class="plain vert_space"><div class="form_label  label_inline">Former UPN:</div>
							<input name="prevUpn" type="text" id="" class="text_area input_inline" tabIndex="13"></div>---->
							<div class="plain vert_space">
								<div class="form_label label_inline">ULN:
									<a onClick="infoPopup('ULN','Ten digits long, the Unique Learner Number (ULN) is a reference number issued and held by the Learner Register (LR). This is used alongside and to access the Personal Learning Record of anyone over the age of 14 involved in UK education or training. The 10-digit ULN has been designed to ensure that no additional meaning can be inferred from its structure e.g. geographical location, level of learning.');"><i class="fa fa-info-circle text-danger" style="cursor:pointer; font-size:13px;"></i></a>
								</div>
								<input name="uln" type="text" id="" class="text_area input_inline" onBlur="if (this.value != '') isUln(this);" tabIndex="14" value="<?php if (isset($student)) echo $student->s_uln; ?>">
							</div>
						</div>
						<div class="col_half right" style="height:140px;">
							<div class="plain vert_space">
								<div class="form_label label_inline">Address:<font class="font_red">*</font></div>
								<textarea name="address" id="" class="text_area input_inline" onBlur="isNotEmpty(this);" tabIndex="15"><?php if (isset($student)) echo $student->s_address; ?></textarea>
							</div>
							<div class="plain vert_space">
								<div class="form_label label_inline">Postcode:<font class="font_red">*</font></div>
								<input type="text" name="postcode" id="" class="text_area input_inline" onBlur="isNotEmpty(this); isPostcode(this);" tabIndex="16" value="<?php if (isset($student)) echo $student->s_postcode; ?>">
							</div>
						</div>
						<div class="col_half left">
							<div class="form_label label_inline">Behaviour Points Total:</div>
							<input name="behaviourPoints" type="text" id="behaviourPoints" class="text_area input_inline" tabIndex="17" value="<?php if (isset($student)) echo $student->s_behaviourPoints; ?>">
						</div>
						<div class="col_half right">
							<div class="form_label label_inline">Achievement Points Total:</div>
							<input name="achievementPoints" type="text" id="achievementPoints" class="text_area input_inline" tabIndex="18" value="<?php if (isset($student)) echo $student->s_achievementPoints; ?>">
						</div>
						<div class="spacer30"></div>
						<div class="form_label">Student Types:</div>
						<?php
						$tabIndex = 19;
						/*
						$studentTypes = new StudentType();
						if (isset($student)) $studentsTypes = $student->getStudentTypes();
						$studentTypes = $studentTypes->getStudentTypes();
						for ($i=0; $i<sizeof($studentTypes); $i++) { ?>
							<div class="plain" style="width:25%; float:left">
								
								<input name="studentType[]" id="<?php echo $studentTypes[$i]->getName(); ?>" class="css-checkbox" type="checkbox" value="<?php echo $studentTypes[$i]->getId(); ?>"
								<?php if (isset($studentsTypes)) {
									for ($a=0; $a<sizeof($studentsTypes); $a++) {
										if ($studentsTypes[$a]->getStudentTypeId() == $studentTypes[$i]->getId()) echo " CHECKED";
									} 
								} ?>/>
								<label for="<?php echo $studentTypes[$i]->getName(); ?>" class="css-label" tabIndex="<?php echo $tabIndex+$i; $tabIndex += $i; ?>"><?php echo $studentTypes[$i]->getName(); ?></label>
							</div>
						<?php } 
						*/
						?>
					</div>
				</div>
			</div>
			<div class="inner_col rc">
			<?php if (isset($student)) {
				/*
				$schAtt = $student->getSchoolAttendance();
				if ($schAtt != null) {
					$today = new DateTime();
					$date1 = explode("-",$schAtt->getStartDate());
					$date2 = explode("-",$schAtt->getEndDate());
					$startDate = new DateTime();
					$endDate = new DateTime();
					$startDate->setDate($date1[0],$date1[1],$date1[2]);
					$endDate->setDate($date2[0],$date2[1],$date2[2]);
				}
				*/
			}
			?>
				<h3 class="font_grey">Attendance Information <a onclick="infoPopup('Attendance Information','Please provide full details of attendance and then click the &ldquo;Create new Attendance Record&rdquo; button below when finished.');"><i class="fa fa-info-circle font_white" style="cursor:pointer; font-size:19px; float:right; margin-top:2px;"></i></a></h3>
				<div class="spacer20"></div>
				<div class="col_fullwidth rc font_grey" id="newAtt" style="display:none; margin-bottom:20px; padding:10px; background:#ffefef; border:1px solid #f9d6d5;">
					A new attendance record has been created! You can now add the attendance information below
				</div>
				<div class="col_half left">
					<div class="col_half left">
						<div class="form_label">Attendance Period Start:</div>
						<input type="text" name="attendanceStart" id="attendanceStart" value="<?php if (isset($startDate,$endDate)) echo $startDate->format("m/d/Y"); ?>" class="text_area select_img" onChange="if (this.value != '' && document.forms[0].attendanceEnd.value != '') calculateAttendanceDays(this,document.forms[0].attendanceEnd,document.forms[0].possibleAttendances); $('#newAtt').slideUp('slow');" tabIndex="<?php echo $tabIndex+1; ?>"<?php if (isset($startDate,$endDate) && $startDate <= $today && $endDate >= $today) echo " disabled"; ?>>
						<link href="https://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css" rel="stylesheet">
						<script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
						<script>
							$(function() {
								$( "#attendanceStart" ).datepicker();
							});
						</script>
					</div>
					<div class="col_half right">
						<div class="form_label">Attendance Period End:</div>
						<input type="text" name="attendanceEnd" id="attendanceEnd" value="<?php if (isset($startDate,$endDate)) echo $endDate->format("m/d/Y"); ?>" class="text_area select_img"  onChange="if (this.value != '' && document.forms[0].attendanceStart.value != '') calculateAttendanceDays(document.forms[0].attendanceStart,this,document.forms[0].possibleAttendances); $('#newAtt').slideUp('slow');" tabIndex="<?php echo $tabIndex+2; ?>"<?php if (isset($startDate,$endDate) && $startDate <= $today && $endDate >= $today) echo " disabled"; ?>>
						<script>
							$(function() {
								$( "#attendanceEnd" ).datepicker();
							});
						</script>
					</div>
				</div>
				<div class="col_half right">
					<div class="form_label">Total Attended:</div>
					<input name="totalAttendances" type="text" id="totalAttendances" class="text_area" onInput="$('#newAtt').slideUp('slow');" onBlur="checkTotalAttendance(this);" tabIndex="<?php echo $tabIndex+4; ?>" value="<?php if (isset($startDate,$endDate)) echo $schAtt->getTotalAttended(); ?>" style="width:160px; height:80px; text-align:center; font-size:40px; margin-left:120px;" readonly>
				</div>
				<div class="clearfix"></div>
				<div class="col_fullwidth">
					<div class="col_1third left" style="margin-right:2%;">
						<div class="form_label ">Total Possible Attendances:</div>
						<input name="possibleAttendances" type="text" id="possibleAttendances" class="text_area " onInput="$('#newAtt').slideUp('slow');" onBlur="checkTotalAttendance(this);" tabIndex="<?php echo $tabIndex+3; ?>" value="<?php if (isset($startDate,$endDate)) echo $schAtt->getTotalPossible(); ?>">
					</div>
					<div class="col_1third left" style="margin-right:2%;">
						<div class="form_label ">Authorised Absences:</div>
						<input name="authorisedAttendances" type="text" id="authorisedAttendances" class="text_area " onInput="$('#newAtt').slideUp('slow');" onBlur="checkTotalAttendance(this);" tabIndex="<?php echo $tabIndex+5; ?>" value="<?php if (isset($startDate,$endDate)) echo $schAtt->getAuthorisedAbsence(); ?>">
					</div>
					<div class="col_1third right">
						<div class="form_label ">Unauthorised Absences:</div>
						<input name="unathorisedAttendances" type="text" id="unauthorisedAttendances" class="text_area " onInput="$('#newAtt').slideUp('slow');" onBlur="checkTotalAttendance(this);" tabIndex="<?php echo $tabIndex+6; ?>" value="<?php if (isset($startDate,$endDate)) echo $schAtt->getUnauthorisedAbsence(); ?>">
					</div>
					
				</div>
				<div class="col_fullwidth right">
					<input class="btn darkblue rc right" type="button" value="Create new Attendance Record" onClick="document.forms[0].attendanceStart.value = ''; document.forms[0].attendanceEnd.value = ''; document.forms[0].possibleAttendances.value=''; document.forms[0].totalAttendances.value = ''; document.forms[0].authorisedAttendances.value = ''; document.forms[0].unauthorisedAttendances.value = ''; document.forms[0].attendanceStart.disabled=false; document.forms[0].attendanceEnd.disabled=false; $('#newAtt').slideDown('slow');">
				</div>
			</div>
			<div class="inner_col rc" style="">
				<h3 class="font_grey">Subject Information</h3>
				<div class="spacer30"></div>
				<div class="col_half left">
					<div class="plain">
						<div class="form_label label_inline">&nbsp;</div>
						<div class="plain input_line" style="width:95px; padding-left:12px; display:inline-block;">
							Predicted
						</div>
						<div class="plain input_line" style="width:95px; padding-left:12px; display:inline-block;">
							Target
						</div>
						<div class="plain input_line" style="width:95px; padding-left:12px; display:inline-block;">
							Actual
						</div>
					</div>
				</div>
				<div class="col_half right">
					<div class="plain">
						<div class="form_label label_inline">&nbsp;</div>
						<div class="plain input_line" style="width:95px; padding-left:12px; display:inline-block;">
							Predicted
						</div>
						<div class="plain input_line" style="width:95px; padding-left:12px; display:inline-block;">
							Target
						</div>
						<div class="plain input_line" style="width:95px; padding-left:12px; display:inline-block;">
							Actual
						</div>
					</div>
				</div>
				<?php
				/*
				$subjects = new Subject();
				$subjects = $subjects->getSubjects();
				for ($i=0; $i<sizeof($subjects); $i++) {
					if ($subjects[$i]->getCategory()->getCategory() != "Academic") {
						array_splice($subjects,$i,1);
						$i--;
					}
				}
				$halfofX = round(sizeof($subjects)/2);
				$index = 0;
				if (isset($student)) {
					$studentGrades = $student->getGrades();
					for ($i=0; $i<sizeof($studentGrades); $i++) {
						$stuGrads[] = $studentGrades[$i]->getSubjectId();
					}
				}
				*/
				$tabIndex += 7;
				//for ($i=0; $i<sizeof($subjects); $i++) {
					//if ($subjects[$i]->getCategory()->getCategory() == "Academic" && $subjects[$i]->isEnabled()) {
						//if ($i == 0)
							echo '<div class="col_half left">';
						//else if ($i == $halfofX) echo '<div class="col_half right">';
						?>
						<div class="plain">
							<div class="form_label label_inline"><?php /*echo $subjects[$i]->getSubject(); ?></div>
							<div class="plain input_line" style="width:95px; padding-left:12px; display:inline-block; overflow:hidden;">
								<select name="predicted[]" id="predicted<?php echo $tabIndex+$i+$index; ?>" class="text_area select_img" style="width:83px; overflow:hidden;" tabIndex="<?php echo $tabIndex+$i+$index++; ?>" onChange="checkGrades(this,'<?php echo $tabIndex+$i+$index-1; ?>');">
									<?php if (!$subjects[$i]->isCore()) { ?><option value="" SELECTED>N/A</option><?php } ?>
									<?php 
									$gradeCategories = new GradeCategory();
									$gradeCategories = $gradeCategories->getCategories();
									for ($a=0; $a<sizeof($gradeCategories); $a++) { ?>
										<optgroup label="<?php echo $gradeCategories[$a]->getCategory(); ?>">
										<?php $grades = $gradeCategories[$a]->getGrades();
										for ($b=0; $b<sizeof($grades); $b++) { ?>
											<option value="<?php echo $subjects[$i]->getId().','.$grades[$b]->getId(); ?>"
											<?php if (isset($studentGrades)) {
												for ($z=0; $z<sizeof($studentGrades); $z++) {
													if (($studentGrades[$z]->getSubjectId() == $subjects[$i]->getId() && $studentGrades[$z]->getPredictedGradeId() == $grades[$b]->getId()) || ($subjects[$i]->isCore() && $grades[$b]->getGrade() == "Not Obtained") && !in_array($subjects[$i]->getId(),$stuGrads)) echo " SELECTED";
												}
											} else if ($subjects[$i]->isCore() && $grades[$b]->getGrade() == "Not Obtained") echo " SELECTED"; ?>><?php echo $grades[$b]->getGrade(); ?></option>
										<?php } ?>
										</optgroup>
									<?php } ?>
								</select>
							</div>
							<div class="plain input_line" style="width:95px; padding-left:12px; display:inline-block;">
								<select name="target[]" id="target<?php echo $tabIndex+$i+$index-1; ?>" class="text_area select_img" style="width:83px; overflow:hidden;" tabIndex="<?php echo $tabIndex+$i+$index++; ?>" onChange="checkGrades(this,'<?php echo $tabIndex+$i+$index-2; ?>');">
									<?php if (!$subjects[$i]->isCore()) { ?><option value="" SELECTED>N/A</option><?php } else { ?><option value="" SELECTED>Pick</option><?php } ?>
									<?php 
									$gradeCategories = new GradeCategory();
									$gradeCategories = $gradeCategories->getCategories();
									for ($a=0; $a<sizeof($gradeCategories); $a++) { ?>
										<optgroup label="<?php echo $gradeCategories[$a]->getCategory(); ?>">
										<?php $grades = $gradeCategories[$a]->getGrades();
										for ($b=0; $b<sizeof($grades); $b++) { ?>
											<option value="<?php echo $subjects[$i]->getId().','.$grades[$b]->getId(); ?>"
											<?php if (isset($studentGrades)) {
												for ($z=0; $z<sizeof($studentGrades); $z++) {
													if (($studentGrades[$z]->getSubjectId() == $subjects[$i]->getId() && $studentGrades[$z]->getTargetGradeId() == $grades[$b]->getId()) || ($subjects[$i]->isCore() && $grades[$b]->getGrade() == "Not Obtained") && !in_array($subjects[$i]->getId(),$stuGrads)) echo " SELECTED";
												}
											} else if ($subjects[$i]->isCore() && $grades[$b]->getGrade() == "Not Obtained") echo " SELECTED"; ?>><?php echo $grades[$b]->getGrade(); ?></option>
										<?php } ?>
										</optgroup>
									<?php } ?>
								</select>
							</div>
							<div class="plain input_line" style="width:95px; padding-left:12px; display:inline-block;">
								<select name="actual[]" id="actual<?php echo $tabIndex+$i+$index-2; ?>" class="text_area select_img" style="width:83px; overflow:hidden;" tabIndex="<?php echo $tabIndex+$i+$index; ?>" onChange="checkGrades(this,'<?php echo $tabIndex+$i+$index-2; ?>');">
									<?php if (!$subjects[$i]->isCore()) { ?><option value="" SELECTED>N/A</option><?php } else { ?><option value="" SELECTED>Pick</option><?php } ?>
									<?php 
									$gradeCategories = new GradeCategory();
									$gradeCategories = $gradeCategories->getCategories();
									for ($a=0; $a<sizeof($gradeCategories); $a++) { 
										if ($gradeCategories[$a]->isEnabled()) { ?>
											<optgroup label="<?php echo $gradeCategories[$a]->getCategory(); ?>">
											<?php $grades = $gradeCategories[$a]->getGrades();
											for ($b=0; $b<sizeof($grades); $b++) { ?>
												<option value="<?php echo $subjects[$i]->getId().','.$grades[$b]->getId(); ?>"
												<?php if (isset($studentGrades)) {
												for ($z=0; $z<sizeof($studentGrades); $z++) {
													if (($studentGrades[$z]->getSubjectId() == $subjects[$i]->getId() && $studentGrades[$z]->getActualGradeId() == $grades[$b]->getId()) || ($subjects[$i]->isCore() && $grades[$b]->getGrade() == "Not Obtained") && !in_array($subjects[$i]->getId(),$stuGrads)) echo " SELECTED";
												}
											} else if ($subjects[$i]->isCore() && $grades[$b]->getGrade() == "Not Obtained") echo " SELECTED"; ?>><?php echo $grades[$b]->getGrade(); ?></option>
											<?php } ?>
											</optgroup>
										<?php }
									} ?>
								</select> <?php */ ?>
							</div>
						</div>
						<?php
						//if ($i == $halfofX-1)
						echo "</div>";
						//else if ($i ==  sizeof($subjects)-1) echo "</div>";
					//} else $halfofX--;
				//}
				//$index += $tabIndex+sizeof($subjects);
				$index = $tabIndex;
				?>
				</div>
			<div class="inner_col rc">
				<h3 class="font_grey">Additional Information</h3>
				<div class="spacer30"></div>
				<div class="col_half left">
					<div class="form_label label_inline">Areas of Strength:</div>
					<textarea name="strengths" id="" rows="5" maxlength="1000" class="text_area input_inline" tabIndex="<?php echo $index++; ?>"><?php if (isset($student)) echo $student->s_strengths; ?></textarea>
					<!---<div class="form_label label_inline">Local Area Environment:</div>
					<textarea name="environment" id="" rows="5" maxlength="1000" class="text_area input_inline" tabIndex="30"></textarea>---->
					<div class="form_label label_inline">Previous Interventions:</div>
					<textarea name="prevInterventions" id="" rows="5" maxlength="1000" class="text_area input_inline" tabIndex="<?php echo $index+1; ?>"><?php if (isset($student)) echo $student->s_previousInterventions; ?></textarea>
					<div class="clearfix"></div>
				</div>
				<div class="col_half right">
					<div class="form_label label_inline">Areas of Concern:</div>
					<textarea name="concerns" id="" rows="5" maxlength="1000" class="text_area input_inline" tabIndex="<?php echo $index; ?>"><?php if (isset($student)) echo $student->s_concerns; ?></textarea>
					<div class="form_label label_inline">Additional Comments:</div>
					<textarea name="additionalComments" id="" rows="5" maxlength="1000" class="text_area input_inline" tabIndex="<?php echo $index+2; ?>"><?php if (isset($student)) echo $student->s_additionalComments; ?></textarea>
					<div class="form_label label_inline">Phase<font class="font_red">*</font></div>
					<div class="plain input_inline">
						<select name="phaseId" class="text_area select_img" tabIndex="<?php echo $index+3; ?>" onBlur="isNotEmpty(this);">
							<option value="" selected="selected">Choose a phase</option>
							<?php
							/*
							$phases = new PhaseType();
							$phases = $phases->getPhases();
							if (isset($student)) $studentPhases = $student->getPhases();
							for ($i=0; $i<sizeof($phases); $i++) {
								echo "<option value='".$phases[$i]->getId()."'";
								if (isset($studentPhases)) {
									for ($a=0; $a<sizeof($studentPhases); $a++) {
										if ($studentPhases[$a]->getPhaseId() == $phases[$i]->getId()) echo " SELECTED";
									}
								}
								echo ">".$phases[$i]->getPhase()."</option>";
							}
							*/
							?>
						</select>
					</div>
				</div>
			</div>
			<div class="inner_col rc">
				<div class="col_fullwidth">
					<h3 class="font_grey">Issues Faced</h3>
					<div class="spacer30"></div>
					<div class="col_fullwidth">
						<div class="col_cp_third">
							<div class="form_label">Choose an issue:</div>
							<select class="text_area select_img" name="issue_options">
							<?php
							/*
							$stmt = viewPhaseType(0);
							if (mysqli_num_rows($stmt) > 0) { while ($prelim = mysqli_fetch_array($stmt)) {
								if ($prelim['enabled']) {
									echo "<optgroup label='".$prelim['phase']."'>";
									$stmt2 = viewIssueType($prelim['id']);
									while ($row = mysqli_fetch_array($stmt2)) {
										echo "<option value='".$row['id']."'>".$row['issue']."</option>";
									}
									echo "</optgroup>";
								}
							} }
							*/
							?>
							</select>
						</div>
						<div class="col_cp_middle" style="overflow:visible;">
							<input name="" type="button" style="margin-bottom:10px;" class="btn darkgreen add_btn" value="&nbsp;&nbsp;&nbsp;Add >&nbsp;&nbsp;" onclick="chooseOpt(document.forms[0].issue_options,document.forms[0].issues)">
							<input name="" type="button" class="btn red remove_btn" value="< Remove" onclick="removeOpt(document.forms[0].issues)">
						</div>
						<div class="col_cp_third">
							<div class="form_label">Issues Faced:</div>
							<select multiple name="issues[]" id='issues' size="5" class="text_area">
							<?php
							/*
							if (isset($student)) {
								$issuesFaced = $student->getIssuesFaced();
								for ($i=0; $i<sizeof($issuesFaced); $i++) {
									echo "<option value='".$issuesFaced[$i]->getIssueId()."'>".$issuesFaced[$i]->getIssue()->getIssue()."</option>";
								}
							}
							*/
							?>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="col_fullwidth footer_section">
				<input type="button" class="btn darkgreen rc right" value="<?php if (isset($student)) echo 'Save'; else echo 'Create'; ?>" tabIndex="<?php echo $index+4; ?>" onClick="selectAllOptions(document.forms[0].issues); document.forms[0].attendanceStart.disabled=false; document.forms[0].attendanceEnd.disabled=false; formValidate();">
			</div>
	</div>
</form>
</div>
<script>
	var focus = "";
	function formValidate() {
		var submit = true;
		if (form.fname.value == "") {
			form.fname.style.border='1px solid #f05a49';
			if (focus == "") focus = form.fname;
			submit = false;
		}
		if (form.lname.value == "") {
			form.lname.style.border='1px solid #f05a49';
			if (focus == "") focus = form.lname;
			submit = false;
		}
		if (form.gender.value == "") {
			form.gender.style.border='1px solid #f05a49';
			if (focus == "") focus = form.gender;
			submit = false;
		}
		if (form.dobDay.value == "" || form.dobMonth.value == "" || form.dobYear.value == "") {
			form.dobDay.style.border='1px solid #f05a49';
			form.dobMonth.style.border='1px solid #f05a49';
			form.dobYear.style.border='1px solid #f05a49';
			if (focus == "") { focus = form.dobDay; }
			submit = false;
		}
		if (form.ethnicityId.value == "") {
			form.ethnicityId.style.border='1px solid #f05a49';
			if (focus == "") focus = form.ethnicityId;
			submit = false;
		}
		if (form.religionId.value == "") {
			form.religionId.style.border='1px solid #f05a49';
			if (focus == "") focus = form.religionId;
			submit = false;
		}
		if (form.teacherId.value == "") {
			form.teacherId.style.border='1px solid #f05a49';
			if (focus == "") focus = form.teacherId;
			submit = false;
		}
		if (form.urn.value == "") {
			form.urn.style.border='1px solid #f05a49';
			if (focus == "") focus = form.urn;
			submit = false;
			console.log('8');
		}
		if (form.upn.value == "") {
			form.upn.style.border='1px solid #f05a49';
			if (focus == "") focus = form.upn;
			submit = false;
		}
		if (form.address.value == "") {
			form.address.style.border='1px solid #f05a49';
			if (focus == "") focus = form.address;
			submit = false;
		}
		if (form.postcode.value == "") {
			form.postcode.style.border='1px solid #f05a49';
			if (focus == "") focus = form.postcode;
			submit = false;
		}
		if (form.phaseId.value == "") {
			form.phaseId.style.border='1px solid #f05a49';
			if (focus == "") focus = form.phaseId;
			submit = false;
		}
		if (focus != "") {
			focus.focus();
			focus = "";
		}
		if (submit) form.submit();
	}

	jQuery(document).ready(function($){	
		setup_expandables();
		setup_tabs();
		style_forms()
	});
</script>