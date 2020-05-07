<?php
	$path = preg_replace('/wp-content.*$/','',__DIR__);
	require_once $path.'wp-load.php';
	
	header("Content-Type: application/json; charset=UTF-8");

	$total = array();

	$query = "SELECT * FROM wp3d_postmeta WHERE meta_key = 'presentation_exp'";
	$res = $wpdb->get_results($query);
	//print_r($res);
	if(count($res)>0) {
		$res[0]->current_date = date("Ymd");
		$total["expiration"] = $res[0];
	}
	
	
	echo json_encode($total);
	
?>