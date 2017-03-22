<?php 
$this->load->view('template/head');
?>
<!--tambahkan custom css disini-->
<style type="text/css">
#kab_box,#kec_box,#kel_box,#lat_box,#lng_box{display:none;}
</style>
<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>
<!-- Content Header (Page header) -->
<section class="content-header">
   
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Tambah Anggota Koperasi</h3>
        </div>

        <div class="box-body">
        <?= validation_errors() ?>
        <form action="" method="post" action="<?= base_url() ?>/add_anggota" enctype="multipart/form-data">
          <div class="col-md-3">
            <div class="form-group ">
              <label for="noktp">No Identitas</label>
              <input type="text" class="form-control" placeholder="No Identitas" required=""  name="noktp" value="<?= set_value('noktp')?>" />
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="jenis_identitas">Jenis Identitas</label>
              <select class="form-control" name="jenis_identitas">
                <option value="KTP">KTP</option>
                <option value="Passport">Passport</option>
                <option value="SIM">SIM</option>

              </select>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group ">
              <label for="nama_depan">Nama Depan</label>
              <input type="text" class="form-control" placeholder="Nama Depan" required=""  name="nama_depan" value="<?= set_value('nama_depan')?>"/>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group ">
              <label for="nama_belakang">Nama Belakang</label>
              <input type="text" class="form-control" placeholder="Nama Belakang" name="nama_belakang" value="<?= set_value('nama_belakang')?>"/>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group ">
              <label for="no_anggota">No. Anggota</label>
              <input type="text" class="form-control" placeholder="No. Anggota" name="no_anggota" value="<?= set_value('no_anggota')?>"/>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group ">
              <label for="nama_belakang">Tempat Lahir</label>
              <input type="text" class="form-control" placeholder="Tempat Lahir" name="tempat_lahir" value="<?= set_value('tempat_lahir')?>"/>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group ">
              <label for="nama_belakang">Tanggal Lahir</label>
              <input type="text" id="datemask" class="form-control" data-inputmask="'alias': 'hh-bb-tttt'" data-mask placeholder="Tanggal Lahir" name="tanggal_lahir" value="<?= set_value('tanggal_lahir')?>"/>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group ">
              <label for="Alamat">Alamat</label>
              <input type="text" class="form-control" placeholder="Alamat" required=""  name="alamat" value="<?= set_value('alamat')?>"/>
            </div>
          </div>

           
          <div class="col-md-4">
             <div class="form-group ">
              <label for="email">Jabatan</label>
              <input type="text" class="form-control" placeholder="Jabatan" required=""  name="jabatan" value="<?= set_value('jabatan')?>"/>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group ">
              <label for="Pekerjaan">Pekerjaan</label>
              <select name="pekerjaan" class="form-control">
                <?php 
                  foreach ($pekerjaan as $row) { ?>
                     <option value="<?= $row->id_pekerjaan ?>" <?= set_select('pekerjaan', $row->id_pekerjaan) ?>><?= $row->nama ?></option>
                <?php   } ?>
              </select>
            </div>
          </div>
          <div class="col-md-4">
          <div class="form-group ">
            <label for="NoHp">No Telp 1</label>
            <input type="text" class="form-control" placeholder="No Telepon / HP" required=""  name="telepon" value="<?= set_value('telepon')?>"/>
          </div>
          </div>
          <div class="col-md-4">
          <div class="form-group ">
            <label for="NoHp">No Telp 2</label>
            <input type="text" class="form-control" placeholder="No Telepon / HP" required=""  name="telepon2" value="<?= set_value('telepon2')?>"/>
          </div>
          </div>

          <div class="col-md-4">
          <div class="form-group ">
            <label for="NoHp">No Telp 3</label>
            <input type="text" class="form-control" placeholder="No Telepon / HP" required=""  name="telepon3" value="<?= set_value('telepon3')?>"/>
          </div>
          </div>

          <div class="col-md-4">
             <div class="form-group ">
             <label for="JenisKelamin">Jenis Kelamin</label><br />
              <label class="radio-inline">
                <input type="radio" name="jkel" value="laki-laki" <?= set_radio('jkel','laki-laki', TRUE) ?>>Laki-Laki
              </label>
              <label class="radio-inline">
                <input type="radio" name="jkel" value="perempuan" <?= set_radio('jkel', 'perempuan')?>>Perempuan
              </label>
            </div>
          </div>
          <div class="col-md-4">
             <div class="form-group ">
             <label for="JenisKelamin">Gol. Darah</label><br />
              <label class="radio-inline">
                <input type="radio" name="gol_darah" value="A" <?= set_radio('gol_darah', 'A', TRUE) ?>>A
              </label>
              <label class="radio-inline">
                <input type="radio" name="gol_darah" value="B" <?= set_radio('gol_darah', 'B') ?>>B
              </label>
              <label class="radio-inline">
                <input type="radio" name="gol_darah" value="AB" <?= set_radio('gol_darah', 'AB') ?>>AB
              </label>
              <label class="radio-inline">
                <input type="radio" name="gol_darah" value="O" <?= set_radio('gol_darah', 'O') ?>>O
              </label>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="Agama">Agama</label>
              <select name="agama" class="form-control">
                <?php foreach ($agama as $r): ?>
                    <option value="<?= $r->id_agama?>" <?= set_select('agama', $r->id_agama) ?>><?= $r->deskripsi ?> </option>
                <?php endforeach ?>
              </select>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group ">
              <label for="text">RT</label>
              <input type="text" class="form-control" placeholder="RT" required=""  name="rt" value="<?= set_value('rt')?>" />
              <label for="text">RW </label>
              <input type="text" class="form-control" placeholder="RW" required=""  name="rw" value="<?= set_value('rw')?>"/>
              
            </div>
          </div>
          <div class="col-md-3">
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
              <div id="kab_box">
                <label for="Alamat">Kota / Kabupaten</label>
                <select name="kota" id="kota" onchange="ajaxkec(this.value)" class="form-control">
                  <option value="">Pilih Kota/Kab</option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group ">
              <div id="kec_box">
                <label for="Alamat">Kecamatan / Desa</label>
                <select name="kec" id="kec" onchange="ajaxkel(this.value)" class="form-control">
                  <option value="">Pilih Kecamatan</option>
                </select>
              </div>
              <div id="kel_box">
                <label for="Alamat">Kelurahan</label>
                <select name="kel" id="kel" class="form-control">
                  <option value="">Pilih Kelurahan/Desa</option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group ">
              <label for="text">Kode Pos</label>
             <input type="text" class="form-control" placeholder="Kode Pos" required=""  name="kode_pos" value="<?= set_value('kode_pos')?>"/>

              <label for="npwp">NPWP</label>
              <input type="text" class="form-control" placeholder="NPWP" required="" name="npwp" value="<?= set_value('npwp')?>"/>
            </div>
          </div>

                        
              
          <div class="clear-both"></div>

          <div class="col-md-3">
            <div class="form-group ">
              <label for="email">Email</label>
              <input type="email" class="form-control" placeholder="E-mail" required=""  name="email" value="<?= set_value('email')?>"/>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group ">
              <label for="username">Username</label>
              <input type="text" class="form-control" placeholder="Username" required="" name="username" value="<?= set_value('username')?>"/>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group ">
              <label for="password">Password</label>
              <input type="password" class="form-control" placeholder="Password" required="" name="password" value="<?= set_value('password')?>"/>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group ">
              <label for="pin">PIN</label>
              <input type="password" class="form-control" placeholder="PIN" required=""  name="pin" value="<?= set_value('pin')?>" />
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group ">
                <div class="form-group ">
             <label for="JenisKelamin">Pendidikan Terakhir</label><br />
              <?php foreach ($pendidikan as $pend): ?>
              <label class="radio-inline">
                <input type="radio" name="pendidikan" value="<?= $pend->id_pendidikan ?>" <?= set_radio('pendidikan',$pend->id_pendidikan, TRUE) ?>><?= $pend->deskripsi ?>
              </label>
              <?php endforeach ?>
            </div>
            </div>
          </div>

          <div class="col-md-6">
          <?php 
            if($this->session->userdata('level') == "1"){ ?>
          <div class="form-group ">
            <label for="Koperasi">Koperasi</label>
            <select name="koperasi" class="form-control">
              <?php 
                foreach ($koperasi as $row) { ?>
                   <option value="<?= $row->id_koperasi ?>"><?= $row->nama ?></option>
              <?php   } ?>
            </select>
          </div>
          <?php } ?>
          </div>

          <div class="clear-both"></div>

          <div class="col-md-3">
            <div class="form-group ">
              <label for="email">Jumlah Tanggungan</label>
              <input type="number" class="form-control" placeholder="Jumlah Tanggungan" required=""  name="tanggungan" value="<?= set_value('tanggungan')?>" />
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group ">
              <label for="jumlah_hp">Jumlah HP Aktif</label>
              <input type="number" class="form-control" placeholder="Jumlah HP Aktif" required="" name="jumlah_hp" value="<?= set_value('jumlah_hp')?>" />
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group ">
              <label for="jumlah_rumah">Jumlah Akun Bank Yang Dimiliki</label>
              <input type="number" class="form-control" placeholder="Jumlah Akun Bank Yang Dimiliki" required="" name="jumlah_bank" value="<?= set_value('jumlah_bank')?>" />
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group ">
              <label for="jumlah_cc">Jumlah Kartu Kredit Aktif</label>
              <input type="number" class="form-control" placeholder="Jumlah Kartu Kredit" required="" name="jumlah_cc" value="<?= set_value('jumlah_cc')?>" />
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group ">
              <label for="jum_motor">Jumlah Sepeda Motor Yang Dimiliki</label>
              <input type="number" class="form-control" placeholder="Jumlah Sepeda Motor Yang Dimiliki" required=""  name="jum_motor" value="<?= set_value('jum_motor')?>" />
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group ">
              <label for="jum_motor">Jumlah Mobil Yang Dimiliki</label>
              <input type="number" class="form-control" placeholder="Jumlah Mobil Yang Dimiliki" required=""  name="jum_mobil" value="<?= set_value('jum_mobil')?>" />
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group ">
              <label for="jumlah_rumah">Jumlah Rumah Yang Dimiliki</label>
              <input type="number" class="form-control" placeholder="Jumlah Rumah Yang Dimiliki" required="" name="jumlah_rumah" value="<?= set_value('jumlah_rumah')?>" />
            </div>
          </div>

        

          <div class="col-md-12">
          <br>
          <b>Pertanyaan Tambahan</b>
          <hr>
          <table class="table table-responsive no-border">
          <?php foreach ($question as $row){ ?>
                  <tr>
                    <td>
                      <div class="col-md-4">
                        <label for="form-username"><?= $row->pertanyaan ?></label>
                      </div>
                      <div class="col-md-8">
                        <input type="radio" name="<?= $row->id_pertanyaan ?>" value="Ya"  <?= set_radio($row->id_pertanyaan, 'Ya', TRUE) ?> checked>
                      Ya
                      <input type="radio" <?= set_radio($row->id_pertanyaan, 'Tidak') ?> name="<?= $row->id_pertanyaan ?>" value="Tidak">
                      Tidak
                      </div>
                  </tr>
          <?php  }?>
          </table>
          </div>

          <div class="row">
            <div class="col-xs-4">
            <br>
              <button type="submit" class="btn btn-primary btn-block btn-flat">Daftar</button>
            </div>
          </div>
        </form>
    </div><!-- /.box -->

</section><!-- /.content -->

<?php 
$this->load->view('template/js');
?>
<!--tambahkan custom js disini-->
<script src="<?= base_url() ?>assets/AdminLTE-2.0.5/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/AdminLTE-2.0.5/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/AdminLTE-2.0.5/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
<script type="text/javascript">
$(function () {
//Datemask dd/mm/yyyy
$("#datemask").inputmask("dd-mm-yyyy", {"placeholder": "hh-bb-tttt"});
});
</script>
<script type="text/javascript" src="<?= base_url()?>assets/js/ajax_daerah.js"></script>
<?php
$this->load->view('template/foot');
?>