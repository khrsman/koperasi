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
  Edit Profile
  <!-- <small>it all starts here</small> -->
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Edit Profile </a></li>
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
      <li class=""><a href="#update_password" data-toggle="tab" aria-expanded="false">Edit Password</a></li>
      <li class=""><a href="#contact" data-toggle="tab" aria-expanded="false">Informasi Kontak</a></li>
      <li class=""><a href="#photo_profile" data-toggle="tab" aria-expanded="false">Foto Profil</a></li>
      <li class=""><a href="#photo_cover" data-toggle="tab" aria-expanded="false">Foto Cover</a></li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane active" id="basic_profile">
        <form id="formBasic" method="post" action="<?= base_url() ?>update_basic_profile"  enctype="multipart/form-data">
          <div class="form-group ">
                  <label for="nama_belakang">Nama Komunitas</label>
                  <input type="text" class="form-control" placeholder="Nama Komunitas" required="" value="<?= $user['nama_lengkap'] ?>" name="nama" />
              </div>
          <div class="form-group ">
            <label for="alamat">Alamat</label>
            <input type="text" class="form-control" placeholder="Alamat" value="<?= $user['alamat'] ?>" name="alamat" />
          </div>
          <div class="form-group">
          <label>Tanggal Berdiri</label>
          <div class="input-group">
              <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
              </div>
              <input type="text" id="datemask" class="form-control" data-inputmask="'alias': 'hh/bb/tttt'" name="berdiri" value="<?= $user['tgl_berdiri'] ?>" value="<?= set_value('berdiri') ?>" data-mask/>
              </div><!-- /.input group -->
          </div>
          <div class="form-group ">
              <label for="Ketua">Ketua Komunitas</label>
              <input type="text" class="form-control" placeholder="Ketua Komunitas" required="" value="<?= $user['ketua_komunitas'] ?>"  value="<?= set_value('ketua') ?>" name="ketua" />
          </div>
          <div class="form-group ">
              <label for="Ketua Telp">No Telepon Ketua Komunitas</label>
              <input type="text" class="form-control" placeholder="No Telepon Ketua Komunitas" required="" value="<?= $user['ketua_komunitas_telp'] ?>"  value="<?= set_value('ketua_telp') ?>" name="ketua_telp" />
          </div>
          <div class="form-group ">
              <label for="Keterangan">Keterangan</label>
              <textarea id="mytextarea" class="form-control" name="keterangan" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?= $user['keterangan_komunitas'] ?> <?= set_value('keterangan') ?></textarea>
          </div>
          <button type="submit" class="btn btn-primary btn-block btn-flat">Perbaharui Data</button>
          
        </form>
      </div>
      <!-- /.tab-pane -->
      <div class="tab-pane" id="update_password">
        <form method="POST" action="<?= base_url()?>update_password" enctype="multipart/form-data">
            <div class="form-group ">
                <label for="username">Username</label>
                <input type="text" class="form-control" placeholder="Username" required="" value="<?= $user['username'] ?>" name="username" readonly />
            </div>
            <div class="form-group ">
                <label for="password">Password Lama</label>
                <input type="password" class="form-control" placeholder="Password" required="" value="" name="old_password" />
            </div>
            <div class="form-group ">
                <label for="password">Password Baru</label>
                <input type="password" class="form-control" placeholder="Password" required="" value="" name="new_password" />
            </div>
            <div class="form-group ">
                <label for="password">Konfirmasi Password Baru</label>
                <input type="password" class="form-control" placeholder="Konfirmasi Password" required="" value="" name="confirm_password" />
            </div>
            <button type="submit" class="btn btn-primary btn-block btn-flat">Perbaharui Data</button>
        </form>
      </div>
      <!-- /.tab-pane -->
      <div class="tab-pane" id="contact">
        <form method="POST" action="<?= base_url()?>update_contact" enctype="multipart/form-data">
            <div class="form-group ">
                <label for="email">Email </label><small> (Kami tidak akan mem-publikasikan email anda)</small>
                <input type="email" class="form-control" placeholder="E-mail" required="" value="<?= $user['email'] ?>" name="email" />
            </div>
            <div class="form-group ">
                <label for="NoHp">Nomor Telepon/HP</label>
                <input type="text" class="form-control" placeholder="No Telepon / HP" required="" value="<?= $user['telp'] ?>" name="telepon" />
                </div>
            <button type="submit" class="btn btn-primary btn-block btn-flat">Perbaharui Data</button>
        </form>
      </div>
      <!-- /.tab-pane -->
       <div class="tab-pane" id="photo_profile">
        <form method="POST" action="<?= base_url()?>photo_profile" enctype="multipart/form-data" runat="server">
            <div class="form-group ">
                <label for="foto">Upload Foto Profil</label>
                <input id="imgProfile" type="file" class="form-control" name="photo" accept="image/*" />
            </div>
            <div class="text-center">
              <img id="imageProfile" class="img-responsive" src="<?php
                                                if($this->session->userdata('foto_user') == NULL){
                                                    echo base_url()."assets/images/user/default.jpg";
                                                }

                                                else {
                                                  echo base_url()."assets/images/user/".$this->session->userdata('foto_user');
                                                }?>"  style="width: 200px; height: auto; margin: 10px auto;">
            </div>
            <button type="submit" class="btn btn-primary btn-block btn-flat">Perbaharui Data</button>
          </form>
      </div>
      <!-- /.tab-pane -->
      <div class="tab-pane" id="photo_cover">
        <form method="POST" action="<?= base_url()?>photo_cover" enctype="multipart/form-data" runat="server">
            <div class="form-group ">
                <label for="foto">Upload Foto Cover</label>
                <input id="imgCover" type="file" class="form-control" name="photo" accept="image/*" />
            </div>
            <div class="text-center">
              <img id="imageCover" class="img-responsive" src="" style="width: 200px; height: auto; margin: 10px auto; display: none;">
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