<?php
session_start();
error_reporting(5);
if (!isset($_SESSION['username'])) {
	header ("Location: http://" . $_SERVER['HTTP_HOST'] .
			dirname($_SERVER['PHP_SELF']) . "/login.php");
			exit();
} 

require_once ('../dzinclude/dbconnect.inc.php'); // Connect to the db.

$imgs2Del = array();
$imgs2Del = $_POST["imgs2Del"];
//print_r($imgs2Del);

//die(print_r($_POST));
foreach($imgs2Del as $img2Del){
	$imgName = mysql_result(mysql_query("select image_name from product_images where id = ". $img2Del),0);
//	die($imgName);
	$numRecs = mysql_result(mysql_query("select count(*) from product_images where image_name = '". $imgName."'"),0);
	
	if($numRecs ==1){
		$file2Del = "../../uploads/products/".$imgName;
		@unlink($file2Del);
	}
	mysql_query("delete from product_images where id = ". $img2Del) or die(mysql_error());
}
	
	print '<meta http-equiv="refresh" content="0;URL=gallery.php?page='.$_POST["hidProdId"].'">';
	
?>