<?php date_default_timezone_set("UTC"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html dir="ltr" lang="en">
<head>
	<title><?php if (isset($title)) echo $title; else echo "Welcome to EduKit"; ?></title>
	<meta http-equiv="Content-Type" content="text-html; charset=UTF-8" />
	<meta name="description" content=""/>
	<meta NAME="keywords" content="" />
	<meta property="og:image" content="" />
	<link rel="shortcut icon" href="" />
	<link rel="image_src" href="" />
	<?php if ($_SERVER['SERVER_NAME'] == "test.edukit.org.uk") { ?>
	<link rel="icon" href="<?php echo base_url(); ?>imgs/test_favicon.png" type="image/x-icon" />
	<?php } else if ($_SERVER['SERVER_NAME'] == "dev.edukit.org.uk") { ?>
	<link rel="icon" href="<?php echo base_url(); ?>imgs/dev_favicon.png" type="image/x-icon" />
	<?php } else { ?>
	<link rel="icon" href="http://www.edukit.org.uk/wp-content/uploads/2014/07/favicon.png" type="image/x-icon" />
	<?php } ?>
	<link href="<?php echo base_url(); ?>css/page.elements.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>css/common.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>css/jquery.dataTables.css" rel="stylesheet" type="text/css">

	<!---// External Stylesheets //---->
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

	<script src="<?php echo base_url(); ?>js/common.js" type="text/javascript" charset="utf-8"></script>
	<script src="<?php echo base_url(); ?>js/form.validate.js" type="text/javascript" charset="utf-8"></script>
	<script src="<?php echo base_url(); ?>js/jquery-1.11.1.min.js" type="text/javascript" charset="utf-8"></script>
	
	
	<!---// External JS //---->

</head>
<body>
	<div class="container">