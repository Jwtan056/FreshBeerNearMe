<!DOCTYPE html>
<html lang="en">
<?php
session_start();

//Inclusion of files
require_once('../Class/User.php');
require_once('../Class/SystemAdmin.php');

//Mongodb client configuration
require_once '../vendor/autoload.php';

$user_id = $_SESSION['_id'];

?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Administrator Homepage</title>
    <link href="../style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <?php include 'navbar.php' ?>

    <div class="container" id="homepage">
        <h1><?php echo "Welcome $user_id!"?> </h1>
    </div>
</body>
</html>