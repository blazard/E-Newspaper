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
echo "<span class=td><img src=\"../dzimages/arrowpath.gif\" />&nbsp;<a href=\"view.php\" class=td\">Articles</a> <img src=\"../dzimages/arrowpath2.gif\" />&nbsp;Delete</span><br><br>";	

$id = $_POST['t1'];



//die(print_r($_POST));

for($loop=0;$loop<sizeof($id);$loop++ ) {

$sregion=$id[$loop];

//$img2Del = mysql_result(mysql_query("select news_image from news where news_id = ". $sregion),0);

//$srcFile = "../../uploads/products/".$img2Del;
//$destFile ="../../uploads/products/thumbs/".$img2Del;  
//die($srcFile. " ". $destFile);

//@unlink($srcFile);
//@unlink($destFile);

$delmaincat = @mysql_query("DELETE FROM articles WHERE video_id=".$sregion) or die(mysql_error());

}

if ($delmaincat) {
	echo "<tr><td class=td>Article(s) has been deleted. Please wait...</td></tr></table>";
	print '<meta http-equiv="refresh" content="2;URL=http:view.php">';
} else {
	echo "<tr><td class=td>Error deleting article(s). Please try again.</td></tr></table>";
	print '<meta http-equiv="refresh" content="2;URL=view.php">';
}
?>
