<?php
$this->load->view('template/head');
?>
<!--tambahkan custom css disini-->
<link href="<?= base_url() ?>assets/select2-4.0.2/dist/css/select2.min.css" rel="stylesheet" />

<link href="<?= base_url() ?>assets/AdminLTE-2.0.5/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>assets/AdminLTE-2.0.5//plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
<style>
#map-canvas {width:100%;height:400px;border:solid #999 1px;}

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
$alakop = $alamat_koperasi->row_array() ?>
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
      <li class=""><a href="#alamat" data-toggle="tab" aria-expanded="false">Informasi Alamat</a></li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane active" id="basic_profile">
        <form id="formBasic" method="post" action="<?= base_url() ?>koperasi_update_basic"  enctype="multipart/form-data">
        <div class="col-md-4">
          <div class="form-group ">
                  <label for="nama_belakang">Nama Koperasi</label>
                  <input type="text" class="form-control" placeholder="Nama Koperasi" required="" value="<?= $koperasi['nama'] ?>" name="nama" />
              </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
          <label>Tanggal Berdiri</label>
          <div class="input-group">
              <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
              </div>
              <input type="text" id="datemask" class="form-control" data-inputmask="'alias': 'hh/bb/tttt'" name="berdiri" value="<?= $koperasi['tgl_berdiri'] ?>" value="<?= set_value('berdiri') ?>" data-mask/>
              </div><!-- /.input group -->
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group ">
              <label for="Legal">Legal</label>
              <input type="text" class="form-control" placeholder="Legal" value="<?= $koperasi['legal'] ?>"  value="<?= set_value('legal') ?>" name="legal" />
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group ">
              <label for="Ketua">Ketua Koperasi</label>
              <input type="text" class="form-control" placeholder="Ketua Koperasi" required="" value="<?= $koperasi['ketua_koperasi'] ?>"  value="<?= set_value('ketua') ?>" name="ketua" />
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group ">
              <label for="Ketua Telp">No Telepon Ketua Koperasi</label>
              <input type="text" class="form-control" placeholder="No Telepon Ketua Koperasi" required="" value="<?= $koperasi['ketua_koperasi_telp'] ?>"  value="<?= set_value('ketua_telp') ?>" name="ketua_telp" />
          </div>
        </div>
                <?php if($this->session->userdata('level') == "1") {?>
            <div class="col-md-4">
                    <div class="form-group ">
                      <label for="Koperasi">Koperasi Cabang</label>
                      <select name="koperasi" class="data-koperasi form-control">
                        <option value="0" selected="selected">Induk</option>
                      </select>
                    </div>
              </div>
                <?php } ?>
                <div class="clear-both"></div>
             <div class="col-md-4">
                <div class="form-group">
                <label for="polis">Polis</label>
                    <select class="js-data-example-ajax form-control" name="polis">
                      <option value="<?= $koperasi['polis'] ?>" selected="selected">Sama Dengan Sebelumnya</option>
                    </select>
                </div>
            </div>
             <div class="col-md-4">
              <div class="form-group ">
                <label for="NoHp">Jenis Koperasi</label>
                <select name="jenis" class="form-control">
                    <?php foreach ($jenis_koperasi->result() as $row): ?>
                        <option value="<?= $row->id_jenis_koperasi ?>"
                        <?php if($row->id_jenis_koperasi == $koperasi['jenis_koperasi']) echo "selected"; ?>
                        ><?= $row->deskripsi?></option>
                    <?php endforeach; ?>
                </select>
              </div>
            </div>
        <div class="col-md-12">

          <div class="form-group ">
              <label for="Keterangan">Keterangan</label>
              <textarea id="mytextarea" class="form-control" name="keterangan" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?= $koperasi['keterangan_koperasi'] ?> <?= set_value('keterangan') ?></textarea>
          </div>
        </div>
          <button type="submit" class="btn btn-primary btn-block btn-flat">Perbaharui Data</button>
        </form>
      </div>
      <!-- /.tab-pane -->
      <div class="tab-pane" id="update_password">
        <form method="POST" action="<?= base_url()?>koperasi_update_password" enctype="multipart/form-data">
            <div class="form-group ">
                <label for="username">Username</label>
                <input type="text" class="form-control" placeholder="Username" required="" value="<?= $koperasi['username'] ?>" name="username" readonly />
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
        <form method="POST" action="<?= base_url()?>koperasi_update_contact" enctype="multipart/form-data">
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
      <div class="tab-pane" id="alamat">

          <div class="form-group">
            <label>Alamat Koperasi</label>
            <input type="text" value="<?php foreach ($alamat_koperasi->result() as $row): ?>
               <?= $row->alamat.", ".$row->nama_kelurahan.", ".$row->nama_kecamatan.", ". $row->nama_kabupaten.", ".$row->nama_provinsi ; ?>
                <?php endforeach; ?>" class="form-control" disabled>
          </div>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" style="margin: 25px;">
                  Ubah Alamat
          </button>
      <!-- /.tab-pane -->
    </div>
    <!-- /.tab-content -->
  </div>
</section>
<!-- /.content -->
<div class="clear-both"></div>

  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
            <form method="POST" action="<?= base_url() ?>koperasi_update_alamat">
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
                        <label for="Ketua Telp">No Telepon Koperasi</label>
                        <input type="text" class="form-control" placeholder="No Telepon" required="" name="telepon" />
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
              </div>
              </form>
            </div>
          </div>
        </div>

<?php
$this->load->view('template/js');
?>

<!--tambahkan custom js disini-->
<script type="text/javascript">
  $(document).ready(function(){

      var kota ='<?= $alakop['kabupaten'] ?>';
      var kec ='<?= $alakop['kecamatan'] ?>';
      var kel ='<?= $alakop['kelurahan'] ?>';

      $("#kota option[value='kota']").prop('selected', true);
      $("#kec option[value='kec']").prop('selected', true);
      $("#kel option[value='kel']").prop('selected', true);



      $('#kota').val(kota);
      $('#kec').val(kec);
      $('#kel').val(kel);
   });
</script>
<script src="<?= base_url() ?>assets/select2-4.0.2/dist/js/select2.js"></script>

<script src="<?= base_url() ?>assets/AdminLTE-2.0.5/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/AdminLTE-2.0.5/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/AdminLTE-2.0.5/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/AdminLTE-2.0.5/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>

<script src="<?= base_url() ?>assets/AdminLTE-2.0.5/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/AdminLTE-2.0.5/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<script type="text/javascript" src="<?= base_url()?>assets/js/ajax_daerah.js"></script>
<script type="text/javascript" src="<?= base_url()?>assets/js/ajax_daerah_edit.js"></script>

<script type="text/javascript">
  function load_daerah() {
      ajaxalamat(<?= $alakop['provinsi'] ?>,<?= $alakop['kabupaten'] ?>,<?= $alakop['kecamatan'] ?>);
  }
  window.onload = function(){
      load_daerah();
  };
</script>
<script type="text/javascript">
$(function () {
//Datemask dd/mm/yyyy
$("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "hh/bb/tttt"});
$("#mytextarea").wysihtml5();
});
</script>
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
 function formatRepo (repo) {
    if (repo.loading) return repo.text;

    var markup = '<div class="clearfix">' +
    '<div class="col-sm-3">' +
    '<img src="<?= base_url() ?>assets/images/user/' + repo.logo+ '" style="max-width: 100%" />' +
    '</div>' +
    '<div clas="col-sm-10">' +
    '<div class="clearfix">' +
    '<div class="col-sm-6"><strong>' + repo.text + '</strong></div>' +
    '</div>';
    markup += '</div></div>';

    return markup;
  }

  function formatRepoSelection (repo) {
    return repo.text || repo.text;
  }

  $(".js-data-example-ajax").select2({
      ajax: {
        url: "<?= base_url() ?>polis/get_polis",
        dataType: 'json',
        delay: 250,
        data: function (params) {
          return {
            q: params.term, // search term
            page: params.page
          };
        },
        processResults: function (data, page) {
          // parse the results into the format expected by Select2.
          // since we are using custom formatting functions we do not need to
          // alter the remote JSON data
          return {
            results: data
          };
        },
        cache: true
      },
      escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
      placeholder: {
      id: '0', // the value of the option
      text: 'Cari Polis'},
      minimumInputLength: 1,
      templateResult: formatRepo, // omitted for brevity, see the source of this page
  });   



  </script>

  <script type="text/javascript">
 function formatKoperasi (repo) {
    if (repo.loading) return repo.text;

    var markup = '<div class="clearfix">' +
    '<div class="col-sm-3">' +
    '<img src="<?= base_url() ?>assets/images/user/' + repo.logo+ '" style="max-width: 100%" />' +
    '</div>' +
    '<div clas="col-sm-10">' +
    '<div class="clearfix">' +
    '<div class="col-sm-6"><strong>' + repo.text + '</strong></div>' +
    '</div>';
    markup += '</div></div>';

    return markup;
  }

  function formatKoperasiSelection(repo) {
    return repo.text || repo.text;
  }

  $(".data-koperasi").select2({
      ajax: {
        url: "<?= base_url() ?>koperasi/get_koperasi",
        dataType: 'json',
        delay: 250,
        data: function (params) {
          return {
            q: params.term, // search term
            page: params.page
          };
        },
        processResults: function (data, page) {
          // parse the results into the format expected by Select2.
          // since we are using custom formatting functions we do not need to
          // alter the remote JSON data
          return {
            results: data
          };
        },
        cache: true
      },
      escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
      placeholder: {
      id: '99', // the value of the option
      text: 'Cari Koperasi'},
      minimumInputLength: 1,
      templateResult: formatKoperasi, // omitted for brevity, see the source of this page
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