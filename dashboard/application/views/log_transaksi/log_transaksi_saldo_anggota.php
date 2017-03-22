<?php 
$this->load->view('template/head');
$this->load->view('new_head_anggota_kop');


?>

<style type="text/css">
  tbody{
    font-color:black;
  }


</style>
<!--tambahkan custom css disini-->
<link href="<?= base_url() ?>assets/AdminLTE-2.0.5/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<?php
// $this->load->view('template/topbar');
// $this->load->view('template/sidebar');
?>

<!-- Content Header (Page header) -->
<section class="content-header container" style="margin-bottom:10px;">
    <div class="col-md-12">
    <h1>
       Data Transaksi <?= ucfirst($this->uri->rsegment(3)) ?>
        <!-- <small>it all starts here</small> -->
    </h1>

                <div class="box-buttons">
               <a href="<?php echo base_url('banking') ?>" class="btn-sm btn btn-danger"> <b>Kembali Ke Minicore Banking</b></a>

               <a style="color:black;" href="<?= base_url() ?>saldo/loyalty" class="btn-sm  btn btn-info"><b>Lihat Transaksi Loyalti </b></a>
<a style="color:black;" href="<?= base_url() ?>saldo/tabungan" class="btn-sm btn btn-info"><b>Lihat Transaksi Tabungan </b></a>
<a style="color:black;" href="<?= base_url() ?>saldo/virtual" class="btn-sm  btn btn-info"><b>Lihat Transaksi Virtual </b></a>

            </div>
    </div>

   
</section>
<div class="clearfix"></div>
<!-- Main content -->
 <section class="content container">
          <div class="row">
            <br>
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
                        <th>Ket.</th>
                        <th>Service Time</th>
                        <th>Saldo Akhir</th>

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
                            <td style="text-align: right;"><?php $nt = str_replace(".00", "", $r->nilai_transaksi);
                                                                echo number_format($nt,0,".",",");?></td>
                            <td><?= ucwords($r->jenis_transaksi)?></td>
                            <td><?php
                                $date = new DateTime($r->service_time); 
                                echo $date->format('d M y, H:i:s'); 
                                                ?></td>
                            <td style="text-align: right;"><?php $sa = str_replace(".00", "", $r->saldo_akhir);
                                                                echo number_format($sa,0,".",",") ?></td>
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
// $this->load->view('template/js');
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