<?php 
  $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  $actual_link = urlencode($actual_link);
?>
<div class="clearfix"></div>
<div class=" bumper_image">
   <center>
      <img src="<?php echo base_url('assets/compro/landing_page/bumper1.jpg');?>" class="img-responsive" style="">
   </center>
</div>
<div class="clearfix"></div>
<div class="main_about_us" style="padding: 10px 0;border-bottom:1px solid #D4D4D4;background: #064862;color: white;font-size: 18px;">
   <div class="container">
      <div class="row">
         <div class="col-md-12 col-xs-12">
            <div class="text-center">
               <marquee>
                  <b>MEMBANGUN JARINGAN KERJASAMA BISNIS KOPERASI INDONESIA</b>
               </marquee>
            </div>
         </div>
      </div>
   </div>
</div>
<section class="white-wrapper jt-shadow">
   <div class="container">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
         <div class="general-title">
            <h2>REKANAN</h2>
            <hr>
         </div>
      </div>
      <div class="clearfix"></div>
      <BR><BR><BR>
      <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"></div>
      <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
         <div class="widget">
            <div class="col-md-4 col-md-offset-2 col-sm-6 col-xs-12">
              <img src="<?php echo base_url('assets/compro/IMAGE/partners/'); ?>/megainsurance.jpg" alt=""  class="img-responsive">
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
               <img src="<?php echo base_url('assets/compro/IMAGE/partners/'); ?>/xllogo.jpg" alt=""  class="img-responsive">
            </div>
            <div class="clearfix"></div>
             <div class="col-md-12">
             <br><br>
            <p>
              We believe that the future of business and life will involve more collaboration and working together, because the best partnerships handle the worst case scenarios in future.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
              It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Sed ut perspiciatis unde omnis iste natus error sit volup accusantium. Lorem ipsum dolor sit amet, consectetur.
            </p>
          </div>
         </div>
      </div>
      <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"></div>
      <div class="clearfix"></div>




      <!-- end col-lg-6 -->
   </div>
   <!-- end container -->
   <br><br><br><br><br><br><br><br>
</section>


<script type="text/javascript">
  // get your select element and listen for a change event on it
  $('.select-redirect').change(function() {
    // set the window's location property to the value of the option the user has selected
    document.location = $(this).val();
  });
</script>