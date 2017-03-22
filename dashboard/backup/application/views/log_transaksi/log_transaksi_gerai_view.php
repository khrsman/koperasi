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
  Data Transaksi <?= ucfirst($this->uri->segment(2)) ?>
  <!-- <small>it all starts here</small> -->
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Data Transaksi <?= ucfirst($this->uri->segment(2)) ?></a></li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Pencarian</h3>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-xs-12 col-sm-5 col-lg-5">
              <?php
              $attributes = array('class'=>'form-inline','method'=>'GET');
              echo form_open(site_url('transaksi/gerai'),$attributes);
              ?>
              <?php search_hidden_query_string(); ?>
              <div class="form-group">
                <label for="keyword">Cari Berdasarkan Kata Kunci :</label><br />
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
              <?php echo form_close(); ?>
            </div>
            
            <?php if($this->session->userdata('level') == '1'){ ?>
            <div class="col-xs-12 col-sm-6 col-lg-6">
              <?php
              $attributes = array('class'=>'form-inline','method'=>'GET');
              echo form_open(site_url('transaksi/gerai'),$attributes);
              ?>
              <?php search_hidden_query_string(); ?>
              <div class="form-group">
                <label for="keyword">Cari Berdasarkan Koperasi :</label><br />
                <select class="js-data-example-ajax" name="filter_koperasi">
                  <?php foreach($filter_koperasi as $k => $v): ?>
                  <option value="<?php echo $v['alias']; ?>" <?php if($v['alias']==$param_filter_koperasi){echo 'selected';} ?>><?php echo $v['alias']; ?></option>
                  <?php endforeach; ?>
                </select>
                <button class="btn btn-info" type="submit"><i class="fa fa-search"></i> Cari</button>
                <?php echo form_close(); ?>
              </div>
            </div>
            <?php } ?>
            
          </div>
          <div class="row">
            <div class="col-xs-12 col-sm-5 col-lg-5">
              <?php
              $attributes = array('class'=>'form-inline','method'=>'GET');
              echo form_open(site_url('transaksi/gerai'),$attributes);
              ?>
              <?php search_hidden_query_string(); ?>
              <div class="form-group">
                <label for="keyword">Cari Berdasarkan Tanggal, Bulan dan Tahun :</label><br />
                <select name="filter_tanggal" class="form-control">
                  <?php foreach($filter_tanggal as $k => $v): ?>
                  <option value="<?php echo $v['alias']; ?>" <?php if($v['alias']==$param_filter_tanggal){echo 'selected';} ?>><?php echo $v['alias']; ?></option>
                  <?php endforeach; ?>
                </select>
                <select name="filter_bulan" class="form-control">
                  <?php foreach($filter_bulan as $k => $v): ?>
                  <option value="<?php echo $v['alias']; ?>" <?php if($v['alias']==$param_filter_bulan){echo 'selected';} ?>><?php echo $v['alias']; ?></option>
                  <?php endforeach; ?>
                </select>
                <select name="filter_tahun" class="form-control">
                  <?php foreach($filter_tahun as $k => $v): ?>
                  <option value="<?php echo $v['alias']; ?>" <?php if($v['alias']==$param_filter_tahun){echo 'selected';} ?>><?php echo $v['alias']; ?></option>
                  <?php endforeach; ?>
                </select>
                <button class="btn btn-info" type="submit"><i class="fa fa-search"></i> Cari</button>
              </div>
              <?php echo form_close(); ?>
            </div>
            <div class="col-xs-12 col-sm-4 col-lg-4">
              <?php
              $attributes = array('class'=>'form-inline','method'=>'GET');
              echo form_open(site_url('transaksi/gerai'),$attributes);
              ?>
              <?php search_hidden_query_string(); ?>
              <div class="form-group">
                <label for="keyword">Cari Berdasarkan Bulan dan Tahun :</label><br />
                <select name="filter_bulan" class="form-control">
                  <?php foreach($filter_bulan as $k => $v): ?>
                  <option value="<?php echo $v['alias']; ?>" <?php if($v['alias']==$param_filter_bulan){echo 'selected';} ?>><?php echo $v['alias']; ?></option>
                  <?php endforeach; ?>
                </select>
                <select name="filter_tahun" class="form-control">
                  <?php foreach($filter_tahun as $k => $v): ?>
                  <option value="<?php echo $v['alias']; ?>" <?php if($v['alias']==$param_filter_tahun){echo 'selected';} ?>><?php echo $v['alias']; ?></option>
                  <?php endforeach; ?>
                </select>
                <button class="btn btn-info" type="submit"><i class="fa fa-search"></i> Cari</button>
              </div>
              <?php echo form_close(); ?>
            </div>
            <div class="col-xs-12 col-sm-3 col-lg-3">
              <?php
              $attributes = array('class'=>'form-inline','method'=>'GET');
              echo form_open(site_url('transaksi/gerai'),$attributes);
              ?>
              <?php search_hidden_query_string(); ?>
              <div class="form-group">
                <label for="keyword">Cari Berdasarkan Tahun :</label><br />
                <select name="filter_tahun" class="form-control">
                  <?php foreach($filter_tahun as $k => $v): ?>
                  <option value="<?php echo $v['alias']; ?>" <?php if($v['alias']==$param_filter_tahun){echo 'selected';} ?>><?php echo $v['alias']; ?></option>
                  <?php endforeach; ?>
                </select>
                <button class="btn btn-info" type="submit"><i class="fa fa-search"></i> Cari</button>
              </div>
              <?php echo form_close(); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="clear-both"></div>
    <div class="row">
      <div class="col-xs-12">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <!-- <h3 class="box-title">Data Table</h3> -->
              <div class="row">
                <div class="col-md-6">
                  <span class="text-muted">Urutkan : </span>
                  <select class="text-muted select-redirect">
                    <?php foreach($sort as $k => $v): ?>
                    <option value="<?php echo site_url('transaksi/commerce').update_query_string('sort',$v['alias']); ?>" <?php if($v['alias']==$param_sort){echo 'selected';} ?>><?php echo $v['alias']; ?></option>
                    <?php endforeach; ?>
                  </select>
                  <select class="text-muted select-redirect">
                    <?php foreach($sort_order as $k => $v): ?>
                    <option value="<?php echo site_url('transaksi/commerce').update_query_string('sort_order',$v['alias']); ?>" <?php if($v['alias']==$param_sort_order){echo 'selected';} ?>><?php echo $v['alias']; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                
                <div class="col-md-4">
                  
                </div>
              </div>
              </div><!-- /.box-header -->
              <div class="box-body">
                <table id="table-1" class="table table-bordered table-consended table-hover">
                  <thead>
                    <tr>
                      <th>No Transaksi</th>
                      <th>Nama Anggota Koperasi</th>
                      <th>Nama Koperasi</th>
                      <th>Tanggal Transaksi</th>
                      <th>Harga Datacell</th>
                      <th>Harga Gerai</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if(!empty($datadb)): ?>
                    <?php foreach ($datadb as $k => $v):?>
                    <tr>
                      <td><?php echo $v['no_transaksi_pulsa']; ?></td>
                      <td><?php echo $v['nama_lengkap']; ?></td>
                      <td><?php echo $v['nama']; ?></td>
                      <td><?php echo $v['tanggal_transaksi']; ?></td>
                      <td><?php echo $v['harga_datacell']; ?></td>
                      <td><?php echo $v['harga_gerai']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                    
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>No Transaksi</th>
                    <th>Nama Anggota Koperasi</th>
                    <th>Nama Koperasi</th>
                    <th>Tanggal Transaksi</th>
                    <th>Total Transaksi</th>
                    <th>Harga Gerai</th>
                  </tr>
                  </tfoot>
                </table>
                <?php echo $pagination; ?>
                </div><!-- /.box-body -->
                </div><!-- /.box -->
              </div>
              
            </div>
            </div><!-- /.row -->
            </section><!-- /.content -->
            <?php
            $this->load->view('template/js');
            ?>
<!--tambahkan custom js disini-->
<script src="<?= base_url() ?>assets/select2-4.0.2/dist/js/select2.js"></script>
<script type="text/javascript">
// get your select element and listen for a change event on it
    $('.select-redirect').change(function() {
// set the window's location property to the value of the option the user has selected
      document.location = $(this).val();
  });
  $(".js-data-example-ajax").select2({
    ajax: {
    url: "<?= base_url() ?>koperasi/get_koperasi",
    dataType: 'json',
    delay: 250,
    data: function (params) {
    return {
    q: params.term // search term
    };
    },
    processResults: function (data) {
    return {
    results: data
    };
    },
    cache: true
    },
    minimumInputLength: 2,

    placeholder: {
    id: '0', // the value of the option
    text: 'Cari Berdasarkan Koperasi'}
    });
</script>
<?php
$this->load->view('template/foot');
?>