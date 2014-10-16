<div id="wrapper">
	<div class="heading_bar rc orange">
		<h1>Search</h1>
	</div>
	<?php //include "forms/school.search.form.php"; ?>
	<div id="content" class="rc border_orange" style="margin-top:30px">
		<div class="heading_bar rc orange">
			<h1>All Schools</h1>
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
		<!----
        <div class="right" style="margin:0px; padding:0px;">
            <select class="text_area select_img" name="orderby" onChange="orderBy(this.value); submit_form();" style="margin:0px; padding:0px; padding-left:10px;">
                <option value="schoolName_asc" <?php if (isset($_GET['orderby']) && $_GET['orderby'] == "schoolName_asc") echo " SELECTED"; ?>>School Name ASC</option>
                <option value="schoolName_desc" <?php if (isset($_GET['orderby']) && $_GET['orderby'] == "schoolName_desc") echo " SELECTED"; ?>>School Name DESC</option>
                <option value="totalStudents_asc" <?php if (isset($_GET['orderby']) && $_GET['orderby'] == "totalStudents_asc") echo " SELECTED"; ?>>Students Total ASC</option>
                <option value="totalStudents_desc" <?php if (isset($_GET['orderby']) && $_GET['orderby'] == "totalStudents_desc") echo " SELECTED"; ?>>Students Total DESC</option>
                <option value="premiumStudents_asc" <?php if (isset($_GET['orderby']) && $_GET['orderby'] == "premiumStudents_asc") echo " SELECTED"; ?>>Pupil Premium ASC</option>
                <option value="premiumStudents_desc" <?php if (isset($_GET['orderby']) && $_GET['orderby'] == "premiumStudents_desc") echo " SELECTED"; ?>>Pupil Premium  DESC</option>

                <option value="borough_asc" <?php if (isset($_GET['orderby']) && $_GET['orderby'] == "borough_asc") echo " SELECTED"; ?>>Borough ASC</option>
                <option value="borough_desc" <?php if (isset($_GET['orderby']) && $_GET['orderby'] == "borough_desc") echo " SELECTED"; ?>>Borough  DESC</option>

            </select>
        </div>
        ---->
		<div class="col_fullwidth" style="height:41px; overflow:visible; border-bottom:1px solid #278bc3; margin-top:10px;">
			<ul class="tabs">
				<a onClick="showTab('#list','#tab1','');"><li id="list" class="tab rc currenttab group1"><i class="fa fa-list-alt"></i> List</li></a>
				<a onClick="showTab('#map','#tab2',''); if (!init) initialize();"><li id="map" class="tab rc group1"><i class="fa fa-map-marker"></i> Map</li></a>	
			</ul>
		</div>

		<div class="col_fullwidth inner_col tabwrap" style="border:1px solid #278bc3; border-top:0px; padding:0px; padding-top:10px; padding-bottom:10px;">
	        <div class="col_fullwidth tabdisplay currentdisplay" id="tab1">
				<table cellspacing="10">
					<?php 
					//$mySch = new MySchool();
					//$mySch = $mySch->getMySchools(unserialize($_SESSION['user'])->getId());
					$mySchIds = array();
					//for ($i=0; $i<sizeof($mySch); $i++) {
					//	$mySchIds[] = $mySch[$i]->getSchoolId();
					//}
					for ($i=0; $i<sizeof($schools); $i++) { ?>
					<tr>
						<td style="width:12%; margin-right:0px; padding-right:0px; text-align:center;">
							<div class="col_fullwidth" style="height:115px; overflow:hidden;"><img src="<?php echo base_url() . $schools[$i]->badge; ?>" width="90" height="90" alt="image" class="rc" style="margin-bottom:7px;">
								<form method="POST" action="?" style="margin:0px;">
									<input type="hidden" name="function" value="<?php if (in_array($schools[$i]->urn,$mySchIds,true)) echo "deleteMySchool"; else echo "createMySchool"; ?>">
									<input type="hidden" name="schoolId" value="<?php echo $schools[$i]->urn; ?>">
									<a class="font_darkblue" style="text-decoration:none;" onClick="this.parentNode.submit();">
										<?php if (in_array($schools[$i]->urn,$mySchIds,true)) { ?><i class="fa fa-eye-slash font_red" style="margin-right:5px;"></i><font class="font_red">Remove</font><?php } else { ?><i class="fa fa-eye" style="margin-right:5px;"></i>Watchlist<?php } ?>
									</a>
								</form>
							</div>
						</td>
						<td>
							<a href="<?php echo base_url() . "index.php/schools/view/" . md5(Page::$sch[2]); ?>/<?php echo $schools[$i]->urn; ?>" style="text-decoration:none;">
								<div class="col_fullwidth inner_col rc" style="background:#fff; width:75%; display:inline-block; height:120px; float:left; margin-right:1%; margin-bottom:0px; padding-top:4px; padding-bottom:4px; overflow:visible;">
									<h1 style="font-size:20px; margin:0px; padding:0px;"><font class="font_green"><?php echo $schools[$i]->schoolName; ?></font></h1>
									<p style="font-size:15px; margin-bottom:35px;"><?php //echo $schools[$i]->getBorough()->getBorough(); ?></p>
									<p style="font-size:25px;"><?php echo $schools[$i]->totalStudents; ?>&nbsp;Total Students</p>
									<div style="width:90px; margin-top:-93px; float:right; text-align:right;">
										<p style="font-size:25px; margin-bottom:10px;"><?php echo $schools[$i]->premiumStudents; ?></p>
										<p style="font-size:25px; margin-bottom:10px;"><?php $stus = $schools[$i]->matchStudents;
											$noStus = 0;
											//for ($a=0; $a<sizeof($stus); $a++) {
											//	if ($stus[$a]->getUser()->isEnabled()) $noStus++;
											//}
											echo $noStus; 
											?>
										</p>
										<p style="font-size:25px;"><?php /*
										$students = $schools[$i]->getStudents();
											$enrolees = 0;
											for ($a=0; $a<sizeof($students); $a++) {
												$enrolments = $students[$a]->getEnrolments();
												if ($enrolments != null) {
													for ($b=0; $b<sizeof($enrolments); $b++) {
														if (!$enrolments[$b]->isCompleted()) $enrolees++;
													}
												}
											}
											echo $enrolees;

											*/
											//echo $schools[$i]->getNoEnrolled();
											echo 0; ?>
										</p>
									</div>
								</div>
								<div class="col_fullwidth inner_col rc" style="background:#fff; width:24%; display:inline-block; height:120px; margin-bottom:0px; padding-top:16px; padding-bottom:4px;"> 
									<p style="font-size:16px; margin-bottom:10px;">on pupil premium</p>
									<p style="font-size:16px; margin-bottom:10px;">on EduKit</p>
									<p style="font-size:16px;">students enrolled</p>
								</div>
							</a>
						</td>
					</tr>
					<?php } ?>
				</table>
			</div>
			<div class="col_fullwidth tabdisplay" id="tab2">
					<?php
					$mapLocations = array();
					$schLocations = array();
					if (sizeof($schools) > 0) {
						for ($i=0; $i<sizeof($schools); $i++) {
							if (!in_array(str_replace(" ","%20",$schools[$i]->address).'%20'.str_replace(" ","%20",$schools[$i]->postcode),$schLocations)) {
								$progLocations[] = str_replace(" ","%20",$schools[$i]->address.'%20'.str_replace(" ","%20",$schools[$i]->postcode));
								$mapLocations[] = "new google.maps.LatLng(".$schools[$i]->lat.", ".$schools[$i]->lng.")";
								$mapTitles[] = addslashes($schools[$i]->schoolName);
								$mapDesc[] = '<div style="width:400px;"><div id="siteNotice"></div><h2 style="color:#000000; text-align:left;">'.addslashes($schools[$i]->schoolName).'</h2><div style="text-align:left;"><p>'.$schools[$i]->postcode.'</p></div></div>';
							}
						}
						?>
						<script type="text/javascript">
							var init = 0;
							var infoWindows = [];
							var markers = [];
							var marker;
							var iterator = 0;
							var map;

							var neighborhoods = [ <?php echo implode(",",$mapLocations); ?> ];
							var titles = [<?php echo "'".implode("','",$mapTitles)."'"; ?>];
							var descriptions = [<?php echo "'".implode("','",$mapDesc)."'"; ?>];

							if (neighborhoods.length > 0) var position = neighborhoods[0];
							else var position = new google.maps.LatLng(51.5085150,-0.1254872);

							function initialize() {
								init = 1;
								var mapOptions = {
									zoom: 10,
									center: position
								};

								map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
								drop();
							}

							function drop() {
								for (var i = 0; i < neighborhoods.length; i++) {
									setTimeout(function() {
										addMarker();
									}, i * 5);
								}
							}

							function addMarker() {
								var infoWindow = new google.maps.InfoWindow({
									content: descriptions[iterator],
									maxWidth: 400
								});
								var point = new google.maps.Marker({
									position: neighborhoods[iterator],
									title: titles[iterator],
									map: map,
									draggable: false,
									animation: google.maps.Animation.DROP
								});
								markers.push(point);
								infoWindows.push(infoWindow);
								google.maps.event.addListener(markers[iterator], 'click', function(e) { toggleBounce(point); if (point.getAnimation() != null) openWindow(infoWindow,map,point); else infoWindow.close(); });
								google.maps.event.addListener(infoWindow,'closeclick',function(){ toggleBounce(point); point.setAnimation(null); });
								iterator++;
							}

							function openWindow(window,map,point) {
								window.open(map,point);
							}

							function toggleBounce(mark) {
								if (mark.getAnimation() != null) {
									mark.setAnimation(null);
								} else {
									mark.setAnimation(google.maps.Animation.BOUNCE);
								}
							}
						</script>
						<div id="map-canvas" style="width:100%; height:600px;"></div>
						<?php } ?>
			</div>
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

    $('#search_form').submit(function(event){
        location.href = '?p=<?php  echo md5(Page::$sch[0]); ?>&'+$(this).serialize();
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

jQuery(document).ready(function($){	
	setup_expandables();
	setup_tabs();
	style_forms()
});
</script>