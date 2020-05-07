<?php
	$path = preg_replace('/wp-content.*$/','',__DIR__);
	require_once $path.'wp-load.php';
	
	header("Content-Type: application/json; charset=UTF-8");
//echo (strcmp($_GET['post_mail'], 0)); exit;
	$post = array(
	    'post_title'     => $_POST['first_name']." ".$_POST['last_name'], // The title of your post.
	    'post_status'    => 'publish', // Whatever status you want to have
	    'post_type'      => 'abstraction' // the slug of your custom post type
	); 
	if(strcmp($_GET['post_mail'], 0) == 0) {
		$thisid = wp_insert_post( $post, true ); // insert the post and allow WP_Error object
	}else{
		$query = "SELECT * FROM wp3d_postmeta WHERE meta_value = '".$_GET['post_mail']."' AND meta_key = 'resident_email'";
		$row = $wpdb->get_results($query);
		//print_r($row[0]->post_id);exit;
		$query1 = "SELECT * FROM wp3d_posts WHERE post_status='publish' AND ID = " . $row[0]->post_id;
		$res = $wpdb->get_results($query1);
		if(count($res) != 0){
			$thisid = $res[0]->ID;
		}else {
			$thisid = wp_insert_post( $post, true ); // insert the post and allow WP_Error object
		}
		//print_r($res); exit;
	}
	
	if ( is_wp_error( $thisid ) ) {
	    // Error handling
	    echo json_encode(array('status'=>"fail"));
	    exit;
	} else {
	    // the rest of your code, inserting metadata
	    $savedata = $_POST;
	    foreach($savedata as $key => $val) {
		    update_post_meta( $thisid, $key, $val);
	    }
	    
	}
	
	//echo json_encode(array('aa'=>is_numeric($_GET['post_id'])));
	echo json_encode(array('status'=> 'success'));
	
?>