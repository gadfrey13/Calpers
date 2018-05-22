<?php
	header('Access-Control-Allow-Origin: *'); 
    $servername = "localhost";
	$username = "root";
	$password = "";
	$dbName = "calpers";
	
	// Make Connection
	$connection = new mysqli($servername, $username, $password, $dbName);
	
	$array = array();
	$search = $_REQUEST["search"];

	if ($search !== "") {
		$query = "SELECT * FROM employee 
		WHERE first_name LIKE '%$search%' OR last_name LIKE '%$search%'";
		// Check connection
		if (mysqli_connect_errno())
		{
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		
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
	}
	

	
	mysqli_close($connection);

	// desired number of columns - this can be any number
	$cols = 5;

	$output = "<table id =\"t01\" align=\"center\">";
	
	$output .= "<tr>";
	$output .= "<th>" . "Name" ."</th>\n";
	$output .= "<th>" . "Job Title" . "</th>\n";
	$output .= "<th>" . "Desk Phone" . "</th>\n";
	$output .= "<th>" . "Building" . "</th>\n";
	$output .= "<th>" . "Floor" . "</th>\n";
	$output .= "</tr>";
	
	for ($i = 0; $i < count($array); $i++) {
		$output .= "<tr>";
		$output .= "<td>" . $array[$i]["first_name"] . " " . $array[$i]["last_name"] . "</td>\n";
		$output .= "<td>" . $array[$i]["job_title"] . "</td>\n";
		$output .= "<td>" . $array[$i]["desk_phone"] . "</td>\n";
		$output .= "<td>" . $array[$i]["building"] . "</td>\n";
		$output .= "<td>" . $array[$i]["floor"] . "</td>\n";
		$output .= "</tr>";
	}
	$output .= "</tablet01>";
	
	echo $output;
?>
