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

                                    <form action="diagnosa_aksi.php" method="post" class="m-0">
                                        <input type="hidden" name="user" value="<?php echo $_GET['id'] ?>">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>no</th>                                                        
                                                        <th>Gejala</th>
                                                        <th>Nilai</th>
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
                                                        <td style="text-align: left;">[ <?php echo $g['gej_inisial'] ?> ] <?php echo $g['gej_nama'] ?></td>
                                                        <td>
                                                            <input type="hidden" name="gejala[]" value="<?php echo $g['gej_id'] ?>">
                                                            <select class="form-control" name="nilai[]" required>
                                                                <option value="0">Tidak</option>
                                                                <option value="1">Ya</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="3">
                                                        <input type="submit" name="Diagnosa"  value="Diagnosa" class="btn btn-sm btn-primary">
                                                    </th>
                                                </tr>
                                                
                                            </tfoot>
                                            </table>
                                        </div>

                                       
                                           

                                            
                                        </form> 





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