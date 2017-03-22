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




  <!-- CART START -->

  <div class="row multi-columns-row">

    <?php if(!empty($group_cart)): ?>

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

      <div class="box">
        
        <div class="box-header" style="margin-bottom:14px;">
          <h3 class="box-title"><i class="fa fa-shopping-cart" style="margin-right:7px"></i> Keranjang Belanja</h3>
        </div>

        <!-- /.box-header -->

        <div class="box-body">

          <form method="POST" action="<?php echo site_url('store/cart/update'); ?>">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-responsive no-padding">

                  <?php if(!empty($group_cart)): ?>
                    
                  <table class="table table-bordered">
                    
                    <tbody>  
                      
                      <?php foreach($group_cart['detail'] as $m => $n): ?>

                      <tr style="background-color:#efefef">
                        <td colspan="5">
                          <span style="font-size:14px">
                            Dijual oleh <b><?php echo $n['merchant']['owner']==3 ? $n['merchant']['nama_user']:$n['merchant']['nama_koperasi']; ?></b>
                          </span>
                        </td>
                      </tr>

                      <?php foreach ($n['product'] as $k => $v): ?>
                      <?php 

                        $rowid    = $v['rowid'];
                        $id       = $v['id'];
                        $name     = $v['name'];
                        $qty      = $v['qty'];

                        $price_s    = $v['price_s'];
                        $price_n    = $v['price'];
                        $savings    = $v['price']-$v['price_s'];
                        $subtotal   = $v['subtotal'];

                        $str_price_s    = number_format($price_s,0,",",".");
                        $str_price_n    = number_format($price_n,0,",",".");
                        $str_savings    = number_format($savings,0,",",".");
                        $str_subtotal   = number_format($subtotal,0,",",".");



                        $foto_path   = $v['foto_path'];
                        $dummy_image = base_url('assets/compro/IMAGE/store/item-store.png');
                      ?>

                      <tr>
                        <td>
                          <img src="<?php echo (!empty($foto_path))?SRC_IMAGE.$foto_path:$dummy_image; ?>" class="img-responsive" width="100px" />
                        </td>

                        <td width="42%">
                          <b><?php echo $name; ?></b><br>
                          <b style="color:gray"><small><?php echo "Harga Pasar : Rp. ".$str_price_n; ?></small></b><br>
                          <b style="color:#d4232b"><small><?php echo "Harga Member : Rp. ".$str_price_s; ?></small></b>
                          <br><small class="bg-blue"style="padding: 1px 5px;"> Savings Rp. <?php echo $str_savings; ?></small>
                        </td>

                        <td>
                          <center>
                            <input type="hidden" name="rowid[]" value="<?php echo $rowid; ?>">
                            <input style="width:75px;" type="number" min="1" class="form-control" name="qty_item[]" value="<?php echo $qty; ?>">
                          </center>
                        </td>

                        <td>
                          <span style="font-size:14px">Rp. <?php echo $str_subtotal; ?></span>
                        </td>

                        <td class="text-center">
                          <button type="submit" class="btn btn-default"><i class="fa fa-refresh"></i></button>
                          <a href="<?php echo site_url('store/cart/remove').'/'.$rowid; ?>" class="btn btn-default"><i class="fa fa-remove"></i></a>
                        </td>

                      </tr>


                      <?php endforeach; ?>

                      <tr>
                        <td colspan="3">
                          <center>
                            <b class="text-muted">Subtotal</b>
                          </center>
                        </td>
                        <td>
                          <span style="font-size:14px">
                            <b>Rp. <?php echo number_format($n['total_price'],0,",","."); ?></b>
                          </span>
                        </td>
                        <td></td>
                      </tr>

                      <?php endforeach; ?>
                    </tbody>

                  </table>    

                  <?php endif; ?>

                  <hr>

                  <table class="table">
                    <tr style="background-color:#efefef">
                      <td colspan="2">
                        <span style="font-size:14px">
                          <b>RANGKUMAN PESANAN</b>
                        </span>
                      </td>
                    </tr>
                    <tr>
                      <td>Total Barang</td>
                      <td><?php echo $group_cart['summary']['grand_total_item']; ?></td>
                    </tr>
                    <tr>
                      <td>Total Qty</td>
                      <td><?php echo $group_cart['summary']['grand_total_qty']; ?></td>
                    </tr>

                    <tr>
                      <td>Total Harga Pasar</td>
                      <td><b>Rp. <?php echo number_format($group_cart['summary']['grand_total_price'],0,",","."); ?><b></td>
                    </tr>

                    <tr class="text-muted">
                      <td>Total Harga Member</b></td>
                      <td>Rp. <?php echo number_format($group_cart['summary']['grand_total_price_s'],0,",","."); ?></td>
                    </tr>
                    
                    <tr class="text-muted">
                      <td>Total Savings</td>
                      <td>Rp. <?php echo number_format($group_cart['summary']['grand_total_savings'],0,",","."); ?></td>
                    </tr>

                    <tr class="text-success" style="border-top:2px solid #ddd">
                      <td><b>Total Harga</b></td>
                      <td><b>Rp. <?php echo number_format($group_cart['summary']['grand_total_price'],0,",","."); ?></b></td>
                    </tr>
                  </table>


                  <button type="submit" class="btn btn-default btn-block"><b>UPDATE</b></button>

                  <a class="btn btn-success btn-block" href="<?php echo site_url('store/cart/check_out'); ?>" onclick="return confirm ('Pastikan jenis dan jumlah pembelian pada setiap barang yang anda pesan sudah benar, lanjutkan ?')"><b><i class="fa fa-check" style="margin-right:7px"></i> CHECKOUT</b>
                  </a>

                </div>



            </div>

 

          </div>

          <!-- /.box-body -->

         </form> 

      </div>

      <!-- /.box -->



    </div>

    <?php endif; ?>



    <?php if(empty($group_cart)): ?>

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

      <center style="margin:80px 0">

        <i class="fa fa-shopping-cart text-muted" style="font-size:64px;"></i>

        <h3 class="text-muted">

          Keranjang Belanja Kosong

        </h3>

        <a href="<?php echo site_url('store/product'); ?>" class="btn btn-flat btn-info">Lanjut Belanja</a>

      </center>

    </div>

    <?php endif; ?>

      

  </div>

  <!-- CART END -->







<!-- </div> -->





<script type="text/javascript">

  // get your select element and listen for a change event on it

  $('.select-redirect').change(function() {

    // set the window's location property to the value of the option the user has selected

    document.location = $(this).val();

  });

</script>