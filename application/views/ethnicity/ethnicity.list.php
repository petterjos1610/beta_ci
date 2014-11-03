<div id="wrapper">
    <div class="heading_bar rc darkgrey">
        <h1>View Ethnicities</h1>
    </div>
    <div id="content" class="rc">

        <?php
       // if (in_array(Page::$eth[1],$_SESSION['privileges']))
        ?>
                    <div class='col_fullwidth' style='margin-bottom:20px'><a href="<?php echo site_url();?>/ethnicities/ethnicity_create/">
                            <input name='' type='submit' class='btn darkgreen right rc' style='width:200px' value='New' >
                        </a></div>
                    <div id='' class='trans_table text_area rc'>

        <?php
       /* if (in_array(Page::$eth[2],$_SESSION['privileges'])) $isEditable = true;
        else */$isEditable = false;
        echo "<table class='datatable'><tr class='header'><th style='width:90%; text-align:left;'>Ethnicity</th><th>Enabled</th>";
        if ($isEditable) echo "<th>Edit</th></tr>";
        for ($i=0;  $i<sizeof($eth); $i++) {
            echo "<tr style='height:20px'><td style='text-align:left]'>".$eth[$i]->ethnicity.'</td><td class="center"><div style="text-align:center;" class="';
            if ($eth[$i]->enabled==1) echo 'font_darkgreen">&#10004;';
            else echo 'font_red">&#10008;';
            echo "</div></td>";
            if ($isEditable)?> <td><a href=<?php echo site_url().'/ethnicities/ethnicity_edit/'.$eth[$i]->id; ?> ><div class='small_btn yellow_bg'>Edit</div></a></td>
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