<?php 
$this->load->view('template/head');
?>
<!--tambahkan custom css disini-->
<link href="<?= base_url() ?>assets/AdminLTE-2.0.5/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
       Data Transaksi <?= ucfirst($this->uri->rsegment(3)) ?>
        <!-- <small>it all starts here</small> -->
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Data Transaksi <?= ucfirst($this->uri->rsegment(3)) ?></a></li>
    </ol>
</section>

<!-- Main content -->
 <section class="content">
          <div class="row">
            <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                  <table id="dataUser" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>No Transaksi</th>
                        <th>Tanggal Transaksi</th>
                        <th>Nilai Transaksi</th>
                        <th>Saldo Awal</th>
                        <th>Saldo Akhir</th>
                        <th>Service Time</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if($saldo != NULL): ?>
                    	<?php foreach ($saldo->result() as $r) { ?>
                    			<tr>
                    				<td><?= $no++ ?></td>
                            <td><?= $r->no_transaksi?></td>
                            <td><?php
                                $date = new DateTime($r->tanggal_transaksi); 
                                echo $date->format('d M y, H:i:s'); 
                                                ?></td>
                            <td><?= $r->nilai_transaksi?></td>
                            <td><?= $r->saldo_awal?></td>
                            <td><?= $r->saldo_akhir?></td>
                            <td><?php
                                $date = new DateTime($r->service_time); 
                                echo $date->format('d M y, H:i:s'); 
                                                ?></td>
                    			</tr>
                    	<?php } ?>
                    <?php endif; ?>
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->

<?php 
$this->load->view('template/js');
?>
<!--tambahkan custom js disini-->
	<script src="<?= base_url() ?>assets/AdminLTE-2.0.5/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/AdminLTE-2.0.5/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>

    <script type="text/javascript">
       function confirmHapus(id)
          {
               if(confirm('Anda Yakin Untuk Menghapus data ?'))
               {
                  window.location.href='<?= base_url() ?>delete_agenda/'+id;
               }
          }
          </script>

    <script>
$(document).ready(function(){

    $('#dataUser').dataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": true,
      "autoWidth": false
    });
  });
</script>
<?php
$this->load->view('template/foot');
?>