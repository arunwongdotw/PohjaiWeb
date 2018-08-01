<?php
	$host = "localhost";
	$username = "roj2009_deng1";
	$password = "kAzLhdtw";
	$dbName = "roj2009_pohjai01";

	$conn = mysql_connect($host, $username, $password);
	mysql_db_query($dbName,"SET NAMES UTF8");

	if (!$conn) {
		echo "<h3>ERROR : ???????????????????????????</h3>";
		exit();
	}
?>
