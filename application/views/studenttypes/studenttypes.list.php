<div id="wrapper">
    <div class="heading_bar rc darkgrey">
        <h1>View Student Types</h1>
    </div>
    <div id="content" class="rc">

        <?php
     /*   if (in_array(Page::$stp[1],$_SESSION['privileges']))
            echo "<div class='col_fullwidth' style='margin-bottom:20px'><a href='?p=".md5(Page::$stp[1])."'>
			<input name='' type='submit' class='btn darkgreen right rc' style='width:200px' value='New' >
			</a></div>
				<div id='' class='trans_table text_area rc'>";
        */?>
        <div class='col_fullwidth' style='margin-bottom:20px'><a href="<?php echo site_url();?>/studenttypes/studenttypes_create/">
                <input name='' type='submit' class='btn darkgreen right rc' style='width:200px' value='New' >
            </a></div>
        <div id='' class='trans_table text_area rc'>
        <?php

        /*if (in_array(Page::$stp[2],$_SESSION['privileges'])) $isEditable = true;
        else*/ $isEditable = false;
        echo "<table class='datatable'><tr class='header'><th style='width:90%; text-align:left;'>Student Types</th><th>Enabled</th>";
        if ($isEditable) echo "<th>Edit</th></tr>";

            foreach($stmt as $row){
            echo "<tr style='height:20px'><td style='text-align:left'>".$row->name.'</td><td class="center"><div class="';
            if ($row->enabled) echo 'green">&#10004;';
            else echo 'red">&#10008;';
            echo "</div></td>";
            if ($isEditable)?>  <td><a href="<?php echo site_url().'/studenttypes/studenttypes_edit/'.$row->id; ?>"><div class='small_btn yellow_bg'>Edit</div></a></td>
            <?php echo "</tr>";
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