<?php 
session_start();
include('../includes/functions.php');
error_reporting(5);
if (!isset($_SESSION['username'])) {
	header ("Location: http://" . $_SERVER['HTTP_HOST'] .
			dirname($_SERVER['PHP_SELF']) . "/login.php");
			exit();
} 
?>
<!-- <meta HTTP-EQUIV="refresh" CONTENT="1"> -->
<meta HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
<meta HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
<!-- Stylesheets -->
<link rel="stylesheet" type="text/css" href="../styles/news.css" />
<!-- Add News Content Start -->
<div id="newscontainer">
	<form method="post" action="" enctype="multipart/form-data">
	<table>
		<tr><td colspan="2">
			<?php
			if(isset($_GET['newsid'])){
				$newsid=$_GET['newsid'];
			}else{
				exit;
			}
				if(isset($_POST['update_image'])){
					$filename=$_FILES['news_img']['name'];
					$filetemp=$_FILES['news_img']['tmp_name'];
					$filesize=floor($_FILES['catimg']['size']/1024);
					$fileuploadfolder='news_images';
					$userid=$_SESSION['id'];
					$filedata=array(
						'userid'=>$userid,
						'filename'=>$filename,
						'tmpfile'=>$filetemp,
						'foldername'=>$fileuploadfolder,
						'filesize'=>$filesize
						);
					$fileRes=fileUploading($filedata);
					// echo '<pre>';
					// print_r($fileRes);
					// echo '</pre>';
					// die;
					if($fileRes['bool']==true){
						$update=updateNewsImage($fileRes['filename'],$newsid);
						if($update['bool']==true){
							echo 'News Image has been updated';
						}
						// echo '<pre>';
						// print_r($update);
						// echo '</pre>';
						// die;
					}
				}
			?>
		</td></tr>
		<tr>
			<td>News Image</td><td><input type="file" name="news_img" /></td>
		</tr>
		<tr>
			<td colspan="2"><input type="submit" name="update_image" value="Update Image" /></td>
		</tr>
	</table>
</form>
</div>
<script type="text/javascript" src="../includes/lib/jquery-1.11.2.js"></script>
<script type="text/javascript" src="../includes/lib/tinymce/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="../includes/lib/custom.js"></script>