<div class="page-banner" style="padding:70px 0 20px 0;background: url(images/slide-02-bg.jpg) center #f9f9f9;">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<!-- <p>We Are Professional</p> -->
			</div>
		</div>
	</div>
</div>

<div class="clear-both"></div>

<div class="col-md-12">
	<div class="col-md-6">
				<object data="<?=SRC_EMAG.$majalah['file_path'] ?>" type="application/pdf" internalinstanceid="120" style="width: 100%; height: 100vh"></object>
	</div>
	<div class="col-md-6">
		<div class="entry-content">
					<h2><?= $majalah['judul'] ?></h2>
						<div class="entry-meta">
							<div class="post-meta">
								<span class="posted-on">Posted on <a rel="bookmark" href="#"><?php
									$date = new DateTime($majalah['tanggal_dibuat']);
									echo $date->format('d M y, H:i:s');
								?></a></span>
								<span class="byline"> by <span class="author vcard"><a href="#"><?= $majalah['username'] ?></a></span></span>
							</div><!-- .post-meta -->
						</div><!-- .entry-meta -->
								<p><?= $majalah['deskripsi'] ?></p>
								
		</div><!-- .entry-content -->
							
	</div>
</div>

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