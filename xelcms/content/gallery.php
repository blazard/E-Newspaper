<?php 
session_start();
error_reporting(5);
if (!isset($_SESSION['username'])) {
	header ("Location: http://" . $_SERVER['HTTP_HOST'] .
			dirname($_SERVER['PHP_SELF']) . "/login.php");
			exit();
} 

require_once ('../dzinclude/dbconnect.inc.php'); // Connect to the db.

if($_GET["img"] != ""){
	
	$numRecs = mysql_result(mysql_query("select count(*) from product_images where image_name = '". $_GET["n"]."'"),0);
	
	if($numRecs ==1){
		$file2Del = "../../uploads/products/".$_GET["n"];
		@unlink($file2Del);
	}
	mysql_query("delete from product_images where id = ". $_GET["img"]) or die(mysql_error());
	print '<meta http-equiv="refresh" content="0;URL=gallery.php?page='.($_GET["page"]).'">';
}
?>
<?php
echo "<span class='td'><img src=\"../dzimages/arrowpath.gif\" />&nbsp;Gallery</a> <img src=\"../dzimages/arrowpath2.gif\" />&nbsp;Add/Edit Images <img src=\"../dzimages/arrowpath2.gif\" />&nbsp; ". ucwords(retStrng($_GET["page"]))."</span><br><br>";
require_once ('../dzinclude/dbconnect.inc.php'); // Connect to the db.
?>
<link href="../fckeditor/_samples/sample.css" rel="stylesheet" type="text/css" />

<?php

if(isset($_POST['productHID']))
{
print_r($_FILES);

(print_r($_POST));

for($i=0;$i<count($_POST["countInput"]);$i++){

	foreach($_FILES["file"]["error"] as $key => $error){
		if (is_uploaded_file ($_FILES['file']['tmp_name'][$i])) {
			
			$newname1=rand()."_".str_replace(" ","",$_FILES['file']['name'][$i]);
			if (move_uploaded_file($_FILES['file']['tmp_name'][$i], "../../uploads/".$newname1)) {
				echo '';	
				$sql = mysql_query("insert into product_images set product_id = '". retStrng($_POST["productHID"])."', image_name = '". $newname1."'") or die(mysql_error()."<hr>". "insert into product_images set product_id = '". retStrng($_POST["productHID"])."', image_name = '". $newname1."'");			
			} else {
				$i2 = '';
			}
			$i2 = $newname1;
		} else {
			$i2 = '';
		}
	}// image uploads
		
}

if($sql)
{
echo '<p>The changes have been saved</p>';
	/*print '<meta http-equiv="refresh" content="2;URL=../main.php">';*/

}

else
{
echo mysql_error();
}

}
else
{
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
 
<script src="js/lib/jquery.js" type="text/javascript"></script>
<script src="js/lib/jquery.metadata.js" type="text/javascript"></script>
<script src="js/jquery.validate.js" type="text/javascript"></script>
<script src="js/cmxforms.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
	$("#commentForm").validate();
});
</script>

<style type="text/css">
#commentForm { width: 900px; }
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
<link href="../fckeditor/_samples/sample.css" rel="stylesheet" type="text/css" />
<script>
var i=1;
function addRow(id) {
var getcount = document.getElementById("countInput").getAttribute("value");
var i = getcount;
i++;
alert(i);
var tbody = document.getElementById(id).getElementsByTagName("TBODY")[0];
var getcountInput = document.getElementById("countInput");
tbody.removeChild(getcountInput);

	var row2 = document.createElement("TR");
	
	var td3 = document.createElement("TD");
	td3.appendChild(document.createTextNode("Add Image:"));
	td3.setAttribute("colspan","1");
	
	var element = document.createElement("input");
	element.setAttribute("type", "file");
	element.setAttribute("name", "file[]");		

    var td4 = document.createElement("TD");
    td4.appendChild (element);
	
	row2.appendChild(td3);
	row2.appendChild(td4);
	tbody.appendChild(row2);
	
	
	var elementHidden = document.createElement("input");
	elementHidden.setAttribute("type", "hidden");
	elementHidden.setAttribute("value", i);
	elementHidden.setAttribute("name", "countInput");
	elementHidden.setAttribute("id", "countInput");
	tbody.appendChild(elementHidden);
	
	var row4 = document.createElement("TR");
	
	var td7 = document.createElement("TD");
	td7.setAttribute("colspan","2");
	
	row4.appendChild(td7);
	tbody.appendChild(row4);
}
</script>
</head><body>
<div id="note" style="color:#F00"></div>
<div id="fields">
<link href="../fckeditor/_samples/sample.css" rel="stylesheet" type="text/css" />

<table width=842>
<tr class="td"><td width="834">
<?php
	$qryImages = "select * from product_images where product_id = '". retStrng($_GET["page"]) ."' order by id asc";
	$rsImages = mysql_query($qryImages) or die(mysql_error()."<hr>". $qryImages);
	$cntImages = mysql_num_rows($rsImages);
	
	if( $cntImages <= 0){
		echo "No Images Added...";
	}else{
?>
<form name="bulkDelete" action="delExtraImgs.php" method="post" onSubmit="return checkSelected();">
<input type="hidden" name="hidProdId" id="hidProdId" value="<?php echo retStrng($_GET["page"]);?>" />
<table width="100%" border="0" align="left"  class="td">
<?php
$cnt = 1;
while($rowImages = mysql_fetch_array($rsImages)){
?>
	<tr>
		<td align="left" valign="top"><?php echo $cnt; ?></td>
		<td align="left" valign="top"><img src="../../uploads/<?php echo $rowImages['image_name'];?>" width="70" /></td>
		<td align="left" valign="top"><a href="gallery.php?id=<?php echo $_GET["id"];?>&img=<?php echo $rowImages["id"];?>&n=<?php echo $rowImages["image_name"];?>&page=<?php echo $_GET["page"];?>" title="Delete" onClick="return confirm('Do you want to delete this image?');">Delete This Image</a>
		<td align="left" valign="top">
			<input type="checkbox" name="imgs2Del[]" id="imgs2Del[]" value="<?php echo $rowImages["id"];?>" />
		</td>
	</tr>
<?php
$cnt++;
}
?>
<tr>
	<td colspan="3" align="left"><input type="submit" value="Delete Selected" /></td>
</tr>
<tr>
	<td colspan="3">&nbsp;</td>
</tr>
</table>
</form>
<script language="javascript">
function checkSelected(){
	var fields = $("input[name='imgs2Del[]']").serializeArray(); 
	
	if (fields.length == 0){ 
		alert('Please select atleast one checkbox'); 
		return false;
  	}
}
</script>
<?php
}
?>
<br />
<form action="" method="post" enctype="multipart/form-data"  class="cmxform" id="commentForm">
<table width="100%" border="0" align="left"  class="td" id="imagesTable">
<tbody>
<input type="hidden" name="productHID" value="<?php echo $_GET["page"];?>"/>
<input type="hidden" name="countInput" value="1" id="countInput" />
	<tr>
		<td colspan="4" align="right" valign="top"><input type="button" onClick="javascript:addRow('imagesTable');"  value="Upload More Image(s)" /></td>
	</tr>
	<tr>
		<td colspan="1" align="left">
			Add Image:
		</td>
		<td colspan="3" align="center">
			<input type="file" name="file[]" />
		</td>
	</tr>
</tbody>	
</table>
<table style="clear:both; float:left;">
	<tr>
		<td>&nbsp;</td>
		<td colspan="3" align=center><input name="submit" type=submit value="Add"></td>
	</tr>
</table></form>


</td></tr></table>
</div>
</body></html>
<?php } 

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