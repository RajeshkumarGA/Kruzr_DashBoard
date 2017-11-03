<?php
	include 'config.php';
	$data_array = array();
	$maleCounter=0;
	$femaleCounter=0;
	$otherCounter=0;
	if($server){
		$sql_query_user_details = "SELECT * FROM $database.userDetails";
		$query_user_details = $con->query($sql_query_user_details);

		syslog(LOG_INFO,$sql_query_user_details);
		syslog(LOG_INFO,$query_user_details->num_rows);

		if($query_user_details){
			
			$data_array['status'] = 200;
			$data_array['msg'] = 'Data Fetched.';
			$data_array['count'] = $query_user_details->num_rows;
			$data_array['data'] = array();
			while($row=$query_user_details->fetch_assoc()){
				if($row[gender]=='Male'||$row[gender]=='MALE' || $row[gender]=='male'){
					$maleCounter++;
				}
				if($row[gender]=='Female'||$row[gender]=='FEMALE' || $row[gender]=='female'){
					$femaleCounter++;
				}
				else $otherCounter++;

			}
			$data= array('male'=>$maleCounter,'female'=>$femaleCounter,'other'=>$otherCounter);
			array_push($data_array['data'], $data);
		}
		else{
			$data_array['status'] = 404;
			$data_array['msg'] = $sql_query_user_details;
		}
	}
	else{
		$sql_query_user_details = "SELECT * from userdetails";
		$query_user_details = mysqli_query($con,$sql_query_user_details);
		if($query_user_details){
			$data_array['status'] = 200;
			$data_array['msg'] = $sql_query_user_details;
			$data_array['count'] = mysqli_num_rows($query_user_details);
			$data_array['data'] = array();
			while($row=mysqli_fetch_array($query_user_details)){
					if($row[gender]=='Male'||$row[gender]=='MALE' || $row[gender]=='male'){
					$maleCounter++;
				}
				if($row[gender]=='Female'||$row[gender]=='FEMALE' || $row[gender]=='female'){
					$femaleCounter++;
				}
				else $otherCounter++;

			}
			$data= array('male'=>$maleCounter,'female'=>$femaleCounter,'other'=>$otherCounter);
			array_push($data_array['data'], $data);
		}
		else{
			$data_array['status'] = 404;
			$data_array['msg'] = $sql_query_user_details;
		}
	}


	//echo $sql_query_user_details;


	echo json_encode($data_array);
?>
