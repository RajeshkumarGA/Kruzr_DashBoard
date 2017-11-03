<?php
/*error_reporting( E_ALL );
ini_set( "display_errors", 1 );*/

syslog(LOG_INFO,"Inside config");


error_reporting(0);
$server = True;
$servername = "localhost";
$username = "root";
$password = "";

  if($server){
    //ids_test
    $database="ids_test";
  }
  else{
    $database="kruzr_production";
  }

date_default_timezone_set('UTC');
$database_array = array();
$current_date = '20'.date("y-m-d 00:00:00");
$next_date = '20'.date("y-m-d 23:59:59");
$last_week_date = '20'.date('y-m-d 00:00:00',strtotime("-6 Days"));
$half_year_date = '20'.date('y-m-d 23:59:59'); //date("Y-m-d");



if($server){
  $con = new mysqli(
                     null, // host
                     'root', // username
                     '',     // password
                     '', // database name
                     null,
                     '/cloudsql/ids-testapp:idscloud-db'
                     );

  if ($con->connect_error) {
    syslog(LOG_INFO,"Connection Error");
    die("Connection failed: " . $con->connect_error);

  }
  else{
    syslog(LOG_INFO,"Connection Successfull");
  }
}
else{
  $con = mysqli_connect($servername,$username,$password,$database);
}

mysqli_set_charset($con, 'utf8');
if (mysqli_connect_errno())
  {
     syslog(LOG_INFO,"Connection Error");
     $database_array['msg'] = mysqli_connect_error();
     $database_array['status'] = 404;
  }
  else {
     syslog(LOG_INFO,"Connection Successfull");
  	 $database_array['msg'] = "connected";
     $database_array['status'] = 200;
  }

  ?>
