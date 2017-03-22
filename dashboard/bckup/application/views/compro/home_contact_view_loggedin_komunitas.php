<?php 
  $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  $actual_link = urlencode($actual_link);
?>


<section class="content-header">
    <h1>
Kontak
    </h1>
</section>
<section class="content">

      <div class="col-md-12">
          <div class="box box-primary">
              <div class="box-body">
  <!-- Classic Heading -->
            <h4 class="page-header"><span>Information</span></h4>

            <!-- Some Info -->
            <!-- Divider -->
            <div class="hr1" style="margin-bottom:10px;"></div>

            <!-- Info - Icons List -->
            <ul class="list-unstyled">
              <li><i class="fa fa-globe">  </i> <strong>Address:</strong> <?= $komunitas['alamat'] ?></li>
              <!-- <li><i class="fa fa-envelope-o"></i> <strong>Email:</strong> info@yourcompany.com</li> -->
              <li><i class="fa fa-mobile"></i> <strong>Phone:</strong> <?= $komunitas['telp'] ?></li>
            </ul>
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





