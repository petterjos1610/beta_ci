<div id="wrapper">
	<div class="heading_bar rc darkgreen">
		<h1>View Service Providers</h1>
	</div>
		<div id="content" class="rc border_green">
			<!----
            <form id="search_form" method="POST" action="" name="search_form">
                <div class="right" style="margin:0px; padding:0px;">
                    <select class="text_area select_img" name="orderby" onChange='submit_form();' style="margin:0px; padding:0px; padding-left:10px;">

                        <option value="name_asc" <?php if (isset($_GET['orderby']) && $_GET['orderby'] == "name_asc") echo " SELECTED"; ?>>Name ASC</option>
                        <option value="name_desc" <?php if (isset($_GET['orderby']) && $_GET['orderby'] == "name_desc") echo " SELECTED"; ?>>Name DESC</option>


                    </select>
                </div>
            </form>
            ---->
<?php
if (isset($_GET['orderby']) && $_GET['orderby']== "name_asc"){
	$orderBy='ORDER BY name ASC';
}
if (isset($_GET['orderby']) && $_GET['orderby']== "name_desc"){
	$orderBy='ORDER BY name DESC';
}

//$service= new ServiceProvider;
//$number=$service->nuOfServiceProviders();
if (isset($_REQUEST['page'])) $page = $_REQUEST['page'];
else $page = 1;

$noOfElementsToShow = 10;
//$total_pages = ceil($number / $noOfElementsToShow);
$start_from = ($page-1) * $noOfElementsToShow;
	
	//$mysqli = $dbconnect->mysqli;
	//if (in_array(Page::$srv[1],$this->client->privileges))

		echo "<div class='col_fullwidth' style='margin-bottom:20px; text-align:right;'><a href='?p=".md5(Page::$srv[1])."'><input type='button' class='btn darkgreen right rc' value='Add'></a></div>";
	//$stmt = viewServiceProvider();//0,$orderBy,$limit);

	//if (in_array(Page::$srv[2],$_SESSION['privileges'])) $isEditable = true;
	//else if (in_array(Page::$srv[0],$_SESSION['privileges'])) { $isEditable = false; $isViewable = true; }
	//else { 
		$isEditable = false; $isViewable = false; 
	//}
	echo "<div id='splist' class='trans_table  text_area rc'><table class='datatable'><tr class='header'><th class='font_green' style='width:900px; text-align:left;'>Service Provider</th>";
	if ($isEditable) echo "<th></th></tr>";
	//while ($serviceproviders = mysqli_fetch_array($stmt)) {
	foreach ($serviceproviders as $serviceprovider) {
		echo "<tr style='height:20px'><td style='text-align:left; width:900px;'>".$serviceprovider->name.'</td>';
		//if ($isEditable)
			echo "<td><a href='". base_url() . "index.php/serviceproviders/view/".md5(Page::$srv[2])."/".$serviceprovider->id."'><div class='small_btn darkblue'>Edit</div></a></td>";
		//else if ($isViewable) echo "<td><a href='?p=".md5(Page::$srv[1])."&id=".$serviceprovider->id."'><div class='small_btn darkblue'>View</div></a></td>";
		echo "</tr>";
	}
	//}
	echo "</table></div>";
	?>
	</div>
	</div>
</div>
<script>
    function submit_form() {
        $('#search_form').submit();
    }

   	jQuery(document).ready(function($){	
        $('#search_form').submit(function(event){
            location.href = '?p=<?php  echo md5(Page::$srv[0]); ?>&'+$(this).serialize();
            event.preventDefault();
        });
        colour_rows("#splist", "green");
    });
</script>