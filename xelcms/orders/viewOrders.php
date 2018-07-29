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

////////
if($_GET["action"] != ""){

	if($_GET["action"] == "sortOrderUp"){
		mysql_query("update subpages set sortOrder = sortOrder + 1 where id = ". $_GET["id"]);
	}else if($_GET["action"] == "sortOrderDown"){
		if($_GET["value"] != 0)
			mysql_query("update subpages set sortOrder = sortOrder - 1 where id = ". $_GET["id"]);
	}

	//echo 'Sort order changed...';
	print '<meta http-equiv="refresh" content="0;URL=viewOrders.php">';	
}
////////

/*?>if(!isset($_GET["treatmentID"])){
echo "<span class=td>&nbsp;<img src=\"../dzimages/arrowpath.gif\" />&nbsp;Order Details <img src=\"../dzimages/arrowpath2.gif\" />&nbsp;View orders</h2></div><br /><br></span>";

	$qryTreatments1 = "select id, category_name from categories where parent_category = 0 order by category_name";
	$rsTreatments1 = mysql_query($qryTreatments1);
	
	echo '<form name="selectTreatmentFrm1"><table align="center" cellpadding="2" cellspacing="2" border="0"><tr><td class="td">Select Category:</td><td>';
	echo '<select name="selectTreatment1" id="selectTreatment1" onchange="getSubpages1();">';
	echo '<option value="">Select</option>';
	while($rowTreatments1 = mysql_fetch_assoc($rsTreatments1)){
		echo '<option value="'.$rowTreatments1["id"].'">'.$rowTreatments1["category_name"].'</option>';
	}
	echo '</select></table>';
	
	echo '<table align="center" cellpadding="2" cellspacing="2" border="0"><tr><td class="td">or</td></tr></table>';

	$qryTreatments = "select id, category_name from categories where parent_category != 0 order by category_name";
	$rsTreatments = mysql_query($qryTreatments);
	
	echo '<form name="selectTreatmentFrm"><table align="center" cellpadding="2" cellspacing="2" border="0"><tr><td class="td">Select Sub Category:</td><td>';
	echo '<select name="selectTreatment" id="selectTreatment" onchange="getSubpages();">';
	echo '<option value="">Select</option>';
	while($rowTreatments = mysql_fetch_assoc($rsTreatments)){
		echo '<option value="'.$rowTreatments["id"].'">'.$rowTreatments["category_name"].'</option>';
	}
	echo '</select></table>';<?php */
?>
<script language="javascript">
function getSubpages(){
	window.location.href='viewOrders.php?treatmentID='+document.getElementById("selectTreatment").value + "&type=sub-category";
}

function getSubpages1(){
	window.location.href='viewOrders.php?treatmentID='+document.getElementById("selectTreatment1").value + "&type=category";
}
</script>
<?php	
//}else{
//print_r($_GET);


//$cat2Disp = stripslashes(mysql_result(mysql_query("select category_name from orders"),0));

echo "<span class=td>&nbsp;<img src=\"../dzimages/arrowpath.gif\" />&nbsp;Order Details <img src=\"../dzimages/arrowpath2.gif\" />&nbsp;View orders <img src=\"../dzimages/arrowpath2.gif\" />&nbsp;". $cat2Disp."</h2></div><br /><br></span>";
echo "<table width=100% cellspacing=0 cellpadding=0><tr><td>";
?>
 <form id="addressForm" action="deleteproducts.php" method="Post" onSubmit="return Delete(this. form)">
<?php
echo "<table width=\"100%\" align=\"right\"><tr bgcolor=\"#425d7b\" style='color:#fff' class=td><td align=left width=10%><font color=\"#ffffff\"><strong>Order Date</strong></font></td><td align=\"left\" halign=\"middle\" width=\"15%\"><font color=\"#ffffff\"><strong>Order Number</strong></font></td>
	    <td align=\"left\" halign=\"middle\" width=\"15%\"><font color=\"#ffffff\"><strong>Client's Name</strong></font></td><td align=\"left\" halign=\"middle\" ><font color=\"#ffffff\" width=10%><strong>Product</strong></font></td><td align=\"center\" halign=\"middle\" width=10% ><font color=\"#ffffff\"><strong>Qty Ordered</strong></font></td><td align=\"middle\" halign=\"middle\" width=10% ><font color=\"#ffffff\"><strong>Details</strong></font></td><td align=\"center\" halign=\"middle\" ><font color=\"#ffffff\" width=10%><strong>Edit</strong></font></td><td align=\"center\" halign=\"middle\" width=10% ><font color=\"#ffffff\"><strong>Delete</strong></font></td></tr>"; //<td align=\"left\" halign=\"middle\" width=\"35%\"><font color=\"#ffffff\"><strong>Sort Order</strong></font></td>
	 //$query="select DATE_FORMAT(subpages.edate, '%d-%m-%Y') as d, subpages.titleeng as subpageTitle, subpages.id, treatments.titleeng, subpages.sortOrder from subpages, treatments where subpages.treatment_id = treatments.id";
	 
	/*if($_GET["type"] == "sub-category")
		 $query="select * from products where sub_
		 category  = ". $_GET["treatmentID"];
	else*/
		
		$query="select * from orders, orders_master where orders.order_id = concat('SG-Ship-Order-',orders_master.order_id) group by orders.order_id";
		
		
		
		$query .= " ORDER BY orders.order_date";
		//echo $query;
		$display = 50;
		$mysqlquery = @mysql_query($query) or die(mysql_error());
		$num_records = @mysql_num_rows ($mysqlquery);
		if (isset($_GET['np'])) {
			$num_pages = $_GET['np'];
		} else {		
			if ($num_records > $display) {
				$num_pages = ceil ($num_records/$display);
			} else {
				$num_pages = 1;
			}
					
		}
						
		if (isset($_GET['sts'])) {
			$start = $_GET['sts'];
		} else {
			$start = 0;
		}	
	
		$query2 = $query;
		$query2 .=  " LIMIT $start, $display";
		$newquery = @mysql_query($query2) or die(mysql_error());
	
	$num = mysql_num_rows($newquery);
	$current_page = ($start/$display) + 1;
	$q = strtolower($query);
	$i1==0;
while ($row = mysql_fetch_array($newquery)) {
//print_r($row);
	$id = $row[15]; //$row['order_id'];
	$edate=date("Y-m-d", strtotime($row['order_date']));
	$title1 = mysql_result(mysql_query("select name from clients where email = '" . $row["email"]."'"),0);
	$title = mysql_result(mysql_query("select product_name from products where id = " . $row["product_id"]),0);
	$image = "../../uploads/products/thumbs/". $row["product_image"];
	
	$bg = ($bg=='#eeeeee' ? '#cccccc' : '#eeeeee');
	echo "<tr bgcolor=\"$bg\" class=td><td>$edate</td><td>".$row[15]."</td>
			<td halign=\"middle\"><a href=\"editproduct.php?id=$id\" title='Edit' style='text-decoration:none; color:#000000;'>$title1 (".$row["email"].")</a></td><td align=\"left\" halign=\"middle\">$title</td><td align=\"center\" halign=\"middle\">".$row["prod_qty"]."</a></td><td halign=\"middle\" align=\"middle\"><a href=\"viewOrderDetails.php?id=$id\" title='View Details' style='text-decoration:none; color:#000000;'>View Details</a></td><td align=\"center\" halign=\"middle\"><a href=\"editproduct.php?id=$id\"><img src=\"../dzimages/edit.png\" alt=\"Edit\" border=\"0\" /></a></td><td align=\"center\" halign=\"middle\"><input type=checkbox name=t1[] value=$id></td></tr>";
} //<td halign=\"middle\">$sortOrder</td>
echo "</td></tr><tr><td colspan=5 align=right><input type=submit value=Delete></td></tr><tr><td colspan=5>";
?>
<table width=100%><tr class=td><td><?
if ($num > 0) {
				if ($num_pages > 1) {
					echo "";
					$current_page = ($start/$display) + 1;
					if ($current_page != 1) {
							echo '<a href="' . $_SESSION['PHP_SELF'] .'?o=' . $o . '&sts=' . ($start - $display) . '&np=' . $num_pages . '&treatmentID='.$_GET["treatmentID"].'&type='.$_GET["type"].'"  class=page>Previous</a>';
						}
						else {
						echo 'Previous';
						}
						}
						else {
						echo 'Previous';
						}
						
						?> </td><td class=page width="100%" align=center  ><div align=center><? if($num_pages<10){  
 
 	// Make all the numbered pages.
						for ($i = 1; $i <= $num_pages; $i++) {
							if ($i != $current_page) {
								echo '&nbsp;<a href="' . $_SESSION['PHP_SELF'] .'?o=' . $o . '&sts=' . (($display * ($i - 1))) . '&np=' . $num_pages . '&parentid='.$parentid.'&pid='.$pid.'&special='.$special.'&treatmentID='.$_GET["treatmentID"].'&type='.$_GET["type"].'" class="page" >' . $i . '&nbsp;</a>';
							} else {
								echo '<span class=page>&nbsp;' . $i . '&nbsp;</span><span style="font-family:tahoma;font-size:11px"></font>';
							}
						}

}else{


for ($i = 1; $i <= $num_pages; $i++){
				
				
							if ($i != $current_page) { 
								
								
								if(($current_page)<=10&&$i<=10){
								
								echo '&nbsp;<a href="' . $_SESSION['PHP_SELF'] .'?o=' . $o . '&sts=' . (($display * ($i - 1))) . '&np=' . $num_pages . '&parentid='.$parentid.'&pid='.$pid.'&special='.$special.'&treatmentID='.$_GET["treatmentID"].'&type='.$_GET["type"].'" class="page">' . $i . '</a>&nbsp;';
							    
								if($i==10)  echo '<span class=page>&nbsp;...&nbsp;</span>';
								
								}else if(  ($current_page-5)<=$i&&$i<=($current_page+5)&&$current_page>10  ){
								
								 if($i==($current_page-5)) echo '<span class=page>&nbsp;...&nbsp;</span>';
								
								echo '&nbsp;<a href="' . $_SESSION['PHP_SELF'] .'?o=' . $o . '&sts=' . (($display * ($i - 1))) . '&np=' . $num_pages . '&parentid='.$parentid.'&pid='.$pid.'&special='.$special.'&treatmentID='.$_GET["treatmentID"].'&type='.$_GET["type"].'" class="page">' . $i . '</a>&nbsp;';
							    if($i==($current_page+5)) echo '<span style=" color:#FFFFFF; font-size:11px;">&nbsp;...&nbsp;</span>';
								
								}
							
							
							} else {// if( $i == $current_page)
							
						    echo '<span class=page>&nbsp;' . $i . '&nbsp;</span>';
							if($i==10)  echo '<span style=" color:#FFFFFF; font-size:11px;">&nbsp;...&nbsp;</span>';
						    }  

}


} ?> </div></td><td align=right style="padding:6" class=page>
						
						
						<?
						if ($num_pages > 1) {
						// If it's not the last page, make a Next button.
						if ($current_page != $num_pages) {
							echo '<a href="' . $_SESSION['PHP_SELF'] .'?o=' . $o . '&sts=' . ($start + $display) . '&np=' . $num_pages . '&treatmentID='.$_GET["treatmentID"].'&type='.$_GET["type"].'"  class=page>Next</a>';
						}
						else {
				echo 'Next';
				}
				echo "";	
						
				}
				else {
				echo 'Next';
				}
			} 
echo "</td></tr></table></td></tr><table></table>";
//} // main else treatment id wala...
?>