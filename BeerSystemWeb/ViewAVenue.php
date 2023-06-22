<!DOCTYPE html>
<html lang="en">
    <?php
    session_start();
    $path = $_SESSION['path'];

    // Inclusion of files
    require_once($path . '/Class/User.php');
    require_once($path . '/Class/BeerOwner.php');
    require_once($path . '/Class/Venue.php');

    // Mongodb client configuration
    require_once $path . '/vendor/autoload.php';

    $user_id = $_SESSION['_id'];

    $error = ''; // Variable To Store Error Message
    if (isset($_POST['ViewAVenue'])) {
        
        // check if it exist in database
        $VenueObj = new Venue();
        $Venue = $VenueObj->ViewAVenue($_POST['_id']);
    }

    // Delete venue
    else if (isset($_POST['DeleteAVenue'])) {
        $VenueObj = new Venue();
        $DeleteSuccess = $VenueObj->DeleteAVenue($_POST['_id']);
        if ($DeleteSuccess == true) {
            echo '<script>alert("Delete Successful.")</script>';
            header("Location: ViewAllVenues.php");
        } else {
            echo '<script>alert("Delete Failed.")</script>';
        }
    }
    ?>

    <script>
        function DeleteVenue() {
            if (confirm("Confirm to delete?") == true) {
                document.getElementById("submit-button").click();
            }
        }
    </script>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>View A Venue</title>
        <link href="style.css" rel="stylesheet" type="text/css">
        <style>
            /* CSS styling for the divs */
            .venue-container {
                background-color: #d3d3d3;
                padding: 10px;
                margin-bottom: 10px;
            }

            .beer-container {
                background-color: #d3d3d3;
                padding: 10px;
                margin-bottom: 10px;
            }

            .other-container {
                background-color: #d3d3d3;
                padding: 10px;
                margin-bottom: 10px;
            }

            .venue-container h2,
            .beer-container h2,
            .other-container h2 {
                margin-top: 0;
            }
        </style>
    </head>

    <body>
        <?php include 'boNavbar.php' ?>

        <div class="container" id="homepage">
            <h1 style="text-align: center;">Venue</h1>
            <br>
        </div>

        <?php foreach ($Venue as $VenueInfo) { ?>
            <div class="venue-container">
                <h2>Venue Information</h2>
                <input id="name" name="_id" type="hidden" value="<?php echo $VenueInfo['_id']; ?>">
                <?php
                echo "<p><tr><td>Venue Name: " . $VenueInfo['_id'] . "</p></tr></td>";
                echo "<p><tr><td>Address: " . $VenueInfo['address'] . "</p></tr></td>";
                echo "<p><tr><td>Contact Number: " . $VenueInfo['contact'] . "</p></tr></td>";

                //Opening hours
                if (count($VenueInfo['opening']) == 0) {
                    echo "<p><tr><td>Opening: No Opening hours available" . "</p></tr></td>";
                } else {
                    $daycounter = 0;
                    foreach ($VenueInfo['opening'] as $day) {
                        foreach ($day as $openinghours) {
                            foreach ($openinghours as $time) {
                                if (array_key_exists("open", (array) $time)) {
                                    $open = $time['open'];
                                } else {
                                    $close = $time['close'];
                                }
                            }
                            $theday = current(array_keys((array) $day));
                            echo "<p><tr><td>$theday Opening Hours: $open - $close </p></tr></td>";
                        }
                        $daycounter += 1;
                    }
                }
            }
            ?>
        </div>

        <div class="beer-container">
            <h2>Beer Offered at this venue:</h2>

            <?php
            if (count($VenueInfo['beer']) == 0) {
                echo "<p><tr><td>No Beers Available</</p>tr></td>";
            } else {
                foreach ($VenueInfo['beer'] as $beer) {
                    $bid = $beer['beerid'];
                    echo "<br><p><tr><td>Beer Name: $bid </br></p></tr></td>";
                    $bfreshness = $beer['freshness'];
                    echo "<p><tr><td>Beer Freshness: $bfreshness </p></tr></td>";
                    $btemp = $beer['temperature'];
                    echo "<p><tr><td>Beer Temperature: $btemp </p></tr></td>";
                }
            }
            ?>
        </div>

        <div class="other-container">
            <h2>Promotion offered at this venue:</h2>
            <?php
            if (count($VenueInfo['promotionid']) == 0) {
                echo "<p><tr><td>No promotions Available</p></tr></td>";
            } else {
                foreach ($VenueInfo['promotionid'] as $promotion) {
                    echo "<p><tr><td>PromotionID: $promotion </p></tr></td>";
                }
            }

            echo "<p><tr><td>OwnerID: " . $VenueInfo['ownerid'] . "</p></tr></td>";

            //Location with their x and y
            foreach ($VenueInfo['location'] as $coordinates) {
                $count = 0;
                $x = "";
                $y = "";
                foreach ($coordinates as $xy) {
                    if ($count == 0) {
                        $x = $xy;
                    } else {
                        $y = $xy;
                    }
                    $count++;
                }
                echo "<tr><td>Location(x: $x,y: $y) </tr></td>";
                ?>
                }

            </div>

            <form action="ViewAVenue.php" method="POST">
                <input id="name" name="_id" type="hidden" value="<?php echo $VenueInfo['_id']; ?>">    
                echo '<tr><td><input type="button" value="Delete" onclick="DeleteVenue()"/></td></tr>';
                echo '<tr><td><input type="submit" name="DeleteAVenue" id="submit-button" style="visibility: hidden;"/></td></tr>';
                    <?php } ?> 
        </form>
    </body>
</html>