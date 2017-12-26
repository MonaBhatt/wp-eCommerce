<?php

	include('../../../wp-load.php');

	global $wpdb;
	$id = $_GET['id'];
	$table_name = $wpdb->prefix . "school";
				
	$wpdb->delete($table_name,['id'=>$id]);
	header("location:".admin_url('admin.php?page=sinetiks_schools_list'));

?>