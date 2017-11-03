<html >
    <head>
        <meta charset="UTF-8">
        <title>Kruzr Dashboard</title>
        <link type="text/css" media="all" rel="stylesheet" href="/css/style.css" />
        <script src="js/jquery-3.2.1.js"></script>
        <script src="js/index.js"></script>

<?php
    // [START formprocessing]
    
    $listOfUser = null;
    
    if (array_key_exists('content', $_POST)) {

        $conn = new mysqli(
                           null, // host
                           'root', // username
                           '',     // password
                           '', // database name
                           null,
                           '/cloudsql/ids-testapp:idscloud-db'
                           );
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        
        $sql = "SELECT * FROM ids_test.DashboardUsers WHERE username = "."'".$_POST['content']."'"." AND password = "."'".$_POST['password']."'".";";
        
        
        $sqlUsers = "Select distinct(user.email),user.firstname, user.phonePrimary , user.gender, user.iduserDetails, user.dob, user.createdDate from ids_test.userDetails as user , ids_test.ActiveUsers as active where (user.iduserDetails = active.userId AND user.email != '') order by user.createdDate DESC ;";
        
        syslog(LOG_INFO,$sql);
        
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            
            $row = $result->fetch_assoc();
            
            syslog(LOG_INFO, 'username : '.$row["username"]);
           
            $listOfUser = $conn->query($sqlUsers);
            syslog(LOG_INFO,$listOfUser->num_rows."");
            
            echo "<table><tr><th>Email</th><th>Name</th><th>Phone</th><th>Gender</th><th>Uid</th><th>dob</th><th>createdDate</th></tr>";
            while($rowUsers = mysqli_fetch_array($listOfUser)) {
                echo "<tr>";
                echo "<td>" . $rowUsers['email'] . "</td>";
                echo "<td>" . $rowUsers['firstname'] . "</td>";
                echo "<td>" . $rowUsers['phonePrimary'] . "</td>";
                echo "<td>" . $rowUsers['gender'] . "</td>";
                echo "<td>" . $rowUsers['iduserDetails'] . "</td>";
                echo "<td>" . $rowUsers['dob'] . "</td>";
                echo "<td>" . $rowUsers['createdDate'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
            
            
            ?>
                <script>

                    $(document).ready(function(){
                            $("#login").hide();
//                            $("#dashboard").show();
                                   
                                      
//                                      $.each(data, function() {index, row){
//
//                                      var name  = row.email;
//                                      
//                                      
//                                      
//                                      $("#users").append('<tr><td>'+name+'</td><td>'+name+'</td>'+
//                                                         '<td>'+name+'</td><td>'+name+'</td><td>'+name+'</td><td>'+name+'</td><td>'+name+'</td></tr>');
//                                      });
                                      
//                            if ($listOfUser->num_rows > 0) {
//                                while($rowUsers = $listOfUser->fetch_assoc()) {
//                                      $("#users").append('<tr><td>'.$rowUsers["email"].'</td><td>'.$rowUsers["firstname"].'</td>'.
//                                                         '<td>'.$rowUsers["phonePrimary"].'</td><td>'.$rowUsers["gender"].'</td><td>'.$rowUsers["iduserDetails"].'</td><td>'.$rowUsers["dob"].'</td><td>'.$rowUsers["createdDate"].'</td></tr>');
//                                }
//                            }
                                      
                            
                        });



                </script>

            <?php
                
                
        }
        else{
            syslog(LOG_INFO,'Empty Response');
        }
    }
    // [END formprocessing]
    ?>

    </head>
    <body>
    <div class="login-page" id="login">
    <div class="form">
        <form class="login-form" action="/dashboard" method="post">
            <input name="content" type="text" placeholder="username"/>
            <input name="password" type="password" placeholder="password"/>
            <input type="submit" value="Sign In">

        </form>
    </div>
    </div>

    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            padding: 5px;
        }
    th {
        text-align: left;
    }
    </style>

    <div class="hiddenPage" id="dashboard">
        <table style="width:100%" id = "users">
            <tr>
                <th>Email</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Gender</th>
                <th>Uid</th>
                <th>dob</th>
                <th>createdDate</th>
            </tr>
        </table>
    </div>


    </body>
</html>

