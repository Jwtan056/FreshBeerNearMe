<!DOCTYPE html>
<html lang="en">
    <?php
    session_start();
    $path = $_SESSION['path'];

    // Inclusion of files
    require_once($path . '/Class/User.php');
    require_once($path . '/Class/BeerOwner.php');
    require_once($path . '/Class/Beer.php');

    // Mongodb client configuration
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
        <title>View A Beer</title>
        <link href="style.css" rel="stylesheet" type="text/css">
        <style>
            /* CSS styling for the divs */

            .beer-container {
                background-color: #d3d3d3;
                padding: 10px;
                margin-bottom: 10px;
            }

            .venue-container {
                background-color: #d3d3d3;
                padding: 10px;
                margin-bottom: 10px;
            }

            .beer-container h2,
            .venue-container h2{
                margin-top: 0;
            }
        </style>
    </head>

    <body>
        <?php include 'boNavbar.php' ?>

        <div class="container" id="homepage">
            <h1 style="text-align: center;">Beer</h1>
            <br>
        </div>
        <?php foreach ($Beer as $BeerInfo) { ?>
            <div class="beer-container">
                <h2>Beer Information</h2>
                <input id="name" name="_id" type="hidden" value="<?php echo $BeerInfo['_id']; ?>">

                <?php
                echo "<p><tr><td>Beer Name: " . $BeerInfo['_id'] . "<p></tr></td>";
                echo "<p><tr><td>Origin: " . $BeerInfo['origin'] . "</p></tr></td>";
                echo "<p><tr><td>Colour: " . $BeerInfo['colour'] . "</p></tr></td>";
                echo "<p><tr><td>Flavour: " . $BeerInfo['flavour'] . "</p></tr></td>";
                echo "<br><p><tr><td>Addition Information: " . $BeerInfo['additional'] . "</br></p></tr></td>";
                ?>
            </div>

            <div class="venue-container">
                <h2>Venue Information</h2>
                <input id="name" name="_id" type="hidden" value="<?php echo $VenueInfo['_id']; ?>">

                <?php
                // Need to come out with how i can just print venueid once
                $counter = 0; // Only print VenueID once
                if (count($BeerInfo['venueid']) == 0) {
                    echo "<br><p><tr><td>VenueID: None Available</br></p></tr></td>";
                } else {
                    echo "<br><p><tr><td>VenueID:</br></p></tr></td>";
                    foreach ($BeerInfo['venueid'] as $venue) {
                        echo "<p><tr><td>&emsp;$venue</p></tr></td>";
                    }
                }
            }
            ?>

        </div>
    </table>
</body>
</html>