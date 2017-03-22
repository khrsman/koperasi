<?php
$this->load->view('template/head');
?>
<!--tambahkan custom css disini-->
<link href="<?= base_url() ?>assets/select2-4.0.2/dist/css/select2.min.css" rel="stylesheet" />
<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
  Data Sharing Profit Koperasi
  <!-- <small>it all starts here</small> -->
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Data Sharing Profit Koperasi</a></li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
<div class="row">
  <div class="col-xs-12">
     <?php
                        if($this->session->flashdata('msg') !=NULL){
                            echo '<div class="alert alert-info" role="alert" style="padding: 6px 12px;height:34px;">';
                            echo "<i class='fa fa-info-circle'></i> <strong><span style='margin-left:10px;'>".$this->session->flashdata('msg')."</span></strong>";
                            echo '</div>';
                        }?>
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Pencarian</h3>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-xs-12 col-sm-8 col-lg-8">
            <?php
            $attributes = array('class'=>'form-inline','method'=>'GET');
            echo form_open(site_url('cabang_koperasi'),$attributes);
            ?>
            <?php search_hidden_query_string(); ?>
            <div class="form-group">
              <label for="keyword">Cari Berdasarkan Kata Kunci :</label>
              <select class="form-control" name="keyword_by">
                <?php foreach($keyword_by as $k => $v): ?>
                <option value="<?php echo $v['alias']; ?>" <?php if($v['alias']==$param_keyword_by){echo 'selected';} ?>><?php echo $v['alias']; ?></option>
                <?php endforeach; ?>
              </select>
              <div class="input-group">
                <input type="text" class="form-control" placeholder="ketik kata kunci" name="q"
                value="<?php if(!$keyword){echo '';}else{echo $keyword;} ?>"
                >
                <span class="input-group-btn">
                  <button type="submit" class="btn btn-info">
                  <i class="fa fa-search"></i> Cari</button>
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

  <div class="clear-both"></div>
  <div class="row">
    <div class="col-xs-12">
        <div class="box">
          <div class="box-header with-border">
            <!-- <h3 class="box-title">Data Table</h3> -->
            <div class="row">
              <div class="col-md-3">
                <span class="text-muted">Urutkan : </span>
                <select class="text-muted select-redirect">
                  <?php foreach($sort as $k => $v): ?>
                  <option value="<?php echo site_url('cabang_koperasi').update_query_string('sort',$v['alias']); ?>" <?php if($v['alias']==$param_sort){echo 'selected';} ?>><?php echo $v['alias']; ?></option>
                  <?php endforeach; ?>
                </select>
                <select class="text-muted select-redirect">
                  <?php foreach($sort_order as $k => $v): ?>
                  <option value="<?php echo site_url('cabang_koperasi').update_query_string('sort_order',$v['alias']); ?>" <?php if($v['alias']==$param_sort_order){echo 'selected';} ?>><?php echo $v['alias']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            </div><!-- /.box-header -->
            <div class="box-body">
              <table id="table-1" class="table table-bordered table-consended table-hover">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>No Telepon</th>
                    <?php if($this->session->userdata('level') != 1): ?>
                    <th>Koperasi Induk</th>
                    <?php endif ?>
                    <th>Share Profit</th>
                    <th style="text-align: center">Detail Profit</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if(!empty($datadb)): ?>
                  <?php foreach ($datadb as $k => $v):?>
                  <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $v['nama']; ?></td>
                    <td><?php echo $v['username']; ?></td>
                    <td><?php echo $v['telp']; ?></td>
                    <?php if($this->session->userdata('level') != 1): ?>

                    <td><?= $this->koperasi_mod->get_induk_koperasi($v['parent_koperasi'])->row_array()['nama']; ?></td>
                  <?php endif ?>
                    <td  style="text-align:right"><?php echo $v['share_cabang']; ?></td>
                    <td style="text-align: center"> 
                        <a class="" href="<?= base_url()?>profit_koperasi/<?= $v['id_koperasi'] ?>">Lihat Profit</a>
                    </td>
                    <td> 
                        <a class="btn btn-success" href="<?= base_url()?>edit_profit/<?= $v['id_koperasi'] ?>"><i class="fa fa-pencil"></i></a>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                  <?php endif; ?>
                  
                </tbody>
                <tfoot>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Username</th>
                  <th>No Telepon</th>
                    <?php if($this->session->userdata('level') != 1): ?>
                    <th>Koperasi Induk</th>
                    <?php endif ?>
                  <th>Share Profit</th>
                  <th style="text-align: center">Detail Profit</th>
                  <th>Aksi</th>
                </tr>
                </tfoot>
              </table>
              <?php echo $pagination; ?>
              </div><!-- /.box-body -->
              </div><!-- /.box -->
            
          </div>
          </div><!-- /.row -->
          </section><!-- /.content -->
          <?php
          $this->load->view('template/js');
          ?>
<!--tambahkan custom js disini-->
<script type="text/javascript">
  // get your select element and listen for a change event on it
  $('.select-redirect').change(function() {
    // set the window's location property to the value of the option the user has selected
    document.location = $(this).val();
  });


</script>
<?php
$this->load->view('template/foot');
?>