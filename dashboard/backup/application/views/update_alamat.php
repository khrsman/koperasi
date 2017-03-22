<?php 
$this->load->view('template/head');
?>
<!--tambahkan custom css disini-->
<style>
#map-canvas {width:100%;height:400px;border:solid #999 1px;}
#kab_box,#kec_box,#kel_box,#lat_box,#lng_box{display:none;}
</style>
<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Edit Alamat
        <!-- <small>it all starts here</small> -->
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Edit Alamat</a></li>
        <li class="active">Edit Alamat</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Alamat</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <form method="post" action="<?= base_url() ?>update_alamat">
            <div class="box-body">
                <div class="form-group ">
                            <label for="Alamat">Alamat</label>
                            <div class="alamat">
                                <textarea name="alamat" class="form-control" placeholder="Detail Alamat"><?= $alamat['pengirim_alamat'] ?></textarea>
                            </div>
                </div>
                 <div class="form-group ">
                            <label for="Alamat">Provinsi</label>
                            <select id="prop" name="prop" class="form-control" onchange="ajaxkota(this.value)">
                                <option value="">Pilih Provinsi</option>
                                <?php
                                foreach($provinsi->result() as $data){ ?>
                                <option value="<?= $data->id_provinsi ?>" <?php if($alamat['pengirim_provinsi']== $data->id_provinsi){ echo "selected";} ?> ><?= $data->nama ?></option>
                                <?php } ?>
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
            </div><!-- /.box-body -->
            <div class="box-footer">
                 
            </div><!-- /.box-footer-->
        </form>
    </div><!-- /.box -->

</section><!-- /.content -->

<?php 
$this->load->view('template/js');
?>
<!--tambahkan custom js disini-->
    <script type="text/javascript" src="<?= base_url()?>assets/js/ajax_daerah.js"></script>
    <

<?php
$this->load->view('template/foot');
?>