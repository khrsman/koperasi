<style type="text/css">
    a{
        color: black;
        font-weight: bold;
    }


</style>


<li class="treeview" style="color:black;">
    <a href="<?= base_url()."home" ?>">
        <img src="<?php echo base_url('assets/compro/dashboard').'/home.png'; ?>" class="img-responsives" width="200px" style="margin:0 22px 0 0" >
    </a>
</li>
<li class="treeview" style="color:black;">
    <a href="#">
        <img src="<?php echo base_url('assets/compro/dashboard').'/reg.png'; ?>" class="img-responsives" width="200px" style="margin:0 22px 0 0" >
        <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
                <li><a href="<?= base_url()."admin" ?>"><i class="fa fa-user"></i> Data Admin</a></li>
                <li><a href="<?= base_url()."polis" ?>"><i class="fa fa-user"></i> Data Polis</a></li>
                <li><a href="<?= base_url()."koperasi" ?>"><i class="fa fa-user"></i> Data Koperasi Induk</a></li>
                <li><a href="<?= base_url()."cabang_koperasi" ?>"><i class="fa fa-user"></i> Data Cabang Koperasi</a></li>
                <li><a href="<?= base_url()."anggota" ?>"><i class="fa fa-user"></i> Data Anggota Koperasi</a></li>
                <li><a href="<?= base_url()."komunitas" ?>"><i class="fa fa-user"></i> Data Komunitas</a></li>
                <li><a href="<?= base_url()."anggota_komunitas" ?>"><i class="fa fa-user"></i> Data Anggota Komunitas</a></li>
        		<li><a href="<?= base_url()."shu_koperasi" ?>"><i class="fa fa-user"></i> Data SHU Koperasi</a></li>
                
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
        <li><a href="<?= base_url() ?>rekening_non_member"><i class="fa fa-user"></i> Rekening Non Member</a></li>
        <li><a href="<?= base_url() ?>share_profit_induk"><i class="fa fa-share"></i> <span>Share Profit Koperasi Induk</span></a></li>
        <li><a href="<?= base_url() ?>share_profit"><i class="fa fa-share"></i> <span>Share Profit Koperasi Cabang</span></a></li>
        <li><a href="<?= base_url() ?>share_profit_smidumay"><i class="fa fa-share"></i> <span>Share Profit CIMAHI1</span></a></li>
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
<li><a href="<?= base_url()."produk_owner" ?>"><i class="fa fa-gift"></i> Data Produk Serba Murah</a></li>
                <li><a href="<?= base_url()."store_order" ?>"><i class="fa fa-gift"></i> Pesanan Masuk</a></li>
                <li><a href="<?= base_url()."produk_koperasi" ?>"><i class="fa fa-gift"></i> Data Produk Koperasi</a></li>
                <li><a href="<?= base_url()."produk_anggota" ?>"><i class="fa fa-gift"></i> Data Produk Anggota</a></li>
                <li><a href="<?= base_url()."produk_kategori" ?>"><i class="fa fa-bookmark"></i> Kategori Produk</a></li>
    </ul>
</li>


<li class="treeview" style="color:black;">
    <a href="#">
        <img src="<?php echo base_url('assets/compro/dashboard').'/serba.png'; ?>" class="img-responsives" width="200px" style="margin:0 22px 0 0" >
        <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
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

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-bookmark"></i> <span>Kelola Vendor</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?= base_url()."gerai_vendor_produk" ?>"><i class="fa fa-bookmark"></i> Produk Vendor</a></li>
                    <li><a href="<?= base_url()."gerai_kategori_produk" ?>"><i class="fa fa-bookmark"></i> Kategori Produk Gerai</a></li>
                    <li><a href="<?= base_url()."gerai_vendor" ?>"><i class="fa fa-bookmark"></i> Data Vendor</a></li>
                    <li><a href="<?= base_url()."gerai_operator" ?>"><i class="fa fa-bookmark"></i> Data Operator</a></li>
                </ul>
            </li>
    </ul>
</li>





<li class="treeview" style="color:black;">
    <a href="#">
        <img src="<?php echo base_url('assets/compro/dashboard').'/laporan.png'; ?>" class="img-responsives" width="200px" style="margin:0 22px 0 0" >
        <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
           <li><a href="<?= base_url() ?>log"><i class="fa fa-file"></i> Laporan transaksi anggota</a></li>
        <li><a href="<?= base_url() ?>transaksi/commerce"><i class="fa fa-file"></i> Laporan Transaksi Commerce</a></li>
        <li><a href="<?= base_url() ?>transaksi/gerai"><i class="fa fa-file"></i> Laporan Transaksi Gerai</a></li>
        <li><a href="<?= base_url() ?>report/product_sell"><i class="fa fa-table"></i> Tabel Pembelian Produk</a></li>
        <li><a href="<?= base_url() ?>chart/anggota"><i class="fa fa-bar-chart"></i> Chart Anggota Koperasi</a></li>
        <li><a href="#"><i class="fa fa-bar-chart"></i> Chart Laporan Jumlah Transaksi Berdasarkan Wilayah</a></li>
        <li><a href="<?= base_url() ?>chart/total_transaksi"><i class="fa fa-bar-chart"></i> Chart Laporan Total Transaksi Berdasarkan Wilayah</a></li>
        <li><a href="#"><i class="fa fa-bar-chart"></i> Chart Laporan Wilayah Pembelian</a></li>
        <li><a href="#"><i class="fa fa-bar-chart"></i> Chart Laporan Transaksi Commerce</a></li>
        <li><a href="#"><i class="fa fa-bar-chart"></i> Chart Laporan Transaksi Gerai</a></li>
    </ul>
</li>
<li class="treeview" style="color:black;">
    <a href="#">
        <img src="<?php echo base_url('assets/compro/dashboard').'/konten.png'; ?>" class="img-responsives" width="200px" style="margin:0 22px 0 0" >
        <i class="fa fa-angle-left pull-right"></i>
    </a>
   <ul class="treeview-menu">
        <li class="treeview">
            <a href="#">
                <i class="fa fa-newspaper-o"></i> <span>Management Berita</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?= base_url() ?>berita/admin"><i class="fa fa-newspaper-o"></i> Berita Admin</a></li>
                <li><a href="<?= base_url() ?>berita_koperasi"><i class="fa fa-newspaper-o"></i> Berita Koperasi</a></li>
                <li><a href="<?= base_url() ?>berita_komunitas"><i class="fa fa-newspaper-o"></i> Berita Komunitas</a></li>
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-fa fa-calendar"></i> <span>Management Event</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?= base_url() ?>event_koperasi"><i class="fa fa-calendar"></i> Event Koperasi</a></li>
                <li><a href="<?= base_url() ?>event_komunitas"><i class="fa fa-calendar"></i> Event Komunitas</a></li>
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-calendar-plus-o"></i> <span>Management Agenda</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?= base_url() ?>agenda_koperasi"><i class="fa fa-calendar-plus-o"></i> Agenda Koperasi</a></li>
                <li><a href="<?= base_url() ?>agenda_komunitas"><i class="fa fa-calendar-plus-o"></i> Agenda Komunitas</a></li>
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-user"></i> <span>Management Compro</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?= base_url() ?>compro_koperasi"><i class="fa fa-user"></i> Compro Koperasi</a></li>
                <li><a href="<?= base_url() ?>compro_komunitas"><i class="fa fa-user"></i> Compro Komunitas</a></li>
            </ul>
        </li>
    </ul>
</li>

<!-- <li class="treeview" style="background:#a2a2a2;color:black;">
    <a href="#">
        <span><b>MANAGEMENT E-MAJALAH</b></span>
        <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li class="treeview">
            <a href="#">
                s<i class="fa fa-newspaper-o"></i> <span>Management Majalah</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?= base_url() ?>majalah/admin"><i class="fa fa-newspaper-o"></i> Majalah Admin</a></li>
                <li><a href="<?= base_url() ?>majalah_koperasi"><i class="fa fa-newspaper-o"></i> Majalah Koperasi</a></li>
                <li><a href="<?= base_url() ?>majalah_komunitas"><i class="fa fa-newspaper-o"></i> Majalah Komunitas</a></li>
            </ul>
        </li>
    </ul>
</li> -->