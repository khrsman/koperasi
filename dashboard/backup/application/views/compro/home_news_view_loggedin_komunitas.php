<?php 
  $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  $actual_link = urlencode($actual_link);
?>

<section class="content-header">
    <h1>
Berita
    </h1>

</section>

<section class="content">
  <div class="row">
      <div class="col-md-12">
          <div class="box box-primary" style="padding:20px;">
                    <br><br><br>
         <div class="clear-both"></div>

         <?php  $i = 0;foreach ($komunitas as $r) { ?>
            <div class="col-md-4">
            <div class="wr-element">
               <div class="blog-post style-3">
                  <article class="post">
                     <div class="entry-thumb">
                        <a class="thumb" href="<?php echo base_url()?>news/<?= $r->id_berita ?>" style="height:201px;overflow-y:hidden;"><img alt="Blog post 1" src="<?php echo SRC_IMG_NEWS.$r->link_gambar?>" width="100%" height="248px"></a>
                     </div>
                     <div class="entry-content">
                        <div class="entry-meta">
                           <h4><a rel="bookmark" href="<?php echo base_url()?>news/<?= $r->id_berita ?>"><?= $r->judul?></a></h4>
                        </div>
                        <p><?php $text =  substr($r->isi, 0, 100);
                                echo $text; ?></p>
                        <a class="more-link" href="<?php echo base_url()?>news/<?= $r->id_berita?>">Read More</a>
                     </div>
                  </article>
               </div>
            </div>
         </div>
     <?php 
        $i++;
        if($i == 3){
          $i==0;
          echo "<div class='clear-both'></div>";
          echo "<br><br>";
        }

        } ?>
        <div class='clear-both'></div>
          </div>
      </div>
  </div>
</section>


<section class="content-header">
    <h1>
Event
    </h1>

</section>

<section class="content">
  <div class="row">
      <div class="col-md-12">
          <div class="box box-primary" style="padding:20px;">
                    <br><br><br>
         <div class="clear-both"></div>

 <?php foreach ($event as $r) { ?>
            <div class="col-md-4">
            <div class="wr-element">
               <div class="blog-post style-3">
                  <article class="post">
                     <div class="entry-thumb">
                        <a class="thumb" href="<?php echo base_url()?>event/<?= $r->id_event ?>" style="height:201px;overflow-y:hidden;"><img alt="Blog post 1" src="<?php echo SRC_IMG_EVENT.$r->link_gambar?>" width="100%" height="248px"></a>
                     </div>
                     <div class="entry-content">
                        <div class="entry-meta">
                           <h4><a rel="bookmark" href="<?php echo base_url()?>event/<?= $r->id_event ?>"><?= $r->judul?></a></h4>
                        </div>
                        <p><?php $text =  substr($r->isi, 0, 100);
                                echo $text; ?></p>
                        <a class="more-link" href="<?php echo base_url()?>event/<?= $r->id_event?>">Read More</a>
                     </div>
                  </article>
               </div>
            </div>
         </div>
     <?php 
        $i++;
        if($i == 3){
          $i==0;
          echo "<div class='clear-both'></div>";
          echo "<br><br>";
        }

        } ?>
        <div class='clear-both'></div>
          </div>
      </div>
  </div>
