<?php
function errorMessage($title,$message) { 
	if ($title == "") $title = "Whoops! It seems there was a problem"; 
	if ($message == "") $message = "We seem to have an error processing your application. Please try again and if the problem persists please contact a member of our team for help."; ?>
	<div class="heading_bar rc darkgreen">
		<h2><?php echo ucFirst($title); ?></h2>
	</div>
	<div class="col_fullwidth"><?php echo nl2br(ucFirst($message)); ?></div>
	<div class="col_fullwidth">
		<input type="button" class="btn red right"value="Let's try again" onClick="form.number.value=''; showNumber()">
	</div>
	<script>
		$( '#confirm' ).animate({ "height": "170px" }, 500);
	</script>
<?php }

/*
$add = true;
if (isset($_POST['number'])) {
	$sps = new ServiceProvider();
	$sps = $sps->getServiceProviders();
	for ($i=0; $i<sizeof($sps); $i++)
		if ($sps[$i]->getCharityNo() == $_POST['number'] || $sps[$i]->getCompanyNo() == $_POST['number']) $add = false;
}
*/

if (isset($_POST['number']) && $_POST['orgOpt'] == "charity") {

	function getMonthInt($month) {
		switch (strtolower($month)) {
			case 'january':
			case 'jan':
				return $month = 1;
				break;
			case 'february':
			case 'feb':
				return $month = 2;
				break;
			case 'march':
			case 'mar':
				return $month = 3;
				break;
			case 'april':
			case 'apr':
				return $month = 4;
				break;
			case 'may':
				return $month = 5;
				break;
			case 'june':
			case 'jun':
				return $month = 6;
				break;
			case 'july':
			case 'jul':
				return $month = 7;
				break;
			case 'august':
			case 'aug':
				return $month = 8;
				break;
			case 'september':
			case 'sept':
			case 'sep':
				return $month = 9;
				break;
			case 'october':
			case 'oct':
				return $month = 10;
				break;
			case 'november':
			case 'nov':
				return $month = 11;
				break;
			case 'december':
			case 'dec':
				return $month = 12;
		}
	}

	$curl_conn = curl_init("apps.charitycommission.gov.uk/Showcharity/RegisterOfCharities/CharityFramework.aspx?RegisteredCharityNumber=".$_POST['number']."&SubsidiaryNumber=0");
	$curl_conn1 = curl_init("http://apps.charitycommission.gov.uk/Showcharity/RegisterOfCharities/ContactAndTrustees.aspx?RegisteredCharityNumber=".$_POST['number']."&SubsidiaryNumber=0");

	$browser = $_SERVER['HTTP_USER_AGENT'];

	curl_setopt($curl_conn, CURLOPT_CONNECTTIMEOUT, 30);
	curl_setopt($curl_conn, CURLOPT_USERAGENT, $browser);
	curl_setopt($curl_conn, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl_conn, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl_conn, CURLOPT_FOLLOWLOCATION, 1);

	curl_setopt($curl_conn1, CURLOPT_CONNECTTIMEOUT, 30);
	curl_setopt($curl_conn1, CURLOPT_USERAGENT, $browser);
	curl_setopt($curl_conn1, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl_conn1, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl_conn1, CURLOPT_FOLLOWLOCATION, 1);

	$charity = curl_exec($curl_conn);
	$contact = curl_exec($curl_conn1);

	//print_r(curl_getinfo($curl_conn));

	curl_close($curl_conn);
	curl_close($curl_conn1);

	if (strpos($charity, 'Charity framework') !== FALSE) {
		$otherName = 0;
		$regDate = 0;
		$regHist = 0;
		$charity = explode("\n",strip_tags($charity));
		for ($i=0; $i<sizeof($charity); $i++) {
			if (!preg_match("([a-zA-Z0-9])",$charity[$i])) {
				array_splice($charity,$i,1);
				$i--;
			} else {
				$charity[$i] = trim($charity[$i]);
				if (strpos($charity[$i],$_POST['number']) === 0) {
					array_splice($charity,0,$i);
					$i-=$i;
				}
				if (strpos($charity[$i],"Other names") === 0) $otherName = $i+1;
				if (strpos($charity[$i], "Governing document") === 0) { $regDate = $i+1;   }
				if (strpos($charity[$i], "Registration history") === 0) $regHist = $i+1;
			}
		}
		//print_r($charity);
		//echo "<br><br>regdate ".$regDate;
		preg_match("([a-zA-z0-9 _-]+)",trim(str_replace("-","",$charity[0])),$charity[0]);
		$charity[0] = $charity[0][0];

		$contact = explode("\n",strip_tags($contact));
		for ($i=0; $i<sizeof($contact); $i++) {
			if (!preg_match("([a-zA-Z0-9])",$contact[$i])) {
				array_splice($contact,$i,1);
				$i--;
			} else {
				$contact[$i] = trim($contact[$i]);
				if (strpos($contact[$i],"Contact") === 0) {
					array_splice($contact,0,$i);
					$i-=$i;
				}
				if (strpos($contact[$i],"Trustees") === 0) {
					array_splice($contact,$i,sizeof($contact)-$i);
					$i--;
				}
				if (strpos($contact[$i],"Tel:") === 0) $tel = $i;
				if (strpos($contact[$i],"Email:") === 0) $email = $i+1;
				if (strpos($contact[$i],"Website:") === 0) $web = $i+1;
			}
		}
		?>

	<div class="heading_bar rc darkgreen" id="header">
		<h2>Is this you?</h2>
	</div>
	<div class="col_half left">
		<div class="form_label">Company Name (Operating Name):</div>
		<input type="text" name="name" id="name" value="<?php echo trim($charity[1]); if (strtolower(trim($charity[$otherName])) != "none") {
			$names = explode(" ",$charity[$otherName]);
			for ($i=0; $i<sizeof($names); $i++) {
				$names[$i] = trim($names[$i]);
				if ($names[$i] == "") {
					array_splice($names,$i,1);
					$i--;
				}
			}
			$names = implode(" ",$names);
			echo " (".trim(str_replace("(Working Name)","",$names)).")";
			//echo " (".trim(str_replace("(Working Name)", "", $charity[$otherName])).")";
		} ?>" class="text_area" readonly>
	</div>
	<div class="col_half right">
		<div class="form_label">Registration Date: <?php //echo str_replace(array("SCHEME","OF","THE","RD","TH","ST"),"",$charity[$regDate]); $charity[$regDate]; ?></div>
		<input type="text" name="regdate" value="<?php $reg = explode(" ",str_replace(array("SCHEME","OF","THE","RD","TH","ST"),"",$charity[$regDate])); if (strpos(end($reg),"/") !== false) {
			$form = explode("/",end($reg));
			$date = new DateTime();
			$date->setDate($form[2],$form[1],$form[0]);
		} else {
			$date = new DateTime();
			$month = getMonthInt($reg[sizeof($reg)-2]);
			$year = $reg[sizeof($reg)-1];
			$date->setDate($year,$month,$reg[sizeof($reg)-3]);
		}
		$regHist = str_replace("Registered", "", $charity[$regHist]);
		$regHist = explode(" ",$regHist);
		$month = getMonthInt($regHist[1]);
		$date2 = new DateTime();
		$date2->setDate($regHist[2],$month,$regHist[0]);
		if ($date < $date2) echo $date->format("d M Y");
		else echo $date2->format("d M Y");
		?>" class="text_area" readonly>
	</div>
	<div class="col_half left">
		<div class="form_label">Contact Name:</div>
		<input type="text" name="contact" onInput="isNotEmpty(this);" value="<?php echo ucWords(strtolower($contact[1])); ?>" class="text_area" readonly>
	</div>
	<div class="clearfix"></div>
	<div class="col_half left">
		<div class="form_label">Contact Address:</div>
		<textarea class="text_area" rows="5" readonly onInput="isNotEmpty(this);" name="address"><?php for ($i=2; $i<$tel-1; $i++) {
			echo ucWords(strtolower($contact[$i]));
			if ($i<$tel-2) echo "\n";
		}?></textarea>
	</div>
	<div class="clearfix"></div>
	<div class="col_half left">
		<div class="form_label">Postcode:</div>
		<input class="text_area" type="text" name="postcode" onInput="isPostcode(this);" value="<?php echo $contact[$tel-1]; ?>" readonly>
	</div>
	<div class="col_half right">
		<div class="form_label">Website:</div>
		<input class="text_area" type="text" name="web" value="<?php if (isset($contact[$web])) echo $contact[$web]; ?>" readonly>
	</div>
	<div class="col_fullwidth" id="itsme">
		<input type="button" class="btn darkgreen right" value="Yes, that's me!" onClick="accountInfo();"><input type="button" class="btn red right"value="No, let's try again" onClick="showNumber(); form.number.value='';">
	</div>
	<script>
		$( '#confirm' ).animate({ "height": "560px" }, 500);
	</script>
	<?php } else errorMessage("Whoops! We didn't find you","Apologies, it seems that we were unable to locate your information. Would you like to try again?");
} else if (isset($_POST['number']) && $_POST['orgOpt'] == "company") {
	if (get_headers("http://data.companieshouse.gov.uk/doc/company/".$_POST['number'].".xml")[0] == "HTTP/1.1 200 OK") {
		$company = simplexml_load_file("http://data.companieshouse.gov.uk/doc/company/".$_POST['number'].".xml");
		$company = $company->primaryTopic; 
		if ($company->CompanyStatus == "Active") { ?>
			<div class="heading_bar rc darkgreen">
				<h2>Is this you?</h2>
			</div>
			<div class="col_half left">
				<div class="form_label">Company Name (Operating Name):</div>
				<input type="text" name="name" id="name" onInput="isNotEmpty(this);" value="<?php echo ucwords(strtolower(trim($company->CompanyName))); ?>" class="text_area" readonly>
			</div>
			<div class="col_half right">
				<div class="form_label">Registration Date:</div>
				<input type="text" name="regdate" id="regdate" value="<?php $reg = explode("-",$company->IncorporationDate);
					$date = new DateTime();
					$date->setDate($reg[0],$reg[1],$reg[2]);
					echo $date->format("d M Y");
				?>" class="text_area" readonly>
			</div>
			<div class="col_half left">
				<div class="form_label">Contact Name:</div>
				<input type="text" name="contact" id="contact" onInput="isNotEmpty(this);" value="<?php ?>" class="text_area" readonly>
			</div>
			<div class="clearfix"></div>
			<div class="col_half left">
				<div class="form_label">Contact Address:</div>
				<textarea class="text_area" rows="5" onInput="isNotEmpty(this);" readonly name="address" id="address"><?php echo ucwords(strtolower($company->RegAddress->AddressLine1));
					echo "\n";
					if (isset($company->RegAddress->AddressLine2)) {
						echo ucwords(strtolower($company->RegAddress->AddressLine2));
						echo "\n";
					}
					echo ucwords(strtolower($company->RegAddress->PostTown));
					echo "\n";
					if (isset($company->RegAddress->County)) {
						echo ucwords(strtolower($company->RegAddress->County));
						echo "\n";
					}
					echo ucwords(strtolower($company->RegAddress->Country));
				?></textarea>
			</div>
			<div class="clearfix"></div>
			<div class="col_half left">
				<div class="form_label">Postcode:</div>
				<input class="text_area" type="text" name="postcode" id="postcode" onInput="isPostcode(this);" value="<?php echo $company->RegAddress->Postcode; ?>" readonly>
			</div>
			<div class="col_half right">
				<div class="form_label">Website:</div>
				<input class="text_area" type="text" name="web" id="web" value="<?php  ?>" readonly>
			</div>
			<div class="col_fullwidth" id="itsme">
				<input type="button" class="btn darkgreen right" value="Yes, that's me" onClick="accountInfo();"><input type="button" class="btn red right"value="No, let's try again" onClick="showNumber(); form.number.value='';">
			</div>
			<script>
				$( '#confirm' ).animate({ "height": "560px" }, 500);
			</script>
		<?php } else errorMessage("Whoops! We didn't find you","Apologies, it seems that we were unable to locate your information. Would you like to try again?");
	} else errorMessage("Whoops! We didn't find you","Apologies, it seems that we were unable to locate your information. Would you like to try again?");
} else errorMessage("Whoops! We didn't find you","Apologies, it seems that we were unable to locate your information. Would you like to try again?") ?>
<div class="col_fullwidth" id="updateInfo" style="height:0px;">
	<input type="button" class="btn darkgreen right" value="Ok, I'm up to date" onClick="accountInfo();">
</div>
<div class="spacer30"></div>
<div id="userInfo" class="col_fullwidth" style="height:0px;">
	<div class="heading_bar rc darkgreen">
		<h2>Account Information <a onclick="infoPopup('Account Information','Please provide full details for your account, completing all mandatory fields marked with an asterix (<font class=\'font_red\'>*</font>).');"><i class="fa fa-info-circle font_white" style="cursor:pointer; font-size:19px; float:right; margin-top:2px;"></i></a></h2>
	</div>
	<div class="col_fullwidth">
		Please enter details of the person who will administer your EduKit account
	</div>
	<div class="spacer10"></div>
	<div class="col_half left">
		<div class="form_label">First name:</div>
		<input class="text_area" type="text" name="userFname" value="" onInput="isNotEmpty(this); accountCheck();">
	</div>
	<div class="col_half right">
		<div class="form_label">Surname:</div>
		<input class="text_area" type="text" name="userLname" value="" onInput="isNotEmpty(this); accountCheck();">
	</div>
	<div class="col_half left">
		<div class="form_label">Account Email:</div>
		<div class="col_fullwidth font_red" style="height:0px;" id="emailerror">This email address is already registered. Please try another.</div>
		<input class="text_area" type="text" name="userEmail" value="" onInput="$('#emailerror').animate({'height':'0px'},500); isNotEmpty(this); isEmail(this); accountCheck();">
	</div>
	<div class="col_half right">
		<div class="form_label">Confirm Email:</div>
		<input class="text_area" type="text" name="userEmailConfirm" value="" onInput="isNotEmpty(this); isEmail(this); accountCheck();">
	</div>
	<div class="col_half left">
		<div class="form_label">Telephone:</div>
		<input class="text_area" type="text" name="phone" onInput="isNotEmpty(this); isPhoneNo(this); accountCheck();" value="<?php if (isset($tel,$contact[$tel])) echo trim(str_replace("Tel:", "", $contact[$tel])); ?>">
	</div>
	<div class="clearfix"></div>
	<div class="col_fullwidth" style="height:0px;" id="nextbtn"><input type="button" class="btn darkgreen right" value="Next >" onClick="accountSubmit();"></div>
</div>