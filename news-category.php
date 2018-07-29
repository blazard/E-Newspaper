<?php include 'header.php'; ?>
<?php
// Making Check for news category page so that nobody can access this page directly
	if(isset($_GET['cat_id'])){
		$catid=$_GET['cat_id'];
		if(is_numeric($catid)){
		$catNews=fetchCategories($catid);
		if($catNews['bool']==false){
			echo '<h4>This is not valid Category.</h4>';
			exit();
		}
		// echo '<pre>';
		// print_r($pNews);
		// echo '</pre>';
		// die;
	}else{
		echo '<h4>This is not valid category.</h4>';
		die;
	}
}else{
	header("location:404.php");
}
?>
				<div class="newscontent"><!-- News Content Start -->
					<div class="col-md-4 newscontent-left"><!-- News Content Left Start -->
						<?php include 'left-sidebar.php'; ?>
					</div><!-- News Content Left End -->
					<div class="col-md-7 col-md-offset-1 newscontent-right"><!-- News Content Right start -->
						<div class="topnews rightcontent row"><!-- Top News Start -->
							<?php
									// Top Story
									if(isset($_GET['cat_id'])){
										$catid=$_GET['cat_id'];
										if(is_numeric($catid)){
											$topStory=fetchTopStory($catid);
											if($topStory['bool']==true){

										// echo '<pre>';
										// print_r($topStory);
										// echo '</pre>';
										// die;
								?>
							<div class="col-md-5 topnews-img"><div class="row">
								<a href="<?php echo $urls->home_url.'/single-news/'.$topStory['news_id'][0]; ?>"><img src="<?php echo $urls->news.'/news_images/'.$topStory['news_image'][0]; ?>"></a></div></div>
							<div class="col-md-7 topnews-content">
								
								<h3><a href="<?php echo $urls->home_url.'/single-news/'.$topStory['news_id'][0]; ?>"><?php echo $topStory['news_title'][0]; ?></a></h3>
								<p><?php echo $topStory['news_content'][0];?></p>
								<p class="topStoryreadMore"><a href="<?php echo $urls->home_url.'/single-news/'.$topStory['news_id'][0]; ?>">Read More..</a></p>
								</div>
								<?php
									}else{
										echo '<h4>'.$topStory['msg'].'</h4>';
									}
									}else{
											echo '<h4>Category is not valid</h4>';
										}
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
								<div class="row">
								<ul class="category-topstory">
									<?php
										$NewsRes=fetchTopStory($catid);
										// echo '<pre>';
										// print_r($NewsRes);
										// echo '</pre>';
										// die;
										if($NewsRes['bool']==true){
											for($ts=0; $ts<count($NewsRes['news_id']); $ts++){
									?>
									<li>
										<div class="categorytopstory-img categorytopstory-content">
											<a href="<?php echo $urls->home_url.'/single-news/'.$NewsRes['news_id'][$ts]; ?>">
												<img src="<?php echo $urls->news.'/news_images/'.$NewsRes['news_image'][$ts]; ?>" />
											</a>
										</div>
										<div class="categorytopstory-text categorytopstory-content">
											<?php echo substr($NewsRes['news_title'][$ts],0,50); ?>
										</div>
										<div class="clearfix"></div>
									</li>
									<?php 
								}
								}else{
									echo '<h4>No Top Story Yet!</h4>';
								}
								?>
								</ul>
							</div>
							</div><!-- #news tabs end -->
							<div class="col-md-6 tabs-adblock">
								<img src="<?php echo $urls->home_url; ?>/images/tabs-ad_03.jpg" />
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