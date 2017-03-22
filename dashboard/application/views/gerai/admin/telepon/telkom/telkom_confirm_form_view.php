<div class="row" style="margin-top:0px">

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

		    				<h4 class="text-center">Konfirmasi Pembayaran Tagihan <?php echo $report['provider_name']; ?></h4>
		    				
		    			</div>

		    		</div>

		    		

		    	</div>

		      

		    </div>

		    <!-- /.box-header -->

		    <!-- form start -->

			
			<?php if(!empty(validation_errors())): ?>
	        <div class="alert alert-warning alert-dismissable">
	           <?php echo validation_errors(); ?>
	        </div> 
	        <?php endif; ?>


			  <?php  
	            $attributes = array('class'=>'form-horizontal');
	            echo form_open($form_action,$attributes);
	          ?>

		      <div class="box-body">

		      	<!-- DATA USER -->
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


	            <!-- DATA PRODUK -->
	            <legend class="text-muted"><small>Data Produk:</small></legend>

		        <div class="form-group">
		          <label for="phone_number" class="col-sm-3 control-label">Nomor Pelanggan</label>

		          <div class="col-sm-9">
		            <span class="form-control"><b><?php echo $report['kode_area'].'-'.$report['no_telepon']; ?></b></span>
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
		        

		        <!-- KONFIRMASI SALDO -->
		        <legend class="text-muted"><small>Konfirmasi Saldo:</small></legend>
	            <div class="form-group">
	               <label for="operator_code" class="col-sm-3 control-label">Sisa Saldo</label>
	               <div class="col-sm-9">
	                  <span class="form-control"><b>Rp. <?php echo number_format($user_anggota_virtual_account['saldo']-$report['biaya_total'], 0,',','.'); ?></b></span>
	                  <p class="help-block">Saldo dikurangi Harga</p>
	               </div>
	            </div>



	            <!-- MASUKAN NO.HP UNTUK BUKTI PEMBAYARAN -->

		        <div class="form-group">
	               <label for="no_handphone" id="no_handphone" class="col-sm-3 control-label">No. Handphone</label>
	               <div class="col-sm-9">
	                  <input type="number" name="no_handphone" class="form-control" id="no_handphone" placeholder="Masukan No. Handphone" required>
	                  <p class="help-block"><small>*Untuk dikirimkan struk bukti pembayaran</small></p>
	               </div>
	            </div>




		      </div>

		      <!-- /.box-body -->

		      <div class="box-footer">

		      	<input type="hidden" name="id_user" class="form-control" id="id_user" value="<?php echo $user_anggota['id_user']; ?>" required readonly>
		      	<input type="hidden" name="provider_name" class="form-control" id="provider_name" value="<?php echo $provider_name; ?>" required>
               	<input type="hidden" name="provider_logo" class="form-control" id="provider_logo" value="<?php echo $provider_logo; ?>" required>
               	<input type="hidden" name="id_pelanggan" class="form-control" id="id_pelanggan" value="<?php echo $report['msisdn']; ?>" required readonly>

               	<input type="hidden" name="kode_area" class="form-control" id="kode_area" value="<?php echo $report['kode_area']; ?>" required readonly>

               	<input type="hidden" name="no_telepon" class="form-control" id="no_telepon" value="<?php echo $report['no_telepon']; ?>" required readonly>

               	<input type="hidden" name="operator_id" class="form-control" id="operator_id" value="<?php echo $report['kode_operator']; ?>" required>

               	<input type="hidden" name="nama_pelanggan" class="form-control" id="nama_pelanggan" value="<?php echo $report['nama_pelanggan']; ?>" required>
               	
               	<input type="hidden" name="biaya_tagihan" class="form-control" id="biaya_tagihan" value="<?php echo $report['biaya_tagihan']; ?>" required>
               	<input type="hidden" name="biaya_admin" class="form-control" id="biaya_admin" value="<?php echo $report['biaya_admin']; ?>" required>
               	<input type="hidden" name="biaya_total" class="form-control" id="biaya_total" value="<?php echo $report['biaya_total']; ?>" required>

		        <a href="<?php echo site_url('gerai/pembayaran'); ?>" class="btn btn-default">Batal</a>

		        <button type="submit" name="submit" class="btn btn-info pull-right">Konfirmasi</button>

		      </div>
		      <?php echo form_close(); ?>
		      <!-- /.box-footer -->

		  </div>



	</div>

</div>

</div>