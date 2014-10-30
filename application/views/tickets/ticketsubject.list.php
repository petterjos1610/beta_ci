<div class="header_shadow">
		<div class="current_tab tab_typeSetting"></div>
</div>
<div id="wrapper">
	<div class="heading_bar rc midgrey">
		<h1>View Ticket Topics</h1>
	</div>
	<div id="content" class="rc">


	<?php
/*if (in_array(Page::$tkt[1],$_SESSION['privileges']))
	echo "<div class='col_fullwidth' style='margin-bottom:20px'><a href='?p=".md5(Page::$tkt[1])."'>
			<input name='' type='submit' class='btn darkgreen right rc' style='width:200px' value='New' >
			</a></div>
				<div id='' class='trans_table text_area rc'>";
*/?>
        <div class='col_fullwidth' style='margin-bottom:20px'><a href="<?php echo site_url();?>/tickets/ticket_subject_create/">
                <input name='' type='submit' class='btn darkgreen right rc' style='width:200px' value='New' >
            </a></div>
        <div id='' class='trans_table text_area rc'>
<?php
/*if (in_array(Page::$tkt[2],$_SESSION['privileges'])) $isEditable = true;
else*/ $isEditable = false;
echo "<table class='datatable'><tr class='header'><th style='width:250px'>User Group</th><th style='width:500px; text-align:left;'>Subject</th><th>Enabled</th>";
if ($isEditable) echo "<th>Edit</th></tr>";
for ($i=0; $i<sizeof($tkt); $i++) {
	echo "<tr style='height:20px'><td class='center'>".$tkt[$i]->name.'</td><td style="width:15px;">'.$tkt[$i]->subject.'</td><td class="center"><div class="';
	if ($tkt[$i]->enabled) echo 'green">&#10004;';
	else echo 'red">&#10008;';
	echo "</div></td>";
	if ($isEditable)?>

        <td><a href="<?php echo    site_url()."/tickets/ticket_subject_edit/".$tkt[$i]->id; ?>"><div class='small_btn yellow_bg'>Edit</div></a></td>
    <?php
        echo "</tr>";
}
echo "</table>";
?>
</div>
</div>
</div>
<script>
	jQuery(document).ready(function($){	
		colour_rows(".trans_table", "grey");
	});
</script>