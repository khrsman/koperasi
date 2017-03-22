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
            <h3 class="box-title">Tambah Anggota Komunitas</h3>
        </div>

        <div class="box-body">
        <?= validation_errors() ?>
        <form action="" method="post" action="<?= base_url() ?>/add_anggota_komunitas" enctype="multipart/form-data">
        <div class="col-md-6">
          <div class="form-group ">
            <label for="nama_depan">Nama Depan</label>
            <input type="text" class="form-control" placeholder="Nama Depan" required=""  name="nama_depan" />
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group ">
            <label for="nama_belakang">Nama Belakang</label>
            <input type="text" class="form-control" placeholder="Nama Belakang" name="nama_belakang" />
          </div>
        </div>
        <div class="col-md-6">
            <div class="form-group ">
              <label for="nama_belakang">Tempat Lahir</label>
              <input type="text" class="form-control" placeholder="Tempat Lahir" name="tempat_lahir" />
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group ">
              <label for="nama_belakang">Tanggal Lahir</label>
              <input type="text" class="form-control" placeholder="Tanggal Lahir" name="tanggal_lahir" />
            </div>
          </div>
           <div class="form-group ">
            <label for="noktp">NO KTP</label>
            <input type="text" class="form-control" placeholder="NO KTP" required=""  name="noktp" />
          </div>
           <div class="form-group ">
            <label for="email">Jabatan</label>
            <input type="text" class="form-control" placeholder="Jabatan" required=""  name="jabatan" />
          </div>
          <div class="form-group ">
            <label for="Alamat">Alamat</label>
            <input type="text" class="form-control" placeholder="Alamat" required=""  name="alamat" />
          </div>
           <div class="form-group ">
           <label for="JenisKelamin">Jenis Kelamin</label><br />
            <label class="radio-inline">
              <input type="radio" name="jkel" value="laki-laki" checked="">Laki-Laki
            </label>
            <label class="radio-inline">
              <input type="radio" name="jkel" value="perempuan">Perempuan
            </label>
          </div>
          <div class="form-group ">
            <label for="email">Email</label>
            <input type="email" class="form-control" placeholder="E-mail" required=""  name="email" />
          </div>
          <div class="form-group ">
            <label for="NoHp">No HP</label>
            <input type="text" class="form-control" placeholder="No Telepon / HP" required=""  name="telepon" />
          </div>
          <div class="form-group ">
            <label for="username">Username</label>
            <input type="text" class="form-control" placeholder="Username" required="" name="username" />
          </div>

          <div class="form-group ">
            <label for="password">Password</label>
            <input type="password" class="form-control" placeholder="Password" required="" name="password" />
          </div>

           <div class="form-group ">
            <label for="Pekerjaan">Pekerjaan</label>
            <select name="pekerjaan" class="form-control">
              <?php 
                foreach ($pekerjaan as $row) { ?>
                   <option value="<?= $row->id_pekerjaan ?>"><?= $row->nama ?></option>
              <?php   } ?>
            </select>
          </div>
          <?php 
            if($this->session->userdata('level') == "1"){ ?>
          <div class="form-group ">
            <label for="Komunitas">Komunitas</label>
            <select name="komunitas" class="form-control">
              <?php 
                foreach ($komunitas as $row) { ?>
                   <option value="<?= $row->id_komunitas ?>"><?= $row->nama ?></option>
              <?php   } ?>
            </select>
          </div>
          <?php } ?>
           <div class="form-group">
            <label for="Agama">Agama</label>
            <select name="agama" class="form-control">
              <?php foreach ($agama as $r): ?>
                  <option value="<?= $r ?>"><?= $r ?> </option>
              <?php endforeach ?>
            </select>
          </div>
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