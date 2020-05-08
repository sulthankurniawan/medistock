<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view("customer/_partials/head.php") ?>
</head>

<body id="page-top">

	<?php $this->load->view("customer/_partials/navbar.php") ?>
	<div id="wrapper">

		<?php $this->load->view("customer/_partials/sidebar.php") ?>

		<div id="content-wrapper">

			<div class="container-fluid">

				<?php $this->load->view("customer/_partials/breadcrumb.php") ?>

				<!-- DataTables -->
				<div class="card mb-3">
					<div class="card-header">
						<a href="<?php echo site_url('customer/products/add') ?>"><i class="fas fa-plus"></i> Add New</a>
					</div>
					<div class="card-body">

						<div class="table-responsive">
							<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
										<th>Name</th>
										<th>Category</th>
										<th>Price</th>
										<th>Photo</th>
										<th>Description</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($products as $product): ?>
									<tr>
										<td width="150">
											<?php echo $product->name ?>
										</td>
										<td>
											<?php echo $product->category ?>
										</td>
										<td>
											<?php echo $product->price ?>
										</td>
										<td>
											<img src="<?php echo base_url('upload/product/'.$product->image) ?>" width="64" />
										</td>
										<td class="small">
											<?php echo substr($product->description, 0, 120) ?>...</td>
										<td width="250">
											<button class="add_cart btn btn-success btn-block" data-product_id="<?php echo $product->product_id ?>" data-product_name="<?php echo $product->name ?>" data-product_category="<?php echo $product->category ?>" data-product_price="<?php echo $product->price ?>">Add To Cart</button>
										</td>
									</tr>
									<?php endforeach; ?>

								</tbody>
							</table>
						</div>
					</div>
				</div>

			</div>
			<!-- shoping cart -->
			<div class="col-md-4">
				<h4>Shopping Cart</h4>
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Produk</th>
							<th>Harga</th>
							<th>Qty</th>
							<th>Subtotal</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody id="detail_cart">

					</tbody>
					
				</table>
			</div>
			<!-- /.container-fluid -->

			

			<!-- Sticky Footer -->
			<?php $this->load->view("customer/_partials/footer.php") ?>

		</div>
		<!-- /.content-wrapper -->

	</div>
	<!-- /#wrapper -->


	<?php $this->load->view("customer/_partials/scrolltop.php") ?>
	<?php $this->load->view("customer/_partials/modal.php") ?>

	<?php $this->load->view("customer/_partials/js.php") ?>

	<script type="text/javascript">
		$(document).ready(function(){
			$('.add_cart').click(function(){
				var product_id    = $(this).data("product_id");
				var name  = $(this).data("product_name");
				var category = $(this).data("product_category");
				var price = $(this).data("product_price");
				var quantity     = $('#' + produk_id).val();
				$.ajax({
					url : "<?php echo base_url() ?>index.php/cart/add_to_cart",
					method : "POST",
					data : {produk_id: produk_id, produk_nama: produk_nama, produk_harga: produk_harga, quantity: quantity},
					success: function(data){
						$('#detail_cart').html(data);
					}
				});
			});

			// Load shopping cart
			$('#detail_cart').load("<?php echo base_url();?>index.php/cart/load_cart");

			//Hapus Item Cart
			$(document).on('click','.hapus_cart',function(){
				var row_id=$(this).attr("id"); //mengambil row_id dari artibut id
				$.ajax({
					url : "<?php echo base_url();?>cart/hapus_cart",
					method : "POST",
					data : {row_id : row_id},
					success :function(data){
						$('#detail_cart').html(data);
					}
				});
			});
		});
	</script>

</body>

</html>
