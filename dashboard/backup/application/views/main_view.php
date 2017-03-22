<?php 
$this->load->view('template/head');
?>
<!--tambahkan custom css disini-->
<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>
<!-- Content Header (Page header) -->
<section class="content-header">
       <h1>

                  <img src="
                    <?php 
                      if($this->session->userdata('id_user') == NULL OR $this->session->userdata('id_user') == "" OR $this->session->userdata('level') == "1"){
                        echo base_url('assets/compro').'/smi-logo.png';
                      }else{
                        echo get_cover_logo();
                      }
                     ?>
                  " class="img-responsive" style="width:200px;"/>
    <!-- <small>it all starts here</small> -->
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Dashboard</a></li>
    </ol>
    <br>
    <?php  if($this->session->userdata('level')     != "1") { 
        if($this->uri->segment(1) == 'home' OR $this->uri->segment(1) == 'about' OR $this->uri->segment(1) == 'agenda' OR $this->uri->segment(1) == 'news' OR $this->uri->segment(1) == 'contact' OR $this->uri->segment(1) == 'partners'  OR $this->uri->segment(1) == 'faq' OR $this->uri->segment(1) == 'services'){ ?>

        <a class="btn btn-sm btn-primary" href="<?php echo site_url('about'); ?>"><strong>Tentang Kami</strong></a>
        <a class="btn btn-sm btn-primary" href="<?php echo site_url('agenda'); ?>"><strong>Agenda Organisasi</strong></a>
        <a class="btn btn-sm btn-primary" href="<?php echo site_url('news'); ?>"><strong>Berita / Acara</strong></a>
        <a class="btn btn-sm btn-primary" href="<?php echo site_url('contact'); ?>"><strong>Kontak</strong></a>
        <a class="btn btn-sm btn-primary" href="<?php echo site_url('partners'); ?>"><strong>Partners</strong></a>
        <a class="btn btn-sm btn-primary" href="<?php echo site_url('faq'); ?>"><strong>FAQ SMI</strong></a>
        <a class="btn btn-sm btn-primary" href="<?php echo site_url('services'); ?>"><strong>Products & Services</strong></a>
 <?php }} ?>
</section>

<section class="content">

      <?php 
         $this->load->view(@$page);
      ?> 



</section><!-- /.content -->

<?php 
$this->load->view('template/js');
?>

<!--tambahkan custom js disini-->

<script type="text/javascript">
  // jQuery plugin to prevent double submission of forms
  jQuery.fn.preventDoubleSubmission = function() {
    $(this).on('submit',function(e){
      var $form = $(this);

      if ($form.data('submitted') === true) {
        // Previously submitted - don't submit again
        e.preventDefault();
      } else {
        // Mark it so that the next submit can be ignored
        $form.data('submitted', true);
      }
    });

    // Keep chainability
    return this;
  };

  $('form').preventDoubleSubmission();
</script>

<?php
$this->load->view('template/foot');
?>