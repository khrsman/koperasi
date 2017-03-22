<?php 
   $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
   $actual_link = urlencode($actual_link);
   ?>

   <style type="text/css">
   .list-group {
    margin-bottom: 3px;
    }
#kab_box,#kec_box,#kel_box,#lat_box,#lng_box{display:none;}
  input{
    color:black;
    font-weight: bold;

  }
</style>
<div class="clearfix"></div>
<div class=" bumper_image">
   <center>
      <img src="<?php echo base_url('assets/compro/landing_page/bumper1.jpg');?>" class="img-responsive" style="">
   </center>
</div>
<div class="clearfix"></div>
<div class="main_about_us" style="padding: 10px 0;border-bottom:1px solid #D4D4D4;background: #064862;color: white;font-size: 18px;">
   <div class="container">
      <div class="row">
         <div class="col-md-12 col-xs-12">
            <div class="text-center">
               <marquee>
                  <b>Welcome to our offical website. We gives people better ways to connect to their money and to each other.</b>
               </marquee>
            </div>
         </div>
      </div>
   </div>
</div>
<link href="<?= base_url() ?>dashboard/assets/select2-4.0.2/dist/css/select2.min.css" rel="stylesheet" />

<div class="clear-both"></div>


<?php 
  $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  $actual_link = urlencode($actual_link);
?>


<section class="gray-wrapper " style="background:#F8F8F8;">
   <div class="container">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
         <div class="general-title">
            <h2>REGISTRASI ANGGOTA</h2>
            <hr>
         </div>
      </div>
      <div class="clearfix"></div>
      <BR><BR><BR>
      <div class="col-md-12 col-xs-12" >
        <?php
           if($this->session->flashdata('msg') != NULL){
           echo '<div class="alert alert-info" role="alert" style="padding: 6px 12px;height:34px;">';
           echo "<i class='fa fa-info-circle'></i> <strong><span style='margin-left:10px;'>".$this->session->flashdata('msg')."</span></strong>";
           echo '</div>';
           }?>
        <?= validation_errors() ?>
      </div>
      <form role="form" action="" method="post" class="login-form" action="<?= base_url() ?>registrasi" >
      <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <div class="widget">
            <h3 class="box-title">Data Utama</h3>
             <div class="form-group col-md-4">
                     <label for="form-username">Nama Depan</label>
                     <input type="text" name="nama_depan" placeholder="Nama Depan" value="<?= set_value('nama_depan') ?>" required class="form-control">
                  </div>
                  <div class="form-group col-md-4">
                     <label for="form-username">Nama Belakang</label>
                     <input type="text" name="nama_belakang" placeholder="Nama Belakang" value="<?= set_value('nama_belakang') ?>"  class="form-control">
                  </div>
                  <div class="form-group col-md-4">
                     <label for="form-username">Tanggal Lahir</label>
                     <input type="text" name="tgl_lahir" placeholder="Tanggal Lahir" value="<?= set_value('tgl_lahir') ?>"  id="datemask" class="form-control" data-inputmask="'alias': 'hh-bb-tttt'" data-mask>
                  </div>
                  <div class="form-group  col-md-4">
                     <label for="form-username">Username</label>
                     <input type="text" name="username"  value="<?= set_value('username') ?>" placeholder="Username" class="form-control" required id="form-username">
                  </div>
                  <div class="form-group col-md-4">
                     <label for="form-password">Password</label>
                     <input type="password"  value="<?= set_value('password') ?>" name="password" placeholder="Password" class="form-control" required id="form-password">
                  </div>
                  <div class="form-group col-md-4">
                     <label for="form-password">Konfirmasi Password</label>
                     <input type="password"  value="<?= set_value('confirm_password') ?>" name="confirm_password" placeholder="Konifirmasi Password" class="form-control" required id="form-confrim-password">
                  </div>
                  <div class="form-group col-md-4">
                     <label for="form-username">E mail</label>
                     <input type="text" name="email" required  value="<?= set_value('email') ?>" placeholder="Email" class="form-control">
                  </div>
                  <div class="form-group col-md-6">
                     <label for="form-username">No Telepon</label>
                     <input type="text" name="telp"  placeholder="No Telepon" class="form-control" value="<?= set_value('telp') ?>" >
                  </div>
                  <div class="form-group col-md-6">
                     <label for="form-username">Jabatan</label>
                     <input type="text" name="jabatan"  placeholder="Jabatan" class="form-control" value="<?= set_value('jabatan') ?>" >
                  </div>


                  <div class="form-group  col-md-6">
                     <label for="form-username">Jenis Kelamin</label>
                     <div class="form-inline" style="margin: 5px;">
                        <div class="radio">
                           <label>
                           <input type="radio" name="jkel" value="L" <?= set_radio('jkel', 'L', TRUE); ?>>
                           Laki - laki
                           </label>
                        </div>
                        <div class="radio">
                           <label>
                           <input type="radio" name="jkel" value="P" <?= set_radio('jkel', 'P') ?> >
                           Perempuan
                           </label>
                        </div>
                     </div>
                  </div>
                  <div class="form-group col-md-6">
                     <label for="form-username">Instansi / Organisasi</label>
                     <select name="instansi" class="js-data-example-ajax form-control">
                     </select>
                  </div>
                  <div class="clear-both"></div>
                  <div class="form-group col-md-12">
                    <label for="Alamat">Alamat</label>
                    <textarea class="form-control" name="alamat" placeholder="Detail Alamat"><?= set_value('alamat')?></textarea>
                  </div>
                  <div class="form-group col-md-6">
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
                  <div class="form-group col-md-6">
                    <div id="kab_box">
                      <label for="Alamat">Kota / Kabupaten</label>
                      <select name="kota" id="kota" onchange="ajaxkec(this.value)" class="form-control">
                        <option value="">Pilih Kota/Kab</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group col-md-6">
                    <div id="kec_box">
                      <label for="Alamat">Kecamatan / Desa</label>
                      <select name="kec" id="kec" onchange="ajaxkel(this.value)" class="form-control">
                        <option value="">Pilih Kecamatan</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group col-md-6">
                    <div id="kel_box">
                      <label for="Alamat">Kelurahan</label>
                      <select name="kel" id="kel" class="form-control">
                        <option value="">Pilih Kelurahan/Desa</option>
                      </select>
                    </div>
                  </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
         <div class="widget">
            <h3 class="box-title">Data Tambahan</h3>
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
      </div>
      <div class="clearfix"></div>
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <button type="submit" class="btn btn-success btn-block">Daftar</button>
      </div>

      </form>






      <!-- end col-lg-6 -->
   </div>
   <!-- end container -->
   <br><br><br><br><br><br><br><br>
</section>


<script type="text/javascript">
  // get your select element and listen for a change event on it
  $('.select-redirect').change(function() {
    // set the window's location property to the value of the option the user has selected
    document.location = $(this).val();
  });
</script>





<div class="clear-both"></div>
















<script type="text/javascript" src="<?= base_url()?>dashboard/assets/js/ajax_daerah.js"></script>
<script src="<?= base_url() ?>dashboard/assets/select2-4.0.2/dist/js/select2.js"></script>



<script src="<?= base_url() ?>dashboard/assets/AdminLTE-2.0.5/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
<script src="<?= base_url() ?>dashboard/assets/AdminLTE-2.0.5/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
<script src="<?= base_url() ?>dashboard/assets/AdminLTE-2.0.5/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
<script type="text/javascript">
$(function () {
//Datemask dd/mm/yyyy
$("#datemask").inputmask("dd-mm-yyyy", {"placeholder": "hh-bb-tttt"});
});
</script>
<script type="text/javascript">
// get your select element and listen for a change event on it
    $('.select-redirect').change(function() {
// set the window's location property to the value of the option the user has selected
      document.location = $(this).val();
  });
  $(".js-data-example-ajax").select2({
    ajax: {
    url: "<?= base_url() ?>auth/get_instansi",
    dataType: 'json',
    delay: 250,
    data: function (params) {
    return {
    q: params.term // search term
    };
    },
    processResults: function (data) {
    return {
    results: data
    };
    },
    cache: true
    },
    minimumInputLength: 2,

    placeholder: {
    id: '0', // the value of the option
    text: 'Masukan Nama Instansi'}
    });
</script>
