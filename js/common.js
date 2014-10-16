
	// ----------------------------------------------------------------------------------	
	
	// OPEN AND CLOSE EXPANDABLE BOXES

	function setup_expandables(){
		
		$('.start_open').children('div.expandable_content').slideDown('medium');
		$('.start_open').children('div.expandable_content').addClass('expanded');
		
		$('.expandable_title').hover(function(){
			$(this).animate({"opacity": .8}, 100); 
		}, function() { 
			$(this).animate({"opacity": 1}, 400); 
		});
		
		$('.expandable_title').click(function(){
			
			if (!$(this).hasClass('inactive')){

				if ($(this).parent().children('div.expandable_content').hasClass('expanded')){
					
					$(this).parent().children('div.expandable_content').slideUp('medium');
					$(this).parent().children('div.expandable_content').removeClass('expanded');
					
				} else {
	
					$(this).parent().parent().children('div.expandable').children('div.expanded').slideUp('medium');
					$(this).parent().parent().children('div.expandable').children('div.expanded').removeClass('expanded');	
					$(this).parent().children('div.expandable_content').slideDown('medium');
					$(this).parent().children('div.expandable_content').addClass('expanded');
				}
				
			} else {
				
				make_popup()
				
			}
		});
	}
	
	
	
	// ----------------------------------------------------------------------------------	
	
	// MAKE POPUP ALERT
	
	function make_popup(){
		
		var poup_html = '<div class="poup_background"><div class="popup_inner"><div class="popup_close"></div><div class="popup_content"></div></div></div>';
		
	}
	
	
	
	
	// ----------------------------------------------------------------------------------	
	
	// ALTERNATE ROW COLOURS
	
	function colour_rows(target_div, colourscheme){
		
		var target = $(''+target_div+'');
		var head_colour = 'row_' + colourscheme +'_head';
		var even_colour = 'row_' + colourscheme +'1';
		var odd_colour = 'row_' + colourscheme +'2';
		
		target.children('table').children('tbody').children('tr:even').addClass(even_colour);
		target.children('table').children('tbody').children('tr:odd').addClass(odd_colour);
		target.children('table').children('tbody').children('.header').addClass(head_colour);
		target.children('table').children('tbody').children('.header').removeClass(even_colour);
	}
		
		
		
		
	// ----------------------------------------------------------------------------------	
	
	// CREATE PROGRAMME APP
	
	var item_width;
	var pb_width;
	var section_width;
	var page_num = 1;

	function create_programme_setup() {
		$(window).bind('resize', set_widths);
		set_widths();
		
		$('#form_container').height($('#create1').height());
		TweenMax.to(('#progressbar_bar'), .5, {css:{width:find_pb_width(1)}});
		
		$('#progress_btn2').click(page1);
		$('#progress_btn4').click(page2);
		$('#progressbar_end img').attr("src", "imgs/tick_fella1.png");
	}

	function set_widths() {
		item_width = $('#form_container').width();
		TweenMax.to(('#create1'), 0, {css:{width:item_width}});
		TweenMax.to(('#create2'), 0, {css:{width:item_width}});
		TweenMax.to(('#create3'), 0, {css:{width:item_width}});
		TweenMax.to(('#create3'), 0, {css:{width:item_width}});
		section_width = ($('#progressbar_holder').width()-290) /3;
		TweenMax.to($('.progressbar_item'), 0, {css:{width:section_width}});
		
		pb_width = section_width *2;
		TweenMax.to(('#progressbar_blank'), 0, {css:{left:160 + section_width/2, width:pb_width}});
		TweenMax.to(('#progressbar_bar'), 0, {css:{left:160 + section_width/2}});
		
		set_page(false);
	}
	
	function set_page(reset_top) {
		if (reset_top){
			TweenMax.to(window, .5, {scrollTo:{y:0}});
		}
		
		var new_x;
		if (page_num == 1){
			new_x = 0;
		} else if (page_num == 2){
			new_x = item_width*-1 -20;
		} else if (page_num == 3){
			new_x = item_width*-2 -40;
		}
		TweenMax.to(('#form_slider'), .5, {css:{left:new_x}, delay:.5});
		TweenMax.to(('#progressbar_bar'), .5, {css:{width:find_pb_width(page_num)}, delay:.5});
		setTimeout(adjust_height, 500, $('#create'+page_num).height());
	}
	
	function find_pb_width(pos) {
		return (pb_width) / (2/(pos-1));
	}
	
	function finish() {
		trace ("Done");
	}
	
	function adjust_height(new_height) {
		$('#form_container').height(new_height);
	}

	function page1() {
		page_num = 1;
		set_page(true);
		$('#progressbar_end img').attr("src", "imgs/tick_fella1.png");
	}
	
	function page2() {
		page_num = 2;
		set_page(true);
		$('#progressbar_end img').attr("src", "imgs/tick_fella2.png");
	}

	function page3() {
		page_num = 3;
		set_page(true);
		$('#progressbar_end img').attr("src", "imgs/tick_fella3.png");
	}

	// ----------------------------------------------------------------------------------
		
	// STUDENT PROFILE BOX FIX
	
	function scale_data_box(output_string) {
		
		$(window).bind('resize', function(){
			$('.student_data').width($('.student_data').parent().width() - $('.student_image').width() - 16);
		});
	}		
	
	
	
	// ----------------------------------------------------------------------------------
		
	// SEARCH PAGE TABS
	
	function setup_tabs() {
		
		$('#list_btn').click(function() {
			$('#list_view').removeClass('hide_me');
			$('#map_view').addClass('hide_me');
		});
		
		$('#map_btn').click(function() {
			$('#list_view').addClass('hide_me');
			$('#map_view').removeClass('hide_me');
		});
	}


	// ----------------------------------------------------------------------------------
		
	// SCROLL TO BOTTOM
	
	function more_btn_scroll() {
	
		$('.more_btn').click(function() {
			trace ("clicky");
			var aTag = $("a[name='cdetails']");
			$('html,body').animate({scrollTop: aTag.offset().top},'medium');
		});
	}
	
	
	
	// ----------------------------------------------------------------------------------
		
	// SET FORM GRAPHICS AND TWEAKS
	
	function style_forms() {
		if (!$(".select_img").is("[disabled]")) $(".select_img").wrap("<div class='select_wrap'></div>");
	}
	
	
	
	// ----------------------------------------------------------------------------------
	
	// ACTIVITY SELECTOR POPUP
	
	function setup_activity_selector() {
		
		$('#add_activity').click(show_popup);
		$('#close_popup').click(close_popup);
	}

	function show_popup() {
		
		var x_pos = Math.round(($(window).innerWidth() - $('#activity_popup').width()) / 2);
		var y_pos = Math.round(($(window).innerHeight() - $('#activity_popup').height()) / 2) - 20;
		
		TweenMax.to(('#activity_popup'), 0, {css:{left:x_pos, top:y_pos}});
		TweenMax.to(('#activity_popup'), .5, {css:{autoAlpha:1}});
	}
	
	function close_popup() {
		TweenMax.to(('#activity_popup'), .5, {css:{autoAlpha:0}});
	}
	




	// ----------------------------------------------------------------------------------
	
	// SET SLIDERS (http://refreshless.com/nouislider/)
	
	function set_slider(sl_target, sl_display, max_val){
		sl_target.noUiSlider({
			start: 0, 
			connect: "lower", 
			step: 1, 
			range: {'min': 1, 'max': max_val},
			serialization: {lower: [$.Link({target: sl_display})]}
		});
		
		var labels_html = '<div class="slider_labels">';
		for (var i = 1; i <= max_val; i++){
			
			if (i == 1){
				labels_html += '<div class="slider_label" style="width:10px" >1</div>';
			
			} else if (i == max_val){
				labels_html += '<div class="slider_label right" style="width:10px" >' + max_val + '</div>';
			} else {
				var label_width = 100 / (max_val-1);
				labels_html += '<div class="slider_label" style="text-align:right; width:' + label_width + '%" >' + i + '</div>';
			}

		}
		labels_html += '</div>';
		sl_target.parent().append(labels_html);
	}
	
	
	
	
	
	

	// ----------------------------------------------------------------------------------
		
	// TRACE (old habits die hard!)

	function trace(output_string){
		if ((window['console'] !== undefined)) {
      		console.log(output_string);
		}
	}
	
	
	
	
	// ----------------------------------------------------------------------------------	


	//var show = false;

	function infoPopup(title,message) {
		message = message.split("\n");
		console.log(message);
		var popup = '<div id="info_popup"><div id="popup_inner" class="border_red rc"><div id="popup_close"><a onClick="removePopup()">Close</a></div><div class="heading_bar rc red"><h2>'+title+'</h2></div><div id="popup_content" class="inner_col rc">';
		for (var i=0; i<message.length; i++) popup += '<p>'+message[i]+'</p>';
		popup += '</div></div></div>';
		$('#popup').html(popup).show();
	}

	function removePopup() {
		$('#popup').hide();
	}


	function showTab(tab,display,group) {	
		for (var i=0; i<$('li').length; i++)
			if (group == "" || $('li')[i].className.indexOf(group) != -1)
				$('li')[i].className = $('li')[i].className.replace('currenttab','');
		for (var i=0; i<$('div').length; i++)
			if (group == "" || $('div')[i].className.indexOf(group) != -1)
				$('div')[i].className = $('div')[i].className.replace('currentdisplay','');
		$(tab).addClass('currenttab');
		$(display).addClass('currentdisplay');
	}

	function add(value) {
		var x = document.getElementById("issues");
		var option = document.createElement("option");
		option.setAttribute("value", value);
		option.text = value
		if (x.options.length == 0) x.add(option);
		else x.insertBefore(option,x.options[0]);
	}
	
	function issueRemove(action_list) {
		var is_selected = [];
		for (var i = 0; i < action_list.options.length; ++i) {
			is_selected[i] = action_list.options[i].selected;
		}
		i = action_list.options.length;
		while (i--) {
			if (is_selected[i]) {
				action_list.remove(i);
			}
		}
	}
	
	function selectAllOptions(obj) {
		for (var i=0; i<obj.options.length; i++) {
			obj.options[i].selected = true;
		}
	}
	
	function hasValue(select,value) {
		for (var i=0; i<select.options.length; i++) {
			if (select.options[i].value == value) return true;
		}
		return false;
	}
	
	function chooseOpt(from,to) {
		if (!hasValue(to,from.options[from.selectedIndex].value) && from.value != "") {
			var option = document.createElement("option");
			option.setAttribute("value", from.options[from.selectedIndex].value);
			option.text = from.options[from.selectedIndex].text;
			if (to.options.length == 0) to.add(option);
			else to.insertBefore(option,to.options[0]);
		}
	}
	
	function chooseTargetStudentOpt(from1,from2,from3,to,to1,to2,to3) {
		if (from1.options[from1.selectedIndex].value != "" && !hasValue(to1,from1.options[from1.selectedIndex].value)) {
			var option = document.createElement("option");
			option.setAttribute("value", "1-"+from1.options[from1.selectedIndex].value);
			option.text = from1.options[from1.selectedIndex].text;
			var option1 = document.createElement("option");
			option1.setAttribute("value", from1.options[from1.selectedIndex].value);
			option1.text = from1.options[from1.selectedIndex].text;
			if (to.options.length == 0) to.add(option);
			else to.insertBefore(option,to.options[0]);
			to1.add(option1);
		}
		if (from2.options[from2.selectedIndex].value != "" && !hasValue(to2,from2.options[from2.selectedIndex].value)) {
			var option = document.createElement("option");
			option.setAttribute("value", "2-"+from2.options[from2.selectedIndex].value);
			option.text = from2.options[from2.selectedIndex].text;
			var option2 = document.createElement("option");
			option2.setAttribute("value", from2.options[from2.selectedIndex].value);
			option2.text = from2.options[from2.selectedIndex].text;
			if (to.options.length == 0) to.add(option);
			else to.insertBefore(option,to.options[0]);
			to2.add(option2);
		}
		if (from3.options[from3.selectedIndex].value != "" && !hasValue(to3,from3.options[from3.selectedIndex].value)) {
			var option = document.createElement("option");
			option.setAttribute("value", "3-"+from3.options[from3.selectedIndex].value);
			option.text = from3.options[from3.selectedIndex].text;
			var option3 = document.createElement("option");
			option3.setAttribute("value", from3.options[from3.selectedIndex].value);
			option3.text = from3.options[from3.selectedIndex].text;
			if (to.options.length == 0) to.add(option);
			else to.insertBefore(option,to.options[0]);
			to3.add(option3);
		}
	}
	
	function removeTargetStudentOpt(from) {
		var is_selected = [];
		var has_value = [];
		for (var i = 0; i < from.options.length; i++) {
			if (from.options[i].selected) {
				//console.log(from.options[i].value);
				is_selected.push(from.options[i]);
				has_value.push(from.options[i].value);			
			}
		}
		//console.log(is_selected);
		for (var i=0; i < is_selected.length; i++) {
			var cat = has_value[i].split("-");
			if (cat[0] == "1") {
				var from1 = document.forms[0].targetStudentTypes;
			}
			if (cat[0] == "2") {
				var from1 = document.forms[0].targetEthnicities;
			}
			if (cat[0] == "3") {
				var from1 = document.forms[0].targetReligions;
			}
			for (var ii = 0; ii < from1.options.length; ii++) {
				if (from1.options[ii].value == cat[1])
					from1.remove(ii);
			}
			for (var iii = 0; iii < from.options.length; iii++) {
				if (from.options[iii].value == has_value[i])
					from.remove(iii);
			}
		}
	}
	
	function padTime(time) {
		if (time<10) return 0+''+time;
		else return time;
	}
	function isLeapYear(year) {
		return ((year % 4 == 0) && (year % 100 != 0)) || (year % 400 == 0);
	}
	
	function chooseSessionOpt(fromDate,fromHour,fromMin,frequency,toDate,toHour,toMin,location,to) {
		var weekday=new Array(7), month=new Array(12);
		weekday[0]="Sunday";
		weekday[1]="Monday";
		weekday[2]="Tuesday";
		weekday[3]="Wednesday";
		weekday[4]="Thursday";
		weekday[5]="Friday";
		weekday[6]="Saturday";
		month[0]="January";
		month[1]="February";
		month[2]="March";
		month[3]="April";
		month[4]="May";
		month[5]="June";
		month[6]="July";
		month[7]="August";
		month[8]="September";
		month[9]="October";
		month[10]="November";
		month[11]="December";
		var mydate1 = fromDate.value.split("/");
		var mydate2 = toDate.value.split("/");
		mydate1[0] -= 1;
		mydate2[0] -= 1;
		
		if (fromDate.value != "Select a date" && toDate.value != "Select a date") {
			if (frequency.value == "between" || frequency.value == "flexible") {
				var d1 = new Date(mydate1[2],mydate1[0],mydate1[1],fromHour.value,fromMin.value,0);
				var d2 = new Date(mydate2[2],mydate2[0],mydate2[1],toHour.value,toMin.value,0);
				var location = location.value.split(";");
				var checkValue = d1.getFullYear()+'-'+d1.getMonth()+'-'+d1.getDate()+' '+d1.getHours()+':'+d1.getMinutes()+':0;'+d2.getFullYear()+'-'+d2.getMonth()+'-'+d2.getDate()+' '+d2.getHours()+':'+d2.getMinutes()+":0;"+location[0];
				if (!hasValue(to,checkValue)) {
					if (d1 < d2) {
						var option = document.createElement("option");
						option.setAttribute("value", checkValue);
						option.text = checkValue;
						//option.text = weekday[d1.getDay()]+" "+month[d1.getMonth()-1]+" "+d1.getDate()+" "+d1.getFullYear()+" at "+d1.getHours()+":"+d1.getMinutes()+" to "+d2.getHours()+":"+d2.getMinutes();
						to.add(option);
						
						var element = document.createElement('div');
						element.className = "sessionRow grey_bg";
						document.getElementById('sessionsDiv').appendChild(element);
						
						var element2 = document.createElement('input');
						element2.setAttribute("type","image");
						element2.setAttribute("src","imgs/delete.png");
						element2.style.width="20px";
						element2.style.height="20px";
						element2.id = checkValue;
						element2.className = 'removeSession right';
						element2.appendChild(document.createTextNode("Remove"));
						element2.onclick = function() { 
							this.parentNode.parentNode.removeChild(this.parentNode);
							var optCount = document.forms[0].sessions.options.length;
							for (var i = 0; i < optCount; i++) {
								var option = document.forms[0].sessions.options[i];
								if (option.value == this.id) document.forms[0].sessions.remove(i);
							}
						}
						if (frequency.value == "between")
							element.appendChild(document.createTextNode(location[1]+' on '+month[d1.getMonth()]+" "+d1.getDate()+" "+d1.getFullYear()+" at "+padTime(d1.getHours())+":"+padTime(d1.getMinutes())+" to "+padTime(d2.getHours())+":"+padTime(d2.getMinutes())));
						else
							element.appendChild(document.createTextNode(location[1]+' on '+month[d1.getMonth()]+" "+d1.getDate()+" "+d1.getFullYear()+" at "+padTime(d1.getHours())+":"+padTime(d1.getMinutes())+" to "+month[d2.getMonth()]+" "+d2.getDate()+" "+d2.getFullYear()+" at "+padTime(d2.getHours())+":"+padTime(d2.getMinutes())));
						element.appendChild(element2);
					}
				}
			} else if (frequency.value == "dailyIncl" || frequency.value == "dailyExcl" || frequency.value == "weekly" || frequency.value == "fortnightly" || frequency.value == "monthly") {
				var d1 = new Date(mydate1[2],mydate1[0],mydate1[1],fromHour.value,fromMin.value,0);
				var d2 = new Date(mydate1[2],mydate1[0],mydate1[1],toHour.value,toMin.value,0);
				var d3 = new Date(mydate2[2],mydate2[0],mydate2[1],toHour.value,toMin.value,0);
				var location = location.value.split(";");
				//alert(d1.getDay()+'\n'+d2.getDay());
				do {
					if (d2 > d1) {
						var checkValue = d1.getFullYear()+'-'+d1.getMonth()+'-'+d1.getDate()+' '+d1.getHours()+':'+d1.getMinutes()+':0;'+d2.getFullYear()+'-'+d2.getMonth()+'-'+d2.getDate()+' '+d2.getHours()+':'+d2.getMinutes()+":0;"+location[0];
						//alert(checkValue);
						if (!hasValue(to,checkValue) && (frequency.value == "dailyIncl" || frequency.value == "weekly" || frequency.value == "fortnightly" || frequency.value == "monthly" || (frequency.value == "dailyExcl" && d1.getDay() != 0 && d1.getDay() != 6))) {
							var option = document.createElement("option");
							option.setAttribute("value", checkValue);
							option.text = checkValue;
							//option.text = weekday[d1.getDay()]+" "+month[d1.getMonth()-1]+" "+d1.getDate()+" "+d1.getFullYear()+" at "+d1.getHours()+":"+d1.getMinutes()+" to "+d2.getHours()+":"+d2.getMinutes();
							to.add(option);
							
							var element = document.createElement('div');
							element.className = "sessionRow grey_bg";
							document.getElementById('sessionsDiv').appendChild(element);
							
							var element2 = document.createElement('input');
							element2.setAttribute("type","image");
							element2.setAttribute("src","imgs/delete.png");
							element2.style.width="20px";
							element2.style.height="20px";
							element2.id = checkValue;
							element2.className = 'removeSession right';
							element2.appendChild(document.createTextNode("Remove"));
							element2.onclick = function() { 
								this.parentNode.parentNode.removeChild(this.parentNode);
								var optCount = document.forms[0].sessions.options.length;
								for (var i = 0; i < optCount; i++) {
									var option = document.forms[0].sessions.options[i];
									if (option.value == this.id) document.forms[0].sessions.remove(i);
								}
							}
							element.appendChild(document.createTextNode(location[1]+' on '+month[d1.getMonth()]+" "+d1.getDate()+" "+d1.getFullYear()+" at "+padTime(d1.getHours())+":"+padTime(d1.getMinutes())+" to "+padTime(d2.getHours())+":"+padTime(d2.getMinutes())));
							element.appendChild(element2);
						}
					}
					var increm = 0;
					if (frequency.value == "dailyIncl" || frequency.value == "dailyExcl") increm = 1;
					if (frequency.value == "weekly") increm = 7;
					if (frequency.value == "fortnightly") increm = 14;
					if (frequency.value == "monthly") {
						if (d1.getMonth() == 0 || d1.getMonth() == 2 || d1.getMonth() == 4 || d1.getMonth() == 6 || d1.getMonth() == 7 || d1.getMonth() == 9 || d1.getMonth() == 11) {
							increm = 31;
						} else if (d1.getMonth() == 3 || d1.getMonth() == 5 || d1.getMonth() == 8 || d1.getMonth() == 10) {
							increm = 30;
						} else {
							if (isLeapYear(d1.getFullYear())) increm = 29;
							else increm = 28;
						}
					}
					d1.setDate(d1.getDate()+increm);
					d2.setDate(d2.getDate()+increm);
					console.log(d1);
					console.log(d2);
					console.log(d3);
				} while (d2 <= d3);
			}
		}
	}
	
	function removeSessionOpt(opt) {
		var optCount = document.forms[0].sessions.options.length;
		for (var i = 0; i < optCount; i++) {
			var option = document.forms[0].sessions.options[i];
			if (option.value == opt.id) {
				document.forms[0].sessions.remove(i);
				opt.parentNode.parentNode.removeChild(opt.parentNode);
				return;
			}
		}
	}
	
	function removeOpt(from) {
		var is_selected = [];
		for (var i = 0; i < from.options.length; ++i) {
			is_selected[i] = from.options[i].selected;
		}
		i = from.options.length;
		while (i--) {
			if (is_selected[i]) {
				from.remove(i);
			}
		}
	}
	
	function createAttachment() {
		var x = document.getElementById("attachmentsSpan");
		var option = document.createElement("input");
		option.setAttribute("type","file");
		option.setAttribute("name","attachments[]");
		x.add(option);
	}
	
	function frequencySelect(option) {
		if (option == "dailyIncl" || option == "dailyExcl" || option == "weekly" || option == "fortnightly" || option == "monthly" || option == "flexible") document.getElementById("frequencyDiv").style.display='inline-block';
		else document.getElementById('frequencyDiv').style.display='none';
	}
	
	function chooseSearchOpt(from,to,div) {
		if (from.value != "") {
			fromCity = from.value.split(",");
			if (!hasValue(to,from.value) && !hasValue(to,fromCity[0]+",0")) {
				var option = document.createElement("option");
				option.setAttribute("value", from.value);
				option.text = from.options[from.selectedIndex].text;
				if (to.options.length == 0) to.add(option);
				else to.insertBefore(option,to.options[0]);
				
				var element = document.createElement('div');
				element.className = "sessionRow grey_bg";
				document.getElementById(div).appendChild(element);
				
				var element2 = document.createElement('input');
				element2.setAttribute("type","image");
				element2.setAttribute("src","imgs/delete.png");
				element2.style.width="20px";
				element2.style.height="20px";
				element2.id = from.value;
				element2.className = 'removeSession right';
				element2.appendChild(document.createTextNode("Remove"));
				element2.onclick = function() { 
					this.parentNode.parentNode.removeChild(this.parentNode);
					var optCount = to.options.length;
					for (var i = 0; i < optCount; i++) {
						var option = to.options[i];
						if (option.value == this.id) to.remove(i);
					}
				}
				element.appendChild(document.createTextNode(from.options[from.selectedIndex].text));
				element.appendChild(element2);
			}
		}
	}
	
	function enableAll() {
		document.forms[0].progName.disabled=false;
		document.forms[0].spId.disabled=false;
		document.forms[0].gender.disabled=false;
		document.forms[0].minAge.disabled=false;
		document.forms[0].maxAge.disabled=false;
		document.forms[0].sessStart.disabled=false;
		document.forms[0].sessEnd.disabled=false;
		document.forms[0].location_options.disabled=false;
		document.forms[0].issue_options.disabled=false;
		document.forms[0].locations.disabled=false;
		document.forms[0].issues.disabled=false;
	}
	
	function disableAllBut(element) {
		console.log(element.name);
		if (element.name != "progName") document.forms[0].progName.disabled=true;
		if (element.name != "spId") document.forms[0].spId.disabled=true;
		if (element.name != "gender" && element.name != "minAge" && element.name != "maxAge" && element.name != "sessStart" && element.name != "sessEnd" && element.name != "locations" && element.name != "issues" && element.name != "location_options" && element.name != "issue_options") {
			document.forms[0].gender.disabled=true;
			document.forms[0].minAge.disabled=true;
			document.forms[0].maxAge.disabled=true;
			document.forms[0].sessStart.disabled=true;
			document.forms[0].sessEnd.disabled=true;
			document.forms[0].locations.disabled=true;
			document.forms[0].issues.disabled=true;
			document.forms[0].location_options.disabled=true;
			document.forms[0].issue_options.disabled=true;
		}
	}
	
	function calculateAttendanceDays(startDate,endDate,to) {
		var weekday=new Array(7), month=new Array(12);
		weekday[0]="Sunday";
		weekday[1]="Monday";
		weekday[2]="Tuesday";
		weekday[3]="Wednesday";
		weekday[4]="Thursday";
		weekday[5]="Friday";
		weekday[6]="Saturday";
		month[0]="January";
		month[1]="February";
		month[2]="March";
		month[3]="April";
		month[4]="May";
		month[5]="June";
		month[6]="July";
		month[7]="August";
		month[8]="September";
		month[9]="October";
		month[10]="November";
		month[11]="December";
		
		var mydate1 = startDate.value.split("/");
		var mydate2 = endDate.value.split("/");
		mydate1[0] -= 1;
		mydate2[0] -= 1;
		
		var d1 = new Date(mydate1[2],mydate1[0],mydate1[1],0,0,0);
		var d2 = new Date(mydate2[2],mydate2[0],mydate2[1],0,0,0);
		var totalDays = 0;
		
		while (d1 <= d2) {
			if (d1.getDay() > 0 && d1.getDay() < 6) totalDays++;
			d1.setDate(d1.getDate()+1);
			console.log(d1.getDate());
		}
		to.value = totalDays;
		document.forms[0].totalAttendances.value = totalDays
	}

	function addAll(from,to,prepend) {
		for (var i=0; i<from.options.length; i++) {
			var added = true;
			if (from.options[i].value != "") {
				for (var ii=0; ii<to.options.length; ii++)
					if (prepend+''+from.options[i].value == to.options[ii].value) added = false;
				if (added) {
					var option = document.createElement('option');
					option.setAttribute('value',prepend+''+from.options[i].value);
					option.text = from.options[i].text;
					to.appendChild(option);
				}
			}
		}
	}

	function addSelected(from,to,prepend) {
		var added = true;
		if (from.options[from.selectedIndex].value != "") {
			for (var i=0; i<to.options.length; i++) {
				if (prepend+''+from.options[from.selectedIndex].value == to.options[i].value) added = false;
			}
			if (added) {
				var option = document.createElement('option');
				option.setAttribute('value',prepend+''+from.options[from.selectedIndex].value);
				option.text = from.options[from.selectedIndex].text;
				to.insertBefore(option,to.options[0]);
			}
		}
	}