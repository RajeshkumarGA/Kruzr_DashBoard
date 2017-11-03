<?php
	include 'config.php';
	$data_array = array();

	syslog(LOG_INFO,"Inside Line Charts");
	$get_id= $_GET['id'];
	switch($get_id)
	{
		case 0 :
			$date1 = $current_date;
			$date2 = $last1_date;
		break;
		case 1 :
			$date1 = $last1_date;
			$date2 = $last2_date;
		break;
		case 2 :
			$date1 = $last2_date;
			$date2 = $last3_date;
		break;
		case 3 :
			$date1 = $last3_date;
			$date2 = $last4_date;
		break;
		case 4 :
			$date1 = $last4_date;
			$date2 = $last5_date;
		break;
		case 5 :
			$date1 = $last5_date;
			$date2 = $last6_date;
		break;	
	}


	if($server)
	{
		$sql_query_user_details_retention = "SELECT * FROM $database.userDetails WHERE createdDate  between '$date2' and '$date1' and iduserDetails IN (SELECT userid FROM $database.ActiveUsers)";
		$query_user_details = $con->query($sql_query_user_details);

		syslog(LOG_INFO,$sql_query_user_details);
		syslog(LOG_INFO,$query_user_details->num_rows);


		if($query_user_details)
		{
			$data_array['status'] = 200;
			$data_array['msg'] = 'Data Fetched.';
			$data_array['count'] = $query_user_details->num_rows;
			$data_array['data'] = array();
			while($row=$query_user_details->fetch_assoc())
			{
				$data = array();
				$data['userName'] = $row['firstname']." ".$row['lastname'];
				$data['userEmail'] = $row['email'];
				$data['userAppId'] = $row['appIdPrimary'];
				$data['userPhone'] = $row['phonePrimary'];
				$data['userGender'] = $row['gender'];
				$data['userLoginMode'] = $row['loginMode'];
				$data['userCreatedAt'] = $row['createdDate'];
				array_push($data_array['data'], $data);
			}
		}
		else
		{
			$data_array['status'] = 404;
			$data_array['msg'] = $sql_query_user_details;
		}
	}

	else
	{
		$sql_query_user_details_retention = "SELECT * FROM userdetails WHERE createdDate  between '$date2' and '$date1' and iduserDetails IN (SELECT userid FROM activeusers)";
		$query_user_details = mysqli_query($con,$sql_query_user_details_retention);

		if($query_user_details)
		{
			$data_array['status'] = 200;
			$data_array['msg'] = $sql_query_user_details;
			$data_array['count'] = mysqli_num_rows($query_user_details);
			$data_array['data'] = array();

			while($row=mysqli_fetch_array($query_user_details))
			{
				$data = array();
				$data['userName'] = $row['firstname']." ".$row['lastname'];
				$data['userEmail'] = $row['email'];
				$data['userAppId'] = $row['appIdPrimary'];
				$data['userPhone'] = $row['phonePrimary'];
				$data['userGender'] = $row['gender'];
				$data['userLoginMode'] = $row['loginMode'];
				$data['userCreatedAt'] = $row['createdDate'];
				array_push($data_array['data'], $data);
			}
		}

		else
		{
			$data_array['status'] = 404;
			$data_array['msg'] = $sql_query_user_details;
		}
	}
	//echo $sql_query_user_details;
	echo json_encode($data_array);
?>
