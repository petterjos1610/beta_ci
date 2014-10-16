function isDate(date) {
	var check = date.value.split("/");
	if (check.length == 3) {
		if (check[0] <= 31 && check[1] <= 12 && check[2] < 9999)
			return true;
	}
	return false;
}

function isEmail(email) {
	var atpos = (email.value).indexOf("@");
	var dotpos = (email.value).lastIndexOf(".");
	
	if (email.value == "" || atpos < 1 || dotpos < atpos+2 || dotpos+2 >= email.length) {
		email.style.border='1px solid #f05a49';
		//email.focus();
		//document.getElementById("errorMsg").style.display='block';
	} else {
		email.style.border='1px solid #ddd';
		//document.getElementById("errorMsg").style.display='none';
		return true;
	}
	return false;
}

function isEmpty(field,errorDiv) {
	var obj = document.getElementById(errorDiv);
	if (field.value == "" || field.value == null) {
		obj.style.border='1px solid #f05a49';
		//field.focus();
		document.getElementById("errorMsg").style.display='block';
	} else {
		obj.style.border='1px solid #ddd';
		document.getElementById("errorMsg").style.display='none';
		return false;
	}
	return true;
}

function isCompanyNo(element) {
	var companyRegEx = new RegExp(/\d{5,8}/);
	if (element.value.length < 5 || element.value.length > 8) {
		element.style.border='1px solid #f05a49';
		//element.focus();
		return false;
	} else {
		if (companyRegEx.test(element.value)) {
			element.style.border='1px solid #ddd';
		} else {
			element.style.border='1px solid #f05a49';
			//element.focus();
			return false;
		}
	}
	return true;
}

function isCharityNo(element) {
	var companyRegEx6 = new RegExp(/\d{6}/);
	var companyRegEx8 = new RegExp(/\d{7}/);
	var checkVal = parseInt(element.value, 10);
	if (!isNaN(checkVal)) element.value = checkVal;
	else element.value = "";
	if (element.value.length != 6 && element.value.length != 7) {
		element.style.border='1px solid #f05a49';
		//element.focus();
		return false;
	} else {
		if (companyRegEx6.test(element.value) || companyRegEx8.test(element.value)) {
			element.style.border='1px solid #ddd';
		} else {
			element.style.border='1px solid #f05a49';
			//element.focus();
			return false;
		}
	}
	return true;
}

function loginValidate() {
	var email = document.loginForm.user;
	var password = document.loginForm.pass;
	if (!isEmail(email)) return false;
	if (isEmpty(pass,"pass")) return false;
	return true;
}

function isNotEmpty(element) {
	if (element.value == "" || element.value == null) {
		element.style.border='1px solid #f05a49';
		//element.focus();
		return false;
	} else {
		element.style.border='1px solid #ddd';
	}
	return true;
}

function formatPostcode(p) { 
	p.value = p.value.toUpperCase();
	var postcodeRegEx = /(^[A-Z]{1,2}[0-9]{2}|[0-9]{1}[A-Z])?([0-9][A-Z]{2}$)/i;
	return p.value.replace(postcodeRegEx,"$1 $2");
}

function isPostcode(element) {
	element.value = element.value.replace(" ","");
	element.value = formatPostcode(element);
    var postcodeRegEx = new RegExp(/[A-Z]{1,2}(?:[0-9]{2}(?![A-Z]))|(?:[0-9]{1}[A-Z]?) ?[0-9][A-Z]{2}/i);
	if (!postcodeRegEx.test(element.value)) {
		element.style.border='1px solid #f05a49';
		//element.focus();
		return false;
	} else {
		element.style.border='1px solid #ddd';
		return true;
	}
}

function isPhoneNo(element) {
	var phoneRegEx = new RegExp(/\d{11}/);
	element.value = element.value.replace("+44","0");
	element.value = element.value.replace(/ /g, '')
	if (element.value.substring(0,2) == "44") element.value = element.value.replace("44","0");
	var elemVal = element.value;
	if (!phoneRegEx.test(element.value) || elemVal.length > 11){
		element.style.border='1px solid #f05a49';
		//element.focus();
		return false;
	} else {
		element.style.border='1px solid #ddd';
	}
	return true;
}

function isEqualTo(element1,element2) {
	if (element1.value != element2.value) {
		element1.style.border='1px solid #f05a49';
		//element1.focus();
		return false;
	} else {
		element1.style.border='1px solid #ddd';
	}
	return true;
}

function hasOption(element) {
	console.log(element.name);
	if (element.options.length == 0) {
		element.style.border='1px solid #f05a49';
		//element.focus();
		return false;
	} else {
		element.style.border='1px solid #ddd';
	}
	return true;
}

function isPositiveInt(element) {
	if (element.value != "") {
		if (isNaN(parseFloat(element.value)) || !isFinite(parseFloat(element.value)) || element.value < 0) {
			element.style.border='1px solid #f05a49';
			//element.focus();
			return false;
		} else {
			element.style.border='1px solid #ddd';
			return true;
		}
	}
	return false;
}

function isUrn(element) {
	if (element.value != "") {
		if (!isFinite(element.value) || element.value.length != 8) {
			element.style.border='1px solid #f05a49';
			//element.focus();
			return false;
		} else {
			element.style.border='1px solid #ddd';
			return true;
		}
	}
	return false;
}

function isIP(element) {
	if (element.value != "") {
		var mask = element.value.split(".");
		if (mask.length != 4 || !isFinite(mask[0]) || !isFinite(mask[1]) || !isFinite(mask[2]) || !isFinite(mask[3]) || mask[0].length > 3 || mask[1].length > 3 || mask[2].length > 3 || mask[3].length > 3 || mask[0] > 128 || mask[1] > 128 || mask[2] > 128 || mask[3] > 128) {
			element.style.border='1px solid #f05a49';
			//element.focus();
			return false;
		} else {
			element.style.border='1px solid #ddd';
			return true;
		}
	}
	return false;
}

function isNetworkMask(element) {
	if (element.value != "") {
		var mask = element.value.split(".");
		if (mask.length <= 1 || mask.length >= 4 || !isFinite(parseFloat(mask[0])) || !isFinite(parseFloat(mask[1])) || mask[0].length > 3 || mask[1].length > 3 || mask[0] > 128 || mask[1] > 128) {
			element.style.border='1px solid #f05a49';
			//element.focus();
			return false;
		} else {
			element.style.border='1px solid #ddd';
			return true;
		}
	}
	return false;
}

function isUpn(element) {
	if (element.value != "") {
		var upnEx = new RegExp(/[A-Z0-9]{13}/i);
		if (element.value.length != 13 || !upnEx.test(element.value)) {
			element.style.border='1px solid #f05a49';
			//element.focus();
		} else {
			element.value = element.value.toUpperCase();
			element.style.border='1px solid #ddd';
			return true;
		}
	}
	return false;
}

function isUln(element) {
	if (element.value != "") {
		if (element.value.length != 10 || !upnEx.test(element.value) || !isFinite(parseFloat(element.value))) {
			element.style.border='1px solid #f05a49';
			//element.focus();
		} else {
			element.style.border='1px solid #ddd';
			return true;
		}
	}
	return false;
}

function checkTotalAttendance(from) {
	var totalPossible = document.forms[0].possibleAttendances;
	var actual = document.forms[0].totalAttendances;
	var unath = document.forms[0].unauthorisedAttendances;
	var auth = document.forms[0].authorisedAttendances;
	if (actual.value == "") actual.value = 0;
	if (unath.value == "") unath.value = 0;
	if (auth.value == "") auth.value = 0;
	//var actualInt = parseInt(actual.value);
	//var unathInt = parseInt(unath.value);
	//var authInt = parseInt(auth.value);
	//var total = actualInt+unathInt+authInt;
	var total = parseInt(actual.value) + parseInt(unath.value) + parseInt(auth.value);
	
	console.log(total);
	
	if (total > totalPossible.value) {
		actual.value = parseInt(actual.value) - (total - parseInt(totalPossible.value));
	}
	
	if (total == totalPossible.value) {
		if (actual.value == "") actual.value = "0";
		if (unath.value == "") unath.value = "0";
		if (auth.value == "") auth.value = "0";
	}
	
	if (total < totalPossible.value) {
		actual.value = parseInt(actual.value) + (parseInt(totalPossible.value) - total);
	}
}

function checkGrades(from,id) {
	//alert(id);
	var predicted = document.getElementById('predicted'+id);
	var target = document.getElementById('target'+id);
	var actual = document.getElementById('actual'+id);
	
	if (from.value == "") {
		predicted.value = "";
		target.value = "";
		actual.value = "";
	} else {	
		if (predicted.value == "") predicted.value = from.value;
		if (target.value == "") target.value = from.value;
		if (actual.value == "") actual.value = from.value;
	}
}

function laterThanStart(end,start) {
	var date1 = end.value.split("/");
	var date2 = start.value.split("/");
	
	var d1 = new Date(date1[2],date1[0],date1[1],0,0,0);
	var d2 = new Date(date2[2],date2[0],date2[1],0,0,0);
	
	if (d1 < d2) {
		console.log(d1+' '+d2);
		end.style.border='1px solid #f05a49';
		end.focus();
	} else {
		end.style.border='1px solid #ddd';
	}
}