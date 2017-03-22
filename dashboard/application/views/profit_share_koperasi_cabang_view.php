<div class="row">

  <?php if($this->session->flashdata('flash_msg')==TRUE): ?>
  <div class="col-md-12">
    <div class="alert alert-<?php echo $this->session->flashdata('flash_msg_type') ?> alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <?php
        if ($this->session->flashdata('flash_msg_status')==TRUE) {
          echo "<i class='icon fa fa-check'></i>";
        } else{
          echo "<i class='icon fa fa-close'></i>";
        }
      ?>
      <?php echo $this->session->flashdata('flash_msg_text'); ?>
    </div>
  </div>
  <?php endif; ?>

	<div class="col-md-12">

		<div class="box">
        <div class="box-header">

          <div class="row">
            
            <div class="col-md-7">
            <h4><i class="fa fa-share" style="margin-right:7px"></i> Profit Share Koperasi Cabang</h4>
            </div>

            
            <div class="col-md-5 pull-right">
              <?php  
                $attributes = array('class'=>'form-inline','method'=>'GET');
                echo form_open(site_url('profit_share_koperasi_cabang/l'),$attributes);
              ?>
                <?php search_hidden_query_string(); ?>
                <div class="form-group">
                  <h4>Pencarian : </h4>
                </div>
                <div class="form-group">
                  <select class="form-control" name="keyword_by">
                    <?php foreach($keyword_by as $k => $v): ?>
                      <option value="<?php echo $v['alias']; ?>" <?php if($v['alias']==$param_keyword_by){echo 'selected';} ?>><?php echo $v['alias']; ?></option>
                    <?php endforeach; ?> 
                  </select>
                </div>
                
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="ketik kata kunci" name="q"
                  value="<?php if(!$keyword){echo '';}else{echo $keyword;} ?>"
                  >
                </div>

                <button class="btn btn-default btn-flat" type="submit"><i class="fa fa-search"></i> Cari</button>

              <?php echo form_close(); ?>
            </div>
            <div class="col-md-12">
              <hr>
            </div>

            <div class="col-md-3">
              <span class="text-muted">Urutkan : </span>
              <select class="text-muted select-redirect">
                <?php foreach($sort as $k => $v): ?>
                  <option value="<?php echo site_url('profit_share_koperasi_cabang/l').update_query_string('sort',$v['alias']); ?>" <?php if($v['alias']==$param_sort){echo 'selected';} ?>><?php echo $v['alias']; ?></option>
                <?php endforeach; ?>  
              </select>
              <select class="text-muted select-redirect">
                <?php foreach($sort_order as $k => $v): ?>
                  <option value="<?php echo site_url('profit_share_koperasi_cabang/l').update_query_string('sort_order',$v['alias']); ?>" <?php if($v['alias']==$param_sort_order){echo 'selected';} ?>><?php echo $v['alias']; ?></option>
                <?php endforeach; ?>  
              </select>
            </div>
            
            <div class="col-md-4">
                <!-- <span class="pull-right text-muted">Hasil Pencarian</span> -->
            </div>
          </div>

        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="table-1" class="table table-bordered table-consended table-hover">
            <thead>
              <tr>
              	<th>ID</th>
                <th>Koperasi</th>
                <th>Share Cabang</th>
                <th>Share Induk</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>

            <?php if(!empty($data_koperasi)): ?>
            <?php foreach ($data_koperasi as $k => $v):?>		
              <tr>
                <td>
                   <?php echo $v['id_koperasi']; ?>
                </td>
                
                <td>
                  <div>
                    <b><?php echo $v['nama_koperasi']; ?></b><br>
                      <small>
                        KEL. <?php echo $v['nama_kelurahan']; ?>, KEC. <?php echo $v['nama_kecamatan']; ?>, <?php echo $v['nama_kabupaten']; ?>, PROV. <?php echo $v['nama_provinsi']; ?><?php echo !empty($v['kode_pos'])?', KODE POS '.$v['kode_pos']:''; ?>
                        <br>
                        Alamat : <?php echo $v['alamat_koperasi']; ?>
                      </small>
                  </div>
                </td>

                <td>
                   <?php echo number_format($v['share_cabang'],0).'%'; ?>
                </td>
                <td>
                   <?php 
                      $share_induk = 100-$v['share_cabang'];
                      echo number_format($share_induk,0).'%'; 
                    ?>
                </td>
                
                <td>
                  <a class="btn btn-sm btn-info" href="<?php echo site_url('profit_share_koperasi_cabang/edit_share').'/'.$v['id_koperasi']; ?>">Edit</a>
                </td>
              </tr>
            <?php endforeach; ?>  
            <?php endif; ?>
              
            </tbody>
            <tfoot>
              <tr>
                <th>ID</th>
                <th>Koperasi</th>
                <th>Share Cabang</th>
                <th>Share Induk</th>
                <th>Aksi</th>
              </tr>
            </tfoot>
          </table>
          <?php echo $pagination; ?>

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