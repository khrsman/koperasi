<div style="background: rgb(243, 243, 243);margin:0 0 20px 0;font-size:1.3em;padding:10px 10px;border-bottom: 1px solid #C1C1C1;"><strong>MINI CORE BANKING</strong></div>    


<div class="page-header">
Informasi Saldo
</div>
<p>
Silahkan pilih menu di bawah ini untuk melihat informasi transaksi anda.


</p>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="padding:0 10px;">
      <div class="info info_1">
         <p style="font-size:1.3em;font-weight:bolder;">Saldo Virtual</p>
         <p style="font-size:1.7em;font-weight:bolder;color:black;text-align:right;">
            Rp. <?php $sv = str_replace(".00", "",  $saldo_virtual['saldo']);
               echo number_format($sv,0,".",",") ?>
         </p>
         <a style="font-size:1em;color:black;" href="<?= base_url() ?>saldo/virtual" class="small-box-footer pull-right"><b>Lihat Log Transaksi </b><i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="padding:0 10px;">
      <div class="info info_2">
         <p style="font-size:1.3em;font-weight:bolder;">Saldo Tabungan</p>
         <p style="font-size:1.7em;font-weight:bolder;color:black;text-align:right;">
            Rp. <?php $st = str_replace(".00", "",  $saldo_tabungan['saldo']);
               echo number_format($st,0,".",",") ?>
         </p>
         <a style="font-size:1em;color:black;" href="<?= base_url() ?>saldo/tabungan" class="small-box-footer pull-right"><b>Lihat Log Transaksi </b><i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="padding:0 10px;">
        <div class="info info_3">
         <p style="font-size:1.3em;font-weight:bolder;">Saldo Loyalti</p>
         <p style="font-size:1.7em;font-weight:bolder;color:black;text-align:right;">
            <?php $total="0"; foreach ($saldo_loyalti as $r):
               $total = $total+$r->saldo;
               endforeach; ?>
            Rp. <?php $t = str_replace(".00", "",  $total);
               echo number_format($t,0,".",",") ?>
         </p>
         <a style="font-size:1em;color:black;" href="<?= base_url() ?>saldo/loyalty" class="small-box-footer pull-right"><b>Lihat Log Transaksi </b><i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

    

   
<div class="clearfix"></div>
<div class="page-header">
Menu Transfer
</div>
<p>
Silahkan pilih menu di bawah ini untuk melakukan transfer sesama rekening.<br>
<font color="red"><b>Sebelum anda melakukan transfer pastikan anda melakukan penambahan nomor rekening tujuan pada menu daftar transfer favourite</b></font>
</p>
<br>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="padding:0 10px;">
     	<a href="<?= base_url()."transfer_saldo" ?>" >
      		<img src="<?php echo base_url('assets/compro/IMAGE/cover_dashboard/rektorek.png');?>" class="img-responsive" width="100%" style="margin:0 0 5px 0;">
     	</a>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="padding:0 10px;">
     	<a href="<?= base_url()."transfer_saldo/tabungan_virtual" ?>" >
      		<img src="<?php echo base_url('assets/compro/IMAGE/cover_dashboard/tabtovir.png');?>" class="img-responsive" width="100%" style="margin:0 0 5px 0;">
     	</a>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="padding:0 10px;">
     	<a href="<?= base_url()."transfer_saldo/virtual_tabungan" ?>" >
      		<img src="<?php echo base_url('assets/compro/IMAGE/cover_dashboard/virtotab.png');?>" class="img-responsive" width="100%" style="margin:0 0 5px 0;">
     	</a>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="padding:0 10px;">
     	<a href="<?= base_url()."rekening_favorit" ?>" >
      		<img src="<?php echo base_url('assets/compro/IMAGE/cover_dashboard/daftar.png');?>" class="img-responsive" width="100%" style="margin:0 0 5px 0;">
     	</a>
    </div>

