<!DOCTYPE html>
<html lang="en">
<?php
session_start();
$path = $_SESSION['path'];

//Inclusion of files
require_once($path . '/Class/User.php');
require_once($path . '/Class/SystemAdmin.php');

//Mongodb client configuration
require_once $path . '/vendor/autoload.php';

$user_id = $_SESSION['_id'];

$error = ''; // Variable To Store Error Message
    if (isset($_POST['ViewAUser'])) {
        
        // check if it exist in database
        $user = new SystemAdmin($_SESSION['_id']);
        $UserAccount = $user->ViewAUser($_POST['_id']);
    }

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Administrator Homepage</title>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <?php include 'navbar.php' ?>

    <div class="container" id="homepage">
        <h1>View A User</h1>
    </div>

    <table style="color:white">
    <?php foreach ($UserAccount as $User) {
        echo "<tr><td>Username: " . $User['_id'] . "</tr></td>";
        echo "<tr><td>Password: " . $User['password'] . "</tr></td>"; 
        echo "<tr><td>First Name: " . $User['firstname'] . "</tr></td>"; 
        echo "<tr><td>Last Name: " . $User['lastname'] . "</tr></td>"; 
        echo "<tr><td>Gender: " . $User['gender'] . "</tr></td>"; 
        echo "<tr><td>Contact: " . $User['contact'] . "</tr></td>"; 
        echo "<tr><td>Profile: " . $User['profile'] . "</tr></td>";
        echo "<tr><td>Email: " . $User['email'] . "</tr></td>";
        echo "<tr><td>Date Of Birth: " . $User['dob'] . "</tr></td>";
        if(isset($User['businessname']) == true){
            echo "<tr><td>Business Name: " . $User['businessname'] . "</tr></td>"; 
        }
    }?> 
    </table>
</body>
</html>