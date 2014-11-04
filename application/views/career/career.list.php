<div id="wrapper">
    <div class="heading_bar rc darkgrey">
        <h1>View Career</h1>
    </div>
    <div id="content" class="rc">


        <?php

      //  if (in_array(Page::$crr[1],$_SESSION['privileges']))
         /*   echo "<div class='col_fullwidth' style='margin-bottom:20px'><a href='?p=".md5(Page::$crr[1])."'>
			<input name='' type='submit' class='btn darkgreen right rc' style='width:200px' value='New' >
			</a></div>
				<div id='' class='trans_table text_area rc'>";*/
        ?>
        <div class='col_fullwidth' style='margin-bottom:20px'><a href="<?php echo site_url();?>/careers/career_create/" >
                <input name='' type='submit' class='btn darkgreen right rc' style='width:200px' value='New' >
            </a></div>
        <div id='' class='trans_table text_area rc'>

        <?php
       /* if (in_array(Page::$crr[2],$_SESSION['privileges'])) $isEditable = true;
        else*/ $isEditable = false;
        echo "<table class='datatable'><tr class='header'><th style='width:90%; text-align:left;'>Career</th><th>Enabled</th>";
        if ($isEditable) echo "<th>Edit</th></tr>";
        for ($i=0; $careers != null,$i<sizeof($careers); $i++) {
            echo "<tr style='height:20px'><td style='text-align:left;'>".$careers[$i]->career.'</td><td class="center"><div class="';
            if ($careers[$i]->enabled==1) echo 'font_darkgreen" style="text-align:center;">&#10004;';
            else echo 'font_red" style="text-align:center;">&#10008;';
            echo "</div></td>";
            if ($isEditable)?><td><a href="<?php echo site_url().'/careers/career_edit/'.$careers[$i]->id; ?>" ><div class='small_btn yellow_bg'>Edit</div></a></td>
            <?php  echo "</tr>";
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