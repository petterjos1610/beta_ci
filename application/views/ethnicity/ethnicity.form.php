<?php echo $this->session->flashdata('msg');?>
<div id="wrapper">
    <div class="heading_bar rc darkgrey">
        <h1><?php if (isset($ethnicity)) echo 'Edit'; else echo 'Create'; ?> Ethnicity</h1>
    </div>
    <div id="content" class="rc">
        <div class="inner_col">

            <form method="post" action="<?php  if (isset($ethnicity)) echo site_url().'/religions/religion_edit_action/'.$ethnicity->id;else echo site_url().'/religions/religion_create_action/' ?>" name="form" onSubmit="return validate()">

                <div class="frmrow">
				<span class="form_label label_inline">
				Code:
				</span><span class="frmfield">
				<input class="text_area input_inline" type="text" name="code" value="<?php if (isset($ethnicity)) echo $ethnicity->code;  ?>">
				</span>
                </div>
                <div class="frmrow">
				<span class="form_label label_inline">
				Ethnicity:
				</span><span class="frmfield">
				<input class="text_area input_inline" type="text" name="name" value="<?php if (isset($ethnicity)) echo $ethnicity->ethnicity;  ?>">
				</span>
                </div>
                <div class="frmrow">
				<span class="form_label label_inline">
				Enabled:
				</span><span class="frmfield">
				<input id="cb1" class="css-checkbox" type="checkbox" name="enabled" value="1"<?php if (isset($ethnicity) && $ethnicity->enabled==1) echo " CHECKED"; ?>>
				<label for="cb1" class="css-label input_inline"></label></span>
                    </span>
                </div>

        <div class="col_fullwidth right">
            <input type="submit" class="btn darkgreen right" style="width:200px" id='sendBtn' value="<?php if (isset($ethnicity)) echo 'Edit'; else echo 'Create'; ?>">
        </div>
        </form>
        </div>
    </div>
</div>