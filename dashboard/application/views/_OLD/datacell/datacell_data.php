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
       Data Datacell
        <!-- <small>it all starts here</small> -->
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Data Datacell</a></li>
    </ol>
</section>

<!-- Main content -->
 <section class="content">
          <div class="row">
            <div class="col-xs-12">
                      <?php
              if($this->session->flashdata('msg') != NULL){
              echo '<div class="alert alert-info" role="alert" style="padding: 6px 12px;height:34px;">';
                  echo "<i class='fa fa-info-circle'></i> <strong><span style='margin-left:10px;'>".$this->session->flashdata('msg')."</span></strong>";
              echo '</div>';
              }?>
              <div class="box">
                <div class="box-body">
                  <table id="dataUser" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Id Operator</th>
                        <th>Kode Operator</th>
                        <th>Harga Datacell</th>
                        <th>Harga Gerai</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    	<?php foreach ($datacell as $r) { ?>
                    			<tr>
                    				<td><?= $no++ ?></td>
                            <td><?= $r->id_operator?></td>
                            <td><?= $r->kode_operator ?></td>
                            <td><?= $r->harga_datacell ?></td>
                            <td><?= $r->harga_gerai ?></td>
                            <td>
                                 <button class="btn btn-info" onclick=location.href="<?= base_url()?>log_datacell/<?= $r->kode_operator ?>"><i class="fa fa-eye"></i></button>
                                 <button class="btn btn-success" onclick=location.href="<?= base_url()?>edit_datacell/<?= $r->kode_operator ?>"><i class="fa fa-pencil"></i></button>
                    				</td>
                    			</tr>
                    	<?php } ?>
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