<?php 
session_start();
include('../includes/functions.php');
error_reporting(5);
if (!isset($_SESSION['username'])) {
	header ("Location: http://" . $_SERVER['HTTP_HOST'] .
			dirname($_SERVER['PHP_SELF']) . "/login.php");
			exit();
} 
?><style>
@import '../styles/main.css';
#form1 table {
	font-size: 12px;
}
 </style><?
echo "<span class=td><img src=\"../dzimages/arrowpath.gif\" />&nbsp;Ad Banners</a> <img src=\"../dzimages/arrowpath2.gif\" />&nbsp;Add Banner</span><br><br>";
require_once ('../dzinclude/dbconnect.inc.php'); // Connect to the db.
?>
<link href="../fckeditor/_samples/sample.css" rel="stylesheet" type="text/css" />
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  
<style>
@import '../styles/main.css';
#form1 table {
	font-size: 12px;
}
 </style><script src="../dzinclude/calendar.js"></script>
 
<script src="../js/lib/jquery.js" type="text/javascript"></script>
<script src="../js/lib/jquery.metadata.js" type="text/javascript"></script>
<script src="../js/jquery.validate.js" type="text/javascript"></script>
<script src="../js/cmxforms.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
	$("#commentForm").validate();
});
</script>

<style type="text/css">
#commentForm { width: 800px; }
#commentForm label { width: 250px; }
#commentForm label.error, #commentForm input.submit { margin-left: 13px; color:#990000; font-weight:bold }
</style>
 <link href="../dzinclude/calender.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.f13 {font-family:Arial;font-size:13px;}
.f13 {font-family:Arial;font-size:13px;}
.txtbox {border:1px solid #BEBCB9;}
.txtbox {border:1px solid #BEBCB9;}
#fields table tr td form table tr td input {
	text-align: left;
}
#fields table tr td form table tr td {
	text-align: left;
}
-->
</style>
<link href="../styles/custom.css" rel="stylesheet" type="text/css" />
</head><body>
<div id="note" style="color:#F00"></div>
<div id="fields">
<link href="../fckeditor/_samples/sample.css" rel="stylesheet" type="text/css" />
<table width=842><tr><td width="834">
<form action="" method="post" enctype="multipart/form-data"  class="cmxform" id="commentForm">
<table width="100%" border="0" align="left">
	<tr><td colspan="2">
		<span class="catmsg <?php echo $class; ?>">
		<?php
		/* Coded By Suraj Kumar */
		if(isset($_POST['add_banner'])){

			$banner_folder='banner_images';
			$banner_url=addslashes($_POST['banner_url']);
			$ext=array('jpg','png','gif');
			$banner_img=$_FILES['banner_image']['name'];
			$banner_ext=pathinfo($banner_img,PATHINFO_EXTENSION);
			$banner_tmp_img=$_FILES['banner_image']['tmp_name'];

			$banner_loc=$_POST['banner_loc'];
			$banner_status=$_POST['banner_status'];
			if(empty($banner_status)){
				$banner_status=0;
			}
			if(empty($banner_loc)){
				echo 'please select banner location';
			}
			if(empty($banner_img)){
				echo 'Please provide image before submitting';
			}else{
				// Validation for Image Type
				if(!in_array($banner_ext,$ext)){
					echo 'Image type not valid';
				}
				else{
					if(move_uploaded_file($banner_tmp_img,$banner_folder.'/'.$banner_img)){
						$bannerData['banner_img']=$banner_img;
						$bannerData['banner_url']=$banner_url;
						$bannerData['banner_loc']=$banner_loc;
						$bannerData['banner_status']=$banner_status;
						$bannerRes=bannersUpload($bannerData);
						// echo '<pre>';
						// print_r($bannerRes);
						// echo '</pre>';
						// die;
						if($bannerRes['bool']==true){
							echo 'Banner has been added on <b>'.$banner_loc.'</b> location';
						}
					}else{
						echo '<br/>'.'Error: Uploading File';
					}
				} // End Validation for url
			}
		}
		?>
		</span>
	</td></tr>
	<tr class="td">
    	<td width="146" valign="top">Instruction</td>
	    <td width="670">
	    	<ul>
	    		<li>Home page top banners should be 140X84 (in pixels).</li>
	    		<li>Middle page banner should be 700X92 (in pixels).</li>
	    		<li>Right Side banners should be 300X250 (in pixels).</li>
	    	</ul>
	    </td>
  	</tr>
	<tr class="td">
    	<td width="146">Banner Image url:</td>
	    <td width="670"><input type="text" name="banner_url" style="width:100%" /></td>
  	</tr>	
	<tr>
    	<td width="152" class="td">Banner Image Local</td>
    	<td width="387"><input type="file" name="banner_image" /></td>
  	</tr>
  	<tr>
    	<td width="152" class="td" valign="top">Banner Location</td>
    	<td width="387">
    		<table>
    			<tr>
    				<td>Top Left</td>
    				<td><input type="radio" name="banner_loc" value="top-left" /></td>
    			</tr>
    			<tr>
    				<td>Top Right</td>
    				<td><input type="radio" name="banner_loc" value="top-right" /></td>
    			</tr>
    			<tr>
    				<td>Middle</td>
    				<td><input type="radio" name="banner_loc" value="middle" /></td>
    			</tr>
    			<tr>
    				<td>Home Page With Tabs</td>
    				<td><input type="radio" name="banner_loc" value="with_tabs" /></td>
    			</tr>
    			<tr>
    				<td>Right Up</td>
    				<td><input type="radio" name="banner_loc" value="right-up" /></td>
    			</tr>
    			<tr>
    				<td>Right Down</td>
    				<td><input type="radio" name="banner_loc" value="right-down" /></td>
    			</tr>
    		</table>
    	</td>
  	</tr>
  	<tr>
    	<td width="152" class="td" valign="top">Banner Status</td>
    	<td width="387">
    		<table>
    			<tr>
    				<td>Enable</td>
    				<td><input type="radio" name="banner_status" value="1" /></td>
    			</tr>
    			<tr>
    				<td>Disable</td>
    				<td><input type="radio" name="banner_status" value="0" /></td>
    			</tr>
    		</table>
    	</td>
  	</tr>
  	<tr>
    	<td>&nbsp;</td>
    	<td align=center><input name="add_banner" type="submit" value="Add"></td>
	</tr>
</table>

</form></td></tr></table>
</div>
</body>
</html>
