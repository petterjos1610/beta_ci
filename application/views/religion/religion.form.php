<?php echo $this->session->flashdata('msg');?>
<div id="wrapper">

    <div class="heading_bar rc darkgrey">
        <h1><?php if (isset($religion)) echo 'Edit'; else echo 'Create'; ?> Religion</h1>
    </div>

    <div id="content" class="rc">

        <div class="inner_col rc">
            <form method="post" action="<?php  if (isset($religion)) echo site_url().'/religions/religion_edit_action/'.$religion->id; else echo site_url().'/religions/religion_create_action/' ?>" name="form" onSubmit="return validate()">


                <div class="frmrow">
				<span class="form_label label_inline">
				Code:
				</span>
				<span class="frmfield">
				<input class="text_area input_inline" type="text" name="code" value="<?php if (isset($religion)) echo $religion->code; ?>">
				</span>
                </div>

                <div class="frmrow">
				<span class="form_label label_inline">
				Religion:
				</span>
				<span class="frmfield">
				<input class="text_area input_inline" type="text" name="religion" value="<?php if (isset($religion)) echo $religion->religion; ?>">
				</span>
                </div>

                <div class="frmrow">
				<span class="form_label label_inline">
				Enabled:
				</span>
				<span class="frmfield">
				<input id="cb1" class="css-checkbox" type="checkbox" name="enabled" value="1"<?php if (isset($religion) && $religion->enabled==1) echo " CHECKED"; ?>>
				<label for="cb1" class="css-label input_inline"></label></span>
                    </span>
                </div>

        </div>
        <div class="frmrow right">
            <input type="submit" class="btn darkgreen" style="width:200px" id='sendBtn' value="<?php if (isset($religion)) echo 'Edit'; else echo 'Create'; ?>">
            </form>
        </div>

    </div>
</div>
<script>
    jQuery(document).ready(function($){
    });
</script>