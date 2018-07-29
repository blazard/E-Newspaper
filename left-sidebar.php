					<!-- <div class="row leftside-content firstleft-content">
							<h2><a href="#">Obama on North Korea: &#39;Sony made a mistakeorea&#39; :</a></h2>
							<div class="col-md-5"><div class="row"><a href="#"><img src="images/1.jpg" /></a></div></div>
							<div class="col-md-7"><div class="row"><span>Australian police consider charges against 37-year-old, mother to seven of eight children stabbed to death</span></div></div>
							<div class="clearfix"></div>
							<p class="newscontent-meta"><i class="fa fa-comments metaicon"></i><a href="#" class="metacontent">Queensland woman in hospital after children stabbed</a></p>
							<ul class="firstcontent">
								<li><i class="fa fa-circle"></i> &nbsp;<a href="#"><b>One subplot in Sony&#39;s trobled big picture</b></a></li>
								<li><i class="fa fa-circle"></i> &nbsp;<a href="#"><b>One subplot in Sony&#39;s trobled big picture</b></a></li>
								<li><i class="fa fa-circle"></i> &nbsp;<a href="#">One subplot in Sony&#39;s trobled big picture</a></li>
								<li><i class="fa fa-circle"></i> &nbsp;<a href="#">One subplot in Sony&#39;s trobled big picture</a></li>
							</ul>
						</div> -->
						<?php
							// Fetch Breaking News according to category or recent breaking news
							if(isset($_GET['cat_id'])){
								$catid=$_GET['cat_id'];
								if(is_numeric($catid)){
									$breakingNews=fetchBreakingNews($catid);
								}else{
									echo 'h4>This is not valid category</h4>';
								}
							}else{
								$breakingNews=fetchBreakingNews($catid=0);
							}
							
							// echo '<pre>';
							// print_r($breakingNews);
							// echo '</pre>';
							// die;

							if($breakingNews['bool']==true){
							for($bn=0; $bn<count($breakingNews['news_id']); $bn++){
								?>
								<div class="row leftside-content">
									<h2><a href="<?php echo $urls->home_url.'/single-news/'.$breakingNews['news_id'][$bn]; ?>"><?php echo $breakingNews['news_title'][$bn]; ?></a></h2>
									<div class="col-md-5"><div class="row">
										<a href="<?php echo $urls->home_url.'/single-news/'.$breakingNews['news_id'][$bn]; ?>">
											<img src="<?php echo $urls->news.'/news_images/'.$breakingNews['news_image'][$bn]; ?>" />
										</a>
									</div>
								</div>
									<div class="col-md-7">
										<div class="row">
											<span><?php echo $breakingNews['news_content'][$bn]; ?></span>
										</div>
									</div>
									<div class="clearfix"></div>
									<!-- <p class="newscontent-meta"><i class="fa fa-video-camera metaicon"></i><a href="#" class="metacontent">Queensland woman in hospital after children stabbed</a></p> -->
								</div>
								<?php
							}
						}else{
							echo '<h4>No Breaking News Found.</h4>';
						}
						?>