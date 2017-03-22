<li class="header" style="background:#a2a2a2;color:black;"><b>HOME NAVIGATION</b></li>

<!-- <li>
    <a href="<?= base_url()."home" ?>">
    <i class="fa fa-dashboard"></i> <span>Beranda</span>
    </a>

</li>
 -->

<script type="text/javascript">
    
function get_home(){
    window.location.href = "<?= base_url().'home' ?>";
}

</script>


<?php 
    $beranda = '';
    $menu = '';

if($this->uri->segment(1) == 'home' OR $this->uri->segment(1) == 'about' OR $this->uri->segment(1) == 'agenda' OR $this->uri->segment(1) == 'news' OR $this->uri->segment(1) == 'contact' OR $this->uri->segment(1) == 'partners'  OR $this->uri->segment(1) == 'faq' OR $this->uri->segment(1) == 'services'){

    $beranda = 'active';
    $menu = 'menu-open';
}
?>

<li class="treeview <?php echo $beranda;?>">
       <a href="<?= base_url()."home" ?>" onclick="get_home()">
        <i class="fa fa-dashboard"></i> <span>Beranda</span>
        <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu  <?php echo $menu;?> ">
            <li><a href="<?php echo site_url('about'); ?>"><i class="fa fa-home"></i> Tentang Kami</a></li>
            <li><a href="<?php echo site_url('agenda'); ?>"><i class="fa fa-home"></i> Agenda Organisasi</a></li>

            <li><a href="<?php echo site_url('news'); ?>"><i class="fa fa-home"></i> Berita / Acara</a></li>
            <li><a href="<?php echo site_url('contact'); ?>"><i class="fa fa-home"></i> Kontak</a></li>

            <li><a href="<?php echo site_url('partners'); ?>"><i class="fa fa-home"></i> Partners</a></li>
            <li><a href="<?php echo site_url('faq'); ?>"><i class="fa fa-home"></i> FAQ SMI</a></li>

            <li><a href="<?php echo site_url('services'); ?>"><i class="fa fa-home"></i> Products & Services</a></li>
        </ul>
</li>


<?php if(($this->session->userdata('status_koperasi') != "0") AND ($this->session->userdata('status_koperasi') != "N")) {?>

<li class="header" style="background:red;color:white;"><b>REGISTRASI ANGGOTA</b></li>
<li><a href="<?= base_url()."add_anggota" ?>"><i class="fa fa-user"></i> Registrasi Anggota Koperasi</a></li>
<li class="treeview">
    <a href="#">
    <i class="fa fa-users"></i> <span>Registrasi Anggota</span>
    <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li><a href="<?= base_url()."cabang_koperasi" ?>"><i class="fa fa-user"></i> Data Cabang Koperasi</a></li>
        <li><a href="<?= base_url()."anggota" ?>"><i class="fa fa-user"></i> Data Anggota Koperasi</a></li>
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


<li class="header" style="background:#03a9a2;color:white;"><b>GERAI LUMRAH</b></li>
<li><a href="<?= base_url()."store/l" ?>"><i class="fa fa-cart-plus"></i> Lihat Produk Commerce</a></li>
<li class="treeview">
    <a href="#">
    <i class="fa fa-qrcode"></i> <span>Produk Ecommerce</span>
    <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li><a href="<?= base_url()."mykopproduk" ?>"><i class="fa fa-gift"></i> Data Produk Commerce</a></li>
    </ul>
</li>

<li class="treeview <?php echo $gerai;?>">
       <a href="<?= base_url()."gerai" ?>" onclick="get_gerai()">
        <i class="fa fa-qrcode"></i> <span>Produk Gerai Transaksi</span>
        <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu  <?php echo $gerai_menu;?> ">
            <li><a href="<?php echo site_url('gerai/pulsa'); ?>"><i class="fa fa-qrcode"></i> Pulsa</a></li>
            <!-- <li><a href="<?php echo site_url('store'); ?>"><i class="fa fa-qrcode"></i> Belanja Online</a></li> -->

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
<!-- <li class="treeview">
    <a href="<?= base_url()."gerai" ?>">
    <i class="fa fa-qrcode"></i> <span></span> Produk Gerai
    </a>
</li> -->





<li class="header" style="background:#159400;color:white;"><b>MINICORE BANKING</b></li>
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
        <li><a href="<?= base_url()."transfer_saldo/rekening_virtual" ?>"><i class="fa fa-send"></i> Transfer Tabungan ke Virtual</a></li>
        <li><a href="<?= base_url()."transfer_saldo/virtual_rekening" ?>"><i class="fa fa-send"></i> Transfer Virtual ke Tabungan</a></li>
    </ul>
</li>
<li><a href="<?= base_url() ?>setor_tunai"><i class="fa fa-user"></i> Setor Tunai</a></li>
<li><a href="<?= base_url() ?>tarik_tunai"><i class="fa fa-user"></i> Penarikan Tunai</a></li>
<li><a href="<?= base_url() ?>ubah_status_rekening"><i class="fa fa-user"></i> Ubah Status Rekening</a></li>



<li class="header" style="background:#a2a2a2;color:black;"><b>MANAGEMENT KONTEN</b></li>

<li class="treeview">
       <a href="#">
        <i class="fa fa-newspaper-o"></i> <span>Management Berita</span>
        <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?= base_url() ?>berita/admin"><i class="fa fa-newspaper-o"></i> Berita Admin</a></li>
            <li><a href="<?= base_url() ?>berita/koperasi"><i class="fa fa-newspaper-o"></i> Berita Koperasi</a></li>
        </ul>

</li>

<li><a href="<?= base_url() ?>event/koperasi"><i class="fa fa-calendar-plus-o"></i> <span>Event Koperasi</span></a></li>
<li><a href="<?= base_url() ?>agenda/koperasi"><i class="fa fa-calendar-plus-o"></i> <span>Agenda Koperasi</span></a></li>


<li class="header" style="background:#a2a2a2;color:black;"><b>MANAGEMENT LAPORAN</b></li>
            <li>
                <a href="<?= base_url() ?>log"><i class="fa fa-file"></i><span> Laporan transaksi anggota</span></a>
            </li>
            <li>
                <a href="<?= base_url() ?>transaksi/commerce"><i class="fa fa-file"></i> <span>Laporan Transaksi Commerce</span></a>
            </li>
            <li>
                <a href="<?= base_url() ?>transaksi/gerai"><i class="fa fa-file"></i> <span>Laporan Transaksi Gerai</span></a>
            </li>            
<?php } ?>
