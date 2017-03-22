<?php 
$this->load->view('template/head');
?>
<!--tambahkan custom css disini-->
<link rel="stylesheet" href="<?= base_url() ?>assets/AdminLTE-2.0.5/plugins/datatables/dataTables.bootstrap.css">
<link href="<?= base_url() ?>assets/AdminLTE-2.0.5/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>assets/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />

<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>
<!-- Content Header (Page header) -->
<section class="content-header">
   
</section>

<!-- Main content -->
<section class="content">
        <?= validation_errors() ?>
           <?php
                        if($this->session->flashdata('msg') !=NULL){
                            echo '<div class="alert alert-info" role="alert" style="padding: 6px 12px;height:34px;">';
                            echo "<i class='fa fa-info-circle'></i> <strong><span style='margin-left:10px;'>".$this->session->flashdata('msg')."</span></strong>";
                            echo '</div>';
                        }?>
    <!-- Default box -->
    <div class="col-md-12">
      <div class="box box-info">
        <div class="box-header">
          <h3 class="box-title">Pencarian</h3>
        </div>
        <div class="box-body">
          <div class="col-md-4">
            <label>Cari berdasarkan tanggal :</label>
            <input type="text" id="tanggal" class="form-control">
          </div>
          <div class="col-md-4">
            <label>Cari berdasarkan kata kunci :</label>
            <input type="text" id="keyword" class="form-control">
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3>Data Penjualan Produk Koperasi</h3>
        </div>
        <div class="box-body">
             <table class="table table-bordered table-striped" id="data_produk">
                <thead>
                  <tr>
                      <th class="no-sort">#</th>
                      <th>Kategori Produk</th>
                      <th>Nama Produk</th>
                      <th>Penjual</th>
                      <th>Harga Pasar</th>
                      <th>Harga Member</th>
                      <th>Jumlah Beli</th>
                      <th>Total Pembelian</th>
                      <th>Tanggal</th>
                      <th>Pembeli</th>
                  </tr>
                </thead>
                <tbody>
                  
                </tbody>
                <tfoot>
                  <tr>
                      <th class="no-sort">#</th>
                      <th>Kategori Produk</th>
                      <th>Nama Produk</th>
                      <th>Penjual</th>
                      <th>Harga Pasar</th>
                      <th>Harga Member</th>
                      <th>Jumlah Beli</th>
                      <th>Total Pembelian</th>
                      <th>Tanggal</th>
                      <th>Pembeli</th>
                  </tr>
                </tfoot>
              </table>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>

</section><!-- /.content -->

<?php 
$this->load->view('template/js');
?>
<!--tambahkan custom js disini-->
<!--tambahkan custom js disini-->
<script src="<?= base_url() ?>assets/AdminLTE-2.0.5/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/AdminLTE-2.0.5/plugins/datatables/dataTables.bootstrap.js"></script>
<script src="<?= base_url() ?>assets/bootstrap-daterangepicker/moment.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>

<script type="text/javascript">
    var table =  $('#data_produk').DataTable({
        ordering: false,
processing: true,
        serverSide: true,
        "bFilter" : false,
        responsive:true,
        "columnDefs": [ {
          "targets": 'no-sort',
          "orderable": false,
      } ],
        "ajax": ({
          url: "<?= base_url('report/list_penjualan_koperasi') ?>",
          type:'POST',
          data:function(d){
            d.tanggal = $("#tanggal").val();
            d.keyword = $("#keyword").val();
          }
        })
    });

    $('#keyword').on('keyup change', function(){
      table.ajax.reload();
    })

    $('#tanggal').daterangepicker({
      format: 'DD/MM/YYYY',
      autoUpdateInput:true,
      locale :{cancelLabel : 'Hapus', applyLabel : 'Cari'}
    }).val("");


  $('#tanggal').on('apply.daterangepicker', function(){
   table.ajax.reload();
  });
  $('#tanggal').on('cancel.daterangepicker', function(){
   $('#tanggal').val("");
   table.ajax.reload();

  });
</script>
<?php
$this->load->view('template/foot');
?>