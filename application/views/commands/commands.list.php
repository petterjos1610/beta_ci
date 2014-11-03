<div id="wrapper">
	<div class="heading_bar rc darkgrey">
		<h1>View Commands</h1>
	</div>
		<div id="content" class="rc">

	<?php
/*	if (in_array(Page::$cmd[1],$_SESSION['privileges']))
		echo "<div class='col_fullwidth' style='margin-bottom:20px'><a href='?p=".md5(Page::$cmd[1])."'>
				<input name='' type='submit' class='btn darkgreen right rc' style='width:200px' value='New' >
				</a></div>"; */?>

	<?php
	/*$cmd = new Command();
	$cmd = $cmd->getCommands();
	$stmt = viewCommand(0);*/
	/*if (in_array(Page::$cmd[2],$_SESSION['privileges'])) $isEditable = true;
	else*/ $isEditable = false;
	echo "<div id='' class='trans_table  text_area rc'><table class='datatable'><tr class='header'><th style='width:40%; text-align:left;'>Command Code</th><th style='width:40%; text-align:left;'>Description</th><th>Enabled</th>";
	if ($isEditable) echo "<th>Edit</th></tr>";
	for ($i=0; $cmd != null, $i < sizeof($cmd); $i++) {
		echo "<tr><td>".$cmd[$i]->command.'</td><td>'.$cmd[$i]->outputString.'</td><td style="text-align:center"><div class="';
		if ($cmd[$i]->enabled) echo 'font_darkgreen" style="text-align:center;">&#10004;';
		else echo 'font_red" style="text-align:center;">&#10008;';
		echo "</div></td>";
		if ($isEditable)?>

        <td><a href="<?php echo    site_url()."/tickets/ticket_subject_edit/".$cmd[$i]->id; ?>"><div class='small_btn yellow_bg'>Edit</div></a></td>
    <?php
        echo "</tr>";
		echo "</tr>";
	}
	echo "</table>"; ?>

	</div></div>
</div>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	</div>