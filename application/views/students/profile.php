<?php
echo "<pre>";
print_r($student);
//print_r($client);
echo "</pre>";
?>
<div class="popup" id="popup"></div>
<div id="wrapper">
	<div class="heading_bar rc orange">
		<h1>Students<a href="?p=<?php echo md5(Page::$stu[2])."&id=".$student->s_upn; ?>"><input type="button" class="btn orange rc" value="Edit" style="height:38px;float:right;margin-top:-6px;margin-right:3.5px;border:solid 1px;border-radius:3px;background-image:none;text-shadow:none;"></a></h1>
	</div>
	<div id="content" class="rc border_orange">
		<div class="heading_bar rc midgrey">
			<?php if ($student->s_teacherId == $client->getId() || $client->getUserType() == "School Administrator") { ?><div class="col_1third right" style="padding:0px; margin:0px; top:-9px; text-align:right;">
			</div><?php } ?>
			<h2>Student Profile</h2>
		</div>
		<div id="top_buttons" class="col_fullwidth">
			<?php //if ($student->getEnrolments() != null) { ?>
			<a href="?p=<?php echo md5(Page::$rep[2])."&id=".$student->s_upn; ?>"><input name="" id="map_btn" type="button" class="btn darkgrey right" value="Intervention Analysis" ></a>
			<a href="?p=<?php echo md5(Page::$rep[3])."&id=".$student->s_upn; ?>"><input name="" type="button" class="btn darkgrey right" value="Academic"></a>
			<a href="?p=<?php echo md5(Page::$rep[5])."&id=".$student->s_upn; ?>"><input name="" type="button" class="btn darkgrey right" value="Behaviour"></a>
			<a href="?p=<?php echo md5(Page::$rep[4])."&id=".$student->s_upn; ?>"><input name="" type="button" class="btn darkgrey right" value="Impact Analysis"></a>
			<a href="?p=<?php echo md5(Page::$rep[0])."&id=".$student->s_upn; ?>"><input name="" type="button" class="btn darkgrey right" value="Report Summary"></a>
			<?php //} ?>
		</div>
		<div class="col_2third left">
			<div class="heading_bar rc orange">
				<h2>Demographic Data</h2>
			</div>
			<div id="image_box" class="inner_col rc">
				<div class="student_image rc"><img src="imgs/student_placeholder.jpg" width="100%"/></div>
				<div class="student_data rc">
					<table padding="8">
						<tr>
							<td width="50%">Student ID:</td>
							<td align="right"><?php echo $student->s_upn; ?></td>
						</tr>
						<tr>
							<td>Chosen Name:</td>
							<td align="right"><?php if ($student->s_displayName != "") echo ucfirst($student->s_displayName); else echo ucfirst($student->fname).' '.ucfirst($student->lname); ?></td>
						</tr>
						<tr>
							<td>D.O.B.:</td>
							<td align="right"><?php $dob = explode("-",$student->s_dob); echo $dob[2].'/'.$dob[1].'/'.$dob[0]; ?></td>
						</tr>
						<tr>
							<td>Sex:</td>
							<td align="right"><?php if ($student->s_male) echo "Male"; else if ($student->s_female) echo "Female"; ?></td>
						</tr>
						<tr>
							<td>Ethnicity:</td>
							<td align="right"><?php echo $student->s_ethnicityId; ?></td>
						</tr>
						<tr>
							<td>Address:</td>
							<td align="right"><?php echo substr($student->s_postcode,0,4); ?></td>
						</tr>
						<!---<tr>
							<td align="left" valign="top">Additional:</td>
							<td align="right"><select name="" class="text_area select_img" style="width:40px; float:right; margin-right:0px">
									<option value="" selected="selected">-</option>
									<option value='1'>1</option>
									<option value='2'>2</option>
									<option value='3'>3</option>
								</select>
								<select name="" class="text_area select_img" style="width:40px; float:right; margin-right:10px">
									<option value="" selected="selected">-</option>
									<option value='1'>1</option>
									<option value='2'>2</option>
									<option value='3'>3</option>
								</select>
								<select name="" class="text_area select_img" style="width:40px; float:right; margin-right:10px">
									<option value="" selected="selected">-</option>
									<option value='1'>1</option>
									<option value='2'>2</option>
									<option value='3'>3</option>
								</select></td>
						</tr>---->
					</table>
				</div>
			</div>
			<div class="expandable">
				<div class="expandable_title rc orange">
				<h2>Other Information</h2>
				</div>
				<div class="expandable_content" style="padding:0; margin-bottom:0px;">
					<div class="inner_col rc">
						<div class="plain left" style="width:20%; margin-right:3%; padding-top:6px; margin-bottom:0px;">FSM: <a onClick="infoPopup('Free School Meals','Please indicate whether or not the student is eligible for free school meals.');"><i class="fa fa-info-circle text-danger" style="cursor:pointer; font-size:13px;"></i></a></div>
						<div class="white_box rc left" style="height:20px; width:20%">
						<?php /*
						$studentsTypes = $student->getStudentTypes();
						$fsm = false;
						for ($i=0; $studentsTypes != null, $i<sizeof($studentsTypes); $i++) {
							if ($studentsTypes[$i]->getStudentType()->getName() == "Free School Meals") $fsm = true;
						}
						*/
						if ($fsm) echo "Yes"; else echo "No"; ?>
						</div>
						<div class="spacer30"></div>
						<div class="plain left" style="width:20%; margin-right:3%">Additional:</div>
						<div class="white_box rc left" style="height:120px; width:77%"><?php echo nl2br(stripslashes($student->s_additionalComments)); ?></div>
					</div>
				</div>
			</div>
			<div class="heading_bar rc darkblue" style="margin-top:20px;">
				<h2>Key Information</h2>
			</div>
			<div class="inner_col rc">
				<h2 class="font_darkblue" style="font-weight:600; margin-bottom:10px; margin-left:5px;">Areas of Strength</h2>
				<div class="white_box rc" style="height:120px; margin-bottom:10px;">
					<?php echo nl2br(ucfirst(stripslashes($student->s_strengths))); ?>
				</div>
				<h2 class="font_darkblue" style="font-weight:600; margin-bottom:10px; margin-left:5px;">Areas of Concern</h2>
				<div class="white_box rc" style="height:120px;">
					<?php echo nl2br(ucfirst(stripslashes($student->s_concerns))); ?>
				</div>
			</div>
			<div class="inner_col rc">
				<h2 class="font_darkblue" style="font-weight:600; margin-bottom:10px; margin-left:5px;">Student Self Assessment</h2>
				<div class="col_half left">
					<div class="inner_col rc" style="height:140px; background-color:#fff;">
						<p class="font_darkblue"><b>Student Career Aspirations:</b></p>
						<p><?php
						/*
						$careers = $student->getCareerAspirations();
						$careerAsp = array();
						for ($i=0; $i<sizeof($careers); $i++) {
							$careerAsp[] = $careers[$i]->getCareer()->getCareer();
						}
						echo implode(", ",$careerAsp); 
						*/ ?>
						</p>
					</div>
				</div>
				<div class="col_half right">
					<div class="inner_col rc" style="height:140px; background-color:#fff;">
						<p class="font_darkblue">What subjects would you like help with?</p>
						<p><?php /*
						$subjects = $student->getStudentSubjects();
						$subs = array();
						//print_r($subjects);
						for ($i=0; $i<sizeof($subjects); $i++) {
							if ($subjects[$i]->getSubject()->getCategory()->getCategory() == "Academic") $subs[] = $subjects[$i]->getSubject()->getSubject();
						}
						echo implode(", ",$subs); 
						*/
						?>
						</p>
					</div>
					
				</div>
				<div class="col_fullwidth">
					<div class="inner_col rc" style="height:140px; background-color:#fff;">
						<p class="font_darkblue">Student Interests:</p>
						<p><?php
						/* $subs = array();
						for ($i=0; $i<sizeof($subjects); $i++) {
							if ($subjects[$i]->getSubject()->getCategory()->getCategory() == "Non-academic") $subs[] = $subjects[$i]->getSubject()->getSubject();
						}
						echo implode(", ",$subs); 
						*/
						?>
						</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col_1third right">
			<div class="heading_bar rc darkblue">
				<h2>Academic Scores</h2>
			</div>
			<div class="scores_box">
				<div class="scores_item ">
					<div class="scores_title">Achievement Points</div>
					<div class="scores_result midgrey"><?php echo $student->s_achievementPoints(); ?></div>
				</div>
				<div class="scores_item scores_subhead">
					<div class="scores_title">Core Subjects</div>
				</div>
				<?php $subjects = $student->getGrades();
				for ($i=0; $i<sizeof($subjects); $i++) {
					if ($subjects[$i]->getSubject()->isCore()) { ?>
						<div class="scores_item ">
							<div class="scores_title"><?php echo $subjects[$i]->getSubject()->getSubject(); ?></div>
							<div class="scores_result <?php if ($subjects[$i]->getActualGrade()->getPoints() <= 6) echo "red"; else if ($subjects[$i]->getActualGrade()->getPoints() > 6 && $subjects[$i]->getActualGrade()->getPoints() <= 12) echo "orange"; else if ($subjects[$i]->getActualGrade()->getPoints() > 12) echo "darkgreen"; ?>"><?php echo $subjects[$i]->getActualGrade()->getGrade(); ?></div>
						</div>
					<?php }
				} ?>
			</div>
			<div class="spacer30"></div>
			<div class="heading_bar rc darkblue">
				<h2>Behaviour Score</h2>
			</div>
			<div class="scores_box">
				<div class="scores_item ">
					<div class="scores_title">Behaviour Points</div>
					<div class="scores_result midgrey"><?php echo $student->getBehaviourPoints(); ?></div>
				</div>
				<?php $sdq = $student->getSDQAssessmentSummaries();	
				if ($sdq != null) { ?>
				<div class="scores_item scores_subhead">
					<div class="scores_title" style="width:100%">Personal Development</div>
				</div>
				<?php for ($i=0; $i<sizeof($sdq); $i++) { ?>
				<div class="scores_item ">
					<div class="scores_title"><?php echo $sdq[$i]->getCategory()->getIssue()->getIssue(); ?></div>
					<div class="scores_result <?php if ($sdq[$i]->isNormal()) echo "green"; else if ($sdq[$i]->isBorderline()) echo "orange"; else if ($sdq[$i]->isAbnormal()) echo "red"; ?>"><?php echo $sdq[$i]->getOverallScore(); ?></div>
				</div>
				<?php }
				}
				if (!isset($_SESSION['role']) || unserialize($_SESSION['user'])->getId() == $student->getTeacherId()) {
					if ($sdq != null && $sdq[0]->getSumDate() < date("Y-m-d")) { ?>
					<div style="width:100%; text-align:center; margin-top:30px;">
					<a href="?p=<?php echo md5(Page::$ass[0]); ?>&id=<?php echo $student->getUpn(); ?>&cId=2"><input type="button" class="btn darkgreen" value="Re-Assess PDA" style="margin-left:0px; margin-right:0px;"></a>
					</div>
					<?php } else if ($sdq == null) {
					 ?>
					<div style="width:100%; text-align:center; margin-top:30px;">
					<p style="padding-bottom:15px;">You need to complete the Personal Development Assessment</p>
					<a href="?p=<?php echo md5(Page::$ass[0]); ?>&id=<?php echo $student->getUpn(); ?>&cId=2"><input type="button" class="btn red" value="Complete PDA" style="margin-left:0px; margin-right:0px;"></a>
					</div>
					<?php }
					if ($student->isEnrolled() && $student->getPhases() != null && $student->getPhases()[0]->getPhaseId() != 2) { 
						$enrolments = $student->getEnrolments();
						$earliest = "";
						for ($i=0; $enrolments != null, $i<sizeof($enrolments); $i++) {
							if (!$enrolments[$i]->isCompleted()) {
								if ($earliest == "" || $earliest > $enrolments[$i]->getCourse()->getFirstSession()) $earliest = $enrolments[$i]->getCourse()->getFirstSession();
							}
						}
						$assessment = $student->getAssessments();
						for ($i=0; $assessment != null, $i<sizeof($assessment); $i++) {
							//print_r($assessment[$i]);
							if ($assessment[$i]->getQuestion()->getCategory()->getPhase()->getId() != $student->getPhases()[0]->getPhaseId()) {
								array_splice($assessment,$i,1);
								$i--;
							}
						}
						//print_r($assessment);
						$date = new DateTime();
						$date2 = new DateTime();
						$date->setDate(date("Y"),date("m")+2,date("d"));
						$date2->setDate(date("Y"),date("m")-2,date("d"));
						$date->format("Y-m-d");
						if ($earliest != "" && $earliest <= $date->format("Y-m-d") && ($assessment == null || sizeof($assessment) == 0 || $assessment[0]->getAssessmentDate() < $date2->format("Y-m-d"))) {
					?>
					<div style="width:100%; text-align:center; margin-top:30px;">
					<p style="padding-bottom:5px;">You need to complete the <?php echo $student->getPhases()[0]->getPhase()->getPhase(); ?> Assessment before <?php $date = new DateTime($earliest); echo $date->format("jS F Y"); ?></p>
					<a href="?p=<?php echo md5(Page::$ass[0]); ?>&id=<?php echo $student->getUpn(); ?>"><input type="button" class="btn red" value="Complete" style="margin-left:0px; margin-right:0px;"></a>
					</div>
						<?php }
					}
				} ?>
			</div>
			<div class="spacer30"></div>
			<div class="heading_bar rc darkblue">
				<h2>Previous Interventions</h2>
			</div>
			<div class="inner_col rc">
				<p><?php echo nl2br(stripslashes($student->getPreviousInterventions())); ?></p>
			</div>
			<div class="heading_bar rc darkblue">
				<h2>Issues Faced</h2>
			</div>
			<div class="inner_col rc">
				<p><?php for ($i=0, $issueFaced = $student->getIssuesFaced(); $issueFaced != null, $i<sizeof($issueFaced); $i++) {
					echo stripslashes($issueFaced[$i]->getIssue()->getIssue());
					if ($i<sizeof($issueFaced)-1) echo ", ";
				} ?></p>
			</div>
			<div class="inner_col rc" style="background-color:#fff; border-width:2px; height:350px; overflow:hidden; text-align:center; vertical-align:middle;"><img src="imgs/childline_image.jpg" style="width:auto; height:100%; vertical-align:middle;"/> </div>
		</div>
		<?php if ($student->isEnrolled()) { ?>
		<div class="heading_bar rc darkgreen">
			<h2>Student Enrolments</h2>
		</div>
		<div id="recent_activity" class="col_fullwidth text_area rc">
			<table class="datatable datatable_header">
				<tr class="header">
					<td class="col1">Programme</td>
					<td class="col2">Location</td>
					<td class="col3">Start</td>
					<td class="col4">End</td>
					<td></td>
					<td></td>
				</tr>
			</table>
			<div id="re_ac" class="col_fullwidth scrollable" style="height:130px">
				<table class="datatable">
					<?php $enrolments = $student->getEnrolments();
					for ($i=0; $i<sizeof($enrolments); $i++) {
					//print_r($enrolments);
						$course = $enrolments[$i]->getCourse();
						//print_r($course);
						$prog = $course->getProgramme();
						$sessions = $course->getSessions();
						$location = "";
						if ($sessions != null) {
							for ($a=0; $a<sizeof($sessions); $a++) {
								$sesLoc = $sessions[$a]->getSessionLocation()->getLocation();
								if ($sesLoc == "On student site") {
									if ($location == "") $location = $sesLoc;
									else if ($location == "On Agency site") $location = "Both";
								} else if ($sesLoc == "On Agency site") {
									if ($location == "") $location = $sesLoc;
									else if ($location == "On student site") $location = "Both";
								}
							}
						} else $location = "No location";
					?>
					<tr>
						<td class="col1"><a href="?p=<?php echo md5(Page::$mat[3])."&id=".$prog->getId()."&cId=".$course->getId(); ?>"><?php echo $prog->getName(); ?></a></td>
						<td class="col2"><?php echo $location; ?></td>
						<td class="col3"><?php $date = new DateTime($course->getFirstSession()); echo $date->format("jS F Y"); ?></td>
						<td class="col4"><?php $date = new DateTime($course->getLastSession()); echo $date->format("jS F Y"); ?></td>
						<td style="text-align:center;">
							<?php if (!isset($_SESSION['role']) || unserialize($_SESSION['user'])->getId() == $student->getTeacherId() || $_SESSION['type'] == "School Administrator") { $rating = new Rating(); $rating->load(unserialize($_SESSION['user'])->getId(),$student->getUpn(),$course->getId()); if ($rating->getRaterId() == 0) { ?>
								<a href="?p=<?php echo md5(Page::$rat[0])."&id=".$course->getId()."&sId=".$student->getUpn(); ?>"><input type="button" value="Rate" class="btn darkgreen"></a>
							<?php } } ?>
						</td>
						<td>
							<?php if (!isset($_SESSION['role']) || unserialize($_SESSION['user'])->getId() == $student->getTeacherId() || $_SESSION['type'] == "School Administrator") { $rating = new Rating(); $rating->load($student->getUser()->getId(),$student->getUpn(),$course->getId()); if ($rating->getRaterId() == 0) { ?>
								<a href="?p=<?php echo md5(Page::$rat[2])."&id=".$course->getId()."&sId=".$student->getUpn(); ?>"><input type="button" value="Student Rate" class="btn blue"></a>
							<?php } } ?>
						</td>
					</tr>
					<?php } ?>
				</table>
			</div>
		</div>
		<?php } ?>
		<div class="spacer30"></div>
		<div class="col_fullwidth">
			<?php 
			//echo unserialize($_SESSION['user'])->getId()." ".$student->getTeacherId();
			if (unserialize($_SESSION['user'])->getId() == $student->getTeacherId() || !isset($_SESSION['role'])) { ?>
				<a href="?p=<?php echo md5(Page::$ass[1])."&id=".$student->getUpn(); ?>"><input name="" type="button" class="btn darkblue left" value="Edit Student Assessment"></a>
			<?php }
			if (!isset($_SESSION['role']) || unserialize($_SESSION['type'])->getName() == "School Manager" || unserialize($_SESSION['type'])->getName() == "School Administrator" || unserialize($_SESSION['user'])->getId() == $student->getTeacherId()) {
				if (($student->isCompleted() || $student->isEnrolled()) && ($student->getPendingMatch() == null)) { ?>
				<form method="POST" action="?p=<?php echo md5(Page::$mat[1]); ?>"><input type="hidden" name="function" value="createMatches"><input type="hidden" name="upn" value="<?php echo $student->getUpn(); ?>"><input name="" type="submit" class="btn darkgreen right" value="Find Matches" style="width:200px;  margin-right:10px;"></form>
				<?php }
			}
			if (($student->isCompleted() || $student->isEnrolled()) && $student->getMatch() != null && $student->getMatch()->getStatus()) { ?>
				<a href="?p=<?php echo md5(Page::$mat[0])."&id=".$student->getUpn(); ?>"><input name="" type="button" class="btn green right" value="View Matches" style="width:200px;  margin-right:10px;"></a>
			<?php } 
			if ($student->getPendingMatch() != null) { ?>
				<input name="" type="button" class="btn orange right" value="Matches Pending" style="width:200px; margin-right:10px;">
			<?php } 
			if ($student->getPendingMatch() != null && (in_array(Page::$mat[2],$_SESSION['privileges']))) { ?>
				<a href="?p=<?php echo md5(Page::$mat[2])."&id=".$student->getUpn(); ?>"><input name="" type="button" class="btn darkgreen right" value="Review Matches" style="width:200px; margin-right:10px;"></a>
			<?php } ?>
		</div>
		
	</div>
</div>
<script>
	jQuery(document).ready(function($){	
		scale_data_box();
		setup_expandables();
		colour_rows("#re_ac", "grey");
	});
</script>