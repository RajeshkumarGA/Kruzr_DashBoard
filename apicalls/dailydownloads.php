<?php
	include 'config.php';
	$data_array = array();


	syslog(LOG_INFO,"Inside Daily Downloads");

	if($server){
		$sql_query_user_details = "SELECT * FROM ids_test.userDetails WHERE createdDate  between '$current_date' and '$next_date'";
	}
	else{
		$sql_query_user_details = "SELECT * FROM userdetails WHERE createdDate  between '$current_date' and '$next_date'";
	}



	$query_user_details = mysqli_query($con,$sql_query_user_details);
	if($query_user_details){
		$data_array['status'] = 200;
		$data_array['msg'] = 'Data Fetched.';
		$data_array['count'] = mysqli_num_rows($query_user_details);
		$data_array['data'] = array();
		while($row=mysqli_fetch_array($query_user_details)){
			$data = array();
			$data['userName'] = $row['firstname']." ".$row['lastname'];
			$data['userEmail'] = $row['email'];
			$data['userAppId'] = $row['appIdPrimary'];
			$data['userPhone'] = $row['phonePrimary'];
			$data['userGender'] = $row['gender'];
			$data['userCreatedAt'] = $row['createdDate'];

			array_push($data_array['data'], $data);
		}
	}
	else{
		$data_array['status'] = 404;
		$data_array['msg'] = 'Sql Query Error.';
	}

	echo json_encode($data_array);
?>
