<style>
@import '../styles/main.css';
#form1 table {
	font-size: 12px;
}
 </style>
 
<?php
error_reporting(5);
require_once ('../dzinclude/dbconnect.inc.php');
$action = $_GET["action"];

if($action == "status"){

	$action2Disp = "Check News Letter Send Status";
	$totRecords = mysql_result(mysql_query("select count(*) from newsletters"),0);
	$totSent = mysql_result(mysql_query("select count(*) from newsletters where status = '1'"),0);

}else if($action == "resetStatus"){

	mysql_unbuffered_query("update newsletters set status = '0'");
	print("<script> alert('Status changed...');</script>");
	print '<meta http-equiv="refresh" content="0;URL=http:viewUsers.php">';

}else if($action == "send"){

	$action2Disp = "Send Newsletter";
	
}	
echo "<span class=td><img src=\"../dzimages/arrowpath.gif\" />&nbsp;<a href=\"viewnews.php\" class=td>News Letters</a> <img src=\"../dzimages/arrowpath2.gif\" />&nbsp;$action2Disp</span><br><br>";	

if($action == "status"){
?>
	<table align="center" cellpadding="2" cellspacing="2" border="0" width="100%">
		<tr>
			<td align="left" valign="top" class="td">
<?php	
	echo "&rarr; Out of ". $totRecords ." users, ". $totSent. " users have been sent newsletter...";
?>
			</td>
		</tr>
	</table>
<?php
}else if($action == "send"){	
	include("sendNewsletter.php");
}
?>