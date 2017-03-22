<?php 
  $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  $actual_link = urlencode($actual_link);
?>

<div class="page-banner" style="padding:70px 0 20px 0;background: url(images/slide-02-bg.jpg) center #f9f9f9;">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2 class="text-center">News</h2>
        <!-- <p>We Are Professional</p> -->
      </div>
    </div>
  </div>
</div>
<div class="page-section v1-three ">
   <div class="container">
      <div class="row">
         <br><br><br>
         <div class="clear-both"></div>

         <?php foreach ($emag as $r) { ?>
            <div class="col-md-4">
            <div class="wr-element">
               <div class="blog-post style-3">
                  <article class="post">
                     <div class="entry-content">
                        <div class="entry-meta">
                           <h4><a rel="bookmark" href="<?php echo base_url()?>emag/<?= $r->id_majalah ?>"><?= $r->judul?></a></h4>
                        </div>
                        <p><?php $text =  substr($r->deskripsi, 0, 100);
                                echo $text; ?></p>
                        <a class="more-link" href="<?php echo base_url()?>emag/<?= $r->id_majalah?>">Read More</a>
                     </div>
                  </article>
               </div>
            </div>
         </div>
        <?php } ?>
      </div>
      <!-- .row -->
   </div>
   <!-- .container -->
</div>