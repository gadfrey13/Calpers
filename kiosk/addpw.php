<?php
	header('Access-Control-Allow-Origin: *'); 
    $servername = "athena.ecs.csus.edu";
	$username 	= "crimsontigers";
	$password 	= "crimsontigers_db";
	$dbName 	= "crimsontigers";
	
	// Make Connection
	$connection = new mysqli($servername, $username, $password, $dbName);
	
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
	$array = array();
	
	$query = "select HRMS_ID, password from employee";
	
	$result = mysqli_query($connection, $query);

	if (!$result)
		echo "Failure to query";
	else
	{
		while ($row = mysqli_fetch_assoc($result))
		{
			$array[] = $row;
		}
	}
	
	echo (md5(time()));
	
	for ($i = 0; $i < count($array); $i++) {
		$hrm = $array[$i]['HRMS_ID'];
		$ps  = md5(time() + $i);
		mysqli_query($connection,"UPDATE employee SET password = '" . $ps . "' WHERE HRMS_ID = '" . $hrm . "'");

		//$connection->query($sql);
	}
?>