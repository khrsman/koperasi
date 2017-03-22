<div class="row" style="margin-top:0px">

	<div class="col-md-10 col-md-offset-0" style="padding:0px;">



		<div class="box box-info">
			
		    <div class="box-header with-border">

		    	



		    	<div class="box-titles">

		    		<div class="row">

		    			<div class="col-md-12">

		    				<center>

		    					<img src="<?php echo $provider_logo; ?>" class="img-responsive" width="150px">

		    				</center>

		    			</div>

		    			<div class="col-md-12">

		    				<h4 class="text-center">Pembayaran Tagihan <?php echo $provider_name; ?></h4>
		    				<h4><?php echo validation_errors(); ?></h4>
		    				
		    				<center>
								<br>
								<span style="padding:6px" class="bg-orange">Saldo Virtual : 
							      <?php if(get_saldo_virtual()!=FALSE): ?>
							        <b>Rp. <?php echo get_saldo_virtual(); ?></b>
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

		    <?php  

	            $attributes = array('class'=>'form-horizontal');

	            echo form_open($form_action,$attributes);

	          ?>

		      <div class="box-body">

		        <div class="form-group">

		        	<input type="hidden" name="provider_name" class="form-control" id="provider_name" value="<?php echo $provider_name; ?>" required>

		        	<input type="hidden" name="provider_logo" class="form-control" id="provider_logo" value="<?php echo $provider_logo; ?>" required>

		        	<input type="hidden" name="operator_id" class="form-control" id="operator_id" value="<?php echo $operator_id; ?>" required>

		        	
		        </div>


		        <div class="form-group">
		        	<label for="kode_area" class="col-sm-4 control-label">Kode Area</label>
		          	<div class="col-sm-8">
		            	<input type="number" name="kode_area" min="0" class="form-control" id="kode_area" placeholder="" value="<?php echo set_value('kode_area') ?>" required>
		          	</div>
		        </div>

		        <div class="form-group">
		        	<label for="no_telepon" class="col-sm-4 control-label">No. Telepon</label>
		          	<div class="col-sm-8">
		            	<input type="number" name="no_telepon" min="0" class="form-control" id="no_telepon" placeholder="" value="<?php echo set_value('no_telepon') ?>" required>
		          	</div>
		        </div>


		        

		      </div>

		      <!-- /.box-body -->

		      <div class="box-footer">

		        <a href="<?php echo site_url('gerai/pembayaran'); ?>" class="btn btn-default">Batal</a>

		        <button type="submit" name="submit" class="btn btn-info pull-right">Kirim</button>

		      </div>

		      <!-- /.box-footer -->

		    <?php echo form_close(); ?>

		  </div>



	</div>

</div>