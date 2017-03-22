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

      <a href="<?php echo site_url('store/product').'?filter_koperasi='.$koperasi['id_koperasi']; ?>" class="btn btn-default btn-block"><i class="fa fa-shopping-bag" style="margin-right:7px"></i>Lihat Produk Lain</a>

    </div>

    <div class="col-md-4">
    <?php
      $session = $this->session->userdata();
      if ($session['level']==3 || $session['level']==1):
    ?>
      <a href="<?php echo site_url('store/koperasi'); ?>" class="btn btn-default btn-block"><i class="fa fa-search"></i>&nbsp; Belanja di Koperasi Lain</a>
    <?php endif; ?>
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

        

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

          <h3 style="margin-bottom:0px"><?php echo $product['nama_produk']; ?></h3>

          <p class="text-muted" style="margin-bottom:0px"><?php echo $product['nama_kategori']; ?></p>


           <h4>
              <b style="color:gray"><?php echo "Harga Pasar : Rp. ".$str_price_n; ?></b>
           </h4>
          <h3 style="margin-bottom:0px"><b style="color:#d4232b"><?php echo "Harga Member : Rp. ".$str_price_s; ?></b></h3><br>
          <small style="padding:0 5px;"><b> Savings Rp. <?php echo $diskon; ?></b></small>


          <!-- <h3 style="margin-bottom:0px">Rp. <?php echo $str_price_n; ?></h3> -->
          <!-- <p>
            <span class="bg-orange"style="padding:0 5px;">Rewards Rp. <?php echo $diskon; ?></span>
          </p> -->


          <?php if(has_koperasi()!=FALSE): ?>
          <form class="form-horizontal" method="POST" action="<?php echo $form_action_cart; ?>">

            <!-- Text input-->

            <br>

            <?php if($is_out_of_stock!=TRUE): ?>
                <?php
                  $session = $this->session->userdata();
                  if ($session['level']==3 || $session['level']==1):
                ?>
                    <?php if(!$is_on_cart): ?>
                    <div class="form-group">
                      <label class="col-md-2 control-label" for="qty">Jumlah</label>  

                      <div class="col-md-3">

                        <input id="rowid" name="rowid" type="hidden" value="<?php echo $rowid; ?>">

                        <input id="produk" name="produk" type="hidden" value="<?php echo $product['id_produk']; ?>">

                        <input id="qty" name="qty_item" type="number" min="1" placeholder="" class="form-control input-md" value="<?php echo $qty_item; ?>" required>

                      </div>
                    </div>
                    <?php endif; ?>

                    <?php if($is_on_cart): ?>

                    <a class="btn btn-default" href="<?php echo site_url('store/cart'); ?>"><i class="fa fa-shopping-cart"></i> Lihat Keranjang</a>

                    <?php else: ?>

                    <button class="btn btn-success" type="submit"><i class="fa fa-shopping-cart"></i> Tambahkan ke Keranjang</button>

                    <?php endif; ?>

                <?php endif; ?>                    

            <?php else: ?>

                 <a class="btn btn-default" disabled>Produk Habis</a>

            <?php endif; ?>



          </form>
          <?php endif; ?>          

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







<!-- </div> -->





<script type="text/javascript">

  // get your select element and listen for a change event on it

  $('.select-redirect').change(function() {

    // set the window's location property to the value of the option the user has selected

    document.location = $(this).val();

  });

</script>