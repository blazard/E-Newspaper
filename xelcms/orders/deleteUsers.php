<style>
@import '../styles/main.css';
#form1 table {
	font-size: 12px;
}
 </style><?php
 error_reporting(5);
require_once ('../dzinclude/dbconnect.inc.php');
echo "<span class=td><img src=\"../dzimages/arrowpath.gif\" />&nbsp;<a href=\"vieUsers.php\" class=td>Registered Users</a> <img src=\"../dzimages/arrowpath2.gif\" />&nbsp;Delete</span><br><br>";	

$id = $_POST['t1'];



echo "<table>";
  for($loop=0;$loop<sizeof($id);$loop++ ) {
	
	$sregion=$id[$loop];
	
	$email = mysql_result(mysql_query("select email from clients where id = ". $sregion),0);
	
	$delmaincat = @mysql_query("DELETE FROM clients WHERE id='$sregion'");
	
	$delmaincat1 = @mysql_query("DELETE FROM order WHERE email ='". $email."'");
	
  }

if ($delmaincat) {
	echo "<tr><td class=td>Registered user(s) have been deleted. Please wait...</td></tr></table>";
	print '<meta http-equiv="refresh" content="2;URL=http:viewUsers.php">';
} else {
	echo "<tr><td class=td>Error deleting registered users(s). Please try again.</td></tr></table>";
	print '<meta http-equiv="refresh" content="2;URL=viewUsers.php">';
}
?>
