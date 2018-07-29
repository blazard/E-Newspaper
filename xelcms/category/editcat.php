<?php 
session_start();
error_reporting(5);
if (!isset($_SESSION['username'])) {
	header ("Location: http://" . $_SERVER['HTTP_HOST'] .
			dirname($_SERVER['PHP_SELF']) . "/login.php");
			exit();
} 
?><?
error_reporting (E_ALL ^ E_NOTICE);
?><style>
@import '../styles/main.css';
#form1 table {
	font-size: 12px;
}
 </style>
<?

echo "<span class=td><img src=\"../dzimages/arrowpath.gif\" />&nbsp;Category Details</a> <img src=\"../dzimages/arrowpath2.gif\" />&nbsp;Edit Category</span><br><br>";
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
</head><body>
<?php
/* Code Done By Suraj Kumar */ 
	$id=$_GET['id'];
	if(isset($_POST['submit'])){
		$cat=$_POST['catname'];
		$catorder=$_POST['catsort'];
		// Update Category
		$updateQuery=mysql_query("UPDATE categories SET catname='$cat',catsort='$catorder' WHERE id='$id'");
		if($updateQuery){
			echo 'Category has been updated';
		}else{
			echo mysql_error();
		}
	}
	// Fetch Categories
	$cat=mysql_query("Select * from categories where id='$id'");
	$cats=mysql_fetch_array($cat);
	$id=$cats['id'];
	$catname=$cats['catname'];
	$catsort = $cats["catsort"];
?>
<div id="note" style="color:#F00"></div>
<div id="fields">
<link href="../fckeditor/_samples/sample.css" rel="stylesheet" type="text/css" />
<table width=842><tr><td width="834">
<form action="" method="post" enctype="multipart/form-data" >
<table width="100%" border="0" align="left">
  <tr class="td">
    <td width="146">Category name:</td>
    <td width="670"><input name="catname" type="text" id="catname" style="width:300px" value="<?php echo $catname; ?>"  />
      <input type="hidden" name="id" id="hiddenField" value='<?php echo $id; ?>'/></td>
	  <input type="hidden" name="hImg" id="hImg" value="<?php echo $image;?>" />
    </tr>
	<tr>
   		<td width="152" class="td">Sort Order:</td>
    	<td width="387"><input name="catsort" type="text" id="catsort" value='<?php echo $catsort; ?>' style="width:300px"  /></td>
  	</tr>	
	<tr>
    <td>&nbsp;</td>
      <td align=center><input name="submit" type=submit value="Edit"></td>
    </tr>
</table>

</form></td></tr></table>
</div>
</body></html>
