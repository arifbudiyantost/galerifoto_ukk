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
					<div class="card-header">Tambah Foto</div>
					<div class="card-body">
						<form action="../config/aksi_foto.php" method="POST" enctype="multipart/form-data">
							<label class="form-label">Judul Foto</label>
							<input type="text" name="judulfoto" class="form-control" required>
							<label class="form-label">Deskripsi Foto</label>
							<textarea name="deskripsifoto" class="form-control" required></textarea>
							<label class="form-label">Album</label>
							<select class="form-control" name="albumid" required>
								<?php
								$userid = $_SESSION['userid'];  
								$sql_album = mysqli_query($konek,"SELECT * FROM album WHERE userid='$userid'");
								while ($data_album = mysqli_fetch_array($sql_album)) { ?>
									<option value="<?php echo $data_album['albumid'] ?>">
										<?php echo $data_album['namaalbum'] ?>
									</option>
								<?php } ?>
							</select>
							<label class="form-label">File</label>
							<input type="file" name="lokasifile" class="form-control" required>
							<button type="submit" class="btn btn-primary mt-2" name="tambah">Simpan</button>
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-8">
				<div class="card-mt-2">
					<div class="card-header">Data Galeri Foto</div>
					<div class="card-body">
						<table class="table">
							<thead>
								<tr>
									<th>#</th>
									<th>Foto</th>
									<th>Judul Foto</th>
									<th>Deskripsi Foto</th>
									<th>Tanggal Unggah</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php  
									$no = 1;
									$userid = $_SESSION['userid'];
									$sql = mysqli_query($konek, "SELECT * FROM foto WHERE userid='$userid'");
									while ($data = mysqli_fetch_array($sql)) {
								?>
								<tr>
									<td><?php echo $no++ ?></td>
									<td><img src="../assets/img/<?php echo $data['lokasifile'] ?>" width="100"></td>
									<td><?php echo $data['judulfoto'] ?></td>
									<td><?php echo $data['deskripsifoto'] ?></td>
									<td><?php echo $data['tanggalunggah'] ?></td>
									<td>
										<!-- Button trigger modal Edit-->
										<a type="button" data-bs-toggle="modal" data-bs-target="#edit<?php echo $data['fotoid'] ?>">
										  <img src="../assets/icons/pencil.svg" alt="Edit" width="20" height="20">
										</a> | 

										<!-- Modal Edit-->
										<div class="modal fade" id="edit<?php echo $data['fotoid'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
										  <div class="modal-dialog">
										    <div class="modal-content">
										      <div class="modal-header">
										        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Galeri Foto</h1>
										        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										      </div>
										      <div class="modal-body">
										        <form action="../config/aksi_foto.php" method="POST" enctype="multipart/form-data">
										        	<input type="hidden" name="fotoid" value="<?php echo $data['fotoid'] ?>">
										        	<label class="form-label">Judul Foto</label>
																			<input type="text" name="judulfoto" value="<?php echo $data['judulfoto'] ?>" class="form-control" required>
																			<label class="form-label">Deskripsi Foto</label>
																			<textarea name="deskripsifoto" class="form-control" required><?php echo $data['deskripsifoto']; ?></textarea>
																   <label class="form-label">Album</label>
																			<select class="form-control" name="albumid">
																				<?php
																				$userid = $_SESSION['userid'];  
																				$sql_album = mysqli_query($konek,"SELECT * FROM album WHERE userid='$userid'");
																				while ($data_album = mysqli_fetch_array($sql_album)) { ?>
																					<option <?php if($data_album['albumid'] == $data['albumid']) {?> selected="selected" <?php } ?> value="<?php echo $data_album['albumid'] ?>">
																						<?php echo $data_album['namaalbum'] ?>
																					</option>
																				<?php } ?>
																			</select>
																			<label class="form-label">Foto</label>
																			<div class="row">
																				<div class="col-md-4">
																					<img src="../assets/img/<?php echo $data['lokasifile'] ?>" width="100">
																				</div>
																				<div class="col-md-8">
																					<label class="form-label">Ganti File</label>
																					<input type="file" name="lokasifile" class="form-control">
																				</div>
																			</div>

										      </div>
										      <div class="modal-footer">
										        <button type="submit" name="edit" class="btn btn-primary">Edit</button>
										        </form>
										      </div>
										    </div>
										  </div>
										</div>

										<!-- Button trigger modal Hapus-->
										<a type="button" data-bs-toggle="modal" data-bs-target="#hapus<?php echo $data['fotoid'] ?>">
										  <img src="../assets/icons/trash.svg" alt="Hapus" width="20" height="20">
										</a>

										<!-- Modal Hapus-->
										<div class="modal fade" id="hapus<?php echo $data['fotoid'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
										  <div class="modal-dialog">
										    <div class="modal-content">
										      <div class="modal-header">
										        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Album</h1>
										        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										      </div>
										      <div class="modal-body">
										        <form action="../config/aksi_foto.php" method="POST">
										        	<input type="hidden" name="fotoid" value="<?php echo $data['fotoid'] ?>">
										        	Apakah yakin akan menghapus data galeri foto <strong> <?php echo $data['judulfoto'] ?> </strong> ?
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