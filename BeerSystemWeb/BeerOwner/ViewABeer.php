<!DOCTYPE html>
<html lang="en">
<?php
session_start();
$path = $_SESSION['path'];

//Inclusion of files
require_once($path . '/Class/User.php');
require_once($path . '/Class/BeerOwner.php');
require_once($path . '/Class/Beer.php');

//Mongodb client configuration
require_once $path . '/vendor/autoload.php';

$user_id = $_SESSION['_id'];

$error = ''; // Variable To Store Error Message
    if (isset($_POST['ViewABeer'])) {
        
        // check if it exist in database
        $BeerObj = new Beer();
        $Beer = $BeerObj->ViewABeer($_POST['_id']);
    }

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Administrator Homepage</title>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <?php include 'boNavbar.php' ?>

    <div class="container" id="homepage">
        <h1>View A Beer</h1>
    </div>

    <table style="color:white">
    <?php foreach ($Beer as $BeerInfo) { 
        echo "<tr><td>Beer Name: " . $BeerInfo['_id'] . "</tr></td>"; 
        echo "<tr><td>Origin: " . $BeerInfo['origin'] . "</tr></td>"; 
        echo "<tr><td>Colour: " . $BeerInfo['colour'] . "</tr></td>"; 
        
        // Need to come out with how i can just print venueid once
        $counter = 0; //Only print venueid once
        if(count($BeerInfo['venueid']) == 0){ 
            echo "<tr><td>VenueID: None Available</tr></td>";
        } 
        else { 
            foreach ($BeerInfo['venueid'] as $venue) { 
                if($counter == 0)
                {
                    echo "<tr><td>VenueID: $venue</tr></td>";
                }
                else{
                    echo "<tr><td>&emsp;$venue</tr></td>";
                }
                $counter++;
            }
        } 
        echo "<tr><td>Addition Information: " . $BeerInfo['additional'] . "</tr></td>"; 
        echo "<tr><td>Flavour: " . $BeerInfo['flavour'] . "</tr></td>"; 
    }?> 
    </table>
</body>
</html>