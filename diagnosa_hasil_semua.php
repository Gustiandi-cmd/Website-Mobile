<?php include 'header.php'; ?>

<header id="header" class="ex-header" style="padding-top: 8rem;padding-bottom: 2rem;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Hasil Diagnosa</h1>
                <p class="text-white">Hasil diagnosa Penyakit ginjal dengan metode forward chaining.</p>
                <div class="form">
                    <div class="container">

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="text-container">

                                    <?php 
                                    if(isset($_GET['id_user']) && $_GET['id_user'] != ""){
                                        ?>
                                        <?php 
                                        $id_user = $_GET['id_user'];
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
                                                                $user_input = mysqli_query($koneksi,"select * from user_input,gejala where user_input.gejala=gejala.gej_id and user_input.user='$id_user' and nilai=1");
                                                                while($i=mysqli_fetch_array($user_input)){
                                                                    ?>
                                                                    

                                                                    <li>
                                                                        <?php
                                                                        echo $i['gej_inisial']." - ".$i['gej_nama']; 
                                                                        echo "( Benar - Ya )";

                                                                        ?>
                                                                    </li>                             


                                                                    <?php
                                                                }
                                                                ?>
                                                            </ul>
                                                        </td>
                                                    </tr>    
                                                    <tr>
                                                        <th>PENYAKIT</th>
                                                        <td>
                                                        <?php 
                                                        $hasil = 0;
                                                         $user_input = mysqli_query($koneksi,"select * from user_input,gejala where user_input.gejala=gejala.gej_id and user_input.user='$id_user' and nilai=1");
                                                         while($ui = mysqli_fetch_array($user_input)){
                                                            $gejala =  $ui['gejala'];
                                                            $kecocokan = mysqli_query($koneksi,"select  kec_alternatif from kecocokan where kec_gejala='$gejala' and kec_nilai='1'");
                                                            while($kc = mysqli_fetch_array($kecocokan)){
                                                                $data_penyakit= $kc['kec_alternatif'];
                                                                // echo $data_penyakit."<br>";

                                                                $cek_nilai = mysqli_query($koneksi,"select sum(kec_bobot) as total from kecocokan where kec_alternatif='$data_penyakit'");

                                                                $cn = mysqli_fetch_assoc($cek_nilai);
                                                                  echo $data_penyakit."/";
                                                                echo $cn['total']."<br>";
                                                                
                                                            }

                                                            // $kc = mysqli_fetch_assoc($kecocokan);

                                                            // $penya =  $kc['kec_alternatif'];
                                                            // $bobo =  $kc['kec_bobot']; 

                                                            // $cek_bobot = mysqli_query($koneksi,"select sum(kec_bobot) as total_bobot from kecocokan where kec_gejala='$gejala' and kec_nilai=1 and kec_alternatif='$penya'");

                                                            // $cb = mysqli_fetch_assoc($cek_bobot);
                                                            // $total_bobot =  $cb['total_bobot'];
                                                            // echo $penya." / ";
                                                            // echo $total_bobot." <br> ";
                                                            


                                                            // echo $cb['kec_alternatif']."<br>";                                   
                                                            // $penyakit = mysqli_query($koneksi,"select * from alternatif where alt_id='$penya'");
                                                            // while($pp = mysqli_fetch_array($penyakit)){
                                                            //     echo $pp['alt_nama']."<br>";
                                                            // }

                                                         }
                                                         

                                                         // while($ui = mysqli_fetch_array($user_input)){
                                                         //    if($ui['nilai']==1){
                                                         //        $kriteria_input = $ui['gejala'];
                                                         //        $kecocokan = mysqli_query($koneksi,"select * from kecocokan where kec_gejala='$kriteria_input' and kec_nilai='1'");
                                                         //        echo "Kriteria :".$kriteria_input."<br>";
                                                         //        while($keco = mysqli_fetch_array($kecocokan)){
                                                         //            $bobot = $keco['kec_bobot'];
                                                         //            $penyakit = $keco['kec_alternatif'];
                                                         //            echo "penyakit :".$penyakit."/";
                                                         //            // echo $bobot."<br>";

                                                         //            $hasil_bobot = mysqli_query($koneksi,"select sum(kec_bobot) as total_bobot from kec_alternatif='$penyakit'");
                                                         //            $hb = mysqli_fetch_assoc($hasil_bobot);
                                                         //            echo $hb['total_bobot']."<br>";
                                                         //        }
                                                         //    }
                                                         // }
                                                         ?>
                                                     </td>
                                                    </tr>    
                                                    <?php 
                                                    $hasil = $d['user_hasil'];
                                                    if($hasil != "0"){
                                                        $alternatif = mysqli_query($koneksi,"select * from alternatif where alternatif.alt_id='$hasil'");
                                                        while($k=mysqli_fetch_array($alternatif)){
                                                            ?>
                                                            <tr>
                                                                <th width="30%">HASIL <br/> <small>Forward Chaining</small></th>
                                                                <td><b><?php echo $k['alt_inisial']; ?> - <?php echo $k['alt_nama']; ?></b></td>
                                                            </tr>                    
                                                            <tr>
                                                                <th width="30%">PENYEBAB KERUSAKAN</th>
                                                                <td><?php echo $k['alt_penyebab']; ?></td>
                                                            </tr>    
                                                            <tr>
                                                                <th width="30%">SOLUSI PERBAIKAN</th>
                                                                <td><?php echo $k['alt_solusi']; ?> </td>
                                                            </tr>  

                                                            <?php 
                                                        }
                                                    }else{
                                                        ?>
                                                        <tr>
                                                            <th width="30%">HASIL <br/> <small>Forward Chaining</small></th>
                                                            <td><b><i>Penyakit tidak ditemukan. mungkin printer anda baik-baik saja.</i></b></td>
                                                        </tr>                     
                                                        <tr>
                                                            <th width="30%">PENYEBAB KERUSAKAN</th>
                                                            <td>-</td>
                                                        </tr>    
                                                        <tr>
                                                            <th width="30%">SOLUSI PERBAIKAN</th>
                                                            <td>-</td>
                                                        </tr> 
                                                        <?php 
                                                    }
                                                    ?>
                                                </table>
                                                <?php             
                                            }
                                        }else{
                                            header("location:diagnosa.php");
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