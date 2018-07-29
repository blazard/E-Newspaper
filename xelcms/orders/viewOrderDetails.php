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
echo "<span class=td>&nbsp;<img src=\"../dzimages/arrowpath.gif\" />&nbsp;Order Details <img src=\"../dzimages/arrowpath2.gif\" />&nbsp;View Order's Details<img src=\"../dzimages/arrowpath2.gif\" />&nbsp;". $cat2Disp."</h2></div><br /><br></span>";

///
//print_r($_GET);
if($_GET["act"] != "" && $_GET["val"] != "" && $_GET["id"] != ""){
	$id = str_replace("SG-Ship-Order-","",$_GET["id"]);
	mysql_query("update orders_master set order_status = '". $_GET["val"]."' where order_id = ". $id) or die(mysql_error());
echo "<br /> <h1 class='td'>Order Status Updated</h1>";	
}
///


$qryDetails = "select * from orders where order_id = '". $_GET["id"]."'";
$rsDetails = mysql_query($qryDetails) or die(mysql_error());

$orderStatus = mysql_result(mysql_query("select order_status from orders_master where order_id = ". str_replace("SG-Ship-Order-","",$_GET["id"])),0);

?>
<script language="javascript">
function confirmChange(obj1){
//	alert(obj1.value);
	a = confirm("Do you want to change the status of this order?");
	if(a){
		window.location.href = 'viewOrderDetails.php?act=change&id=<?php echo $_GET["id"];?>&val='+obj1.value;
	}else{
		window.location.reload();
	}
}
</script>
<table align="center" cellpadding="2" cellspacing="5" border="0" width="90%">
<tr class="td">
	<td align="left" valign="top" colspan="2" width="50%"><strong>Order Number:</strong> <?php echo $_GET["id"];?></td>
	<td align="left" valign="top" colspan="2" width="50%"><strong>Order Status:</strong> 
		<select name="orderStatus" id="orderStatus" onchange="confirmChange(this);">
			<option value="Pending" <?php if($orderStatus == 'Pending') echo 'selected'; ?>>Pending</option>
			<option value="Shipped" <?php if($orderStatus == 'Shipped') echo 'selected'; ?>>Shipped</option>
			<option value="Completed" <?php if($orderStatus == 'Completed') echo 'selected'; ?>>Completed</option>	
		</select>
	</td>
</tr>
<?php
$totAmtPaid = 0;
$cnt = 1;
while($rowDetails = mysql_fetch_assoc($rsDetails)){
$totAmtPaid += ($rowDetails["prod_qty"] * $rowDetails["product_price"]);
?>
<?php
if($cnt == 1){
?>
<tr class="td">
	<td align="left" valign="top" colspan="2"><strong>User's Name:</strong>
	<?php 
		$userName = mysql_result(mysql_query("select name from clients where email = '" . $rowDetails["email"]."'"),0);
		echo $userName ."&nbsp;(". $rowDetails["email"] .")";
	?></td>
</tr>
<tr>
	<td style="height:10px;" colspan="4"><hr /></td>
</tr>
<?php
}
$cnt++;
?>
<tr class="td">
<td align="right" valign="top" style="text-decoration:underline;" colspan="2">Product Name:</td>
<td align="left" valign="top" colspan="2">
<?php 
$prodName = mysql_result(mysql_query("select product_name from products where id = " . $rowDetails["product_id"]),0);
echo $prodName;
?>
</td>
</tr>
<tr>
	<td style="height:10px;" colspan="4"><hr /></td>
</tr>
<tr class="td" style="line-height:20px;">
<td align="left" valign="top" colspan="2" width="50%"><strong style="text-decoration:underline;">Measurements:</strong><br />
<strong>Shoulders:</strong> <?php echo $rowDetails["shoulders"];?><br />
						<strong>Chest:</strong> <?php echo $rowDetails["chest"];?><br />
						<strong>Upper Arm Width:</strong> <?php echo $rowDetails["upper_arm_width"];?><br />
						<strong>Waist:</strong> <?php echo $rowDetails["waist"];?><br />
						<strong>Hips:</strong> <?php echo $rowDetails["hips"];?><br />
						<strong>Waist to Ankle Length:</strong> <?php echo $rowDetails["waist_to_ankle_length"];?><br />
						<strong>Shoulder to Knee Length:</strong> <?php echo $rowDetails["shoulder_to_knee_length"];?><br />
</td>
<?php
$qryShippingAddress = "select * from addresses where user_id = '". $rowDetails["email"]."' and address_type = 'Shipping'";
$rsShippingAddress = mysql_query($qryShippingAddress);
$rowShippingAddress = mysql_fetch_assoc($rsShippingAddress);
?>
<td align="left" valign="top" colspan="1" width="25%"><strong style="text-decoration:underline;">Shipping Address:</strong><br />
<strong>Full Address:</strong> <?php echo $rowShippingAddress["full_address"];?><br />
						<strong>City/Suburb:</strong> <?php echo $rowShippingAddress["city"];?><br />
						<strong>State/Province:</strong> <?php echo $rowShippingAddress["state"];?><br />
						<strong>Country:</strong> <?php 
							$countryName = mysql_result(mysql_query("select country_name from shipping_master where id = ". $rowShippingAddress["country"]),0);
							echo $countryName;	
						?><br />
						<strong>Phone:</strong> <?php echo $rowShippingAddress["phone"];?><br />
</td>
<?php
$qryShippingAddress = "select * from addresses where user_id = '". $rowDetails["email"]."' and address_type = 'Billing'";
$rsShippingAddress = mysql_query($qryShippingAddress);
$rowShippingAddress = mysql_fetch_assoc($rsShippingAddress);
?>
<td align="left" valign="top" colspan="1" width="25%"><strong style="text-decoration:underline;">Billing Address:</strong><br />
<strong>Full Address:</strong> <?php echo $rowShippingAddress["full_address"];?><br />
						<strong>City/Suburb:</strong> <?php echo $rowShippingAddress["city"];?><br />
						<strong>State/Province:</strong> <?php echo $rowShippingAddress["state"];?><br />
						<strong>Country:</strong> <?php 
							$countryName = mysql_result(mysql_query("select country_name from shipping_master where id = ". $rowShippingAddress["country"]),0);
							echo $countryName;	
						?><br />
						<strong>Phone:</strong> <?php echo $rowShippingAddress["phone"];?><br />
</td>
</tr>
<?php
}
?>
<tr>
	<td style="height:10px;" colspan="4"><hr /></td>
</tr>
<tr class="td">
	<td align="left" valign="top" colspan="2"><strong>Shipping Method : </strong>
	<?php 
		$shippingMethod = mysql_result(mysql_query("select shipping_method from shipping_details where cart_order_id = '" . $_GET["id"]."'"),0);
		echo $shippingMethod;
	?></td>
	<td align="left" valign="top" colspan="2"><strong>Amount Paid : </strong>
	<?php 
		echo $rowDetails["product_currency"]. " ". $totAmtPaid;
	?></td>
</tr>
<tr>
	<td style="height:10px;" colspan="4"><hr /></td>
</tr>
</table>