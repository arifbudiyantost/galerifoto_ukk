<?php  
session_start();
$userid = $_SESSION['userid'];
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
	      //$userid = $_SESSION['userid'];
	      echo "Hai, ". $_SESSION['namalengkap'];
	      ?>
	      <a href="../config/aksi_keluar.php" class="btn btn-outline-danger m-1">Keluar</a>
	    </div>
	  </div>
	</nav>

	<div class="container mt-2">
		<div class="row">
			<?php
			$query = mysqli_query($konek, "SELECT * FROM foto INNER JOIN user ON foto.userid=user.userid INNER JOIN album ON foto.albumid=album.albumid");
				while($data = mysqli_fetch_array($query)){
			?>
			<div class="col-md-3">
				<!-- Button trigger modal -->
				<a type="button" data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['fotoid'] ?>">

					<div class="card mb-2">
						<img src="../assets/img/<?php echo $data['lokasifile'] ?>" class="card-img-top" title="<?php echo $data['judulfoto'] ?>" style="height:12rem;">
						<div class="card-footer text-center">
							<?php
								$fotoid = $data['fotoid'];
								$ceksuka = mysqli_query($konek,"SELECT * FROM likefoto WHERE fotoid='$fotoid' AND userid='$userid'");  
								if (mysqli_num_rows($ceksuka) == 1) { ?>
									<a href="../config/proses_suka.php?fotoid=<?php echo $data['fotoid'] ?>" type="submit" name="batalsuka"><img src="../assets/icons/heart-fill.svg"></a>
							<?php }else{?>
							<a href="../config/proses_suka.php?fotoid=<?php echo $data['fotoid'] ?>" type="submit" name="suka"><img src="../assets/icons/heart.svg"></a>
							<?php }
							//Jumlah Suka
							$suka = mysqli_query($konek, "SELECT * FROM likefoto WHERE fotoid='$fotoid'");
							echo mysqli_num_rows($suka). ' Suka'; 
							?>
							<!-- Jumlah komentar -->
							<a type="button" data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['fotoid'] ?>"><img src="../assets/icons/chat.svg"></a>
							<?php  
								$jmlkomen = mysqli_query($konek, "SELECT * FROM komentarfoto WHERE fotoid='$fotoid'");
								echo mysqli_num_rows($jmlkomen).' Komentar';
							?>
						</div>
			</div>
				</a>
				<!-- Modal -->
				<div class="modal fade" id="komentar<?php echo $data['fotoid'] ?>" tabindex="-1" aria-labelledby="exampleModallabel" aria-hidden="true">
					<div class="modal-dialog modal-xl">
						<div class="modal-content">
							<div class="modal-body">
								<div class="row">
									<div class="col-md-8">
										<img src="../assets/img/<?php echo $data['lokasifile'] ?>" class="card-img-top" title="<?php echo $data['judulfoto'] ?>">
									</div>
									<div class="col-md-4">
										<div class="m-m2">
											<div class="overflow-auto">
												<div class="sticky-top">
													<strong><?php echo $data['judulfoto'] ?></strong><br>
													<span class="badge bg-secondary"><?php echo $data['namalengkap'] ?></span>
													<span class="badge bg-secondary"><?php echo $data['tanggalunggah'] ?></span>
													<span class="badge bg-primary"><?php echo $data['namaalbum'] ?></span>
												</div>
												<hr>
												<p align="left">
													<?php echo $data['deskripsifoto'] ?>
												</p>
												<hr>
												<!-- Menampilkan komentar-->
												<?php
													$fotoid = $data['fotoid'];  
													$komentar = mysqli_query($konek, "SELECT * FROM komentarfoto INNER JOIN user ON komentarfoto.userid=user.userid WHERE komentarfoto.fotoid='$fotoid'" );
													while($row = mysqli_fetch_array($komentar)){
												?>
												<p align="left">
													<strong><?php echo $row['namalengkap'] ?></strong>
													<?php echo $row['isikomentar'] ?>
												</p>
												<?php } ?>
												<hr>
												<!-- Mengisi komentar -->
												<div class="sticky-bottom">
													<form action="../config/proses_komentar.php" method="POST">
														<div class="input-group">
															<input type="hidden" name="fotoid" value="<?php echo $data['fotoid'] ?>">
															<input type="text" name="isikomentar" class="form-control" placeholder="Tambah komentar">
															<div class="input-group-prepend">
																<button type="submit" name="kirimkomentar" class="btn btn-outline-primary">Kirim</button>
															</div>
														</div>
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
				</div>
			</div>

				<?php } ?>
		</div>
	</div>

	<footer class="d-flex justify-content-center border-top mt-3 bg-light fixed-bottom">
		<p>&copy; UKK 2024 | Arif Budiyanto</p>
	</footer>

<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
</body>
</html>