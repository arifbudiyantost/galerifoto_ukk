<?php  
session_start();
include 'koneksi.php';

$fotoid = $_POST['fotoid'];
$userid = $_SESSION['userid'];
$isikomentar = $_POST['isikomentar'];
$tglkomentar = date('Y-m-d');

$query = mysqli_query($konek, "INSERT INTO komentarfoto VALUES ('','$fotoid','$userid','$isikomentar','$tglkomentar')");
echo "<script>
location.href='../user/index.php';
</script>";
?>