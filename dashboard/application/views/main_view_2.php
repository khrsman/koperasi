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