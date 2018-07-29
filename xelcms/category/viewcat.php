 </style><style>
@import '../styles/main.css';
#form1 table {
	font-size: 12px;
}
 </style><?php
error_reporting(5);

require_once ('../dzinclude/dbconnect.inc.php');

echo "<span class=td>&nbsp;<img src=\"../dzimages/arrowpath.gif\" />&nbsp;Category Details <img src=\"../dzimages/arrowpath2.gif\" />&nbsp;View Category</h2></div><br /><br></span>";
echo "<table width=100% cellspacing=0 cellpadding=0><tr><td>";
?>
<script language="javascript" src="../dzinclude/jquery-1.2.6.pack.js"></script>
 <form id="addressForm" action="deletecat.php" method="Post" onsubmit="return confirm('Do you want to delete this category?');">
<?
echo "<table width=\"100%\" align=\"right\"><tr bgcolor=\"#425d7b\" style='color:#fff' class=td><td align=\"left\" halign=\"middle\" width=\"60%\"><font color=\"#ffffff\"><strong>Title</strong></font></td><td align=\"center\" halign=\"middle\"><font color=\"#ffffff\" width=10%><strong>Sort Order</strong></font></td><td align=\"center\" halign=\"middle\" ><font color=\"#ffffff\" width=10%><strong>Edit</strong></font></td><td align=\"center\" halign=\"middle\" width=10% ><font color=\"#ffffff\"><strong>Delete</strong></font></td></tr>
	  </tr>";
	 $query="select * from categories";
		$query .= " ORDER BY id desc";
			//echo $query;
		$display = 100;
		$mysqlquery = @mysql_query($query) or die(mysql_error());
		$num_records = @mysql_num_rows($mysqlquery);
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
	$id = $row['id'];
	
	$title = $row['catname'];
	$bg = ($bg=='#eeeeee' ? '#cccccc' : '#eeeeee');
	$sortOrder = $row["catsort"];
	echo "<tr bgcolor=\"$bg\" class=td><td halign=\"middle\">$title</td><td halign=\"middle\" align='center'>$sortOrder</td><td align=\"center\" halign=\"middle\"><a href=\"editcat.php?id=$id\"><img src=\"../dzimages/edit.png\" alt=\"Edit\" border=\"0\" /></a></td><td align=\"center\" halign=\"middle\"><input type=checkbox name=t1[] value=$id></td></tr>";
}
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
?><script src="js/jquery.js"></script>
  <script type="text/javascript">
$(function() {


$(".delbutton").click(function(){
//Save the link in a variable called element
var element = $(this);
//Find the id of the link that was clicked
var del_id = element.attr("id");
//Built a url to send
var info = 'id=' + del_id;
if(confirm("Sure you want to delete this update? There is NO undo!")){
$.ajax({
	   type: "GET",
	   url: "deletecat.php",
	   data: info,
	   success: function(){
	   }
	});
}

return false;
});
});
</script>
