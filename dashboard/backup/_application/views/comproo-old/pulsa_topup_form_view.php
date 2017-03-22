<div class="row" style="margin-top:100px">
	<div class="col-md-4 col-md-offset-4" style="padding:20px;">

		<div class="box box-info">
		    <div class="box-header with-border">
		    	

		    	<div class="box-titles">
		    		<div class="row">
		    			<div class="col-md-12">
		    				<center>
		    					<img src="<?php echo $provider_logo; ?>" class="img-responsive" width="75px">
		    				</center>
		    			</div>
		    			<div class="col-md-12">
		    				<h4 class="text-center">Topup Pulsa <?php echo $provider_name; ?></h4>
		    			</div>
		    		</div>
		    		
		    	</div>
		      
		    </div>
		    <!-- /.box-header -->
		    <!-- form start -->
		    <form class="form-horizontal">
		      <div class="box-body">
		        <div class="form-group">
		          <label for="phonenumber" class="col-sm-3 control-label">Nomor HP</label>

		          <div class="col-sm-9">
		            <input name="phone_number" class="form-control" id="phonenumber" placeholder="Nomor HP" required>
		          </div>
		        </div>

		        <div class="form-group">
		          <label for="nominal" class="col-sm-3 control-label">Nominal</label>

		          <div class="col-sm-9">
		            <select class="form-control" id="nominal" name="nominal" required>
	                    <option value="10000">10.000</option>
	                    <option value="25000">25.000</option>
	                    <option value="50000">50.000</option>
	                    <option value="100000">100.000</option>
	                  </select>
		          </div>
		        </div>
		        
		      </div>
		      <!-- /.box-body -->
		      <div class="box-footer">
		        <a href="<?php echo site_url('pulsa'); ?>" class="btn btn-default">Batal</a>
		        <button type="submit" class="btn btn-info pull-right">Kirim</button>
		      </div>
		      <!-- /.box-footer -->
		    </form>
		  </div>

	</div>
</div>