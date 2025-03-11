<?php 
	$hostname='localhost';
	$userdb = 'root';
	$passdb = '';
	$namadb = 'db.galerifoto';

	$konek = mysqli_connect($hostname,$userdb,$passdb,$namadb);
	/*if ($konek) {
		echo "Terhubung";
	} else {
		echo "Tidak terhubung";
	}*/
	
?>