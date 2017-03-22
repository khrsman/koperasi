<?php if ($this->session->userdata('status_koperasi') == "0") { ?>
        <div class="alert alert-danger">
            <h4><i class="icon fa fa-ban"></i> Perhatian !</h4>
            Koperasi anda dalam status <strong>Tidak Aktif</strong> Silakan hubungi koperasi anda.
        </div>
<?php } ?>

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
            <a href="<?= base_url() ?>mymemproduk" class="small-box-footer">Lihat Data <i class="fa fa-arrow-circle-right"></i></a>

        </div>
    </div><!-- ./col -->
</div>
<div class="row">
    <div class="col-md-4 col-xs-6">
        <div class="small-box bg-red">
            <div class="inner">
                <h3>Rp. <?= $saldo_virtual['saldo'] ?></h3>
                <p>Saldo Virtual</p>
            </div>
            <div class="icon">
                <i class="fa fa-money"></i>
            </div>
            <a href="<?= base_url() ?>saldo/virtual" class="small-box-footer">Lihat Log Transaksi <i class="fa fa-arrow-circle-right"></i></a>

        </div>
    </div><!-- ./col -->
    <div class="col-md-4 col-xs-6">
        <div class="small-box bg-green">
            <div class="inner">
                <h3>Rp. <?= $saldo_tabungan['saldo'] ?></h3>
                <p>Saldo Tabungan</p>
            </div>
            <div class="icon">
                <i class="fa fa-money"></i>
            </div>
            <a href="<?= base_url() ?>saldo/tabungan" class="small-box-footer">Lihat Log Transaksi <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div><!-- ./col -->
    <div class="col-md-4 col-xs-6">
        <div class="small-box bg-aqua">
            <div class="inner">
                <?php foreach ($saldo_loyalti as $r):?>
                    <p>Saldo <?= ucfirst($r->jenis_rekening) ?> : <?= $r->saldo ?>
                <?php endforeach; ?>
            </div>
            <div class="icon">
                <i class="fa fa-money"></i>
            </div>
            <a href="<?= base_url() ?>saldo/loyalty" class="small-box-footer">Lihat Log Transaksi <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div><!-- ./col -->
</div>