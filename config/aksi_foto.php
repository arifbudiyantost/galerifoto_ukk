<?php  
session_start();
include 'koneksi.php';

if (isset($_POST['tambah'])) {
	$judulfoto = $_POST['judulfoto'];
	$deskripsifoto = $_POST['deskripsifoto'];
	$tanggalunggah = date('Y-m-d');
	$albumid = $_POST['albumid'];
	$userid = $_SESSION['userid'];
	$foto = $_FILES['lokasifile']['name'];
	$tmp = $_FILES['lokasifile']['tmp_name'];
	$lokasi = '../assets/img/';
	$namafoto = rand().'-'.$foto;

	move_uploaded_file($tmp, $lokasi.$namafoto);

	$sql = mysqli_query($konek, "INSERT INTO foto VALUES('','$judulfoto','$deskripsifoto','$tanggalunggah','$namafoto','$albumid','$userid')");

	echo "
		<script>
		alert('Data berhasil disimpan!');
		location.href='../user/foto.php';
		</Script>
	";
}

if (isset($_POST['edit'])) {
	$fotoid = $_POST['fotoid'];
	$judulfoto = $_POST['judulfoto'];
	$deskripsifoto = $_POST['deskripsifoto'];
	$tanggalunggah = date('Y-m-d');
	$albumid = $_POST['albumid'];
	$userid = $_SESSION['userid'];
	$foto = $_FILES['lokasifile']['name'];
	$tmp = $_FILES['lokasifile']['tmp_name'];
	$lokasi = '../assets/img/';
	$namafoto = rand().'-'.$foto;

	if ($foto == null) {
		$sql = mysqli_query($konek, "UPDATE foto SET judulfoto='$judulfoto', deskripsifoto='$deskripsifoto', tanggalunggah='$tanggalunggah', albumid='$albumid' WHERE fotoid='$fotoid'");
	}else{
		$query = mysqli_query($konek, "SELECT * FROM foto WHERE fotoid='$fotoid'");
		$data = mysqli_fetch_array($query);
		if (is_file('../assets/img/'.$data['lokasifile'])) {
			unlink('../assets/img/'.$data['lokasifile']);
		}
		move_uploaded_file($tmp, $lokasi.$namafoto);
		$sql = mysqli_query($konek, "UPDATE foto SET judulfoto='$judulfoto', deskripsifoto='$deskripsifoto', tanggalunggah='$tanggalunggah', lokasifile='$namafoto', albumid='$albumid' WHERE fotoid='$fotoid'");
	}
	echo "
		<script>
		alert('Data berhasil diedit!');
		location.href='../user/foto.php';
		</Script>
	";
}

if (isset($_POST['hapus'])) {
	$fotoid = $_POST['fotoid'];
	$query = mysqli_query($konek, "SELECT * FROM foto WHERE fotoid='$fotoid'");
		$data = mysqli_fetch_array($query);
		if (is_file('../assets/img/'.$data['lokasifile'])) {
			unlink('../assets/img/'.$data['lokasifile']);
		}

		$sql = mysqli_query($konek, "DELETE FROM foto WHERE fotoid='$fotoid'");

		echo "
			<script>
			location.href='../user/foto.php';
			</Script>
		";
	}