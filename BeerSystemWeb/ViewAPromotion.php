<!DOCTYPE html>
<html lang="en">
    <?php
    session_start();
    $path = $_SESSION['path'];

    // Inclusion of files
    require_once($path . '/Class/User.php');
    require_once($path . '/Class/BeerOwner.php');
    require_once($path . '/Class/Promotion.php');

    // Mongodb client configuration
    require_once $path . '/vendor/autoload.php';

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
        <link href="style.css" rel="stylesheet" type="text/css">
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
            <h1 style="text-align: center;">Promotion</h1>
            <br>
        </div>

        <?php foreach ($Promotions as $Promotioninfo) { ?>
            <div class="promotion-container">
                <input id="name" name="_id" type="hidden" value="<?php echo $Promotioninfo['_id']; ?>">
                <?php
                echo "<p><tr><td>Promotion ID: " . $Promotioninfo['_id'] . "</p></tr></td>";
                echo "<p><tr><td>Promotion Name: " . $Promotioninfo['name'] . "</p></tr></td>";

                // Time period
                $counter = 0;
                if (count($Promotioninfo['timeperiod']) == 0) {
                    echo "<p><tr><td>Promotion not available</p></tr></td>";
                } else {
                    $startdate = "";
                    $enddate = "";
                    foreach ($Promotioninfo['timeperiod'] as $date) {
                        if ($counter == 0) {
                            $startdate = $date['open'];
                        } else {
                            $enddate = $date['close'];
                        }
                        $counter++;
                    }
                }
        }
                    echo "<p><br><tr><td>Promotion period is from $startdate - $enddate </br></p></tr></td>";
             

                echo "<p><tr><td>Promotion Details: " . $Promotioninfo['details'] . "</p></tr></td>";

                $counter = 0; // Only print VenueID once
                if (count($Promotioninfo['venueid']) == 0) {
                    echo "<br><p><tr><td>VenueID: None Available</br></p></tr></td>";
                } else {
                    echo "<br><p><tr><td>VenueID:</br></p></tr></td>";
                    foreach ($Promotioninfo['venueid'] as $venue) {
                        echo "<p><tr><td>&emsp;$venue</p></tr></td>";
                    }
                }

                $counter = 0; // Only print Conditions once
                if (count($Promotioninfo['condition']) == 0) {
                    echo "<br><p><tr><td>Conditions: None Available</br></p></tr></td>";
                } else {
                    echo "<br><p><tr><td>Conditions:</br></p></tr></td>";
                    foreach ($Promotioninfo['condition'] as $condition) {
                        echo "<p><tr><td>&emsp;$condition</p></tr></td>";
                    }
                }
                ?>
            </div>

            <form action="ViewAPromotion.php" method="POST">
                echo "<tr><td>Promotion Status: " . $Promotioninfo['status'] . "</tr></td>";

                echo '<tr><td><input type="button" value="Delete" onclick="DeletePromotion()"/></td></tr>';
                echo '<tr><td><input type="submit" name="DeleteAPromotion" id="submit-button" style="visibility: hidden;"/></td></tr>';
            }
            <?php ?> 
            </form>
    </body>
</html>
