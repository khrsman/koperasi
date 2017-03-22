<?php 
$this->load->view('template/head');
?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/style.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/bootstrap-select.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/ajax-bootstrap-select.css"/>
<style>
.bootstrap-select {
    width: 100% !important;
}
</style>
<!--tambahkan custom css disini-->
<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Pembuatan Rekening Pinjaman
        <small>Pembuatan Rekening Pinjaman</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"><?php echo $title;?></a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <form role="form" id="form_pinjaman">
        <div class="row">
            <div class="col-md-9">
                <?php if($this->session->flashdata('rekening_pinjaman_stat')) { $rek_temp = $this->session->flashdata('rekening_pinjaman_stat'); ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Pembuatan Rekening Pinjaman Berhasil!</h4>
                    Pembuatan rekening pinjaman baru telah dibuat dengan nomor rekening <?php echo $rek_temp['no_rekening_pinjaman'] ?> dengan jumlah pinjaman sebesar Rp. <?php echo number_format($rek_temp['jumlah_pinjaman'], 2, ".", ",") ?>. Klik <a href="<?php echo base_url() ?>rekening_pinjaman">disini</a> untuk melihat rekening pinjaman lainnya.
                </div>
                <?php } ?>
                <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Formulir isian pembuatan rekening pinjaman</h3>
                    </div>
                    <div class="box-body form-input-data">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-lg-12">
                                <div class="form-group">
                                    <label for="nasabah_id">Pilih Calon Nasabah</label>
                                    <select id="nasabah_id" class="selectpicker with-ajax search-select" name="nasabah_id" data-live-search="true"></select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-7 col-lg-7">
                                <div class="form-group">
                                    <label for="jumlah_pinjaman">Nominal Jumlah Pinjaman</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">Rp</span>
                                        <input type="text" name="jumlah_pinjaman" class="form-control" id="jumlah_pinjaman">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-5 col-lg-5">
                                <div class="form-group">
                                    <label for="tanggal_pencairan">Tanggal Pencairan Pinjaman</label>
                                    <input type="date" name="tanggal_pencairan" class="form-control" id="tanggal_pencairan" value="<?php echo date('Y-m-d'); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-3 col-lg-3">
                                <div class="form-group">
                                    <label for="jumlah_angsuran">Jumlah Angsuran</label>
                                    <input type="number" name="jumlah_angsuran" class="form-control" id="jumlah_angsuran">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-3 col-lg-3">
                                <div class="form-group">
                                    <label for="tanggal_tagihan">Tanggal Tagihan</label>
                                    <input type="number" name="tanggal_tagihan" class="form-control" id="tanggal_tagihan">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-6">
                                <div class="form-group">
                                    <label for="tanggal_jatuh_tempo">Tanggal Jatuh Tempo</label>
                                    <input type="date" name="tanggal_jatuh_tempo" class="form-control" id="tanggal_jatuh_tempo" value="<?php echo date('Y-m-d'); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-4 col-lg-4">
                                <div class="form-group">
                                    <label for="periode_jumlah">Periode Jumlah</label>
                                    <input type="number" name="periode_jumlah" class="form-control" id="periode_jumlah">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4 col-lg-4">
                                <div class="form-group">
                                    <label for="periode_waktu">Periode Waktu</label>
                                    <select name="periode_waktu" id="periode_waktu" class="form-control">
                                        <option value="HARI">HARI</option>
                                        <option value="TAHUN">TAHUN</option>
                                        <option value="BULAN">BULAN</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4 col-lg-4">
                                <div class="form-group">
                                    <label for="grace_period">Lama Penangguhan Pembayaran</label>
                                    <input type="number" name="grace_period" class="form-control" id="grace_period">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-lg-6">
                                <div class="form-group">
                                    <label for="margin_rupiah">Margin Rupiah</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">Rp</span>
                                        <input type="text" name="margin_rupiah" class="form-control" id="margin_rupiah">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-6">
                                <div class="form-group">
                                    <label for="margin_persen">Margin Persen</label>
                                    <div class="input-group">
                                        <input type="text" name="margin_persen" class="form-control" id="margin_persen">
                                        <span class="input-group-addon">%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-lg-4">
                                <div class="form-group">
                                    <label for="potongan_notaris">Potongan Notaris</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">Rp</span>
                                        <input type="text" name="potongan_notaris" class="form-control" id="potongan_notaris">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-4">
                                <div class="form-group">
                                    <label for="potongan_premi">Potongan Premi</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">Rp</span>
                                        <input type="text" name="potongan_premi" class="form-control" id="potongan_premi">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-4">
                                <div class="form-group">
                                    <label for="potongan_tab_wajib">Potongan Tabungan Wajib </label>
                                    <div class="input-group">
                                        <span class="input-group-addon">Rp</span>
                                        <input type="text" name="potongan_tab_wajib" class="form-control" id="potongan_tab_wajib">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-4">
                                <div class="form-group">
                                    <label for="potongan_materai">Potongan Materai </label>
                                    <div class="input-group">
                                        <span class="input-group-addon">Rp</span>
                                        <input type="text" name="potongan_materai" class="form-control" id="potongan_materai">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-4">
                                <div class="form-group">
                                    <label for="potongan_cr">Potongan CR </label>
                                    <div class="input-group">
                                        <span class="input-group-addon">Rp</span>
                                        <input type="text" name="potongan_cr" class="form-control" id="potongan_cr">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-4">
                                <div class="form-group">
                                    <label for="potongan_adm">Potongan Administrasi </label>
                                    <div class="input-group">
                                        <span class="input-group-addon">Rp</span>
                                        <input type="text" name="potongan_adm" class="form-control" id="potongan_adm">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Konfirmasi Transaksi</h3>
                    </div>
                    <div class="box-body form-input-data">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-lg-12">
                                Pastikan pengisian pembuatan rekening pinjaman nasabah sudah sesuai
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary full-width">Lakukan Transaksi</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section><!-- /.content -->
<?php 
$this->load->view('template/js');
?>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/inputmask/inputmask.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/inputmask/inputmask.numeric.extensions.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/inputmask/jquery.inputmask.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/ajax-bootstrap-select.js"></script>
<script>
    var options = {
        ajax          : {
            url     : '<?php echo base_url() ?>rekening/cari_anggota',
            type    : 'POST',
            dataType: 'json',
            // Use "{{{q}}}" as a placeholder and Ajax Bootstrap Select will
            // automatically replace it with the value of the search query.
            data    : {
                keyword: '{{{q}}}'
            }
        },
        locale        : {
            currentlySelected: 'Saat ini dipilih',
            emptyTitle: 'Masukan Nama atau ID Anggota',
            errorText: 'Maaf, terjadi gangguan saat menerima data. Silahkan ulangi',
            searchPlaceholder: 'Ketikan Nama, ID, atau Username Anggota...',
            statusInitialized: 'Lakukan pencarian anggota',
            statusNoResults: 'Pencarian tidak ditemukan',
            statusSearching: 'Mencari...'
        },
        log           : 3,
        preprocessData: function (data) {
            var i, l = data.data.length, array = [];
            if (l) {
                for (i = 0; i < l; i++) {
                    array.push($.extend(true, data.data[i], {
                        text : data.data[i].fullname + ' (' + data.data[i].username + ')',
                        value: data.data[i].id_user,
                        data : {
                            subtext: data.data[i].id_user
                        }
                    }));
                }
            }
            // You must always return a valid array when processing data. The
            // data argument passed is a clone and cannot be modified directly.
            return array;
        }
    };

    $('.selectpicker').selectpicker().filter('.with-ajax').ajaxSelectPicker(options);
    $('select').trigger('change');
</script>
<!--tambahkan custom js disini-->
<script type="text/javascript">
$(document).ready(function(){
    $("#jumlah_pinjaman, #margin_rupiah, #potongan_adm, #potongan_cr, #potongan_materai, #potongan_premi, #potongan_notaris, #potongan_tab_wajib").inputmask({ 
        alias: "numeric",
        radixPoint: '.', 
        placeholder: "0", 
        autoGroup: !0, 
        digits: 0, 
        groupSeparator: ',', 
        groupSize: 3, 
        repeat: 10, 
        clearMaskOnLostFocus: !1 
    });
    $("#margin_persen").inputmask("decimal",{
        radixPoint:".",
        digits: 2,
        autoGroup: true,
        placeholder: "0", 
        max: 100,
        min: 0
    });
    $("#form_pinjaman").bind('submit', function(e){
        var $this = $(this);
        var json_data = $this.serializeObject();
        $.ajax({
            url: '<?php echo base_url() ?>rekening/ajax_register_pinjaman',
            data: json_data,
            dataType: 'JSON',
            type: 'POST',
            success: function(data){
                if(data.errorcode == 1){
                    $.each(data.msg.form_error, function(key,val){
                        $("label[for='"+key+"'").parents('.form-group').append('<span class="input-error">'+val+'</span>');
                    });
                    $this.find('button[type=submit]').html('Lakukan Transaksi');
                } else {
                    $this.find('button[type=submit]').html('Mohon Tunggu...');
                    window.location.href = '<?php echo base_url() ?>buat_rekening_pinjaman/success';
                }
            },
            beforeSend: function(data){
                $('.input-error').remove();
                $this.find('button[type=submit]').html('Memproses Transaksi...');
            }
        });

        return false;
    })
});
$.fn.serializeObject = function()
{
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};
</script>
<?php
$this->load->view('template/foot');
?>