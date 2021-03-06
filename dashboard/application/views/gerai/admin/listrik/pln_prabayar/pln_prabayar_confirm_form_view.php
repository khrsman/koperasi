<div class="row" >

	<div class="col-md-8 " >



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

		    				<h4 class="text-center">Konfirmasi Pembelian Token <?php echo $report['provider_name']; ?></h4>
		    				<br>
		    				
		    			</div>

		    		</div>

		    		

		    	</div>

		      

		    </div>

		    <!-- /.box-header -->

		    <!-- form start -->

			
			<?php if(!empty(form_error('pin'))): ?>
	        <div class="alert alert-warning alert-dismissable">
	           <?php echo form_error('pin'); ?>
	        </div> 
	        <?php endif; ?>


			  <?php  
	            $attributes = array('class'=>'form-horizontal');
	            echo form_open($form_action,$attributes);
	          ?>

		      <div class="box-body">

		      	<legend class="text-muted"><small>Data User:</small></legend>
	            <div class="form-group">
	               <label for="operator_code" class="col-sm-3 control-label">ID User</label>
	               <div class="col-sm-9">
	                  <span class="form-control"><b><?php echo $user_anggota['id_user']; ?></b></span>
	               </div>
	            </div>
	            <div class="form-group">
	               <label for="operator_code" class="col-sm-3 control-label">Nama Lengkap</label>
	               <div class="col-sm-9">
	                  <span class="form-control"><b><?php echo $user_anggota['nama_lengkap']; ?></b></span>
	               </div>
	            </div>
	            <div class="form-group">
	               <label for="operator_code" class="col-sm-3 control-label">Koperasi</label>
	               <div class="col-sm-9">
	                  <span class="form-control"><b><?php echo $user_anggota['nama']; ?></b></span>
	               </div>
	            </div>
	            <div class="form-group">
	               <label for="operator_code" class="col-sm-3 control-label">No Rekening Virtual</label>
	               <div class="col-sm-9">
	                  <span class="form-control"><b><?php echo $user_anggota_virtual_account['no_rekening_virtual']; ?></b></span>
	               </div>
	            </div>
	            
	            <div class="form-group">
	               <label for="operator_code" class="col-sm-3 control-label">Status Rekening</label>
	               <div class="col-sm-9">
	                  <span class="form-control"><b><?php echo $user_anggota_virtual_account['status_rekening']; ?></b></span>
	               </div>
	            </div>

	            <div class="form-group">
	               <label for="operator_code" class="col-sm-3 control-label">Saldo</label>
	               <div class="col-sm-9">
	                  <span class="form-control"><b>Rp. <?php echo number_format($user_anggota_virtual_account['saldo'], 0,',','.'); ?></b></span>
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
		          <label for="phone_number" class="col-sm-3 control-label">Tarif/Daya</label>
		          <div class="col-sm-9">
		            <span class="form-control"><b><?php echo $report['tarif_daya']; ?></b></span>
		          </div>
		        </div>



		        <div class="form-group">
		          <label for="operator_code" class="col-sm-3 control-label">Kode Operator</label>
		          <div class="col-sm-9">
		            <span class="form-control"><b><?php echo $report['kode_operator']; ?></b></span>
		        	</div>
		        </div>


		        <div class="form-group">
		          <label for="nominal" class="col-sm-3 control-label">Nominal</label>
		          <div class="col-sm-9">
		            <span class="form-control"><b>Rp. 
		            	<?php
		            		$nominal = $report['nominal_produk'];
							echo number_format($nominal, 0,',','.');
		            	?>
		            </b></span>
		        	</div>
		        </div>

		        <div class="form-group">
		          <label for="operator_code" class="col-sm-3 control-label">Harga</label>
		          <div class="col-sm-9">
		            <span class="form-control"><b>Rp. <?php echo number_format($report['harga_gerai'], 0,',','.'); ?></b></span>
		        	</div>
		        </div>

		        <!-- <div class="form-group">
	               <label for="pin" id="pin" class="col-sm-3 control-label">PIN</label>
	               <div class="col-sm-9">
	                  <input type="password" name="pin" class="form-control" id="pin" placeholder="Masukan PIN" required>
	               </div>
	            </div> -->


	            <legend class="text-muted"><small>Konfirmasi Saldo:</small></legend>
	            <div class="form-group">
	               <label for="operator_code" class="col-sm-3 control-label">Sisa Saldo</label>
	               <div class="col-sm-9">
	                  <span class="form-control"><b>Rp. <?php echo number_format($user_anggota_virtual_account['saldo']-$product['harga_gerai'], 0,',','.'); ?></b></span>
	                  <p class="help-block">Saldo dikurangi Harga</p>
	               </div>
	            </div>



		      </div>

		      <!-- /.box-body -->

		      <div class="box-footer">

		      	<input type="hidden" name="id_user" class="form-control" id="id_user" value="<?php echo $user_anggota['id_user']; ?>" required>
		      	<input type="hidden" name="provider_name" class="form-control" id="provider_name" value="<?php echo $provider_name; ?>" required>
               	<input type="hidden" name="provider_logo" class="form-control" id="provider_logo" value="<?php echo $provider_logo; ?>" required>
               	<input type="hidden" name="id_pelanggan" class="form-control" id="id_pelanggan" value="<?php echo $product['id_pelanggan']; ?>" required readonly>
               	<input type="hidden" name="operator_id" class="form-control" id="operator_id" value="<?php echo $product['kode_operator']; ?>" required>
               	<input type="hidden" name="nominal" class="form-control" id="nominal" value="<?php echo $product['nominal_produk']; ?>" required>

               	<input type="hidden" name="nama_pelanggan" class="form-control" id="nama_pelanggan" value="<?php echo $report['nama_pelanggan']; ?>" required>
               	<input type="hidden" name="tarif_daya" class="form-control" id="tarif_daya" value="<?php echo $report['tarif_daya']; ?>" required>

		        <a href="<?php echo site_url('gerai/admin/pembayaran'); ?>" class="btn btn-default">Batal</a>

		        <button type="submit" name="submit" class="btn btn-info pull-right">Konfirmasi</button>

		      </div>
		      <?php echo form_close(); ?>
		      <!-- /.box-footer -->

		  </div>



	</div>

</div>

</div>