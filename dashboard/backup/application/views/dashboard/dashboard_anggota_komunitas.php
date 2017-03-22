<?php if($this->session->userdata('status_komunitas') == "N"){?>
        <div class="alert alert-warning">
            <h4><i class="icon fa fa-warning"></i> Perhatian !</h4>
            Anda belum memilih komunitas, silakan pilih komunitas anda di menu <strong><a href="<?= base_url() ?>profile">Profil</a></strong>
        </div>
<? } ?>
<?php if ($this->session->userdata('status_komunitas') == "0"){ ?>
        <div class="alert alert-danger">
            <h4><i class="icon fa fa-ban"></i> Perhatian !</h4>
            Komunitas anda dalam status <strong>Tidak Aktif</strong> Silakan hubungi komunitas anda.
        </div>
<?php } ?>