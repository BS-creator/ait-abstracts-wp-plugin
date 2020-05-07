var late_submission = getParameterByName('late_submission');

jQuery(document).ready(function() {
	console.log(late_submission)
	jQuery(".ait-step-box:not(:first)").hide();

	//jQuery(".ait-step-box").hide();
	//jQuery(".ait-step-box:nth-child(4)").show();
	
	jQuery("[name='conflict_no']").change(function() {
		if(jQuery(this).val() == 'false') {
			jQuery("[name='conflict_explanation']").removeAttr('disabled')
		}else {
			jQuery("[name='conflict_explanation']").attr('disabled', 'true')
		}
	})
	jQuery(".ait-step-navigation li").click(function() {
		var ok = true;
		var num = jQuery(this).attr('num');
		console.log(num)
		if(retrieved && (num != 1 && num != 5 && num != 6)) {return;}
		var prev_step = current_step;
		console.log(num)
		if(prev_step > num) {
			
		}else if(num != 1 && !retrieved){
			for(var i=1; i<num; i++) {
				current_step = i;
				var form_data = jQuery("#ait-step-"+i+" [name]").serializeArray();
				if(!validate(form_data)) {
					ok = false;
				}else {
				
				}
			}
		}
		if(retrieved) {
			jQuery(".ait-step-box").hide();
			jQuery(".ait-step-box:nth-child("+(num)+")").show();
			current_step = num;
		}else{
			if(ok) {
				current_step = num;
				jQuery(".ait-step-box").hide();
				jQuery(".ait-step-box:nth-child("+(num)+")").show();
				jQuery(this).prevUntil('ul').addClass('active')
				jQuery(this).addClass('active')
				jQuery(this).nextUntil('div').removeClass('active')
			}else {
				current_step = prev_step;
				error_msg('Please fill out all forms of previous steps', '')
			}
		}
	})
	jQuery.get(absScript.pluginsUrl+"/ait-abstracts/inc/get_initials.php", function(data, status){
		console.log(data);
		resident_emails = data['resident_email']
		if(data['expiration'].length == 0) {
			error_msg('Expiration Date Unset!', '');
		}else {
			if(data['expiration'].meta_value <= data['expiration'].current_date && !late_submission && window.location.href.indexOf("abstract-submission")!=-1) {
				jQuery(".protect-submission").show();
				error_msg('Submissions are closed !','Date is Expired',20000, 'toast-top-full-width');
			}
		}
		var institutions = "<option value=''>-- Select an Institution/Site --</option>";
		for(var i=0; i<data.institution.length; i++) {
			institutions += "<option>"+data.institution[i].post_title+"</option>";
		}
		jQuery("select[name='institution_site']").html(institutions);
		
		var practice_areas = "<option value=''>-- Select a Practice Area --</option>";
		for(var i=0; i<data.practice_area.length; i++) {
			practice_areas += "<option>"+data.practice_area[i].post_title+"</option>";
		}
		jQuery("select[name='practice_area']").html(practice_areas);
	});
	
})
var resident_emails;
var current_step = 1;
var totalValues = [];
var cv_uploaded = false;
var retrieved = false;
var preceptor_mail_sent = false;
var current_post_id = 0;
var current_resident_email = 0;

function step(num) {
	console.log(current_step)
	if(retrieved && ((current_step+1) != 1 && (current_step+1)!= 5 && (current_step+1)!= 6)) {return;}
	
	var form_data = jQuery("#ait-step-"+current_step+" [name]").serializeArray();
	if(num>0 && !validate(form_data)){
		return;
	}
	
	if (current_step == 6) return;
	
	jQuery(".ait-step-box").hide();
	current_step = eval(current_step) + eval(num);
	console.log(current_step);
	jQuery(".ait-step-box:nth-child("+current_step+")").show();
	if(num > 0){
		jQuery(".ait-step-navigation li:nth-child("+current_step+")").addClass('active');		
	} else {
		jQuery(".ait-step-navigation li:nth-child("+(1+current_step)+")").removeClass('active');
	}

}

function validate(form_data) {
//return true;

	if(current_step == 3) {
		var answers = ['B', 'D', 'A', 'C', 'A'];
		if(form_data.length != 5) {
			error_msg('Answer', 'Please answer all questions. Select correct answer')
			return false;
		}else {
			for(var i=0; i<answers.length; i++) {
				if(form_data[i].value != answers[i]) {
					var forms = jQuery("#ait-step-3 form");
					var title = jQuery(forms[i]).parent().prev().text();
					error_msg('Wrong Answer', 'Please select correct answer in '+ title);
					return false;
				}
			}
		}
		savedata = [];	
		savedata.push({name: 'answered_questions', value: true});
		submit_abstract(savedata);
	} else if(current_step == 4) {
		console.log(form_data);
		var spouse = jQuery("#spouse_partner").serializeArray();
		console.log(spouse)
		var checkboxs = jQuery("#checkboxgroup4 input[type='checkbox']")
		var i = 0;
		for(i=0; i<checkboxs.length; i++) {
			if(!(checkboxs[i].checked)) {
				break;
			}
		}
		var tmp = jQuery("[name='conflict_explanation']").val()
		if(spouse[0].value == 'false' && (tmp=="" || tmp==" ")) {error_msg('Required Explanation of the conflict', ''); return false;}
		else if(i != 3) {error_msg('Required to check all checkboxes', ''); return false;}
		
		if(!preceptor_mail_sent) {error_msg('Please submit preceptor email!'); return false;}
		var signature = document.querySelector("[name='signature']");
		var signature_date = document.querySelector("[name='signature_date']");
		// if(!(signature.checkValidity())) {error_msg(jQuery(signature).prev().text() + ' Cannot Be Empty!'); return false;}
		// if(!(signature_date.checkValidity())) {error_msg(jQuery(signature_date).prev().text() + ' Cannot Be Empty!'); return false;}
		var disclosure_signed = false;
		if(signature.checkValidity() && signature_date.checkValidity()) { disclosure_signed = true; }	
		var savedata = [];
		var tmp = jQuery("[name='conflict_explanation']").val()
		savedata.push({name: 'conflict_explanation', value: tmp });
		savedata.push({name: 'signature', value: signature.value });
		savedata.push({name: 'signature_date', value: signature_date.value });
		savedata.push({name: 'disclosure_signed', value: disclosure_signed });
		var conflict_no = jQuery("[name='conflict_no']").val();
		if(conflict_no == true) {savedata.push({name: 'conflict_no', value: true });}
		else{savedata.push({name: 'conflict_yes', value: true });}
		submit_abstract(savedata);
		
	} else if(current_step == 5) {
		if(cv_uploaded == false) {
			error_msg('Upload your CV (.doc, .docx, .pdf)', ''); 
			return false;
		} else {
			var savedata = [];
			savedata.push({name: 'cv_upload', value: true });
			submit_abstract(savedata);
		}
	} else if(current_step == 6 || current_step == 1) {
		for(var x=0; x<form_data.length; x++) {
			var item = form_data[x]	
			var ele = document.querySelector("#ait-step-"+current_step+" [name='"+ item.name +"']");
			
			console.log(ele)		
			console.log(ele.checkValidity())
	
			if(!(ele.checkValidity())) {
				error_msg(jQuery(ele).prev().text() + ' Cannot Be Empty!');
				return false;
			}
		}
		var form_data = jQuery("#ait-step-"+current_step+" [name]").serializeArray();
		if(current_step == 6) {
			var answer1 = jQuery("#answer1").serializeArray();
			var answer2 = jQuery("#answer2").serializeArray();
			var off_label_use_form = jQuery("#off_label_use_form").serializeArray();
			if(answer1.length == 0) {error_msg('Select an answer of question 1', '');return false;}
			else if(answer2.length == 0) {error_msg('Select an answer of question 2', '');return false;}
			else if(off_label_use_form.length == 0) {error_msg('Label Off', 'Yes or No? Select one choice');return false;}
			var now = new Date();
			form_data.push({name: 'submit_date', value: now.getFullYear()+"-"+eval(now.getMonth()+1)+"-"+now.getDate() });
		} else if(current_step == 1) {
			var cur_resident_email = jQuery("[name='resident_email']").val();
			var check = resident_emails.find(function(email) {
				return email.meta_value == cur_resident_email;
			})
			if(check != undefined) {error_msg('Resident Email already exists'); return false;}
		}
		submit_abstract(form_data );
	}
	
	return true;
}
var submitted = false;
function submit_abstract(step_data) {	

	var post_mail = (current_resident_email==0) ? jQuery("[name='resident_email']").val() :current_resident_email;
	console.log(step_data);
	console.log(post_mail)
	jQuery.post(absScript.pluginsUrl+"/ait-abstracts/inc/savedata.php?post_id="+current_post_id+"&post_mail="+post_mail,  step_data,  function(data, status){
		if(data.status == 'success') {
			submitted = true;
			success_msg('Submitted Successfully!', '')
		}else {
			error_msg('Submitted Unsuccessfully!', '');
		}
	});
	
}

function upload_cv() {
	var names = jQuery("#ait-step-1 [name]").serializeArray();
	var data = new FormData();

	jQuery.each(jQuery('#cv_file')[0].files, function(i, file) {
	    data.append('file-'+i, file);
	});
	jQuery.ajax({
	    url: absScript.pluginsUrl+"/ait-abstracts/inc/cv_upload.php?title="+ names[0].value+" " + names[1].value,
	    data: data,
	    cache: false,
	    contentType: false,
	    processData: false,
	    method: 'POST',
	    type: 'POST', // For jQuery < 1.9
	    success: function(data){
	        if(data.status == 'success'){
		        cv_uploaded = true;
		        jQuery("#currentcv_link").attr('href', 'http://glprc.bgsdev.com/wp-content/uploads/abstraction_files/students_cv/'+jQuery("[name='first_name']").val()+' '+jQuery("[name='last_name']").val()+'.docx')
		        success_msg('CV uploaded successfully !', '');
		}else {
			error_msg(data.status, '')
		}
	    }
	});
}

function retrieve() {
	var ele = document.getElementById('retrieve_email');
	if(!ele.checkValidity()) { error_msg('Please type valid email','');  return; }
	
	jQuery.post(absScript.pluginsUrl+"/ait-abstracts/inc/retrieve.php",  "email="+ele.value,  function(data, status){
		console.log(data);
		if(data.length != 0) {
			success_msg('Retrieved successfully', '');
			
			current_post_id = data[0]['post_id'];
			//current_resident_email = data[0]['resident_email'];
			
			var resident_fname, resident_lname;
			
			for(var i=0; i<data.length; i++){
				jQuery("[name='"+data[i]['meta_key']+"']").val(data[i]['meta_value']);
				if(data[i]['meta_key'] == 'self_assessment1_q1_answer') {
					jQuery("#answer1 input").eq(data[i]['meta_value'].charCodeAt(0)-65).attr('checked', 'checked');
				}else if(data[i]['meta_key'] == 'self_assessment2_q2_answer') {
					jQuery("#answer2 input").eq(data[i]['meta_value'].charCodeAt(0)-65).attr('checked', 'checked');
				}else if(data[i]['meta_key'] == "answered_questions" && data[i]['meta_value'] == "true" ) {
					jQuery("#radio1_2, #radio2_4, #radio3_1, #radio4_3, #radio5_1").attr('checked', 'checked');
				}else if(data[i]['meta_key'] == "conflict_yes") {
					jQuery("#part1_2").attr('checked', 'checked');
					jQuery("#part1_1").removeAttr('checked', 'checked'); 
					jQuery("#check_1, #check_2, #check_3").attr('checked', 'checked'); 
					jQuery("[name='conflict_explanation']").removeAttr('disabled')
				}else if(data[i]['meta_key'] == "conflict_no") {
					jQuery("#part1_1").attr('checked', 'checked');
					jQuery("#part1_2").removeAttr('checked', 'checked'); 
					jQuery("#check_1, #check_2, #check_3").attr('checked', 'checked'); 
				}else if(data[i]['meta_key'] == "cv_upload") {
					cv_uploaded == true;
				}else if(data[i]['meta_key'] == "resident_email") {
					current_resident_email = data[i]['meta_value'];
				}else if(data[i]['meta_key'] == "first_name") {
					resident_fname = data[i]['meta_value']
				}else if (data[i]['meta_key'] == "last_name") {
					resident_lname = data[i]['meta_value']
				}
				
				if(data[i]['meta_key'] == "submit_date") {
					retrieved = true;
				}
			}
			jQuery("#currentcv_link").attr('href', 'http://glprc.bgsdev.com/wp-content/uploads/abstraction_files/students_cv/'+resident_fname +' '+resident_lname +'.docx')
			if(retrieved) {
				jQuery(".ait-step-navigation li").removeClass('active');
				jQuery(".ait-step-navigation li").eq(0).addClass('active');
				jQuery(".ait-step-navigation li").eq(4).addClass('active');
				jQuery(".ait-step-navigation li").eq(5).addClass('active');
			}else { jQuery(".ait-step-navigation li").addClass('active'); }
		
		} else { 
			error_msg('Can\'t find abstract', '') 
			for(var i=0; i<data.length; i++){
				jQuery("[name='"+data[i]['meta_key']+"']").val('');
			}
		}
	});
}

function mailToPreceptor() {
	var ele = document.getElementById("preceptor_email");
	var rele = document.getElementById("retype_preceptor_email");
	console.log(ele.value, rele.value);
	if(!ele.checkValidity()) { error_msg('Please type valid email','');  return; }
	if(ele.value != rele.value) { error_msg('Please ensure Preceptor\'s email address matches','');  return; }
	var mailbody = "As the project preceptor for a resident(s) presenting at the Great Lakes Pharmacy Resident Conference, you are required to submit a copy of your CV and conflict of interest as it pertains to your resident’s presentation. Please take a moment to complete the forms by following the below link. Your timely submission is a required component of your resident’s registration process.         LINK:  http://glprc.bgsdev.com/conflictofinterest/";
	window.open('mailto:'+ele.value+'?subject=subject&body='+mailbody+'');
	preceptor_mail_sent = true
	
}

function error_msg(title, msg, timeout, position) {
	if(!msg) msg= '';
	if(!timeout) timeout = 1000;
	if(!position) position= 'toast-top-right';
	toastr.options = {
            positionClass: position,
            timeOut: timeout,
            onclick: null,
        };

	toastr['warning'](msg, title);
}


function success_msg(title, msg) {
	toastr.options = {
            positionClass: 'toast-top-right',
            timeOut: 1000,
            onclick: null,
        };

	toastr['success'](msg, title);
}

function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, '\\$&');
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url);
    if (!results) return false;
    if (!results[2]) return false;
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
}


















