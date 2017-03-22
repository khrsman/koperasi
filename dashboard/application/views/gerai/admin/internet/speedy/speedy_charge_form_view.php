<div class="row" style="margin-top:0px">

	<div class="col-md-8 col-md-offset-2"">



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
		          <label for="id_user" class="col-sm-3 control-label">ID Anggota</label>
		          <div class="col-sm-9">
		            <!-- <input type="number" name="id_user" min="0" class="form-control" id="id_user" placeholder="Masukan ID User" value="<?php echo set_value('id_user') ?>" required> -->
		            <select id="id_user" class="selectpicker_user with-ajax search-select form-control" name="id_user" data-live-search="true" required=""></select>
		            <p class="help-block">*Harus merupakan Anggota Koperasi</p>
		          </div>
		        </div>


		        <div class="form-group">
		        	<label for="kode_area" class="col-sm-3 control-label">ID Pelanggan</label>
		          	<div class="col-sm-9">
		            	<input type="number" name="id_pelanggan" min="0" class="form-control" id="id_pelanggan" placeholder="" value="<?php echo set_value('id_pelanggan') ?>" required>
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





<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/style.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/bootstrap-select.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/ajax-bootstrap-select.css"/>

<script type="text/javascript" src="<?php echo base_url() ?>assets/AdminLTE-2.0.5/plugins/jQuery/jQuery-2.1.3.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/ajax-bootstrap-select.js"></script>
<script type="text/javascript">
  

$('.selectpicker').selectpicker('val', ['Mustard','Relish']);
</script>


<script type="text/javascript">
    var options = {
        ajax          : {
            url     : '<?php echo site_url()."gerai/admin/pulsa/search_anggota_kopearasi"; ?>',
            type    : 'POST',
            dataType: 'json',
            data    : {
                keyword: '{{{q}}}'
            }
        },
        locale        : {
            currentlySelected : 'Saat ini dipilih',
            emptyTitle        : 'Cari ID User atau Nama User..',
            errorText         : 'Maaf, terjadi gangguan saat menerima data. Silahkan ulangi',
            searchPlaceholder : 'Cari ID User atau Nama User..',
            statusInitialized : 'Lakukan pencarian user',
            statusNoResults   : 'Pencarian tidak ditemukan',
            statusSearching   : 'Mencari...'
        },
        log           : 3,
        preprocessData: function (data) {
            var i, l = data.length, array = [];
            if (l) {
                for (i = 0; i < l; i++) {
                    array.push($.extend(true, data[i], {
                        text : data[i].text,
                        value: data[i].id,
                    }));
                }
            }

            return array;
        }
    };

    $('.selectpicker_user').selectpicker().filter('.with-ajax').ajaxSelectPicker(options);


</script>