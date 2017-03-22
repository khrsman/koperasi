<?php 
$this->load->view('template/head');
?>
<!--tambahkan custom css disini-->
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
          <div class="col-md-4">
            <div class="form-group ">
              <label for="noktp">NO KTP</label>
              <input type="text" class="form-control" placeholder="NO KTP" required=""  name="noktp" />
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group ">
              <label for="nama_depan">Nama Depan</label>
              <input type="text" class="form-control" placeholder="Nama Depan" required=""  name="nama_depan" />
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group ">
              <label for="nama_belakang">Nama Belakang</label>
              <input type="text" class="form-control" placeholder="Nama Belakang" name="nama_belakang" />
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group ">
              <label for="no_anggota">No. Anggota</label>
              <input type="text" class="form-control" placeholder="No. Anggota" name="no_anggota" />
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group ">
              <label for="nama_belakang">Tempat Lahir</label>
              <input type="text" class="form-control" placeholder="Tempat Lahir" name="tempat_lahir" />
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group ">
              <label for="nama_belakang">Tanggal Lahir</label>
              <input type="text" class="form-control" placeholder="Tanggal Lahir" name="tanggal_lahir" />
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group ">
              <label for="Alamat">Alamat</label>
              <input type="text" class="form-control" placeholder="Alamat" required=""  name="alamat" />
            </div>
          </div>

           
          <div class="col-md-4">
             <div class="form-group ">
              <label for="email">Jabatan</label>
              <input type="text" class="form-control" placeholder="Jabatan" required=""  name="jabatan" />
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group ">
              <label for="Pekerjaan">Pekerjaan</label>
              <select name="pekerjaan" class="form-control">
                <?php 
                  foreach ($pekerjaan as $row) { ?>
                     <option value="<?= $row->id_pekerjaan ?>"><?= $row->nama ?></option>
                <?php   } ?>
              </select>
            </div>
          </div>
          <div class="col-md-4">
          <div class="form-group ">
            <label for="NoHp">No Telp 1</label>
            <input type="text" class="form-control" placeholder="No Telepon / HP" required=""  name="telepon" />
          </div>
          </div>
          <div class="col-md-4">
          <div class="form-group ">
            <label for="NoHp">No Telp 2</label>
            <input type="text" class="form-control" placeholder="No Telepon / HP" required=""  name="telepon" />
          </div>
          </div>

          <div class="col-md-4">
          <div class="form-group ">
            <label for="NoHp">No Telp 3</label>
            <input type="text" class="form-control" placeholder="No Telepon / HP" required=""  name="telepon" />
          </div>
          </div>

          <div class="col-md-4">
             <div class="form-group ">
             <label for="JenisKelamin">Jenis Kelamin</label><br />
              <label class="radio-inline">
                <input type="radio" name="jkel" value="laki-laki" checked="">Laki-Laki
              </label>
              <label class="radio-inline">
                <input type="radio" name="jkel" value="perempuan">Perempuan
              </label>
            </div>
          </div>
          <div class="col-md-4">
             <div class="form-group ">
             <label for="JenisKelamin">Gol. Darah</label><br />
              <label class="radio-inline">
                <input type="radio" name="gol_darah" value="A" checked="">A
              </label>
              <label class="radio-inline">
                <input type="radio" name="gol_darah" value="B">B
              </label>
              <label class="radio-inline">
                <input type="radio" name="gol_darah" value="AB">AB
              </label>
              <label class="radio-inline">
                <input type="radio" name="gol_darah" value="O">O
              </label>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="Agama">Agama</label>
              <select name="agama" class="form-control">
                <?php foreach ($agama as $r): ?>
                    <option value="<?= $r ?>"><?= $r ?> </option>
                <?php endforeach ?>
              </select>
            </div>
          </div>


          <div class="col-md-3">
            <div class="form-group ">
              <label for="text">RT</label>
              <input type="text" class="form-control" placeholder="RT" required=""  name="rt" />
              <label for="text">RW </label>
              <input type="text" class="form-control" placeholder="RW" required=""  name="rw" />
              
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group ">
              <label for="text">Kota / Kabupaten</label>
              <input type="text" class="form-control" placeholder="kota/kab" required=""  name="kota" />
              <label for="text">Kelurahan</label>
              <input type="text" class="form-control" placeholder="kelurahan" required=""  name="kelurahan" />
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group ">
              <label for="text">Kecamatan</label>
              <input type="text" class="form-control" placeholder="kecamatan" required=""  name="kecamatan" />
              <label for="text">Provinsi</label>
              <input type="text" class="form-control" placeholder="provinsi" required=""  name="provinsi" />
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group ">
              <label for="text">Kode Pos</label>
             <input type="text" class="form-control" placeholder="kode_pos" required=""  name="kode_pos" />

              <label for="npwp">NPWP</label>
              <input type="text" class="form-control" placeholder="NPWP" required="" name="npwp" />
            </div>
          </div>

                        
              
          <div class="clear-both"></div>

          <div class="col-md-3">
            <div class="form-group ">
              <label for="email">Email</label>
              <input type="email" class="form-control" placeholder="E-mail" required=""  name="email" />
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group ">
              <label for="username">Username</label>
              <input type="text" class="form-control" placeholder="Username" required="" name="username" />
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group ">
              <label for="password">Password</label>
              <input type="password" class="form-control" placeholder="Password" required="" name="password" />
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group ">
              <label for="pin">PIN</label>
              <input type="password" class="form-control" placeholder="PIN" required=""  name="pin" />
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group ">
                <div class="form-group ">
             <label for="JenisKelamin">Pendidikan Terakhir</label><br />
              <label class="radio-inline">
                <input type="radio" name="pendidikan" value="SD" checked="">SD
              </label>
              <label class="radio-inline">
                <input type="radio" name="pendidikan" value="SMP">SMP
              </label>
              <label class="radio-inline">
                <input type="radio" name="pendidikan" value="SMA">SMA
              </label>
              <label class="radio-inline">
                <input type="radio" name="pendidikan" value="Diploma">Diploma
              </label>
              <label class="radio-inline">
                <input type="radio" name="pendidikan" value="S1">S1
              </label>
              <label class="radio-inline">
                <input type="radio" name="pendidikan" value="S2">S2
              </label>
              <label class="radio-inline">
                <input type="radio" name="pendidikan" value="S3">S3
              </label>
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
              <input type="number" class="form-control" placeholder="Jumlah Tanggungan" required=""  name="tanggungan" />
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group ">
              <label for="jumlah_hp">Jumlah HP Aktif</label>
              <input type="number" class="form-control" placeholder="Jumlah HP Aktif" required="" name="jumlah_hp" />
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group ">
              <label for="jumlah_rumah">Jumlah Akun Bank Yang Dimiliki</label>
              <input type="number" class="form-control" placeholder="Jumlah Akun Bank Yang Dimiliki" required="" name="jumlah_bank" />
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group ">
              <label for="jumlah_cc">Jumlah Kartu Kredit Aktif</label>
              <input type="number" class="form-control" placeholder="Password" required="" name="jumlah_cc" />
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group ">
              <label for="jum_motor">Jumlah Sepeda Motor Yang Dimiliki</label>
              <input type="number" class="form-control" placeholder="Jumlah Sepeda Motor Yang Dimiliki" required=""  name="jum_motor" />
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group ">
              <label for="jum_motor">Jumlah Mobil Yang Dimiliki</label>
              <input type="number" class="form-control" placeholder=">Jumlah Mobil Yang Dimiliki" required=""  name="jum_mobil" />
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group ">
              <label for="jumlah_rumah">Jumlah Rumah Yang Dimiliki</label>
              <input type="number" class="form-control" placeholder="Jumlah Rumah Yang Dimiliki" required="" name="jumlah_rumah" />
            </div>
          </div>

        

          <div class="col-md-12">
          <br>
          <b>Pertanyaan Tambahan</b>
          <hr>
          
          <?php foreach ($question as $row){ ?>
                            <div class="form-group">
                                <label for="form-username"><?= $row->pertanyaan ?></label>
                                <div class="form-inline">
                                    <div class="radio">
                                        <label>
                                        <input type="radio" name="<?= $row->id_pertanyaan ?>" value="Ya"  <?= set_radio($row->id_pertanyaan, 'Ya', TRUE) ?> checked>
                                        Ya
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                        <input type="radio" <?= set_radio($row->id_pertanyaan, 'Tidak') ?> name="<?= $row->id_pertanyaan ?>" value="Tidak">
                                        Tidak
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <?php  }?>
          </div>

          <div class="row">
            <div class="col-xs-4">
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
<?php
$this->load->view('template/foot');
?>