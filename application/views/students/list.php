<?php //echo "<pre>"; print_r($students); ?>
<div id="wrapper">
<?php
    $orderBy='ORDER BY lname ASC';
    if (isset($_GET['orderby']) && $_GET['orderby']== "lname_asc"){
        $orderBy='ORDER BY lname ASC';
    }
    if (isset($_GET['orderby']) && $_GET['orderby']== "lname_desc"){
        $orderBy='ORDER BY lname DESC';
    }
    if (isset($_GET['orderby']) && $_GET['orderby']== "fname_asc"){
        $orderBy='ORDER BY fname ASC';
    }
    if (isset($_GET['orderby']) && $_GET['orderby']== "fname_desc"){
        $orderBy='ORDER BY fname DESC';
    }
    if (isset($_GET['orderby']) && $_GET['orderby']== "age_asc"){
        $orderBy='order by s_dob DESC';
    }
    if (isset($_GET['orderby']) && $_GET['orderby']== "age_desc"){
        $orderBy='order by s_dob ASC';
    }

    if (isset($_GET['orderby']) && $_GET['orderby']== "s_upn_asc"){
        $orderBy='order by s_upn ASC';
    }
    if (isset($_GET['orderby']) && $_GET['orderby']== "s_upn_desc"){
        $orderBy='order by s_upn DESC';
    }
	if (isset($_GET['function']) ) {
		$function=$_GET['function'];
	}
	if (isset($function) && $function == "studentSearch") {
		if ($_GET['name'] != "" || $_GET['age'] != "" || $_GET['gender'] != "" || $_GET['phaseId'] != "" ) {
		if ($_GET['name'] != "") {
			$name = $_GET['name'];
			$searchString =  "SELECT s_upn,s_uln,s_userId,s_schoolId,s_teacherId,s_displayName,s_dob,s_male,s_female,s_ethnicityId,s_religionId,s_address,s_postcode,s_behaviourPoints,s_achievementPoints,s_strengths,s_concerns,s_previousInterventions,s_additionalComments,Users.fname,Users.lname FROM Students LEFT JOIN (SELECT id,fname,lname FROM Users) AS Users ON Users.id = Students.s_userId WHERE fname LIKE '%$name%' OR lname LIKE '%$name%' OR s_displayName LIKE '%$name%'";

			$stmt = mysqli_query($dbconnect->mysqli,$searchString) or die(mysqli_error($dbconnect->mysqli));
			$num = array();
			while ($row = mysqli_fetch_array($stmt)) {
				$num[] = $row['s_upn'] ;
			}
			$totalEntries = count($num);
			$ur= "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
			if(isset($_GET['pn'])) {
				$pn=$_GET['pn'];
			} else {
				$pn='';
			}

			$paginator=new Paginator();
			$arr=$paginator->paginiraj($ur,$pn,$totalEntries);
			$limit_start=$arr['limit_start'];
			$limit_end=$arr['limit_end'];
			$limit=" LIMIT $limit_start,$limit_end ";

			$searchString = "SELECT s_upn,s_uln,s_userId,s_schoolId,s_teacherId,s_displayName,s_dob,s_male,s_female,s_ethnicityId,s_religionId,s_address,s_postcode,s_behaviourPoints,s_achievementPoints,s_strengths,s_concerns,s_previousInterventions,s_additionalComments,Users.fname,Users.lname FROM Students LEFT JOIN (SELECT id,fname,lname FROM Users) AS Users ON Users.id = Students.s_userId WHERE fname LIKE '%$name%' OR lname LIKE '%$name%' OR s_displayName LIKE '%$name%' $limit ";
		} else if ($_GET['age'] != "" || $_GET['gender'] != "" || $_GET['phaseId'] != "") {
			$age = $_GET['age'];
			$gender = $_GET['gender'];
			$phaseId = $_GET['phaseId'];
			$searchString = array();
			if ($age != "") {
				$d1 = new DateTime($age);
				$d2 = new DateTime($d1->format("Y")-1 .'-'. $d1->format("m") .'-'. $d1->format("d"));
				$searchString[] = "s_dob <= '".$d1->format("Y-m-d")."' AND s_dob > '".$d2->format("Y-m-d")."'";
			}
			if ($gender != "") {
				if ($gender == "both") $searchString[] = "s_male = '1' OR s_female = '1' ";
				if ($gender == "male") $searchString[] = "s_male = '1' AND s_female = '0' ";
				if ($gender == "female") $searchString[] = "s_male = '0' AND s_female = '1' ";
			}
			if ($phaseId != "") {
				$phase = "phaseId = '$phaseId'";
			}
			$searchString = implode(" AND ", $searchString);
			$search = "SELECT lname,fname,s_upn,s_uln,s_userId,s_schoolId,s_teacherId,s_displayName,s_dob,s_male,s_female,s_ethnicityId,s_religionId,s_address,s_postcode,s_behaviourPoints,s_achievementPoints,s_strengths,s_concerns,s_previousInterventions,s_additionalComments FROM Students INNER JOIN users on students.s_userId=users.id ";
			if (isset($phase)) {
				$search .= " INNER JOIN (SELECT s_studentId,s_phaseId FROM StudentsPhases WHERE s_phaseId='$phaseId') AS tb1 ON tb1.s_studentId = Students.s_upn";
			}
			if ($searchString != "") $search .= " WHERE ".$searchString." ".$orderBy."";
			$searchString = $search;
			$searchString =  $search;
			$stmt = mysqli_query($dbconnect->mysqli,$searchString) or die(mysqli_error($dbconnect->mysqli));
			$num = array();
			while ($row = mysqli_fetch_array($stmt)) {
				$num[] =$row['s_upn'] ;
			}
			$totalEntries = count($num);
			$ur= "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
			if(isset($_GET['pn'])){
				$pn=$_GET['pn'];
			} else {
				$pn='';
			}
			$paginator=new Paginator();
			$arr=$paginator->paginiraj($ur,$pn,$totalEntries);
			$limit_start=$arr['limit_start'];
			$limit_end=$arr['limit_end'];
			$limit=" LIMIT $limit_start,$limit_end ";
			$age = $_GET['age'];
			$gender = $_GET['gender'];
			$phaseId = $_GET['phaseId'];
			$searchString = array();
			if ($age != "") {
				$d1 = new DateTime($age);
				$d2 = new DateTime($d1->format("Y")-1 .'-'. $d1->format("m") .'-'. $d1->format("d"));
				$searchString[] = "s_dob <= '".$d1->format("Y-m-d")."' AND s_dob > '".$d2->format("Y-m-d")."'";
			}
			if ($gender != "") {
				if ($gender == "both") $searchString[] = "s_male = '1' OR s_female = '1' ";
				if ($gender == "male") $searchString[] = "s_male = '1' AND s_female = '0' ";
				if ($gender == "female") $searchString[] = "s_male = '0' AND s_female = '1' ";
			}
			if ($phaseId != "") {
				$phase = "phaseId = '$phaseId'";
			}
			$searchString = implode(" AND ", $searchString);
			$search = "SELECT lname,fname,s_upn,s_uln,s_userId,s_schoolId,s_teacherId,s_displayName,s_dob,s_male,s_female,s_ethnicityId,s_religionId,s_address,s_postcode,s_behaviourPoints,s_achievementPoints,s_strengths,s_concerns,s_previousInterventions,s_additionalComments FROM Students INNER JOIN users on students.s_userId=users.id ";
			if (isset($phase)) {
				$search .= " INNER JOIN (SELECT s_studentId,s_phaseId FROM StudentsPhases WHERE s_phaseId='$phaseId') AS tb1 ON tb1.s_studentId = Students.s_upn";
			}
			if ($searchString != "") $search .= " WHERE ".$searchString." ".$orderBy." $limit ";

			$searchString = $search;
		}
		$stmt = mysqli_query($dbconnect->mysqli,$searchString) or die(mysqli_error($dbconnect->mysqli));
		$students = array();
		while ($row = mysqli_fetch_array($stmt)) {
			$students[] = new Student($row['s_upn'], $row['s_uln'], $row['s_userId'], $row['s_schoolId'], $row['s_teacherId'], $row['s_displayName'], $row['s_dob'], $row['s_male'], $row['s_female'], $row['s_ethnicityId'], $row['s_religionId'], $row['s_address'], $row['s_postcode'], $row['s_behaviourPoints'], $row['s_achievementPoints'], $row['s_strengths'], $row['s_concerns'], $row['s_previousInterventions'], $row['s_additionalComments']);
			if ($students[sizeof($students)-1]->isActive()) $number++;
		}
	}
	} else {
		$students = new Student();
		$students = $students->getStudents();//$orderBy,$limit);
		for ($i=0; $i<sizeof($students); $i++) {
			if ($students[$i]->enabled && ((!isset($_SESSION['role'])) || (isset($_SESSION['role']) && unserialize($_SESSION['role'])->getSchoolId() == $students[$i]->getSchoolId()))) {
				//$number++;
			}
		}
	} ?>
	<div class="heading_bar rc orange">
		<h1>Search Students</h1>
	</div>
	<div id="content" class="rc border_orange">
		<?php //include "forms/student.search.form.php"; ?>
		<?php if (!isset($_SESSION['role']) || $_SESSION['type'] == "School Administrator") { ?>
		<!---<form name="form" method="POST" action="?p=<?php echo md5(Page::$stu[0]); ?>" enctype="multipart/form-data">
			<input type="hidden" name="function" value="csv_upload" enctype="multipart/form-data">
			<div class="expandable">
				<div class="expandable_title rc orange">
					<h2>Student Import</h2>
				</div>
				<div class="expandable_content" style="padding:0"> Import pupils/students from school MIS. Choose either upload a CSV file or connect via API
					<div class="spacer30"></div>
					<div class="col_half left">
						<div class="form_label">CSV</div>
						<input name="csv" type="file" class="text_area" style="width:70%" accept=".csv">
						<input name="" type="button" class="btn darkgreen right rc" style="width:26%" value="Upload" onClick="form.submit()">
					</div>
					<div class="plain left" style="margin-left:5%; width:5%; text-align:center">|<br>OR<br>|</div>
					<div class="col_half right" style="width:40%">
						<div class="form_label" style="text-align:right">Connect via API</div>
						<input name="" type="button" class="btn red right rc" style="width:26%" value="Connect" >
					</div>
				</div>
			</div>
		</form>---->
		<?php } ?>
	</div>
	<div id="content" class="rc border_orange" style="margin-top:30px">
		<div class="heading_bar rc orange">
			<h1>All Students</h1>
		</div>
		<div class="plain right" style="display:inline-block; width:348px">
			<!---<div class="horiz_form_label" style="width:40px">View</div>
			<form name="">
				<div class="plain" style="width:200px; margin-right:10px; float:left">
					<select name="" class="text_area select_img">
						<option value='3' selected="selected">All Schools</option>
						<option value="1">Edukit Schools</option>
					</select>
				</div>
				<input name="" type="submit" class="btn darkgrey rc left" value="Update" >
			</form>---->
		</div>
		<!---<div class="clearfix"></div>
		<div class="col_fullwidth">
			<input name="" id="list_btn" type="button" class="btn darkgrey rc" value="List" >
			<input name="" id="map_btn"type="button" class="btn darkgrey rc" value="Map" >
		</div>---->




        <!---<div class="right" style="margin:0px; padding:0px;">
            <select class="text_area select_img" name="orderby" onChange="orderBy(this.value); submit_form();" style="margin:0px; padding:0px; padding-left:10px;">
                <option value="lname_asc" <?php if (isset($_GET['orderby']) && $_GET['orderby'] == "lname_asc") echo " SELECTED"; ?>>Last Name ASC</option>
                <option value="lname_desc" <?php if (isset($_GET['orderby']) && $_GET['orderby'] == "lname_desc") echo " SELECTED"; ?>>Last Name DESC</option>
                <option value="fname_asc" <?php if (isset($_GET['orderby']) && $_GET['orderby'] == "fname_asc") echo " SELECTED"; ?>>First Name ASC</option>
                <option value="fname_desc" <?php if (isset($_GET['orderby']) && $_GET['orderby'] == "fname_desc") echo " SELECTED"; ?>>First Name DESC</option>
                <option value="age_asc" <?php if (isset($_GET['orderby']) && $_GET['orderby'] == "age_asc") echo " SELECTED"; ?>>Age ASC</option>
                <option value="age_desc" <?php if (isset($_GET['orderby']) && $_GET['orderby'] == "age_desc") echo " SELECTED"; ?>>Age DESC</option>
                <option value="s_upn_asc" <?php if (isset($_GET['orderby']) && $_GET['orderby'] == "s_upn_asc") echo " SELECTED"; ?>>Upn ASC</option>
                <option value="s_upn_desc" <?php if (isset($_GET['orderby']) && $_GET['orderby'] == "s_upn_desc") echo " SELECTED"; ?>>Upn DESC</option>
            </select>
        </div>---->





		<div id="list_view" class="centre_td inner_col rc" style="margin-top:30px">
			<table>
				<?php if (!isset($students)) {
					$students = new Student();
					$students = $students->getStudents($orderBy);
				}
				$sA = array();
				$sUpn = array();
				$myProgIds = array();
				/*
				$myProgs = new MyStudent();
				$myProgs = $myProgs->getMyStudents(unserialize($_SESSION['user'])->getId());
				for ($i=0; $i<sizeof($myProgs); $i++) {
					$myProgIds[] = $myProgs[$i]->getStudentId();
				}
				*/
				for ($i=0; $i<sizeof($students); $i++) {
					$sA[] = '"'.stripslashes($students[$i]->fname).' '.stripslashes($students[$i]->lname).' ('.$students[$i]->s_upn.')"';
					$sUpn[] = '"'.$students[$i]->s_upn.'"';
					if ($students[$i]->enabled && ((!isset($_SESSION['role'])) || (isset($_SESSION['role']) && unserialize($_SESSION['role'])->schoolId() == $students[$i]->s_schoolId()))) {
						?>
						<tr>
							<td style="width:12%; margin-right:0px; padding-right:0px; text-align:center;">
								<div class="col_fullwidth" style="width:100px; height:115px; overflow:hidden;"><img src="<?php echo base_url(); ?>imgs/icon-user-default2.png" width="90" height="90" alt="image" class="rc" style="margin-bottom:7px;">
									<form method="POST" action="?" style="margin-top:0px;">
										<input type="hidden" name="function" value="<?php if (in_array($students[$i]->s_upn,$myProgIds,true)) echo "deleteMyStudent"; else echo "createMyStudent"; ?>">
										<input type="hidden" name="studentId" value="<?php echo $students[$i]->s_upn; ?>">
										<a class="font_darkblue" style="text-decoration:none;" onClick="this.parentNode.submit();">
											<?php if (in_array($students[$i]->s_upn,$myProgIds,true)) { ?>
											<i class="fa fa-eye-slash font_red" style="margin-right:5px;"></i><font class="font_red">Remove</font>
											<?php } else { ?>
											<i class="fa fa-eye" style="margin-right:5px;"></i>Watchlist
											<?php } ?>
										</a>
									</form>
								</div>
							</td>
							<td>
								<a href="<?php echo base_url() . "index.php/students/view/" . md5(Page::$stu[0]); ?>/<?php echo $students[$i]->s_upn; ?>" style="text-decoration:none;">
									<div class="col_fullwidth inner_col rc" style="background:#fff; width:100%; display:inline-block; height:120px; float:left; margin-right:1%; margin-bottom:0px; padding-top:4px; padding-bottom:4px; overflow:visible; text-align:left;">
										<h1 style="font-size:30px; margin:5px; padding:0px;"><font class="font_green">
											<?php echo $students[$i]->fname; ?>&nbsp;<?php echo $students[$i]->lname; ?></font>
										</h1>
										<p style="font-size:25px; margin-top:10px; margin-left:5px;"><?php echo $students[$i]->s_upn; ?></p>
										<div style="float:right; margin-top:-33px; text-align:right; padding-right:25px;">
											<p style="font-size:25px; margin-bottom:10px;"><?php if ($students[$i]->s_male) echo "Male";
												else if ($students[$i]->s_female) echo "Female"; ?>
											</p>
											<p style="font-size:25px;"><?php $dob = new DateTime($students[$i]->s_dob); $today = new DateTime(date("Y-m-d")); print_r($dob->diff($today)->y); ?></p>
										</div>
									</div>
								</a>
							</td>
						</tr>
						<?php } 
					} ?>
			</table>
		</div>
		<div class="spacer20"></div>
		<div class="col_fullwidth" style="overflow:visible; text-align:center;">
		</div>
	</div>
</div>
<script>
	function submit_form() {
		$('#search_form').submit();
	}

	jQuery(document).ready(function($){	
		setup_expandables();
		setup_tabs();
		style_forms();

		var studentNames = [<?php echo implode(",",$sA); ?>];
		var upns = [<?php echo implode(",",$sUpn); ?>]
		$( "#search" ).autocomplete({
			source: function(request, response) {
				var filteredArray = $.map(studentNames, function(item) {
					var names = item.split(" ");
					for (var i=0; i<names.length; i++) {
						if (names[i].toLowerCase().substr(0,request.term.length) == request.term.toLowerCase())
							return item;
					}
					return null;
				});
				response(filteredArray);
			},
			select: function( event, ui ) {
				if (event.type == "autocompleteselect") {
					console.log(ui.item.value+' '+studentNames.indexOf(ui.item.value));
					window.location.href='index.php?p=<?php echo md5(Page::$stu[0]); ?>&id='+upns[studentNames.indexOf(ui.item.value)]
				}
			}
		});

		$('#search_form').submit(function(event){
			location.href = '?p=<?php  echo md5(Page::$stu[0]); ?>&'+$(this).serialize();
			event.preventDefault();
		});
	});

    function orderBy(value) {
        var element = document.createElement('input');
        element.setAttribute("type","hidden");
        element.setAttribute("name","orderby");
        element.setAttribute("value",value);
        search_form.appendChild(element);
    }
</script>