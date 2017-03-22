<div class="row" >

	<div class="col-md-10 " >



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
		    				<br>
		    				<center>
            <span style="padding:6px;color:black;" class="bg-orange"><font color="black">Saldo Virtual : </font>
               <?php if(get_saldo_virtual()!=FALSE): ?>
                 <b style="color:black;">Rp. <?php echo get_saldo_virtual(); ?></b>
               <?php else: ?>
                 <b>Tidak Ada.</b>  
               <?php endif; ?>
             </span>
             </center>
		    			</div>

		    		</div>

		    		

		    	</div>

		      

		    </div>

		    <!-- /.box-header -->

		    <!-- form start -->

			
			<?php if(!empty(form_error('pin'))): ?>
	        <div class="alert alert-danger alert-dismissable">
	           <?php echo form_error('pin'); ?>
	        </div> 
	        <?php endif; ?>


			  <?php  
	            $attributes = array('class'=>'form-horizontal');
	            echo form_open($form_action,$attributes);
	          ?>

		      <div class="box-body">

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
		        

		        <div class="form-group">
	               <label for="no_handphone" id="no_handphone" class="col-sm-3 control-label">No. Handphone</label>
	               <div class="col-sm-9">
	                  <input type="number" name="no_handphone" class="form-control" id="no_handphone" placeholder="Masukan No. Handphone" required>
	                  <p class="help-block"><small>*Untuk dikirimkan struk bukti pembayaran</small></p>
	               </div>
	            </div>

		        <div class="form-group">
	               <label for="pin" id="pin" class="col-sm-3 control-label">PIN</label>
	               <div class="col-sm-9">
	                  <input type="password" name="pin" class="form-control" id="pin" placeholder="Masukan PIN" required>
	               </div>
	            </div>


		      </div>

		      <!-- /.box-body -->

		      <div class="box-footer">

		      	<input type="hidden" name="provider_name" class="form-control" id="provider_name" value="<?php echo $provider_name; ?>" required>
               	<input type="hidden" name="provider_logo" class="form-control" id="provider_logo" value="<?php echo $provider_logo; ?>" required>
               	<input type="hidden" name="id_pelanggan" class="form-control" id="id_pelanggan" value="<?php echo $report['msisdn']; ?>" required readonly>

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