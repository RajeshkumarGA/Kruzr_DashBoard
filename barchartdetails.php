<?php
	include 'config.php';
	$data_array = array();

	syslog(LOG_INFO,"Inside Line Charts");
	$get_id= $_GET['id'];
	$year='20'.date('y');
	switch($get_id){
		case 0 :
		$month= date('m')-5;
		if($month<0){
			$month=13+$month;
			$year=$year-1;
		}
		break;
		case 1 :
		$month= date('m')-4;
		if($month<0){
			$month=13+$month;
			$year=$year-1;
		}
		break;
		case 2 :
		$month= date('m')-3;
		if($month<0){
			$month=13+$month;
			$year=$year-1;
		}
		break;
		case 3 :
		$month= date('m')-2;
		if($month<0){
			$month=13+$month;
			$year=$year-1;
		}
		break;
		case 4 :
		$month= date('m')-1;
		if($month<0){
			$month=13+$month;
			$year=$year-1;
		}
		break;
		case 5 :
		$month= date('m');
		if($month<0){
			$month=13+$month;
			$year=$year-1;
		}
		break;
		case 6 :
		$month= date('m')+1;
		break;

	}


	if($server){
		$sql_query_user_details = "SELECT * FROM $database.userDetails where MONTH(createdDate)='$month' and YEAR(createdDate)='$year' ";
		$query_user_details = $con->query($sql_query_user_details);

		syslog(LOG_INFO,$sql_query_user_details);
		syslog(LOG_INFO,$query_user_details->num_rows);


		if($query_user_details){
			$data_array['status'] = 200;
			$data_array['msg'] = 'Data Fetched.';
			$data_array['count'] = $query_user_details->num_rows;
			$data_array['data'] = array();
			while($row=$query_user_details->fetch_assoc()){
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
		else{
			$data_array['status'] = 404;
			$data_array['msg'] = $sql_query_user_details;
		}
	}
	else{
		$sql_query_user_details = "SELECT * FROM userDetails where MONTH(createdDate)='$month' and YEAR(createdDate)='$year'";
		$query_user_details = mysqli_query($con,$sql_query_user_details);
		if($query_user_details){
			$data_array['status'] = 200;
			$data_array['msg'] = $sql_query_user_details;
			$data_array['count'] = mysqli_num_rows($query_user_details);
			$data_array['data'] = array();
			while($row=mysqli_fetch_array($query_user_details)){
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
		else{
			$data_array['status'] = 404;
			$data_array['msg'] = $sql_query_user_details;
		}
	}


	//echo $sql_query_user_details;


	echo json_encode($data_array);
?>
