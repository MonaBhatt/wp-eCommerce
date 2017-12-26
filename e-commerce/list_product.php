<?php

	function list_product()
	{
?>
		<link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/e-commerce/css/bootstrap.min.css" rel="stylesheet" />
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="tablenav top">
						<a href="<?php echo admin_url('admin.php?page=add_product'); ?>">Add New</a>
					</div>
					<br class="clear">
				</div>
			</div>
		</div>
		<?php
			global $wpdb;
			
				$table_name = $wpdb->prefix . "products";
				
				$rows = $wpdb->get_results("SELECT id,name,price,qty from $table_name ORDER BY id DESC");
				
				if($rows)
				{
					
				
					//form for product add
					ob_start();
			?>
			
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h2>List Product</h2>
						<div class="table tabel-responsive">
							<table class="table table-bordered table table-hover">
								<thead>
									<tr>
										<th class="text-centre"> S.No.</th>
										<th class="text-centre"> Name</th>
										<th class="text-centre"> Price</th>
										<th class="text-centre"> Quantity</th>
										<th class="text-centre"> Action</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($rows as $key=>$row) { ?>
										<tr>
											<td class="text-centre"><?php echo $key+1; ?></td>
											<td class="text-centre"><?php echo $row->name; ?></td>
											<td class="text-centre">
												<?php echo $row->price; ?>
											</td>
											<td class="text-centre"><?php echo $row->qty; ?></td>
											<td class="text-centre">
												<a href="<?php echo admin_url('admin.php?page=add_product&id='.$row->id)?>">Edit</a>
												<a href="<?php echo WP_PLUGIN_URL; ?>/e-commerce/delete.php<?php echo '?id='.$row->id?>">Delete</a>
											</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
			</div>
		<?php 
			$form = ob_get_clean();//it will return the data that has been stored by ob_start() and clean from buffer memory
			echo $form;
		}
		else {
			echo "<h1>Oops! No Result Found</h1>";
	}
	}