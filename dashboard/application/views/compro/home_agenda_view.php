<?php 
  $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  $actual_link = urlencode($actual_link);
?>

<section class="content-header">
    <h1>
Agenda
    </h1>

</section>

<section class="content">
  <div class="row">
          <div class="box box-primary">
          <div class="clear-both"></div>
          <br>
            <?php 
            $i = 0;
            foreach ($agenda as $r) { ?>
            <div class="col-md-4">
            <div class="wr-element">
               <div class="blog-post style-3">
                  <article class="post">
                     <div class="entry-thumb">
                        <a class="thumb" href="<?php echo base_url()?>agenda/<?= $r->id_agenda ?>" style="height:201px;overflow-y:hidden;"><img alt="Blog post 1" src="<?php echo SRC_IMG_AGENDA.$r->link_gambar?>" width="100%" height="248px"></a>
                     </div>
                     <div class="entry-content">
                        <div class="entry-meta">
                           <h4><a rel="bookmark" href="<?php echo base_url()?>agenda/<?= $r->id_agenda ?>"><?= $r->judul?></a></h4>
                        </div>
                        <p><?php $text =  substr($r->isi, 0, 100);
                                echo $text; ?></p>
                        <a class="more-link" href="<?php echo base_url()?>agenda/<?= $r->id_agenda?>">Read More</a>
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
</section>
