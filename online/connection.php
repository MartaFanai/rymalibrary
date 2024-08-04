<?php 
	// $con = mysqli_connect("hostname", "sql_user_name", "sql_password", "DBname", "PortNo");
	// $con = mysqli_connect("remotemysql.com", "Ud9zBzfrk0", "rtttbT7Pru", "Ud9zBzfrk0", "3306");
	
	$con = mysqli_connect("127.0.0.1", "root", "", "libraryonline", "3306");

	if(!$con){
		echo "Connection failed".mysqli_connect_error();
	}
?>