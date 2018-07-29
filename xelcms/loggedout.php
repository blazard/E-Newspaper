<?php
session_start();
if (!isset($_SESSION['username'])) {
	header ("Location: http://" . $_SERVER['HTTP_HOST'] .
	dirname($_SERVER['PHP_SELF']) . "/login.php");
	exit();
} else {
	$_SESSION = array();
	session_destroy();
	setcookie ('PHPSESSIO', '', time()-300, '/', '', 0);
	header ("Location: http://" . $_SERVER['HTTP_HOST'] .
	dirname($_SERVER['PHP_SELF']) . "/login.php");
}
?>