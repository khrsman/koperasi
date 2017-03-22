<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/compro/compro.css">
<div class="clearfix"></div>
<div class=" bumper_image">
   <center>
      <img src="<?php echo base_url('assets/compro/landing_page/koperasi.jpg');?>" class="img-responsive" style="">
   </center>
</div>
<div class="clearfix"></div>
<div class="main_about_us" style="padding: 10px 0;border-bottom:1px solid #D4D4D4;background: #064862;color: white;font-size: 18px;">
   <div class="container">
      <div class="row">
         <div class="col-md-12 col-xs-12">
            <div class="text-center">
               <marquee>
                  <b>MEMBANGUN JARINGAN KERJASAMA BISNIS KOPERASI INDONESIA</b>
               </marquee>
            </div>
         </div>
      </div>
   </div>
</div>

    <div class="col-md-7 col-xs-12" style="padding:0px;" >
      <h1 style="background: rgb(243, 243, 243);padding:10px 10px;">KOPERASI YANG TERGABUNG CIMAHI1</h1>
    </div>
   <div class="col-md-5 col-xs-12" style="padding:0px;" >
    <div class="widget text-widget"  style="padding:23px;">
                    <form action="#" class="search_form">
                        <input type="text" class="form-control" placeholder="Pencarian Koperasi">     
                    </form><!-- end search form -->
                </div>
      
   </div>
  <div class="clearfix"></div>
  

<section class="white-wrapper" style="padding: 20px 0;">
<div class="row">
      <?php 
         if($koperasi->num_rows() > 0){
           $i = 0;$count = 0;
           foreach ($koperasi->result_array() as $key ) { ?>
      <div class="col-lg-6 col-md-6">
        <div class="row no-margin">
          <div class="list-compro">
            <div class="col-lg-4 col-md-4 no-padding">
              <a href="<?php echo base_url('koperasi/'.$key['id_koperasi'].'/'.convert_to_url($key['nama'])) ?>">
                <div class="compro-thumbnail" style="background-image: url(<?php echo SRC_LOGO.$key['foto'] ?>)"></div>
              </a>
            </div>
            <div class="col-lg-8 col-md-8 no-padding">
              <div class="compro-title">
                 <a href="<?php echo base_url('koperasi/'.$key['id_koperasi'].'/'.convert_to_url($key['nama'])) ?>"><?php echo $key['nama']; ?></a>
              </div>
              <div class="compro-desc">
                  <p class="captions"><span>Alamat : </span><?php echo $key['alamat']; ?></p>
                  <p class="captions"><span>No. Telp : </span><?php echo $key['telp']; ?></p>
              </div><!-- end blog-carousel-desc -->
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
      <?php  
         $i++;
         ?>
      <?php } 
        }else{
           echo '<div class="alert alert-danger" role="alert"><strong>Tidak ada data komunitas saat ini.</strong></div>';
        }
        ?>
</div>
</section>

<!-- end container -->
<div class="clearfix"></div>




