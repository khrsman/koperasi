<?php if ($this->session->userdata('status_koperasi') == "0") { ?>
        <div class="alert alert-danger">
            <h4><i class="icon fa fa-ban"></i> Perhatian !</h4>
            Koperasi anda dalam status <strong>Tidak Aktif</strong> Silakan hubungi koperasi anda.
        </div>
<?php } ?>

<div class="row">
<!--     <div class="col-md-4 col-xs-6">
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
    </div> --><!-- ./col -->
</div>
<div class="row">
    <div class="col-md-4 col-xs-6">
        <div class="small-box bg-red">
            <div class="inner">
                <p style="font-size:2em;font-weight:bolder;">Saldo Virtual</p>
                <h3>Rp. <?php $sv = str_replace(".00", "",  $saldo_virtual['saldo']);
                                                                echo number_format($sv,0,".",",") ?></h3>
                    
            </div>
            <div class="icon">
                <i class="fa fa-money"></i>
            </div>
            <a style="font-size:1.2em;color:black;" href="<?= base_url() ?>saldo/virtual" class="small-box-footer">Lihat Log Transaksi <i class="fa fa-arrow-circle-right"></i></a>

        </div>
    </div><!-- ./col -->
    <div class="col-md-4 col-xs-6">
        <div class="small-box bg-green">
            <div class="inner">
                <p style="font-size:2em;font-weight:bolder;">Saldo Tabungan</p>
                <h3>Rp. <?php $st = str_replace(".00", "",  $saldo_tabungan['saldo']);
                                                                echo number_format($st,0,".",",") ?></h3>
            </div>
            <div class="icon">
                <i class="fa fa-money"></i>
            </div>
            <a style="font-size:1.2em;color:black;" href="<?= base_url() ?>saldo/tabungan" class="small-box-footer">Lihat Log Transaksi <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div><!-- ./col -->
    <div class="col-md-4 col-xs-6">
        <div class="small-box bg-aqua">
            <div class="inner">
                <?php $total="0"; foreach ($saldo_loyalti as $r):
                $total = $total+$r->saldo;

                endforeach; ?>
                    <!-- <p>Saldo <?= ucfirst($r->jenis_rekening) ?> : <?= $r->saldo ?> -->
                    <p style="font-size:2em;font-weight:bolder;">Saldo Loyalti</p>
                <h3>Rp. <?php $t = str_replace(".00", "",  $total);
                                                                echo number_format($t,0,".",",") ?></h3>

                
            </div>
            <div class="icon">
                <i class="fa fa-money"></i>
            </div>
            <a style="font-size:1.2em;color:black;" href="<?= base_url() ?>saldo/loyalty" class="small-box-footer"><b>Lihat Log Transaksi <i class="fa fa-arrow-circle-right"></i></b></a>
        </div>
    </div><!-- ./col -->
</div>