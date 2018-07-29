<?php //function ing and triming form data
function escape_data ($data) {
	global $dbcnx;
	if (ini_get('magic_quotes_gpc')) {
		$data = stripcslashes($data);
	}
	
	return mysql_real_escape_string(trim($data), $dbcnx);
}
?>