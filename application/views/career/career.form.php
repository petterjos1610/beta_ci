<?php echo $this->session->flashdata('msg');?>
<div id="wrapper">

    <div class="heading_bar rc darkgrey">
        <h1><?php if (isset($career)) echo 'Edit'; else echo 'Create'; ?> Career</h1>
    </div>

    <div id="content" class="rc">

        <div class="inner_col rc">

            <form method="post" action="<?php  if (isset($career)) echo site_url().'/careers/career_edit_action/'.$career->id;else echo site_url().'/careers/career_create_action/' ?>" name="form" onSubmit="return validate()">


                <div class="frmrow">
				<span class="form_label label_inline">
				Career:
				</span><span class="frmfield">
				<input class="text_area input_inline" type="text" name="name" value="<?php if (isset($career)) echo $career->career; ?>">
				</span>
                </div>
                <div class="frmrow">
                    <span class="form_label label_inline">Enabled:</span>
				<span class="frmfield">
				<input id="cb1" class="css-checkbox" type="checkbox" name="enabled" value="1"<?php if (isset($career) && $career->enabled==1)  echo " CHECKED"; ?>>
				<label for="cb1" class="css-label input_inline"></label></span>
                </div>

        </div>
        <div class="col_fullwidth right">
            <input type="submit" class="btn darkgreen right" style="width:200px" id='sendBtn' value="<?php if (isset($career)) echo 'Edit'; else echo 'Create'; ?>">
            </form>
        </div>

    </div>

</div>
</div>
<script>
    jQuery(document).ready(function($){
    });
</script>
