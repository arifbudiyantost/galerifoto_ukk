<!DOCTYPE html>
<html>
<head>
	<title>Website Galeri Foto</title>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
</head>
<body>
	<nav class="navbar navbar-expand-lg bg-body-tertiary">
		<div class="container">
			<a class="navbar-brand" href="index.php">GALERImu</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse mt-2" id="navbarNavAltMarkup">
				<ul class="navbar-nav me-auto">
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="index.php">Beranda</a>
					</li>
				</ul>
				<a href="daftar.php" class="btn btn-outline-primary m-1">Daftar</a>
				<a href="masuk.php" class="btn btn-outline-success m-1">Masuk</a>
			</div>
		</div>
	</nav>

	<div class="container py-2">
		<div class="row justify-content-center">
			<div class="col-md-4">
				<div class="card">
					<div class="card-body bg-light">
						<div class="text-center">
							<h5>Daftar Akun Baru</h5><small>GALERImu</small>
						</div>
						<form action="config/aksi_daftar.php" method="POST">
							<div class="form-floating mb-2">
								<input type="text" name="username" class="form-control" id="floatingInput" placeholder="Ismail">
								<label for="floatingInput">Username</label>
							</div>
							<div class="form-floating mb-2">
								<input type="text" name="namalengkap" class="form-control" id="floatingInput" placeholder="Ismail bin Ibrohim">
								<label for="floatingInput">Nama Lengkap</label>
							</div>
							<div class="form-floating mb-2">
								<input type="email" name="email" class="form-control" id="floatingInput" placeholder="Ismail@gmail.com">
								<label for="floatingInput">Email</label>
							</div>
							<div class="form-floating mb-2">
								<input type="text" name="alamat" class="form-control" id="floatingInput" placeholder="Sedayu">
								<label for="floatingInput">Alamat</label>
							</div>
							<div class="form-floating mb-3">
								<input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
								<label for="floatingPassword">Password</label>
							</div>

							<!--label class="form-label">Username</label>
							<input type="text" name="username" class="form-control" required>
							<label class="form-label">Nama Lengkap</label>
							<input type="text" name="namalengkap" class="form-control" required>
							<label class="form-label">Email</label>
							<input type="email" name="email" class="form-control" required>
							<label class="form-label">Alamat</label>
							<input type="text" name="alamat" class="form-control" required>
							<label class="form-label">Password</label>
							<input type="password" name="password" class="form-control" required-->
							<div class="d-grid mt-2">
								<button class="btn btn-primary" type="submit" name="daftar">Daftar</button>
							</div>
						</form>
						<hr>
						<p>Sudah punya akun? <a href="masuk.php">Masuk</a></p>
					</div>
				</div>
			</div>	
		</div>
	</div>

	<footer class="d-flex justify-content-center border-top mt-3 bg-light fixed-bottom">
		<p>&copy; UKK 2024 | Arif Budiyanto</p>
	</footer>

	<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
</body>
</html>