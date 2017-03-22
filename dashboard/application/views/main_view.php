<?php 
if($this->session->userdata('level') == "3"){ ?>







<?php 
// $this->load->view('template/head');
$this->load->view('template/head');
$this->load->view('new_head_anggota_kop');
?>
<!--tambahkan custom css disini-->
<?php
// $this->load->view('template/topbar');
// $this->load->view('template/sidebar');
?>
<!-- Content Header (Page header) -->


<section class="content container">
<div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
<?php $this->load->view('new_sidebar_anggota');?>

</div>

<div class="col-md-9 col-lg-9 col-sm-12 col-xs-12">
      <?php 
         $this->load->view(@$page);
      ?> 
</div>


</section><!-- /.content -->

 <div class="clearfix"></div>
      <div id="copyrights" style="background-color: white;">
         <div class="container">
            <hr>
            <div class="col-lg-12 col-md-12 col-sm-12">
               <center>
                  <div class="copyright-text ">
                     <p style="color:black;"> Powered by <strong>
                        <img src="<?php echo base_url('assets/compro').'/smi-logo-lite.png'; ?>" class="img-responsives" width="50px">
                        PT SANMADA MEGA INDONESIA
                        </strong> 
                     </p>
                  </div>
                  <!-- end copyright-text -->
               </center>
            </div>
            <!-- end widget -->
         </div>
         <!-- end container -->
      </div>

<?php 
// $this->load->view('template/js');
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


<?php 
}
else{

  $this->load->view('main_view_2');
}

?>