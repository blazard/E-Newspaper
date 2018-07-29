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
	print '<meta http-equiv="refresh" content="0;URL=viewUsers.php">';	
}
////////

//print_r($_GET);


echo "<span class=td>&nbsp;<img src=\"../dzimages/arrowpath.gif\" />&nbsp;News Letters <img src=\"../dzimages/arrowpath2.gif\" />&nbsp;View Users</h2></div><br /><br></span>";
echo "<table width=100% cellspacing=0 cellpadding=0><tr><td>";
?>
 <form id="addressForm" action="deleteUsers.php" method="Post" onSubmit="return Delete(this. form)">
<?php
echo "<table width=\"100%\" align=\"right\"><tr bgcolor=\"#425d7b\" style='color:#fff' class=td><td align=left width=10%><font color=\"#ffffff\"><strong>Date</strong></font></td>
	    <td align=\"left\" halign=\"middle\" width=\"35%\"><font color=\"#ffffff\"><strong>Email</strong></font></td><td align=\"center\" halign=\"middle\" ><font color=\"#ffffff\" width=10%><strong>Newsletter Sent</strong></font></td><td align=\"center\" halign=\"middle\" width=10% ><font color=\"#ffffff\"><strong>Delete</strong></font></td></tr>
	  </tr>"; //<td align=\"left\" halign=\"middle\" width=\"35%\"><font color=\"#ffffff\"><strong>Sort Order</strong></font></td>
	 //$query="select DATE_FORMAT(subpages.edate, '%d-%m-%Y') as d, subpages.titleeng as subpageTitle, subpages.id, treatments.titleeng, subpages.sortOrder from subpages, treatments where subpages.treatment_id = treatments.id";
	 
	 $query="select * from newsletters order by id desc";

			//echo $query;
		$display = 100;
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
		$newquery = @mysql_query($query2);
	
	$num = mysql_num_rows($newquery);
	$current_page = ($start/$display) + 1;
	$q = strtolower($query);
	$i1==0;
while ($row = mysql_fetch_array($newquery)) {
//print_r($row);
	$id = $row['id'];
	$edate=$row['date_entry'];
	$email = $row["email"];
	$status = $row["status"];
	
	$bg = ($bg=='#eeeeee' ? '#cccccc' : '#eeeeee');
	echo "<tr bgcolor=\"$bg\" class=td><td>$edate</td>
			<td halign=\"middle\">$email</td><td align=\"center\" halign=\"middle\">";
			
			if($status == "1")
				echo "Sent";
			else
				echo "Not Sent";
				
	echo "</td><td align=\"center\" halign=\"middle\"><input type=checkbox name=t1[] value=$id></td></tr>";
} //<td halign=\"middle\">$sortOrder</td>
echo "</td></tr><tr><td colspan=5 align=right><input type=submit value=Delete></td></tr><tr><td colspan=5>";
?>
<table width=100%><tr class=td><td><?
if ($num > 0) {
				if ($num_pages > 1) {
					echo "";
					$current_page = ($start/$display) + 1;
					if ($current_page != 1) {
							echo '<a href="' . $_SESSION['PHP_SELF'] .'?o=' . $o . '&sts=' . ($start - $display) . '&np=' . $num_pages . '"  class=page>Previous</a>';
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
								echo '&nbsp;<a href="' . $_SESSION['PHP_SELF'] .'?o=' . $o . '&sts=' . (($display * ($i - 1))) . '&np=' . $num_pages . '&parentid='.$parentid.'&pid='.$pid.'&special='.$special.'" class="page" >' . $i . '&nbsp;</a>';
							} else {
								echo '<span class=page>&nbsp;' . $i . '&nbsp;</span><span style="font-family:tahoma;font-size:11px"></font>';
							}
						}

}else{


for ($i = 1; $i <= $num_pages; $i++){
				
				
							if ($i != $current_page) { 
								
								
								if(($current_page)<=10&&$i<=10){
								
								echo '&nbsp;<a href="' . $_SESSION['PHP_SELF'] .'?o=' . $o . '&sts=' . (($display * ($i - 1))) . '&np=' . $num_pages . '&parentid='.$parentid.'&pid='.$pid.'&special='.$special.'" class="page">' . $i . '</a>&nbsp;';
							    
								if($i==10)  echo '<span class=page>&nbsp;...&nbsp;</span>';
								
								}else if(  ($current_page-5)<=$i&&$i<=($current_page+5)&&$current_page>10  ){
								
								 if($i==($current_page-5)) echo '<span class=page>&nbsp;...&nbsp;</span>';
								
								echo '&nbsp;<a href="' . $_SESSION['PHP_SELF'] .'?o=' . $o . '&sts=' . (($display * ($i - 1))) . '&np=' . $num_pages . '&parentid='.$parentid.'&pid='.$pid.'&special='.$special.'" class="page">' . $i . '</a>&nbsp;';
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
							echo '<a href="' . $_SESSION['PHP_SELF'] .'?o=' . $o . '&sts=' . ($start + $display) . '&np=' . $num_pages . '"  class=page>Next</a>';
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
?>