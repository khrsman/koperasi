<?php 

  $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

  $actual_link = urlencode($actual_link);

?>












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



    <div class="col-md-3">

      

        <select class="form-control select-redirect" style="margin-bottom:7px;">

          <?php foreach($filter_product_category as $k => $v): ?>

            <option value="<?php echo site_url('store/l').update_query_string('filter_product_category',$v['alias']); ?>" <?php if($v['alias']==$param_filter_product_category){echo 'selected';} ?>><?php echo $v['alias']; ?></option>

          <?php endforeach; ?>  

        </select>

      

    </div>



    <div class="col-md-3">


      <?php  
        $attributes = array('class'=>'form-inline','method'=>'GET');
        echo form_open(site_url('store/l'),$attributes);
      ?>
      <?php search_hidden_query_string_store(); ?>
      <div class="input-group" style="margin-bottom:7px;">
          <input type="text" class="search-query form-control" placeholder="Search" name='q' value='<?php if(!$keyword){echo '';}else{echo $keyword;} ?>' />
          <span class="input-group-btn">
              <button class="btn btn-info" type="submit">
                  <span class="fa fa-search"></span>
              </button>
          </span>
      </div>
      <?php echo form_close(); ?>



    </div>



    <div class="col-md-12">

      <hr>

    </div>



  </div>



  <div class="row">

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

      <center>

      <?php echo $pagination; ?>

      </center>

    </div>

  </div>



  <div class="row multi-columns-row">



    <?php 
    $counter = 0;
    if (!empty($product)): ?>

    <?php foreach($product as $k => $v): ?>

    <?php 

      $price_n = $v['price_n'];
      $price_s = $v['price_s'];
      $str_price_n = number_format($v['price_n'],0,",",".");
      $str_price_s = number_format($v['price_s'],0,",",".");
      $diskon = number_format($price_n-$price_s,0,",",".");;
      $diskon_persen = ceil(($price_n-$price_s)/$price_n*100);
      $dummy_image = base_url('assets/compro/IMAGE/store/item-store.png');

    ?>

    <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3" style="margin-top:32px;">

      <?php if($diskon!=0): ?>

      <!-- <div class="label-diskon">-<?php echo $diskon_persen; ?>%</div> -->

      <?php endif; ?>

      <a href="<?php echo site_url('store/item').'/'.$v['id_produk']; ?>" title="See product :<?php echo $v['nama_produk'] ?>">
        <img src="<?php echo (!empty($v['foto_path']))?SRC_IMAGE.$v['foto_path']:$dummy_image; ?>" class="img-responsive" style="border:0px;width:270px;height:270px;">

      </a>

      <p></p>

      <div>
        <a href="<?php echo site_url('store/item').'/'.$v['id_produk']; ?>" title="See product :<?php echo $v['nama_produk'] ?>">
          <?php echo $v['nama_produk'] ?>
        </a>

      </div>
      

      <font color="#6b6a6a" size="2"><?php echo $v['nama_kategori'] ?> </font>

      <font color="#6b6a6a"><br>

        <?php if ($diskon!=0): ?>

        <!-- <b style="color:#d4232b">Rp. <?php echo $str_price_n; ?></b> <small class="bg-orange"style="padding:0 5px;"> Rewards Rp. <?php echo $diskon; ?></small> -->
        <b style="color:gray"><?php echo "Harga Pasar : Rp. ".$str_price_n; ?></b><br>
        <b style="color:#d4232b"><?php echo "Harga Member : Rp. ".$str_price_s; ?></b>
        <br><br> <small class="bg-blue"style="padding:0 5px;"> Savings Rp. <?php echo $diskon; ?></small>

        <?php else: ?>

        <b style="color:#d4232b">Rp. <?php echo $str_price_n; ?></b>

        <?php endif; ?>

      </font>


      <p></p>

    </div>  

    



    <?php 

    $counter++;

    if($counter == 4){
      $counter = 0;
      echo "<div class='clear-both'></div>";
    }
    endforeach; ?>

    <?php endif; ?>

  </div>



  <div class="row">

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

      <center>

      <?php echo $pagination; ?>

      </center>

    </div>

  </div>










<script type="text/javascript">

  // get your select element and listen for a change event on it

  $('.select-redirect').change(function() {

    // set the window's location property to the value of the option the user has selected

    document.location = $(this).val();

  });

</script>