<?php
	$whitelist = array(
	    '127.0.0.1',
	    '::1'
	);

	if(!in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
	    // not on localhost
	    $servername = "";
		$username = "";
		$password = "";
		$dbname = "assam";
	}else{
		$servername = "localhost";
		$username = "root";
		$password = "123456";
		$dbname = "assam";
	}
?>