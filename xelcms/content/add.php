<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="../dzinclude/calendar.js"></script>
 <link href="../dzinclude/calender.css" rel="stylesheet" type="text/css">
 <script language="javaScript" type="text/javascript" src="../dzinclude/calender_date_picker.js"></script><style type="text/css">
<!--
.f13 {font-family:Arial;font-size:13px;}
.f13 {font-family:Arial;font-size:13px;}
.txtbox {border:1px solid #BEBCB9;}
.txtbox {border:1px solid #BEBCB9;}
-->
 </style><style>
@import '../styles/main.css';
#form1 table {
	font-size: 12px;
}
 </style>
<?php 
require_once ('../dzinclude/dbconnect.inc.php'); // Connect to the db.
error_reporting(5);
echo "<span class=td><img src=\"../dzimages/arrowpath.gif\" />&nbsp;<a href=\"add.php\" class=td>Content</a> <img src=\"../dzimages/arrowpath2.gif\" />&nbsp;Enter Data</span><br><br>";

if (isset($_POST['hPageName'])) {


//////////////////////////////////////////////////////
function resampimagejpg( $forcedwidth, $forcedheight, $sourcefile, $destfile){
	$fw = $forcedwidth;
	$fh = $forcedheight;

	$is = getimagesize( $sourcefile );

	if($is[0] >= $is[1]){
		$orientation = 0;
	}else{
		$orientation = 1;
		$fw = $forcedheight;
		$fh = $forcedwidth;
	}

	if($is[0] > $fw || $is[1] > $fh){
		if( ( $is[0] - $fw ) >= ( $is[1] - $fh ) ){
			$iw = $fw;
			$ih = ( $fw / $is[0] ) * $is[1];
		}else{
			$ih = $fh;
			$iw = ( $ih / $is[1] ) * $is[0];
		}
		$t = 1;
	}else{
		$iw = $is[0];
		$ih = $is[1];
		$t = 2;
	}

	if ( $t == 1 ){
		$img_src = imagecreatefromjpeg( $sourcefile );
		$img_dst = imagecreatetruecolor( $iw, $ih );
		imagecopyresampled( $img_dst, $img_src, 0, 0, 0, 0, $iw, $ih, $is[0], $is[1] );
		
		if( !imagejpeg( $img_dst, $destfile, 100 ) ){
			exit( );
		}
	}else if ( $t == 2 ){
		copy( $sourcefile, $destfile );
	}
}
//////////////////////////////////////////////////////

//die(print_r($_POST));

//$edate=$_REQUEST['edate'];
//$name=$_REQUEST['titleeng'];
//$toparticles=$_REQUEST['toparticles'];
/*$short_desc = $_REQUEST["short_desc"];*/

$desc=addslashes($_REQUEST['descen']);


/*if ($toparticles!='') {
	$toparticles='Y';
} else {
	$toparticles='N';
}*/


if (is_uploaded_file ($_FILES['image']['tmp_name'])) {

		$newname=rand()."_".$_FILES['image']['name'];

		if (move_uploaded_file($_FILES['image']['tmp_name'], "../../uploads/".$newname)) {
			//echo '';
			resampimagejpg(200,180, "../../uploads/".$newname, "../../uploads/thumbs/".$newname);
			
		} else {
			$i = '';
		}
		$i = $newname;
	} else {
		$i = 'N.A.';
	}

//$query=mysql_query("insert into articles set edate='$edate', titleeng='$name',  descen='$desc', picture='$i',toparticles='$toparticles'");


mysql_query("delete from others where page_name = '". retStrng($_POST["hPageName"])."'") or die(mysql_error());
$query=mysql_query("insert into others set page_name ='".retStrng($_POST["hPageName"])."',  page_text='$desc', image_name = '". $i."'") or die(mysql_error());
if ($query) {
				echo '<p>Text saved....</p>';

				//print '<meta http-equiv="refresh" content="2;URL=viewnews.php">';

}



} else { 

$dataRow = @stripslashes(mysql_result(mysql_query("select page_text from others where page_name = '". retStrng($_GET["page"]). "'"),0));
?>
<link rel="stylesheet" type="text/css" media="screen" href="css/screen.css" />

<script src="js/lib/jquery.js" type="text/javascript"></script>
<script src="js/lib/jquery.metadata.js" type="text/javascript"></script>
<script src="js/jquery.validate.js" type="text/javascript"></script>
<script src="js/cmxforms.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
	$("#commentForm").validate();
});
</script>

<style type="text/css">
#commentForm { width: 500px; }
#commentForm label { width: 250px; }
#commentForm label.error, #commentForm input.submit { margin-left: 13px; color:#990000; font-weight:bold }
</style>
<table width=100%><tr><td>
<form action="?page=<?php echo $_GET["page"];?>" method="post" enctype="multipart/form-data" class="cmxform" id="commentForm" >
<input type="hidden" name="hPageName" value="<?php echo $_GET["page"];?>" />
<table width="918" border="0" align="left">
  	<tr>
    	<td width="161" colspan="4" class="td">Enter Content For - <strong><?php echo ucwords(retStrng($_GET["page"]));?></strong></td>
	</tr> 
<?php
$page = retStrng($_GET["page"]);

if( ($page != "about us") && ($page != "contact us") && ($page != "bespoke furniture") ) {
?>	
<!--	<tr>
		<td valign="top">&nbsp;</td>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
    	<td valign="top" class="td">Image:</td>
	    <td><label>
    		<input type="file" name="image" id="image" />
	      </label></td>
    	<td>&nbsp;</td>
	    <td>&nbsp;</td>
  	</tr> -->
<?php
}
?>	
	<tr>
		<td valign="top">&nbsp;</td>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td valign="top" class="td">Description:</td>
		<td colspan="3"><!--<textarea name="descen" id="descen" cols="45" rows="5"><?php echo $dataRow;?></textarea> -->
		<?php
		include("../fckeditor/fckeditor.php") ;
		$oFCKeditor = new FCKeditor('descen') ;
		
		$oFCKeditor->BasePath = '../fckeditor/' ;
		
		// Automatically calculates the editor base path based on the _samples directory.
		// This is usefull only for these samples. A real application should use something like this:
		// $oFCKeditor->BasePath = '/fckeditor/' ;	// '/fckeditor/' is the default value.
		/*$sBasePath = $_SERVER['PHP_SELF'] ;
		$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "_samples" ) ) ;
		
		
		$oFCKeditor->BasePath	= $sBasePath ;*/
		$oFCKeditor->Value		= stripslashes($dataRow);
		$oFCKeditor->Create() ;
		?>	
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td colspan="3" align="center"><input name="submit" type=submit value="Add" /></td>
	</tr>
</table>
<table id="calenderTable">
<tbody id="calenderTableHead">
<tr>
 <td colspan="4" align="left">
	<select onChange="showCalenderBody(createCalender(document.getElementById('selectYear').value, this.selectedIndex, false));" id="selectMonth">
	 <option value="0">January</option>
	 <option value="1">February</option>
	 <option value="2">March</option>
	 <option value="3">April</option>
	 <option value="4">May</option>
	 <option value="5">June</option>
	 <option value="6">July</option>
	 <option value="7">August</option>
	 <option value="8">September</option>
	 <option value="9">October</option>
	 <option value="10">November</option>
	 <option value="11">December</option>
	</select>
 </td>
 <td colspan="2" align="center"><select onChange="showCalenderBody(createCalender(this.value, document.getElementById('selectMonth').selectedIndex, false));" id="selectYear"></select></td>
 <td align="right"><a href="#" onClick="closeCalender();">X</a></td>
</tr>
</tbody>
<tbody id="calenderTableDays">
<tr style="">
 <td>Su</td><td>Mo</td><td>Tu</td><td>We</td><td>Thu</td><td>Fr</td><td>Sa</td>
</tr>
</tbody>
<tbody id="calender"></tbody>
</table>
</form></td></tr>
<? } ?>