<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
@import '../styles/main.css';
#form1 table {
	font-size: 12px;
}
 </style><script>
function Delete(thisform) {
if (confirm("Are you sure you want to delete")) {
return true;
}else{
return false;
}
} </script><?php
error_reporting(5);

require_once ('../dzinclude/dbconnect.inc.php');
?>

<?php	
echo "<span class=td>&nbsp;<img src=\"../dzimages/arrowpath.gif\" />&nbsp;Order Details <img src=\"../dzimages/arrowpath2.gif\" />&nbsp;Search Order(s)<img src=\"../dzimages/arrowpath2.gif\" />&nbsp;". $cat2Disp."</h2></div><br /><br></span>";
?>
<form name="frmSearch" action="search.php" method="get">
<table align="center" cellpadding="2" cellspacing="5" border="0" width="90%">
	<tr class="td">
		<td align="right" valign="top">Enter Order Number:</td>
		<td align="left" valign="top"><input type="text" name="ordNum" id="ordNum" /></td>
	</tr>
	<tr class="td">
		<td colspan="2" align="center"><input type="submit" value="Search" /></td>
	</tr>
</table>
</form>