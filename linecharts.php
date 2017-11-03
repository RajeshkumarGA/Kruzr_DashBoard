<?php
	include 'config.php';
	$data_array = array();

	syslog(LOG_INFO,"Inside Line Charts");


	if($server){
		$sql_query_user_details = "SELECT DATE(createdDate) AS forDate, COUNT(*) AS downloadsCount FROM $database.userDetails where createdDate between '$last_week_date' and '$next_date' GROUP BY DATE(createdDate)";
		$query_user_details = $con->query($sql_query_user_details);

		syslog(LOG_INFO,$sql_query_user_details);
		syslog(LOG_INFO,$query_user_details->num_rows);


		if($query_user_details){
			$data_array['status'] = 200;
			$data_array['msg'] = 'Data Fetched.';
			$data_array['count'] = $query_user_details->num_rows;
			$data_array['data'] = array();
			while($row=$query_user_details->fetch_assoc()){
				$data = array('date' =>$row[forDate] ,'downloadsCountPerDay'=>$row[downloadsCount]);
				array_push($data_array[data], $data);
			}
		}
		else{
			$data_array['status'] = 404;
			$data_array['msg'] = $sql_query_user_details;
		}
	}
	else{
		$sql_query_user_details = "SELECT DATE(createdDate) AS forDate, COUNT(*) AS downloadsCount FROM userdetails where createdDate between '$last_week_date' and '$next_date' GROUP BY DATE(createdDate)";
		$query_user_details = mysqli_query($con,$sql_query_user_details);
		if($query_user_details){
			$data_array['status'] = 200;
			$data_array['msg'] = $sql_query_user_details;
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
	}


	//echo $sql_query_user_details;


	echo json_encode($data_array);
?>
