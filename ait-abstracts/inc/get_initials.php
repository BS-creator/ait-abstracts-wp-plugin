<?php
	$path = preg_replace('/wp-content.*$/','',__DIR__);
	require_once $path.'wp-load.php';
	
	header("Content-Type: application/json; charset=UTF-8");

	$total = array();

	$query = "SELECT * FROM wp3d_postmeta WHERE meta_key = 'expiration_date'";
	$res = $wpdb->get_results($query);
	//print_r($res);
	if(count($res)>0) {
		$res[0]->current_date = date("Ymd");
		$total["expiration"] = $res[0];
	}
	
	$query = "SELECT post_title FROM wp3d_posts WHERE post_type = 'practice_area' AND post_title != 'Auto Draft'";
	$res = $wpdb->get_results($query);
	if(count($res)>0) {
		$total["practice_area"] = $res;
	}
	
	$query = "SELECT post_title FROM wp3d_posts WHERE post_type = 'institution' AND post_title != 'Auto Draft'";
	$res = $wpdb->get_results($query);
	if(count($res)>0) {
		$total["institution"] = $res;
	}
	
	$query = "SELECT meta_value FROM wp3d_postmeta WHERE meta_key = 'resident_email'";
	$res = $wpdb->get_results($query);
	if(count($res)>0) {
		$total["resident_email"] = $res;
	}
	
	echo json_encode($total);
	
?>