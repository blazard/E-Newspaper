<?php 
//$dbcnx = @mysql_connect('localhost', 'knitsand_knits', '4321$#@!');
$dbcnx = mysqli_connect('localhost', 'root', '','elg');
if (!$dbcnx) {
	exit('<p>Unable to connect to the database server at this time.</p>');
}
		
//if (!@mysql_select_db('knitsand_knits')) {
if (mysqli_connect_error()) {
	exit('<p>Unable to locate the database at this time.</p>');
}

function creaStrng($val){
	return (base64_encode('jayant').base64_encode($val).base64_encode('ahuja'));
	//return $val;
}

function retStrng($val){
$val = str_replace(base64_encode("jayant"),"",$val);
$val = str_replace(base64_encode("ahuja"),"",$val);
$val = base64_decode($val);
return $val;
}

function funcGetParentCatName($id){
	return(stripslashes(mysql_result(mysqli_query("select category_name from categories where id = ". $id),0)));
}
?>