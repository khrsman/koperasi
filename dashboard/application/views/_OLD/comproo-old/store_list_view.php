<?php 
  $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  $actual_link = urlencode($actual_link);
?>

<!-- Carousel
================================================== -->
<div id="myCarousel" class="carousel slide" data-ride="carousel" style="margin-top:65px;">

  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img class="first-slide" src="<?php echo base_url('assets/compro/image/slider/slider_1.png') ?>" alt="First slide">
    </div>
  </div>
  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="fa fa-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="fa fa-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div><!-- /.carousel -->


<div class="container" style="margin:100px;">

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

    <div class="col-md-3">
      
        <select class="form-control select-redirect" style="margin-bottom:7px;">
          <?php foreach($filter_product_category as $k => $v): ?>
            <option value="<?php echo site_url('store/l').update_query_string('filter_product_category',$v['alias']); ?>" <?php if($v['alias']==$param_filter_product_category){echo 'selected';} ?>><?php echo $v['alias']; ?></option>
          <?php endforeach; ?>  
        </select>
      
    </div>

    <div class="col-md-3">

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

  <div class="row multi-columns-row">

    <?php if (!empty($product)): ?>
    <?php foreach($product as $k => $v): ?>
    <?php 
      $price_n = $v['price_n'];
      $price_s = $v['price_s'];
      $str_price_n = number_format($v['price_n'],0,",",".");
      $str_price_s = number_format($v['price_s'],0,",",".");
      $diskon = number_format($price_n-$price_s,0,",",".");;
      $diskon_persen = round(($price_n-$price_s)/$price_n*100);
      $dummy_image = base_url('assets/compro/IMAGE/store/item-store.png');
    ?>
    <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3" style="margin-top:32px;">
      <?php if($diskon!=0): ?>
      <div class="label-diskon">-<?php echo $diskon_persen; ?>%</div>
      <?php endif; ?>
      <a href="<?php echo site_url('store/item').'/'.$v['id_produk']; ?>" title="See product :<?php echo $v['nama_produk'] ?>">
        <img src="<?php echo (!empty($v['foto_path']))?SRC_IMAGE.$v['foto_path']:$dummy_image; ?>" class="img-responsive" style="border:0px;">
      </a>
      <p></p>
      <div>
        <a href="<?php echo site_url('store/item').'/'.$v['id_produk']; ?>" title="See product :<?php echo $v['nama_produk'] ?>">
          <?php echo $v['nama_produk'] ?>
        </a>
      </div>
      
      <font color="#6b6a6a" size="2"><?php echo $v['nama_kategori'] ?> 
        <?php if ($diskon!=0): ?>
        - Rp. <strike><?php echo $str_price_n; ?></strike>
        <?php endif; ?>
      </font>
      <font color="#6b6a6a"><br>
        <?php if ($diskon!=0): ?>
        <b style="color:#d4232b">Rp. <?php echo $str_price_s; ?></b> <small>- hemat Rp. <?php echo $diskon; ?></small>
        <?php else: ?>
        <b style="color:#d4232b">Rp. <?php echo $str_price_n; ?></b>
        <?php endif; ?>
      </font>
      <p></p>
    </div>  
    <?php endforeach; ?>
    <?php endif; ?>
  </div>
</div>



<script type="text/javascript">
  // get your select element and listen for a change event on it
  $('.select-redirect').change(function() {
    // set the window's location property to the value of the option the user has selected
    document.location = $(this).val();
  });
</script>