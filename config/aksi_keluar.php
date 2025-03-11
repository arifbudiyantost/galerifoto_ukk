<?php  
session_start();
session_destroy();
	echo "
		<script>
		alert('Apakah akan keluar dari halaman ini?');
		location.href='../index.php';
		</script>
	";
?>