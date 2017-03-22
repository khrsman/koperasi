<div class="row" style="margin-top:0px" >

	<div class="col-md-8 col-md-offset-2" >



		<div class="box box-default">


		    <div class="box-header with-border">

		    	



		    	<div class="box-titles">

		    		<div class="row">

		    			<div class="col-md-12">

		    				<center>

		    					<img src="<?php echo $report['provider_logo']; ?>" class="img-responsive" width="150px">

		    				</center>

		    			</div>

		    			<div class="col-md-12">

		    				<h4 class="text-center">Laporan Pembayaran Tagihan <?php echo $report['provider_name']; ?></h4>
		    				
		    			</div>

		    		</div>

		    		

		    	</div>

		      

		    </div>

		    <!-- /.box-header -->

		    <!-- form start -->

		   

			  <div class="row">

			    <div class="alert alert-<?php echo $report['flash_msg_type'] ?> alert-dismissable">
			      <?php
			        if ($report['flash_msg_status']==TRUE) {
			          echo "<i class='icon fa fa-check'></i>";
			        } else{
			          echo "<i class='icon fa fa-close'></i>";
			        }
			      ?>
			      <?php echo $report['flash_msg_text']; ?>
			    </div>

			  </div>

		



		      <div class="box-body form-horizontal">

		        
		      	 <!-- START REPORT -->
		        <legend class="text-muted"><small>Data Transaksi:</small></legend>
		        
		        
		      	<div class="form-group">
		          <label class="col-sm-3 control-label">Status Transaksi</label>

		          <div class="col-sm-9">
		            <span class="form-control"><b><?php echo $report['flash_msg_status']==TRUE?'BERHASIL':'GAGAL'; ?></b></span>
		          </div>
		        </div>


		        <div class="form-group">
		          <label for="phone_number" class="col-sm-3 control-label">ID Transaksi</label>

		          <div class="col-sm-9">
		            <span class="form-control"><b><?php echo $report['no_transaksi']; ?></b></span>
		          </div>
		        </div>





		        <legend class="text-muted"><small>Data User:</small></legend>
	            <div class="form-group">
	               <label for="operator_code" class="col-sm-3 control-label">ID User</label>
	               <div class="col-sm-9">
	                  <span class="form-control"><b><?php echo $report['user_anggota']['id_user']; ?></b></span>
	               </div>
	            </div>
	            <div class="form-group">
	               <label for="operator_code" class="col-sm-3 control-label">Nama Lengkap</label>
	               <div class="col-sm-9">
	                  <span class="form-control"><b><?php echo $report['user_anggota']['nama_lengkap']; ?></b></span>
	               </div>
	            </div>
	            <div class="form-group">
	               <label for="operator_code" class="col-sm-3 control-label">Koperasi</label>
	               <div class="col-sm-9">
	                  <span class="form-control"><b><?php echo $report['user_anggota']['nama']; ?></b></span>
	               </div>
	            </div>
	            <div class="form-group">
	               <label for="operator_code" class="col-sm-3 control-label">No Rekening Virtual</label>
	               <div class="col-sm-9">
	                  <span class="form-control"><b><?php echo $report['user_anggota_virtual_account']['no_rekening_virtual']; ?></b></span>
	               </div>
	            </div>
	            
	            <div class="form-group">
	               <label for="operator_code" class="col-sm-3 control-label">Status Rekening</label>
	               <div class="col-sm-9">
	                  <span class="form-control"><b><?php echo $report['user_anggota_virtual_account']['status_rekening']; ?></b></span>
	               </div>
	            </div>

	            <div class="form-group">
	               <label for="operator_code" class="col-sm-3 control-label">Saldo Awal</label>
	               <div class="col-sm-9">
	                  <span class="form-control"><b>Rp. <?php echo number_format($report['user_anggota_virtual_account']['saldo'], 0,',','.'); ?></b></span>
	               </div>
	            </div>

	            <div class="form-group">
	               <label for="operator_code" class="col-sm-3 control-label">Saldo Akhir</label>
	               <div class="col-sm-9">
	               	  <?php if($report['data_insert']['status']=='SUKSES'): ?>
	                  <span class="form-control"><b>Rp. <?php echo number_format($report['user_anggota_virtual_account']['saldo']-$report['biaya_total'], 0,',','.'); ?></b>
	                  </span>
	              	  <?php else: ?>
	              	  <span class="form-control"><b>Rp. <?php echo number_format($report['user_anggota_virtual_account']['saldo'], 0,',','.'); ?></b>
	                  </span>	
	              	  <?php endif; ?>
	               </div>
	            </div>



	            

	            <legend class="text-muted"><small>Data Produk:</small></legend>

		        <div class="form-group">
		          <label for="phone_number" class="col-sm-3 control-label">ID Pelanggan</label>

		          <div class="col-sm-9">
		            <span class="form-control"><b><?php echo $report['msisdn']; ?></b></span>
		          </div>
		        </div>


		        <div class="form-group">
		          <label for="phone_number" class="col-sm-3 control-label">Nama Pelanggan</label>

		          <div class="col-sm-9">
		            <span class="form-control"><b><?php echo $report['nama_pelanggan']; ?></b></span>
		          </div>
		        </div>


		        <div class="form-group">
		          <label for="operator_code" class="col-sm-3 control-label">Kode Operator</label>

		          <div class="col-sm-9">
		            <span class="form-control"><b><?php echo $report['kode_operator']; ?></b></span>
		        	</div>
		        </div>


		        <div class="form-group">
		          <label class="col-sm-3 control-label">Biaya Tagihan</label>

		          <div class="col-sm-9">
		            <span class="form-control"><b>Rp. 
		            	<?php
		            		$biaya_tagihan = $report['biaya_tagihan'];
							echo number_format($biaya_tagihan, 0,',','.');
		            	?>
		            </b></span>
		        	</div>
		        </div>

		        <div class="form-group">
		          <label class="col-sm-3 control-label">Biaya Admin</label>

		          <div class="col-sm-9">
		            <span class="form-control"><b>Rp. 
		            	<?php
		            		$biaya_admin = $report['biaya_admin'];
							echo number_format($biaya_admin, 0,',','.');
		            	?>
		            </b></span>
		        	</div>
		        </div>

		        <div class="form-group">
		          <label class="col-sm-3 control-label">Biaya Total</label>

		          <div class="col-sm-9">
		            <span class="form-control"><b>Rp. 
		            	<?php
		            		$biaya_total = $report['biaya_total'];
							echo number_format($biaya_total, 0,',','.');
		            	?>
		            </b></span>
		        	</div>
		        </div>


		      </div>

		      <!-- /.box-body -->

		      <div class="box-footer">

		        <!-- <a href="<?php echo site_url('pulsa'); ?>" class="btn btn-default">Batal</a> -->

		        <a href="<?php echo site_url('gerai/pembayaran'); ?>" class="btn btn-info pull-right">Selesai</a>

		      </div>

		      <!-- /.box-footer -->

		  </div>



	</div>

</div>

</div>