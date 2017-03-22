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



  <!-- CART START -->
  <div class="row multi-columns-row">

    <?php if(!empty($cart)): ?>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

    <?php if(!empty(validation_errors())): ?>
    <div class="alert alert-danger alert-dismissable">
       <?php echo validation_errors(); ?>
    </div> 
    <?php endif; ?>

    <form class="form-horizontal" action="<?php echo $form_action; ?>" method="POST" >

      <div class="box box-solid">
        <div class="box-header" style="margin-bottom:14px;">
          <h3 class="box-title"><i class="fa fa-shopping-cart" style="margin-right:7px"></i> Selesaikan Pemesanan</h3>
        </div>

        <!-- /.box-header -->
        <div class="box-body">

          <div class="rows">
              <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                <div class="table-responsive no-padding">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Produk</th>
                        <th class="hidden">Berat</th>
                        <th>Harga</th>
                        <th class="text-center">Qty</th>
                        <th class="hidden">Sub-Total Berat</th>
                        <th>Sub-Total Harga</th>
                      </tr>
                    </thead>

                    <tbody>
                      <?php if(!empty($cart)): ?>
                      <?php
                        $total_qty    = 0;
                        $total_price  = 0;
                      ?>

                      <?php foreach($cart as $k => $v): ?>
                      <?php 
                        $rowid    = $k;
                        $id       = $v['id'];
                        $name     = $v['name'];
                        $qty      = $v['qty'];
                        $price    = $v['price'];
                        $subtotal = $v['subtotal'];
                        $str_price    = number_format($price,0,",",".");
                        $str_subtotal = number_format($subtotal,0,",",".");

                        $foto_path   = $v['foto_path'];
                        $dummy_image = base_url('assets/compro/IMAGE/store/item-store.png');

                        $total_qty       = $total_qty+$qty;
                        $total_price     = $total_price+$subtotal;
                        $str_total_price = number_format($total_price,0,",",".");
                      ?>

                      <tr>

                        <td>
                          <img src="<?php echo (!empty($foto_path))?SRC_IMAGE.$foto_path:$dummy_image; ?>" class="img-responsive" width="100px" />
                          <p><?php echo $name; ?></p>
                        </td>

                        <td class="hidden">
                          <h5>2 Kg</h5>
                        </td>

                        <td>
                          <h5>Rp. <?php echo $str_price; ?></h5>
                        </td>

                        <td>
                          <center>
                            <input style="width:50px;" type="number" min="1" class="form-control" name="qty_item[]" value="<?php echo $qty; ?>" readonly disabled>
                          </center>
                        </td>

                        <td class="hidden">
                          <h5>2 Kg</h5>
                        </td>

                        <td>
                          <h5>Rp. <?php echo $str_subtotal; ?></h5>
                        </td>

                      </tr>
                      <?php endforeach; ?>
                      <?php endif; ?>

                      <tr bgcolor="#EEE">
                        <td colspan="2" align="center"><strong>TOTAL</strong></td>
                        <td class="text-center"><strong> <?php echo $total_qty; ?></strong></td>
                        <td class="hidden"><strong>3 Kg</strong></td>
                        <td class=""><strong>Rp. <?php echo $str_total_price; ?></strong></td>
                      </tr>

                    </tbody>

                  </table>

                </div>


                <!-- DETAIL START -->
                <div>

                    <div class="box-body">
                      <h4 class="text-muted">Data Penerima</h4>
                      <br>
                      <div class="form-group">
                        <label for="penerima_nama" class="col-sm-2 control-label">Nama Penerima</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="penerima_nama" id="penerima_nama" placeholder="Nama Penerima" required value="<?php echo set_value('penerima_nama'); ?>" >
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="penerima_alamat" class="col-sm-2 control-label">Alamat</label>

                        <div class="col-sm-10">
                          <textarea class="form-control" name="penerima_alamat" id="penerima_alamat" placeholder="Alamat Penerima" required><?php echo set_value('penerima_alamat'); ?></textarea>
                        </div>
                      </div>



                      <div class="form-group">
                        <label for="penerima_kelurahan" class="col-sm-2 control-label">Kelurahan</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" name="penerima_kelurahan" id="penerima_kelurahan" placeholder="Kelurahan Penerima" value="<?php echo set_value('penerima_kelurahan'); ?>" >
                        </div>


                        <label for="penerima_kecamatan" class="col-sm-2 control-label">Kecamatan</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" name="penerima_kecamatan" id="penerima_kecamatan" placeholder="Kecamatan Penerima" value="<?php echo set_value('penerima_kecamatan'); ?>" >
                        </div>
                      </div>



                      <div class="form-group">
                        <label for="penerima_kabupaten" class="col-sm-2 control-label">Kota/Kab.</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" name="penerima_kabupaten" id="penerima_kabupaten" placeholder="Kota/Kabupaten Penerima" required value="<?php echo set_value('penerima_kabupaten'); ?>" >
                        </div>

                        <label for="penerima_provinsi" class="col-sm-2 control-label">Provinsi</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" name="penerima_provinsi" id="penerima_provinsi" placeholder="Provinsi Penerima" required value="<?php echo set_value('penerima_provinsi'); ?>" >
                        </div>
                      </div>



                      <div class="form-group">
                        <label for="penerima_kode_pos" class="col-sm-2 control-label">Kode Pos</label>
                        <div class="col-sm-4">
                          <input type="number" min="1" class="form-control" name="penerima_kode_pos" id="penerima_kode_pos" placeholder="Kode Pos" value="<?php echo set_value('penerima_kode_pos'); ?>" >
                        </div>
                      </div>


                      <div class="form-group">
                        <label for="penerima_no_tlp" class="col-sm-2 control-label">No. Telp</label>
                        <div class="col-sm-10">
                          <input type="number" min="1" class="form-control" name="penerima_no_tlp" id="penerima_no_tlp" placeholder="No. HP / Telp Penerima" value="<?php echo set_value('penerima_no_tlp'); ?>" >
                        </div>
                      </div>

                    </div>

                    <hr>

                    <h4 class="text-muted">Data Pengirim</h4>
                      <br>
                      <div class="form-group">
                        <label for="pengirim_nama" class="col-sm-2 control-label">Nama Pengirim</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="pengirim_nama" id="pengirim_nama" placeholder="Nama Pengirim"  value="<?php echo set_value('pengirim_nama'); ?>" required>
                        </div>
                      </div>


                      <div class="form-group">
                        <label for="pengirim_alamat" class="col-sm-2 control-label">Alamat</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" name="pengirim_alamat" id="pengirim_alamat" placeholder="Alamat Pengirim" required><?php echo set_value('pengirim_alamat'); ?></textarea>
                        </div>
                      </div>


                      <div class="form-group">
                        <label for="pengirim_kelurahan" class="col-sm-2 control-label">Kelurahan</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" name="pengirim_kelurahan" id="pengirim_kelurahan" placeholder="Kelurahan Pengirim"  value="<?php echo set_value('pengirim_kelurahan'); ?>" >
                        </div>

                        <label for="pengirim_kecamatan" class="col-sm-2 control-label">Kecamatan</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" name="pengirim_kecamatan" id="pengirim_kecamatan" placeholder="Kecamatan Pengirim" value="<?php echo set_value('pengirim_kecamatan'); ?>" >
                        </div>
                      </div>


                      <div class="form-group">
                        <label for="pengirim_kabupaten" class="col-sm-2 control-label">Kota/Kab.</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" name="pengirim_kabupaten" id="pengirim_kabupaten" placeholder="Kota/Kabupaten Pengirim"  value="<?php echo set_value('pengirim_kabupaten'); ?>" required>
                        </div>

                        <label for="pengirim_provinsi" class="col-sm-2 control-label">Provinsi</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" name="pengirim_provinsi" id="pengirim_provinsi" placeholder="Provinsi Pengirim" value="<?php echo set_value('pengirim_provinsi'); ?>" required>
                        </div>
                      </div>


                      <div class="form-group">
                        <label for="pengirim_kode_pos" class="col-sm-2 control-label">Kode Pos</label>
                        <div class="col-sm-4">
                          <input type="number" min="1" class="form-control" name="pengirim_kode_pos" id="pengirim_kode_pos" placeholder="Kode Pos" value="<?php echo set_value('pengirim_kode_pos'); ?>" >
                        </div>
                      </div>


                      <div class="form-group">
                        <label for="pengirim_no_tlp" class="col-sm-2 control-label">No. Telp</label>
                        <div class="col-sm-10">
                          <input type="number" min="1" class="form-control" name="pengirim_no_tlp" id="pengirim_no_tlp" placeholder="No. HP / Telp pengirim" value="<?php echo set_value('pengirim_no_tlp'); ?>" >
                        </div>
                      </div>

                      <hr>

                      <div class="form-group">
                         <label for="pin" id="pin" class="col-sm-2 control-label">PIN</label>
                         <div class="col-sm-10">
                            <input type="password" name="pin" class="form-control" id="pin" placeholder="Masukan PIN" required>
                         </div>
                      </div>


                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                        <button class="btn btn-success btn-blocks" onclick="return confirm ('Pastikan jenis dan jumlah pembelian pada setiap barang yang anda pesan, serta alamat sudah benar, lanjutkan ?')"><b><i class="fa fa-check" style="margin-right:7px"></i> SELESAI</b></button>

                          <!-- <div class="checkbox">
                            <label>
                              <input type="checkbox"> Checklist ini jika alamat pengiriman sama dengan alamat profil anda
                            </label>
                          </div> -->
                        </div>

                      </div>

                    </div>

                    <!-- /.box-body -->


                </div>

                <!-- DETAIL END -->

              </div>


              <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                <div class="box box-default box-solid">
                  <div class="box-header with-border">
                    <h3 class="box-title">TOTAL</h3>
                    <!-- /.box-tools -->
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body" style="display: block;">
                    <table class="table">
                      <tr>
                        <td>Total Qty</td>
                        <td><?php echo $total_qty; ?></td>
                      </tr>
                      <tr class="hidden">
                        <td>Total Berat</td>
                        <td>2 Kg</td>
                      </tr>
                      <tr>
                        <td>Total Harga</b></td>
                        <td>Rp. <?php echo $str_total_price; ?></td>
                      </tr>
                      <tr class="hidden">
                        <td>Biaya Pengiriman</b></td>
                        <td>Rp. 0</td>
                      </tr>
                      <tr style="border-top:2px solid #ddd">
                        <td><b>GRAND TOTAL</b></td>
                        <td><b>Rp. <?php echo $str_total_price; ?></b></td>
                      </tr>
                    </table>

                    <br>

                    <!-- <a href="<?php echo site_url('store/transaction_add'); ?>" class="btn btn-success btn-block" onclick="return confirm ('Pastikan jenis dan jumlah pembelian pada setiap barang yang anda pesan sudah benar, lanjutkan ?')"><b><i class="fa fa-check" style="margin-right:7px"></i> SELESAI</b></a> -->

                  </div>

                  <!-- /.box-body -->

                </div>

              </div>



          </div>


        </div>

        <!-- /.box-body -->

      </div>

      <!-- /.box -->

    </form>  

    </div>

    <?php endif; ?>



    <?php if(empty($cart)): ?>

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <center style="margin:80px 0">
        <i class="fa fa-shopping-cart text-muted" style="font-size:64px;"></i>
        <h3 class="text-muted">
          Keranjang Belanja Kosong
        </h3>
        <a href="<?php echo site_url('store'); ?>" class="btn btn-flat btn-info">Lanjut Belanja</a>
      </center>
    </div>

    <?php endif; ?>

      

  </div>

  <!-- CART END -->



</div>


<script type="text/javascript">
  // get your select element and listen for a change event on it
  $('.select-redirect').change(function() {
    // set the window's location property to the value of the option the user has selected
    document.location = $(this).val();
  });
</script>