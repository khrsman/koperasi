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
       Data Pekerjaan
        <!-- <small>it all starts here</small> -->
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Data Pekerjaan</a></li>
    </ol>
</section>

<!-- Main content -->
 <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
              	<div class="box-header with-border">
              		<button class="btn btn-sm btn-success" onclick=location.href="<?= base_url() ?>add_pekerjaan"><i class="fa fa-plus-circle"></i> Tambah Pekerjaan</button>
              		
              	</div>
                <div class="box-body">
                  <table id="dataUser" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama Pekerjaan</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    	<?php foreach ($pekerjaan as $r) { ?>
                    			<tr>
                    				<td><?= $no++ ?></td>
                    				<td><?= $r->nama?></td>
                    				<td>
                    					<button class="btn btn-success" onclick=location.href="<?= base_url()?>edit_pekerjaan/<?= $r->id_pekerjaan ?>"><i class="fa fa-pencil"></i> Edit</button>
                    					<button class="btn btn-danger" onclick=location.href="<?= base_url()?>delete_pekerjaan/<?= $r->id_pekerjaan ?>"><i class="fa fa-trash"></i> Hapus</button>
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