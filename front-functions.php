<?php
	session_start();
	// Include Database Connectivity
	include('xelcms/dzinclude/dbconnect.inc.php');
	// Define Some Constants
	define('MAIN_CATEGORY','categories');
	define('NEWS','news');
	define('COMMENTS','comments');
	define('BANNERS','banners');
	define('EPAPER','epaper');

	// Fetch Categories For making Menu
	function fetchCategories($catid){
		$cats=array();
		if($catid==0){
			$fetchCategories=mysqli_query($GLOBALS['dbcnx'],"SELECT id,catname FROM ".MAIN_CATEGORY." ORDER BY catsort asc LIMIT 6");
		}else{
			$fetchCategories=mysqli_query($GLOBALS['dbcnx'],"SELECT id,catname FROM ".MAIN_CATEGORY." WHERE id='$catid' ORDER BY catsort asc LIMIT 6");
		}
		if(mysqli_num_rows($fetchCategories)>0){
			while($data=mysqli_fetch_array($fetchCategories)){
				$cats['categories'][]=$data['catname'];
				$cats['id'][]=$data['id'];
				$cats['bool']=true;
			}
		}else{
			$cats['bool']=false;
		}
		return $cats;
	}


	// Some Specific Urls
	function get_urls(){
		$urls=new stdClass();
		$protocol='http://';
		$server=$_SERVER['SERVER_NAME'];
		$urls->home_url=$protocol.$server.'/elg';
		$urls->admin_url=$protocol.$server.'/elg/xelcms';
		$urls->news=$protocol.$server.'/elg/xelcms/news';
		$urls->epaper=$protocol.$server.'/elg/xelcms/epaper';
		$urls->epapers=$protocol.$server.'/elg/epaper';
		$urls->banners=$protocol.$server.'/elg/xelcms/ad-banners';
		return $urls;
	}

	// Fetch Some Subpart of News
	function getLatestNews($orderby,$start,$limit){
		$newsRes=array();
		$fetchNews=mysqli_query($GLOBALS['dbcnx'],"SELECT id, cat_id, news_title, LEFT(news_content,50),news_image FROM ".NEWS." ORDER BY id $orderby LIMIT $start, $limit");
		if(mysqli_num_rows($fetchNews)>0){
			$newsRes['bool']=true;
			while($newsData=mysqli_fetch_array($fetchNews)){
				$newsRes['news_id'][]=$newsData['id'];
				$newsRes['news_title'][]=$newsData['news_title'];
				$newsRes['news_content'][]=$newsData['LEFT(news_content,50)'];
				$newsRes['news_images'][]=$newsData['news_image'];
				$newsRes['news_catid'][]=$newsData['cat_id'];
				// $newsRes['all']=$newsData;
			}
		}else{
			$newsRes['bool']=false;
			$newsRes['msg']='No News Found';
		}
		return $newsRes;
	}

	// Fetch total news in the news table
	function all_news(){
		$res=array();
		$allnewQuery=mysqli_query($GLOBALS['dbcnx'],"SELECT * FROM ".NEWS);
		$allNewsDataCount=mysqli_num_rows($allnewQuery);
		return $allNewsDataCount;
	}

	// Fetch Single News
	function singleNews($newsid){
		$singlenewsRes=array();
		$singleNews=mysqli_query($GLOBALS['dbcnx'],"SELECT * FROM ".NEWS." WHERE id='$newsid'");
		if(mysqli_num_rows($singleNews)>0){
			$singlenewsRes['bool']=true;
			$singleNewsData=mysqli_fetch_array($singleNews);
			$singlenewsRes['newscontent']=$singleNewsData;
		}else{
			$singlenewsRes['bool']=false;
		}
		return $singlenewsRes;
	}

	// Fetch Breaking News
	function fetchBreakingNews($catid){
		$breakingRes=array();
		if($catid==0){
			$breakingNews=mysqli_query($GLOBALS['dbcnx'],"SELECT id,news_title,news_image,LEFT(news_content,100) FROM ".NEWS." WHERE is_breaking=1 ORDER BY id desc LIMIT 3");
		}else{
			$breakingNews=mysqli_query($GLOBALS['dbcnx'],"SELECT id,news_title,news_image,LEFT(news_content,100) FROM ".NEWS." WHERE is_breaking=1 AND cat_id='$catid' ORDER BY id desc LIMIT 3");
		}
		if(mysqli_num_rows($breakingNews)>0){
			$breakingRes['bool']=true;
			while($breakingNewsData=mysqli_fetch_array($breakingNews)){
				$breakingRes['news_id'][]=$breakingNewsData['id'];
				$breakingRes['news_title'][]=$breakingNewsData['news_title'];
				$breakingRes['news_image'][]=$breakingNewsData['news_image'];
				$breakingRes['news_content'][]=$breakingNewsData['LEFT(news_content,100)'];
			}
		}else{
			$breakingRes['bool']=false;
			$breakingRes['msg']='No Breaking News Yet!';
		}
		return $breakingRes;
	}

	// Fetch Breaking News According to Category
	function fetchBreakingNewsCategory($catid){
		$breakingRes=array();
		$breakingNews=mysqli_query($GLOBALS['dbcnx'],"SELECT id,news_title FROM ".NEWS." WHERE cat_id='$catid' AND is_breaking=1 ORDER BY id desc");
		if(mysqli_num_rows($breakingNews)>0){
			$breakingRes['bool']=true;
			while($breakingNewsData=mysqli_fetch_array($breakingNews)){
				$breakingRes['news_id'][]=$breakingNewsData['id'];
				$breakingRes['news_title'][]=$breakingNewsData['news_title'];
			}
		}else{
			$breakingRes['bool']=false;
			$breakingRes['msg']='No Breaking in this category!';
		}
		return $breakingRes;
	}

	// Fetch Top Story News
	function fetchTopStory($catid){
		$topstoryRes=array();
		if($catid==0){
			$topStory=mysqli_query($GLOBALS['dbcnx'],"
				SELECT id,news_title,news_image, LEFT(news_content,200) FROM ".NEWS." 
				WHERE is_topstory=1
				ORDER BY news_time desc
				");
		}else{
			$topStory=mysqli_query($GLOBALS['dbcnx'],"
				SELECT id,news_title,news_image, LEFT(news_content,200) FROM ".NEWS." 
				WHERE is_topstory=1 AND cat_id='$catid'
				ORDER BY news_time desc
				");
		}
		
		if(mysqli_num_rows($topStory)>0){
			$topstoryRes['bool']=true;
			while($topstoryData=mysqli_fetch_array($topStory)){
				$topstoryRes['news_id'][]=$topstoryData['id'];
				$topstoryRes['news_title'][]=$topstoryData['news_title'];
				$topstoryRes['news_image'][]=$topstoryData['news_image'];
				$topstoryRes['news_content'][]=$topstoryData['LEFT(news_content,200)'];
			}
		}else{
			$topstoryRes['bool']=false;
			$topstoryRes['msg']='No Top Story Yet!';
		}
		return $topstoryRes;
	}

	// BreadCrumbs
	// function showBreadcrumbs(){
	// 	$current_page=$_SERVER['PHP_SELF'];
	// 	return $current_page;
	// }

	// Fetch Category Wise Top Stories
	function CategoryWiseTopStories($limit){
		$topNewsCat=array();
		$fetchcategories=mysqli_query($GLOBALS['dbcnx'],"
			SELECT news.id as news_id,cat_id,catname,news_title,news_image FROM categories,news
			WHERE categories.id=news.cat_id AND 
			news.is_topstory=1
			GROUP BY news_id
			ORDER BY news_id desc
			LIMIT $limit
			");
		if(mysqli_num_rows($fetchcategories)>0){
			while($fetchcategoriesData=mysqli_fetch_array($fetchcategories)){
				$topNewsCat['news_id'][]=$fetchcategoriesData['news_id'];
				$topNewsCat['cat_id'][]=$fetchcategoriesData['cat_id'];
				$topNewsCat['catname'][]=$fetchcategoriesData['catname'];
				$topNewsCat['news_title'][]=$fetchcategoriesData['news_title'];
				$topNewsCat['news_image'][]=$fetchcategoriesData['news_image'];
			}
			$topNewsCat['bool']=true;
		}else{
			$topNewsCat['bool']=false;
			$topNewsCat['msg']='No top story news found';
		}
		return $topNewsCat;
	}

	// Fetch E-Paper News
	function fetchEpaperNews(){
		$resImg=array();
		$epaperQuery=mysqli_query($GLOBALS['dbcnx'],"SELECT * FROM ".EPAPER." WHERE epaper_status='1'");
		if(mysql_num_rows($epaperQuery)>0){
			$resImg['bool']=true;
			while($data=mysqli_fetch_array($epaperQuery)){
				$resImg['epaper_id'][]=$data['id'];
				$resImg['epaper_date'][]=$data['epaper_date'];
				$resImg['epaper_images'][]=$data['epaper_images'];
			}
		}else{
			$resImg['bool']=false;
			$resImg['msg']='No Epaper Yet!';
		}
		return $resImg;
	}

	// fetch Specific Date E-Paper News
	function fetchEpaperNewsSpecific($eid){
		$resImg=array();
		$epaperQuery=mysqli_query($GLOBALS['dbcnx'],"SELECT * FROM ".EPAPER." WHERE id='$eid'");
		if($epaperQuery){
			$resImg['bool']=true;
			while($data=mysqli_fetch_array($epaperQuery)){
				$resImg['epaper_id'][]=$data['id'];
				$resImg['epaper_date'][]=$data['epaper_date'];
				$resImg['epaper_images'][]=$data['epaper_images'];
			}
		}else{
			$resImg['bool']=false;
			$resImg['msg']=mysqli_error();
		}
		return $resImg;
	}

	// Add Comments
	function addComment($commentData){
		$cmntRes=array();
		$news_id=$commentData['newsid'];
		$comment_msg=$commentData['comment_msg'];
		$comment_subject=$commentData['comment_subject'];
		$comment_email=$commentData['comment_email'];
		$comment_name=$commentData['comment_name'];
		$commentQuery=mysqli_query($GLOBALS['dbcnx'],"INSERT INTO ".COMMENTS." (news_id,comment_name,comment_email,comment_subject,comment_text) VALUES ('$news_id','$comment_name','$comment_email','$comment_subject','$comment_msg')");
		if($commentQuery){
			$cmntRes['bool']=true;
		}else{
			$cmntRes['bool']=false;
			$cmntRes['msg']=mysqli_error();
		}
		return $cmntRes;
	}

	// Fetch Comments
	function get_all_comments($newsID){
		$res=array();
		$commentQuery=mysqli_query($GLOBALS['dbcnx'],"SELECT * FROM ".COMMENTS." WHERE news_id='$newsID' AND status='1'");
		if(mysqli_num_rows($commentQuery)>0){
			$res['bool']=true;
			while($commentData=mysqli_fetch_array($commentQuery)){
				$res['commentData'][]=$commentData;
			}
		}else{
			$res['bool']=false;
		}
		return $res;
	}

	// BreadCrumbs
	function breadcrumbs($separator = ' / ', $home = 'Home') {
		$path = array_filter(explode('/', $_SERVER['REQUEST_URI']));
		
		$breadcrumbs = array(''.$home.'');
		$last =end(array_keys($path));
		foreach ($path as $x => $crumb) {
		$title = ucwords(str_replace(array('.php', '_', '-'), array('', ' ', ' '), $crumb));
		if ($x!= $last){
			$breadcrumbs[] = ''.$title.'';
			}
			else{
			$breadcrumbs[] = ''.$title.'';
			}
		}
		
		return implode($separator, $breadcrumbs);
	}

	// Fetch random news images
	function fetchImagesNews(){
		$res=array();
		$query=mysqli_query($GLOBALS['dbcnx'],"SELECT news_image FROM ".NEWS." ORDER BY rand() LIMIT 15");
		if(mysqli_num_rows($query)>0){
			$res['bool']=true;
			while($newsimages=mysqli_fetch_array($query)){
				$res['news_images'][]=$newsimages['news_image'];
			}
		}else{
			$res['bool']=false;
			$res['msg']=mysqli_error();
		}
		return $res;
	}

	// Fetch Banners From database
	function getBanners($loc){
		$getRes=array();
		$getBanners=mysqli_query($GLOBALS['dbcnx'],"SELECT * FROM ".BANNERS." WHERE banner_loc='$loc' AND banner_status='1'");
		if(mysqli_num_rows($getBanners)>0){
			$getRes['bool']=true;
			$data=mysqli_fetch_array($getBanners);
			$getRes['banner']=$data;
		}else{
			$getRes['bool']=false;
			$getRes['msg']='No Banner for this location';
		}
		return $getRes;
	}
?>