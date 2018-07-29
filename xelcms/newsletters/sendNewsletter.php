<?php
if($_POST["sub1"] == ""){
?>
<form name="frm1" action="newsletters.php?action=send" method="post">
	<table align="center" cellpadding="2" cellspacing="2" border="0" width="100%">
		<tr>
			<td align="right" valign="top" class="td">Enter Subject:</td>
			<td align="left" valign="top" class="td" colspan="3"><input type="text" name="subject" style="width:500px;"></td>
		</tr>
		<tr>
			<td valign="top" align="right" class="td">Content:</td>
			<td colspan="3" align="left" valign="top" class="td"><!--<textarea name="descen" id="descen" cols="45" rows="5" ></textarea> -->
<?php
include("../fckeditor/fckeditor.php") ;
$oFCKeditor = new FCKeditor('descen') ;
$oFCKeditor->BasePath = '../fckeditor/' ;
$oFCKeditor->Create() ;
?>	
			</td>
		</tr>	
		<tr>
			<td>&nbsp;</td>
			<td colspan="3" align="center"><input name="sub1" type="submit" value="Send Newsletter" /></td>
		</tr>	
  </table>
</form>
<?php
}else{

echo '<script language="JavaScript">
function funAll() {
if (document.getElementById) {  // DOM3 = IE5, NS6
document.getElementById("div420").style.visibility = "hidden";
}
else {
if (document.layers) {  // Netscape 4
document.div420.visibility = "hidden";
}
else {  // IE 4
document.all.div420.style.visibility = "hidden";
      }
   }
}
//  End -->
</script>';

date_default_timezone_set('America/Toronto');
include("class.phpmailer.php");
$mail = new PHPMailer();
$mail->IsHTML(true);
$mail->Subject = $_POST["subject"];

$qryUsrs = "select email,id from newsletters where status = '0' order by id desc limit 0,100";
$rsUsrs = mysql_query($qryUsrs);

if(mysql_num_rows($rsUsrs) > 0){

echo '<body onLoad="funAll()">';
echo '<div id="div420" style="position: absolute; left:5px; top:5px; background-color: #FFFFCC; layer-background-color: #FFFFCC; height: 100%; width: 100%;"> 
<table width=100%><tr><td>Page loading ... Please wait.</td></tr></table></div>';

	$UsrsSnd2="";
			
	while($rowUsrs = mysql_fetch_assoc($rsUsrs)){
// connect for every entry

	$mail->SetLanguage('en',"lang/");	

	$mail->IsMail();
	
	$mail->Password = ""; //  
	$mail->From = 'info@emgonline.co.uk'; 
	$mail->FromName = 'EMG Online';
	
	$mail->AddReplyTo("info@emgonline.co.uk","EMG Online"); 

// connect for every entry
			
	$body = $_POST["descen"];
	$body = eregi_replace("[\]",'',$body);
	$mail->Body = $body;
	$mail->AddAddress($rowUsrs["email"]);
	
	if(!$mail->Send()){
		echo "Message could not be sent. <p>";
		die("Mailer Error: " . $mail->ErrorInfo);
		exit;
	}
	//$mail->ClearBCCs();
		$mail->ClearAddresses();
		$mail->ClearReplyTos();
		
		$UsrsSnd2 .= trim(html_entity_decode(stripslashes($rowUsrs['email']),ENT_QUOTES))."<br>";
		mysql_query("update newsletters set status = '1' where id =".$rowUsrs['id']);
							
	}
	
	echo "Your mail has been sent to following recepients - ". $UsrsSnd2;
	$mail->SmtpClose(); 
}// if num rows	
}
?>