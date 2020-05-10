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
						<a href="<?php echo site_url('admin/users/add') ?>"><i class="fas fa-plus"></i> Tambah Pengguna Baru </a>
					</div>
					<div class="card-body">

						<div class="table-responsive">
							<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
										<th>Id</th>
										<th>Username</th>
										<th>Email</th>
										<th>Nama Lengkap</th>
										<th>Nomor Telepon</th>
										<th>Login Terakhir</th>
										<th>Gambar</th>
										<th>Waktu Pembuatan</th>
										<th>Jabatan</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($users as $user): ?>
									<tr>
										<td width="150">
											<?php echo $user->user_id ?>
										</td>
										<td>
											<?php echo $user->username ?>
										</td>
										<td>
											<?php echo $user->email ?>
										</td>
										<td>
											<?php echo $user->full_name ?>
										</td>
										<td>
											<?php echo $user->phone ?>
										</td>
										<td>
											<?php echo $user->last_login ?>
										</td>
										<td>
											<img src="<?php echo base_url('upload/user/'.$user->image) ?>" width="64" />
										</td>
										<td>
											<?php echo $user->created_at ?>
										</td>
										<td>
										<?php echo $user->role ?>
										</td>
										<td width="250">
											<a href="<?php echo site_url('admin/users/edit/'.$user->user_id) ?>"
											 class="btn btn-small"><i class="fas fa-edit"></i> Ubah</a>
											<a onclick="deleteConfirm('<?php echo site_url('admin/users/delete/'.$user->user_id) ?>')"
											 href="#!" class="btn btn-small text-danger"><i class="fas fa-trash"></i> Hapus</a>
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
			<?php $this->load->view("admin/_partials/footer.php") ?>

		</div>
		<!-- /.content-wrapper -->

	</div>
	<!-- /#wrapper -->


	<?php $this->load->view("admin/_partials/scrolltop.php") ?>
	<?php $this->load->view("admin/_partials/modal.php") ?>
	<?php $this->load->view("admin/_partials/js.php") ?>

	<script>
	function deleteConfirm(url){
		$('#btn-delete').attr('href', url);
		$('#deleteModal').modal();
	}
	</script>
</body>

</html>
