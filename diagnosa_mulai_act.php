<?php 
include 'koneksi.php';
session_start();

$id_user = $_POST['id_user'];
$inisial = $_POST['inisial'];
$nilai = $_POST['nilai'];
$jumlah_kriteria = count($inisial);

mysqli_query($koneksi,"delete from user_input where user='$id_user'");
for($i=0; $i<$jumlah_kriteria; $i++){
	mysqli_query($koneksi,"insert into user_input values(NULL,'$id_user','$inisial[$i]','$nilai[$i]')");
}
header("location:diagnosa_hasil.php?id_user=$id_user");
// // mysqli_query($koneksi,"delete from user_input where user='$id_user'");
// for($i=0; $i<=count($inisial); $i++){	
// 	// mysqli_query($koneksi,"insert into user_input values(NULL,'$id_user','$inisial[$i]','$nilai[$i]')");
// 	echo $inisial[$i];
// 	// echo $nilai[$i];
// }