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
        User Data
        <!-- <small>it all starts here</small> -->
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">User Data</a></li>
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
              <div class="box">
              	<div class="box-header with-border">
              		<button class="btn btn-sm btn-success" onclick=location.href="<?= base_url() ?>add_anggota_komunitas"><i class="fa fa-plus-circle"></i> Tambah Anggota Komunitas</button>
              		
              	</div>
                <div class="box-body">
                   <table id="dataUser" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <td>No</td>
                        <td>Nama Lengkap</td>
                        <td>Username</td>
                        <td>Email</td>
                        <td>No Telepon</td> 
                        <td>Komunitas</td>
                        <td>Aksi</td>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($anggota_komunitas as $r) { ?>
                          <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $r->nama_lengkap ?></td>
                            <td><?= $r->username ?></td>
                            <td><?= $r->email?></td>
                            <td><?= $r->telp ?></td>
                            <td><?= $r->nama ?></td>
                            <td>
                              <button class="btn btn-success" onclick=location.href="<?= base_url()?>edit_anggota_komunitas/<?= $r->id_user ?>"><i class="fa fa-pencil"></i></button>
                              <button class="btn btn-danger" onclick=confirmHapus(<?= $r->id_user ?>)><i class="fa fa-trash"></i></button>
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
           if(confirm('Anda Yakin Untuk Menghapus data '+id+' ?'))
           {
              window.location.href='<?= base_url() ?>delete_anggota_komunitas/'+id;
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