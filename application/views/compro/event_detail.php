<div class="page-banner" style="padding:70px 0 20px 0;background: url(images/slide-02-bg.jpg) center #f9f9f9;">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2 class="text-center"><?= $event['judul'] ?></h2>
				<!-- <p>We Are Professional</p> -->
			</div>
		</div>
	</div>
</div>
<div class="container">
	<article class="post">
		<header class="entry-header">
			<div class="entry-thumb">
				<img width="100%" height="360" alt="Blog 01" class="attachment-post-thumbnail" src="<?php echo SRC_IMG_EVENT.$event['link_gambar'] ?>">
				</div><!-- .entry-thumb -->
				</header><!-- .entry-header -->
				<div class="entry-content">
					<div class="entry-meta">
						<div class="post-meta">
							<span class="posted-on">Posted on <a rel="bookmark" href="#"><?php
                                                $date = new DateTime($event['tanggal_dibuat']); 
                                                echo $date->format('d M y, H:i:s'); 
                                                ?></a></span>
							<span class="byline"> by <span class="author vcard"><a href="#"><?= $event['username'] ?></a></span></span>
							</div><!-- .post-meta -->
							</div><!-- .entry-meta -->
							<p>Tanggal Event : <?php
                                                $date = new DateTime($event['tanggal_event']); 
                                                echo $date->format('d M y, H:i:s'); 
                                                ?></p>
							<p><?= $event['isi'] ?></p>
	

				</div><!-- .entry-content -->
	<footer class="entry-footer">
		<div class="single-share">
			Share this post
			<ul class="social">
				<li>
					<a onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" href="http://www.facebook.com/sharer.php?u=#" title="Facebook">
						<i class="fa fa-facebook"></i>
						<span>Facebook</span>
					</a>
				</li>
				<li>
					<a onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" href="https://twitter.com/share?url=#" title="Twitter">
						<i class="fa fa-twitter"></i>
						<span>Twitter</span>
					</a>
				</li>
				<li>
					<a onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" href="https://plus.google.com/share?url=#" title="Googleplus">
						<i class="fa fa-google-plus"></i>
						<span>Google Plus</span>
					</a>
				</li>
				<li>
					<a onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" href="http://pinterest.com/pin/create/button/?url=#" title="Pinterest">
						<i class="fa fa-pinterest"></i>
						<span>Pinterest</span>
					</a>
				</li>
			</ul>
			</div><!-- .single-share -->
		</footer>
	</article>
</div>