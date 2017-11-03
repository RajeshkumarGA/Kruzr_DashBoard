<?php
include 'config.php';
$username=$_POST['userName'];
$password= $_POST['password'];
$currenttime='20'.Date('y:m:d H:i:s');
$password=md5($password);
$data_array = array();
//echo 'in';
if($server){

}
else{
	//echo 'in';
	$admin_query="SELECT * from adminpanel where userName='$username' and userPassword='$password'";
	$status = mysqli_query($con,$admin_query);
	

	//echo $admin_query;
	if($status){
		$update_status_query = "UPDATE adminpanel set updateStatus='Active' and updatedOn='$currenttime' where userName='$username'";
		$updatestatus = mysqli_query($con,$update_status_query);

		$data_array['status']=200;
		$data_array['msg']= 'user matched';
	}
	else{
		$data_array['status']=404;
		$data_array['msg']= 'user did not match';
	}
}
echo json_encode($data_array);
?>