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
				if(isset($_POST['add_epaper'])){
					$epaper_date=mysql_real_escape_string($_POST['epaper_date']);
					$epaper_images=$_FILES['epaper_images']['name'];
					$epaper_images_tmp=$_FILES['epaper_images']['tmp_name'];
					
					$file_array=array(
						'filename'=>$epaper_images,
						'filetmp'=>$epaper_images_tmp,
						);
					$multiplefileUpload=multiplefileUpload($file_array,$epaper_date);
					// echo '<pre>';
					// print_r($multiplefileUpload);
					// echo '</pre>';
					// die;
					if($multiplefileUpload['bool']==false){
						echo $multiplefileUpload['msg'];
					}else{
						$addepaper=addmultipleImages($multiplefileUpload['filename'],$epaper_date);
						// echo '<pre>';
						// print_r($addepaper);
						// echo '</pre>';
						// die;
						if($addepaper['bool']==true){
						echo 'Files Has been uploaded in <b>'.$epaper_date.'</b> Directory and added in database';
					}else{
						echo $addepaper['msg'];
					}
					}
				}
			?>
		</td></tr>
		<tr>
			<td>Add News Date</td><td><input type="text" name="epaper_date" /></td>
		</tr>
		<tr>
			<td>Add News Images</td><td><input type="file" name="epaper_images[]" multiple /></td>
		</tr>
		<tr>
			<td colspan="2" align="right"><input type="submit" name="add_epaper" value="Add E-paper Images" /></td>
		</tr>
	</table>
</form>
</div>
<script type="text/javascript" src="../includes/lib/jquery-1.11.2.js"></script>
<script type="text/javascript" src="../includes/lib/tinymce/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="../includes/lib/custom.js"></script>