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
          <h3 class="page-header"><?= $komunitas['nama'] ?></h3>
        </div>
        <p>
          Didirikan pada <?= $komunitas['tgl_berdiri'] ?>
        </p>
          <br />
        <p>
          <?= $komunitas['keterangan_komunitas'] ?>
        </p>
      </div>

      <div class="col-md-5">
        <div>
          <h3 class="page-header">Alamat</h3>
          <p>
              <?= $komunitas['alamat'] ?><br />
              Telepon : <?= $komunitas['telp'] ?> 
          </p>
        </div>
        <div>
          <h3 class="page-header">Ketua</h3>
          <p>
              <?= ucwords($komunitas['ketua_komunitas']) ?><br />
              Telepon : <?= $komunitas['ketua_komunitas_telp'] ?>
          </p>
        </div>
      </div>
 
  </div>
</div>
        </div>
        </div>
        </div>
</section>

