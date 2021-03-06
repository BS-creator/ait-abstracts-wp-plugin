<?php
	$path = preg_replace('/wp-content.*$/','',__DIR__);
	require_once $path.'wp-load.php';
	
	header("Content-Type: application/json; charset=UTF-8");

	file_upload_callback();	
	
	function file_upload_callback() {
	    //$arr_img_ext = array('image/png', 'image/jpeg', 'image/jpg', 'image/gif');
	    //if (in_array($_FILES['file-0']['type'], $arr_img_ext)) {
            //wp_upload_bits($_FILES['file-0']["name"], null, file_get_contents($_FILES['file-0']["tmp_name"]));
            
            	$wordpress_upload_dir = wp_upload_dir();
		
		$i = 1; // number of tries when the file with the same name is already exists
		
		$file_cv = $_FILES['file-0'];
		$new_file_path = $wordpress_upload_dir['path'] . '/' . $file_cv['name'];
		$new_file_mime = mime_content_type( $file_cv['tmp_name'] );
		$fileType = strtolower(pathinfo($new_file_path ,PATHINFO_EXTENSION));
		$new_file_path = $wordpress_upload_dir['path'] . '/abstraction_files/presentation/' . $_GET['title'] . "." . $fileType;
		if( empty( $file_cv ) ) {
			echo json_encode( array('status'=> 'File is not selected.' ));
			return;
		}
		if( $file_cv['error'] ) {
			echo json_encode( array('status'=> $file_cv['error'] ));
			return;
		}
		if( $file_cv['size'] > wp_max_upload_size() ) {
			echo json_encode( array('status'=> 'It is too large than expected.' ));
			return;
		}
		
		$mime_types = array('application/vnd.openxmlformats-officedocument.presentationml.presentation','application/vnd.ms-powerpoint');
		if( !in_array( $new_file_mime, $mime_types ) ) {
			echo json_encode( array('status'=> 'Only .ppt and .pptx allowed. Not '.$new_file_mime ));
			return;
		}
		//while( file_exists( $new_file_path ) ) {
		//  $i++;
		//  $new_file_path = $wordpress_upload_dir['path'] . '/abstraction_files/presentation/' . $_GET['title'] . '_' . $i . "." . $fileType;
		//}
		
		// looks like everything is OK
		if( move_uploaded_file( $file_cv['tmp_name'], $new_file_path ) ) {
		
		
		  $upload_id = wp_insert_attachment( array(
		    'guid' => $new_file_path,
		    'post_mime_type' => $new_file_mime,
		    'post_title' => $_GET['title'] . "." . $fileType,
		    'post_content' => '',
		    'post_status' => 'inherit'
		  ), $new_file_path );
		
		  // wp_generate_attachment_metadata() won't work if you do not include this file
		  require_once( ABSPATH . 'wp-admin/includes/image.php' );
		
		  // Generate and save the attachment metas into the database
		  wp_update_attachment_metadata( $upload_id, wp_generate_attachment_metadata( $upload_id, $new_file_path ) );
		
		  // Show the uploaded file in browser
		  // wp_redirect( $wordpress_upload_dir['url'] . '/' . basename( $new_file_path ) );
		  
		  global $wpdb;
	          $prefix = $wpdb->prefix;

		  $wpdb->insert( 
	            $prefix."term_relationships", 
	            array( 
	                'object_id' => $upload_id, 
	                'term_taxonomy_id' => 13,
	                ), 
	            array('%d', '%d', '%d') 
	          ); 
		
		}
		
		echo json_encode(array('status'=>'success'));

	}
	
?>