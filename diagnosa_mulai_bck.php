<?php include 'header.php'; ?>

<header id="header" class="ex-header" style="padding-top: 8rem;padding-bottom: 2rem;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="form">
                    <div class="container">
                        <p class="text-white">Jawab pertanyaan berikut sesuai dengan yang terjadi pada printer anda.</p>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="text-container">

                                    <?php
                                    $no = 0;
                                    $rule = array();
                                    $alternatif = mysqli_query($koneksi,"select * from alternatif");        
                                    while($ker=mysqli_fetch_array($alternatif)){
                                        $nox = $no++;
                                        ?>

                                        <?php 
                                        $xx = 0;
                                        $id_ker = $ker['alt_id'];
                                        $rule2 = array();
                                        $kecocokan2 = mysqli_query($koneksi,"select * from kecocokan,gejala where kec_gejala=gej_id and kec_alternatif='$id_ker' and kec_nilai=1");        
                                        while($kec2=mysqli_fetch_array($kecocokan2)){
                                            $xxx = $xx++;
                                            array_push($rule2, $kec2['gej_inisial']);
                                        }                                              
                                        array_push($rule, $rule2);
                                        ?>

                                        <?php 

                                    }
                                    ?>

                                    <?php 
                                    if(isset($_GET['gejala'])){
                                        $gejala = $_GET['gejala'];
                                        ?>
                                        <!-- tampilkan pertanyaan pertama -->

                                        <form action="diagnosa_mulai2.php" method="post" class="m-0">
                                            <?php 
                                            $inisial_pertanyaan_selanjutnya = $gejala;                                            
                                            $pertanyaan_pertama = mysqli_query($koneksi,"select * from gejala where gej_inisial='$inisial_pertanyaan_selanjutnya'");
                                            $pp = mysqli_fetch_array($pertanyaan_pertama);
                                            ?>

                                            <div class="row justify-item-center">

                                                <div class="col-12">

                                                    <input type="hidden" name="id_user" value="<?php echo $_GET['id']; ?>">
                                                    <input type="hidden" name="inisial" value="<?php echo $pp['gej_inisial']; ?>">
                                                    <h1 class="mb-5 text-dark"> <?php echo $pp['gej_inisial']; ?> - <?php echo $pp['gej_nama']; ?> ? </h1>

                                                    <br>

                                                </div>

                                                <div class="col-md-6">
                                                    <input type="radio" name="jawaban" value="1" class="form-control" required> YA
                                                </div>

                                                <div class="col-md-6">
                                                    <input type="radio" name="jawaban" value="0" class="form-control" required> TIDAK
                                                </div>

                                                <div class="col-md-12">

                                                    <center>
                                                        <br>
                                                        <input class="form-control-submit-button mt-5 w-50" type="submit" value="SIMPAN JAWABAN" style="">
                                                    </center>

                                                </div>

                                            </div>
                                        </form> 

                                        <?php
                                    }else{
                                        ?>
                                        <!-- tampilkan pertanyaan pertama -->

                                        <form action="diagnosa_mulai2.php" method="post" class="m-0">
                                            <?php 
                                            $inisial_pertanyaan_pertama = $rule[0][0];                                            
                                            $pertanyaan_pertama = mysqli_query($koneksi,"select * from gejala where gej_inisial='$inisial_pertanyaan_pertama'");
                                            $pp = mysqli_fetch_array($pertanyaan_pertama);
                                            ?>

                                            <div class="row justify-item-center">

                                                <div class="col-12">

                                                    <input type="hidden" name="id_user" value="<?php echo $_GET['id']; ?>">
                                                    <input type="hidden" name="inisial" value="<?php echo $pp['gej_inisial']; ?>">
                                                    <h1 class="mb-5 text-dark"><?php echo $pp['gej_inisial']; ?> - <?php echo $pp['gej_nama']; ?> ?</h1>
                                                    <br>

                                                </div>

                                                <div class="col-md-6">
                                                    <input type="radio" name="jawaban" value="1" class="form-control" required> YA
                                                </div>

                                                <div class="col-md-6">
                                                    <input type="radio" name="jawaban" value="0" class="form-control" required> TIDAK
                                                </div>

                                                <div class="col-md-12">

                                                    <center>
                                                        <br>
                                                        <input class="form-control-submit-button mt-5 w-50" type="submit" value="SIMPAN JAWABAN" style="">
                                                    </center>

                                                </div>

                                            </div>
                                        </form>  

                                        <?php
                                    }

                                    ?>






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