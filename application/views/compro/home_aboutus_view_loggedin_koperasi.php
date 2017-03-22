<section class="grey-wrapper jt-shadow">
      <div class="container">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="general-title">
         <h2>TENTANG KAMI</h2>
         <hr>
          </div>
        </div>
              <div class="clearfix"></div>
              <BR><BR><BR>
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="widget">
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
                </div><!-- end widget -->
            </div><!-- end col-lg-6 -->
            
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="widget">
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

                </div><!-- end widget -->
            </div><!-- end col-lg-6 -->
            
        
    </div><!-- end container -->
    <br><br><br><br><br><br><br><br>
    </section>




