<!-- <div class="container" style="margin-top:80px;"> -->



  <div class="row">


     <div class="col-md-4">

        
        <div style="margin-top:7px;">
          <span style="padding:10px !important;color:black;background:#FFC501" ><font color="black">Saldo Virtual : </font>
             <?php if(get_saldo_virtual()!=FALSE): ?>
               <b style="color:black;">Rp. <?php echo get_saldo_virtual(); ?></b>
             <?php else: ?>
               <b>Tidak Ada.</b>  
             <?php endif; ?>
           </span>
        </div>


    </div>

    <div class="col-md-4">

      <?php 
        $session=$this->session->userdata(); 
        if(isset($session['current_store_koperasi_id']) || isset($session['current_store_koperasi_nama'])):
      ?>
      <a href="<?php echo site_url('store/product').'?filter_koperasi='.$session['current_store_koperasi_id']; ?>" class="btn btn-default btn-block"><?php echo $session['current_store_koperasi_nama']; ?></a>
      <?php endif; ?>

    </div>

    <div class="col-md-4">

      <a href="<?php echo site_url('store/koperasi'); ?>" class="btn btn-default btn-block"><i class="fa fa-search"></i>&nbsp; Belanja di Koperasi Lain</a>

    </div>





    <div class="col-md-12">
            
      <hr>

    </div>



  </div>





  <!-- TRANSACTION OK START -->

  <div class="row multi-columns-row">



    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

    
      <?php if(!empty($this->session->flashdata('flash_msg_type'))): ?>
      <div class="row">
        <div class="alert alert-<?php echo $this->session->flashdata('flash_msg_type'); ?> alert-dismissable">
          <?php
            if ($this->session->flashdata('flash_msg_status')==TRUE) {
              echo "<i class='icon fa fa-check'></i>";
            } else{
              echo "<i class='icon fa fa-close'></i>";
            }
          ?>
          <?php echo $this->session->flashdata('flash_msg_text'); ?>
        </div>
      </div>
      <?php endif; ?>


      <center style="margin:80px 0">

        <i class="fa fa-thumbs-up text-muted" style="font-size:64px;"></i>

        <h3 class="text-muted">

          Terimakasih, Pesanan Berhasil Diproses

        </h3>

        <a href="<?php echo site_url('store/product'); ?>" class="btn btn-flat btn-info">Lanjut Belanja</a>

        <a href="<?php echo site_url('store/my_order'); ?>" class="btn btn-flat btn-success">Lihat Pesanan</a>

      </center>

    </div>

      

  </div>

  <!-- TRANSACTION OK END -->







<!-- </div> -->





<script type="text/javascript">

  // get your select element and listen for a change event on it

  $('.select-redirect').change(function() {

    // set the window's location property to the value of the option the user has selected

    document.location = $(this).val();

  });

</script>