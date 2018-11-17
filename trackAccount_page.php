<?php
// declaring some variables
$host = "localhost";
$user = "root";
$password = "";
$dbName = "ngi";
$Desc = '';
$Price = '';
$Date = '';

//Connect to the Server+Select DB
$con = mysqli_connect($host, $user, $password, $dbName)
or die("Connection is failed");


//Find
if(isset($_POST['FIND'])){
    $Desc = $_POST['desc'];

    $query = "Select * from userHistory where exTitle = '$Desc'";
    $result = mysqli_query($con, $query) or die ("query is failed" . mysqli_error($con));
    if (($row = mysqli_fetch_row($result)) == true) {

        $Desc = $row[1];
        $Price = $row[2];
        $Date = $row[3];
    }
    else echo "Record not found";
}

//Retrieve All
$query = "Select * from userhistory";
$result = mysqli_query($con, $query) or die ("query is failed" . mysqli_error($con));

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="Project-basic.css">
    <meta charset="UTF-8">
    <title>Search Form</title>
</head>
<body>

<h3 id="second_title"> - History of your account - </h3>
<?php
echo "<table  border='1' >";
echo "<tr><th>Description</th><th>Price</th><th>Date</th></tr>";
while (($row = mysqli_fetch_row($result)) == true) {
    echo "<tr><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td></tr>";
}
echo "</table>";
?>
</body>
</html>