
<section class="content-header">
    <h1>
<?= $berita['judul'] ?>
    </h1>
</section>


<section class="content">
  <div class="row">
      <div class="col-md-12">
          <div class="box box-primary">
          <br><br>
           	<article class="post" style="padding:20px;">
		<header class="entry-header">
			<div class="entry-thumb">
				<img width="100%" height="360" alt="Blog 01" class="attachment-post-thumbnail" src="<?php echo SRC_IMG_NEWS.$berita['link_gambar'] ?>">
				</div><!-- .entry-thumb -->
				</header><!-- .entry-header -->
				<div class="entry-content">
					<div class="entry-meta">
						<div class="post-meta">
								<span class="posted-on">Posted on <a rel="bookmark" href="#"><?php
                                                $date = new DateTime($berita['tanggal_dibuat']); 
                                                echo $date->format('d M y, H:i:s'); 
                                                ?></a></span>
							<span class="byline"> by <span class="author vcard"><a href="#"><?= $berita['username'] ?></a></span></span>
							</div><!-- .post-meta -->
							</div><!-- .entry-meta -->
							
							<p><?= $berita['isi'] ?></p>
	

				</div><!-- .entry-content -->

	</article>
          </div>
      </div>
  </div>
</section>








