
<section class="content-header">
    <h1>
<?= $agenda['judul'] ?>
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
				<img width="100%" height="360" alt="Blog 01" class="attachment-post-thumbnail" src="<?php echo SRC_IMG_AGENDA.$agenda['link_gambar'] ?>">
				</div><!-- .entry-thumb -->
				</header><!-- .entry-header -->
				<div class="entry-content">
					<div class="entry-meta">
						<div class="post-meta">
							<span class="posted-on">Posted on <a rel="bookmark" href="#"><?php
                                                $date = new DateTime($agenda['tanggal_dibuat']); 
                                                echo $date->format('d M y, H:i:s'); 
                                                ?></a></span>
							<span class="byline"> by <span class="author vcard"><a href="#"><?= $agenda['username'] ?></a></span></span>
							</div><!-- .post-meta -->
							</div><!-- .entry-meta -->
							<p>Tanggal Agenda : <?php
                                                $date = new DateTime($agenda['tanggal_agenda']); 
                                                echo $date->format('d M y, H:i:s'); 
                                                ?></p>
							<p><?= $agenda['isi'] ?></p>
	

				</div><!-- .entry-content -->

	</article>
          </div>
      </div>
  </div>
</section>

