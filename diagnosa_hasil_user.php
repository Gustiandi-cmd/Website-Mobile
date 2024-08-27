<?php include 'header.php'; ?>
<?php mysqli_query($koneksi,"delete from tmp_kecocokan"); ?>

<header id="header" class="ex-header" style="padding-top: 8rem;padding-bottom: 2rem;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Hasil Diagnosa</h1>
                <p class="text-white">Hasil diagnosa Penyakit Ginjal dengan metode forward chaining.</p>
                <div class="form">
                    <div class="container">

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="text-container">

                                    <?php 
                                    if(isset($_GET['id'])){
                                        ?>
                                        <?php 
                                        $id_user = $_GET['id'];
                                        $data = mysqli_query($koneksi,"select * from user where user.user_id='$id_user'");
                                        $cek = mysqli_num_rows($data);
                                        if($cek>0){
                                            while($d = mysqli_fetch_array($data)){
                                                ?>
                                                <table class="table table-bordered text-left">
                                                    <tr>
                                                        <th width="30%">NAMA PENGGUNA</th>
                                                        <td class="text-uppercase"><?php echo $d['user_nama']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th width="30%">NO. HP</th>
                                                        <td><?php echo $d['user_hp']; ?></td>
                                                    </tr> 
                                                    <tr>
                                                        <th width="30%">JAWABAN PENGGUNA</th>
                                                        <td>
                                                            <ul>
                                                                <?php               
                                                                $user_input = mysqli_query($koneksi,"select * from user_input,gejala where user_input.gejala=gejala.gej_id and user_input.user='$id_user'");
                                                                while($i=mysqli_fetch_array($user_input)){
                                                                    ?>
                                                                    <li>
                                                                        <?php echo $i['gej_inisial']." - ".$i['gej_nama']; ?>

                                                                        <?php 
                                                                        if($i['nilai'] == "0"){
                                                                            echo "( Salah - tidak )";
                                                                        }else{
                                                                            echo "( Benar - ya )";
                                                                        }
                                                                        ?>
                                                                    </li>

                                                                    <?php
                                                                }
                                                                ?>
                                                            </ul>
                                                        </td>
                                                    </tr>        
                                                   
                                                    		<tr>
                                                    			<th width="30%">HASIL <br/> <small>Forward Chaining</small></th>
                                                    			<td>
                                                    				<table>
                                                    					<tr>
                                                    						<th>Penyakit</th>
                                                    						<th>Persentase</th>
                                                    						<th>Penyebab</th>
                                                    						<th>Solusi</th>
                                                                            <th>Probabilitas (%)</th>
                                                    					</tr>

                                                    					 <?php 
                                                    					 $id = $_GET['id'];
                                                    					 $alternatif = mysqli_query($koneksi,"select * from alternatif, user_input where alt_id=alternatif and user='$id' GROUP by alt_id");
                                                    					 while($alt = mysqli_fetch_array($alternatif)){	
                                                    					 	$alternatif_id =  $alt['alt_id'];
                                                    					 	$penjumlahan_bobot = mysqli_query($koneksi,"select sum(bobot) as total_bobot, alternatif from user_input where user_input.alternatif='$alternatif_id' and user_input.user='$id' order by total_bobot asc");
                                                    					 	while($p = mysqli_fetch_array($penjumlahan_bobot)){
                                                    					 		?>
                                                    					 		<tr>
                                                    					 			<td>[<?php echo $alt['alt_inisial'] ?>] <?php echo $alt['alt_nama'] ?></td>
                                                    					 			<td><?php echo $p['total_bobot'] ?></td>
                                                    					 			<td><?php echo $alt['alt_penyebab'] ?></td>
                                                    					 			<td><?php echo $alt['alt_solusi'] ?></td>
                                                                                    <td>
                                                                                        <?php 
                                                                                        $semua = mysqli_query($koneksi,"select sum(kec_bobot) as total_semua from kecocokan where kec_alternatif='$alternatif_id'");
                                                                                        $sm = mysqli_fetch_assoc($semua);

                                                                                        $total_semua =  $sm['total_semua'];
                                                                                        $satu = $p['total_bobot']/$total_semua;
                                                                                        $dua = 100/100;
                                                                                        $error = $satu*$dua;
                                                                                        echo abs(round($error,2));
                                                                                         ?>
                                                                                    </td>
                                                    					 		</tr>
                                                    					 		<?php
                                                    					 	}


                                                    					 }

                                                    					 ?>



                                                    				</table>
                                                    			</td>
                                                    		</tr>                                                                         		
                                                    		

                                                    
                                                </table>
                                                <?php             
                                            }
                                        }
                                    }
                                    ?>

                                    <br>

                                    <center>
                                        <a class="btn btn-primary mt-5 w-50" href="diagnosa.php">DIAGNOSA LAGI</a>
                                    </center>

                                </div> 
                            </div> 
                        </div> 

                    </div> 
                </div> 

            </div>
        </div>
    </div>
</header>

<?php include 'footer.php'; ?>