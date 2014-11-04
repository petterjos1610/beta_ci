<?php
switch ($this->uri->segment(3)) {
	case md5(Page::$cmd[0]):
	case md5(Page::$cmd[1]):
	case md5(Page::$cmd[2]):
	case md5(Page::$prv[0]):
	case md5(Page::$prv[1]):
	case md5(Page::$tkt[0]):
	case md5(Page::$tkt[1]):
	case md5(Page::$tkt[2]):
	case md5(Page::$slc[0]):
	case md5(Page::$slc[1]):
	case md5(Page::$slc[2]):
	case md5(Page::$stp[0]):
	case md5(Page::$stp[1]):
	case md5(Page::$stp[2]):
	case md5(Page::$elt[0]):
	case md5(Page::$elt[1]):
	case md5(Page::$elt[2]):
	case md5(Page::$eth[0]):
	case md5(Page::$eth[1]):
	case md5(Page::$eth[2]):
	case md5(Page::$sjt[0]):
	case md5(Page::$sjt[1]):
	case md5(Page::$sjt[2]):
	case md5(Page::$pit[0]):
	case md5(Page::$pit[1]):
	case md5(Page::$pit[2]):
	case md5(Page::$crr[0]):
	case md5(Page::$crr[1]):
	case md5(Page::$crr[2]):
	case md5(Page::$cbt[0]):
	case md5(Page::$cbt[1]):
	case md5(Page::$cbt[2]):
	case md5(Page::$rel[0]):
	case md5(Page::$rel[1]):
	case md5(Page::$rel[2]):
	case md5(Page::$ads[0]):
	case md5(Page::$ads[1]):
	case md5(Page::$ads[2]):
	case md5(Page::$ads[3]):
	$colour = "grey";
	break;
	case md5(Page::$usr[0]):
	case md5(Page::$usr[1]):
	case md5(Page::$usr[2]):
	case md5(Page::$usr[3]):
	case md5(Page::$usr[4]):
	case md5(Page::$usr[5]):
	case md5(Page::$tkt[3]):
	case md5(Page::$tkt[4]):
	case md5(Page::$tkt[5]):
	case md5(Page::$tkt[6]):
	case md5(Page::$tkt[7]):
	case md5(Page::$tkt[8]):
	case md5(Page::$ulg[0]):
	case md5(Page::$faq[0]):
	$colour = "red";
	break;
	case md5(Page::$srv[0]):
	case md5(Page::$srv[1]):
	case md5(Page::$srv[2]):
	case md5(Page::$srv[3]):
	case md5(Page::$prg[0]):
	case md5(Page::$prg[1]):
	case md5(Page::$prg[2]):
	case md5(Page::$prg[3]):
	case md5(Page::$prg[4]):
	case md5(Page::$prg[5]):
	case md5(Page::$crs[0]):
	case md5(Page::$crs[1]):
	case md5(Page::$crs[2]):
	case md5(Page::$crs[3]):
	case md5(Page::$srv[4]):
	case md5(Page::$prg[6]):
	$colour = "green";
	break;
	case md5(Page::$sch[0]):
	case md5(Page::$sch[1]):
	case md5(Page::$sch[2]):
	case md5(Page::$stf[0]):
	case md5(Page::$stf[1]):
	case md5(Page::$stf[2]):
	case md5(Page::$stu[0]):
	case md5(Page::$stu[1]):
	case md5(Page::$stu[2]):
	case md5(Page::$ass[0]):
	case md5(Page::$ass[1]):
	case md5(Page::$enr[0]):
	case md5(Page::$enr[1]):
	case md5(Page::$enr[2]):
	case md5(Page::$rat[0]):
	case md5(Page::$rat[1]):
	case md5(Page::$rat[2]):
	case md5(Page::$rep[0]):
	case md5(Page::$rep[1]):
	case md5(Page::$rep[2]):
	case md5(Page::$rep[3]):
	case md5(Page::$rep[4]):
	case md5(Page::$rep[5]):
	case md5(Page::$mat[0]):
	case md5(Page::$mat[1]):
	case md5(Page::$mat[2]):
	case md5(Page::$mat[3]):
	$colour = "orange";
	break;
	default:
	$colour = "blue";
}
?>
<header>
	<div class="wrapper">
		<div class="logo"><a href="#" title="Edukit"><img src="<?php echo base_url(); ?>imgs/edukit_logo_<?php if ($_SERVER['SERVER_NAME'] == "test.edukit.org.uk") echo "test"; else if ($_SERVER['SERVER_NAME'] == "dev.edukit.org.uk") echo "dev"; else echo "trans"; ?>.png" alt="logo"></a></div>
		<div class="right-menuBar">
			<?php if ($this->session->userdata('user')) { ?>
			<ul>
				<li><a href="#">Hello, <?php echo $this->client->getFname().' '.$this->client->getLname(); ?> &nbsp;<i class="fa fa-chevron-down"></i></a>
					<ul>
						<li><a href="<?php echo base_url(); ?>index.php/myaccount/view/<?php echo $this->client->getId(); ?>" style="width: 179px;">My Account</a></li>
						<li><a href="<?php echo base_url(); ?>index.php/myaccount/logout" style="width: 179px;">Logout</a></li>
					</ul>
				</li>
			</ul>
		</div>
		<?php } ?>
		<div class="menuBar">
		<div class="clearfix"></div>
			<?php if ($this->session->userdata('user') && sizeof($this->client->getPrivileges()) > 0) { ?>
			<ul>
			<div class="clearfix"></div>
				<li><a href="<?php echo base_url(); ?>index.php/" class="menu_blue <?php if ($colour == "blue") echo "current_tab"; ?>"><span><i class="fa fa-home"></i></span>DashBoard</a></li>
				<?php if ((in_array(Page::$sch[0],$this->client->getPrivileges()) || in_array(Page::$sch[1],$this->client->getPrivileges()) || in_array(Page::$stf[0],$this->client->getPrivileges()) || in_array(Page::$stu[0],$this->client->getPrivileges()) || in_array(Page::$stu[1],$this->client->getPrivileges()))) { ?>
					<li><a class="menu_orange <?php if ($colour == "orange") echo "current_tab"; ?>" style="cursor:pointer;"><span><i class="fa fa-book"></i></span>Schools</a>
						<ul class="orange-ul">
							<?php if (in_array(Page::$sch[0],$this->client->getPrivileges()) && $this->client->getUserType() != "Teacher") { ?>
								<li>
									<a href="<?php echo base_url(); ?>index.php/schools/view/<?php if ($this->client->getUserType() == "Edukit Administrator" || $this->client->getUserType() == "Edukit Staff") echo md5(Page::$sch[0]); else if ($this->client->getUserType() == "Teacher") echo md5(Page::$sch[2])."/".unserialize($_SESSION['role'])->getSchoolId(); else echo md5(Page::$sch[2])."&id=".unserialize($_SESSION['role'])->getSchoolId(); ?>">School <?php if ($this->client->getUserType() == "Edukit Administrator" || $this->client->getUserType() == "Edukit Staff") echo "Listings"; else echo "Information"; ?></a>
								</li>
							<?php } ?>
							<?php if (in_array(Page::$sch[1],$this->client->getPrivileges()) && $this->client->getUserType() == "Edukit Administrator" || $this->client->getUserType() == "Edukit Staff") { ?>
								<li><a href="<?php echo base_url(); ?>index.php/schools/create/<?php echo md5(Page::$sch[1]); ?>">Create School</a></li>
							<?php } ?>
							<?php if (in_array(Page::$stf[0],$this->client->getPrivileges())) { ?>
								<li><a href="<?php echo base_url(); ?>index.php/schoolstaff/view/<?php echo md5(Page::$stf[0]); ?>">Staff</a></li>
							<?php } ?>
							<?php if (in_array(Page::$stu[0],$this->client->getPrivileges())) { ?>
								<li><a href="<?php echo base_url(); ?>index.php/students/view/<?php echo md5(Page::$stu[0]); ?>">Students</a></li>
							<?php } ?>
							<?php if (in_array(Page::$stu[1],$this->client->getPrivileges()) && $this->client->getUserType() != "Teacher") { ?>
								<li><a href="<?php echo base_url(); ?>index.php/students/create/<?php echo md5(Page::$stu[1]); ?>">Create Student</a></li>
							<?php } ?>
						</ul>
					</li>
				<?php }
					//echo Page::$srv[0]."<br><pre>"; print_r($this->client->getPrivileges()); echo "</pre>";
					if (in_array(Page::$srv[0],$this->client->getPrivileges()) || in_array(Page::$srv[1],$this->client->getPrivileges()) || in_array(Page::$prg[0],$this->client->getPrivileges()) || in_array(Page::$prg[1],$this->client->getPrivileges()) || in_array(Page::$crs[0],$this->client->getPrivileges()) || in_array(Page::$crs[1],$this->client->getPrivileges())) { ?>
					<li><a class="menu_green <?php if ($colour == "green") echo "current_tab"; ?>" style="cursor:pointer;"><span><i class="fa fa-th-large"></i></span><?php if (!isset($_SESSION['role'])) echo "Service Provider"; else echo "My Organisation"; ?></a>
						<ul class="green-ul">
							<?php if (in_array(Page::$srv[0],$this->client->getPrivileges()) && $this->client->getUserType() == "Edukit Administrator" || $this->client->getUserType() == "Edukit Staff") { ?>
								<li><a href="<?php echo base_url(); ?>index.php/serviceproviders/view/<?php echo md5(Page::$srv[0]); ?>">Service Provider Listings</a></li>
							<?php } ?>
							<?php if (in_array(Page::$srv[1],$this->client->getPrivileges()) || (isset($_SESSION['role']))) { ?>
								<li><a href="<?php echo base_url(); ?>index.php/serviceproviders/<?php if (isset($_SESSION['role'])) echo "view/".md5(Page::$srv[2])."/".unserialize($_SESSION['role'])->getSpId(); else echo "create/".md5(Page::$srv[1]); ?>"><?php if (isset($_SESSION['role'])) echo "View Information"; else echo "Create Service Provider"; ?></a></li>
							<?php } ?>
							<?php if (!isset($_SESSION['role']) || (isset($_SESSION['role']) && $this->client->getUserType() == "Service Provider Administrator")) { ?>
								<li><a href="<?php echo base_url(); ?>index.php/spstaff/create/<?php echo md5(Page::$srv[4]); ?>">Add Staff</a></li>
							<?php } ?>
							<?php if (in_array(Page::$prg[0],$this->client->getPrivileges())) { ?>
								<li><a href="<?php echo base_url(); ?>index.php/programmes/view/<?php echo md5(Page::$prg[0]); ?>"><?php if (isset($_SESSION['role'])) echo "My Programmes"; else echo "Programme Listings"; ?></a></li>
							<?php } ?>
							<?php if (in_array(Page::$prg[1],$this->client->getPrivileges())) { ?>
								<li><a href="<?php echo base_url(); ?>index.php/programmes/create/<?php echo md5(Page::$prg[1]); ?>">Create Programme</a></li>
							<?php } ?>
							<?php if (in_array(Page::$crs[0],$this->client->getPrivileges())) { ?>
								<li><a href="<?php echo base_url(); ?>index.php/courses/view/<?php echo md5(Page::$crs[0]); ?>"><?php if (isset($_SESSION['role'])) echo "My Courses"; else echo "Courses"; ?></a></li>
							<?php } ?>
							<?php if (in_array(Page::$crs[1],$this->client->getPrivileges())) { ?>
								<li><a href="<?php echo base_url(); ?>index.php/courses/create/<?php echo md5(Page::$crs[1]); ?>">Create Course</a></li>
							<?php } ?>
						</ul>
					</li>
				<?php }
					if (in_array(Page::$usr[0],$this->client->getPrivileges()) || in_array(Page::$usr[4],$this->client->getPrivileges()) || in_array(Page::$ulg[0],$this->client->getPrivileges()) || in_array(Page::$tkt[3],$this->client->getPrivileges())) { ?>
					<li><a class="menu_red <?php if ($colour == "red") echo "current_tab"; ?>" style="cursor:pointer;"><span><i class="fa fa-tasks"></i></span><?php if (!isset($_SESSION['role'])) { ?>Users<?php } else { ?>Support<?php } ?></a>
						<ul class="red-ul">
							<?php if (in_array(Page::$usr[3],$this->client->getPrivileges())) { ?><li><a href="<?php echo base_url(); ?>index.php/users/view/<?php echo md5(Page::$usr[3]); ?>">Users</a></li><?php } ?>
							<?php if (in_array(Page::$tkt[3],$this->client->getPrivileges())) { ?><li><a href="<?php echo base_url(); ?>index.php/tickets/view/<?php echo md5(Page::$tkt[3]); ?>">My Tickets</a></li><?php } ?>
							<?php if (in_array(Page::$usr[0],$this->client->getPrivileges()) && ($this->client->getUserType() == "Edukit Administrator" || $this->client->getUserType() == "Edukit Staff")) { ?><li><a href="<?php echo base_url(); ?>index.php/usertypes/view/<?php echo md5(Page::$usr[0]); ?>">User Groups</a></li><?php } ?>
							<?php if (in_array(Page::$ulg[0],$this->client->getPrivileges()) && ($this->client->getUserType() == "Edukit Administrator" || $this->client->getUserType() == "Edukit Staff")) { ?><li><a href="<?php echo base_url(); ?>index.php/userlogs/view/<?php echo md5(Page::$ulg[0]); ?>">User Logs</a></li><?php } ?>
							<?php if (isset($_SESSION['role'])) { ?>
								<!----<li><a href="#">Contact</a></li>
								<li><a href="?p=<?php echo md5(Page::$faq[0]); ?>">FAQs</a></li>---->
							<?php } ?>
						</ul>
					</li>
				<?php }
					if (in_array(Page::$slc[0],$this->client->getPrivileges()) || in_array(Page::$stp[0],$this->client->getPrivileges()) || in_array(Page::$elt[0],$this->client->getPrivileges()) || in_array(Page::$eth[0],$this->client->getPrivileges()) || in_array(Page::$itt[0],$this->client->getPrivileges()) || in_array(Page::$sjt[0],$this->client->getPrivileges()) || in_array(Page::$pit[0],$this->client->getPrivileges()) || in_array(Page::$pit[2],$this->client->getPrivileges()) || in_array(Page::$crr[0],$this->client->getPrivileges()) || in_array(Page::$cbt[0],$this->client->getPrivileges()) || in_array(Page::$cbt[2],$this->client->getPrivileges()) || in_array(Page::$cmd[0],$this->client->getPrivileges()) || in_array(Page::$tkt[0],$this->client->getPrivileges()) && ($this->client->getUserType() == "Edukit Administrator" || $this->client->getUserType() == "Edukit Staff")) { ?>
					<li><a class="menu_grey <?php if ($colour == "grey") echo "current_tab"; ?>" style="cursor:pointer;"><span><i class="fa fa-cog"></i></span>Type Setting</a>
						<ul class="grey-ul">
							<?php if (in_array(Page::$tkt[0],$this->client->getPrivileges())) { ?><li><a href="<?php echo base_url(); ?>index.php/tickets/ticket_subject<?php //echo md5(Page::$tkt[0]); ?>">Ticket Topics</a></li><?php } ?>
							<?php  ?><li><a href="<?php echo base_url(); ?>index.php/commands/command_subject<?php /// echo md5(Page::$cmd[0]); ?>">Commands</a></li><?php ?>
							<?php if (in_array(Page::$slc[0],$this->client->getPrivileges())) { ?><li><a href="<?php echo base_url(); ?>index.php/sessionlocations/view/<?php echo md5(Page::$slc[0]); ?>">Session Locations</a></li><?php } ?>
								<?php if (in_array(Page::$stp[0],$this->client->getPrivileges())) { ?><li><a href="<?php echo base_url(); ?>index.php/studenttypes/<?php // echo md5(Page::$stp[0]); ?>">Student Types</a></li><?php } ?>
									<?php if (in_array(Page::$eth[0],$this->client->getPrivileges())) { ?><li><a href="<?php echo base_url(); ?>index.php/ethnicities/<?php //echo md5(Page::$eth[0]); ?>">Ethnicities</a></li><?php } ?>
							<?php if (in_array(Page::$sjt[0],$this->client->getPrivileges())) { ?><li><a href="<?php echo base_url(); ?>index.php/subjects/view/<?php echo md5(Page::$sjt[0]); ?>">Subjects</a></li><?php } ?>
							<?php if (in_array(Page::$pit[0],$this->client->getPrivileges())) { ?><li><a href="<?php echo base_url(); ?>index.php/issues/view/<?php echo md5(Page::$pit[0]); ?>">Phase/Issue Types</a></li><?php } ?>
							<?php if (in_array(Page::$crr[0],$this->client->getPrivileges())) { ?><li><a href="<?php echo base_url(); ?>index.php/careers/<?php //echo md5(Page::$crr[0]); ?>">Career Types</a></li><?php } ?>
							<?php if (in_array(Page::$cbt[0],$this->client->getPrivileges())) { ?><li><a href="<?php echo base_url(); ?>index.php/cities/view/<?php echo md5(Page::$cbt[0]); ?>">Cities/Boroughs</a></li><?php } ?>
									<li><a href="<?php echo base_url(); ?>index.php/religions/<?php //echo md5(Page::$rel[0]); ?>">Religions</a></li>
							<?php //if (in_array(Page::$cbt[0],$this->client->getPrivileges())) { ?><li><a href="<?php echo base_url(); ?>index.php/campaigns/view/<?php echo md5(Page::$ads[0]); ?>">Ad Campaigns</a></li><?php// } ?>
						</ul>
					</li>
				<?php } ?>
			</ul>
			<?php } ?>
		</div>
	</div>
</header>
<header class="border <?php if (isset($colour)) echo $colour; else echo "blue"; ?>"></header>