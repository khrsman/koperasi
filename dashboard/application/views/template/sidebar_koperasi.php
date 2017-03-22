<style type="text/css">
    a{
        color: black;
        font-weight: bold;
    }


</style>

<li class="treeview" style="color:black;">
    <a href="#">
        <img src="<?php echo base_url('assets/compro/dashboard').'/home.png'; ?>" class="img-responsives" width="200px" style="margin:0 22px 0 0" >
        <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
    		<li ><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i>Beranda</a></li>
           <li ><a href="<?php echo site_url('about'); ?>"><i class="fa fa-home"></i> Tentang Kami</a></li>
            <li><a href="<?php echo site_url('agenda'); ?>"><i class="fa fa-home"></i> Agenda Organisasi</a></li>
            <li><a href="<?php echo site_url('news'); ?>"><i class="fa fa-home"></i> Berita / Acara</a></li>
            <li><a href="<?php echo site_url('contact'); ?>"><i class="fa fa-home"></i> Kontak</a></li>
            <li><a href="<?php echo site_url('partners'); ?>"><i class="fa fa-home"></i> Partners</a></li>
            <li><a href="<?php echo site_url('faq'); ?>"><i class="fa fa-home"></i> FAQ SMI</a></li>
            <li><a href="<?php echo site_url('services'); ?>"><i class="fa fa-home"></i> Products & Services</a></li>
    </ul>
</li>

<?php
    $beranda = '';
    $menu = '';

if($this->uri->segment(1) == 'home' OR $this->uri->segment(1) == 'about' OR $this->uri->segment(1) == 'agenda' OR $this->uri->segment(1) == 'news' OR $this->uri->segment(1) == 'contact' OR $this->uri->segment(1) == 'partners'  OR $this->uri->segment(1) == 'faq' OR $this->uri->segment(1) == 'services'){

    $beranda = 'active';
    $menu = 'menu-open';
}
?>



<?php if(($this->session->userdata('status_koperasi') != "0") AND ($this->session->userdata('status_koperasi') != "N")) {?>

<li class="treeview" style="color:black;">
    <a href="#">
        <img src="<?php echo base_url('assets/compro/dashboard').'/reg.png'; ?>" class="img-responsives" width="200px" style="margin:0 22px 0 0" >
        <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li>
        <li><a href="<?= base_url()."add_anggota" ?>"><i class="fa fa-user"></i> Registrasi Anggota</a></li>
        <li><a href="<?= base_url()."cabang_koperasi" ?>"><i class="fa fa-user"></i> Data Cabang Koperasi</a></li>
        <li><a href="<?= base_url()."anggota" ?>"><i class="fa fa-user"></i> Data Anggota Koperasi</a></li>
	    <li><a href="<?= base_url()."shu_koperasi" ?>"><i class="fa fa-user"></i> Data SHU Koperasi</a></li>

        </li>
    </ul>
</li>


<!-- <li class="header" style="background:#f57722;color:white;"><b>ECOMMERCE</b></li> -->

<script type="text/javascript">

function get_gerai(){
    window.location.href = "<?= base_url().'gerai' ?>";
}

</script>


<?php
    $gerai = '';
    $gerai_menu = '';

if($this->uri->segment(1) == 'gerai' ){

    $gerai = 'active';
    $gerai_menu = 'menu-open';
}
?>

<li class="treeview" style="color:black;">
    <a href="#">
        <img src="<?php echo base_url('assets/compro/dashboard').'/serba.png'; ?>" class="img-responsives" width="200px" style="margin:0 22px 0 0" >
        <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
		    <li><a href="<?php echo base_url('gerai'); ?>"><i class="fa fa-qrcode"></i> Lihat Semua</a></li>
		  	<li><a href="<?php echo site_url('gerai/pulsa'); ?>"><i class="fa fa-qrcode"></i> Pulsa</a></li>
            <li><a href="<?php echo site_url('store'); ?>"><i class="fa fa-qrcode"></i> Belanja Online</a></li>

            <li><a href="#"><i class="fa fa-qrcode"></i> Wesel Instan</a></li>
            <li><a href="<?php echo site_url('gerai/pembayaran'); ?>"><i class="fa fa-qrcode"></i> Jasa Pembayaran</a></li>

            <li><a href="<?php echo site_url('gerai/reservasi'); ?>"><i class="fa fa-qrcode"></i> Reservasi</a></li>
            <li><a href="#"><i class="fa fa-qrcode"></i> Pinjaman</a></li>

            <li><a href="#"><i class="fa fa-qrcode"></i> Pegadaian</a></li>
            <li><a href="https://www.google.co.id/webhp?sourceid=chrome-instant&ion=1&espv=2&ie=UTF-8#q=currency%20rupiah"><i class="fa fa-qrcode"></i> Penukaran Uang</a></li>
            <li><a href="#"><i class="fa fa-qrcode"></i> Asuransi & Investasi</a></li>
            <li><a href="#"><i class="fa fa-qrcode"></i> Emas</a></li>
            <li><a href="#"><i class="fa fa-qrcode"></i> Infaq Zakat</a></li>
            <li><a href="<?php echo site_url('gerai/trading'); ?>"><i class="fa fa-qrcode"></i> Trading</a></li>
    </ul>
</li>

<li class="treeview" style="color:black;">
    <a href="#">
        <img src="<?php echo base_url('assets/compro/dashboard').'/mini.png'; ?>" class="img-responsives" width="200px" style="margin:0 22px 0 0" >
        <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li><a href="<?= base_url() ?>rekening"><i class="fa fa-user"></i> List Rekening Anggota</a></li>
<li><a href="<?= base_url() ?>buka_rekening"><i class="fa fa-user"></i> Buka Rekening Anggota</a></li>
<li><a href="<?= base_url() ?>cek_saldo"><i class="fa fa-user"></i> Cek Saldo Anggota</a></li>
<li class="treeview">
    <a href="#">
        <i class="fa fa-send"></i> <span>Transfer Saldo</span>
        <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li><a href="<?= base_url()."transfer_saldo" ?>"><i class="fa fa-send"></i> Transfer Saldo</a></li>
        <li><a href="<?= base_url()."transfer_saldo/tabungan_virtual" ?>"><i class="fa fa-send"></i> Transfer Tabungan ke Virtual</a></li>
        <li><a href="<?= base_url()."transfer_saldo/virtual_tabungan" ?>"><i class="fa fa-send"></i> Transfer Virtual ke Tabungan</a></li>
    </ul>
</li>
<li><a href="<?= base_url() ?>setor_tunai"><i class="fa fa-user"></i> Setor Tunai</a></li>
<li><a href="<?= base_url() ?>tarik_tunai"><i class="fa fa-user"></i> Penarikan Tunai</a></li>
<li><a href="<?= base_url() ?>ubah_status_rekening"><i class="fa fa-user"></i> Ubah Status Rekening</a></li>

<li><a href="<?= base_url() ?>profit_sharing"><i class="fa fa-user"></i> Kelola Bagi Hasil</a></li>
<li><a href="<?= base_url() ?>profit_share_koperasi_cabang"><i class="fa fa-user"></i> Share Cabang</a></li>
<li><a href="<?= base_url() ?>rekening_non_member"><i class="fa fa-user"></i> Rekening Non Member</a></li>
<?php if($this->session->userdata('parent_koperasi') == "0"){ ?>
<li>
    <a href="<?= base_url() ?>share_profit_koperasi"><i class="fa fa-share"></i> <span>Share Profit Koperasi Induk</span></a>
</li>
<li>
    <a href="<?= base_url() ?>share_profit"><i class="fa fa-share"></i> <span>Share Profit Koperasi Cabang</span></a>
</li>
<?php } else { ?>
<li>
    <a href="<?= base_url() ?>share_profit_koperasi"><i class="fa fa-share"></i> <span>Share Profit Koperasi</span></a>
</li>
<?php } ?>
<li class="treeview">
    <a href="#">
        <i class="fa fa-send"></i> <span>Deposito</span>
        <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li><a href="<?= base_url()."rekening_deposito" ?>"><i class="fa fa-send"></i> List Rekening Deposito</a></li>
        <li><a href="<?= base_url()."buat_rekening_deposito" ?>"><i class="fa fa-send"></i> Buat Rekening Deposito</a></li>
    </ul>
</li>
<li class="treeview">
    <a href="#">
        <i class="fa fa-send"></i> <span>Pinjaman</span>
        <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li><a href="<?= base_url()."rekening_pinjaman" ?>"><i class="fa fa-send"></i> List Rekening Pinjaman</a></li>
        <li><a href="<?= base_url()."buat_rekening_pinjaman" ?>"><i class="fa fa-send"></i> Buat Rekening Pinjaman</a></li>
        <li><a href="<?= base_url()."bayar_angsuran" ?>"><i class="fa fa-send"></i> Pembayaran Angsuran</a></li>
    </ul>
</li>

        <li class="treeview">
            <a href="#">
                <i class="fa fa-send"></i> <span>Kredit Cicilan</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?= base_url()."rekening_kredit_cicilan" ?>"><i class="fa fa-send"></i> List Rekening Kredit Cicilan</a></li>
                <li><a href="<?= base_url()."buat_rekening_kredit_cicilan" ?>"><i class="fa fa-send"></i> Buat Rekening Kredit Cicilan</a></li>
                <li><a href="<?= base_url()."bayar_angsuran_kredit_cicilan" ?>"><i class="fa fa-send"></i> Pembayaran Angsuran Kredit Cicilan</a></li>
            </ul>
        </li>
    </ul>
</li>


<li class="treeview" style="color:black;">
    <a href="#">
        <img src="<?php echo base_url('assets/compro/dashboard').'/ecommerce.png'; ?>" class="img-responsives" width="200px" style="margin:0 22px 0 0" >
        <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
                <li><a href="<?= base_url()."store_order" ?>"><i class="fa fa-gift"></i> Pesanan Masuk</a></li>
                <li><a href="<?= base_url()."mykopproduk" ?>"><i class="fa fa-gift"></i> Data Produk Koperasi</a></li>
    </ul>
</li>


<li class="treeview" style="color:black;">
    <a href="#">
        <img src="<?php echo base_url('assets/compro/dashboard').'/konten.png'; ?>" class="img-responsives" width="200px" style="margin:0 22px 0 0" >
        <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li><a href="<?= base_url() ?>berita/admin"><i class="fa fa-newspaper-o"></i> Berita Admin</a></li>
        <li><a href="<?= base_url() ?>berita/koperasi"><i class="fa fa-newspaper-o"></i> Berita Koperasi</a></li>
        <li><a href="<?= base_url() ?>event/koperasi"><i class="fa fa-calendar-plus-o"></i> <span>Event Koperasi</span></a></li>
        <li><a href="<?= base_url() ?>agenda/koperasi"><i class="fa fa-calendar-plus-o"></i> <span>Agenda Koperasi</span></a></li>
    </ul>
</li>

<li class="treeview" style="color:black;">
    <a href="#">
        <img src="<?php echo base_url('assets/compro/dashboard').'/laporan.png'; ?>" class="img-responsives" width="200px" style="margin:0 22px 0 0" >
        <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
            <li>
                <a href="<?= base_url() ?>log"><i class="fa fa-file"></i><span> Laporan transaksi anggota</span></a>
            </li>
            <li>
                <a href="<?= base_url() ?>transaksi/commerce"><i class="fa fa-file"></i> <span>Laporan Transaksi Commerce</span></a>
            </li>
            <li>
                <a href="<?= base_url() ?>transaksi/gerai"><i class="fa fa-file"></i> <span>Laporan Transaksi Gerai</span></a>
            </li>


        <li><a href="<?= base_url() ?>chart/anggota"><i class="fa fa-bar-chart"></i> Chart Anggota Koperasi</a></li>
    </ul>
</li>


<?php } ?>
