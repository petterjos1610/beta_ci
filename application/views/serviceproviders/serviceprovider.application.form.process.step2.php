<input type="hidden" name="name" value="<?php echo $_POST['name']; ?>">
<input type="hidden" name="regdate" value="<?php echo $_POST['regdate']; ?>">
<input type="hidden" name="contact" value="<?php echo $_POST['contact']; ?>">
<input type="hidden" name="phone" value="<?php echo $_POST['phone']; ?>">
<input type="hidden" name="address" value="<?php echo $_POST['address']; ?>">
<input type="hidden" name="postcode" value="<?php echo $_POST['postcode']; ?>">
<input type="hidden" name="website" value="<?php echo $_POST['website']; ?>">
<input type="hidden" name="userEmail" value="<?php echo $_POST['userEmail']; ?>">
<input type="hidden" name="userFname" value="<?php echo $_POST['userFname']; ?>">
<input type="hidden" name="userLname" value="<?php echo $_POST['userLname']; ?>">

<div class="heading_bar rc darkgreen">
	<h2>Nearly there... We just need to know the following</h2>
</div>
<div class="col_fullwidth">
	<div class="col_2third left">
		<div class="form_label">We have all required safeguarding policies in place i.e. a safe from harm policy and DBS screening for staff and volunteers</div>
	</div>
	<div class="col_1third right">
		<div class="col_half left">
			<input id="safeguard" class="css-checkbox" type="radio" name="safeguard" value="1" onChange="validateForm()" />
			<label id="safeguardLbl" for="safeguard" class="css-label" style="height:auto;">We do</label>
		</div><div class="col_half right">
			<input id="safeguard2" class="css-checkbox" type="radio" name="safeguard" value="0" onChange="validateForm()" />
			<label id="safeguardLbl2" for="safeguard2" class="css-label" style="height:auto;">We don't</label>
		</div>
	</div>
	<div class="spacer30"></div>
	<div class="col_2third left">
		<div class="form_label">For each programme that we wish to upload, we will provide details of at least one teacher or education professional who is willing to provide visible feedback on their experience to be displayed on our site</div>
	</div>
	<div class="col_1third right">
		<div class="col_half left">
			<input id="referee" class="css-checkbox" type="radio" name="referee" value="1" onClick="validateForm()" />
			<label id="refereeLbl" for="referee" class="css-label" style="height:auto;">We will</label>
		</div><div class="col_half right">
			<input id="referee2" class="css-checkbox" type="radio" name="referee" value="0" onClick="validateForm()" />
			<label id="refereeLbl2" for="referee2" class="css-label" style="height:auto;">We won't</label>
		</div>
	</div>
	<div class="spacer30"></div>
	<div class="col_2third left">
		<div class="form_label">We have all necessary insurance in place i.e. public liability insurance</div>
	</div>
	<div class="col_1third right">
		<div class="col_half left">
			<input id="insurance" class="css-checkbox" type="radio" name="insurance" value="1" onClick="validateForm()" />
			<label id="insuranceLbl" for="insurance" class="css-label" style="height:auto;">We do</label>
		</div><div class="col_half right">
			<input id="insurance2" class="css-checkbox" type="radio" name="insurance" value="0" onClick="validateForm()" />
			<label id="insuranceLbl2" for="insurance2" class="css-label" style="height:auto;">We don't</label>
		</div>
	</div>
	<div class="spacer30"></div>
	<div class="col_2third left">
		<div class="form_label">We are using this service in good faith and agree to provide honest, accurate information in response to all questions. We will advise the EduKit team immediately should our circumstances change.</div>
	</div>
	<div class="col_1third right">
		<div class="col_half left">
			<input id="honesty" class="css-checkbox" type="radio" name="honesty" value="1" onClick="validateForm()" />
			<label id="honestLbl" for="honesty" class="css-label" style="height:auto;">We agree</label>
		</div><div class="col_half right">
			<input id="honesty2" class="css-checkbox" type="radio" name="honesty" value="0" onClick="validateForm()" />
			<label id="honestyLbl2" for="honesty2" class="css-label" style="height:auto;">We disagree</label>
		</div>
	</div>
</div>
<div class="spacer30"></div>
<div class="col_fullwidth">
	<div class="col_1third right" style="height:0px;" id="complete"><input type="button" class="btn darkgreen right" value="Submit my application" onClick="formSubmit();"></div>
</div>
<script>
	function validateForm() {
		//console.log($('input[name="safeguard"]:checked').val());
		//console.log($('input[name="referee"]:checked').val());
		//console.log($('input[name="insurance"]:checked').val());
		//console.log($('input[name="honesty"]:checked').val());
		if (($('input[name="safeguard"]:checked').val() == "1" || $('input[name="safeguard"]:checked').val() == "0") && ($('input[name="referee"]:checked').val() == "1" || $('input[name="referee"]:checked').val() == "0") && ($('input[name="insurance"]:checked').val() == "1" || $('input[name="insurance"]:checked').val() == "0") && ($('input[name="honesty"]:checked').val() == "1" || $('input[name="honesty"]:checked').val() == "0"))
			$('#complete').animate({ "height":"40px" }, 500);
		else $('#complete').animate({ "height":"0px" }, 500);
	}

	$( '#confirm' ).animate({ "height": "460px" }, 500);
</script>