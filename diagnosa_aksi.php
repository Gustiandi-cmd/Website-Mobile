<?php 
include'koneksi.php';
$user = $_POST['user'];
$gejala = $_POST['gejala'];
$nilai = $_POST['nilai'];

// data user
$nama = $_POST['nama'];
$hp = $_POST['hp'];


mysqli_query($koneksi, "insert into user values(null,'$nama','$hp',null)");
$id_terakhir = mysqli_insert_id($koneksi);


for($i=1; $i<count($gejala); $i++){
	$gej = $gejala[$i];
	$nil = $nilai[$i];

	if($nil==1){
		$kecocokan = mysqli_query($koneksi,"select * from kecocokan where kec_gejala='$gej' and kec_nilai='1'");
		while($k = mysqli_fetch_array($kecocokan)){
			$alternatif = $k['kec_alternatif'];
			$bobot = $k['kec_bobot'];
			mysqli_query($koneksi,"insert into user_input values(NULL,'$user','$gej','$nil','$alternatif','$bobot')");
		}

	}
	
}
header("location:diagnosa_hasil_user.php?id=$user");
?>
