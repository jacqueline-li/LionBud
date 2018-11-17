<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to RBC</title>
</head>
<body>
<form method="post">
    <h1>Choose three functions!:</h1>

    <p><button>Tracking your account</button></p>
    <p><button>Main Page</button></p>
    <p><button>Setting</button></p>


</form>

</body>
</html>
<?php
session_start();
if(isset($_POST['submit'])) {

    //Declaring some variables to connect to DB
    $host = "localhost";
    $user = "root";
    $password = "";
    $dbName = "project-xyz";


    //Connect to the Server + Select DB
    $con = mysqli_connect($host, $user, $password, $dbName) or die("Connection is failed");

    //Formulate Query and Pose the Query
    $issue = $_POST['issue'];
    $desc = $_POST['desc'];
    $level = $_POST['level'];
    $location = $_POST['location'];
    //retrieve username from previous page
    $eUser = $_SESSION['eUser'];
    $gUser = $_SESSION['gUser'];
    //checks if user is employee or guest and then adds to that specific table
    if(!empty($eUser)) {
        $email = mysqli_query($con,"select * from employee where eName = '$eUser'");
        //retrieves the email from username from the table
        $row = mysqli_fetch_assoc($email);
        $mail = $row['eEmail'];
        $query = "Insert into report values ('$mail','$desc','$level','$location','$eUser',curdate())";

    }
    else if(!empty($gUser)) {
        $email = mysqli_query($con,"select * from guest where gName = '$gUser'");
        $row = mysqli_fetch_assoc($email);
        $mail = $row['gEmail'];
        $query = "Insert into report values ('$mail','$desc','$level','$location','$gUser',curdate())";


    }
    function Alert($msg) {
        echo '<script type="text/javascript">alert("' . $msg . '")</script>';
    }

    Alert("Report Successfully submitted");
//open a write to a log file to store username and date
    $result = mysqli_query($con, $query) or die ("query is failed!" . mysqli_error($con));
    $myfile = fopen('log.txt','a');
    $mydata = $eUser.$gUser. " " .date( 'Y-m-d h:i:s A')."\n";

//write

    fwrite($myfile,$mydata);
//close

    fclose($myfile);

    //Close the connection
    mysqli_close($con);
}

