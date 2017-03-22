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
    <?= validation_errors() ?>
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Anggota</h3>
        </div>

        <div class="box-body">
        <form method="post" action="<?= base_url() ?>update_anggota_komunitas" enctype="multipart/form-data">
          <div class="form-group ">
            <label for="nama_depan">Nama Depan</label>
            <input type="text" class="form-control" placeholder="Nama Depan" required="" value="<?= $user['nama_depan'] ?>" name="nama_depan" />
          </div>
          <div class="form-group ">
            <label for="nama_belakang">Nama Belakang</label>
            <input type="text" class="form-control" placeholder="Nama Belakang" value="<?= $user['nama_belakang'] ?>" name="nama_belakang" />
          </div>
           <div class="form-group ">
            <label for="noktp">NO KTP</label>
            <input type="text" class="form-control" placeholder="NO KTP" required=""  name="noktp" value="<?= $user['no_ktp']?>" />
          </div>
           <div class="form-group ">
            <label for="email">Jabatan</label>
            <input type="text" class="form-control" placeholder="Jabatan" required=""  name="jabatan"  value="<?= $user['jabatan']?>" />
          </div>
          <div class="form-group ">
            <label for="Alamat">Alamat</label>
            <input type="text" class="form-control" placeholder="Alamat" required="" value="<?= $user['alamat'] ?>"  name="alamat" />
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
            <label for="email">Email</label>
            <input type="email" class="form-control" placeholder="E-mail" required="" value="<?= $user['email'] ?>" name="email" />
          </div>
          <div class="form-group ">
            <label for="NoHp">No HP</label>
            <input type="text" class="form-control" placeholder="No Telepon / HP" required="" value="<?= $user['telp'] ?>" name="telepon" />
          </div>
          <div class="form-group ">
            <label for="username">Username</label>
            <input type="text" class="form-control" placeholder="Username" required="" value="<?= $user['username'] ?>" name="username" readonly />
          </div>
           <div class="form-group ">
            <label for="Pekerjaan">Pekerjaan</label>
            <select name="pekerjaan" class="form-control">
              <?php 
                foreach ($pekerjaan as $row) { ?>
                   <option value="<?= $row->id_pekerjaan ?>" <?php if($row->id_pekerjaan == $user['pekerjaan'])
                                      echo "selected";
                                      else
                                      echo ""; ?>><?= $row->nama ?></option>
              <?php   } ?>
            </select>
          </div>
<?php if($this->session->userdata('level') == 1){ ?>
          <div class="form-group ">
            <label for="Komunitas">Komunitas</label>
            <select name="komunitas" class="form-control">
              <?php 
                foreach ($komunitas as $row) { ?>
                   <option value="<?= $row->id_komunitas ?>" <?php if($row->id_komunitas == $user['komunitas'])
                                      echo "selected";
                                      else
                                      echo ""; ?>><?= $row->nama ?></option>
              <?php   } ?>
            </select>
          </div>
<?php } ?>
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
              <button type="submit" class="btn btn-primary btn-block btn-flat">Edit</button>
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