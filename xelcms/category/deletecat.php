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
 </style><?php
 error_reporting(5);
require_once ('../dzinclude/dbconnect.inc.php');
echo "<span class=td><img src=\"../dzimages/arrowpath.gif\" />&nbsp;<a href=\"viewnews.php\" class=td>Category Details</a> <img src=\"../dzimages/arrowpath2.gif\" />&nbsp;Delete category</span><br><br>";	

$id = $_POST['t1'];



echo "<table>";
  for($loop=0;$loop<sizeof($id);$loop++ ) {
	
	$sregion=$id[$loop];
	$img2Del = mysql_result(mysql_query("select cat_image from categories where id = '".$sregion."'"),0);
	@unlink("../../uploads/products/".$img2Del);
	
	$delmaincat = @mysql_query("DELETE FROM categories WHERE id='$sregion'");
	$delmaincat1 = @mysql_query("DELETE FROM products WHERE category_id='$sregion'");

  }

if ($delmaincat) {

	echo "<tr><td class=td>Category has been deleted. Please wait...</td></tr></table>";
	print '<meta http-equiv="refresh" content="2;URL=http:viewcat.php">';
} else {
	echo "<tr><td class=td>Error deleting Category. Please try again.</td></tr></table>";
	print '<meta http-equiv="refresh" content="2;URL=viewcat.php">';
}
?>
