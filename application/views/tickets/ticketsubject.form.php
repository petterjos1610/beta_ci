<?php echo $this->session->flashdata('msg');
//echo validation_errors();


?>
<div id="wrapper">

	<div class="heading_bar rc darkgrey">
		<h1>Ticket Topics</h1>
	</div>
	<div id="content" class="rc">
	
		<div class="inner_col rc">
			
			<form method="post" action="<?php  if (isset($ticketSubject)) echo site_url().'/tickets/ticket_subject_edit_action/'.$ticketSubject->id;else echo site_url().'/tickets/ticket_subject_create_action/' ?>" name="form" onSubmit="return validate()">
			
			<div class="frmrow">
				<span class="form_label label_inline">
				Subject:
				</span>
				<span class="frmfield input_inline">
				<textarea class="text_area" name="subject" rows="5"><?php if (isset($ticketSubject)) echo $ticketSubject->subject;  ?></textarea>
				</span>
			</div>
			
			<div class="frmrow">
				<span class="form_label label_inline">
				Assign to UserType:
				</span>
				<div class="frmfield input_inline">
				<select class="text_area select_img" name="userTypeId">
				<?php

				?>
                <?php foreach($userTypes as $userType){?>
                    <option value="<?php echo $userType->id?>" <?php if (isset($ticketSubject) && $userType->id == $ticketSubject->userTypeId){ echo " SELECTED";}?> ><?php echo $userType->name;?></option>
                <?php }?>
				</select>
				</div>
			</div>
			
			<div class="frmrow">
				<span class="form_label label_inline">
				Enabled:
				</span>
				<span class="frmfield">
				<input id="cb1" class="css-checkbox" type="checkbox" name="enabled" value="1"<?php if (isset($ticketSubject) && $ticketSubject->enabled==1) echo " CHECKED";?>>
				<label for="cb1" class="css-label input_inline"></label></span>
				</span>
			</div>
			
		</div>
				
		<div class="frmrow right">
		<input type="submit" class="btn darkgreen right" style="width:200px" value="<?php if (isset($ticketSubject)) echo 'Save'; else echo 'Create'; ?>">
		</form>
		</div>
	</div>
</div>
<script>
	jQuery(document).ready(function($){	
		setup_forms();
	});
</script>