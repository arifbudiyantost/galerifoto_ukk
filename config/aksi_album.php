<?php  
session_start();
include 'koneksi.php';

if (isset($_POST['tambah'])) {
	$namaalbum = $_POST['namaalbum'];
	$deskripsi = $_POST['deskripsi'];
	$tanggal = date('Y-m-d');
	$userid = $_SESSION['userid'];

	$sql = mysqli_query($konek, "INSERT INTO album VALUES('','$namaalbum','$deskripsi','$tanggal','$userid')");

	echo "
		<script>
		alert('Data berhasil disimpan!');
		location.href='../user/album.php';
		</Script>
	";
}

if (isset($_POST['edit'])) {
	$albumid = $_POST['albumid'];
	$namaalbum = $_POST['namaalbum'];
	$deskripsi = $_POST['deskripsi'];
	$tanggal = date('Y-m-d');
	$userid = $_SESSION['userid'];

	$sql = mysqli_query($konek, "UPDATE album SET namaalbum='$namaalbum', deskripsi='$deskripsi', tanggalbuat='$tanggal' WHERE albumid='$albumid'");

	echo "
		<script>
		alert('Data berhasil dirubah!');
		location.href='../user/album.php';
		</Script>
	";
}

if (isset($_POST['hapus'])) {
	$albumid = $_POST['albumid'];

	$sql = mysqli_query($konek, "DELETE FROM album WHERE albumid='$albumid'");

	echo "
		<script>
		location.href='../user/album.php';
		</Script>
	";
}

?>