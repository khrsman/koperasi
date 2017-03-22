<!-- <div class="container" style="margin-top:80px;"> -->
  
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/style.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/bootstrap-select.min.css"/>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/ajax-bootstrap-select.css"/>

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

    <?php if(!empty(validation_errors())): ?>
    <div class="alert alert-danger alert-dismissable">
       <?php echo validation_errors(); ?>
    </div> 
    <?php endif; ?>

    <form class="form-horizontal" action="<?php echo $form_action; ?>" method="POST" >

      <div class="box box-defult">
        <div class="box-header" style="margin-bottom:14px;">
          <h3 class="box-title"><i class="fa fa-shopping-cart" style="margin-right:7px"></i> Selesaikan Pemesanan</h3>
        </div>

        <!-- /.box-header -->
        <div class="box-body">

          <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="table-responsive no-padding">
                  
                  <?php if(!empty($group_cart)): ?>
                    
                  <table class="table table-bordered">
                    
                    <tbody>  
                      
                      <?php foreach($group_cart['detail'] as $m => $n): ?>

                      <tr style="background-color:#efefef">
                        <td colspan="4">
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

                        <td>
                          <b><?php echo $name; ?></b><br>
                          <b style="color:gray"><small><?php echo "Harga Pasar : Rp. ".$str_price_n; ?></small></b><br>
                          <b style="color:#d4232b"><small><?php echo "Harga Member : Rp. ".$str_price_s; ?></small></b>
                          <br><small class="bg-blue"style="padding: 1px 5px;"> Savings Rp. <?php echo $str_savings; ?></small>
                        </td>

                        <td>
                          <center>
                            <span style="font-size:14px"><?php echo $qty; ?></span>
                          </center>
                        </td>

                        <td>
                          <span style="font-size:14px">Rp. <?php echo $str_subtotal; ?></span>
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

                  <hr>
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
                        
                        <label for="penerima_provinsi" class="col-sm-2 control-label">Provinsi</label>
                        <div class="col-sm-4">

                          <select id="penerima_provinsi" class="selectpicker_provinsi with-ajax search-select form-control" name="penerima_provinsi" data-live-search="true" required=""></select>
                        </div>

                        <label for="penerima_kabupaten" class="col-sm-2 control-label">Kota/Kab.</label>
                        <div class="col-sm-4">

                          <select id="penerima_kabupaten" class="form-control" name="penerima_kabupaten" required=""></select>
                        </div>

                      </div>


                      <div class="form-group">
                        <label for="penerima_kecamatan" class="col-sm-2 control-label">Kecamatan</label>
                        <div class="col-sm-4">

                          <select id="penerima_kecamatan" class="form-control" name="penerima_kecamatan"></select>
                        </div>
                        
                        <label for="penerima_kelurahan" class="col-sm-2 control-label">Kelurahan</label>
                        <div class="col-sm-4">

                         <select id="penerima_kelurahan" class="form-control" name="penerima_kelurahan"></select>
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
                        <label for="pengirim_provinsi" class="col-sm-2 control-label">Provinsi</label>
                        <div class="col-sm-4">

                          <select id="pengirim_provinsi" class="selectpicker_provinsi with-ajax search-select form-control" name="pengirim_provinsi" data-live-search="true" required=""></select>
                        </div>

                        <label for="pengirim_kabupaten" class="col-sm-2 control-label">Kota/Kab.</label>
                        <div class="col-sm-4">

                          <select id="pengirim_kabupaten" class="form-control" name="pengirim_kabupaten" required=""></select>
                        </div>
                      </div>



                      <div class="form-group">
                        <label for="pengirim_kecamatan" class="col-sm-2 control-label">Kecamatan</label>
                        <div class="col-sm-4">

                          <select id="pengirim_kecamatan" class="selectpicker_kecamatan form-control" name="pengirim_kecamatan"></select>
                        </div>

                        <label for="pengirim_kelurahan" class="col-sm-2 control-label">Kelurahan</label>
                        <div class="col-sm-4">

                          <select id="pengirim_kelurahan" class="selectpicker_kelurahan with-ajax search-select form-control" name="pengirim_kelurahan" data-live-search="true"></select>
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


          </div>


        </div>

        <!-- /.box-body -->

      </div>

      <!-- /.box -->

    </form>  

    </div>

    <?php endif; ?>



    <?php if(empty($group_cart)): ?>

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



<!-- </div> -->


<script type="text/javascript">
  // get your select element and listen for a change event on it
  $('.select-redirect').change(function() {
    // set the window's location property to the value of the option the user has selected
    document.location = $(this).val();
  });
</script>

<script type="text/javascript" src="<?php echo base_url() ?>assets/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/ajax-bootstrap-select.js"></script>




<script type="text/javascript">

    var id_selected_province_penerima  = 'nothing';
    var id_selected_kabupaten_penerima = 'nothing';
    var id_selected_kecamatan_penerima = 'nothing';
   

    var options = {
        ajax          : {
            url     : '<?php echo base_url()."store/cart/search_provinsi"; ?>',
            type    : 'POST',
            dataType: 'json',
            data    : {
                keyword: '{{{q}}}'
            }
        },
        locale        : {
            currentlySelected : 'Saat ini dipilih',
            emptyTitle        : 'Ketikan nama provinsi',
            errorText         : 'Maaf, terjadi gangguan saat menerima data. Silahkan ulangi',
            searchPlaceholder : 'Ketikan nama provinsi...',
            statusInitialized : 'Lakukan pencarian provinsi',
            statusNoResults   : 'Pencarian tidak ditemukan',
            statusSearching   : 'Mencari...'
        },
        log           : 3,
        preprocessData: function (data) {
            var i, l = data.length, array = [];
            if (l) {
                for (i = 0; i < l; i++) {
                    array.push($.extend(true, data[i], {
                        text : data[i].text,
                        value: data[i].id,
                    }));
                }
            }

            return array;
        }
    };

    $('#penerima_provinsi').selectpicker().filter('.with-ajax').ajaxSelectPicker(options);

    $('#penerima_provinsi').on('change', function () {
        id_selected_province_penerima = $(this).val();

        fetch_select_kabupaten_penerima(id_selected_province_penerima);
        $('#penerima_kecamatan').val('');
        $('#penerima_kelurahan').val('');     
     });


    $('#penerima_kabupaten').on('change', function () {
        var id_selected_kabupaten_penerima = $(this).val();
        fetch_select_kecamatan_penerima(id_selected_kabupaten_penerima);;
        $('#penerima_kelurahan').val('');
     });

    $('#penerima_kecamatan').on('change', function () {
         var id_selected_kecamatan_penerima = $(this).val();
         fetch_select_kelurahan_penerima(id_selected_kecamatan_penerima);
     });


    function fetch_select_kabupaten_penerima(id_province){  
       $.ajax({
         type: 'POST',
         url: '<?php echo base_url()."store/cart/select_kabupaten"; ?>'+'/'+id_province,
         data: {get_option:id_province},
         success: function (response) {
           document.getElementById("penerima_kabupaten").innerHTML=response; 
         }
       });
    }


    function fetch_select_kecamatan_penerima(id_kabupaten){  
       $.ajax({
         type: 'POST',
         url: '<?php echo base_url()."store/cart/select_kecamatan"; ?>'+'/'+id_kabupaten,
         data: {get_option:id_kabupaten},
         success: function (response) {
           document.getElementById("penerima_kecamatan").innerHTML=response; 
         }
       });
    }


    function fetch_select_kelurahan_penerima(id_kecamatan){  
       $.ajax({
         type: 'POST',
         url: '<?php echo base_url()."store/cart/select_kelurahan"; ?>'+'/'+id_kecamatan,
         data: {get_option:id_kecamatan},
         success: function (response) {
           document.getElementById("penerima_kelurahan").innerHTML=response; 
         }
       });
    }


</script>




<script type="text/javascript">

    var id_selected_province_pengirim  = 'nothing';
    var id_selected_kabupaten_pengirim = 'nothing';
    var id_selected_kecamatan_pengirim = 'nothing';
   

    var options = {
        ajax          : {
            url     : '<?php echo base_url()."store/cart/search_provinsi"; ?>',
            type    : 'POST',
            dataType: 'json',
            data    : {
                keyword: '{{{q}}}'
            }
        },
        locale        : {
            currentlySelected : 'Saat ini dipilih',
            emptyTitle        : 'Ketikan nama provinsi',
            errorText         : 'Maaf, terjadi gangguan saat menerima data. Silahkan ulangi',
            searchPlaceholder : 'Ketikan nama provinsi...',
            statusInitialized : 'Lakukan pencarian provinsi',
            statusNoResults   : 'Pencarian tidak ditemukan',
            statusSearching   : 'Mencari...'
        },
        log           : 3,
        preprocessData: function (data) {
            var i, l = data.length, array = [];
            if (l) {
                for (i = 0; i < l; i++) {
                    array.push($.extend(true, data[i], {
                        text : data[i].text,
                        value: data[i].id,
                    }));
                }
            }

            return array;
        }
    };

    $('#pengirim_provinsi').selectpicker().filter('.with-ajax').ajaxSelectPicker(options);

    $('#pengirim_provinsi').on('change', function () {
        id_selected_province_pengirim = $(this).val();

        fetch_select_kabupaten_pengirim(id_selected_province_pengirim);
        $('#pengirim_kecamatan').val('');
        $('#pengirim_kelurahan').val('');     
     });


    $('#pengirim_kabupaten').on('change', function () {
        var id_selected_kabupaten_pengirim = $(this).val();
        fetch_select_kecamatan_pengirim(id_selected_kabupaten_pengirim);;
        $('#pengirim_kelurahan').val('');
     });

    $('#pengirim_kecamatan').on('change', function () {
         var id_selected_kecamatan_pengirim = $(this).val();
         fetch_select_kelurahan_pengirim(id_selected_kecamatan_pengirim);
     });


    function fetch_select_kabupaten_pengirim(id_province){  
       $.ajax({
         type: 'POST',
         url: '<?php echo base_url()."store/cart/select_kabupaten"; ?>'+'/'+id_province,
         data: {get_option:id_province},
         success: function (response) {
           document.getElementById("pengirim_kabupaten").innerHTML=response; 
         }
       });
    }


    function fetch_select_kecamatan_pengirim(id_kabupaten){  
       $.ajax({
         type: 'POST',
         url: '<?php echo base_url()."store/cart/select_kecamatan"; ?>'+'/'+id_kabupaten,
         data: {get_option:id_kabupaten},
         success: function (response) {
           document.getElementById("pengirim_kecamatan").innerHTML=response; 
         }
       });
    }


    function fetch_select_kelurahan_pengirim(id_kecamatan){  
       $.ajax({
         type: 'POST',
         url: '<?php echo base_url()."store/cart/select_kelurahan"; ?>'+'/'+id_kecamatan,
         data: {get_option:id_kecamatan},
         success: function (response) {
           document.getElementById("pengirim_kelurahan").innerHTML=response; 
         }
       });
    }


</script>




