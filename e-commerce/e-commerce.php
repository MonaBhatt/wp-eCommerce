<?php

	/**
		Plugin Name: e-Commerce Website
		Plugin URI: 
		Description: Plugin for e-Commerce Website Creation
		Author: Mona Bhatt
		Version: 1.0
		Author URI: 
	*/
	// function to create the DB / Options / Defaults					
	function product_options_install() {
	
		global $wpdb;
		
		$table_name = $wpdb->prefix . "products";
		$charset_collate = $wpdb->get_charset_collate();
		$sql = "CREATE TABLE $table_name(
				`id` int(3) AUTO_INCREMENT,
				`name` varchar(50),
				`price` double(10,2),
				`qty` int(10),
				PRIMARY KEY (`id`)
			) $charset_collate; ";
		/* echo $sql;die;  */
		$wpdb->query($sql);
	}
	function product_options_uninstall() {
	
		global $wpdb;
		
		$table_name = $wpdb->prefix . "products";
		$charset_collate = $wpdb->get_charset_collate();
		$sql = "DROP TABLE $table_name;";
		//echo $sql;die;
		$wpdb->query($sql);
	}
	/* ABSPATH: absolute path used to get full path of current directory */
	/*  run the install scripts upon plugin activation */
	register_activation_hook(__FILE__, 'product_options_install');
	register_deactivation_hook(__FILE__, 'product_options_uninstall');

	add_action('admin_menu','add_own_menu');
	
	function add_own_menu()
	{
		/* slug: slug represent to page url. It will come after domain name. */
		
		/* manage_otions: it has full permission ex : read,write,delete,update. */
		
		add_menu_page('eCommerce','eCommerce','manage_options','list-product','list_product');

		/* Explation : add_submenu_page('Parent menu slug','Menu title','Page Title','capabilty','function name'); */
		
		add_submenu_page('list-product','Add Product','Add Product Page','manage_options','add_product','add_product_detail');
	}
	
	
	

	/* Use below code to include files in WordPress */
	
	define('ECOM_ROOTDIR', plugin_dir_path(__FILE__));
	require_once(ECOM_ROOTDIR . 'edit_product.php');
	require_once(ECOM_ROOTDIR . 'add_product.php');
	require_once(ECOM_ROOTDIR . 'list_product.php');