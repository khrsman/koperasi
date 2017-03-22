<div class="row">


	<div class="col-md-12">

		<div class="box">
        <div class="box-header">

          <div class="row">
            
            <div class="col-md-7">
            <h4><i class="fa fa-share" style="margin-right:7px"></i> Profit Share Koperasi Cabang</h4>
            </div>

          </div>

        </div><!-- /.box-header -->
        
        <div class="box-body">

          <?php if(!empty(validation_errors())): ?>
          <div class="alert alert-danger alert-dismissable">
             <?php echo validation_errors(); ?>
          </div> 
          <?php endif; ?>


          <?php  
            $attributes = array('class'=>'form-horizontal');
            echo form_open($form_action,$attributes);
          ?>

          <table id="table-1" class="table table-bordered table-consended">

            <tbody>

             
              <tr>
                <td style="width:25%">ID Koperasi</td>
                <td><?php echo $data_koperasi['id_koperasi']; ?></td>
              </tr>
              <tr>
                <td>Nama Koperasi</td>
                <td><?php echo $data_koperasi['nama_koperasi']; ?></td>
              </tr>
              <tr>
                <td>Alamat</td>
                <td><?php echo $data_koperasi['alamat_koperasi']; ?></td>
              </tr>
              <tr>
                <td>Kota / Kabupaten</td>
                <td><?php echo $data_koperasi['nama_kabupaten']; ?></td>
              </tr>
              <tr>
                <td>Provinsi</td>
                <td><?php echo $data_koperasi['nama_provinsi']; ?></td>
              </tr>
              <tr>
                <td>Share (%)</td>
                <td>
                  <input class="form-control" style="width:150px" type="number" step="0.1" min="0" max="100" name="share" value="<?php echo number_format($data_koperasi['share_cabang'],0); ?>" required />
                </td>
              </tr>
              <tr>
                <td></td>
                <td>
                  <button type="submit" class="btn btn-info">Simpan</button>&nbsp;&nbsp;
                  <a href="<?php echo site_url('profit_share_koperasi_cabang'); ?>" class="btn btn-default">Batal</a>
                </td>
              </tr>

              
            </tbody>
           
          </table>

          <?php echo form_close(); ?>

        </div><!-- /.box-body -->
      </div><!-- /.box -->

	</div>
</div>


<script type="text/javascript">
  // get your select element and listen for a change event on it
  $('.select-redirect').change(function() {
    // set the window's location property to the value of the option the user has selected
    document.location = $(this).val();
  });


</script>