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

	<div class="container py-5">
		<div class="row justify-content-center">
			<div class="col-md-4">
				<div class="card">
					<div class="card-body bg-light">
						<div class="text-center">
							<h4>GALERImu</h4><small>v.2024.01</small>
						</div>
						<form action="config/aksi_masuk.php" method="POST">
							<div class="input-group mb-3 mt-4">
								<span class="input-group-text"><img src="assets/icons/person.svg"></span>
								<div class="form-floating">
									<input type="text" name="username" class="form-control" id="floatingInputGroup1" placeholder="Username" required>
									<label for="floatingInputGroup1">Username</label>
								</div>
							</div>
							<div class="input-group mb-3">
								<span class="input-group-text"><img src="assets/icons/shield-lock.svg"></span>
								<div class="form-floating">
									<input type="password" name="password" class="form-control" id="floatingInputGroup1" placeholder="Username" required>
									<label for="floatingInputGroup1">Password</label>
								</div>
							</div>

							<!--label class="form-label">Username</label>
							<input type="text" name="username" class="form-control" required>
							<label class="form-label">Password</label>
							<input type="password" name="password" class="form-control" required-->
							<div class="d-grid mt-2">
								<button class="btn btn-info" type="submit" name="masuk">Masuk</button>
							</div>
						</form>
						<hr>
						<p>Belum punya akun? <a href="daftar.php">Daftar</a></p>
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