<?php if ($this->session->userdata('status_koperasi') == "0") { ?>
<div class="alert alert-danger">
   <h4><i class="icon fa fa-ban"></i> Perhatian !</h4>
   Koperasi anda dalam status <strong>Tidak Aktif</strong> Silakan hubungi koperasi anda.
</div>
<?php } ?>

<div class="container">
   <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="padding:10px;background:#FFC501;min-height:330px;border-bottom:7px solid #064862">
      <?php   
         $img = base_url()."assets/images/user/default.jpg";
               if($this->session->userdata('foto_user') != NULL){
                      $img =  base_url()."assets/images/user/".$this->session->userdata('foto_user');
               }
         ?>
      <center>
         <br><br>
         <img src="<?php echo $img;?>" class="img-circle" alt="User Image" width="100px;"/>
         <h3><?= $this->session->userdata('nama'); ?></h3>
         <b>
         <?php
            if($this->session->userdata('level')==1){
                echo "Admin";
            }
            else if($this->session->userdata('level')==2){
                echo "Koperasi";
            }
            else if($this->session->userdata('level')==3){
                echo "Anggota Koperasi";
            }
            else if($this->session->userdata('level')==4){
                echo "Komunitas";
            }
            else if($this->session->userdata('level')==5){
                echo "Anggota Komunitas";
            }
            ?>
         <br>
         Login Terakhir : <?php
            $date = new DateTime($this->session->userdata('last_login')); 
            echo $date->format('d M y, H:i:s'); 
            ?>
         </b>
      </center>
   </div>

    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="padding:0 10px;">
      <div class="info info_1">
         <p style="font-size:1.3em;font-weight:bolder;">Saldo Virtual</p>
         <p style="font-size:1.7em;font-weight:bolder;color:black;text-align:right;">
            Rp. <?php $sv = str_replace(".00", "",  $saldo_virtual['saldo']);
               echo number_format($sv,0,".",",") ?>
         </p>
         <a style="font-size:1em;color:black;" href="<?= base_url() ?>saldo/virtual" class="small-box-footer pull-right"><b>Lihat Log Transaksi </b><i class="fa fa-arrow-circle-right"></i></a>
      </div>
      <div class="info info_2">
         <p style="font-size:1.3em;font-weight:bolder;">Saldo Tabungan</p>
         <p style="font-size:1.7em;font-weight:bolder;color:black;text-align:right;">
            Rp. <?php $st = str_replace(".00", "",  $saldo_tabungan['saldo']);
               echo number_format($st,0,".",",") ?>
         </p>
         <a style="font-size:1em;color:black;" href="<?= base_url() ?>saldo/tabungan" class="small-box-footer pull-right"><b>Lihat Log Transaksi </b><i class="fa fa-arrow-circle-right"></i></a>
      </div>
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

    

   <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="padding:0 5px;">
      <a href="<?php echo base_url('banking'); ?>" >
      <img src="<?php echo base_url('assets/compro/IMAGE/cover_dashboard/banking.jpg');?>" class="img-responsive" width="100%" style="margin:0 0 5px 0;">
      </a>
      <a href="<?php echo site_url('gerai/'); ?>">
      <img src="<?php echo base_url('assets/compro/IMAGE/cover_dashboard/serbamurah.jpg');?>" class="img-responsive" width="100%">
      </a>
   </div>
<div class="clearfix"></div>

   
   <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 "  style="padding-left:0px;padding-right:5px;">
      <a href="<?php echo site_url('gerai/pulsa'); ?>">
      <img src="<?php echo base_url('assets/compro/IMAGE/cover_produk/1.png');?>" class="img-responsive" width="100%" style="margin:0 0 5px 0;">
      </a>
      <a href="<?php echo site_url('gerai/pembayaran'); ?>">
      <img src="<?php echo base_url('assets/compro/IMAGE/cover_produk/2.png');?>" class="img-responsive" width="100%">
      </a>
   </div>

   <style type="text/css">
      .row {
        margin-left: 0px; 
        margin-right: 0px;    
      }
   </style>
   <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 " style="">
      <div style="background: rgb(243, 243, 243);font-size:1.3em;padding:10px 10px;border-bottom: 1px solid #C1C1C1;"><strong>LINK CEPAT SERBA MURAH</strong></div>
      <div style="background:rgb(243, 243, 243);padding:0px 0;" class="row">
       <a href="<?php echo site_url('gerai/pulsa'); ?>">
                  <div class="col-md-2 col-centered col-xs-6 text-center box-gerai" style="padding:20px; margin: auto auto; 'background': red">
                     <center>
                        <img src="<?php echo base_url('assets/compro/IMAGE/cover_main/cover_circle_pulsa.png');?>" class="img-responsive" style="width:70%;">
                     </center>
                     <p class="text-center" style="font-size:16px;color:black;margin-bottom:0px;"><strong>Top Up Pulsa</strong></p>
                  </div>
               </a>
               <a href="<?php echo site_url('store'); ?>">
                  <div class="col-md-2 col-centered col-xs-6 text-center box-gerai" style="padding:20px; margin: auto auto; 'background': yellow">
                     <center>
                        <img src="<?php echo base_url('assets/compro/IMAGE/cover_main/cover_circle_online_store.png');?>" class="img-responsive" width="70%">
                        <p class="text-center" style="font-size:16px;color:black;margin-bottom:0px;"><strong>Belanja Online</strong></p>
                     </center>
                  </div>
               </a>
               <a href="<?php echo site_url('store'); ?>">
                  <div class="col-md-2 col-centered col-xs-6 text-center box-gerai" style="padding:20px; margin: auto auto; 'background': yellow">
                     <center>
                        <img src="<?php echo base_url('assets/compro/IMAGE/cover_main/cover_circle_sembako.png');?>" class="img-responsive" width="70%">
                        <p class="text-center" style="font-size:16px;color:black;margin-bottom:0px;"><strong>Sembako</strong></p>
                     </center>
                  </div>
               </a>
               <a href="#">
                  <div class="col-md-2 col-centered col-xs-6 text-center box-gerai" style="padding:20px; margin: auto auto; 'background': yellow">
                     <center>
                        <img src="<?php echo base_url('assets/compro/IMAGE/cover_main/cover_circle_tabungan haji.png');?>" class="img-responsive" width="70%">
                        <p class="text-center" style="font-size:16px;color:black;margin-bottom:0px;"><strong>Tabungan Haji</strong></p>
                     </center>
                  </div>
               </a>
               <a href="<?php echo '#'; ?>">
                  <div class="col-md-2 col-centered col-xs-6 text-center box-gerai" style="padding:20px; margin: auto auto; 'background':#1b69bb">
                     <center>
                        <img src="<?php echo base_url('assets/compro/IMAGE/cover_main/cover_circle_wesel.png');?>" class="img-responsive" width="70%">
                     </center>
                     <p class="text-center" style="font-size:16px;color:black;margin-bottom:0px;"><strong>Wesel Instan</strong></p>
                  </div>
               </a>
               <a href="<?php echo site_url('gerai/pembayaran'); ?>">
                  <div class="col-md-2 col-centered col-xs-6 text-center box-gerai" style="padding:20px; margin: auto auto; 'background': #eb5157">
                     <center>
                        <img src="<?php echo base_url('assets/compro/IMAGE/cover_main/cover_circle_pembayaran.png');?>" class="img-responsive" width="70%">
                     </center>
                     <p class="text-center" style="font-size:16px;color:black;margin-bottom:0px;"><strong>Jasa Pembayaran</strong></p>
                  </div>
               </a>
               <div class="clearfix"></div>
               <a href="<?php echo site_url('gerai/reservasi'); ?>">
               <div class="col-md-2 col-centered col-xs-6 text-center box-gerai" style="padding:20px; margin: auto auto; 'background': purple">
                  <center>
                     <img src="<?php echo base_url('assets/compro/IMAGE/cover_main/cover_circle_reservasi.png');?>" class="img-responsive" width="70%">
                  </center>
                  <p class="text-center" style="font-size:16px;color:black;margin-bottom:0px;"><strong>Reservasi</strong></p>
               </div>
            </a>
            <a href="#">
               <div class="col-md-2 col-centered col-xs-6 text-center box-gerai" style="padding:20px; margin: auto auto; 'background': purple">
                  <center>
                     <img src="<?php echo base_url('assets/compro/IMAGE/cover_main/cover_circle_pinjaman.png');?>" class="img-responsive" width="70%">
                  </center>
                  <p class="text-center" style="font-size:16px;color:black;margin-bottom:0px;"><strong>Pinjaman</strong></p>
               </div>
            </a>
            
            <a href="<?php echo '#'; ?>">
               <div class="col-md-2 col-centered col-xs-6 text-center box-gerai" style="padding:20px;  margin: auto auto; 'background': purple">
                  <center>
                     <img src="<?php echo base_url('assets/compro/IMAGE/cover_main/cover_circle_pegadaian.png');?>" class="img-responsive" width="70%">
                  </center>
                  <p class="text-center" style="font-size:16px;color:black;margin-bottom:0px;"><strong>Pegadaian</strong></p>
               </div>
            </a>
            <a href="https://www.google.co.id/webhp?sourceid=chrome-instant&ion=1&espv=2&ie=UTF-8#q=currency%20rupiah" target="_blank">
               <div class="col-md-2 col-centered col-xs-6 text-center box-gerai" style="padding:20px;  margin: auto auto; 'background': purple">
                  <center>
                     <img src="<?php echo base_url('assets/compro/IMAGE/cover_main/cover_circle_penukaran_uang.png');?>" class="img-responsive" width="70%">
                  </center>
                  <p class="text-center" style="font-size:16px;color:black;margin-bottom:0px;"><strong>Penukaran Uang</strong></p>
               </div>
            </a>
                        <a href="<?php echo '#'; ?>">
               <div class="col-md-2 col-centered col-xs-6 text-center box-gerai" style="padding:20px;  margin: auto auto; 'background': purple">
                  <center>
                     <img src="<?php echo base_url('assets/compro/IMAGE/cover_main/cover_circle_asuransi.png');?>" class="img-responsive" width="70%">
                  </center>
                  <p class="text-center" style="font-size:16px;color:black;margin-bottom:0px;"><strong>Asuransi & Investasi</strong></p>
               </div>
            </a>
            <a href="<?php echo '#'; ?>">
               <div class="col-md-2 col-centered col-xs-6 text-center box-gerai" style="padding:20px;  margin: auto auto; 'background': purple">
                  <center>
                     <img src="<?php echo base_url('assets/compro/IMAGE/cover_main/cover_circle_emas.png');?>" class="img-responsive" width="70%">
                  </center>
                  <p class="text-center" style="font-size:16px;color:black;margin-bottom:0px;"><strong>Emas</strong></p>
               </div>
            </a>
            <div class="clearfix"></div>
            <a href="<?php echo '#'; ?>">
               <div class="col-md-2 col-centered col-xs-6 text-center box-gerai" style="padding:20px;  margin: auto auto; 'background': purple">
                  <center>
                     <img src="<?php echo base_url('assets/compro/IMAGE/cover_main/cover_circle_infaq.png');?>" class="img-responsive" width="70%">
                  </center>
                  <p class="text-center" style="font-size:16px;color:black;margin-bottom:0px;"><strong>Infaq & Zakat</strong></p>
               </div>
            </a>
            <a href="<?php echo site_url('gerai/trading'); ?>">
               <div class="col-md-2 col-centered col-xs-6 text-center box-gerai" style="padding:20px;  margin: auto auto; 'background': purple">
                  <center>
                     <img src="<?php echo base_url('assets/compro/IMAGE/cover_main/cover_circle_tagihan.png');?>" class="img-responsive" width="70%">
                  </center>
                  <p class="text-center" style="font-size:16px;color:black;margin-bottom:0px;"><strong>Trading</strong></p>
               </div>
            </a>
         </div>
   </div>
</div>

      <div class="clearfix"></div>
      <div id="copyrights" style="background-color: white;">
         <div class="container">
            <hr>
            <div class="col-lg-12 col-md-12 col-sm-12">
               <center>
                  <div class="copyright-text ">
                     <p style="color:black;"> Powered by <strong>
                        <img src="<?php echo base_url('assets/compro').'/smi-logo-lite.png'; ?>" class="img-responsives" width="50px">
                        PT SANMADA MEGA INDONESIA
                        </strong> 
                     </p>
                  </div>
                  <!-- end copyright-text -->
               </center>
            </div>
            <!-- end widget -->
         </div>
         <!-- end container -->
      </div>