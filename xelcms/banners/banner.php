<?php 
session_start();
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
echo "<span class=td><img src=\"../dzimages/arrowpath.gif\" />&nbsp;Banner <img src=\"../dzimages/arrowpath2.gif\" />&nbsp;Add</span><br><br>";
require_once ('../dzinclude/dbconnect.inc.php'); // Connect to the db.
?>
<link href="../fckeditor/_samples/sample.css" rel="stylesheet" type="text/css" />

<?
//print_r($_POST);

if(isset($_POST['long_desc']))
{
require_once ('../dzinclude/dbconnect.inc.php'); // Connect to the db.

//$pname=addslashes($_POST['pname']);
//$productLongDesc = addslashes($_POST["long_desc"]);
$productSmallDesc = addslashes($_POST["small_desc"]);
$newsDate = addslashes($_POST["date_of_exhibition"]);

$error = '';

/*if($pname == ""){
echo '<p>Please select exhibition type...</p>';
print '<meta http-equiv="refresh" content="2;URL=addsubcat.php">';
die();
}
*/// Check name
if (is_uploaded_file ($_FILES['image']['tmp_name'])) {
		$newname="TOUR-".rand().str_replace(" ","",$_FILES['image']['name']);

		if (move_uploaded_file($_FILES['image']['tmp_name'], "../../uploads/products/".$newname)) {
			echo '';
			
		} else {

			$i = '';
			
		}
		$i = $newname;
		
	$srcFile = "../../uploads/products/".$newname;
	$destFile ="../../uploads/products/thumbs/".$newname;

	resampimagejpg(283,200,$srcFile, $destFile);
			
	$srcFile1 = "../../uploads/products/".$_POST["hIMAGE"];
	$destFile1 ="../../uploads/products/thumbs/".$_POST["hIMAGE"];
	
	@unlink($srcFile1);
	@unlink($destFile1);
			
} else {
		$i = $_POST["hIMAGE"];
}

$cntExist = mysql_result(mysql_query("select count(*) from banners"),0);

if($cntExist <= 0)
	$sql = mysql_query("insert into banners set  news_image = '".$i."', date_added = '". date("Y-m-d")."'") or die(mysql_error()); //tour_title = '". $_POST["small_desc"]."', , content = '". mysql_real_escape_string($_POST["long_desc"])."',
else
	$sql=mysql_query("update banners set news_image = '".$i."', date_added = '". date("Y-m-d")."'") or die(mysql_error()); //tour_title = '". $_POST["small_desc"]."', content = '". mysql_real_escape_string($_POST["long_desc"])."',

if($sql)
{
echo '<p>The changes have been saved</p>';
//print '<meta http-equiv="refresh" content="2;URL=viewStories.php">';
//die();
}

else
{
echo '<div class="notification_error">'.$error.'</div>';
}

}

$qryDRec = "Select * from banners";
$rsDRec = mysql_query($qryDRec);
$rowDRec = mysql_fetch_assoc($rsDRec);

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
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
<script> 

function HttpRequest( url ) { 
	var pageRequest = false // variable to hold ajax object 
 
if (!pageRequest && typeof XMLHttpRequest != 'undefined') 
   pageRequest = new XMLHttpRequest() 
 
if (pageRequest){ //if pageRequest is not false 
   pageRequest.open('GET', url, false); //get page synchronously 
   pageRequest.send(null); 
   return( embedpage(pageRequest) ); 
   } 
} 
 
function embedpage(request) { 
//if viewing page offline or the document was successfully retrieved online (status code=2000) 
if (window.location.href.indexOf("http")==-1 || request.status==200) 
   return(request.responseText); 
} 

function updateItems() { 
	region = document.getElementById("category").value; 
	document.getElementById("townselect").options[0] = new Option( "Loading...", null, true, true ); 
	document.getElementById("townselect").disabled = true; 
	// load new list 
	newselect = HttpRequest( "catitemselect.php?region=" + region ); 
	document.getElementById("townselectdiv").innerHTML = newselect; 
} 
</script>
</head><body>
<div id="note" style="color:#F00"></div>
<div id="fields">
<link href="../fckeditor/_samples/sample.css" rel="stylesheet" type="text/css" />
	

<table width=842><tr><td width="834">
<form action="" method="post" enctype="multipart/form-data"  class="cmxform" id="commentForm">
<input type="hidden" name="hID" id="hID" value="<?php echo $rowDRec["id"];?>" />
<input type="hidden" name="hIMAGE" id="hIMAGE" value="<?php echo $rowDRec["news_image"];?>" />
<input type="hidden" name="long_desc" id="long_desc" value="saveBanner" />
<table width="100%" border="0" align="left">
<?php /*?><tr>
    	<td width="152" class="td">Tour Title<br /> (One Liner):</td>
    	<td width="387"><input name="small_desc" type="text" id="small_desc" value='<?php echo stripslashes($rowDRec["tour_title"]); ?>' style="width:300px"  /></td>
  	</tr><?php */?>
<tr class="td">
	<td>Banner: 
<?php if ($rowDRec["news_image"] != '') {?>
	<a href="../../uploads/products/<?php echo $rowDRec["news_image"]; ?>" target="_blank"><img src="../dzimages/preview.gif" alt="<?php echo $image; ?>" border="0" /></a>
<?php } ?>	
	<br /><small>size, 244px by 223px</small></td>
	<td><input type="file" name="image" id="image"></td>
</tr>
<!--	<tr class="td">
    	<td valign="top" class="td">Description:</td>
    <td>
<?php
include("../fckeditor/fckeditor.php") ;
$oFCKeditor = new FCKeditor('long_desc') ;
$oFCKeditor->BasePath = '../fckeditor/' ;
$oFCKeditor->Value	= stripslashes($rowDRec["content"]);
$oFCKeditor->Width  = '100%' ;
$oFCKeditor->Height = '500' ;
$oFCKeditor->Create() ;
?>	
	</td>
  	</tr>	 -->
  	<tr>
    	<td>&nbsp;</td>
    	<td align=center><input name="submit" type=submit value="Update"></td>
	</tr>
</table>

</form></td></tr></table>
</div>
</body></html>
<? //} 

function resampimagejpg( $forcedwidth, $forcedheight, $sourcefile, $destfile){
	$fw = $forcedwidth;
	$fh = $forcedheight;

	$is = getimagesize( $sourcefile );

	if($is[0] >= $is[1]){
		$orientation = 0;
	}else{
		$orientation = 1;
		$fw = $forcedheight;
		$fh = $forcedwidth;
	}

	if($is[0] > $fw || $is[1] > $fh){
		if( ( $is[0] - $fw ) >= ( $is[1] - $fh ) ){
			$iw = $fw;
			$ih = ( $fw / $is[0] ) * $is[1];
		}else{
			$ih = $fh;
			$iw = ( $ih / $is[1] ) * $is[0];
		}
		$t = 1;
	}else{
		$iw = $is[0];
		$ih = $is[1];
		$t = 2;
	}

	if ( $t == 1 ){
		$img_src = imagecreatefromjpeg( $sourcefile );
		$img_dst = imagecreatetruecolor( $iw, $ih );
		imagecopyresampled( $img_dst, $img_src, 0, 0, 0, 0, $iw, $ih, $is[0], $is[1] );
		
		if( !imagejpeg( $img_dst, $destfile, 100 ) ){
			exit( );
		}
	}else if ( $t == 2 ){
		copy( $sourcefile, $destfile );
	}
}

?>
