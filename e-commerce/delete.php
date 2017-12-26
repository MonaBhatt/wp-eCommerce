<?php
include('../../../wp-load.php');

global $wpdb;
$id = $_GET['id'];
$table_name = $wpdb->prefix . "products";
			
$wpdb->delete($table_name,['id'=>$id]);
header("location:".admin_url('admin.php?page=list-product'));

?>