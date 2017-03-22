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
        <form method="post" action="<?= base_url() ?>update_anggota" enctype="multipart/form-data">
          <div class="form-group ">
            <label for="nama_depan">Nama Depan</label>
            <input type="text" class="form-control" placeholder="Nama Depan" required="" value="<?= $user['nama_depan'] ?>" name="nama_depan" />
          </div>
          <div class="form-group ">
            <label for="nama_belakang">Nama Belakang</label>
            <input type="text" class="form-control" placeholder="Nama Belakang" value="<?= $user['nama_belakang'] ?>" name="nama_belakang" />
          </div>
           <div class="form-group ">
            <label for="pin">PIN</label>
            <input type="text" class="form-control" placeholder="PIN" required=""  name="pin" value="<?= $user['user_ver'] ?>" />
          </div>
           <div class="form-group ">
            <label for="noktp">NO KTP</label>
            <input type="text" class="form-control" placeholder="NO KTP" required=""  name="noktp" value="<?= $user['noktp']?>" />
          </div>
           <div class="form-group ">
            <label for="email">Jabatan</label>
            <input type="email" class="form-control" placeholder="Jabatan" required=""  name="jabatan"  value="<?= $user['jabatan']?>" />
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
          <div class="form-group ">
            <label for="username">Jabatan</label>
            <input type="text" class="form-control" placeholder="jabatan" required="" name="jabatan" value="" />
          </div>

        <?php if ($this->session->userdata('level') == 1) { ?>
          <div class="form-group ">
            <label for="Koperasi">Koperasi</label>
            <select name="koperasi" class="form-control">
              <?php 
                foreach ($koperasi as $row) { ?>
                   <option value="<?= $row->id_koperasi ?>" <?php if($row->id_koperasi == $user['koperasi'])
                                      echo "selected";
                                      else
                                      echo ""; ?>><?= $row->nama ?></option>
              <?php   } ?>
            </select>
          </div>
        <?php } ?>
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