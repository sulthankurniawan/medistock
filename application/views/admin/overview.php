<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view("admin/_partials/head.php") ?>
</head>
<body id="page-top">

<?php $this->load->view("admin/_partials/navbar.php") ?>

<div id="wrapper">

	<?php $this->load->view("admin/_partials/sidebar.php") ?>

	<div id="content-wrapper">

		<div class="container-fluid">

		<?php $this->load->view("admin/_partials/breadcrumb.php") ?>

			<!-- DataTables -->
			<div class="card mb-3">
				<div class="card-header">
					<center><h4>Pesanan</h4></center>
				</div>
				<div class="card-body">

					<div class="table-responsive">
						<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th>Created At</th>
									<th>Items</th>
									<th>Quantity</th>
									<th>Prices</th>
									<th>Total</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
								<!-- <?//php foreach ($carts as $cart): ?>
								<tr>
									<td>
										<?//php echo $cart->created_at ?>
									</td>
									<td>
										<ol>
										<?//php foreach ($obtains as $obtain): ?>
											<li><?//php echo $obtain->name ?></li>
										<?//php endforeach; ?>
										</ol>    
									</td>
									<td>
										<ol>
										<?//php foreach ($obtains as $obtain): ?>
											<li><?//php echo $obtain->quantity ?></li>
										<?//php endforeach; ?>
										</ol>    
									</td>
									<td>
										<ol>
										<?//php foreach ($obtains as $obtain): ?>
											<li><?//php echo $obtain->price ?></li>
										<?//php endforeach; ?>
										</ol>
									</td>
									<td>
										<?//php echo $cart->total ?>
									</td>
									<td>
										<?//php echo $cart->status ?>
									</td>
								</tr>
								<?//php endforeach; ?> -->
							</tbody>
						</table>
					</div>
				</div>
			</div>

		</div>
		<!-- /.container-fluid -->

		<!-- Sticky Footer -->
		<?php $this->load->view("admin/_partials/footer.php") ?>

	</div>
	<!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->


<?php $this->load->view("admin/_partials/scrolltop.php") ?>
<?php $this->load->view("admin/_partials/modal.php") ?>
<?php $this->load->view("admin/_partials/js.php") ?>
    
</body>
</html>
