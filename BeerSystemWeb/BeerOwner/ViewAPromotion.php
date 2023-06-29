<!DOCTYPE html>
<html lang="en">
    <?php
    session_start();

    // Inclusion of files
    require_once('../Class/User.php');
    require_once('../Class/BeerOwner.php');
    require_once('../Class/Promotion.php');

    // Mongodb client configuration
    require_once '../vendor/autoload.php';

    $user_id = $_SESSION['_id'];

    $error = ''; // Variable To Store Error Message
    if (isset($_POST['ViewAPromotion'])) {

        // check if it exists in the database
        $PromotionObj = new Promotion();
        $PromotionObj->setOwnerid($user_id);
        $Promotions = $PromotionObj->ViewAPromotion($_POST['_id']);
    }

    // Delete Promotion
    else if (isset($_POST['DeleteAPromotion'])) {
        $PromotionObj = new Promotion();
        $DeleteSuccess = $PromotionObj->DeleteAPromotion($_POST['_id']);
        if ($DeleteSuccess == true) {
            echo '<script>alert("Delete Successful.")</script>';
            header("Location: ViewAllPromotions.php");
        } else {
            echo '<script>alert("Delete Failed.")</script>';
        }
    }
    ?>

    <script>
        function DeletePromotion() {
            if (confirm("Confirm to delete?") == true) {
                document.getElementById("submit-button").click();
            }
        }
    </script>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>View A Promotion</title>
        <link href="../style.css" rel="stylesheet" type="text/css">
        <style>
            /* CSS styling for the divs */
            .promotion-container {
                background-color: #d3d3d3;
                padding: 10px;
                margin-bottom: 10px;
            }

            .promotion-container h2 {
                margin-top: 0;
            }
        </style>
    </head>

    <body>
        <?php include 'boNavbar.php' ?>

        <div class="container" id="homepage">
            <h1>View A Promotion</h1>
        </div>

        <table id="saVenue">
        <form action="ViewAPromotion.php" method="POST">
        <?php foreach ($Promotions as $PromotionInfo) { ?>
            <input id="name" name="_id" type="hidden" value="<?php echo $PromotionInfo['_id']; ?>">
        <?php
            echo "<tr><td>Promotion ID: " . $PromotionInfo['_id'] . "</tr></td>"; 
            echo "<tr><td>Promotion Name: " . $PromotionInfo['name'] . "</tr></td>"; 

            // Time period
            $counter = 0;
            if (count($PromotionInfo['timeperiod']) == 0) {
                echo "<p><tr><td>Promotion not available</p></tr></td>";
            } else {
                $startdate = "";
                $enddate = "";
                foreach ($PromotionInfo['timeperiod'] as $date) {
                    if ($counter == 0) {
                        $startdate = $date['open'];
                    } else {
                        $enddate = $date['close'];
                    }
                    $counter++;
                }
            }
            echo "<tr><td>Promotion period is from $startdate - $enddate </tr></td>";
            
            echo "<tr><td>Promotion Details: " . $PromotionInfo['details'] . "</tr></td>";

            $counter = 0; // Only print VenueID once
            if (count($PromotionInfo['venueid']) == 0) {
                echo "<tr><td stlyle='border-bottom: 0px solid #000000;'>VenueID: None Available</tr></td>";
            } else {
                
                foreach ($PromotionInfo['venueid'] as $venue) {
                    if ($counter == 0){
                        echo "<br><tr><td style='border:none;'>VenueID:&emsp;$venue</br></tr></td>";
                    }
                    else{
                        echo "<tr><td>&emsp;&emsp;&emsp;&emsp;&emsp; $venue</tr></td>";
                    }
                    $counter++;
                    
                }
            }

            $counter = 0; // Only print Conditions once
            if (count($PromotionInfo['condition']) == 0) {
                echo "<tr><td>Conditions: None Available</tr></td>";
            } else {
                foreach ($PromotionInfo['condition'] as $condition) {
                    if ($counter == 0){
                        echo "<tr><td style='border:none;'>Conditions:&emsp;$condition</tr></td>";
                    }
                    else{
                        echo "<p><tr><td>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; $condition</td></tr></p>";
                    }
                    $counter++;
                }
            }
            
            echo '<tr><td><input type="button" value="Delete" onclick="DeletePromotion()"/></td></tr>';
            echo '<tr><td><input type="submit" name="DeleteAPromotion" id="submit-button" style="visibility: hidden;"/></td></tr>';
        }?> 
        </form></table>
    </body>
</html>
