<!-- <div class="container" style="margin-top:80px;"> -->
  
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/style.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/bootstrap-select.min.css"/>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/ajax-bootstrap-select.css"/>


 <div class="row">
 	
 	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">


	 	<div class="box box-solid">
	        <div class="box-header" style="margin-bottom:14px;">
	          <h3 class="box-title">
	          <a class="btn" href="<?php echo $return; ?>">
	          	<i class="fa fa-arrow-left" style="margin-right:7px"></i>
	          </a> 
	          Detail Pesanan : No. Transaksi #<?php echo $order_shipping['no_transaksi']; ?></h3>
	        </div>

	        <!-- /.box-header -->
	        <div class="box-body">

	        	<!-- Start Col -->
	        	<div class="col-md-12">
		 		
			 		<table class="table table-bordered" style="border:2px solid #eee !important">
			          	<tr>
			          		<td style="width:20%">No. Transaksi</td>
			          		<td><b><?php echo $order['no_transaksi']; ?></b></td>
			          	</tr>
			          	<tr>
			          		<td style="width:20%">Tanggal Transaksi</td>
			          		<td><b><?php echo date('d M Y, H:i',strtotime($order['tanggal_transaksi'])); ?></b></td>
			          	</tr>
			          	<tr>
			          		<td style="width:20%">Nama User Pemesan</td>
			          		<td><b><?php echo $order['nama_lengkap']; ?></b></td>
			          	</tr>
			          	<tr>
			          		<td style="width:20%">ID User Pemesan</td>
			          		<td><b><?php echo $order['id_user']; ?></b></td>
			          	</tr>
			          	<tr>
			          		<td>Status</td>
			          		<td>
			          			<?php  
						            $attributes = array('class'=>'form-horizontal');
						            echo form_open($form_action,$attributes);   
						         ?>
						         <div class="form-group">
					               <div class="col-sm-3">
					                  <select class="form-control" required="" name="status">
					                  	<option value="">-</option>
					                  	<option value="N" <?php echo $order_detail[0]['status_terkirim']=='N'?'selected':''; ?>>Belum Terkirim</option>
					                  	<option value="Y" <?php echo $order_detail[0]['status_terkirim']=='Y'?'selected':''; ?>>Terkirim</option>
					                  </select>
					               </div>
					               <div class="col-sm-3">
					               		<a href="<?php echo site_url('store_order/detail').'/'.$order['no_transaksi']; ?>" class="btn btn-default">Kembali</a>&nbsp&nbsp
					               		<button class="btn btn-success" type="submit">Simpan</button>
					               </div>
					            </div>
						         <?php echo form_close(); ?>
			          		</td>
			          	</tr>

			          </table>
			          <hr>

			 	</div>
			 	<!-- End Col -->


			 	<!-- Start Col -->
		        <div class="col-md-6">
		 		
			 		<table class="table table-bordered" style="border:2px solid #eee !important">
			          	<tr>
			          		<td colspan="2" class="text-center" style="background: #eee"><b>DATA PENERIMA</b></td>
			          	</tr>
			          	<tr>
			          		<td style="width:20%">Nama Penerima</td>
			          		<td><b><?php echo $order_shipping['penerima_nama']; ?></b></td>
			          	</tr>
			          	<tr>
			          		<td>Alamat</td>
			          		<td><b><?php echo $order_shipping['penerima_alamat']; ?></b></td>
			          	</tr>
			          	<tr>
			          		<td>Kelurahan</td>
			          		<td><b><?php echo $order_shipping['penerima_kelurahan']; ?></b></td>
			          	</tr>
			          	<tr>
			          		<td>Kecamatan</td>
			          		<td><b><?php echo $order_shipping['penerima_kecamatan']; ?></b></td>
			          	</tr>
			          	<tr>
			          		<td>Kota/Kab.</td>
			          		<td><b><?php echo $order_shipping['penerima_kabupaten']; ?></b></td>
			          	</tr>
			          	<tr>
			          		<td>Provinsi</td>
			          		<td><b><?php echo $order_shipping['penerima_provinsi']; ?></b></td>
			          	</tr>
			          	<tr>
			          		<td>Kode Pos</td>
			          		<td><b><?php echo $order_shipping['penerima_kode_pos']; ?></b></td>
			          	</tr>
			          	<tr>
			          		<td>No. Telp</td>
			          		<td><b><?php echo $order_shipping['penerima_no_tlp']; ?></b></td>
			          	</tr>

			          </table>

			 	</div>
			 	<!-- End Col -->


			 	<!-- Start Col -->
			 	<div class="col-md-6">
			 		<table class="table table-bordered" style="border:2px solid #eee !important">
			          	<tr>
			          		<td colspan="2" class="text-center" style="background: #eee"><b>DATA PENGIRIM</b></td>
			          	</tr>
			          	<tr>
			          		<td style="width:20%">Nama Pengirim</td>
			          		<td><b><?php echo $order_shipping['pengirim_nama']; ?></b></td>
			          	</tr>
			          	<tr>
			          		<td>Alamat</td>
			          		<td><b><?php echo $order_shipping['pengirim_alamat']; ?></b></td>
			          	</tr>
			          	<tr>
			          		<td>Kelurahan</td>
			          		<td><b><?php echo $order_shipping['pengirim_kelurahan']; ?></b></td>
			          	</tr>
			          	<tr>
			          		<td>Kecamatan</td>
			          		<td><b><?php echo $order_shipping['pengirim_kecamatan']; ?></b></td>
			          	</tr>
			          	<tr>
			          		<td>Kota/Kab.</td>
			          		<td><b><?php echo $order_shipping['pengirim_kabupaten']; ?></b></td>
			          	</tr>
			          	<tr>
			          		<td>Provinsi</td>
			          		<td><b><?php echo $order_shipping['pengirim_provinsi']; ?></b></td>
			          	</tr>
			          	<tr>
			          		<td>Kode Pos</td>
			          		<td><?php echo $order_shipping['pengirim_kode_pos']; ?></td></td>
			          	</tr>
			          	<tr>
			          		<td>No. Telp</td>
			          		<td><b><?php echo $order_shipping['pengirim_no_tlp']; ?></b></td>
			          	</tr>

			        </table>

			 	</div>
			 	<!-- End Col -->



			 	<!-- Start Col -->
			 	<div class="col-md-12">
			 		<hr>
			 		<div class="table-responsive no-padding">
		                  <table class="table" style="border:2px solid #eee !important">
		                    <thead>
		                      <tr style="background: #eee">
		                        <th>Produk</th>
		                        <th class="hidden">Berat</th>
		                        <th>Harga</th>
		                        <th class="text-center">Qty</th>
		                        <th class="hidden">Sub-Total Berat</th>
		                        <th>Sub-Total Harga</th>
		                      </tr>
		                    </thead>

		                    <tbody>
		                      <?php if(!empty($order_detail)): ?>
		                      <?php
		                        $total_qty    = 0;
		                        $total_price  = 0;
		                      ?>

		                      <?php foreach($order_detail as $k => $v): ?>
		                      <?php 
		                        $rowid    = $k;
		                        $name     = $v['nama_produk'];
		                        $qty      = $v['jumlah'];
		                        $price    = $v['harga'];
		                        $subtotal = $v['harga']*$v['jumlah'];
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
		                            <h5><?php echo $qty; ?></h5>
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

			 	</div>
			 	<!-- End Col -->

	        </div>
		</div>

	</div>	

 </div>





<script type="text/javascript">
  // get your select element and listen for a change event on it
  $('.select-redirect').change(function() {
    // set the window's location property to the value of the option the user has selected
    document.location = $(this).val();
  });
</script>