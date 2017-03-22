<?php
$this->load->view('template/head');
?>
<!--tambahkan custom css disini-->
<link href="<?= base_url() ?>assets/AdminLTE-2.0.5/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>assets/AdminLTE-2.0.5//plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
<style>
#map-canvas {width:100%;height:400px;border:solid #999 1px;}
#kab_box,#kec_box,#kel_box,#lat_box,#lng_box{display:none;}

#formBasic label.error {
color:red;
}
#formBasic input.error {
border:1px solid red;
}
</style>
<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
  Edit Koperasi
  <!-- <small>it all starts here</small> -->
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Edit Koperasi </a></li>
  </ol>
  
</section>
  <div class="col-md-6">
    <?php
    if($this->session->flashdata('msg') != NULL):
    echo '<div class="alert alert-info" role="alert" style="padding: 6px 12px;height:34px;">';
      echo "<i class='fa fa-info-circle'></i> <strong><span style='margin-left:10px;'>".$this->session->flashdata('msg')."</span></strong>";
    echo '</div>';
    endif;?>
    <?php
    if($this->session->flashdata('validation_errors') != NULL):
         echo $this->session->flashdata('validation_errors');
    endif;?>
  </div>
<div class="clear-both"></div>

<!-- Main content -->
<section class="content">
  <!-- Custom Tabs -->
  <div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#basic_profile" data-toggle="tab" aria-expanded="false">Informasi Umum</a></li>
      <li class=""><a href="#contact" data-toggle="tab" aria-expanded="false">Informasi Kontak</a></li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane active" id="basic_profile">
        <form id="formBasic" method="post" action="<?= base_url() ?>koperasi/update_basic_profile"  enctype="multipart/form-data">
          <div class="form-group ">
                  <label for="nama_belakang">Nama Koperasi</label>
                  <input type="text" class="form-control" placeholder="Nama Koperasi" required="" value="<?= $koperasi['nama'] ?>" name="nama" />
              </div>
          <div class="form-group ">
            <label for="alamat">Alamat</label>
            <input type="text" class="form-control" placeholder="Alamat" value="<?= $koperasi['alamat'] ?>" name="alamat" />
          </div>
          <div class="form-group">
          <label>Tanggal Berdiri</label>
          <div class="input-group">
              <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
              </div>
              <input type="text" id="datemask" class="form-control" data-inputmask="'alias': 'hh/bb/tttt'" name="berdiri" value="<?= $koperasi['tgl_berdiri'] ?>" value="<?= set_value('berdiri') ?>" data-mask/>
              </div><!-- /.input group -->
          </div>
          <div class="form-group ">
              <label for="Legal">Legal</label>
              <input type="text" class="form-control" placeholder="Legal" value="<?= $koperasi['legal'] ?>"  value="<?= set_value('legal') ?>" name="legal" />
          </div>
          <div class="form-group ">
              <label for="Ketua">Ketua Koperasi</label>
              <input type="text" class="form-control" placeholder="Ketua Koperasi" required="" value="<?= $koperasi['ketua_koperasi'] ?>"  value="<?= set_value('ketua') ?>" name="ketua" />
          </div>
          <div class="form-group ">
              <label for="Ketua Telp">No Telepon Ketua Koperasi</label>
              <input type="text" class="form-control" placeholder="No Telepon Ketua Koperasi" required="" value="<?= $koperasi['ketua_koperasi_telp'] ?>"  value="<?= set_value('ketua_telp') ?>" name="ketua_telp" />
          </div>
          <?php if ($this->session->userdata('level') == 1) { ?>
          <div class="form-group ">
            <label for="Koperasi">Koperasi Cabang</label>
            <select name="koperasi" class="form-control">
              <option value="0">Induk</option>
              <?php 
                foreach ($data_kop as $row) { ?>
                   <option value="<?= $row->id_koperasi ?>" 
                   <?php
                      if($row->id_koperasi == $koperasi['parent_koperasi'])
                      echo "selected"; 
                   ?> 
                   <?= set_select('koperasi', '$row->id_koperasi') ?>><?= $row->nama ?></option>
              <?php   } ?>
            </select>
          </div>
          <?php } ?>
          <div class="form-group ">
              <label for="Keterangan">Keterangan</label>
              <textarea id="mytextarea" class="form-control" name="keterangan" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?= $koperasi['keterangan_koperasi'] ?> <?= set_value('keterangan') ?></textarea>
          </div>
          <button type="submit" class="btn btn-primary btn-block btn-flat">Perbaharui Data</button>
        </form>
      </div>
      <!-- /.tab-pane -->
      <div class="tab-pane" id="contact">
        <form method="POST" action="<?= base_url()?>koperasi/update_contact" enctype="multipart/form-data">
            <div class="form-group ">
                <label for="email">Email </label><small> (Kami tidak akan mem-publikasikan email anda)</small>
                <input type="email" class="form-control" placeholder="E-mail" required="" value="<?= $koperasi['email'] ?>" name="email" />
            </div>
            <div class="form-group ">
                <label for="NoHp">Nomor Telepon/HP</label>
                <input type="text" class="form-control" placeholder="No Telepon / HP" required="" value="<?= $koperasi['telp'] ?>" name="telepon" />
                </div>
            <button type="submit" class="btn btn-primary btn-block btn-flat">Perbaharui Data</button>
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
    <!-- /.tab-content -->
  </div>
</section>
<!-- /.content -->
<div class="clear-both"></div>
<?php
$this->load->view('template/js');
?>

<!--tambahkan custom js disini-->
<script src="<?= base_url() ?>assets/AdminLTE-2.0.5/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/AdminLTE-2.0.5/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/AdminLTE-2.0.5/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/AdminLTE-2.0.5/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(function () {
//Datemask dd/mm/yyyy
$("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "hh/bb/tttt"});
$("#mytextarea").wysihtml5();
});
</script>
<script src="<?= base_url() ?>assets/AdminLTE-2.0.5/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/AdminLTE-2.0.5/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<script type="text/javascript" src="<?= base_url()?>assets/js/ajax_daerah.js"></script>



<script type="text/javascript">
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

<script type="text/javascript">
  function confirmHapus(id){
    if(confirm('Anda Yakin Untuk Menghapus Alamat ?')) {
    window.location.href='<?= base_url() ?>delete_alamat/'+id;
    }
  };


  function readURL(input) {
    if (input.files && input.files[0]) {
        var read = new FileReader();

        read.onload = function (e) {
            $('#imageProfile').attr('src', e.target.result);
        }

        read.readAsDataURL(input.files[0]);
    }
  }

  $("#imgProfile").change(function(){
      readURL(this);
  });


  function readURI(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#imageCover').attr('src', e.target.result);
            $('#imageCover').css('display', 'block');
        }

        reader.readAsDataURL(input.files[0]);
    }
  }

  $("#imgCover").change(function(){
      readURI(this);
  });
</script>
<?php
$this->load->view('template/foot');
?>