<?php 
	ob_start(); //Turns on output buffering 

	// Start the session
	session_start();

	$timezone = date_default_timezone_set("Asia/Kolkata");

	  
	$con = mysqli_connect("localhost", "root", "Subham8249041078", "social"); //Connection variable

	if(mysqli_connect_errno()) 
	{
		echo "Failed to connect: " . mysqli_connect_errno();
	}


 ?>