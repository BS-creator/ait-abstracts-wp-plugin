jQuery(document).ready(function() {

})

var p_resident_fname, p_resident_lname, p_title;
var p_abstract_info;
var preceptor_cv_uploaded = false;

function submitData() {	
	var fdata = preceptor_validate();
	if(fdata == false) return;
	var post_mail = document.getElementById("presentation_email").value;
	jQuery.post(absScript.pluginsUrl+"/ait-conflict/inc/savedata.php?post_id="+current_post_id+"&post_mail="+post_mail,  fdata,  function(data, status){
		if(data.status == 'success') {
			success_msg('Submitted Successfully!', '')
		}else {
			error_msg('Submitted Unsuccessfully!', '');
		}
	});
}

function preceptor_validate() {
	
	var spouse = jQuery("#spouse_partner").serializeArray();
	var checkboxs = jQuery("#checkboxgroup4 input[type='checkbox']")
	var i = 0;
	for(i=0; i<checkboxs.length; i++) {
		if(!(checkboxs[i].checked)) {
			break;
		}
	}
	var tmp = jQuery("[name='conflict_explanation']").val()
	if(spouse[0].value == 'false' && (tmp=="" || tmp==" ")) {error_msg('Required Explanation of the conflict', ''); return false;}
	else if(i != 3) {error_msg('Required to check all checkbox', ''); return false;}
	
	var signature = document.querySelector("[name='signature']");
	var signature_date = document.querySelector("[name='signature_date']");
	if(!(signature.checkValidity())) {error_msg(jQuery(signature).prev().text() + ' Cannot Be Empty!'); return false;}
	if(!(signature_date.checkValidity())) {error_msg(jQuery(signature_date).prev().text() + ' Cannot Be Empty!'); return false;}
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
	
	if(preceptor_cv_uploaded == false) {
		error_msg('Upload your CV (.doc, .docx, .pdf)', ''); 
		return false;
	} else {
		savedata.push({name: 'cv_upload', value: true });
	}
	return savedata;	
}

function upload_confl() {
	var data = new FormData();
	var signature = document.querySelector("[name='signature']");
	jQuery.each(jQuery('#prec_cv_file')[0].files, function(i, file) {
	    data.append('file-'+i, file);
	});
	jQuery.ajax({
	    url: absScript.pluginsUrl+"/ait-conflict/inc/pres_upload.php?title="+signature.value,
	    data: data,
	    cache: false,
	    contentType: false,
	    processData: false,
	    method: 'POST',
	    type: 'POST', // For jQuery < 1.9
	    success: function(data){
	        if(data.status == 'success'){
		        preceptor_cv_uploaded = true;
		        success_msg('Presentation uploaded successfully !', '');
		}else {
			error_msg(data.status, '')
		}
	    }
	});
}

function retrive_presentation_conflict() {
	var ele = document.getElementById("presentation_email");
	
	if(!(ele.checkValidity())) {
		error_msg('Please enter valid email');
		return false;
	}

	jQuery.post(absScript.pluginsUrl+"/ait-conflict/inc/retrieve.php",  "email="+ele.value,  function(data, status){
		if(data.length == 0) {error_msg('No Abstract Exists'); return;}
		success_msg('Done Successfully', '')
		abstract_info = data;
		for(var i=0; i<data.length; i++){
			var item = data[i];
			if(item.meta_key== "first_name") {
				p_resident_fname = item.meta_value
			}else if (item.meta_key == "last_name") {
				p_resident_lname = item.meta_value
			}else if (item.meta_key == "title") {
				p_title= item.meta_value
			}
			
		}
		
		jQuery("#conflict_part").slideDown()
		
		jQuery("#login_part").hide()
		
	});
}





















