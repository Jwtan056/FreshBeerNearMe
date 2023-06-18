<!DOCTYPE html>
<html lang="en">
<?php
//Inclusion of files
require_once('Class/User.php');
require_once('Class/SystemAdmin.php');

//Mongodb client configuration
require_once __DIR__ . '/vendor/autoload.php';

session_start();
$user_id = $_SESSION['_id'];

?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Venues</title>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <?php include 'navbar.php' ?>

    <div class="container" id="homepage">
        <h1><?php echo "All Venues"?> </h1>
    </div>

    <table style="color: red" >    
    <?php
        $SysAdmin = new SystemAdmin($_SESSION['_id']);
        $AllVenues = $SysAdmin->ViewAllVenues();

        //From here for u to design
        foreach ($AllVenues as $Venue) {
            ?><tr><td><?php
            echo $Venue['_id'];
            ?> </td></tr>
            <tr><td><?php
            echo $Venue['address'];
            }; ?> </td></tr>
    </table>
</body>
</html>