<?php include 'header.php'; ?>
	<div class="single-wrapper row"><!-- Single News Wrapper -->
		<div class="col-md-8 single-left"><!-- Single Left -->
			<div class="singleleft-wrapper"><!-- Single Left Wrapper Start -->
				<ul>
					<?php
						$limit=2;
						if(!isset($_GET['page']) || $_GET['page']==1){
							$start=0;
						}else{
							$page=$_GET['page']-1;
							$start=$page*$limit;
						}
						$latestNews=getLatestNews('desc',$start,$limit);
						// echo '<pre>';
						// print_r($newsCount);
						// echo '</pre>';
						// die;
						for($li=0; $li<count($latestNews['news_id']);$li++){
					?>
					<li>
						<p class="singlenews-textImg">
							<a href="<?php echo $urls->home_url.'/single-news/'.$latestNews['news_id'][$li]; ?>"><img src="<?php echo $urls->news.'/news_images/'.$latestNews['news_images'][$li]; ?>" id="singlenewsImg" align="left" /></a>
							<span class="singlenews-heading singlenews-content">
								<span class="singlenews-heading singlenews-content">
									<a href="<?php echo $urls->home_url.'/single-news/'.$latestNews['news_id'][$li]; ?>"><?php echo $latestNews['news_title'][$li]; ?></a></span>
								<span class="singlenews-meta singlenews-content">
									BY <a href="#" class="newsby singlenews-metalinks">Sikh24 Editor</a> / <span class="newsdate singlenews-metalinks">December 20, 2014</span>
								</span>
								<span class="singlenews-maintext singlenews-content"><?php echo substr($latestNews['news_content'][$li],0,250); ?></span>
		<span class="singlenews-text"><?php echo substr($latestNews['newscontent']['news_content'],250); ?></span>
							</span>
						</p>
					</li>
					<div class="clearfix"></div>
					<?php
				}
				?>
				</ul>
			</div><!-- Single Left Wrapper End -->
			<div class="paginationWrapper">
				<ul>
					<?php
						$newsCount=all_news();
						$showNews=5;
						$paginationNum=ceil($newsCount/2);
						$currentPage=$_GET['page'];
						if($currentPage==''){
							$currentPage=1;
						}
						// $currentTotal=$currentPage*$showNews;
						// echo '<li class="leftFirst">'.$currentTotal.' of '.$newsCount.'</li>';
						for($page=1; $page<=$paginationNum; $page++){
							if($currentPage==$page){
								$class="activePage";
							}else{
								$class="";
							}
							echo '<li class="'.$class.'"><a href="'.$urls->home_url.'/latest-news/page/'.$page.'">'.$page.'</a></li>';
						}
					?>
				</ul>
			</div>
		</div><!-- Single Left -->
		<div class="col-md-4 single-right right-sidebar"><!-- Right Sidebar Start -->
			<?php include 'right-sidebar.php'; ?>
		</div><!-- Right Sidebar End -->
	</div><!-- Single News Wrapper -->
<?php include 'footer.php'; ?>