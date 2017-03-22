<div class="row" >
   <div class="col-md-8 " >
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
                     <h4 class="text-center">Konfirmasi Topup Pulsa <?php echo $provider_name; ?></h4>
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


         
        <?php if (!empty(validation_errors())): ?>
         <div class="row">
            <div class="alert alert-danger alert-dismissable">
               <?php echo validation_errors(); ?>
            </div> 
        </div>
         <?php endif; ?>
       


         <?php  
            $attributes = array('class'=>'form-horizontal');
            
            echo form_open($form_action,$attributes);
            
            ?>
         <div class="box-body">
            <div class="form-group">
               <input type="hidden" name="provider_name" class="form-control" id="provider_name" value="<?php echo $provider_name; ?>" required>
               <input type="hidden" name="provider_logo" class="form-control" id="provider_logo" value="<?php echo $provider_logo; ?>" required>
               <input type="hidden" name="phone_number" class="form-control" id="phone_number" value="<?php echo $product['phone_number']; ?>" required readonly>
               <input type="hidden" name="operator_id" class="form-control" id="operator_id" value="<?php echo $product['kode_operator']; ?>" required>
               <input type="hidden" name="nominal" class="form-control" id="nominal" value="<?php echo $product['nominal_produk']; ?>" required>
               <label for="phone_number" class="col-sm-3 control-label">Nomor HP</label>
               <div class="col-sm-9">
                  <span class="form-control"><b><?php echo $product['phone_number']; ?></b></span>
               </div>
            </div>
            <div class="form-group">
               <label for="operator_code" class="col-sm-3 control-label">Kode Operator</label>
               <div class="col-sm-9">
                  <span class="form-control"><b><?php echo $product['kode_operator']; ?></b></span>
               </div>
            </div>
            <div class="form-group">
               <label for="operator_code" class="col-sm-3 control-label">Nominal</label>
               <div class="col-sm-9">
                  <span class="form-control"><b>Rp. 
                  <?php
                     $nominal = $product['nominal_produk'];
                     
                     echo number_format($nominal, 0,',','.');
                     
                     ?>
                  </b></span>
               </div>
            </div>
            <div class="form-group">
               <label for="operator_code" class="col-sm-3 control-label">Harga</label>
               <div class="col-sm-9">
                  <span class="form-control"><b>Rp. <?php echo number_format($product['harga_gerai'], 0,',','.'); ?></b></span>
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
            <a href="<?php echo site_url('gerai/pulsa'); ?>" class="btn btn-default">Batal</a>
            <button type="submit" class="btn btn-info pull-right">Konfirmasi</button>
         </div>
         <!-- /.box-footer -->
         <?php echo form_close(); ?>
      </div>
   </div>
</div>
</div>