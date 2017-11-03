<?php
	include 'config.php';
	$data_array = array();
	$age = 0;
	$ageRange =[0,0,0,0,0,0,0];
	if($server){

		$sql_query_user_details = "SELECT * FROM $database.userDetails";
		$query_user_details =  $con->query($sql_query_user_details);
		if($query_user_details){
			$data_array['status'] = 200;
			$data_array['msg'] = $sql_query_user_details;
			$data_array['count'] =$query_user_details->num_rows;
			$data_array['data'] = array();
			//echo $data_array['count'];
			$data_of_group0=array();
			$data_of_group0['group']=0;
			$data_of_group0['data']=array();
			$data_of_group1=array();
			$data_of_group1['group']=1;
			$data_of_group1['data']=array();
			$data_of_group2=array();
			$data_of_group2['group']=2;
			$data_of_group2['data']=array();
			$data_of_group3=array();
			$data_of_group3['group']=3;
			$data_of_group3['data']=array();
			$data_of_group4=array();
			$data_of_group4['group']=4;
			$data_of_group4['data']=array();
			$data_of_group5=array();
			$data_of_group5['group']=5;
			$data_of_group5['data']=array();
			$data_of_group6=array();
			$data_of_group6['group']=6;
			$data_of_group6['data']=array();
			while($row=$query_user_details->fetch_assoc())
			{ 				
				if($row[dob]!='Please select your date of Birth')
				{
					$d1 = new DateTime($row[dob]);
					$d2 = new DateTime();
					$diff = $d2->diff($d1);
					$age = $diff->y;
					
					
					if($age>=15 && $age<25){
						$data['userName']=$row['firstname'];
						$data['userEmail']=$row['email'];
						$data['userAppId'] = $row['appIdPrimary'];
						$data['userPhone'] = $row['phonePrimary'];
						$data['userGender'] = $row['gender'];
						$data['userLoginMode'] = $row['loginMode'];
						$data['userCreatedAt'] = $row['createdDate'];
						array_push($data_of_group0['data'],$data);
						$ageRange[0]++;
					}
					else if($age>=25 && $age<35){
						$data['userName']=$row['firstname'];
						$data['userEmail']=$row['email'];
						$data['userAppId'] = $row['appIdPrimary'];
						$data['userPhone'] = $row['phonePrimary'];
						$data['userGender'] = $row['gender'];
						$data['userLoginMode'] = $row['loginMode'];
						$data['userCreatedAt'] = $row['createdDate'];
						array_push($data_of_group1['data'],$data);
						$ageRange[1]++;
					}
					else if($age>=35 && $age<45){
						$data['userName']=$row['firstname'];
						$data['userEmail']=$row['email'];
						$data['userAppId'] = $row['appIdPrimary'];
						$data['userPhone'] = $row['phonePrimary'];
						$data['userGender'] = $row['gender'];
						$data['userLoginMode'] = $row['loginMode'];
						$data['userCreatedAt'] = $row['createdDate'];
						array_push($data_of_group2['data'],$data);
						$ageRange[2]++;
					}
					else if($age>=45 && $age<55){
						$data['userName']=$row['firstname'];
						$data['userEmail']=$row['email'];
						$data['userAppId'] = $row['appIdPrimary'];
						$data['userPhone'] = $row['phonePrimary'];
						$data['userGender'] = $row['gender'];
						$data['userLoginMode'] = $row['loginMode'];
						$data['userCreatedAt'] = $row['createdDate'];
						array_push($data_of_group3['data'],$data);
						$ageRange[3]++;
					}
					else if($age>=55 && $age<65){
						$data['userName']=$row['firstname'];
						$data['userEmail']=$row['email'];
						$data['userAppId'] = $row['appIdPrimary'];
						$data['userPhone'] = $row['phonePrimary'];
						$data['userGender'] = $row['gender'];
						$data['userLoginMode'] = $row['loginMode'];
						$data['userCreatedAt'] = $row['createdDate'];
						array_push($data_of_group4['data'],$data);
						$ageRange[4]++;
					}
					else if($age>=65 && $age<120){
						$data['userName']=$row['firstname'];
						$data['userEmail']=$row['email'];
						$data['userAppId'] = $row['appIdPrimary'];
						$data['userPhone'] = $row['phonePrimary'];
						$data['userGender'] = $row['gender'];
						$data['userLoginMode'] = $row['loginMode'];
						$data['userCreatedAt'] = $row['createdDate'];
						array_push($data_of_group5['data'],$data);
						$ageRange[5]++;}
					else{
						$data['userName']=$row['firstname'];
						$data['userEmail']=$row['email'];
						$data['userAppId'] = $row['appIdPrimary'];
						$data['userPhone'] = $row['phonePrimary'];
						$data['userGender'] = $row['gender'];
						$data['userLoginMode'] = $row['loginMode'];
						$data['userCreatedAt'] = $row['createdDate'];
						array_push($data_of_group6['data'],$data);
						$ageRange[6]++;
					}
				}
				else{
						$data['userName']=$row['firstname'];
						$data['userEmail']=$row['email'];
						$data['userAppId'] = $row['appIdPrimary'];
						$data['userPhone'] = $row['phonePrimary'];
						$data['userGender'] = $row['gender'];
						$data['userLoginMode'] = $row['loginMode'];
						$data['userCreatedAt'] = $row['createdDate'];
						array_push($data_of_group6['data'],$data);
						$ageRange[6]++;
					}

			}
			$data_of_group0['count']=$ageRange[0];
			array_push($data_array['data'],$data_of_group0);
			$data_of_group1['count']=$ageRange[1];
			array_push($data_array['data'],$data_of_group1);
			$data_of_group2['count']=$ageRange[2];
			array_push($data_array['data'],$data_of_group2);
			$data_of_group3['count']=$ageRange[3];
			array_push($data_array['data'],$data_of_group3);
			$data_of_group4['count']=$ageRange[4];
			array_push($data_array['data'],$data_of_group4);
			$data_of_group5['count']=$ageRange[5];
			array_push($data_array['data'],$data_of_group5);
			$data_of_group6['count']=$ageRange[6];
			array_push($data_array['data'],$data_of_group6);
		}
		else{
			$data_array['status'] = 404;
			$data_array['msg'] = 'Sql Query Error.';
		}
		
	}
	else{

		$sql_query_user_details = "SELECT * FROM userdetails";
		$query_user_details = mysqli_query($con,$sql_query_user_details);
		if($query_user_details){
			$data_array['status'] = 200;
			$data_array['msg'] = $sql_query_user_details;
			$data_array['count'] = mysqli_num_rows($query_user_details);
			$data_array['data'] = array();
			//echo $data_array['count'];
			$data_of_group0=array();
			$data_of_group0['group']=0;
			$data_of_group0['data']=array();
			$data_of_group1=array();
			$data_of_group1['group']=1;
			$data_of_group1['data']=array();
			$data_of_group2=array();
			$data_of_group2['group']=2;
			$data_of_group2['data']=array();
			$data_of_group3=array();
			$data_of_group3['group']=3;
			$data_of_group3['data']=array();
			$data_of_group4=array();
			$data_of_group4['group']=4;
			$data_of_group4['data']=array();
			$data_of_group5=array();
			$data_of_group5['group']=5;
			$data_of_group5['data']=array();
			$data_of_group6=array();
			$data_of_group6['group']=6;
			$data_of_group6['data']=array();
			while($row=mysqli_fetch_array($query_user_details))
			{ 				
				if($row[dob]!='Please select your date of Birth')
				{
					$d1 = new DateTime($row[dob]);
					$d2 = new DateTime();
					$diff = $d2->diff($d1);
					$age = $diff->y;
					
					
					if($age>=15 && $age<25){
						$data['userName']=$row['firstname'];
						$data['userEmail']=$row['email'];
						$data['userAppId'] = $row['appIdPrimary'];
						$data['userPhone'] = $row['phonePrimary'];
						$data['userGender'] = $row['gender'];
						$data['userLoginMode'] = $row['loginMode'];
						$data['userCreatedAt'] = $row['createdDate'];
						array_push($data_of_group0['data'],$data);
						$ageRange[0]++;
					}
					else if($age>=25 && $age<35){
						$data['userName']=$row['firstname'];
						$data['userEmail']=$row['email'];
						$data['userAppId'] = $row['appIdPrimary'];
						$data['userPhone'] = $row['phonePrimary'];
						$data['userGender'] = $row['gender'];
						$data['userLoginMode'] = $row['loginMode'];
						$data['userCreatedAt'] = $row['createdDate'];
						array_push($data_of_group1['data'],$data);
						$ageRange[1]++;
					}
					else if($age>=35 && $age<45){
						$data['userName']=$row['firstname'];
						$data['userEmail']=$row['email'];
						$data['userAppId'] = $row['appIdPrimary'];
						$data['userPhone'] = $row['phonePrimary'];
						$data['userGender'] = $row['gender'];
						$data['userLoginMode'] = $row['loginMode'];
						$data['userCreatedAt'] = $row['createdDate'];
						array_push($data_of_group2['data'],$data);
						$ageRange[2]++;
					}
					else if($age>=45 && $age<55){
						$data['userName']=$row['firstname'];
						$data['userEmail']=$row['email'];
						$data['userAppId'] = $row['appIdPrimary'];
						$data['userPhone'] = $row['phonePrimary'];
						$data['userGender'] = $row['gender'];
						$data['userLoginMode'] = $row['loginMode'];
						$data['userCreatedAt'] = $row['createdDate'];
						array_push($data_of_group3['data'],$data);
						$ageRange[3]++;
					}
					else if($age>=55 && $age<65){
						$data['userName']=$row['firstname'];
						$data['userEmail']=$row['email'];
						$data['userAppId'] = $row['appIdPrimary'];
						$data['userPhone'] = $row['phonePrimary'];
						$data['userGender'] = $row['gender'];
						$data['userLoginMode'] = $row['loginMode'];
						$data['userCreatedAt'] = $row['createdDate'];
						array_push($data_of_group4['data'],$data);
						$ageRange[4]++;
					}
					else if($age>=65 && $age<120){
						$data['userName']=$row['firstname'];
						$data['userEmail']=$row['email'];
						$data['userAppId'] = $row['appIdPrimary'];
						$data['userPhone'] = $row['phonePrimary'];
						$data['userGender'] = $row['gender'];
						$data['userLoginMode'] = $row['loginMode'];
						$data['userCreatedAt'] = $row['createdDate'];
						array_push($data_of_group5['data'],$data);
						$ageRange[5]++;}
					else{
						$data['userName']=$row['firstname'];
						$data['userEmail']=$row['email'];
						$data['userAppId'] = $row['appIdPrimary'];
						$data['userPhone'] = $row['phonePrimary'];
						$data['userGender'] = $row['gender'];
						$data['userLoginMode'] = $row['loginMode'];
						$data['userCreatedAt'] = $row['createdDate'];
						array_push($data_of_group6['data'],$data);
						$ageRange[6]++;
					}
				}
				else{
						$data['userName']=$row['firstname'];
						$data['userEmail']=$row['email'];
						$data['userAppId'] = $row['appIdPrimary'];
						$data['userPhone'] = $row['phonePrimary'];
						$data['userGender'] = $row['gender'];
						$data['userLoginMode'] = $row['loginMode'];
						$data['userCreatedAt'] = $row['createdDate'];
						array_push($data_of_group6['data'],$data);
						$ageRange[6]++;
					}

			}
			$data_of_group0['count']=$ageRange[0];
			array_push($data_array['data'],$data_of_group0);
			$data_of_group1['count']=$ageRange[1];
			array_push($data_array['data'],$data_of_group1);
			$data_of_group2['count']=$ageRange[2];
			array_push($data_array['data'],$data_of_group2);
			$data_of_group3['count']=$ageRange[3];
			array_push($data_array['data'],$data_of_group3);
			$data_of_group4['count']=$ageRange[4];
			array_push($data_array['data'],$data_of_group4);
			$data_of_group5['count']=$ageRange[5];
			array_push($data_array['data'],$data_of_group5);
			$data_of_group6['count']=$ageRange[6];
			array_push($data_array['data'],$data_of_group6);
		}
		else{
			$data_array['status'] = 404;
			$data_array['msg'] = 'Sql Query Error.';
		}
	}

	echo json_encode($data_array);
?>
