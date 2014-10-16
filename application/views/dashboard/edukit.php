<div id="wrapper">
	<div class="heading_bar rc darkblue">
		<h1>Edukit Dashboard</h1>
	</div>
	<div id="content" class="rc border_blue">
		<div class="col_1third left">
			<div class="heading_bar rc red">
				<h2>Tickets</h2>
			</div>
			<div class="inner_col rc tickets">
				<table width="100%" border="0" cellspacing="5"  cellpadding="8">
					<?php
					//$tickets = $this->client->getTickets();
			//print_r($tickets);
					if ($tickets != null) {
						for ($i=0; $i<sizeof($tickets); $i++) { 
					//print_r($tickets[$i]); ?>
					<tr>
						<td class="<?php $cutoff = new DateTime(); $cutoff->setDate(date("Y"),date("m"),date("d")+2); if ($tickets[$i]->isOpen() && $tickets[$i]->getOpenDate() >= $cutoff) echo "blue"; else echo "red"; ?> font_white left_rc" style="width:10px;"><a href="?p=<?php echo md5(Page::$tkt[5]).'&id='.$tickets[$i]->getId(); ?>">
							<i class="fa fa-envelope-o font_white"></i></a>
						</td>
						<td style="border: solid 1px #f05a49;border-bottom-right-radius: 5px;border-top-right-radius: 5px;">
							<b><?php echo $tickets[$i]->getSubject()->getSubject(); ?></b><br>
							<font style="font-size:12px;">
							<?php echo $tickets[$i]->getUser()->getFname().' '.$tickets[$i]->getUser()->getLname(); ?><br>
							<?php 
							$tickDate = new DateTime($tickets[$i]->getOpenDate());
							echo $tickDate->format("d/m/Y"); ?></font>
						</td>
					</tr>
					<?php }
				} ?>

				</table>
			</div>
		</div>
		<div class="col_2third right">
			<div class="heading_bar rc darkblue">
				<h2>Watchlists</h2>
			</div>
			<?php
			$programmes = new MyProgramme(); $programmes = $programmes->getMyProgrammes(unserialize($_SESSION['user'])->getId());
			$schools = new MySchool(); $schools = $schools->getMySchools(unserialize($_SESSION['user'])->getId());
			$stu = new MyStudent(); $stu = $stu->getMyStudents(unserialize($_SESSION['user'])->getId());
			?>
			<div class="col_fullwidth" style="height:41px; overflow:visible; border-bottom:1px solid #278bc3; margin-top:10px;">
		        <ul class="tabs">
		        	<a onClick="showTab('#progs','#tab1','');"><li id="progs" class="tab rc currenttab group1"><i class="fa fa-file-text-o"></i> Programmes (<?php echo sizeof($programmes); ?>)</li></a>
		        	<a onClick="showTab('#schools','#tab2','');"><li id="schools" class="tab rc group1"><i class="fa fa-university"></i> Schools (<?php echo sizeof($schools); ?>)</li></a>
		        	<a onClick="showTab('#students','#tab3','');"><li id="students" class="tab rc group1"><i class="fa fa-graduation-cap"></i> Students (<?php echo sizeof($stu); ?>)</li></a>
		        </ul>
	        </div>
	        <div class="col_fullwidth inner_col tabwrap" style="border:1px solid #278bc3; border-top:0px; padding:20px; padding-top:10px; padding-bottom:10px;">
        		<div class="col_fullwidth tabdisplay currentdisplay" id="tab1">
					
						<table>
							<?php
							for ($i=0; $i<sizeof($programmes); $i++) {
								$prog = $programmes[$i]->getProgramme(); ?>
							<tr>
								<td style="width:140px; margin-right:0px; padding-right:0px; text-align:center; vertical-align:top;">
									<div class="col_fullwidth" style="width:100px; overflow:hidden; vertical-align:top;">
										<img src="<?php echo $prog->getLogo(); ?>" width="auto" height="auto" alt="image" class="rc" style="max-width:100px; max-height:80px;">
										<form method="POST" action="?">
											<input type="hidden" name="function" value="deleteMyProgramme">
											<input type="hidden" name="programmeId" value="<?php echo $prog->getId(); ?>">
											<a class="font_darkblue" style="text-decoration:none;" onClick="this.parentNode.submit();">
												<i class="fa fa-eye-slash font_red" style="margin-right:5px;"></i><font class="font_red">Remove</font>
											</a>
										</form>
									</div>
								</td>
								<td style="width:100%; vertical-align:top; overflow:visible;">
									<a href="?p=<?php echo md5(Page::$prg[0]); echo "&id=".$prog->getId(); ?>" style="text-decoration:none; overflow:visible;">
										<div class="col_fullwidth inner_col rc" style="background:#fff; height:110px; margin-bottom:6px; padding-top:4px; padding-bottom:4px; overflow:visible;">
											<div class="col_fullwidth" style="height:100%;">
												<h1 style="font-size:20px; margin:0px; padding:0px;"><font class="font_green"><?php echo $prog->getName(); ?></font></h1>
												<p style="font-size:12px;">London<?php if ($prog->getPostcode() != "") echo ", ".substr($prog->getPostcode(),0,7); ?></p>
												<div class="fullwidth" style="position:relative; bottom:-30px;">
													<div class="col_half left">
														<p class="font_darkblue"><i class="fa fa-money" style="margin-right:5px;"></i><font class="font_darkblue"><?php
														if ($prog->getPrice() > 0) {
															echo "&pound;".$prog->getPrice();
															echo " / ";
															if ($prog->getPerStudent()) echo "student";
															else echo "school";
														} else if ($prog->getPrice() == 0) echo "Free";
														else if ($prog->getPrice() < 0) echo "Enquire";
														?></font></p>
													</div>
													<div class="col_half right">
														<i class="fa fa-calendar-o" style="margin-right:5px;"></i><?php
														$crs = $prog->getCourses();
														$courses = array();
														for($a=0; $a<sizeof($crs); $a++) {
															if ($a<2) {
																$dateTime = explode(" ",$crs[$a]->getFirstSession());
																$date = explode("-",$dateTime[0]);
																$courses[] = date("M Y",mktime(0,0,0,$date[1],$date[2],$date[0]));
															}
														}
														if (sizeof($courses) > 0) echo implode(", ",$courses);
														else echo "None";
														?>
													</div>
												</div>
											</div>
										</div>
									</a>
								</td>
							</tr>
							<?php } ?>
						</table>
					
				</div>
				<div class="col_fullwidth tabdisplay" id="tab2">
					
					<table>
						<?php for ($i=0; $i<sizeof($schools); $i++) {
							$school = $schools[$i]->getSchool(); ?>
						<tr>
							<td style="width:12%; margin-right:0px; padding-right:0px; text-align:center;">
								<div class="col_fullwidth" style="width:100px; height:115px; overflow:hidden;"><img src="<?php echo $school->getBadge(); ?>" width="90" height="90" alt="image" class="rc" style="margin-bottom:7px;">
									<form method="POST" action="?" style="margin-top:0px;">
										<input type="hidden" name="function" value="deleteMySchool">
										<input type="hidden" name="schoolId" value="<?php echo $schools[$i]->getSchoolId(); ?>">
										<a class="font_darkblue" style="text-decoration:none;" onClick="this.parentNode.submit();">
											<i class="fa fa-eye-slash font_red" style="margin-right:5px;"></i><font class="font_red">Remove</font>
										</a>
									</form>
								</div>
							</td>
							<td>
								<a href="?p=<?php echo md5(Page::$sch[2]); ?>&id=<?php echo $schools[$i]->getSchoolId(); ?>" style="text-decoration:none;">
									<div class="col_fullwidth inner_col rc" style="background:#fff; display:inline-block; height:120px; float:left; margin-right:1%; margin-bottom:0px; padding-top:4px; padding-bottom:4px; overflow:visible; text-align:left;">
										<h1 style="font-size:20px; margin:0px; padding:0px;"><font class="font_green"><?php echo $school->getSchoolName(); ?></font></h1>
										<p style="font-size:15px; margin-bottom:35px;"><?php echo $school->getBorough()->getBorough(); ?></p>
										<p style="font-size:25px;"><?php echo $school->getTotalStudents(); ?>&nbsp;Total Students</p>
									</div>
								</a>
							</td>
						</tr>
						<?php } ?>
					</table>
				
			</div>
			<div class="col_fullwidth tabdisplay" id="tab3">
				
					<table>
						<?php for ($i=0; $i<sizeof($stu); $i++) { ?>
						<tr>
							<td style="width:12%; margin-right:0px; padding-right:0px; text-align:center;">
								<div class="col_fullwidth" style="width:100px; height:115px; overflow:hidden;"><img src="imgs/icon-user-default2.png" width="90" height="90" alt="image" class="rc" style="margin-bottom:7px;">
									<form method="POST" action="?" style="margin-top:0px;">
										<input type="hidden" name="function" value="deleteMyStudent">
										<input type="hidden" name="studentId" value="<?php echo $stu[$i]->getStudentId(); ?>">
										<a class="font_darkblue" style="text-decoration:none;" onClick="this.parentNode.submit();">
											<i class="fa fa-eye-slash font_red" style="margin-right:5px;"></i><font class="font_red">Remove</font>
										</a>
									</form>
								</div>
							</td>
							<?php $student = $stu[$i]->getStudent(); ?>
							<td>
								<a href="?p=<?php echo md5(Page::$stu[0]); ?>&id=<?php echo $stu[$i]->getStudentId(); ?>" style="text-decoration:none;">
									<div class="col_fullwidth inner_col rc" style="background:#fff; width:100%; display:inline-block; height:120px; float:left; margin-right:1%; margin-bottom:0px; padding-top:4px; padding-bottom:4px; overflow:visible; text-align:left;">
										<h1 style="font-size:30px; margin:5px; padding:0px;"><font class="font_green">
											<?php echo $student->getUser()->getFname(); ?>&nbsp;<?php echo $student->getUser()->getLname(); ?></font>
										</h1>
										<p style="font-size:25px; margin-top:10px; margin-left:5px;"><?php echo $stu[$i]->getStudentId(); ?></p>
										<div style="float:right; margin-top:-33px; text-align:right; padding-right:25px;">
											<p style="font-size:25px; margin-bottom:10px;"><?php if ($student->getMale()) echo "Male";
												else if ($student->getFemale()) echo "Female"; ?>
											</p>
											<p style="font-size:25px;"><?php echo $student->getAge(); ?></p>
										</div>
									</div>
								</a>
							</td>
						</tr>
						<?php } ?>
					</table>
				
			</div>
		</div>
	</div>
</div>
<script>
jQuery(document).ready(function($){
	colour_rows(".tickets", "light");
});
</script>