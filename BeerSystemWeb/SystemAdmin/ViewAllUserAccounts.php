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
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
    <link href="style.css" rel="stylesheet" type="text/css">

<style>
</style>
</head>
<body>
    <?php include 'navbar.php' ?>
    <div class="container" id="users">
        <p>Users</p>
    </div>

    <table style="color: red" >    
    <?php
        $SysAdmin = new SystemAdmin($_SESSION['_id']);
        $UserAccounts = $SysAdmin->ViewAllUsers();

        //From here for u to design
        foreach ($UserAccounts as $User) {
            ?><tr><td><?php
            echo $User['_id']; ?> </td>
            <td><?php
            echo $User['firstname']; ?> </td>
            <td><?php
            echo $User['lastname']; ?> </td>
            <td><?php
            echo $User['email']; 
            }; ?> </td></tr>
    </table>
</body>
</html>