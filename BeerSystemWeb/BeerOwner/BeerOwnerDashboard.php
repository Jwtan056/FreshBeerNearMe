<!DOCTYPE html>
<html lang="en">
<?php
session_start();

//Inclusion of files
require_once('../Class/User.php');
require_once('../Class/BeerOwner.php');

//Mongodb client configuration
require_once '../vendor/autoload.php';

$user_id = $_SESSION['_id'];

?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/FYP/style.css" rel="stylesheet" type="text/css">
    <title>Beer Owner Homepage</title>
</head>

<body>
    <?php include 'boNavbar.php' ?>
    <link href="../style.css" rel="stylesheet" type="text/css">
    
    <div class="container" id="homepage">
        <link href="../style.css" rel="stylesheet" type="text/css">
        <h1><h1><?php echo "Welcome $user_id!"?> </h1></h1>
    </div>

    
</body>
</html>