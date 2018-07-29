<?php 
	session_start(); 
	error_reporting(5);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
	<TITLE>Ludhiana web design and web hosting, graphic design in Ludhiana multimedia solution</TITLE>
	<META NAME="LANGUAGE" CONTENT="English">
	<META NAME="ROBOTS" CONTENT="index">
	<META NAME="ROBOTS" CONTENT="follow">
	<META NAME="REVISIT-AFTER" CONTENT="30 days">
	<link rel="stylesheet" href="../style/navigation.css" type="text/css">
	<script language="JavaScript" src="../style/navi.js" type="text/javascript"></script>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>

<body topmargin="0">
<table width=100% cellpadding="0" cellspacing="0" border=0><tr><td height=450>
        <div id="leftNavigation">       
        	<ul class="modEntries">
	        	<li class="pluginMenu" id="moduleId0">
    	    		<a href="../main.php" class="menuLink" target="mainFrame">Home</a>
				</li>
				<li class="pluginMenu" id="moduleId3"> 
				<a href="JavaScript:void(0);" class="menuLink" onclick="modNavClick('3'); return false;">Category Details</a>
					<ul class="subMenu">
						<li class="subMenuChild" id="moduleId0Sub3"> <a href="../category/viewcat.php" target="mainFrame"  class="pluginLink" >View Categories</a></li>
						<li class="subMenuChild" id="moduleId0Sub3"> <a href="../category/addcat.php" target="mainFrame"  class="pluginLink">Add Category </a></li>
					</ul>
				</li>
				<li class="pluginMenu" id="moduleId4"> 
				<a href="JavaScript:void(0);" class="menuLink" onclick="modNavClick('4'); return false;">News Details</a>
					<ul class="subMenu">
						<li class="subMenuChild" id="moduleId0Sub4"> <a href="../news/viewnews.php" target="mainFrame"  class="pluginLink">View News</a></li>
						<li class="subMenuChild" id="moduleId0Sub4"> <a href="../news/addnews.php" target="mainFrame"  class="pluginLink" >Add News</a></li>
						
					</ul>
				</li>

				<li class="pluginMenu" id="moduleId5"> 
				<a href="JavaScript:void(0);" class="menuLink" onclick="modNavClick('5'); return false;">Comments</a>
					<ul class="subMenu">
						<li class="subMenuChild" id="moduleId0Sub5"> <a href="../comments/comments.php" target="mainFrame"  class="pluginLink" >Comments List</a></li>
					</ul>
				</li>

				<li class="pluginMenu" id="moduleId6"> 
					<a href="JavaScript:void(0);" class="menuLink" onclick="modNavClick('6'); return false;">E-Paper</a>
					<ul class="subMenu">
						<li class="subMenuChild" id="moduleId0Sub5"> <a href="../epaper/add.php" target="mainFrame"  class="pluginLink" >Add epaper images</a></li>
						<li class="subMenuChild" id="moduleId0Sub5"> <a href="../epaper/view.php" target="mainFrame"  class="pluginLink" >View epaper images</a></li>
					</ul>
				</li>

				<li class="pluginMenu" id="moduleId7"> 
					<a href="JavaScript:void(0);" class="menuLink" onclick="modNavClick('7'); return false;">Ad Banners</a>
					<ul class="subMenu">
						<li class="subMenuChild" id="moduleId0Sub5"> <a href="../ad-banners/add.php" target="mainFrame"  class="pluginLink" >Add Banners</a></li>
						<li class="subMenuChild" id="moduleId0Sub5"> <a href="../ad-banners/view.php" target="mainFrame"  class="pluginLink" >View Banners</a></li>
					</ul>
				</li>

	   	  </ul>

		</div>
</td></tr></table>

<?php
function creaStrng($val){
	return base64_encode('jayant').base64_encode($val).base64_encode('ahuja');
	//return $val;
}

function retStrng($val){
	$val = str_replace(base64_encode("jayant"),"",$val);
	$val = str_replace(base64_encode("ahuja"),"",$val);
	$val = base64_decode($val);
	return $val;
}

?>