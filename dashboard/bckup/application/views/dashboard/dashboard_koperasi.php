<?php if(($this->session->userdata('status_koperasi') == "N")){?>
        <div class="alert alert-warning">
            <h4><i class="icon fa fa-warning"></i> Perhatian !</h4>
            Anda belum memilih koperasi, silakan pilih koperasi anda di menu <strong><a href="<?= base_url() ?>profile">Profil</a></strong>
        </div>
<?php } ?>
<?php if ($this->session->userdata('status_koperasi') == "0") { ?>
        <div class="alert alert-danger">
            <h4><i class="icon fa fa-ban"></i> Perhatian !</h4>
            Koperasi induk anda dalam status <strong>Tidak Aktif</strong> Silakan hubungi koperasi anda.
        </div>
<?php } ?>


<div class="row">
    <div class="col-md-4 col-xs-6">
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3><?= $produk ?></h3>
                <p>Produk</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="<?= base_url() ?>mykopproduk" class="small-box-footer">Lihat Data <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div><!-- ./col -->
    <div class="col-md-4 col-xs-6">
        <div class="small-box bg-green">
            <div class="inner">
                <h3><?= $koperasi ?></h3>
                <p>Cabang Koperasi</p>
            </div>
            <div class="icon">
                <i class="ion ion-ios-world-outline"></i>
            </div>
            <a href="<?= base_url() ?>cabang_koperasi" class="small-box-footer">Lihat Data <i class="fa fa-arrow-circle-right"></i></a>

        </div>
    </div><!-- ./col -->
    <div class="col-md-4 col-xs-6">
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3><?= $anggota ?></h3>
                <p>Anggota</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="<?= base_url() ?>anggota" class="small-box-footer">Lihat Data <i class="fa fa-arrow-circle-right"></i></a>

        </div>
    </div><!-- ./col -->
</div>

<div class="row">
    <div class="col-md-8">
        <!-- USERS LIST -->
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Anggota Yang Terakhir Login</h3>
                <div class="box-tools pull-right">
                    <!-- <span class="label label-danger">8 New Members</span> -->
                    <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button> -->
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
                <ul class="users-list clearfix">
                    <?php foreach ($last_login_user as $row) { ?>
                    <li>
                        <img src="<?php
                        if($row->foto == NULL){
                        echo base_url()."assets/images/user/default.jpg";
                        }
                        else {
                        echo base_url()."assets/images/user/".$row->foto;
                        }
                        ?>" class="image-last-login" alt="User Image"/>
                        <a class="users-list-name" href="#"><?= $row->nama_lengkap ?></a>
                        <span class="users-list-date"> <?php
                            $date = new DateTime($row->last_login);
                            echo $date->format('d M y, H:i:s');
                        ?></span>
                    </li>
                    <?php } ?>
                </ul>
                <!-- /.users-list -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
                <!-- <a href="javascript::" class="uppercase">View All Users</a> -->
            </div>
            <!-- /.box-footer -->
        </div>
        <!--/.box -->
    </div>
</div>