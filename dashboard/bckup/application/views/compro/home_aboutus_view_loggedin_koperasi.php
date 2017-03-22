<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
About Us
    </h1>

</section>


<section class="content">
<div class="row">
    <div class="col-md-12">
        <!-- USERS LIST -->
        <div class="box box-primary">
          <div class="contact" style="margin:50px 0px;">
            <div class="container">

                <div class="col-md-7">
                  <div>
                    <h3 class="page-header"><?= $koperasi['nama'] ?></h3>
                  </div>
                  <p>
                    Didirikan pada <?= $koperasi['tgl_berdiri'] ?>
                  </p>
                    <br />
                  <p>
                    <?= $koperasi['keterangan_koperasi'] ?>
                  </p>
                </div>

                <div class="col-md-5">
                  <div>
                    <h3 class="page-header">Alamat</h3>
                    <p>
                        <?= $koperasi['alamat'] ?><br />
                        Telepon : <?= $koperasi['telp'] ?> 
                    </p>
                  </div>
                  <div>
                    <h3 class="page-header">Ketua</h3>
                    <p>
                        <?= ucwords($koperasi['ketua_koperasi']) ?><br />
                        Telepon : <?= $koperasi['ketua_koperasi_telp'] ?>
                    </p>
                  </div>
                </div>
           
            </div>
          </div>
        </div>
        </div>
        </div>
</section>

