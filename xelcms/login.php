<?php
if (isset($_POST['username'])) { //check if the form has been submited
require_once('dzinclude/dbconnect.inc.php');
require_once('dzinclude/escape.inc.php');
if (empty($_POST['username'])) { //validate the username
$u = FALSE;
$error = '<p>Please enter your username</p>';
} else {
$u = escape_data($_POST['username']);
}
if (empty($_POST['password'])) { //validate the password
$p = FALSE;
$error = '<p>Please enter your password</p>';
} else {
$p = escape_data($_POST['password']);
}
if ($u && $p) { //if everything is ok
$query = "SELECT id, username,password, type FROM users WHERE username='$u' 
and password='$p'";
$result = @mysql_query($query);
$row = mysql_fetch_array($result);
if ($row) { //a match was made
// start a session, register the values and redirect
session_start();
$_SESSION['username'] = $row['username'];
$_SESSION['id'] = $row['id'];
$_SESSION['type'] = $row['type'];
//ob_end_clean();

//header ("Location: http://" . $_SERVER['HTTP_HOST'] .
//			dirname($_SERVER['PHP_SELF']) . "/index.php");
print '<meta http-equiv="refresh" content="0;URL=index.php">';
exit();
/*ob_start(); // delete the buffer

ob_end_flush();

echo "ole";
echo "{$_SESSION['username']}";
echo "{$_SESSION['type']}";
echo "{$_SESSION['user_id']}";*/
} else {
$error = '<p>Invalid username or password. Please try again.</p>';
}
mysql_close();
} 
}
?> 
<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>XELcms - The power of cms - Login Page</title>
</head>

<body>

<blockquote>
    <div align="center">
        <table border="0" cellpadding="0" cellspacing="0" width="44%" align="center">
<tr>
                <td width="465">
                <img border="0" src="xelimages/cms_title.jpg" width="382" height="107"></td>
               
               
            </tr>
            <tr>
                <td width="465" background="xelimages/login_bg.jpg"  style="background-repeat:no-repeat" valign="top">
                <p>&nbsp;</p>
                <div align="center">
                    <form action="" method="post">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td width="15">&nbsp;</td>
                                <td valign="top">
                                <div align="center">
                                    <table border="0" cellpadding="0" cellspacing="5" width="100%">
                                       <?php if ($error) { ?> <tr>
                                          <td colspan="2"  align="center" style="font-family:tahoma; color:#FF0000; font-size:10px"><? echo $error; ?></td>
                                          </tr><? }?>
                                        <tr>
                                            <td width="148" align="right">
                                            <font face="Arial" size="2">Username</font></td>
                                            <td>
                                            <input type="text" name="username" size="20" style="border-style: double; border-width: 2px"></td>
                                        </tr>
                                        <tr>
                                            <td width="148" align="right">
                                            <font face="Arial" size="2">Password</font></td>
                                            <td>
                                            <input type="password" name="password" size="20" style="border-style: double; border-width: 2px"></td>
                                        </tr>
                                        <tr>
                                            <td width="148" align="right">&nbsp;</td>
                                            <td>
                                            <input type="submit" value="Login" name="B1"></td>
                                        </tr>
                                    </table>
                                </div></td>
                                <td width="23">&nbsp;</td>
                            </tr>
                        </table>
                    </form></div>
                <p>&nbsp;</td>
            </tr>
        </table>
      <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</div>
</blockquote>
<div align="center">
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td>&nbsp;</td>
            <td>
            <p align="center">
          <img border="0" src="xelimages/weblabel.jpg" width="133" height="32"></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
            <p align="center"><font face="Arial" size="2">If you have any 
            confusion or doubt; please contact at: +91-98144 06799, 
            z91-161-2408274</font><br>
            <font face="Arial" size="2">email: info@cyberxel.com</font></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><font size="2" face="Arial">All Rights Reserved.</font></td>
        </tr>
    </table>
</div>

</body>

</html><?php
ob_end_flush();
?>
</body>
</html>