<?php echo $this->session->flashdata('msg');?>
<script language="javascript" type="text/javascript">
   /*<!------ // Hide script from older browsers
     /*   function validate() {
            var name = document.forms["form"]["name"].value;
            if (name == "" || name == null) return false;
            return true;
        }
    // End hide script ----->*/
</script>

<div id="wrapper">

    <div class="heading_bar rc darkgrey">
        <h1><?php if (isset($studentType)) echo 'Edit'; else echo 'Create'; ?> Student Type</h1>
    </div>

    <div id="content" class="rc">

        <div class="inner_col rc">

            <form method="post" action="<?php  if (isset($studentType)) echo site_url().'/studenttypes/studenttypes_edit_action/'.$studentType->id;else echo site_url().'/studenttypes/studenttypes_create_action/' ?>" name="form" onSubmit="return validate()">
                <input type="hidden" name="function" value="<?php if (isset($studentType)) echo 'editStudentType'; else echo 'createStudentType'; ?>">

                <div class="frmrow">
				<span class="form_label label_inline">
				Student Type:
				</span>
				<span class="frmfield">
				<input class="text_area input_inline" type="text" name="name" value="<?php if (isset($studentType)) echo $studentType->name;  ?>">
				</span>
                </div>

                <div class="frmrow">
				<span class="form_label label_inline">
				Enabled:
				</span>
				<span class="frmfield">
				<input id="cb1" class="css-checkbox" type="checkbox" name="enabled" value="1"<?php if (isset($studentType) && $studentType->enabled==1) echo " CHECKED"; ?>>
				<label for="cb1" class="css-label input_inline"></label></span>
                    </span>
                </div>

        </div>

        <div class="frmrow right">
            <input type="submit" class="btn darkgreen" style="width:200px" id='sendBtn' value="<?php if (isset($studentType)) echo 'Edit'; else echo 'Create'; ?>">
            </form>
        </div>
    </div>
</div>
<script>
    jQuery(document).ready(function($){
    });
</script>