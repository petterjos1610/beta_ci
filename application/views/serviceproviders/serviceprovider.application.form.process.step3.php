<?php
session_start();
include "../../classes/dbconnect.class.php";
include "../../classes.project.php";
//print_r($_POST);
date_default_timezone_set ( 'UTC' );

if ($_POST['orgOpt'] == "company") {
	$companyNo = $_POST['number'];
	$charityNo = "";
} else {
	$charityNo = $_POST['number'];
	$companyNo = "";
}
$name = $_POST['name'];
$founded = new DateTime($_POST['regdate']);
$contact = $_POST['contact'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$postcode = $_POST['postcode'];
$website = $_POST['website'];
$accEmail = $_POST['userEmail'];
$accFname = $_POST['userFname'];
$accLname = $_POST['userLname'];
$safeguard = $_POST['safeguard'];
$referee = $_POST['referee'];
$insurance = $_POST['insurance'];
$honesty = $_POST['honesty'];
if ($safeguard && $referee && $insurance && $honesty) $enabled = 1;
else $enabled = 0;
$contact = explode(" ",$contact);
$fname = "";
//print_r($contact);
for ($i=0; $i<sizeof($contact)-1; $i++) {
	$fname .= $contact[$i].' ';
}
$lname = end($contact);
if ($fname == "") $fname = end($contact);
//echo 'fname '.$fname.' lname'.$lname;
if ($fname == "") $fname = $accFname;
if ($lname == "") $lname = $accLname;
$dbconnect = new DBConnect();

$sp = new ServiceProvider();
$sp->create($name,$fname,$lname,$accEmail,0,$phone,"",$founded->format("Y-m-d"),$charityNo,$companyNo,$website,$safeguard,"");
//print_r($sp);

$user = new User();
$user->create(4,$accEmail,0,"","",$accFname,$accLname,$enabled);

$spstaff = new SPStaff();
$spstaff->create($sp->getId(),$user->getId(),$accFname.' '.$accLname,$enabled);

//print_r($user);
mysqli_query($dbconnect->mysqli,"COMMIT");

$privileges[] = $user->getPrivileges();
for ($i=0; $i<sizeof($privileges[0]); $i++) {
	$_SESSION['privileges'][] = $privileges[0][$i]->getCommand()->getCommand();
}
if ($user->isEnabled()) {
	$_SESSION['user'] = serialize($user);
	$_SESSION['type'] = serialize($user->getUserType());
	if ((unserialize($_SESSION['type'])->getName() == "Service Provider Manager" || unserialize($_SESSION['type'])->getName() == "Service Provider Administrator" || unserialize($_SESSION['type'])->getName() == "Service Provider Staff") && $user->getSPStaff() != null) {
		$_SESSION['role'] = serialize($user->getSPStaff());
		if (sizeof($user->getSpStaff()->getServiceProvider()->getSpStaff()) == 1) {
			/*
			$logs = $user->getUserLogs();
			$first = true;
			if ($logs != null) {
				$no = 0;
				for ($i=0; $i<sizeof($logs); $i++)
					if ($logs[$i]->getCommand()->getCommand() == "USR_LOGIN") $no++;
			}
			if ($no > 1) $first = false;
			if ($first) {
				*/
				include "../../classes/page.class.php";
				$_REQUEST['p'] = md5(Page::$srv[2]);
			//}
		}
	} else if ((unserialize($_SESSION['type'])->getName() == "School Administrator" || unserialize($_SESSION['type'])->getName() == "School Manager" || unserialize($_SESSION['type'])->getName() == "Teacher") && $user->getSchoolStaff() != null && ($user->getSchoolStaff()->getSchool()->getSchoolNetwork() == "" || $_SERVER['REMOTE_ADDR'] == $user->getSchoolStaff()->getSchool()->getSchoolNetwork())) {
		$_SESSION['role'] = serialize($user->getSchoolStaff());
	} else if (unserialize($_SESSION['type'])->getName() == "Student") {
		$_SESSION['role'] = serialize($user->getStudent());
	} else if (unserialize($_SESSION['type'])->getName() == "Edukit Administrator" || unserialize($_SESSION['type'])->getName() == "Edukit Staff" || unserialize($_SESSION['type'])->getName() == "Edukit Staff Service Provider" || unserialize($_SESSION['type'])->getName() == "Edukit Staff Schools" || unserialize($_SESSION['type'])->getName() == "Guest Account") {
		// Edukit Admin/Staff
	} else unset($_SESSION['privileges'],$_SESSION['user'],$_SESSION['role']);
	//print_r($_POST);
	$userlog = new UserLog();
} else unset($_SESSION['privileges'],$_SESSION['user'],$_SESSION['role']);

mysqli_query($dbconnect->mysqli,"COMMIT");

if ($enabled && isset($_REQUEST['p'])) {
	// Eligible 
	//print_r(unserialize($_SESSION['user']));
	?>

	<div class="heading_bar rc darkgreen">
		<h2>Congratulations! Welcome to Edukit</h2>
	</div>
	<div class="col_fullwidth">
		Your application has been successful and you are now a part of the Edukit Family. We are happy to have you on board and look forward to helping you engage more students with your programmes.<br><br>
		Please check the following email address <h1 class="font_darkblue" style="display:inline;"><?php echo $accEmail; ?></h1> for a confirmation email with your password so that you can log in.<br><br>
		But no need to wait, just click the "Next" button below to start inputting your programme information onto Edukit.<br><br>
		Thank you,<br>
		Edukit Team.
		<a href="<?php //echo "http://".$_SERVER['SERVER_NAME']; ?>?p=<?php echo $_REQUEST['p']; ?>"><input type="button" class="btn darkgreen right" value="Next" onClick="window.location.href = '<?php //echo "http://".$_SERVER['SERVER_NAME']; ?>?p=<?php echo $_REQUEST['p']; ?>';"></a>
	</div>

<?php } else {
	// Ineligible ?>

	<div class="heading_bar rc darkgreen">
		<h2>Oh no!</h2>
	</div>
	<div class="col_fullwidth">
		Unfortunately you do not meet 1 or more of the criteria to get onto the Edukit platform. But do not despair, one of our team will be in touch to guide you with your application to help you meet our requirements as we want to help all Service Providers and get all of you on our site.<br><br>
		We thank you for taking the time to complete our application and we hope to help you and look forward to you using our platform soon.<br><br>
		Thankyou, Edukit Team.
		<a href="http://www.edukit.org.uk"><input type="button" class="btn darkgreen right" value="Finished" onClick="window.location.href = 'http://www.edukit.org.uk';"></a>
	</div>
<?php }  ?>