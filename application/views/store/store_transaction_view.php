<div class="container" style="margin-top:80px;">



  <div class="row">

    <div class="col-md-6">

      <div style="margin-top:5px;margin-bottom:7px;">

        <a href="<?php echo site_url('store'); ?>"

          class="btn btn-default"

        >

        <b>Produk Gerai Lumrah</b>

        </a>



        <a href="<?php echo site_url('store'); ?>"

          class="btn btn-default"

        >

        <b>Produk Member</b>

        </a>


        <span style="margin-left: 25px;padding:6px" class="bg-orange">Saldo Virtual : 
          <?php if(get_saldo_virtual()!=FALSE): ?>
            <b>Rp. <?php echo get_saldo_virtual(); ?></b>
          <?php else: ?>
            <b>Tidak Ada.</b>  
          <?php endif; ?>
        </span>

      </div>



    </div>



    <div class="col-md-2">

      

        <select class="form-control select-redirect" style="margin-bottom:7px;">

          <?php foreach($filter_product_category as $k => $v): ?>

            <option value="<?php echo site_url('store/l').update_query_string('filter_product_category',$v['alias']); ?>" <?php if($v['alias']==$param_filter_product_category){echo 'selected';} ?>><?php echo $v['alias']; ?></option>

          <?php endforeach; ?>  

        </select>

      

    </div>



    <div class="col-md-4">



      <div class="input-group" style="margin-bottom:7px;">

          <input type="text" class="search-query form-control" placeholder="Search" />

          <span class="input-group-btn">

              <button class="btn btn-info" type="button">

                  <span class="fa fa-search"></span>

              </button>

          </span>

      </div>



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

        <a href="<?php echo site_url('store'); ?>" class="btn btn-flat btn-info">Lanjut Belanja</a>

        <a href="<?php echo URL_DASHBOARD;?>" class="btn btn-flat btn-success">Lihat Pesanan</a>

      </center>

    </div>

      

  </div>

  <!-- TRANSACTION OK END -->







</div>





<script type="text/javascript">

  // get your select element and listen for a change event on it

  $('.select-redirect').change(function() {

    // set the window's location property to the value of the option the user has selected

    document.location = $(this).val();

  });

</script>