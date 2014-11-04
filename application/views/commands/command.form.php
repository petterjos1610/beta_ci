<?php echo $this->session->flashdata('msg');?>
<div id="wrapper">
	<div class="heading_bar rc darkgrey">
		<h1><?php if (isset($cmd)) echo "Edit"; else echo "Create"; ?> Command</h1>
	</div>
	<div id="content" class="rc">
		<div class="inner_col rc">
				<form method="post" action="<?php  if (isset($cmd)) echo site_url().'/commands/command_subject_edit_action/'.$cmd->id;else echo site_url().'/commands/command_subject_create_action/' ?>" name="form" onSubmit="return validate()">
			<input type="hidden" name="function" value="<?php if (isset($cmd)) echo 'editCommand'; else echo 'createCommand'; ?>">
			
			<div class="frmrow">
				<span class="frmlabel">
				Command Code:
				</span><span class="frmfield">
				<input class="text_area input_inline" type="text" name="command" value="<?php if (isset($cmd)) echo $cmd->command; else if (isset($_POST['command'])) echo $_POST['command']; ?>">
				</span>
			</div>
			<div class="frmrow">
				<span class="frmlabel">
				Command Description:
				</span><span class="frmfield">
				<input class="text_area input_inline" type="text" name="outputString" value="<?php if (isset($cmd)) echo $cmd->outputString; else if (isset($_POST['outputString'])) echo $_POST['outputString']; ?>">
				</span>
			</div>
			<div class="frmrow">
				<span class="frmlabel">&nbsp;
				</span><span class="frmfield">
				<input id="enabled" class="css-checkbox" type="checkbox" name="enabled" value="1"<?php if ((isset($cmd) && !$cmd->enabled)) echo ""; else if (isset($_POST['enabled'])) echo " CHECKED"; else echo " CHECKED"; ?>>
				<label for="enabled" class="css-label">Enabled</label>
				</span>
			</div>
		</div>
		<div class="frmrow right">
		<input type="submit" class="btn grey_bg right" value="<?php if (isset($cmd)) echo 'Save'; else echo 'Create'; ?>">
		</div>
		</form>
	</div>
</div>