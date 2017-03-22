<style type="text/css">
   .ch-info-wrap {
   height: 163px;
   }
   .ch-info {
   height: 163px;
   }
  .nav-tabs > li.active > a{
    color: black !important;
  }
  .nav-tabs > li.active > a:focus, .nav-tabs > li.active > a {
    color: black !important;
  }
  .tabbable .nav-tabs {
     background: white; 
     
   }
</style>



<div class="clearfix"></div>
<div class=" bumper_image">
   <center>
      <img src="<?php echo base_url('assets/compro/landing_page/bumper.jpg');?>" class="img-responsive" style="">
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

   
      <div class="col-lg-12" style="padding:0px;margin:20px 0;">
                           <div class="doc">
                                <div id="custom_tab" class="tabbable">
                                    <ul class="nav nav-tabs tabs_fitur" >
                                        <li class="active"><a href="#tab1" data-toggle="tab">Tergabung di CIMAHI1</a></li>
                                        <li class=""><a href="#tab2" data-toggle="tab">Produk Kami</a></li>
                                        <li class=""><a href="#tab3" data-toggle="tab">Serba Murah</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab1">
                                          <?php $this->load->view('compro/tab_tergabung');?>
                                        </div>
                                        <div class="tab-pane " id="tab2">
                                           <?php $this->load->view('compro/tab_fitur');?>
                                        </div>
                                        <div class="tab-pane " id="tab3">
                                           <?php $this->load->view('compro/tab_produk');?>
                                        </div>
                                    </div><!-- end tab-content -->
                                </div><!-- end tabbable -->
                            </div>
                            
                            <div class="clearfix"></div>
                            
                                             
                        </div>




          
    <!-- Modal -->
<div id="option" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Pilih Instansi</h4>
      </div>
      <div class="clearfix"></div>
      <div class="modal-body">
         <div class="col-md-12" >
         silahkan pilih instansi / jenis organisasi untuk registrasi data anda.
         <br><br>
         <div class="col-md-6">
          <button type="button" class="btn btn-primary btn-block" onclick=location.href="<?= base_url() ?>auth/choose_register/1">KOPERASI</button>
         </div>
         <div class="col-md-6">
            <button type="button" class="btn btn-success btn-block" onclick=location.href="<?= base_url() ?>auth/choose_register/2">KOMUNITAS</button>
         </div>
         <div class="clearfix"></div>
         </div>
      </div>
      
      <div class="clearfix"></div>
      <div class="modal-footer">
        <div class="col-md-12" style="padding-top: 25px">
         <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
        </div>
      </div>
    </div>

  </div>
</div>






