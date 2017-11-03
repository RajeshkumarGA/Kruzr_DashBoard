<?php
//address of the server where db is installed
    $conn = new mysqli(
                       null, // host
                       'root', // username
                       '',     // password
                       '', // database name
                       null,
                       '/cloudsql/ids-testapp:idscloud-db'
                       );

//checking if there were any error during the last connection attempt
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

    $sql = "SELECT * FROM ids_test.DashboardUsers WHERE username = "."'".$_POST['content']."'"." AND password = "."'".$_POST['password']."'".";";
    
    
    $sqlUsers = "Select distinct(user.email),user.firstname, user.phonePrimary , user.gender, user.iduserDetails, user.dob, user.createdDate from ids_test.userDetails as user , ids_test.ActiveUsers as active where (user.iduserDetails = active.userId AND user.email != '') order by user.createdDate DESC ;";
    
    syslog(LOG_INFO,$sql);
    
    $jsonArray = array();
    
    $result = $conn->query($sql);
    
//    if ($result->num_rows > 0) {
//        
//        $row = $result->fetch_assoc();
//        
//        syslog(LOG_INFO, 'username : '.$row["username"]);
    
        $listOfUser = $conn->query($sqlUsers);
        syslog(LOG_INFO,$listOfUser->num_rows."");
        
        if ($listOfUser->num_rows > 0) {
            //Converting the results into an associative array
            while($rowUwe = $listOfUser->fetch_assoc()) {
                $jsonArrayItem = array();
                $jsonArrayItem['label'] = $rowUwe['firstname'];
                $jsonArrayItem['value'] = $rowUwe['gender'];
                //append the above created object into the main array.
                array_push($jsonArray, $jsonArrayItem);
            }
        }
//    }
    
    
    

//initialize the array to store the processed data
//$jsonArray = array();
//
////check if there is any data returned by the SQL Query
//if ($result->num_rows > 0) {
//  //Converting the results into an associative array
//  while($row = $result->fetch_assoc()) {
//    $jsonArrayItem = array();
//    $jsonArrayItem['label'] = $row['player'];
//    $jsonArrayItem['value'] = $row['wickets'];
//    //append the above created object into the main array.
//    array_push($jsonArray, $jsonArrayItem);
//  }
//}

//Closing the connection to DB
$conn->close();

//set the response content type as JSON
header('Content-type: application/json');
//output the return value of json encode using the echo function. 
echo json_encode($jsonArray);
?>
