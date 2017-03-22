<?php
$this->load->view('template/head');
?>
<!--tambahkan custom css disini-->
<style>
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
  Tambah Polis
  <!-- <small>it all starts here</small> -->
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Tambah Polis</a></li>
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
    </ul>
    <div class="tab-content">
      <div class="tab-pane active" id="basic_profile">
        <form id="formBasic" method="post" action="<?= base_url() ?>add_polis"  enctype="multipart/form-data">
          <div class="form-group ">
            <label for="nama_depan">Nama Polis</label>
            <input type="text" class="form-control" placeholder="Nama Polis" minlength="2" required="" name="nama_polis" />
          </div>
          <div class="form-group ">
                <label for="foto">Upload Logo Polis</label>
                <input id="imgProfile" type="file" class="form-control" name="photo" accept="image/*" />
            </div>
            <div class="text-center">
              <img id="imageProfile" class="img-responsive" style="width: 200px; height: auto; margin: 10px auto;">
            </div>
          <button type="submit" class="btn btn-primary btn-block btn-flat">Tambah Polis</button>
          
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
    <!-- /.tab-content -->
  </div>
</section>
<!-- /.content -->
<div class="clear-both"></div>
<?php
$this->load->view('template/js');
?>

<!--tambahkan custom js disini-->

<script type="text/javascript">
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