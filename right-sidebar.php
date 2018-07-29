			<div class="rightsidebar-wrapper"><!-- Right Sidebar Wrapper Start -->
				<h1><span class="redtext">Latest</span> News</h1>
				<?php
					// Fetch Recent News
					$newsdata=getLatestNews('desc',$start=0,$limit=4);
					// echo '<pre>';
					// print_r($newsdata);
					// echo '</pre>';
					// die;
					for($news=0; $news<count($newsdata['news_id']); $news++):
						?>
						<div class="rightsidebar">
							<h2><a href="<?php echo $urls->home_url.'/single-news/'.$newsdata['news_id'][$news]; ?>"><?php echo $newsdata['news_title'][$news]; ?></a></h2>
							<div class="col-md-5"><div class="row"><a href="<?php echo $urls->home_url.'/single-news/'.$newsdata['news_id'][$news]; ?>"><img src="<?php echo $urls->news.'/news_images/'.$newsdata['news_images'][$news]; ?>" /></a></div></div>
							<div class="col-md-7"><div class="row"><span><?php echo $newsdata['news_content'][$news]; ?></span></div></div>
							<div class="clearfix"></div>
							<!-- <p class="newscontent-meta"><i class="fa fa-video-camera metaicon"></i><a href="#" class="metacontent">Queensland woman in hospital after children stabbed</a></p> -->
						</div>
						<?php
					endfor;
				?>
				<p class="latestnews-readmore"><a href="<?php echo $urls->home_url.'/latest-news/'; ?>">Learn More News</a></p>

				<div class="rightsidebar right-adblock2">
					<?php
						$banner=getBanners('right-up');
						if($banner['bool']==true){
						// echo '<pre>';
						// print_r($banner);
						// echo '</pre>';
						// die();
					?>
							<a href="<?php echo $banner['banner']['banner_url']; ?>"><img src="<?php echo $urls->banners.'/banner_images/'.$banner['banner']['banner_img']; ?>" /></a>
						<?php
						}else{
							?>
						<p>No Banner Yet.</p>
						<?php } ?>
				</div>

				<div class="rightsidebar right-adblock2">
					<h1><span class="redtext">Picture</span> Gallery</h1>
					<ul class="bxslider">
						<?php
						$images=fetchImagesNews();
						// echo '<pre>';
						// print_r($images);
						// echo '</pre>';
						// die;
						if($images['bool']==true){
							for($im=0; $im<count($images['news_images']);$im++){
								?>
								<li><img src="<?php echo $urls->news;?>/news_images/<?php echo $images['news_images'][$im]; ?>" /></li>
								<?php
							}
						}else{
							echo $images['msg'];
						}
						?>
					</ul>
				</div>

				<div class="rightsidebar right-adblock2">
					<?php
								$banner=getBanners('right-down');
								if($banner['bool']==true){
								// echo '<pre>';
								// print_r($banner);
								// echo '</pre>';
								// die();
								?>
							<a href="<?php echo $banner['banner']['banner_url']; ?>"><img src="<?php echo $urls->banners.'/banner_images/'.$banner['banner']['banner_img']; ?>" /></a>
						<?php
						}else{
							?>
						<p>No Banner Yet.</p>
						<?php } ?>
				</div>

			</div><!-- Right Sidebar Wrapper End -->