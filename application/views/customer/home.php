<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view("customer/_partials/head.php") ?>
</head>

<body id="page-top">

	<?php $this->load->view("customer/_partials/navbar.php") ?>
	
	<div id="wrapper">
		<div id="content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-8">
						<!-- DataTables -->
						<div class="card mb-8" >
							<div class="card-header">
								<center><h4>Produk yang tersedia</h4></center>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
										<thead>
											<tr>
												<th>Nama Produk</th>
												<th>Kategori</th>
												<th>Harga</th>
												<th>Gambar</th>
												<th>Deskripsi</th>
												<th>Aksi</th>
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
												<td>
													<button class="add_cart btn btn-success btn-block" data-product_id="<?php echo $product->product_id ?>" data-product_name="<?php echo $product->name ?>" data-product_category="<?php echo $product->category ?>" data-product_price="<?php echo $product->price ?>" data-product_quantity=1>Tambah ke keranjang</button>
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
						<div class="card mb-4">
							<div class="card-header">
								<center><h4>Keranjang Belanja</h4></center>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
										<thead>
											<tr>
												<th>Produk</th>
												<th>Harga</th>
												<th>Kuantitas</th>
												<th>Subtotal</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody id="detail_cart">

										</tbody>
									</table>
									<button class="add_cart btn btn-primary btn-block">Pesan</button>
								</div>
							</div>
						</div>
					</div>
					<!-- shoping cart -->
				</div>
			</div>
			<!-- /.container-fluid -->

		</div>
		<!-- /.content-wrapper -->

		

	</div>
	<!-- /#wrapper -->

	<!-- Sticky Footer -->
	<?php $this->load->view("customer/_partials/footer.php") ?>

	<?php $this->load->view("customer/_partials/scrolltop.php") ?>
	<?php $this->load->view("customer/_partials/modal.php") ?>
	<?php $this->load->view("customer/_partials/js.php") ?>

	<script type="text/javascript">
		$(document).ready(function(){
			$('.add_cart').click(function(){
				var product_id = $(this).data("product_id");
				var name = $(this).data("product_name");
				var category = $(this).data("product_category");
				var price = $(this).data("product_price");
				var quantity = $('#' + product_id).val();
				$.ajax({
					url : "<?php echo base_url() ?>index.php/cart",
					method : "POST",
					data : {product_id: product_id, product_name: product_name, product_category: product_category, product_price: product_price, product_quantity: product_quantity},
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
