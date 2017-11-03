<?php
    include 'config.php';
    $data_array = array();

    syslog(LOG_INFO,"Inside Active Users download file");


    if($server){
        $sql_query_user_ids = "SELECT * FROM $database.ActiveUsers;";
        $query_user_ids = $con->query($sql_query_user_ids);
        syslog(LOG_INFO,"Num of Active users".$query_user_ids->num_rows);
    }
    else{
        $sql_query_user_ids = "SELECT * FROM activeusers";
        $query_user_ids = mysqli_query($con,$sql_query_user_ids);
    }
    if($query_user_ids){

        if($server){
            $sql_query_user_details = "SELECT * FROM $database.userDetails WHERE iduserdetails IN (SELECT userid FROM $database.ActiveUsers);";
            $query_user_details = $con->query($sql_query_user_details);
            if($query_user_details){
                $data_array['status'] = 200;
                $data_array['msg'] = 'Data Fetched.';
                $data_array['count'] = $query_user_details->num_rows; //mysqli_num_rows($query_user_details);
                $data_array['data'] = array();

                while($row = $query_user_details->fetch_assoc()) {
                // while($row=mysqli_fetch_array($query_user_details)){
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
        }
        else{
            $sql_query_user_details = "SELECT * FROM userdetails WHERE iduserdetails IN (SELECT userid FROM activeusers)";
            $query_user_details = mysqli_query($con,$sql_query_user_details);
            if($query_user_details){
                $data_array['status'] = 200;
                $data_array['msg'] = 'Data Fetched.';
                $data_array['count'] = mysqli_num_rows($query_user_details); //mysqli_num_rows($query_user_details);
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
        }

    
    }
    else{
        $data_array['status'] = 404;
        $data_array['msg'] = 'Sql Query Error.';
    }
    echo json_encode($data_array);
?>