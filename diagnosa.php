<?php include 'header.php'; ?>
<?php mysqli_query($koneksi,"delete from tmp_kecocokan"); ?>

<header id="header" class="ex-header" style="padding-top: 8rem;padding-bottom: 2rem;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Diagnosa</h1>

                <div class="form">
                    <div class="container">

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="text-container">

                                    <h2>Isi data berikut</h2>

                                    <form action="diagnosa_act.php" method="post" data-toggle="validator" data-focus="false">


                                        <div class="form-group">
                                            <input class="form-control-input" autocomplete="off" type="text" name="nama" required>
                                            <label class="label-control" for="nemail">Nama Lengkap</label>
                                            <div class="help-block with-errors"></div>
                                        </div>

                                        <div class="form-group">
                                            <input class="form-control-input" autocomplete="off" type="number" name="hp" required>
                                            <label class="label-control" for="nemail">Nomor HP</label>
                                            <div class="help-block with-errors"></div>
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="form-control-submit-button">SIMPAN</button>
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