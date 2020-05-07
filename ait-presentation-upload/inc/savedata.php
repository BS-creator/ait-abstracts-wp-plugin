<?php
	$path = preg_replace('/wp-content.*$/','',__DIR__);
	require_once $path.'wp-load.php';
	
	header("Content-Type: application/json; charset=UTF-8");

	$post = array(
	    'post_title'     => $_POST['first_name']." ".$_POST['last_name'], // The title of your post.
	    'post_status'    => 'publish', // Whatever status you want to have
	    'post_type'      => 'abstraction' // the slug of your custom post type
	); 
	if($_GET['post_id'] == 0) {
		$thisid = wp_insert_post( $post, true ); // insert the post and allow WP_Error object
	}else{
		$thisid = $_GET['post_id'];
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
	
	echo json_encode(array('aa'=>is_numeric($_GET['post_id'])));
	echo json_encode(array('status'=> 'success'));
	
?>