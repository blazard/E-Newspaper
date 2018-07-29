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
echo "<span class=td><img src=\"../dzimages/arrowpath.gif\" />&nbsp;Category Details</a> <img src=\"../dzimages/arrowpath2.gif\" />&nbsp;Add Category</span><br><br>";
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
		if(isset($_POST['submit'])){
			$catname=mysql_real_escape_string($_POST['catname']);
			$catsort=mysql_real_escape_string($_POST['sortOrder']);
			$filename=$_FILES['catimg']['name'];
			$filetemp=$_FILES['catimg']['tmp_name'];
			$filesize=floor($_FILES['catimg']['size']/1024);
			$fileuploadfolder='category_images';
			$userid=$_SESSION['id'];
			$filedata=array(
				'userid'=>$userid,
				'filename'=>$filename,
				'tmpfile'=>$filetemp,
				'filesize'=>$filesize,
				'foldername'=>$fileuploadfolder
				);
			// echo '<pre>';
			// print_r($fileuploadResponse);
			// echo '</pre>';
			// die;
			if(empty($catname)){
				$class="error";
				echo 'Category name is necessary';
			}else{
				$catCheck=checkCategory($catname);
				if($catCheck==true){
					echo 'This category is already exist, Please Try some other';
					die;
				}
				// File Uploadin Process
				// $fileuploadResponse=fileUploading($filedata);
				// $finalfile=$fileuploadResponse['filename'];
				$finalfile='';
				// Insert Query for main category
				$insertquery=mysql_query("INSERT INTO ".MAIN_CATEGORY." (catname,catsort,catimg) VALUES ('$catname','$catsort','$finalfile')");
				if($insertquery){
					$class="success";
					echo 'Category has been added';
				}else{
					$class="error";
					echo mysql_error();
				}
			}
		}
		?>
		</span>
	</td></tr>
	<tr class="td">
    	<td width="146">Category name:</td>
	    <td width="670"><input name="catname" placeholder="Ex. News, Article"  type="text" id="catname" style="width:300px" class="required"  /></td>
  	</tr>	
	<tr>
    	<td width="152" class="td">Sort Order:</td>
    	<td width="387"><input placeholder="ex.. 1,2,3" name="sortOrder" type="text" id="sortOrder" style="width:300px"  /></td>
  	</tr>
<!--   	<tr>
    	<td width="152" class="td">Category Image:</td>
    	<td width="387"><input name="catimg" type="file" id="catimg" style="width:300px"  /></td>
  	</tr> -->
  	<tr>
    	<td>&nbsp;</td>
    	<td align=center><input name="submit" type=submit value="Add"></td>
	</tr>
</table>

</form></td></tr></table>
</div>
</body>
</html>
