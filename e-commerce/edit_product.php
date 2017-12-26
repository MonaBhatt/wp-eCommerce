<?php

	function edit_product_detail()
	{
		
		global $wpdb;
		if(isset($_POST['submit']))
		{
			$id = $_POST['id'];
			$table_name = $wpdb->prefix . "products";
			$data = [
						'name'	=> $_POST['name'],
						'price'	=> $_POST['price'],
						'qty'	=> $_POST['qty'],
					];
			$wpdb->update($table_name,$data,['id'=>$id],['%s','%d','%d'],['%d']);
			$message = '';
			if($wpdb->affected_rows)
			{
				$message = 'Record has been saved successfully!';
			}
		}
		
		$id = $_GET['id'];
		
		$table_name = $wpdb->prefix . "products";
				
		$row = $wpdb->get_row("SELECT id,name,price,qty from $table_name where id = ".$id);
		
		//form for product add  
		ob_start(); 
		?>
		
		<link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/e-commerce/css/bootstrap.min.css" rel="stylesheet" />
		<div class="container">
			<h2>Product Edit</h2>
			
			<p class="success"> <?php echo $message; ?></p>
			<form method="post">
				<input type="hidden" name="id" value="<?php echo $id; ?>">
				<div class="form-group">
					<label for="name">Name:</label>
					<input type="text" class="form-control" id="name" placeholder="Product Name" name="name" value="<?php echo $row->name; ?>" />
				</div>
				<div class="form-group">
					<label for="price">Price:</label>
					<input type="text" class="form-control" id="price" placeholder="Price" name="price" value="<?php echo $row->price; ?>" />
				</div>
				<div class="form-group">
					<label for="qty">Qty:</label>
					<input type="text" class="form-control" id="qty" placeholder="Enter qty" name="qty" value="<?php echo $row->qty; ?>" />
				</div>
				
				<button type="submit" name="submit" value="submit" class="btn btn-default">Submit</button>
			</form>
		</div>
	<?php 
		$form = ob_get_clean();//it will return the data that has been stored by ob_start() and clean from buffer memory
		echo $form;
	}