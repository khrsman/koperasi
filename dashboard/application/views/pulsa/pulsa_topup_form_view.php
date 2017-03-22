<div class="row" style="margin-top:0px">

	<div class="col-md-8 " >



		<div class="box box-info">
		
		    <div class="box-header with-border">

		    	



		    	<div class="box-titles">

		    		<div class="row">

		    			<div class="col-md-12" style="padding-top:0px;">

		    				<center>

		    					<img src="<?php echo $provider_logo; ?>" class="img-responsive" width="150px">

		    				</center>

		    			</div>

		    			<div class="col-md-12">

		    				<h4 class="text-center">Topup Pulsa <?php echo $provider_name; ?></h4>
		    				<h4><?php echo validation_errors(); ?></h4>
		    				<center>
            <br>
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

		    <?php  

	            $attributes = array('class'=>'form-horizontal');

	            echo form_open($form_action,$attributes);

	          ?>

		      <div class="box-body">

		        <div class="form-group">

		        <input type="hidden" name="provider_name" class="form-control" id="provider_name" value="<?php echo $provider_name; ?>" required>

		        	<input type="hidden" name="provider_logo" class="form-control" id="provider_logo" value="<?php echo $provider_logo; ?>" required>

		          <input type="hidden" name="operator_id" class="form-control" id="operator_id" value="<?php echo $operator_id; ?>" required>

		          <label for="phone_number" class="col-sm-3 control-label">Nomor HP</label>



		          <div class="col-sm-9">

		            <input type="number" name="phone_number" min="0" class="form-control" id="phone_number" placeholder="Nomor HP" value="<?php echo set_value('phone_number') ?>"required>

		          </div>

		        </div>



		        <div class="form-group">

		          <label for="nominal" class="col-sm-3 control-label">Nominal</label>



		          <div class="col-sm-9">

		            <select class="form-control" id="nominal" name="nominal" required>

		            	<?php 

		            		if(!empty($products)): 

							foreach ($products as $k => $v):
							$nominal = $v['nominal_produk'];	
							$str_nominal = number_format($v['nominal_produk'], 0,',','.');

						?>

	                    <option value="<?php echo $nominal; ?>"><?php echo $str_nominal; ?></option>

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

		        <a href="<?php echo site_url('gerai/pulsa'); ?>" class="btn btn-danger">Batal</a>

		        <button type="submit" name="submit" class="btn btn-info pull-right">Kirim</button>

		      </div>

		      <!-- /.box-footer -->

		    <?php echo form_close(); ?>

		  </div>



	</div>



</div>