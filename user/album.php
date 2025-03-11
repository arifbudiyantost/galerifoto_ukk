<?php  
session_start();
include '../config/koneksi.php';
if ($_SESSION['status'] != 'masuk') {
	echo "
	<script>
	alert('Mohon maaf masuk terlebih dahulu!');
	location.href='../index.php';
	</script>
	";
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Website Galeri Foto</title>
	<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
</head>
<body>
	<nav class="navbar navbar-expand-lg bg-body-tertiary">
		<div class="container">
			<a class="navbar-brand" href="index.php">GALERImu</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse mt-2" id="navbarNavAltMarkup">
				<div class="navbar-nav me-auto">
					<a href="home.php" class="nav-link">Home</a>
					<a href="album.php" class="nav-link">Album</a>
					<a href="foto.php" class="nav-link">Foto</a>  
				</div>
				<?php
				$userid = $_SESSION['userid'];
				echo "Hai, ". $_SESSION['namalengkap'];
				?>
				<a href="../config/aksi_keluar.php" class="btn btn-outline-danger m-1">Keluar</a>
			</div>
		</div>
	</nav>

	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<div class="card mt-2">
					<div class="card-header">Tambah Album</div>
					<div class="card-body">
						<form action="../config/aksi_album.php" method="POST">
							<label class="form-label">Nama Album</label>
							<input type="text" name="namaalbum" class="form-control" required>
							<label class="form-label">Deskripsi</label>
							<textarea name="deskripsi" class="form-control" required></textarea>
							<button type="submit" class="btn btn-primary mt-2" name="tambah">Simpan</button>
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-8">
				<div class="card-mt-2">
					<div class="card-header">Data Album</div>
					<div class="card-body">
						<table class="table">
							<thead>
								<tr>
									<th>#</th>
									<th>Nama Album</th>
									<th>Deskripsi</th>
									<th>Tanggal</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php  
								$no = 1;
								$userid = $_SESSION['userid'];
								$sql = mysqli_query($konek, "SELECT * FROM album WHERE userid='$userid'");
								while ($data = mysqli_fetch_array($sql)) {
									?>
									<tr>
										<td><?php echo $no++ ?></td>
										<td><?php echo $data['namaalbum'] ?></td>
										<td><?php echo $data['deskripsi'] ?></td>
										<td><?php echo $data['tanggalbuat'] ?></td>
										<td>
											<!-- Button trigger modal Edit-->
											<a type="button" data-bs-toggle="modal" data-bs-target="#edit<?php echo $data['albumid'] ?>">
												<img src="../assets/icons/pencil.svg" alt="Edit" width="20" height="20">
											</a> | 

											<!-- Modal Edit-->
											<div class="modal fade" id="edit<?php echo $data['albumid'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<h1 class="modal-title fs-5" id="exampleModalLabel">Edit Album</h1>
															<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
														</div>
														<div class="modal-body">
															<form action="../config/aksi_album.php" method="POST">
																<input type="hidden" name="albumid" value="<?php echo $data['albumid'] ?>">
																<label class="form-label">Nama Album</label>
																<input type="text" name="namaalbum" value="<?php echo $data['namaalbum'] ?>" class="form-control" required>
																<label class="form-label">Deskripsi</label>
																<textarea name="deskripsi" class="form-control" required><?php echo $data['deskripsi']; ?></textarea>
															</div>
															<div class="modal-footer">
																<button type="submit" name="edit" class="btn btn-primary">Edit</button>
															</form>
														</div>
													</div>
												</div>
											</div>

											<!-- Button trigger modal Hapus-->
											<a type="button" data-bs-toggle="modal" data-bs-target="#hapus<?php echo $data['albumid'] ?>">
												<img src="../assets/icons/trash.svg" alt="Hapus" width="20" height="20">
											</a>

											<!-- Modal Hapus-->
											<div class="modal fade" id="hapus<?php echo $data['albumid'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Album</h1>
															<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
														</div>
														<div class="modal-body">
															<form action="../config/aksi_album.php" method="POST">
																<input type="hidden" name="albumid" value="<?php echo $data['albumid'] ?>">
																Apakah yakin akan menghapus data album <strong> <?php echo $data['namaalbum'] ?> </strong> ?
															</div>
															<div class="modal-footer">
																<button type="submit" name="hapus" class="btn btn-danger">Hapus</button>
															</form>
														</div>
													</div>
												</div>
											</div>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

	<footer class="d-flex justify-content-center border-top mt-3 bg-light fixed-bottom">
		<p>&copy; UKK 2024 | Arif Budiyanto</p>
	</footer>

	<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
</body>
</html>