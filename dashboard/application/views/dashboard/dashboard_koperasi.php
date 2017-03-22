<?php if(($this->session->userdata('status_koperasi') == "N")){?>
        <div class="alert alert-warning">
            <h4><i class="icon fa fa-warning"></i> Perhatian !</h4>
            Anda belum memilih koperasi, silakan pilih koperasi anda di menu <strong><a href="<?= base_url() ?>profile">Profil</a></strong>
        </div>
<?php } ?>
<?php if ($this->session->userdata('status_koperasi') == "0") { ?>
        <div class="alert alert-danger">
            <h4><i class="icon fa fa-ban"></i> Perhatian !</h4>
            Koperasi induk anda dalam status <strong>Tidak Aktif</strong> Silakan hubungi koperasi anda.
        </div>
<?php } ?>

<div class="row">
    <div class="col-md-12">
         <div class="box box-success table-responsive no-padding">
            <div class="box-header">
              <h3 class="box-title">Jumlah Anggota Berdasarkan Provinsi</h3>
            </div>
            <div class="box-body">
              <canvas id="chartProvinsi" ></canvas>
            </div><!-- /.box-body -->
    </div><!-- /.box -->
    </div>
</div>
<div class="row">
    <div class="col-md-4 col-xs-6">
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3><?= $produk ?></h3>
                <p>Produk</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="<?= base_url() ?>mykopproduk" class="small-box-footer">Lihat Data <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div><!-- ./col -->
    <div class="col-md-4 col-xs-6">
        <div class="small-box bg-green">
            <div class="inner">
                <h3><?= $koperasi ?></h3>
                <p>Cabang Koperasi</p>
            </div>
            <div class="icon">
                <i class="ion ion-ios-world-outline"></i>
            </div>
            <a href="<?= base_url() ?>cabang_koperasi" class="small-box-footer">Lihat Data <i class="fa fa-arrow-circle-right"></i></a>

        </div>
    </div><!-- ./col -->
    <div class="col-md-4 col-xs-6">
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3><?= $anggota ?></h3>
                <p>Anggota</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="<?= base_url() ?>anggota" class="small-box-footer">Lihat Data <i class="fa fa-arrow-circle-right"></i></a>

        </div>
    </div><!-- ./col -->
</div>



