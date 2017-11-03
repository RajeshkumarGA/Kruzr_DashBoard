<?php
      error_reporting( E_ALL );
      ini_set( "display_errors", 1 );

      syslog(LOG_INFO,"Inside config");


      error_reporting(0);
      $server = false;
      $servername = "localhost";
      $username = "root";
      $password = "";
      if($server){
          //ids_test
          $database="ids_test";
        }
        else{
          $database="ids_test";
        }

      date_default_timezone_set('UTC');
      $database_array = array();
      $current_date = '20'.date("y-m-d 00:00:00");
      $next_date = '20'.date("y-m-d 23:59:59");
      $last1_date = '20'.date("y-m-d 00:00:00",strtotime("-1 Days"));
      $last2_date = '20'.date("y-m-d 00:00:00",strtotime("-2 Days"));
      $last3_date = '20'.date("y-m-d 00:00:00",strtotime("-3 Days"));
      $last4_date = '20'.date("y-m-d 00:00:00",strtotime("-4 Days"));
      $last5_date = '20'.date("y-m-d 00:00:00",strtotime("-5 Days"));
      $last6_date = '20'.date("y-m-d 00:00:00",strtotime("-6 Days"));
      $last_month_date = '20'.date("y-m-d 00:00:00",strtotime("-31 Days"));

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
