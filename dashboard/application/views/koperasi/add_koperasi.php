<?php 
$this->load->view('template/head');
?>
<!--tambahkan custom css disini-->
<link href="<?= base_url() ?>assets/select2-4.0.2/dist/css/select2.min.css" rel="stylesheet" />
<link href="<?= base_url() ?>assets/AdminLTE-2.0.5//plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
<style type="text/css">
/*#kab_box,#kec_box,#kel_box,#lat_box,#lng_box{display:none;}*/
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
            <h3 class="box-title">Tambah Koperasi</h3>
        </div>

        <div class="box-body">
        <?= validation_errors() ?>
        <form action="" method="post" action="<?= base_url() ?>/add_koperasi" enctype="multipart/form-data">
            <form action="" method="post" action="<?= base_url() ?>/add_admin" enctype="multipart/form-data">
            <div class="col-md-3">
              <div class="form-group ">
                <label for="nama">Nama Koperasi</label>
                <input type="text" class="form-control" placeholder="Nama Koperasi" required=""  value="<?= set_value('nama') ?>" name="nama" />
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group ">
                <label for="Alamat">Alamat</label>
                <input type="text" class="form-control" placeholder="Alamat" required="" value="<?= set_value('alamat') ?>" name="alamat" />
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group ">
                <label for="email">Email</label>
                <input type="email" class="form-control" placeholder="E-mail" value="<?= set_value('email') ?>" required=""  name="email" />
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group ">
                <label for="NoHp">No Telepon</label>
                <input type="text" class="form-control" placeholder="No Telepon / HP" required="" value="<?= set_value('telepon') ?>" name="telepon" />
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group ">
                <label for="NoHp">Jenis Koperasi</label>
                <select name="jenis" class="form-control">
                    <?php foreach ($jenis_koperasi->result() as $row): ?>
                        <option value="<?= $row->id_jenis_koperasi ?>"><?= $row->deskripsi?></option>
                    <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="col-md-3">
               <div class="form-group">
                <label>Tanggal Berdiri</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" id="datemask" class="form-control" data-inputmask="'alias': 'hh/bb/tttt'" name="berdiri" value="<?= set_value('berdiri') ?>" data-mask/>
                </div><!-- /.input group -->
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group ">
                <label for="Legal">Legal</label>
                <input type="text" class="form-control" placeholder="Legal" value="<?= set_value('legal') ?>" name="legal" />
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group ">
                <label for="Ketua">Ketua Koperasi</label>
                <input type="text" class="form-control" placeholder="Ketua Koperasi" required="" value="<?= set_value('ketua') ?>" name="ketua" />
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group ">
                <label for="Ketua Telp">No Telepon Ketua Koperasi</label>
                <input type="text" class="form-control" placeholder="No Telepon Ketua Koperasi" required="" value="<?= set_value('ketua_telp') ?>" name="ketua_telp" />
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group ">
                <label for="username">Username</label>
                <input type="text" class="form-control" placeholder="Username" value="<?= set_value('username') ?>" required="" name="username" />
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
                <label for="password">Konfirmasi Password</label>
                <input type="password" class="form-control" placeholder="Konfirmasi Password" required="" name="confirm_password" />
              </div>
            </div>
                <?php if($this->session->userdata('level') == "1") {?>
            <div class="col-md-3">
                  <div class="form-group ">
                    <label for="Koperasi">Koperasi Cabang</label>
                    <select name="koperasi" class="data-koperasi form-control">
                      <option value="0" selected="selected">Induk</option>
                    </select>
                  </div>
            </div>
                <?php } ?>
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
              </div>
            </div>
            <div id="kab_box">
              <div class="col-md-3">
                <div class="form-group ">
                  <label for="Alamat">Kota / Kabupaten</label>
                  <select name="kota" id="kota" onchange="ajaxkec(this.value)" class="form-control">
                    <option value="">Pilih Kota/Kab</option>
                  </select>
              </div>
            </div>
          </div>
         
              <div id="kec_box">
               <div class="col-md-3">
                <div class="form-group ">
                  <label for="Alamat">Kecamatan / Desa</label>
                  <select name="kec" id="kec" onchange="ajaxkel(this.value)" class="form-control">
                    <option value="">Pilih Kecamatan</option>
                  </select>
                </div>
               </div>
              </div>

              <div id="kel_box">
                <div class="col-md-4">
                  <div class="form-group ">
                    <label for="Alamat">Kelurahan</label>
                    <select name="kel" id="kel" class="form-control">
                      <option value="">Pilih Kelurahan/Desa</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group ">
                    <label for="Alamat">Kode Pos</label>
                    <input type="text" name="kode_pos" id="kel" class="form-control" value="<?= set_value('kode_pos') ?>">
                  </div>
                </div>
              </div>
             <div class="col-md-4">
                <div class="form-group">
                <label for="polis">Polis</label>
                    <select class="form-control js-data-example-ajax" name="polis">
                    </select>
                </div>
            </div>
            <div class="col-md-12">
              <div class="form-group ">
                <label for="Keterangan">Keterangan</label>
                <textarea id="mytextarea" class="form-control" name="keterangan" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?= set_value('keterangan') ?></textarea>
              </div>
            </div>
              <button type="submit" class="btn btn-primary btn-block btn-flat">Tambah</button>
          
        </form>
    </div><!-- /.box -->

</section><!-- /.content -->

<?php 
$this->load->view('template/js');
?>
<!--tambahkan custom js disini-->
<script src="<?= base_url() ?>assets/select2-4.0.2/dist/js/select2.js"></script>

    <script src="<?= base_url() ?>assets/AdminLTE-2.0.5/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/AdminLTE-2.0.5/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/AdminLTE-2.0.5/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
     <script src="<?= base_url() ?>assets/AdminLTE-2.0.5/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?= base_url()?>assets/js/ajax_daerah.js"></script>


<script type="text/javascript">
      $(function () {
        //Datemask dd/mm/yyyy
        $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "hh/bb/tttt"});
        $("#mytextarea").wysihtml5();
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
      id: '-1', // the value of the option
      text: 'Cari Koperasi'},
      minimumInputLength: 1,
      templateResult: formatKoperasi, // omitted for brevity, see the source of this page
  });   



  </script>

<?php
$this->load->view('template/foot');
?>