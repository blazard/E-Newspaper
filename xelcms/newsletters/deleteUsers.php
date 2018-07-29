<style>
@import '../styles/main.css';
#form1 table {
	font-size: 12px;
}
 </style><?php
 error_reporting(5);
require_once ('../dzinclude/dbconnect.inc.php');
echo "<span class=td><img src=\"../dzimages/arrowpath.gif\" />&nbsp;<a href=\"viewnews.php\" class=td>News Letters</a> <img src=\"../dzimages/arrowpath2.gif\" />&nbsp;Delete Users</span><br><br>";	

$id = $_POST['t1'];



echo "<table>";
  for($loop=0;$loop<sizeof($id);$loop++ ) {
	
	$sregion=$id[$loop];
$delmaincat = @mysql_query("DELETE FROM newsletters WHERE id='$sregion'");
  }

if ($delmaincat) {
	echo "<tr><td class=td>News letter subscriber(s) have been deleted. Please wait...</td></tr></table>";
	print '<meta http-equiv="refresh" content="2;URL=http:viewUsers.php">';
} else {
	echo "<tr><td class=td>Error deleting news letter subscriber(s). Please try again.</td></tr></table>";
	print '<meta http-equiv="refresh" content="2;URL=viewUsers.php">';
}
?>
