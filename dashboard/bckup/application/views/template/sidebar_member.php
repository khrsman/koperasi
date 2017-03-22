<li class="header" style="background:#FFDDAD;color:black;"><img src="<?php echo base_url('assets/compro/dashboard').'/lite-home.png'; ?>" class="img-responsives" width="30px" style="margin:0 22px 0 0" ><font size="2px"><b>HOME NAVIGATION</b></font></li>

<!-- <li class="header">MAIN NAVIGATION</li> -->


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

<!-- 
<li class="header" style="background:#f57722;color:white;"><b>ECOMMERCE</b></li>
<li><a href="<?= base_url()."store/l" ?>"><i class="fa fa-cart-plus"></i>Lihat Produk Commerce</a></li>
<li class="treeview">
    <a href="#">
    <i class="fa fa-qrcode"></i> <span>Produk Ecommerce</span>
    <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li><a href="<?= base_url()."mykopproduk" ?>"><i class="fa fa-gift"></i> Data Produk Commerce</a></li>
    </ul>
</li>
 -->
<!-- <li class="header">MANAGEMENT ECOMMERCE</li>
<li class="treeview">
    <a href="#">
    <i class="fa fa-qrcode"></i> <span>Produk Ecommerce</span>
    <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li><a href="<?= base_url()."mymemproduk" ?>"><i class="fa fa-gift"></i> Data Produk Commerce</a></li>
    </ul>
</li> -->
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


<li class="header" style="background:#FFADAD;color:black;border: 1px solid #ddd;"><img src="<?php echo base_url('assets/compro/dashboard').'/lite-gerai.png'; ?>" class="img-responsives" width="30px" style="margin:0 22px 0 0" ><font size="2px"> <b>GERAI LUMRAH</b></font></li>
<li><a href="<?= base_url()."store/l" ?>"><i class="fa fa-cart-plus"></i> Lihat Produk Belanja Online</a></li>
<li class="treeview">
    <a href="#">
    <i class="fa fa-qrcode"></i> <span>Produk Belanja Online</span>
    <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li><a href="<?= base_url()."mykopproduk" ?>"><i class="fa fa-gift"></i> Data Produk Belanja Online</a></li>
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



<li class="header" style="background:#FFFAAD;color:black;border: 1px solid #ddd;"><img src="<?php echo base_url('assets/compro/dashboard').'/lite-banking.png'; ?>" class="img-responsives" width="30px" style="margin:0 22px 0 0" ><font size="2px"><b>MINI PERBANKAN</b></font></li>
<li><a href="<?php echo base_url() ?>nasabah"><i class="fa fa-gift"></i> Lihat Rekening & Transaksi</a></li>
<li><a href="<?php echo base_url() ?>transfer_saldo"><i class="fa fa-gift"></i> Transfer Saldo</a></li>
<!-- <li><a href="#"><i class="fa fa-gift"></i> Permohonan Rekening</a></li>
<li><a href="#"><i class="fa fa-gift"></i> Permohonan Kredit</a></li> -->

<li class="header"  style="background:#C5FFAD;color:black;"><img src="<?php echo base_url('assets/compro/dashboard').'/lite-konten.png'; ?>" class="img-responsives" width="30px" style="margin:0 22px 0 0" ><font size="2px"><b>PORTOFOLIO</b></font></li>
<li><a href="#"><i class="fa fa-gift"></i> Portofolio</a></li>




<!-- <li class="header">TRANSAKSI</li>
<li><a href="#"><i class="fa fa-gift"></i> Lihat Pembelian Gerai</a></li>
<li><a href="#"><i class="fa fa-gift"></i> Lihat Transaksi Commerce</a></li>
<li><a href="<?= base_url() ?>saldo"><i class="fa fa-dollar"></i> Informasi Saldo </a></li> -->

<li class="header"  style="background:#FFDDAD;color:black;"><img src="<?php echo base_url('assets/compro/dashboard').'/lite-report.png'; ?>" class="img-responsives" width="30px" style="margin:0 22px 0 0" ><font size="2px"><b>LAINNYA</b></font></li>
<li class="treeview">
       <a href="#">
        <i class="fa fa-newspaper-o"></i> <span>Berita</span>
        <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?= base_url() ?>berita/admin"><i class="fa fa-newspaper-o"></i> Berita Admin</a></li>
            <li><a href="<?= base_url() ?>berita/koperasi"><i class="fa fa-newspaper-o"></i> Berita Koperasi</a></li>
        </ul> 
</li>
        
<li><a href="<?= base_url() ?>event/koperasi"><i class="fa fa-calendar-plus-o"></i> Event Koperasi</a></li>
<li><a href="<?= base_url() ?>agenda/koperasi"><i class="fa fa-calendar-plus-o"></i> Agenda Koperasi</a></li>
<!-- <li class="header">MANAGEMENT LAPORAN</li>
            <li>
                <a href="<?= base_url() ?>transaksi/commerce"><i class="fa fa-file"></i> Laporan Transaksi Commerce</a>
            </li>
            <li>
                <a href="<?= base_url() ?>transaksi/gerai"><i class="fa fa-file"></i> Laporan Transaksi Gerai</a>
            </li> -->
<?php } ?>
