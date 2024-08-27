<?php include 'header.php'; ?>
<?php mysqli_query($koneksi,"delete from tmp_kecocokan"); ?>

<header id="header" class="ex-header" style="padding-top: 8rem;padding-bottom: 2rem;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Riwayat Diagnosa</h1>
            </div>
        </div>
    </div>
</header>

<div class="container">

    <div class="card mt-5">
        <div class="card-body">
            <div class="table-responsive">             
                <table class="table table-bordered" id="tableku">
                    <thead>
                        <tr>
                            <th width="1%">No</th>
                            <th>Nama</th>
                            <th>No.HP</th>                            
                            <th width="1%">Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no=1;
                        $data = mysqli_query($koneksi,"select * from user order by user.user_id desc");
                        while($d=mysqli_fetch_array($data)){
                            ?>            
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $d['user_nama']; ?></td>
                                <td><?php echo $d['user_hp']; ?></td>                                
                                <td><a class="btn btn-primary" href="diagnosa_hasil_user.php?id=<?php echo $d['user_id']; ?>"> Detail</a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<?php include 'footer.php'; ?>