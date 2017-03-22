<?php 
  $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  $actual_link = urlencode($actual_link);
?>


<section class="content-header">
    <h1>
Partners
    </h1>
</section>
<section class="content">

      <div class="col-md-12">
          <div class="box box-primary">
              <div class="box-body">
                     <div class="col-md-4 col-md-offset-2">
         <img src="<?php echo base_url('assets/compro/IMAGE/partners/'); ?>/megainsurance.jpg" alt=""  class="img-responsive">
      </div>
      <div class="col-md-4">
         <img src="<?php echo base_url('assets/compro/IMAGE/partners/'); ?>/xllogo.jpg" alt=""  class="img-responsive">
      </div>

      <div class="clear-both"></div>
      <br><br>
      <hr>
      <br><br>
      <div class="col-md-12">
        <p>
          We believe that the future of business and life will involve more collaboration and working together, because the best partnerships handle the worst case scenarios in future.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
          It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Sed ut perspiciatis unde omnis iste natus error sit volup accusantium. Lorem ipsum dolor sit amet, consectetur.
        </p>
      </div>
              </div>
          </div>
      </div>


 





</section>



<script type="text/javascript">
  // get your select element and listen for a change event on it
  $('.select-redirect').change(function() {
    // set the window's location property to the value of the option the user has selected
    document.location = $(this).val();
  });
</script>