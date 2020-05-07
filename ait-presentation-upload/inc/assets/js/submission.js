jQuery(document).ready(function() {
	jQuery.get(absScript.pluginsUrl+"/ait-presentation-upload/inc/get_initials.php", function(data, status){
		console.log(data);
		if(data['expiration'].length == 0) {
			error_msg('Expiration Date Unset!', '');
		}else {
			if(data['expiration'].meta_value <= data['expiration'].current_date && !late_submission && window.location.href.indexOf("presentation_upload")!=-1) {
				jQuery(".protect-presentation").show();
				error_msg('Submissions are closed !','Date is Expired',20000, 'toast-top-full-width');
			}
		}
	});
})

var resident_fname, resident_lname, title;
var abstract_info;

function upload_pres() {
	var data = new FormData();

	jQuery.each(jQuery('#pres_file')[0].files, function(i, file) {
	    data.append('file-'+i, file);
	});
	jQuery.ajax({
	    url: absScript.pluginsUrl+"/ait-presentation-upload/inc/pres_upload.php?title="+resident_fname+" "+resident_lname,
	    data: data,
	    cache: false,
	    contentType: false,
	    processData: false,
	    method: 'POST',
	    type: 'POST', // For jQuery < 1.9
	    success: function(data){
	        if(data.status == 'success'){
		        success_msg('Presentation uploaded successfully !', '');
		}else {
			error_msg(data.status, '')
		}
	    }
	});
}

function retrive_presentation () {
	var ele = document.getElementById("presentation_email");
	
	if(!(ele.checkValidity())) {
		error_msg('Please enter valid email');
		return false;
	}

	jQuery.post(absScript.pluginsUrl+"/ait-presentation-upload/inc/retrieve.php",  "email="+ele.value,  function(data, status){
		if(data.length == 0) {error_msg('No Abstract Exists'); return;}
		success_msg('Done Successfully', '')
		abstract_info = data;
		for(var i=0; i<data.length; i++){
			var item = data[i];
			if(item.meta_key== "first_name") {
				resident_fname = item.meta_value
			}else if (item.meta_key == "last_name") {
				resident_lname = item.meta_value
			}else if (item.meta_key == "title") {
				title= item.meta_value
			}
			jQuery(".presentation_view [forkey='"+item.meta_key+"']").text(item.meta_value)
			
		}
		jQuery(".present-section").slideDown()
		jQuery("#presentation_resident").text(resident_fname + " " + resident_lname)
		jQuery("#presentation_title").text(title)
		jQuery("#presentation_dl").attr('href', 'http://glprc.bgsdev.com/wp-content/uploads/abstraction_files/presentation/'+resident_fname+' '+resident_lname+'.pptx')
		
	});
}

function view_abstract() {
	jQuery(".presentation-upload").slideToggle();
}




















