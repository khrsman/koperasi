<li class="header" style="background:#a2a2a2;color:black;"><b>HOME NAVIGATION</b></li>
<li>
    <a href="<?= base_url()."home" ?>">
        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
    </a>
</li>

<li class="header" style="background:red;color:white;"><b>REGISTRASI ANGGOTA</b></li>
<li><a href="<?= base_url()."add_anggota" ?>"><i class="fa fa-user"></i> Registrasi Anggota</a></li>
<li class="treeview">
    <a href="#">
    <i class="fa fa-users"></i> <span>Registrasi Anggota</span>
    <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li><a href="<?= base_url()."admin" ?>"><i class="fa fa-user"></i> Data Admin</a></li>
        <li><a href="<?= base_url()."koperasi" ?>"><i class="fa fa-user"></i> Data Koperasi Induk</a></li>
        <li><a href="<?= base_url()."cabang_koperasi" ?>"><i class="fa fa-user"></i> Data Cabang Koperasi</a></li>
        <li><a href="<?= base_url()."anggota" ?>"><i class="fa fa-user"></i> Data Anggota Koperasi</a></li>
         <li><a href="<?= base_url()."komunitas" ?>"><i class="fa fa-user"></i> Data Komunitas</a></li>
        <li><a href="<?= base_url()."anggota_komunitas" ?>"><i class="fa fa-user"></i> Data Anggota Komunitas</a></li>
    </ul>
</li>
<li class="header" style="background:#f57722;color:white;"><b>ECOMMERCE</b></li>
<li><a href="<?= base_url()."store/l" ?>"><i class="fa fa-cart-plus"></i> Lihat Produk Commerce</a></li>
<li class="treeview">
    <a href="#">
    <i class="fa fa-qrcode"></i> <span>Produk Ecommerce</span>
    <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li><a href="<?= base_url()."produk_owner" ?>"><i class="fa fa-gift"></i> Data Produk Gerai Lumrah</a></li>
        <li><a href="<?= base_url()."produk_koperasi" ?>"><i class="fa fa-gift"></i> Data Produk Koperasi</a></li>
        <li><a href="<?= base_url()."produk_anggota" ?>"><i class="fa fa-gift"></i> Data Produk Anggota</a></li>
        <li><a href="<?= base_url()."produk_kategori" ?>"><i class="fa fa-bookmark"></i> Kategori Produk</a></li>
    </ul>
</li>
<li class="header" style="background:#03a9a2;color:white;"><b>GERAI TRANSACTION</b></li>
<li class="treeview">
    <a href="<?= base_url()."gerai" ?>">
        <i class="fa fa-qrcode"></i> <span>Produk Gerai</span>
    </a>
</li>
<li>
    <a href="<?= base_url() ?>datacell"><i class="fa fa-mobile"></i> Datacell Harga</a>
</li>

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


<li class="header" style="background:#a2a2a2;color:black;"><b>MANAGEMENT LAPORAN</b></li>
            <li>
                <a href="<?= base_url() ?>log"><i class="fa fa-file"></i> Laporan transaksi anggota</a>
            </li>
            <li>
                <a href="<?= base_url() ?>transaksi/commerce"><i class="fa fa-file"></i> Laporan Transaksi Commerce</a>
            </li>
            <li>
                <a href="<?= base_url() ?>transaksi/gerai"><i class="fa fa-file"></i> Laporan Transaksi Gerai</a>
            </li>
<!-- 
<li class="treeview">
    <a href="#">
    <i class="fa fa-users"></i> <span>Management Operasi</span>
    <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li><a href="#"><i class="fa fa-user"></i> Teller - Setor Tunai</a></li>
        <li><a href="#"><i class="fa fa-user"></i> Teller - Penarikan</a></li>
        <li><a href="#"><i class="fa fa-user"></i> Teller - Pindah Buku</a></li>
        <li><a href="#"><i class="fa fa-user"></i> Teller - Transfer</a></li>
        <li><a href="<?= base_url() ?>buka_rekening"><i class="fa fa-user"></i> CS - Pembukaan Rekening</a></li>
        <li><a href="<?= base_url() ?>rekening"><i class="fa fa-user"></i> CS - Lihat Rekening</a></li>
        <li><a href="#"><i class="fa fa-user"></i> Pemasaran - Pinjaman</a></li>
        
        <li><a href="#"><i class="fa fa-user"></i> Hitung Bunga</a></li>
    </ul>
</li>

<li class="treeview">
    <a href="#">
    <i class="fa fa-users"></i> <span>Management Produk</span>
    <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li><a href="#"><i class="fa fa-user"></i> Tabungan</a></li>
        <li><a href="#"><i class="fa fa-user"></i> Deposito</a></li>
        <li><a href="#"><i class="fa fa-user"></i> Pinjaman</a></li>
    </ul>
</li> -->


<li class="header" style="background:#a2a2a2;color:black;"><b>MANAGEMENT KONTEN</b></li>
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

<li class="header" style="background:#a2a2a2;color:black;"><b>MANAGEMENT E-MAJALAH</b></li>
<li class="treeview">
       <a href="#">
        <i class="fa fa-newspaper-o"></i> <span>Management Majalah</span>
        <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?= base_url() ?>majalah/admin"><i class="fa fa-newspaper-o"></i> Majalah Admin</a></li>
            <li><a href="<?= base_url() ?>majalah_koperasi"><i class="fa fa-newspaper-o"></i> Majalah Koperasi</a></li>
            <li><a href="<?= base_url() ?>majalah_komunitas"><i class="fa fa-newspaper-o"></i> Majalah Komunitas</a></li>
        </ul>
</li>

<!-- <li class="header">MANAGEMENT DATACELL</li>
<li class="treeview">
    <a href="#">
        <i class="fa fa-mobile"></i> <span>Management Harga</span>
        <i class="fa fa-angel pull-right"></i></a>
        <ul class="treeview-menu">
            <li>
                <a href="<?= base_url() ?>datacell"><i class="fa fa-mobile"></i> Datacell Harga</a>
            </li>
        </ul>
</li> -->
