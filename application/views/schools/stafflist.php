<div id="wrapper">
	<div class="heading_bar rc orange">
		<h1>Staff Accounts</h1>
	</div>
	<div id="content" class="rc border_orange">
		<!----
        <form id="search_form" method="POST" action="" name="search_form">
            <div class="right" style="margin:0px; padding:0px;">
                <select class="text_area select_img" name="orderby" onChange='search_form.submit();' style="margin:0px; padding:0px; padding-left:10px;">

                    <option value="lname_asc" <?php if (isset($_POST['orderby']) && $_POST['orderby'] == "lname_asc") echo " SELECTED"; ?>>Last Name ASC</option>
                    <option value="lname_desc" <?php if (isset($_POST['orderby']) && $_POST['orderby'] == "lname_desc") echo " SELECTED"; ?>>Last Name DESC</option>
                    <option value="fname_asc" <?php if (isset($_POST['orderby']) && $_POST['orderby'] == "fname_asc") echo " SELECTED"; ?>>First Name ASC</option>
                    <option value="fname_desc" <?php if (isset($_POST['orderby']) && $_POST['orderby'] == "fname_desc") echo " SELECTED"; ?>>First Name DESC</option>

                </select>
            </div>
        </form>
		---->


		<div class="col_fullwidth">
			<a href="?p=<?php echo md5(Page::$stf[1]); ?>"><input name="" type="button" class="btn darkgreen rc right" value="Add" style="margin-bottom:20px;"></a>
			<input class='text_area left' type='text' id='search' value='' style='width:200px; background:url(imgs/search_icon_sml.gif) no-repeat scroll 7px 7px; background-position:7px 50%; padding-left:35px;'>
		</div>
		<div class="col_fullwidth">
			<?php 
			
			//order by
            $orderBy='ORDER BY lname ASC';
            if (isset($_POST['orderby']) && $_POST['orderby']== "lname_asc"){
                $orderBy='ORDER BY lname ASC';
            }
            if (isset($_POST['orderby']) && $_POST['orderby']== "lname_desc"){
                $orderBy='ORDER BY lname DESC';
            }
            if (isset($_POST['orderby']) && $_POST['orderby']== "fname_asc"){
                $orderBy='ORDER BY fname ASC';
            }
            if (isset($_POST['orderby']) && $_POST['orderby']== "fname_desc"){
                $orderBy='ORDER BY fname DESC';
            }
			
			//
			
			
			/*
			if (!isset($_SESSION['role'])) {
				$schools = new School();
				$schools = $schools->getSchools();
			} else if (get_class(unserialize($_SESSION['role'])) == "SchoolStaff") {
				$school = new School();
				$schools = array();
				$school->load(unserialize($_SESSION['role'])->getSchoolId());
				$schools[] = $school;
			}
			*/
			//echo "<pre>";
			//print_r($schstaff);
			$sS = array();
			$sId = array();
			foreach ($schstaff as $staff) { 
				//print_r($staff); ?>
			<div class="expandable">
				<div class="expandable_title rc orange">
					<h2><span class="fa fa_icon fa-file-text-o"></span><?php echo $staff[0]->schoolName; ?></h2>
				</div>
				<div class="expandable_content rc inner_col staff_accounts">
					<table class="datatable">
					<?php
					for ($i=1; $i<sizeof($staff); $i++) {
						$sS[] = '"'.$staff[$i]->fname.' '.$staff[$i]->lname.'"';
						$sId[] = '"'.$staff[$i]->s_userId.' '.$staff[$i]->s_schoolId.'"';
						if ($staff[$i]->enabled) { ?>
						<tr>
							<td width="10%" ><span class="fa fa-user"></span></td>
							<td width="30%"><?php echo $staff[$i]->lname.', '.$staff[$i]->fname; ?></td>
							<td width="20%"><?php //echo $staff[$i]->userType()->getName(); ?></td>
							<td width="20%">TBC</td>
							<td width="10%"><a href="<?php echo base_url(). "index.php/schoolstaff/view/" . md5(Page::$stf[1]); ?>/<?php echo $staff[$i]->s_userId; ?>/<?php echo $staff[$i]->s_schoolId; ?>"><i class="fa fa-pencil-square-o" style="margin-right:5px;"></i> Edit</td>
						</tr>
						<?php }
					} ?>
					</table>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
</div>
<script>

	jQuery(document).ready(function($) {
		/*
		var availableTags = [<?php echo implode(",",$sS); ?>];
		var ids = [<?php echo implode(",",$sId); ?>]
		$( "#search" ).autocomplete({
			source: function(request, response) {
				var filteredArray = $.map(availableTags, function(item) {
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
					//console.log(ui.item.value+' '+studentNames.indexOf(ui.item.value));
					var params = ids[availableTags.indexOf(ui.item.value)].split(" ");
					window.location.href='index.php?p=<?php echo md5(Page::$stf[1]); ?>&id='+params[0]+'&urn='+params[1]
				}
			}
		});
*/
		setup_expandables();
		colour_rows("#staff_accounts", "trans");

	});
</script>