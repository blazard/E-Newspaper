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
echo "<span class=td><img src=\"../dzimages/arrowpath.gif\" />&nbsp;<a href=\"viewnews.php\" class=td>Order Details</a> <img src=\"../dzimages/arrowpath2.gif\" />&nbsp;Delete Order(s)</span><br><br>";	

//die(print_r($_POST));

$id = $_POST['t1'];



//print_r($_POST);

for($loop=0;$loop<sizeof($id);$loop++ ) {

$sregion=$id[$loop];

/*$img2Del = mysql_result(mysql_query("select product_image from products where id = ". $sregion),0);

$srcFile = "../../uploads/products/".$img2Del;
$destFile ="../../uploads/products/thumbs/".$img2Del;  
//die($srcFile. " ". $destFile);

@unlink($srcFile);
@unlink($destFile);*/
$delmaincat1 = @mysql_query("Delete from orders_master where order_id = ". str_replace("SG-Ship-Order-","",$sregion)) or die(mysql_error());
$delmaincat2 = @mysql_query("DELETE FROM shipping_details WHERE cart_order_id='$sregion'") or die(mysql_error());
$delmaincat = @mysql_query("DELETE FROM orders WHERE order_id='$sregion'") or die(mysql_error());

}

if ($delmaincat) {
	echo "<tr><td class='td'>Order(s) have been deleted. Please wait...</td></tr></table>";
	print '<meta http-equiv="refresh" content="2;URL=http:viewOrders.php">';
} else {
	echo "<tr><td class='td'>Error deleting order(s). Please try again.</td></tr></table>";
	print '<meta http-equiv="refresh" content="2;URL=viewOrders.php">';
}
?>
