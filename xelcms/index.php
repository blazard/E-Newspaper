<?php 
session_start();
error_reporting(5);
if (!isset($_SESSION['username'])) {
	header ("Location: http://" . $_SERVER['HTTP_HOST'] .
			dirname($_SERVER['PHP_SELF']) . "/login.php");
			exit();
} 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<title>XELcms&copy; v.3.1</title>
</head>
<frameset rows="84,*" cols="*" frameborder="no" border="0" framespacing="0">
  <frame src="top.php" name="topFrame" scrolling="No" noresize="noresize"  id="topFrame" frameborder="no" border="0" framespacing="0" title="topFrame" />
  <frameset rows="*" cols="181,*" framespacing="0" frameborder="0" border="4" >
    <frame src="dzinclude/header.inc.php" name="leftFrame" scrolling="no"  id="leftFrame" title="leftFrame" marginwidth="3" marginheight="3"  frameborder="0" border="0"/>
    <frame src="main.php" name="mainFrame" id="mainFrame" title="mainFrame" marginwidth="10" marginheight="10"  />
  </frameset>
</frameset>
<noframes><body>
</body></noframes>
</html>