<?php
	include 'config.php';
	$data_array = array();

	//syslog(LOG_INFO,"Inside Daily Downloads");
	if($server){
		$sql_query= "SELECT * from $database.activeusers";
		$query_user_details = $con->query($sql_query);
		while($row=$query_user_details->fetch_assoc()){ 
		
			$sql_check_query="SELECT * from $database.totalactiveusers where createdAT between '$current_date' and '$next_date' and userid='$row[userId]'";
			$sql_check_query_details = $con->query($sql_check_query);
			if($sql_check_query_details->num_rows > 0);
			else{
				// echo $row[userId];
				$sql_insert_query ="INSERT INTO $database.totalactiveusers(userId,createdAt) values ('$row[userId]',NOW(); )";
				echo $sql_insert_query ;
			}
		}

	}
	else{
		$sql_query= 'SELECT * from activeusers';
		$query_user_details = mysqli_query($con,$sql_query);
		while($row=mysqli_fetch_array($query_user_details)){ 
		
			$sql_check_query="SELECT * from totalactiveusers where createdAT between '$current_date' and '$next_date' and userid='$row[userId]'";
			$sql_check_query_details = mysqli_query($con,$sql_check_query);
			if(mysqli_num_rows($sql_check_query_details)>0);
			else{
				// echo $row[userId];
				$sql_insert_query ="INSERT INTO totalactiveusers(userId,createdAt) values ('$row[userId]',NOW(); )";
				echo $sql_insert_query ;
			}
		}
	}
?>