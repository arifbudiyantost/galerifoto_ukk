<?php
include 'koneksi.php';
 
	$username = $_POST['username'];
	$namalengkap = $_POST['namalengkap'];
	$email = $_POST['email'];
	$alamat = $_POST['alamat'];
	$password = md5($_POST['password']);

	$sql = mysqli_query($konek,"INSERT INTO user VALUES ('','$username','$password','$email','$namalengkap','$alamat') ");
	if ($sql) {
		echo "
			<script>
			alert('Pendaftaran akun berhasil');
			location.href='../masuk.php';
			</script>
		";
	}
	
?>