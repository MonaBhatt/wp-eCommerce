<?php

	function add_product_detail()
	{
		
		global $wpdb;
		if(!isset($_GET['id']))
		{
		if(isset($_POST['submit']))
		{
			$table_name = $wpdb->prefix . "products";
			$data = [
						'name'	=> $_POST['name'],
						'price'	=> $_POST['price'],
						'qty'	=> $_POST['qty'],
					];
			$wpdb->insert($table_name,$data,['%s','%d','%d']);
			$message = '';
			if($wpdb->insert_id)
			{
				$message = 'Record has been saved successfully!';
			}
		}
		
		//form for product add
		ob_start(); 
		?>
		
		<link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/e-commerce/css/bootstrap.min.css" rel="stylesheet" />
		<div calass="container">
			<h2>Product Add</h2>
			
			<p class="success"> <?php echo $message; ?></p>
			<form method="post">
				<div class="form-group">
					<label for="name">Name:</label>
					<input type="text" class="form-control" id="name" placeholder="Product Name" name="name"  />
				</div>
				<div class="form-group">
					<label for="price">Price:</label>
					<input type="text" class="form-control" id="price" placeholder="Price" name="price" />
				</div>
				<div class="form-group">
					<label for="qty">Qty:</label>
					<input type="text" class="form-control" id="qty" placeholder="Enter qty" name="qty" />
				</div>
				
				<button type="submit" name="submit" value="submit" class="btn btn-default">Submit</button>
			</form>
		</div>
	<?php 
		$form = ob_get_clean();//it will return the data that has been stored by ob_start() and clean from buffer memory
		echo $form;
		}
		else 
		{
			edit_product_detail();
		}
	}