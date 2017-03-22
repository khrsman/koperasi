<?php 

  $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

  $actual_link = urlencode($actual_link);

?>






<div class="clearfix"></div>
<div class=" bumper_image">
   <center>
      <img src="<?php echo base_url('assets/compro/IMAGE/slider/slider_1.png');?>" class="img-responsive" style="">
   </center>
</div>
<div class="clearfix"></div>
<div class="main_about_us" style="padding: 10px 0;border-bottom:1px solid #D4D4D4;background: #064862;color: white;font-size: 18px;">
   <div class="container">
      <div class="row">
         <div class="col-md-12 col-xs-12">
            <div class="text-center">
               <marquee>
                  <b>Welcome to our offical website. We gives people better ways to connect to their money and to each other.</b>
               </marquee>
            </div>
         </div>
      </div>
   </div>
</div>

<section class="grey-wrapper jt-shadow" style="padding: 20px 30px;">


  





  <div class="row">


          <div class="general-title">
         <h2>BELANJA ONLINE</h2>
         <hr>
      </div>


      <div class="col-md-12 col-xs-12" style="padding:10px 0;">


            <div class="col-md-6">

              <div style="margin-top:5px;margin-bottom:7px;">

                <a href="<?php echo site_url('store'); ?>"
                  class="btn btn-default"
                >
                <b>Produk Serba Murah</b>
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
           <!--   <div class="col-md-12">
            <span style="padding:6px" class="bg-orange">Saldo Virtual : 
                  <?php if(get_saldo_virtual()!=FALSE): ?>
                    <b>Rp. <?php echo get_saldo_virtual(); ?></b>
                  <?php else: ?>
                    <b>Tidak Ada.</b>  
                  <?php endif; ?>
                </span>
            </div> -->

            <div class="col-md-12">

              <hr>

            </div>






          <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

              <center>

              <?php echo $pagination; ?>

              </center>

            </div>

          </div>



          <div class="row multi-columns-row">



            <?php if (!empty($product)): $count = 0;?>

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

              <a href="javascript:void();">
                <img src="<?php echo (!empty($v['foto_path']))?SRC_IMAGE.$v['foto_path']:$dummy_image; ?>" class="img-responsive" style="border:0px;width:270px;height:270px;">

              </a>

              <p></p>

              <div>
           <!--      <a href="<?php //echo site_url('store/item').'/'.$v['id_produk']; ?>" title="See product :<?php //echo $v['nama_produk'] ?>">
                  <?php //echo $v['nama_produk'] ?>
                </a> -->

               <a href="<?php echo site_url('store/item').'/'.$v['id_produk']; ?>" title="See product :<?php echo $v['nama_produk'] ?>">
                 <strong> <?php echo $v['nama_produk'] ?></strong>
                </a>

              </div>
              

              <font color="#6b6a6a" size="2"><?php echo $v['nama_kategori'] ?> </font>

              <font color="#6b6a6a"><br>

                <?php if ($diskon!=0): ?>

                <b style="color:gray"><?php echo "Harga Pasar : Rp. ".$str_price_n; ?></b><br>
                <b style="color:#d4232b"><?php echo "Harga Member : Rp. ".$str_price_s; ?></b><br>
                <b style="color:blue;"> Savings Rp. <?php echo $diskon; ?></b>

                <?php else: ?>

                <b style="color:#d4232b">Rp. <?php echo "Harga Pasar : ".$str_price_n; ?></b>

                <?php endif; ?>

              </font>


              <p></p>

            </div>  

            <?php 
            $count++;
            if($count == 4){
              echo '<div class="clearfix"></div>';
              $count=0;
            }
            ?>

            <?php endforeach; ?>

            <?php endif; ?>

          </div>



          <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

              <center>

              <?php echo $pagination; ?>

              </center>

            </div>

          </div>

      </div>

</div>


</section>





<script type="text/javascript">

  // get your select element and listen for a change event on it

  $('.select-redirect').change(function() {

    // set the window's location property to the value of the option the user has selected

    document.location = $(this).val();

  });

</script>