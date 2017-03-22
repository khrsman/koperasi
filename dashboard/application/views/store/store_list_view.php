  <div class="row">

    <div class="col-md-12">
      <div>
        <h4><b><?php echo $koperasi['nama_koperasi']; ?> <small>( ID : <?php echo $koperasi['id_koperasi']; ?> )</small><br>
          <small>
            KEL. <?php echo $koperasi['nama_kelurahan']; ?>, KEC. <?php echo $koperasi['nama_kecamatan']; ?>, <?php echo $koperasi['nama_kabupaten']; ?>, PROV. <?php echo $koperasi['nama_provinsi']; ?><?php echo !empty($koperasi['kode_pos'])?', KODE POS '.$koperasi['kode_pos']:''; ?>
            <br>
            <b>Alamat : <?php echo $koperasi['alamat_koperasi']; ?></b>
          </small>
        </h4>
        <hr>
      </div>
    </div>

    <div class="col-md-4">

      <div style="margin-top:7px">
        <span style="padding:10px;padding:10px;color:black;background:#FFC501" ><font color="black">Saldo Virtual : </font>
           <?php if(get_saldo_virtual()!=FALSE): ?>
             <b style="color:black;">Rp. <?php echo get_saldo_virtual(); ?></b>
           <?php else: ?>
             <b>Tidak Ada.</b>  
           <?php endif; ?>
         </span>
      </div>
    </div>



    <div class="col-md-4">

        <select class="form-control select-redirect">

          <?php foreach($filter_product_category as $k => $v): ?>

            <option value="<?php echo site_url('store/product').update_query_string('filter_product_category',$v['alias']); ?>" <?php if($v['alias']==$param_filter_product_category){echo 'selected';} ?>><?php echo $v['alias']; ?></option>

          <?php endforeach; ?>  

        </select>

    </div>



    <div class="col-md-4">

      <?php  
        $attributes = array('class'=>'form-inline','method'=>'GET');
        echo form_open(site_url('store/product'),$attributes);
      ?>
      <?php search_hidden_query_string_store(); ?>
      <div class="input-group">
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

    <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4" style="margin-top:32px;">

      <?php if($diskon!=0): ?>

      <!-- <div class="label-diskon">-<?php echo $diskon_persen; ?>%</div> -->

      <?php endif; ?>

      <a href="<?php echo site_url('store/product/item').'/'.$v['id_produk']; ?>" title="See product :<?php echo $v['nama_produk'] ?>">
        <img src="<?php echo (!empty($v['foto_path']))?SRC_IMAGE.$v['foto_path']:$dummy_image; ?>" class="img-responsive" style="border:0px;width:270px;height:270px;">

      </a>

      <p></p>

      <div>
        <a href="<?php echo site_url('store/product/item').'/'.$v['id_produk']; ?>" title="See product :<?php echo $v['nama_produk'] ?>">
          <b style="color:black;"><?php echo $v['nama_produk'] ?></b>
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

    if($counter == 3){
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