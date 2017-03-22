<?php
$this->load->view('template/head');
?>
<!--tambahkan custom css disini-->
<link href="<?= base_url() ?>assets/AdminLTE-2.0.5/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>assets/AdminLTE-2.0.5//plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
<style>
#map-canvas {width:100%;height:400px;border:solid #999 1px;}
#kab_box,#kec_box,#kel_box,#lat_box,#lng_box{display:none;}
</style>
<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>
<!-- Content Header (Page header) -->
<section class="content-header"></section>
<!-- Main content -->
<section class="content">
<div class="col-md-7"><?= validation_errors() ?></div>
<div class="col-md-5">
    <?php
    if($this->session->flashdata('msg') != NULL){
    echo '<div class="alert alert-info" role="alert" style="padding: 6px 12px;height:34px;">';
        echo "<i class='fa fa-info-circle'></i> <strong><span style='margin-left:10px;'>".$this->session->flashdata('msg')."</span></strong>";
    echo '</div>';
    }?>
</div>
<div class="col-md-7">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Profile </h3>
        </div>
        <div class="box-body">
            <form method="post" action="<?= base_url() ?>update_profile" enctype="multipart/form-data">
                <?php if(($this->session->userdata('level') != "2") AND ($this->session->userdata('level') !="4")){ ?>
                <div class="form-group ">
                    <label for="nama_depan">Nama Depan</label>
                    <input type="text" class="form-control" placeholder="Nama Depan" required="" value="<?= $user['nama_depan'] ?>" name="nama_depan" />
                </div>
                <div class="form-group ">
                    <label for="nama_belakang">Nama Belakang</label>
                    <input type="text" class="form-control" placeholder="Nama Belakang" value="<?= $user['nama_belakang'] ?>" name="nama_belakang" />
                </div>
                <?php if($this->session->userdata('level') != 3){?>
                <div class="form-group ">
                    <label for="alamat">Alamat</label>
                    <input type="text" class="form-control" placeholder="Alamat" value="<?= $user['alamat'] ?>" name="alamat" />
                </div>
                <?php } }
                else {?>
                <div class="form-group ">
                    <label for="nama_belakang">Nama  <?php if($this->session->userdata('level') == "2"){ echo"Koperasi";}?> <?php if ($this->session->userdata('level') =="4") {echo "Komunitas" ;}?></label>
                    <input type="text" class="form-control" placeholder="Nama Belakang" required="" value="<?= $user['nama_lengkap'] ?>" name="nama" />
                </div>
                <?php } ?>
                <?php if($this->session->userdata('level') != "2" AND ($this->session->userdata('level') !="4")){ ?>
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
                

                <?php if ($this->session->userdata('level')==3){ ?>
                 <div class="form-group ">
                    <label for="email">PIN</label>
                    <input type="text" class="form-control" placeholder="PIN" size="8" required="" value="<?= $user['user_ver'] ?>" name="pin" />
                </div>
                <div class="form-group ">
                    <label for="jabatan">No KTP</label>
                    <input type="jabatan" class="form-control" placeholder="No KTP" required="" value="<?= $user['no_ktp'] ?>" name="noktp" />
                </div>
                <div class="form-group ">
                    <label for="jabatan">Jabatan</label>
                    <input type="jabatan" class="form-control" placeholder="Jabatan" required="" value="<?= $user['jabatan'] ?>" name="jabatan" />
                </div>
                <?php }} ?>
                <div class="form-group ">
                    <label for="NoHp">No HP</label>
                    <input type="text" class="form-control" placeholder="No Telepon / HP" required="" value="<?= $user['telp'] ?>" name="telepon" />
                </div>
                <?php
                if($this->session->userdata('level') != "1"){ ?>
                <!-- Jika yang nginput nya user -->
                <?php if ($this->session->userdata('level') == "3") {?>
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
                <?php if(empty($this->session->userdata('koperasi'))) { ?>
                <div class="form-group ">
                    <label for="Koperasi">Koperasi</label>
                    <select name="koperasi" class="form-control">
                        <?php
                        foreach ($data_kop as $row) { ?>
                        <option value="<?= $row->id_koperasi ?>" <?php if($row->id_koperasi == $user['koperasi'])
                            echo "selected";
                            else
                        echo ""; ?>><?= $row->nama ?></option><?php }?>
                    </select>
                </div>
                <?php } else { ?>
                <div class="form-group ">
                    <label for="koperasi">Koperasi</label>
                    <input type="text" class="form-control" disabled="" value="<?= $user['nama'] ?>" />
                </div>
                <?php } ?><!-- end of if user select koperasi -->
                <?php } ?> <!-- end of if user -->
                <!-- Jika Koperasi -->
                <?php if($this->session->userdata('level')== "2") { ?>
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
                        <label for="Legal">Legal</label>
                        <input type="text" class="form-control" placeholder="Legal" value="<?= $user['legal'] ?>"  value="<?= set_value('legal') ?>" name="legal" />
                    </div>
                    <div class="form-group ">
                        <label for="Ketua">Ketua Koperasi</label>
                        <input type="text" class="form-control" placeholder="Ketua Koperasi" required="" value="<?= $user['ketua_koperasi'] ?>"  value="<?= set_value('ketua') ?>" name="ketua" />
                    </div>
                    <div class="form-group ">
                        <label for="Ketua Telp">No Telepon Ketua Koperasi</label>
                        <input type="text" class="form-control" placeholder="No Telepon Ketua Koperasi" required="" value="<?= $user['ketua_koperasi_telp'] ?>"  value="<?= set_value('ketua_telp') ?>" name="ketua_telp" />
                    </div>
                    <div class="form-group ">
                        <label for="Keterangan">Keterangan</label>
                        <textarea id="mytextarea" class="form-control" name="keterangan" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?= $user['keterangan_koperasi'] ?> <?= set_value('keterangan') ?></textarea>
                    </div>
                    
                    <?php } ?> <!-- end of if koperasi -->

                     <?php if($this->session->userdata('level')== "4") { ?>
                    <div class="form-group ">

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
                     <?php } ?>

                    <?php if ($this->session->userdata('level') == "5") {?>
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
                    <?php if(empty($this->session->userdata('komunitas'))) { ?>
                    <div class="form-group ">
                        <label for="Koperasi">Komunitas</label>
                        <select name="komunitas" class="form-control">
                            <?php
                            foreach ($data_kom as $row) { ?>
                            <option value="<?= $row->id_komunitas ?>" <?php if($row->id_komunitas == $user['komunitas'])
                                echo "selected";
                                else
                            echo ""; ?>><?= $row->nama ?></option><?php }?>
                        </select>
                    </div>
                    <?php } else { ?>
                    <div class="form-group ">
                        <label for="koperasi">Komunitas</label>
                        <input type="text" class="form-control" disabled="" value="<?= $user['nama'] ?>" />
                    </div>
                    <?php } ?><!-- end of if user select komunitas -->
                    <?php } ?> <!-- end of if anggota komunitas -->
                    
                    <?php } ?>  <!-- end of not admin -->
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Perbaharui Data</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><?= $text_upload_photo ?></h3>
            </div>
            <div class="box-body">
                <form method="POST" action="<?= base_url()?>photo_profile" enctype="multipart/form-data">
                    <div class="form-group ">
                        <label for="foto">Upload Foto</label>
                        <div class="input-group input-group-sm">
                            <input type="file" class="form-control" name="photo" accept="image/*" />
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-info btn-flat">Upload</button>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-5">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Update Password</h3>
            </div>
            <div class="box-body">
                <form method="POST" action="<?= base_url()?>update_password" enctype="multipart/form-data">
                    <div class="form-group ">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" placeholder="Username" required="" value="<?= $user['username'] ?>" name="username" readonly />
                    </div>
                    <div class="form-group ">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" placeholder="Password" required="" value="" name="password" />
                    </div>
                    <div class="form-group ">
                        <label for="password">Konfirmasi Password</label>
                        <input type="password" class="form-control" placeholder="Konfirmasi Password" required="" value="" name="confirm_password" />
                    </div>
                </form>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Perbaharui Data</button>
            </div>
        </div>
    </div>

    
   
        <?php if($this->session->userdata('level')== 2 or $this->session->userdata('level') == 4) {?>
        <div class="col-md-5">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Upload Foto Cover</h3>
                </div>
                <div class="box-body">
                    <form method="POST" action="<?= base_url()?>photo_cover" enctype="multipart/form-data">
                        <div class="form-group ">
                            <label for="foto">Upload Foto</label>
                            <div class="input-group input-group-sm">
                                <input type="file" class="form-control" name="photo" accept="image/*" />
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-info btn-flat">Upload</button>
                                </span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php } ?>
        <div class="clear-both"></div>

        <?php if($this->session->userdata('level')=="3"){ ?>
         <div class="col-md-12">
        
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Alamat Anda</h3>
                <button type="button" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#myModal">
                  Tambah Alamat
                </button>

            </div>
            <div class="box-body">
                <table id="dataUser" class="table table-bordered table-striped">
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
                            <td> <button type="button" class="btn btn-info btn-sm" onclick=location.href="<?= base_url() ?>setDefaultAlamat/<?= $row->id_alamat ?>"><i class="fa fa-check-circle-o"></i></button>
                                 <button type="button" class="btn btn-danger btn-sm" onclick=confirmHapus(<?= $row->id_alamat ?>)><i class="fa fa-trash"></i></button>
                                 </td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="clear-both"></div>

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
            <form method="POST" action="<?= base_url() ?>add_alamat">
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
        <?php } ?>
    </section>
    <!-- /.content -->
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
     <script type="text/javascript">
       function confirmHapus(id)
          {
               if(confirm('Anda Yakin Untuk Menghapus Alamat ?'))
               {
                  window.location.href='<?= base_url() ?>delete_alamat/'+id;
               }
          }
          </script>

    <?php
    $this->load->view('template/foot');
    ?>