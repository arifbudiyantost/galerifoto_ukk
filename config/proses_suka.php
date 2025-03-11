<?php  
	session_start();
	include 'koneksi.php';
	$fotoid = $_GET['fotoid'];
	$userid = $_SESSION['userid'];

	$ceksuka = mysqli_query($konek,"SELECT * FROM likefoto WHERE fotoid='$fotoid' AND userid='$userid'");
	if (mysqli_num_rows($ceksuka) == 1) {
		while ($row = mysqli_fetch_array($ceksuka)) {
			$likeid = $row['likeid'];
			$query = mysqli_query($konek,"DELETE FROM likefoto WHERE likeid='$likeid'");
			echo "
				<script>
				location.href='../user/index.php';
				</script>
			";
		}
	}else{
		$tgllike = date('Y-m-d');
		$query = mysqli_query($konek, "INSERT INTO likefoto VALUES ('','$fotoid','$userid','$tgllike')" );

		echo "
			<script>
			location.href='../user/index.php';
			</script>
		";
	}

?>