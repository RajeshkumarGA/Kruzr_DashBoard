<?php
include 'config.php';
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$username = $request->userName;
$password = $request->password;
$currenttime='20'.Date('y:m:d H:i:s');
$password=md5($password);
$data_array = array();
if($server){

}
else{
	$admin_query="SELECT * from adminpanel where userName='$username' and userPassword='$password'";
	$status = mysqli_query($con,$admin_query);
	if(mysqli_num_rows($status)>0){
		$data_array['status']=200;
		$data_array['msg']= 'user matched';
	}
	else{
		$data_array['status']=404;
		$data_array['msg']='Fake User';
	}
}
echo json_encode($data_array);
?>