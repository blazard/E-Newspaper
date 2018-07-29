<?php include 'header.php'; ?>
				<div class="newscontent"><!-- News Content Start -->
					<div class="col-md-4 newscontent-left"><!-- News Content Left Start -->
						<?php include 'left-sidebar.php'; ?>
					</div><!-- News Content Left End -->
					<div class="col-md-7 col-md-offset-1 newscontent-right"><!-- News Content Right start -->
						<div class="topnews rightcontent row"><!-- Top News Start -->
							<?php
								// Top Story
								$topStory=fetchTopStory($catid=0);
								if($topStory['bool']==true){
								// echo '<pre>';
								// print_r($topStory);
								// echo '</pre>';
								// die;
							?>
							<div class="col-md-5 topnews-img"><div class="row"><a href="<?php echo $urls->home_url.'/single-news.php?newsid='.$topStory['news_id'][0]; ?>"><img src="<?php echo $urls->news.'/news_images/'.$topStory['news_image'][0]; ?>"></a></div></div>
							<div class="col-md-7 topnews-content">
								
								<h3><a href="<?php echo $urls->home_url.'/single-news.php?newsid='.$topStory['news_id'][0]; ?>"><?php echo $topStory['news_title'][0]; ?></a></h3>
								<p><?php echo $topStory['news_content'][0];?></p>
								<p class="topStoryreadMore">
									<a href="<?php echo $urls->home_url.'/single-news/'.$topStory['news_id'][0]; ?>">Read More..</a>
								</p>
								</div>
								<?php
									}else{
										echo '<h4>'.$topStory['msg'].'</h4>';
									}
								?>
						</div><!-- Top News End -->
						<div class="row topnews-adblock"><!-- #adblock -->
							<?php
								$banner=getBanners('middle');
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
						</div><!-- #adblock -->
						<div class="row rightnews-tabs"><!-- Right News Tabs Start -->
							<div class="col-md-6 tabs-container"><!-- News Tabs -->
								<div class="row" id="newstabs">
									<div role="tabpanel"><!-- Tab Panel -->
									  <!-- Nav tabs -->
									  <ul class="nav nav-tabs" role="tablist">
									    <li role="presentation" class="active"><a href="#topnews" aria-controls="topnews" role="tab" data-toggle="tab">Top News</a></li>
									    <li role="presentation">
									    	<a href="#latestnews" aria-controls="latestnews" role="tab" data-toggle="tab">Latest News
									    		<!-- <i class="fa fa-circle latestnews-notification"></i>
									    		 <span class="latestnews-notification-count">2</span> -->
									    	</a>
									   </li>

									    <!-- <li role="presentation"><a href="#mynews" aria-controls="mynews" role="tab" data-toggle="tab">My News</a></li> -->
									  </ul>
									  <!-- Tab panes -->
									  <div class="tab-content">
									    <div role="tabpanel" class="tab-pane active" id="topnews">
									    	<ol>
									    		<?php
									    			$topStory=fetchTopStory($catid=0);
									    			if($topStory['bool']==true){
									    				for($top=0; $top<count($topStory['news_id']); $top++){
									    				?>
									    				<li><a href="<?php echo $urls->home_url.'/single-news/'.$topStory['news_id'][$top]; ?>"><?php echo $topStory['news_title'][$top]; ?></a></li>
									    				<?php
									    				}// end forloop
									    			}else{
									    				echo $topStory['msg'];
									    			}
									    			// echo '<pre>';
									    			// print_r($topStory);
									    			// echo '</pre>';
									    			// die;
									    		?>
										    	
										    </ol>
									    </div>
									    <div role="tabpanel" class="tab-pane" id="latestnews">
									    	<ol>
									    		<?php
									    		$latestNews=getLatestNews('asc',0,10);
									    			if($latestNews['bool']==true){
									    				for($ln=0; $ln<count($latestNews['news_id']); $ln++){
									    				?>
									    				<li><a href="<?php echo $urls->home_url.'/single-news/'.$latestNews['news_id'][$ln]; ?>"><?php echo $latestNews['news_title'][$ln]; ?></a></li>
									    				<?php
									    				}// end forloop
									    			}else{
									    				echo $latestNews['msg'];
									    			}
									    			// echo '<pre>';
									    			// print_r($topStory);
									    			// echo '</pre>';
									    		// die;
									    		?>
										    </ol>
									    </div>
									   <!--  <div role="tabpanel" class="tab-pane" id="mynews">
									    	<li><a href="#">Magnitude 5.9 earthquake hits Japan: USGS</a></li>
									    	<li><a href="#">Magnitude 5.9 earthquake hits Japan: USGS</a></li>
									    	<li><a href="#">Magnitude 5.9 earthquake hits Japan: USGS</a></li>
									    	<li><a href="#">Magnitude 5.9 earthquake hits Japan: USGS</a></li>
									    	<li><a href="#">Magnitude 5.9 earthquake hits Japan: USGS</a></li>
									    	<li><a href="#">Magnitude 5.9 earthquake hits Japan: USGS</a></li>
									    	<li><a href="#">Magnitude 5.9 earthquake hits Japan: USGS</a></li>
									    	<li><a href="#" class="imp">Magnitude 5.9 earthquake hits Japan: USGS</a></li>
									    	<li><a href="#">Magnitude 5.9 earthquake hits Japan: USGS</a></li>
									    	<li><a href="#">Magnitude 5.9 earthquake hits Japan: USGS</a></li>
									    	<li><a href="#" class="imp">Magnitude 5.9 earthquake hits Japan: USGS</a></li>
									    	<li><a href="#">Magnitude 5.9 earthquake hits Japan: USGS</a></li>
									    	<li><a href="#">Magnitude 5.9 earthquake hits Japan: USGS</a></li>
									    	<li><a href="#">Magnitude 5.9 earthquake hits Japan: USGS</a></li>
									    	<li><a href="#">Magnitude 5.9 earthquake hits Japan: USGS</a></li>
									    </div> -->
									  </div>
									</div><!-- #Tab Panel End -->
								</div>
								<!-- <p class="tabs-readmore"><a href="#"><i class="fa fa-angle-double-right"></i>&nbsp;More From <span>Top News</span></a></p> -->
							</div><!-- #news tabs end -->
							<div class="col-md-6 tabs-adblock">
								<?php
								$banner=getBanners('with_tabs');
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
						</div><!-- Right News Tabs End -->
					</div><!-- News Content Right end -->
				</div><!-- News Content End -->
			</div><!-- Main Container wrapper end -->
		</div><!-- Main Container end -->
		<div class="newscategory container-fluid"><!-- News Category Start -->
			<div class="container newcategory-container">
				<div class="row newcategory-wrapper"><!-- News Category Wrapper Start -->
					<?php
						// Fetch top stories for diffrent category.
						$topNewsCat=CategoryWiseTopStories($limit=6);
						// echo '<pre>';
						// print_r($topNewsCat);
						// echo '</pre>';
						// die;
						if($topNewsCat['bool']==true){
							for($tcn=0; $tcn<count($topNewsCat['news_id']); $tcn++){
								?>
									<div class="col-md-2 singlenews-category">
										<div class="newscategory-content">
											<h3><a href="#"><?php echo $topNewsCat['catname'][$tcn]; ?></a></h3>
											<p><a href="<?php echo $urls->home_url.'/single-news/'.$topNewsCat['news_id'][$tcn]; ?>"><img src="<?php echo $urls->news.'/news_images/'.$topNewsCat['news_image'][$tcn];?>" /></a></p>
											<p class="newscat-desc"><?php echo $topNewsCat['news_title'][$tcn]; ?></p>
										</div>
									</div>
								<?php
							}
						}else{
							echo '<h4><i class="fa fa-ban"></i> No Top Stories Found Yet!</h4>';
						}
					?>
				</div><!-- News Category Wrapper End -->
			</div>
		</div><!-- News Category End -->
		<?php include 'footer.php'; ?>