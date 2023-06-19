<!DOCTYPE html>
<html lang="en">
<?php
session_start();
$path = $_SESSION['path'];

//Inclusion of files
require_once($path . '/Class/User.php');
require_once($path . '/Class/BeerOwner.php');

//Mongodb client configuration
require_once $path . '/vendor/autoload.php';

$user_id = $_SESSION['_id'];

$error = ''; // Variable To Store Error Message
    if (isset($_POST['ViewAPromotion'])) {
        
        // check if it exist in database
        $user = new BeerOwner($_SESSION['_id']);
        $Promotions = $user->ViewAPromotion($_POST['_id']);
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
        <h1>View A Promotion</h1>
    </div>

    <table style="color:white">
    <?php foreach ($Promotions as $Promotioninfo) { 
        echo "<tr><td>Promotion ID: " . $Promotioninfo['_id'] . "</tr></td>"; 
        echo "<tr><td>Promotion Name: " . $Promotioninfo['name'] . "</tr></td>"; 
        
        //timeperiod
        $counter = 0;
        if(count($Promotioninfo['timeperiod']) == 0){ 
            echo "<tr><td>Promotion not available</tr></td>";  } 
        else { 
            $startdate = "";
            $enddate = "";
            foreach ($Promotioninfo['timeperiod'] as $date) { 
                if ($counter == 0){
                    $startdate = $date['open'];
                }
                else{
                    $enddate = $date['close'];
                }       
                $counter++;
            }    
            echo "<tr><td>Promotion period is from $startdate - $enddate </tr></td>";
        } 

        echo "<tr><td>Promotion Details: " . $Promotioninfo['details'] . "</tr></td>"; 

        $counter = 0; //Only print venueid once
        if(count($Promotioninfo['venueid']) == 0){ 
            echo "<tr><td>VenueID: None Available</tr></td>";
        } 
        else { 
            foreach ($Promotioninfo['venueid'] as $venue) { 
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

        $counter = 0; //Only print venueid once
        if(count($Promotioninfo['condition']) == 0){ 
            echo "<tr><td>Conditions: None Available</tr></td>";
        } 
        else { 
            foreach ($Promotioninfo['condition'] as $condition) { 
                if($counter == 0)
                {
                    echo "<tr><td>Conditions: $condition</tr></td>";
                }
                else{
                    echo "<tr><td>&emsp;$condition</tr></td>";
                }
                $counter++;
            }
        } 

        echo "<tr><td>Promotion Status: " . $Promotioninfo['status'] . "</tr></td>"; 
    }?> 
    </table>
</body>
</html>