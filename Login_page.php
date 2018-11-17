<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to RBC</title>
</head>
<body>
<form method="post">
    <h1>RBC Personal banking system</h1>

    <p>User ID:<input type="text" name="userid"/></p>
    <p>User Password:<input type="password" name="password"/></p>

    <input type="submit" value="Login" name="login"/>
    <input type="submit" value="Forget password" name="forget"/>
</form>

</body>
</html>
<?php
session_start();
$host = "localhost";
$user = "root";
$password = "";
$dbName = "ngi";

// Database connecting
$con = mysqli_connect($host,$user,$password,$dbName) or die("Connection failed");
if(isset($_POST['login'])) {
    if (empty($_POST["userid"]) || empty($_POST["password"])) {
        echo "You need to fill up all the form fields";
    } else {
        // Gets login information from text boxes
        $user1 = mysqli_real_escape_string($con,$_POST["userid"]);
        $pass =  mysqli_real_escape_string($con,$_POST["password"]);

        $query2 = "select * from userlogin where userId = '$user1' and password = '$pass'";
        $result2 = mysqli_query($con, $query2) or die ("Query failed" . mysqli_error($con));

        $query3 = "select * from userlogin where userId = '$user1' and password = '$pass'";
        $result3 = mysqli_query($con, $query3) or die ("Query failed" . mysqli_error($con));

        //check if user is employee/guest or admin then saves user to session and changes to next page
        if (mysqli_num_rows($result2) > 0 ) {

            $_SESSION['userId'] = $user1;
            header('location:Project-SubmitReport.php');
            exit();
        }
        elseif (mysqli_num_rows($result3) > 0 && mysqli_num_rows($result4) <= 0){
            $_SESSION['userId'] = $user1;
            header('location:Project-SubmitReport.php');
            exit();
        }
        else {

            echo "<h1>The account does not exist</h1>";
        }

    }

}
//heads to create account page
elseif (isset($_POST['forget'])){
    header('location:Project-CreateAccount.php');
}




mysqli_close($con);