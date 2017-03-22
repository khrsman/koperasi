<div class="row" style="margin-top:100px">

	<div class="col-md-6 col-md-offset-3" style="padding:20px;">



		<div class="box box-info">
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
		    <div class="box-header with-border">

		    	



		    	<div class="box-titles">

		    		<div class="row">

		    			<div class="col-md-12">

		    				<center>

		    					<img src="<?php echo $provider_logo; ?>" class="img-responsive" width="75px">

		    				</center>

		    			</div>

		    			<div class="col-md-12">

		    				<h4 class="text-center">Pembelian <?php echo $provider_name; ?></h4>
		    				<h4><?php echo validation_errors(); ?></h4>

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

		          <label for="msisdn" class="col-sm-4 control-label">Nomor Meter/Pelanggan</label>



		          <div class="col-sm-8">

		            <input type="number" name="msisdn" min="0" class="form-control" id="msisdn" placeholder="" value="<?php echo set_value('msisdn') ?>"required>

		          </div>

		        </div>



		        <div class="form-group">

		          <label for="operator_code" class="col-sm-4 control-label">Nominal</label>



		          <div class="col-sm-8">

		            <select class="form-control" id="operator_code" name="operator_code" required>

		            	<?php 

		            		if(!empty($products)): 

							foreach ($products as $k => $v):

							$kode_operator = $v['kode_operator'];

							$nominal = explode('.', $kode_operator);

							$nominal = number_format($nominal[1].'000', 0,',','.');

						?>

	                    <option value="<?php echo $kode_operator; ?>"><?php echo $nominal; ?></option>

	                	<?php 

	                		endforeach;

	                		endif; 

	                	?>

	                  </select>

		          </div>

		        </div>

		        

		      </div>

		      <!-- /.box-body -->

		      <div class="box-footer">

		        <a href="<?php echo site_url('gerai/pembayaran'); ?>" class="btn btn-default">Batal</a>

		        <button type="submit" class="btn btn-info pull-right">Kirim</button>

		      </div>

		      <!-- /.box-footer -->

		    <?php echo form_close(); ?>

		  </div>



	</div>

</div>