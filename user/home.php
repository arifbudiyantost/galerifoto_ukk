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
	      $userid = $_SESSION['userid'];
	      echo "Hai, ". $_SESSION['namalengkap'];
	      ?>
	      <a href="../config/aksi_keluar.php" class="btn btn-outline-danger m-1">Keluar</a>
	    </div>
	  </div>
	</nav>

	<div class="container mt-3">
		Album:
		<?php  
			$album = mysqli_query($konek,"SELECT * FROM album WHERE userid='$userid'");
			while ($row = mysqli_fetch_array($album)){ ?>
				<a href="home.php?albumid=<?php echo $row['albumid'] ?>" class="btn btn-outline-primary">
					<?php echo $row['namaalbum'] ?>
				</a>
			<?php } ?>

		<div class="row">
			<?php
				if (isset($_GET['albumid'])) {
					$albumid = $_GET['albumid'];
					$query = mysqli_query($konek, "SELECT * FROM foto WHERE userid='$userid' AND albumid='$albumid'");
					while ($data = mysqli_fetch_array($query)) { ?>
						<div class="col-md-3 mt-2">
							<div class="card">
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

											$suka = mysqli_query($konek, "SELECT * FROM likefoto WHERE fotoid='$fotoid'");
											echo mysqli_num_rows($suka). ' Suka';
										?>
									<a href=""><img src="../assets/icons/chat.svg"></a> 3 Komentar
								</div>
							</div>
						</div>
					
			<?php } }else{ 
				$query = mysqli_query($konek, "SELECT * FROM foto WHERE userid='$userid'");
				while($data = mysqli_fetch_array($query)){
			?>
			<div class="col-md-3 mt-2">
						<div class="card">
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

										$suka = mysqli_query($konek, "SELECT * FROM likefoto WHERE fotoid='$fotoid'");
										echo mysqli_num_rows($suka). ' Suka';
									?>
								<a href=""><img src="../assets/icons/chat.svg"></a> 3 Komentar
							</div>
						</div>
					</div>
			<?php } } ?>
		</div>
	</div>

	<footer class="d-flex justify-content-center border-top mt-3 bg-light fixed-bottom">
		<p>&copy; UKK 2024 | Arif Budiyanto</p>
	</footer>

<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
</body>
</html>