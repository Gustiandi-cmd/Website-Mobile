<?php 
include 'koneksi.php';
$username = $_POST['username'];
$password = md5($_POST['password']);

$cek = mysqli_query($koneksi,"select * from admin where username='$username' and password='$password'");

if(mysqli_num_rows($cek) > 0){
	session_start();
	$_SESSION['username'] = $username;
	$_SESSION['status'] = "login";
	header("location:admin/");
}else{
	header("location:login.php?alert=gagal");
}
?>