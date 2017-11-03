<?php
	include 'config.php';
	$data_array = array();

	syslog(LOG_INFO,"Inside Line Charts");


	if($server){
		$sql_query_user_details = "SELECT DATE(createdDate) AS forDate, COUNT(*) AS downloadsCount FROM ids_test.userDetails where createdDate between '$next_date' and '$last_week_date' GROUP BY DATE(createdDate)";
	}
	else{
		$sql_query_user_details = "SELECT DATE(createdDate) AS forDate, COUNT(*) AS downloadsCount FROM userdetails where createdDate between '$next_date' and '$last_week_date' GROUP BY DATE(createdDate)";
	}


	//echo $sql_query_user_details;
	$query_user_details = mysqli_query($con,$sql_query_user_details);
	if($query_user_details){
		$data_array['status'] = 200;
		$data_array['msg'] = 'Data Fetched.';
		$data_array['count'] = mysqli_num_rows($query_user_details);
		$data_array['data'] = array();
		while($row=mysqli_fetch_array($query_user_details)){
			$data = array('date' =>$row[forDate] ,'downloadsCountPerDay'=>$row[downloadsCount]);
			array_push($data_array[data], $data);
		}
	}
	else{
		$data_array['status'] = 404;
		$data_array['msg'] = $sql_query_user_details;
	}

	echo json_encode($data_array);
?>
