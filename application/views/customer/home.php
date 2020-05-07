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
											<a href="<?php echo site_url('customer/products/edit/'.$product->product_id) ?>"
											 class="btn btn-small"><i class="fas fa-edit"></i> Edit</a>
											<a onclick="deleteConfirm('<?php echo site_url('customer/products/delete/'.$product->product_id) ?>')"
											 href="#!" class="btn btn-small text-primary"><i class="fas fa-trash"></i> Add to cart</a>
										</td>
									</tr>
									<?php endforeach; ?>

								</tbody>
							</table>
						</div>
					</div>
				</div>

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

	<script>
	function deleteConfirm(url){
		$('#btn-delete').attr('href', url);
		$('#deleteModal').modal();
	}
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            
        })
    </script>
</body>

</html>
