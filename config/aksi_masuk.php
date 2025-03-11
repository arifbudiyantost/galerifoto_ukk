<?php  
session_start();
include 'koneksi.php';

	$username = $_POST['username'];
	$password = md5($_POST['password']);

	$sql = mysqli_query($konek,"SELECT * FROM user WHERE username='$username' AND password='$password'");

	$cek =mysqli_num_rows($sql);
	if ($cek > 0) {
		$data = mysqli_fetch_array($sql);

		$_SESSION['username'] = $data['username'];
		$_SESSION['userid'] = $data['userid'];
		$_SESSION['namalengkap'] = $data['namalengkap'];
		$_SESSION['status'] = 'masuk';

		echo "
			<script>
			location.href='../user/index.php';
			</script>
		";
	} else{
		echo "
			<script>
			alert('Username atau Password Salah!');
			location.href='../masuk.php';
			</script>
		";
	}
?>