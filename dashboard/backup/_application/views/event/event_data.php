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
       Data Event <?= ucfirst($this->uri->rsegment(3)) ?>
        <!-- <small>it all starts here</small> -->
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Data Event <?= ucfirst($this->uri->rsegment(3)) ?></a></li>
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
              <?php if($level_data_event == $this->session->userdata('level')) {?>
              	<div class="box-header with-border">
              		<button class="btn btn-sm btn-success" onclick=location.href="<?= base_url() ?>add_event"><i class="fa fa-plus-circle"></i> Tambah Event <?= ucfirst($this->uri->rsegment(3)) ?></button>
              	</div>
              <?php } ?>
                <div class="box-body">
                  <table id="dataUser" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Tanggal Dibuat</th>
                        <th>Penulis</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    	<?php foreach ($event as $r) { ?>
                    			<tr>
                    				<td><?= $no++ ?></td>
                            <td><?= $r->judul?></td>
                            <td><?php
                                $date = new DateTime($r->tanggal_dibuat); 
                                echo $date->format('d M y, H:i:s'); 
                                                ?></td>
                            <td><?= $r->nama_lengkap ?></td>
                            <td>
                              <?php if($r->id_user == $this->session->userdata('id_user')) { ?>
                              <button class="btn btn-info" onclick=location.href="<?= base_url()?>lihat_event/<?= $r->id_event ?>"><i class="fa fa-eye"></i></button>
                    					 <button class="btn btn-success" onclick=location.href="<?= base_url()?>edit_event/<?= $r->id_event ?>"><i class="fa fa-pencil"></i></button>
                              <button class="btn btn-danger" onclick=confirmHapus(<?= $r->id_event?>)><i class="fa fa-trash"></i></button>
                              <?php } else {?>
                                 <button class="btn btn-info" onclick=location.href="<?= base_url()?>lihat_event/<?= $r->id_event ?>"><i class="fa fa-eye"></i></button>
                              <?php } ?>
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
                  window.location.href='<?= base_url() ?>delete_event/'+id;
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