<?php
	
	// Include DataBase
	require '../dzinclude/dbconnect.inc.php';

	// Define Table Name Here
	define('MAIN_CATEGORY','categories');
	define('NEWS','news');
	define('EPAPERIMG','epaper_images');
	define('EPAPER','epaper');
	define('COMMENTS','comments');
	define('BANNERS','banners');

	// File Uploading For Category Page
	function fileUploading($filedata){
		$res=array();
		$uploadingSize=1000;
		// Check folder is exist or not
		if(!empty($filedata['filename'])){
			if(file_exists($filedata['foldername'])){
				// Check file size that should not greater then 1MB.
				if($filedata['filesize']<=$uploadingSize){
					// Check file duplicate
					if(file_exists($filedata['foldername'].'/'.$filedata['filename'])){
						$randomnum=rand(1,1000);
						$filerename=$randomnum.'_'.$filedata['userid'].'_'.$filedata['filename'];
						move_uploaded_file($filedata['tmpfile'],$filedata['foldername'].'/'.$filerename);
						$res['msg']='File Rename and uploaded';
						$res['filename']=$filerename;
						$res['bool']=true;
					}else{
						move_uploaded_file($filedata['tmpfile'],$filedata['foldername'].'/'.$filedata['filename']);
						$res['msg']='File uploaded';
						$res['filename']=$filedata['filename'];
						$res['bool']=true;
					}
				}else{
					$res['msg']='File Shouldn\'t be greater then 1MB.';
					$res['bool']=false;
				}
			}else{
				mkdir($filedata['foldername']);
				$res=fileUploading($filedata);
			}
		}else{
			$res['msg']='File is empty';
			$res['bool']=false;
		}
		return $res;
	} //End function


	// Check Category Duplicacy
	function checkCategory($catname){
		$query=mysql_query("SELECT id FROM ".MAIN_CATEGORY." WHERE catname='$catname'");
		if(mysql_num_rows($query)>0){
			$catres=true;
		}else{
			$catres=-false;
		}
		return $catres;
	}

	// Fetch Category
	function fetchCategories(){
		$cats=array();
		$fetchCategories=mysql_query("SELECT id,catname FROM ".MAIN_CATEGORY);
		if(mysql_num_rows($fetchCategories)>0){
			while($data=mysql_fetch_array($fetchCategories)){
				$cats['categories'][]=$data['catname'];
				$cats['id'][]=$data['id'];
				$cats['bool']=true;
			}
		}else{
			$cats['bool']=false;
		}
		return $cats;
	}

	// Add News
	function addNews($newsdata){
		$newsRes=array();
		$newscat=$newsdata['news_cat'];
		$newstitle=$newsdata['news_title'];
		$newscontent=$newsdata['news_content'];
		$newsimage=$newsdata['news_image'];
		$breaking=$newsdata['is_breaking'];
		$topstory=$newsdata['is_top_story'];
		$username=$newsdata['username'];
		$addnews=mysql_query("INSERT INTO ".NEWS." (cat_id,news_title,news_content,news_image,is_breaking,is_topstory,username) VALUES ('$newscat','$newstitle','$newscontent','$newsimage','$breaking','$topstory','$username')");
		if($addnews){
			$newsRes['bool']=true;
		}else{
			$newsRes['bool']=false;
		}
		return $newsRes;
	}


	// Add News
	function updateNews($newsdata){
		$newsRes=array();
		$newsid=$newsdata['news_id'];
		$newscat=$newsdata['news_cat'];
		$newstitle=$newsdata['news_title'];
		$newscontent=$newsdata['news_content'];
		$newsimage=$newsdata['news_image'];
		$breaking=$newsdata['is_breaking'];
		$topstory=$newsdata['is_top_story'];
		$updatenews=mysql_query("UPDATE ".NEWS." SET news_title='$newstitle',cat_id='$newscat',news_content='$newscontent',is_breaking='$breaking',is_topstory='$topstory' WHERE id='$newsid'");
		if($updatenews){
			$newsRes['bool']=true;
		}else{
			$newsRes['bool']=false;
		}
		return $newsRes;
	}

	// Fetch News Rows
	function fetchNewsRows($catid){
		if($catid==0){
			$fetchNews=mysql_query("SELECT id FROM ".NEWS);
		}else{
			$fetchNews=mysql_query("SELECT id FROM ".NEWS." WHERE cat_id='$catid'");
		}
		return mysql_num_rows($fetchNews);
	}

	// Fetch News Subpart
	function fetchNewsSubPart($start,$limit,$catid){
		$newsRes=array();
		if($catid==0){
			$fetchNews=mysql_query("SELECT id,cat_id, news_title,news_image, news_time FROM ".NEWS." LIMIT $start,$limit");
		}else{
			$fetchNews=mysql_query("SELECT id,cat_id, news_title,news_image, news_time FROM ".NEWS." WHERE cat_id='$catid' LIMIT $start,$limit");
		}
		
		if(mysql_num_rows($fetchNews)>0){
			$totalnews=mysql_num_rows($fetchNews);
			while($newsdata=mysql_fetch_array($fetchNews)){
				$newsRes['id'][]=$newsdata['id'];
				$newsRes['cat_id'][]=$newsdata['cat_id'];
				$newsRes['news_title'][]=$newsdata['news_title'];
				$newsRes['news_image'][]=$newsdata['news_image'];
				$newsRes['news_time'][]=$newsdata['news_time'];
				$newsRes['total']=$totalnews;
				$newsRes['bool']=true;
			}
		}else{
			$newsRes['msg']=mysql_error();
			$newsRes['bool']=false;
		}
		return $newsRes;
	}

	// Delete News
	function deleteNews($newsids){
		$delRes=array();
		for($i=0; $i<count($newsids); $i++){
			$newsid=$newsids[$i];
			$delQuery=mysql_query("DELETE FROM ".NEWS." WHERE id='$newsid'");
			if($delQuery){
			$delRes['bool']=true;
			}else{
				$delRes['bool']=false;
			}
		}
		return $delRes;
	}

	// News File Uploading
	function addNewsFile($filedata){
		$res=array();
		$uploadingSize=1000;
		// Check folder is exist or not
		if(!empty($filedata['filename'])){
			if(file_exists($filedata['foldername'])){
				// Check file size that should not greater then 1MB.
				if($filedata['filesize']<=$uploadingSize){
					// Check file duplicate
					if(file_exists($filedata['foldername'].'/'.$filedata['filename'])){
						$randomnum=rand(1,1000);
						$filerename=$randomnum.'_'.$filedata['userid'].'_'.$filedata['filename'];
						move_uploaded_file($filedata['tmpfile'],$filedata['foldername'].'/'.$filerename);
						$res['msg']='File Rename and uploaded';
						$res['filename']=$filerename;
						$res['bool']=true;
					}else{
						move_uploaded_file($filedata['tmpfile'],$filedata['foldername'].'/'.$filedata['filename']);
						$res['msg']='File uploaded';
						$res['filename']=$filedata['filename'];
						$res['bool']=true;
					}
				}else{
					$res['msg']='File Shouldn\'t be greater then 1MB.';
					$res['bool']=false;
				}
			}else{
				mkdir($filedata['foldername']);
				$res=addNewsFile($filedata);
			}
		}else{
			$res['bool']=true;
			$res['msg']='File is empty';
		}
		return $res;
	}


	// Fetch Specific News
	function FetchSpecificNews($newsid){
		$Newsres=array();
		$fetchNews=mysql_query("SELECT * FROM ".NEWS." WHERE id='$newsid'");
		if(mysql_num_rows($fetchNews)>0){
			$Newsres['bool']=true;
			$fetchNewsData=mysql_fetch_array($fetchNews);
			$Newsres=$fetchNewsData;
		}
		return $Newsres;
	}


	// Update News Image
	function updateNewsImage($file,$newsid){
		$updateRes=array();
		$updatequery=mysql_query("UPDATE ".NEWS." SET news_image='$file' WHERE id='$newsid'");
		if($updatequery){
			$updateRes['bool']=true;
		}else{
			$updateRes['bool']=false;
		}
		return $updateRes;
	}


	// Add Epaper Images
	// function epaperImages($data){

	// }

	// multiple File upload
	function multiplefileUpload($file_array,$folder){
		$res=array();
		if(!empty($folder)){
		if(file_exists($folder)){
			for($file=0; $file<count($file_array['filename']); $file++){
				if(file_exists($folder.'/'.$file_array['filename'][$file])){
					$random_num=rand(1,1000);
					$filename=$random_num.'_'.$file_array['filename'][$file];
					if(move_uploaded_file($file_array['filetmp'][$file],$folder.'/'.$filename)){
						$res['bool']=true;
						$res['filename'][]=$filename;
					}else{
						$res['bool']=false;
					}
				}else{
					$filename=$file_array['filename'][$file];
					if(move_uploaded_file($file_array['filetmp'][$file],$folder.'/'.$filename)){
						$res['bool']=true;
						$res['filename'][]=$filename;
					}else{
						$res['bool']=false;
					}
				}
			}
		}else{
			mkdir($folder);
			$res=multiplefileUpload($file_array,$folder);
		}
	}else{
		$res['bool']=false;
		$res['msg']="Please Provide Date";
	}
		return $res;
	}

	// Add Multiple images in Database
	function addmultipleImages($filename,$folder){
		$fileRes=array();
		$fileRes['filename']=serialize($filename);
		$files=$fileRes['filename'];
		$insertQuery=mysql_query("INSERT INTO ".EPAPER." (epaper_date,epaper_images) VALUES ('$folder','$files')");
		if($insertQuery){
			$fileRes['bool']=true;
			$lastID=mysql_insert_id();
			foreach($filename as $f){
				mysql_query("INSERT INTO ".EPAPERIMG."(epaper_id,src) VALUES ('$lastID','$f')");
			}
		}else{
			$fileRes['bool']=false;
			$fileRes['msg']=mysql_error();
		}
		return $fileRes;
	}

	// create function for comment listing
	function commentList($id){
		$comnt=array();
		if($id==0){
			$commentQuery=mysql_query("SELECT * FROM ".COMMENTS);
		}else{
			$commentQuery=mysql_query("SELECT * FROM ".COMMENTS." WHERE id='$id'");
		}
		if(mysql_num_rows($commentQuery)>0){
			while($commentData=mysql_fetch_array($commentQuery)){
				$comnt['bool']=true;
				$comnt['comment_id'][]=$commentData['id'];
				$comnt['news_id'][]=$commentData['news_id'];
				$comnt['comment_name'][]=$commentData['comment_name'];
				$comnt['comment_email'][]=$commentData['comment_email'];
				$comnt['comment_text'][]=$commentData['comment_text'];
				$comnt['comment_subject'][]=$commentData['comment_subject'];
				$comnt['comment_time'][]=$commentData['comment_time'];
				$comnt['comment_status'][]=$commentData['status'];
			}
		}else{
			$comnt['bool']=false;
		}
		return $comnt;
	}

	// update comment
	function updateComment($id){
		$res=array();
		$update=mysql_query("UPDATE ".COMMENTS." SET status='1' WHERE id='$id'");
		if($update){
			$res['bool']=true;
		}else{
			$res['bool']=false;
			$res['msg']=mysql_error();
		}
		return $res;
	}

	// update comment
	function updateCommentd($id){
		$res=array();
		$update=mysql_query("UPDATE ".COMMENTS." SET status='0' WHERE id='$id'");
		if($update){
			$res['bool']=true;
		}else{
			$res['bool']=false;
			$res['msg']=mysql_error();
		}
		return $res;
	}


	// Ad Banners
	function bannersUpload($bannerData){
		$bannerRes=array();
		$banner_url=$bannerData['banner_url'];
		$banner_img=$bannerData['banner_img'];
		$banner_loc=$bannerData['banner_loc'];
		$banner_status=$bannerData['banner_status'];
		$bannerInsert=mysql_query("INSERT INTO ".BANNERS."(banner_url,banner_img,banner_loc,banner_status) VALUES ('$banner_url','$banner_img','$banner_loc','$banner_status')");
		if($bannerInsert){
			$bannerRes['bool']=true;
		}else{
			$bannerRes['bool']=false;
			$bannerRes['msg']=mysql_error();
		}

		return $bannerRes;
	}

	// Fetch Banner ads
	function banners($id){
		$response=array();
		if($id==0){
			$res=mysql_query("SELECT * FROM ".BANNERS);
		}else{
			$res=mysql_query("SELECT * FROM ".BANNERS." WHERE id='$id'");
		}
		
		if(mysql_num_rows($res)>0){
			$response['bool']=true;
			while($bannerData=mysql_fetch_array($res)){
				$response['banner_id'][]=$bannerData['id'];
				$response['banner_url'][]=$bannerData['banner_url'];
				$response['banner_img'][]=$bannerData['banner_img'];
				$response['banner_loc'][]=$bannerData['banner_loc'];
				$response['banner_status'][]=$bannerData['banner_status'];
			}
		}else{
			$response['bool']=false;
			$response['msg']='No Banners Yet!';
		}

		return $response;
	}

	// Update Banner
	function bannersUpdate($bannerdata,$id){
		$res=array();
		$banner_url=$bannerdata['banner_url'];
		$banner_loc=$bannerdata['banner_loc'];
		$banner_status=$bannerdata['banner_status'];
		$query=mysql_query("UPDATE ".BANNERS." SET banner_url='$banner_url',banner_loc='$banner_loc',banner_status='$banner_status' WHERE id='$id'");
		if($query){
			$res['bool']=true;
		}else{
			$res['bool']=false;
			$res['msg']=mysql_error();
		}

		return $res;
	}

	// Update Banner's Image
	function bannersImgUdate($img,$id){
		$res=array();
		$query=mysql_query("UPDATE ".BANNERS." SET banner_img='$img' WHERE id='$id'");
		if($query){
			$res['bool']=true;
		}else{
			$res['bool']=false;
			$res['msg']='Error: Updating';
		}
	}

	// Delete Banners
	function deleteBanners($ids){
		$res=array();
		foreach($ids as $id){
			$query=mysql_query("DELETE FROM ".BANNERS." WHERE id='$id'");
		}
		if($query){
			$res['bool']=true;
		}else{
			$res['bool']=false;
			$res['msg']=mysql_error();
		}

		return $res;
	}

	// Get Epaper List
	function getEpapers($id){
		$res=array();
		if($id==0){
			$query=mysql_query("SELECT * FROM ".EPAPER);
		}else{
			$query=mysql_query("SELECT * FROM ".EPAPER." WHERE id='$id'");
		}
		if(mysql_num_rows($query)){
			$res['bool']=true;
			while($data=mysql_fetch_array($query)){
				$res['eid'][]=$data['id'];
				$res['edate'][]=$data['epaper_date'];
				$res['eimg'][]=$data['epaper_images'];
				$res['estatus'][]=$data['epaper_status'];
			}
		}else{
			$res['bool']=false;
			$res['msg']='No Epapers Found!';
		}
		return $res;
	}

	// Get Epaper List
	function getEpapersImgs($id){
		$res=array();
		if($id==0){
			$query=mysql_query("SELECT * FROM ".EPAPER);
		}else{
			$query=mysql_query("select *,epaper_images.epaper_id as imgID from epaper,epaper_images WHERE epaper.id=epaper_images.epaper_id AND epaper.id='$id'");
		}
		if(mysql_num_rows($query)){
			$res['bool']=true;
			while($data=mysql_fetch_array($query)){
				$res['eid'][]=$data['id'];
				$res['edate'][]=$data['epaper_date'];
				$res['eimg'][]=$data['src'];
				$res['estatus'][]=$data['epaper_status'];
				$res['imgid'][]=$data['imgID'];
			}
		}else{
			$res['bool']=false;
			$res['msg']='No Epapers Found!';
		}
		return $res;
	}

	// Update Epaper Status
	function updateEpaper($status,$id){
		$res=array();
		$query=mysql_query("UPDATE ".EPAPER." SET epaper_status='$status' WHERE id='$id'");
		if($query){
			$res['bool']=true;
		}else{
			$res['bool']=false;
			$res['msg']='Error: Upadting';
		}
	}
?>