<div class="clearfix"></div>
<div class=" bumper_image">
   <center>
      <img src="<?php echo base_url('assets/compro/landing_page/komunitas.jpg');?>" class="img-responsive" style="">
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
      <h1 style="background: rgb(243, 243, 243);padding:10px 10px;">KOMUNITAS YANG TERGABUNG</h1>
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
<div class="container">

   
      <?php 
         if($komunitas->num_rows() > 0){
           // var_dump($koperasi->result());
           // die();
           $i = 0;$count = 0;
           foreach ($komunitas->result_array() as $key ) { ?>
       <div class="col-lg-4" style="cursor:pointer;margin:0 0 10px 0;">
        <div class="blog-carousel" style="padding:5px;border:1px solid #DDDDDD;border-bottom: 7px solid #FFC501;">
          <div class="entry">
              <center>
                        <img src="<?php echo SRC_LOGO.$key['foto']; ?>" class="img-responsive" style="max-width:350px;min-height:200px;max-height:200px;" >
                     </center>
                     <br>
          </div><!-- end entry -->
          <div class="blog-carousel-header" style="border-top: 1px solid #DDDDDD;">
              <h3><a href="#" style="color:black;"> <?php echo $key['nama']; ?></a></h3>
              <div class="blog-carousel-meta">
              </div><!-- end blog-carousel-meta -->
          </div><!-- end blog-carousel-header -->
          <div class="blog-carousel-desc">
              <p><strong>Ketua : <?php echo $key['ketua_komunitas']; ?></strong><br>Alamat komunitas : <?php echo $key['alamat']; ?></p>
          </div><!-- end blog-carousel-desc -->
        </div>
      </div>





            <?php  
               $i++;$count++;
               if($count == 3){ $count = 0;?>
            <div class="clearfix"></div>
            <?php }?>
            <?php } }
               
               else{
                 echo '<div class="alert alert-danger" role="alert"><strong>Tidak ada data komunitas saat ini.</strong></div>';
               }
               
               ?>
      </div>
   


</div>
</section>

<!-- end container -->
<div class="clearfix"></div>




