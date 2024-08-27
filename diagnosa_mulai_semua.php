<?php include 'header.php'; ?>
<?php mysqli_query($koneksi,"delete from tmp_kecocokan"); ?>

<header id="header" class="ex-header" style="padding-top: 8rem;padding-bottom: 2rem;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1> Diagnosa</h1>
                 <p class="text-white">Jawab pertanyaan berikut sesuai dengan yang Anda alami.</p>
            </div>
        </div>
    </div>
</header>

<div class="container">
  
   <div class="card mt-5">
    <div class="card-body">

        <div class="alert alert-success">
  <strong>Penting!</strong> Pilih Jawaban <b>Ya</b> atau <b>Tidak</b> untuk setiap gejala berikut :
</div>


        <div class="table-responsive">     
            <form method="post" action="diagnosa_mulai_act.php">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Gejala</th>
                            <th>Jawaban</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no=1;
                        $gejala = mysqli_query($koneksi,"select * from gejala");
                        while($g = mysqli_fetch_array($gejala)){
                            ?>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td>[<?php echo $g['gej_inisial'] ?>] <?php echo $g['gej_nama'] ?></td>
                                <td>
                                  <input type="hidden" name="id_user" value="<?php echo $_GET['id']; ?>">
                                  <input type="number" name="inisial[]" value="<?php echo $g['gej_id'] ?>">
                                    <input type="checkbox" name="nilai[]" value="1"> Ya
                                    <input type="checkbox" name="nilai[]" value="0"> Tidak
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                    

                </table>
                <center>                    
                    <input class="form-control-submit-button mt-5 w-50" type="submit" value="SIMPAN JAWABAN" style="">
                </center>
            </form>
        </div>
    </div>
</div>

</div>

<?php include 'footer.php'; ?>