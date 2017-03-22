<li class="header" style="background:#FFDDAD;color:black;"><img src="<?php echo base_url('assets/compro/dashboard').'/lite-home.png'; ?>" class="img-responsives" width="30px" style="margin:0 22px 0 0" ><font size="2px"><b>HOME NAVIGATION</b></font></li>

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



<li class="header" style="background:#ADDEFF;color:black;border: 1px solid #ddd;"><img src="<?php echo base_url('assets/compro/dashboard').'/lite-registrasi.png'; ?>" class="img-responsives" width="30px"style="margin:0 22px 0 0" ><font size="2px"> <b>REGISTRASI ANGGOTA</b></font></li>
<li class="treeview">
        <li><a href="<?= base_url()."anggota_komunitas" ?>"><i class="fa fa-user"></i> Data Anggota Komunitas</a></li>
</li>

<li class="header"  style="background:#C5FFAD;color:black;"><img src="<?php echo base_url('assets/compro/dashboard').'/lite-konten.png'; ?>" class="img-responsives" width="30px" style="margin:0 22px 0 0" ><font size="2px"><b>MANAGEMENT KONTEN</b></font></li>
<li class="treeview">
       <a href="#">
        <i class="fa fa-newspaper-o"></i> <span>Management Berita</span>
        <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?= base_url() ?>berita/admin"><i class="fa fa-newspaper-o"></i> Berita Admin</a></li>
            <li><a href="<?= base_url() ?>berita/komunitas"><i class="fa fa-newspaper-o"></i> Berita Komunitas</a></li>
        </ul>
        
</li>
<li><a href="<?= base_url() ?>event/komunitas"><i class="fa fa-calendar-plus-o"></i> Event Komunitas</a></li>
<li><a href="<?= base_url() ?>agenda/komunitas"><i class="fa fa-calendar"></i> Agenda Komunitas</a></li>
