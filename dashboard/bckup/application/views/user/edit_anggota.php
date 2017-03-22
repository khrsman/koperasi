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
  Edit Anggota
  <!-- <small>it all starts here</small> -->
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Edit Anggota</a></li>
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
      <li class=""><a href="#alamat" data-toggle="tab" aria-expanded="false">Alamat</a></li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane active" id="basic_profile">
        <form id="formBasic" method="post" action="<?= base_url() ?>anggota/update_basic_profile"  enctype="multipart/form-data">
        <div class="col-md-6">
          <div class="form-group ">
            <label for="nama_depan">Nama Depan</label>
            <input type="text" class="form-control" placeholder="Nama Depan" minlength="2" required="" value="<?= $user['nama_depan'] ?>" name="nama_depan" />
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group ">
            <label for="nama_belakang">Nama Belakang</label>
            <input type="text" class="form-control" placeholder="Nama Belakang" value="<?= $user['nama_belakang'] ?>" name="nama_belakang" />
          </div>
        </div>

          <div class="form-group ">
            <label for="JenisKelamin">Jenis Kelamin</label><br />
            <label class="radio-inline">
              <input type="radio" name="jkel" value="laki-laki" <?php if($user['jenis_kelamin']=="l")
              echo "checked";?>>Laki-Laki
            </label>
            <label class="radio-inline">
              <input type="radio" name="jkel" value="perempuan" <?php if($user['jenis_kelamin']=="p")
              echo "checked";?>>
              Perempuan
            </label>
          </div>
          <div class="form-group ">
              <label for="jabatan">No KTP</label>
              <input type="jabatan" class="form-control" placeholder="No KTP" required="" value="<?= $user['no_ktp'] ?>" name="noktp" />
          </div>
          <div class="form-group ">
            <label>Tempat Lahir</label>
            <input type="text" class="form-control" placeholder="Tempat Lahir" value="<?= $user['tempat_lahir'] ?>" name="tempat_lahir" />
          </div>
          <div class="form-group">
          <label>Tanggal Lahir</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" id="datemask" class="form-control" data-inputmask="'alias': 'hh-bb-tttt'" name="tgl_lahir" value="<?php $date = new DateTime($user['tgl_lahir']); 
                                            echo $date->format('d-m-Y'); ?>" data-mask/>
                    </div><!-- /.input group -->
          </div>
           <div class="form-group ">
                <label for="Pekerjaan">Pekerjaan</label>
                <select name="pekerjaan" class="form-control">
                    <?php
                    foreach ($pekerjaan as $row) { ?>
                    <option value="<?= $row->id_pekerjaan ?>" <?php if($row->id_pekerjaan == $user['pekerjaan'])
                        echo "selected";
                        else
                    echo ""; ?>><?= $row->nama ?></option><?php } ?>
                </select>
            </div>
          <button type="submit" class="btn btn-primary btn-block btn-flat">Perbaharui Data</button>
          
        </form>
      </div>
      <!-- /.tab-pane -->
      <div class="tab-pane" id="contact">
        <form method="POST" action="<?= base_url()?>anggota/update_contact" enctype="multipart/form-data">
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
      <div class="tab-pane" id="alamat">
      <button type="button" class="btn btn-primary btn-md pull-right" data-toggle="modal" data-target="#myModal" style="margin: 25px;">
                  Tambah Alamat
      </button>
        <table class="table table-bordered table-striped">
          <thead>
              <tr>
                  <th>No</th>
                  <th>Alamat</th>
                  <th>Default</th>
                  <th>Aksi</th>
              </tr>
          </thead>
          <tbody>
              <?php foreach ($alamat as $row) { ?>
              <tr>
                  <td><?= $no++ ?></td>
                  <td><?= $row->pengirim_alamat.", ".$row->nama_kelurahan.", ".$row->nama_kecamatan.", ". $row->nama_kabupaten.", ".$row->nama_provinsi ?></td>
                  <td class="text-center"><?php if($row->status_default == "1"){echo "<i class='fa fa-check-circle-o'></i>";} ?></td>
                  <td> <button type="button" class="btn btn-info btn-sm" onclick=location.href="<?= base_url() ?>anggota/set_default/<?= $row->id_alamat ?>"><i class="fa fa-check-circle-o"></i></button>
                       <button type="button" class="btn btn-danger btn-sm" onclick=confirmHapus(<?= $row->id_alamat ?>)><i class="fa fa-trash"></i></button>
                       </td>
              </tr>
              <?php } ?>
              </tbody>
        </table>
      </div>
      <!-- /.tab-pane -->
    </div>
    <!-- /.tab-content -->
  </div>
</section>

<div class="clear-both"></div>

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
            <form method="POST" action="<?= base_url() ?>anggota/tambah_alamat">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Tambah Alamat</h4>
              </div>
              <div class="modal-body">
               <div class="form-group ">
                            <label for="Alamat">Alamat</label>
                            <div class="alamat">
                                <textarea name="alamat" class="form-control" placeholder="Detail Alamat"></textarea>
                            </div>
                </div>
                 <div class="form-group ">
                            <label for="Alamat">Provinsi</label>
                            <select id="prop" name="prop" class="form-control" onchange="ajaxkota(this.value)">
                                <option value="">Pilih Provinsi</option>
                                <?php
                                foreach($provinsi->result() as $data){
                                echo '<option value="'.$data->id_provinsi.'">'.$data->nama.'</option>';
                                }
                                ?>
                            </select>
                </div>
                 <div class="form-group ">
                            <div id="kab_box">
                                <label for="Alamat">Kota / Kabupaten</label>
                                <select name="kota" id="kota" onchange="ajaxkec(this.value)" class="form-control">
                                    <option value="">Pilih Kota/Kab</option>
                                </select>
                            </div>
                </div>
                 <div class="form-group ">
                            <div id="kec_box">
                                <label for="Alamat">Kecamatan / Desa</label>
                                <select name="kec" id="kec" onchange="ajaxkel(this.value)" class="form-control">
                                    <option value="">Pilih Kecamatan</option>
                                </select>
                            </div>
                </div>
                 <div class="form-group ">
                            <div id="kel_box">
                                <label for="Alamat">Kelurahan</label>
                                <select name="kel" id="kel" class="form-control">
                                    <option value="">Pilih Kelurahan/Desa</option>
                                </select>
                            </div>
                </div>
                <div class="form-group ">
                        <label for="Ketua Telp">No Telepon Pengiriman</label>
                        <input type="text" class="form-control" placeholder="No Telepon" required="" name="telepon" />
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
              </form>
            </div>
          </div>
        </div>
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
$("#datemask").inputmask("dd-mm-yyyy", {"placeholder": "hh-bb-tttt"});
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
    window.location.href='<?= base_url() ?>anggota/hapus_alamat/'+id;
    }
  };


  function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#imageProfile').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
  }

  $("#imgProfile").change(function(){
      readURL(this);
  });
</script>
<?php
$this->load->view('template/foot');
?>