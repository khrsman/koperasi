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


  <!-- STORE DETAIL START -->
  <div class="row multi-columns-row">

    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
      <?php 
        $qty = $product['qty'];
        $terjual = $product['terjual'];
        $is_out_of_stock = (($qty-$terjual)<=0)?TRUE:FALSE;
        $price_n = $product['price_n'];
        $price_s = $product['price_s'];
        $str_price_n = number_format($product['price_n'],0,",",".");
        $str_price_s = number_format($product['price_s'],0,",",".");
        $diskon = number_format($price_n-$price_s,0,",",".");;
        $diskon_persen = round(($price_n-$price_s)/$price_n*100);
        $dummy_image = base_url('assets/compro/IMAGE/store/item-store.png');
      ?>
      <img src="<?php echo (!empty($product['foto_path']))?SRC_IMAGE.$product['foto_path']:$dummy_image; ?>" class="img-responsive">
    </div>

    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
      
      <div class="row">
        
        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
          <h3 style="margin-bottom:0px"><?php echo $product['nama_produk']; ?></h3>
          <p class="text-muted" style="margin-bottom:0px"><?php echo $product['nama_kategori']; ?></p>
          <?php if($is_out_of_stock==TRUE): ?>
          <label class="label label-danger">Out of Stock</label>
          <?php endif; ?> 
          <h3 style="margin-bottom:0px">Rp. <?php echo $str_price_s; ?></h3>
          <p>
            Harga Normal Rp. <strike><?php echo $str_price_n; ?></strike> 
            <b>Diskon <?php echo $diskon_persen; ?>%</b>,
            hemat Rp. <?php echo $diskon; ?>
          </p>
          <form class="form-horizontal" method="POST" action="<?php echo $form_action_cart; ?>">
            <!-- Text input-->
            <div class="form-group">
              <label class="col-md-2 control-label" for="qty">Jumlah</label>  
              <div class="col-md-3">
                <input id="rowid" name="rowid" type="hidden" value="<?php echo $rowid; ?>">
                <input id="produk" name="produk" type="hidden" value="<?php echo $product['id_produk']; ?>">
                <input id="qty" name="qty_item" type="number" min="1" placeholder="" class="form-control input-md" value="<?php echo $qty_item; ?>" required>
              </div>
            </div>
            <?php if($is_on_cart): ?>
            <a class="btn btn-default" href="<?php echo site_url('store/cart'); ?>"><i class="fa fa-shopping-cart"></i> Lihat Keranjang</a>
            <?php else: ?>
            <button class="btn btn-success" type="submit"><i class="fa fa-shopping-cart"></i> Tambahkan ke Keranjang</button>
            <?php endif; ?>
          </form>          
        </div>

        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
          <p class="text-muted">Penjual</p>
          <h4>
            <a href="#"><b>Gerai Lumrah</b></a>
          </h4>
          <p>
            <small>Bergabung 20 Oktober 2015</small><br>
            <small>Login terakhir 25 Februari 2016</small><br>
            <small>Menerima 100 dari 100 pesanan (100%)</small>
          </p>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <!-- Custom Tabs -->
          <br><br>
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab"><b>Deskripsi</b></a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                <?php echo $product['desk']; ?> 
              </div>
              <!-- /.tab-pane -->
              
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
        </div>

      </div>
      
    </div>

    
      
  </div>
  <!-- STORE DETAIL END -->



</div>


<script type="text/javascript">
  // get your select element and listen for a change event on it
  $('.select-redirect').change(function() {
    // set the window's location property to the value of the option the user has selected
    document.location = $(this).val();
  });
</script>