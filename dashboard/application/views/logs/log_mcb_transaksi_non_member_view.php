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
          <!-- <h3 class="box-title">Data Table</h3> -->

          <div class="row">
            <div class="col-sm-12 col-md-4 hidden">
              <h4>Sumber Dana : 
                <?php foreach($filter_sumber_dana as $k => $v): ?>
                  <a href="<?php echo site_url('logs/log_mcb_transaksi_non_member/l').update_query_string('filter_sumber_dana',$v['alias']); ?>" 
                    style="margin:5px 5px 5px 0px;font-size:11.5px;"
                    <?php if ($param_filter_sumber_dana == $v['alias']): ?>
                    class="label label-info"
                    <?php else: ?>
                    class="label label-default"
                    <?php endif; ?>
                    >
                    <?php echo $v['alias']; ?>
                  </a>
                <?php endforeach; ?>
              </h4>
            </div>
            <div class="col-sm-12 col-md-8 hidden">
              <h4>Account : 
                <?php foreach($filter_jenis_account as $k => $v): ?>
                  <a href="<?php echo site_url('logs/log_mcb_transaksi_non_member/l').update_query_string('filter_jenis_account',$v['alias']); ?>" 
                    style="margin:5px 5px 5px 0px;font-size:11.5px;"
                    <?php if ($param_filter_jenis_account == $v['alias']): ?>
                    class="label label-info"
                    <?php else: ?>
                    class="label label-default"
                    <?php endif; ?>
                    >
                    <?php echo $v['alias']; ?>
                  </a>
                <?php endforeach; ?>
              </h4>
            </div>

            <div class="col-md-12 hidden">
              <hr>
            </div>

            <div class="col-sm-12 col-md-6">
              <?php  
                $attributes = array('class'=>'form-inline','method'=>'GET');
                echo form_open(site_url('logs/log_mcb_transaksi_non_member/l'),$attributes);
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

            <div class="col-sm-6 col-md-4">
              <span class="text-muted">Urutkan : </span>
              <select class="text-muted select-redirect">
                <?php foreach($sort as $k => $v): ?>
                  <option value="<?php echo site_url('logs/log_mcb_transaksi_non_member/l').update_query_string('sort',$v['alias']); ?>" <?php if($v['alias']==$param_sort){echo 'selected';} ?>><?php echo $v['alias']; ?></option>
                <?php endforeach; ?>  
              </select>
              <select class="text-muted select-redirect">
                <?php foreach($sort_order as $k => $v): ?>
                  <option value="<?php echo site_url('logs/log_mcb_transaksi_non_member/l').update_query_string('sort_order',$v['alias']); ?>" <?php if($v['alias']==$param_sort_order){echo 'selected';} ?>><?php echo $v['alias']; ?></option>
                <?php endforeach; ?>  
              </select>
            </div>

            <div class="col-sm-6 col-md-4">
              <span class="text-muted">Account : </span>
              <select class="text-muted select-redirect">
                <?php foreach($filter_jenis_account as $k => $v): ?>
                  <option value="<?php echo site_url('logs/log_mcb_transaksi_non_member/l').update_query_string('filter_jenis_account',$v['alias']); ?>" <?php if($v['alias']==$param_filter_jenis_account){echo 'selected';} ?>><?php echo $v['alias']; ?></option>
                <?php endforeach; ?>  
              </select>
            </div>

            <div class="col-sm-6 col-md-4">
              <span class="text-muted">Sumber Dana : </span>
              <select class="text-muted select-redirect">
                <?php foreach($filter_sumber_dana as $k => $v): ?>
                  <option value="<?php echo site_url('logs/log_mcb_transaksi_non_member/l').update_query_string('filter_sumber_dana',$v['alias']); ?>" <?php if($v['alias']==$param_filter_sumber_dana){echo 'selected';} ?>><?php echo $v['alias']; ?></option>
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
                <th>Tanggal</th>
                <th>Tipe</th>
                <th>No.Rek</th>
                <th>Nama</th>
                <th>Account</th>
                <th>Total Profit</th>
                <th>Share</th>
                <th>Nilai Trx</th>
                <th>Saldo Awal</th>
                <th>Saldo Akhir</th>
                <th>Sumber Dana</th>
                <th>No.Referensi</th>
                <th class="hidden">Aksi</th>
              </tr>
            </thead>
            <tbody>

            <?php if(!empty($datadb)): ?>
            <?php foreach ($datadb as $k => $v):?>		
              <tr>
                <td><?php echo date('d M Y, H:i',strtotime($v['tanggal_transaksi'])); ?></td>
                <td><?php echo $v['tipe_transaksi']; ?></td>
                <td><?php echo $v['no_rekening_non_member']; ?></td>
                <td><?php echo $v['pemilik_rekening']; ?></td>
                <td><?php echo $v['jenis_account']; ?></td>
                <td><?php echo number_format($v['total_profit'],0,',','.'); ?></td>
                <td><?php echo number_format($v['share_persen'],2,',','.'); ?>%</td>
                <td><?php echo number_format($v['nilai_transaksi'],0,',','.'); ?></td>
                <td><?php echo $v['saldo_awal']?number_format($v['saldo_awal'],0,',','.'):''; ?></td>
                <td><?php echo $v['saldo_akhir']?number_format($v['saldo_akhir'],0,',','.'):''; ?></td>
                <td><?php echo $v['sumber_dana']; ?></td>
                <td><?php echo $v['no_ref_transaksi']; ?></td>
                <td class="hidden">
                  <a class="btn btn-sm btn-default" href="#" title="Detail"><i class="fa fa-file"></i></a>
                </td>
              </tr>
            <?php endforeach; ?>  
            <?php endif; ?>
              
            </tbody>
            <tfoot>
              <tr>
                <th>Tanggal</th>
                <th>Tipe</th>
                <th>No.Rek</th>
                <th>Nama</th>
                <th>Account</th>
                <th>Total Profit</th>
                <th>Share</th>
                <th>Nilai Trx</th>
                <th>Saldo Awal</th>
                <th>Saldo Akhir</th>
                <th>Sumber Dana</th>
                <th>No.Referensi</th>
                <th class="hidden">Aksi</th>
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