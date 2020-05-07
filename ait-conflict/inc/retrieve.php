<?php
	$path = preg_replace('/wp-content.*$/','',__DIR__);
	require_once $path.'wp-load.php';
	
	header("Content-Type: application/json; charset=UTF-8");

	$query = "SELECT * FROM wp3d_postmeta WHERE meta_value = '".$_POST['email']."' AND meta_key = 'resident_email'";
	$row = $wpdb->get_results($query);
	//print_r($row[0]->post_id);exit;
	$query1 = "SELECT * FROM wp3d_postmeta WHERE post_id = " . $row[0]->post_id;
	$res = $wpdb->get_results($query1);
	
	//echo json_encode($_POST);
	echo json_encode($res);
	
?>