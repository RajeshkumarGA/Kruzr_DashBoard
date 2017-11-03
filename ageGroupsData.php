<?php
	include 'config.php';
	$data_array = array();
	$ageGroup=$_GET['id'];
	switch($ageGroup){
		case 0:
		$first_date= '20'.date('y:m:d',strtotime("-15 Years"));
		$second_date= '19'.date('y:m:d',strtotime("-24 Years"));
		break;
	}
	if($server){
		$sql_query_user_details = "SELECT * FROM $database.userDetails where DATE(dob) between '$second_date' and '$first_date'";
		$query_user_details = $con->query($sql_query_user_details);
		if($query_user_details){
			$data_array['status'] = 200;
			$data_array['msg'] = $sql_query_user_details;
			$data_array['count'] =$query_user_details->num_rows;
			$data_array['data'] = array();
			//echo $data_array['count'];
			while($row=$query_user_details->fetch_assoc())
			{
				if($row[dob]!='Please select your date of Birth')
				{
					$d1 = new DateTime($row[dob]);
					$d2 = new DateTime();
					$diff = $d2->diff($d1);
					$age = $diff->y;
					echo $row[dob].'<br>';
				}
				

			}
		}
		else{
			$data_array['status'] = 404;
			$data_array['msg'] = 'Sql Query Error.';
		}
			
	}
	else{

		$sql_query_user_details = "SELECT * FROM userdetails where DATE(dob) between '$second_date' and '$first_date'";
		$query_user_details = mysqli_query($con,$sql_query_user_details);
		if($query_user_details){
			$data_array['status'] = 200;
			$data_array['msg'] = $sql_query_user_details;
			$data_array['count'] = mysqli_num_rows($query_user_details);
			$data_array['data'] = array();
			//echo $data_array['count'];
			while($row=mysqli_fetch_array($query_user_details))
			{
				if($row[dob]!='Please select your date of Birth')
				{
					$d1 = new DateTime($row[dob]);
					$d2 = new DateTime();
					$diff = $d2->diff($d1);
					$age = $diff->y;
					echo $row[dob].'<br>';
				}
				

			}
		}
		else{
			$data_array['status'] = 404;
			$data_array['msg'] = 'Sql Query Error.';
		}
	}

	echo json_encode($data_array);
?>
