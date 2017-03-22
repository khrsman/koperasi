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
          <div class="col-md-3">
            <div class="form-group ">
              <label for="noktp">No Identitas</label>
              <input type="text" class="form-control" placeholder="No Identitas" required=""  name="noktp" value="<?= $user['no_ktp']?>" value="<?= set_value('noktp')?>" />
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="jenis_identitas">Jenis Identitas</label>
              <select class="form-control" name="jenis_identitas">
                <option value="KTP" <?php if($user['jenis_id'] == "KTP") echo "selected"; ?>>KTP</option>
                <option value="Passport" <?php if($user['jenis_id'] == "Passport") echo "selected"; ?>>Passport</option>
                <option value="SIM" <?php if($user['jenis_id'] == "SIM") echo "selected"; ?>>SIM</option>

              </select>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group ">
              <label for="nama_depan">Nama Depan</label>
              <input type="text" class="form-control" placeholder="Nama Depan" required=""  name="nama_depan" value="<?= $user['nama_depan']?>"  value="<?= set_value('nama_depan')?>"/>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group ">
              <label for="nama_belakang">Nama Belakang</label>
              <input type="text" class="form-control" placeholder="Nama Belakang" name="nama_belakang" value="<?= $user['nama_belakang']?>"  value="<?= set_value('nama_belakang')?>"/>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group ">
              <label for="no_anggota">No. Anggota</label>
              <input type="text" class="form-control" placeholder="No. Anggota" name="no_anggota" value="<?= $user['no_anggota']?>"  value="<?= set_value('no_anggota')?>"/>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group ">
              <label for="nama_belakang">Tempat Lahir</label>
              <input type="text" class="form-control" placeholder="Tempat Lahir" name="tempat_lahir" value="<?= $user['tempat_lahir']?>"  value="<?= set_value('tempat_lahir')?>"/>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group ">
              <label for="nama_belakang">Tanggal Lahir</label>
              <input type="text" id="datemask" class="form-control" data-inputmask="'alias': 'hh-bb-tttt'" data-mask placeholder="Tanggal Lahir" name="tanggal_lahir" value="<?php $date = new DateTime($user['tgl_lahir']); 
                                                                          echo $date->format('d-m-Y'); ?>" 
              value="<?= set_value('tanggal_lahir')?>"/>
            </div>
          </div>
           
          <div class="col-md-6">
             <div class="form-group ">
              <label for="email">Jabatan</label>
              <input type="text" class="form-control" placeholder="Jabatan" required=""  name="jabatan" value="<?= $user['jabatan']?>" value="<?= set_value('jabatan')?>"/>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group ">
              <label for="Pekerjaan">Pekerjaan</label>
              <select name="pekerjaan" class="form-control">
                <?php 
                  foreach ($pekerjaan as $row) { ?>
                     <option value="<?= $row->id_pekerjaan ?>" <?= set_select('pekerjaan', $row->id_pekerjaan) ?>
                     <?php if($user['pekerjaan'] == $row->id_pekerjaan) echo "selected"; ?>><?= $row->nama ?></option>
                <?php   } ?>
              </select>
            </div>
          </div>
          <div class="col-md-3">
             <div class="form-group ">
             <label for="JenisKelamin">Jenis Kelamin</label><br />
              <label class="radio-inline">
                <input type="radio" name="jkel" value="L" <?= set_radio('jkel','laki-laki', TRUE) ?> 
                <?php if($user['jenis_kelamin'] == "L") echo "checked"; ?>>Laki-Laki
              </label>
              <label class="radio-inline">
                <input type="radio" name="jkel" value="P" <?= set_radio('jkel', 'perempuan')?>
                <?php if($user['jenis_kelamin'] == "P") echo "checked"; ?>>Perempuan
              </label>
            </div>
          </div>

          <div class="col-md-3">
             <div class="form-group ">
             <label for="JenisKelamin">Gol. Darah</label><br />
              <label class="radio-inline">
                <input type="radio" name="gol_darah" value="A" <?= set_radio('gol_darah', 'A', TRUE) ?>
                <?php if($user['golongan_darah'] == "A") echo "checked"; ?>>A
              </label>
              <label class="radio-inline">
                <input type="radio" name="gol_darah" value="B" <?= set_radio('gol_darah', 'B') ?>
                <?php if($user['golongan_darah'] == "B") echo "checked"; ?>>B
              </label>
              <label class="radio-inline">
                <input type="radio" name="gol_darah" value="AB" <?= set_radio('gol_darah', 'AB') ?>
                <?php if($user['golongan_darah'] == "AB") echo "checked"; ?>>AB
              </label>
              <label class="radio-inline">
                <input type="radio" name="gol_darah" value="O" <?= set_radio('gol_darah', 'O') ?>
                <?php if($user['golongan_darah'] == "O") echo "checked"; ?>>O
              </label>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="Agama">Agama</label>
              <select name="agama" class="form-control">
                <?php foreach ($agama as $r): ?>
                    <option value="<?= $r->id_agama?>" <?= set_select('agama', $r->id_agama) ?>
                    <?php if($user['agama'] == $r->id_agama) echo "selected" ?>><?= $r->deskripsi ?> </option>
                <?php endforeach ?>
              </select>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group ">
              <label for="npwp">NPWP</label>
              <input type="text" class="form-control" placeholder="NPWP" required="" name="npwp" value="<?= $user['npwp']?>" value="<?= set_value('npwp')?>"/>
            </div>
          </div>      
          <div class="clear-both"></div>
          <div class="col-md-6">
                <div class="form-group ">
                 <label for="JenisKelamin">Pendidikan Terakhir</label><br />
                  <?php foreach ($pendidikan as $pend): ?>
                  <label class="radio-inline">
                    <input type="radio" name="pendidikan" value="<?= $pend->id_pendidikan ?>" <?= set_radio('pendidikan',$pend->id_pendidikan, TRUE) ?>
                      <?php if($user['pendidikan_terakhir'] == $pend->id_pendidikan) echo "checked"; ?>><?= $pend->deskripsi ?>
                  </label>
                  <?php endforeach ?>
                </div>
         </div>
    

          <!-- <div class="col-md-6">
          <?php 
            // if($this->session->userdata('level') == "1"){ ?>
          <div class="form-group ">
            <label for="Koperasi">Koperasi</label>
            <select name="koperasi" class="form-control">
              <?php 
                foreach ($koperasi as $row) { ?>
                   <option value="<?= $row->id_koperasi ?>"
                   <?php //if($user['koperasi'] == $row->id_koperasi) echo "selected"; ?>><?= $row->nama ?></option>
              <?php   //} ?>
            </select>
          </div>
          <?php } ?>
          </div> -->

          <div class="clear-both"></div>

          <div class="col-md-3">
            <div class="form-group ">
              <label for="email">Jumlah Tanggungan</label>
              <input type="number" class="form-control" placeholder="Jumlah Tanggungan" required=""  name="tanggungan" value="<?= $user['jumlah_tanggungan']?>" value="<?= set_value('tanggungan')?>" />
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group ">
              <label for="jumlah_hp">Jumlah HP Aktif</label>
              <input type="number" class="form-control" placeholder="Jumlah HP Aktif" required="" name="jumlah_hp" value="<?= $user['jumlah_hp_aktif']?>" value="<?= set_value('jumlah_hp')?>" />
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group ">
              <label for="jumlah_rumah">Jumlah Akun Bank Yang Dimiliki</label>
              <input type="number" class="form-control" placeholder="Jumlah Akun Bank Yang Dimiliki" required="" name="jumlah_bank" value="<?= $user['jumlah_akun_bank']?>" value="<?= set_value('jumlah_bank')?>" />
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group ">
              <label for="jumlah_cc">Jumlah Kartu Kredit Aktif</label>
              <input type="number" class="form-control" placeholder="Jumlah Kartu Kredit" required="" name="jumlah_cc" value="<?= $user['jumlah_kartu_kredit']?>" value="<?= set_value('jumlah_cc')?>" />
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group ">
              <label for="jum_motor">Jumlah Sepeda Motor Yang Dimiliki</label>
              <input type="number" class="form-control" placeholder="Jumlah Sepeda Motor Yang Dimiliki" required=""  name="jum_motor" value="<?= $user['jumlah_mobil']?>" value="<?= set_value('jum_motor')?>" />
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group ">
              <label for="jum_motor">Jumlah Mobil Yang Dimiliki</label>
              <input type="number" class="form-control" placeholder="Jumlah Mobil Yang Dimiliki" required=""  name="jum_mobil" value="<?= $user['jumlah_mobil']?>" value="<?= set_value('jum_mobil')?>" />
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group ">
              <label for="jumlah_rumah">Jumlah Rumah Yang Dimiliki</label>
              <input type="number" class="form-control" placeholder="Jumlah Rumah Yang Dimiliki" required="" name="jumlah_rumah" value="<?= $user['jumlah_rumah']?>" value="<?= set_value('jumlah_rumah')?>" />
            </div>
          </div>
          <div class="col-md-12">
          <br>
          <b>Pertanyaan Tambahan</b>
          <hr>
           <?php foreach ($question as $row):
                  $q = $this->question_answer_mod->get_question_answered($row->id_pertanyaan, $this->session->userdata('id'));?>
                  <div class="form-group">
                      <label for="form-username"><?= $row->pertanyaan ?></label>
                      <div class="form-inline">
                          <div class="radio">
                              <label>
                              <input type="radio" name="<?= $row->id_pertanyaan ?>" value="Ya"  <?= set_radio($row->id_pertanyaan, 'Ya', TRUE) ?>
                              <?php if($q->row_array()['jawaban'] == "YA") echo "checked"; ?>>
                              Ya
                              </label>
                          </div>
                          <div class="radio">
                              <label>
                              <input type="radio" <?= set_radio($row->id_pertanyaan, 'Tidak') ?> name="<?= $row->id_pertanyaan ?>" value="Tidak" <?= set_radio($row->id_pertanyaan, 'Tidak') ?> <?php if($q->row_array()['jawaban'] == "Tidak") echo "checked"; ?>>
                              Tidak
                              </label>
                          </div>
                      </div>
                  </div>
              <?php endforeach; ?>
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
            <div class="form-group ">
                <label for="NoHp">Nomor Telepon/HP 2</label>
                <input type="text" class="form-control" placeholder="No Telepon / HP" required="" value="<?= $user['telp2'] ?>" name="telepon2" />
            </div>
            <div class="form-group ">
                <label for="NoHp">Nomor Telepon/HP 3</label>
                <input type="text" class="form-control" placeholder="No Telepon / HP" required="" value="<?= $user['telp3'] ?>" name="telepon3" />
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