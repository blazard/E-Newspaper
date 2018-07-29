<?php
ob_start();
// get url and make array of current url
$url=$_SERVER['REQUEST_URI'];
$breakUrl=explode('/',$url);
require('front-functions.php');
$urls=get_urls();
	// echo '<pre>';
	// print_r($urls);
	// echo '</pre>';
	// die;
	// $breadCrumbs=showBreadcrumbs();
	// print_r($breadCrumbs);
	// die;
?>
<!doctype html>
<html>
	<head>
		<title>Egalitarian News</title>
		<link rel="stylesheet" type="text/css" href="<?php echo $urls->home_url; ?>/lib/jquery.bxslider/jquery.bxslider.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo $urls->home_url; ?>/lib/fancybox/source/jquery.fancybox.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo $urls->home_url; ?>/fonts/font-awesome-4.2.0/css/font-awesome.min.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo $urls->home_url; ?>/lib/bootstrap/css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo $urls->home_url; ?>/style.css" />
	</head>
	<body>
		<div id="topbar" class="container-fluid"><!-- Top Bar Start -->
			<div class="container topbar-container"><!-- Top Bar Container Start -->
				<div class="topbar-wrapper"><!-- Top Bar Wrapper Start -->
					<div class="col-md-6 col-sm-8 topbar-menu"><!-- Top Bar Menu Start -->
						<div class="row topmenu-wrapper">
							<ul>
								<li><a href="<?php echo $urls->home_url; ?>">Home</a></li>
							<?php 
							if(!in_array('epaper',$breakUrl)){
								$categories=fetchCategories($catid=0);
								// echo '<pre>';
								// print_r($categories);
								// echo '</pre>';
								// die;
								if($categories==true){
									for($i=0; $i<sizeof($categories['id']); $i++){
									?>
										<li><a href="<?php echo $urls->home_url; ?>/news-category/<?php echo $categories['id'][$i]; ?>"><?php echo trim($categories['categories'][$i]); ?></a></li>
										<?php
									}
								}
							}
							?>
							</ul>
						</div>
					</div><!-- Top Bar Menu End -->
					<div class="col-md-2 epaper"><!-- E Paper Start -->
						<div class="row epaper-wrapper">
							<a class="epaper-block" href="<?php echo $urls->home_url.'/epaper/'; ?>">e-Paper</a>
						</div>
					</div><!-- E Paper End -->
					<div class="col-md-4 topbar-social"><!-- Top Bar Social Icons -->
						<ul class="pull-right">
							<li><a href="#"><i class="fa fa-facebook topicons"></i></a></li>
							<li><a href="#"><i class="fa fa-twitter topicons"></i></a></li>
							<li><a href="#"><i class="fa fa-google-plus topicons"></i></a></li>
							<li><a href="#"><i class="fa fa-youtube topicons"></i></a></li>
							<li><a href="#"><i class="fa fa-pinterest topicons"></i></a></li>
							<li><a href="#"><i class="fa fa-envelope topicons"></i></a></li>
						</ul>
					</div><!-- Top Bar Social Icons -->
				</div><!-- Top Bar Wrapper Start -->
			</div><!-- Top Bar Container End -->
		</div><!-- Top Bar Start -->
		<div id="maincontainer" class="container-fluid"><!-- Main Container start -->
			<div class="container maincontainer-wrapper"><!-- Main Container wrapper start -->
				<div class="row"><!-- Logo Row start -->
					<div class="col-md-2 leftad">
						<div class="logoad">
							<?php
								$banner=getBanners('top-left');
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
				</div>
					<div class="col-md-8"><div class="row logorow"><a href="<?php echo $urls->home_url; ?>"><img src="<?php echo $urls->home_url; ?>/images/logo_03.jpg" /></a></div></div>
					<div class="col-md-2 leftad">
						<div class="logoad pull-right">
							<?php
								$banner=getBanners('top-right');
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
					</div>
				</div><!-- Logo Row end -->
				<div class="row breakingnewsrow"><!-- Breaking News Row Start -->
					<span class="breaking-heading">Breaking News :</span>
					<span class="breaking-text">
						<marquee class="animatebreaking" mouseover="this.stop()">
								<?php
								// Fetch Breaking News 
								$breakingNews=fetchBreakingNews($catid=0);
								// echo '<pre>';
								// print_r($breakingNews);
								// echo '</pre>';
								// die;
								for($br=0; $br<count($breakingNews['news_id']);$br++){
								?>
								<li><a href="<?php echo $urls->home_url.'/single-news/'.$breakingNews['news_id'][$br]; ?>"><?php echo $breakingNews['news_title'][$br]; ?></a></li>
								<?php	}	?>
						</marquee>
					</span>
				</div><!-- Breaking News Row End -->
				<div class="breadCrumbs"><!-- BreadCrumbs Start -->
					<?php
						echo breadcrumbs();
					?>
				</div><!-- BreadCrumbs End-->