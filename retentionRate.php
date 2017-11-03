<?php
	include 'config.php';
	$data_array = array();

	syslog(LOG_INFO,"Inside bar Charts");


	if($server)
	{
		$sql_query_user_details_day1_retention = "SELECT * FROM $database.userDetails WHERE createdDate  between '$last1_date' and '$current_date' and iduserDetails IN (SELECT userid FROM $database.ActiveUsers)";
		//echo $sql_query_user_details_day1_retention.'<br/>';
		$sql_query_user_details_day2_retention = "SELECT * FROM $database.userDetails WHERE createdDate  between '$last2_date' and '$last1_date' and iduserDetails IN (SELECT userid FROM $database.ActiveUsers)";
		//echo $sql_query_user_details_day2_retention.'<br/>';
		$sql_query_user_details_day3_retention = "SELECT * FROM $database.userDetails WHERE createdDate  between '$last3_date' and '$last2_date' and iduserDetails IN (SELECT userid FROM $database.ActiveUsers)";
		//echo $sql_query_user_details_day3_retention.'<br/>';
		$sql_query_user_details_day4_retention = "SELECT * FROM $database.userDetails WHERE createdDate  between '$last4_date' and '$last3_date' and iduserDetails IN (SELECT userid FROM $database.ActiveUsers)";
		//echo $sql_query_user_details_day4_retention.'<br/>';
		$sql_query_user_details_day5_retention = "SELECT * FROM $database.userDetails WHERE createdDate  between '$last5_date' and '$last4_date' and iduserDetails IN (SELECT userid FROM $database.ActiveUsers)";
		//echo $sql_query_user_details_day5_retention.'<br/>';
		$sql_query_user_details_day6_retention = "SELECT * FROM $database.userDetails WHERE createdDate  between '$last6_date' and '$last5_date' and iduserDetails IN (SELECT userid FROM $database.ActiveUsers)";
		//echo $sql_query_user_details_day6_retention.'<br/>';
	    //echo $arrayName;
		$query_user_details1 = $con->query($sql_query_user_details_day1_retention);
		$query_user_details2 = $con->query($sql_query_user_details_day2_retention);
		$query_user_details3 = $con->query($sql_query_user_details_day3_retention);
		$query_user_details4 = $con->query($sql_query_user_details_day4_retention);
		$query_user_details5 = $con->query($sql_query_user_details_day5_retention);
		$query_user_details6 = $con->query($sql_query_user_details_day6_retention);
		//echo 'out';
		if($query_user_details1)
		{
			$data_array['status'] = 200;
			$data_array['msg'] = 'Data Fetched.';
			$data_array['count']=array();
			$data_array['data']=array();
			//echo 'out';
			//$data_array['count'] = mysqli_num_rows($query_user_details);
			$data_count=array();
			$data_count[] = $query_user_details1->num_rows;
			$data_count[] = $query_user_details2->num_rows;
			$data_count[] = $query_user_details3->num_rows;
			$data_count[] = $query_user_details4->num_rows;
			$data_count[] = $query_user_details5->num_rows;
			$data_count[] = $query_user_details6->num_rows;
			$data_array['count'] = $data_count;
			$data = array();
				
		}
		else
		{
			$data_array['status'] = 404;
			$data_array['msg'] = $sql_query_user_details;
		}
	}
	else
	{ 
		//echo "in";
		$sql_query_user_details_day1_retention = "SELECT * FROM userdetails WHERE createdDate  between '$last1_date' and '$current_date' and iduserDetails IN (SELECT userid FROM activeusers)";
		//echo $sql_query_user_details_day1_retention.'<br/>';
		$sql_query_user_details_day2_retention = "SELECT * FROM userdetails WHERE createdDate  between '$last2_date' and '$last1_date' and iduserDetails IN (SELECT userid FROM activeusers)";
		//echo $sql_query_user_details_day2_retention.'<br/>';
		$sql_query_user_details_day3_retention = "SELECT * FROM userdetails WHERE createdDate  between '$last3_date' and '$last2_date' and iduserDetails IN (SELECT userid FROM activeusers)";
		//echo $sql_query_user_details_day3_retention.'<br/>';
		$sql_query_user_details_day4_retention = "SELECT * FROM userdetails WHERE createdDate  between '$last4_date' and '$last3_date' and iduserDetails IN (SELECT userid FROM activeusers)";
		//echo $sql_query_user_details_day4_retention.'<br/>';
		$sql_query_user_details_day5_retention = "SELECT * FROM userdetails WHERE createdDate  between '$last5_date' and '$last4_date' and iduserDetails IN (SELECT userid FROM activeusers)";
		//echo $sql_query_user_details_day5_retention.'<br/>';
		$sql_query_user_details_day6_retention = "SELECT * FROM userdetails WHERE createdDate  between '$last6_date' and '$last5_date' and iduserDetails IN (SELECT userid FROM activeusers)";
		//echo $sql_query_user_details_day6_retention.'<br/>';


	    //echo $arrayName;
		$query_user_details1 = mysqli_query($con,$sql_query_user_details_day1_retention);
		$query_user_details2 = mysqli_query($con,$sql_query_user_details_day2_retention);
		$query_user_details3 = mysqli_query($con,$sql_query_user_details_day3_retention);
		$query_user_details4 = mysqli_query($con,$sql_query_user_details_day4_retention);
		$query_user_details5 = mysqli_query($con,$sql_query_user_details_day5_retention);
		$query_user_details6 = mysqli_query($con,$sql_query_user_details_day6_retention);
		//echo 'out';
		if($query_user_details1)
		{
			$data_array['status'] = 200;
			$data_array['msg'] = 'Data Fetched.';
			$data_array['count']=array();
			$data_array['data']=array();
			//echo 'out';
			//$data_array['count'] = mysqli_num_rows($query_user_details);
			$data_count=array();
			$data_count[] = mysqli_num_rows($query_user_details1);
			$data_count[] = mysqli_num_rows($query_user_details2);
			$data_count[] = mysqli_num_rows($query_user_details3);
			$data_count[] = mysqli_num_rows($query_user_details4);
			$data_count[] = mysqli_num_rows($query_user_details5);
			$data_count[] = mysqli_num_rows($query_user_details6);
			$data_array['count']= $data_count;
			$data = array();
			
		}
		else
		{
			$data_array['status'] = 404;
			$data_array['msg'] = $sql_query_user_details;
		}
	}


	echo json_encode($data_array);
?>
