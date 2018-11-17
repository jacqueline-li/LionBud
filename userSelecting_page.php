<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to RBC</title>
</head>
<body>
<form method="post">
    <h1>RBC Personal banking system</h1>
    <h3>Choose three functions!</h3>

    <p><button type = "submit" name = "track">Tracking your account</button></p>
    <p><button type = "submit" name = "main">Main Page</button></p>
    <p><button type = "submit" name = "setting">Setting</button></p>

</form>

</body>
</html>
<?php
if(isset($_POST['track'])) {
    header('location:trackAccount_page.php');
}
elseif (isset($_POST['create'])){
    header('location:Project-CreateAccountEMP.php');
}
elseif (isset($_POST['reports'])){
    header('location:Project-ViewReports.php');
}