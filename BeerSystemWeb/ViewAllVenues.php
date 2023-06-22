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
    ?>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>View All Venues</title>
        <link href="style.css" rel="stylesheet" type="text/css">
        <style>
            /* CSS styling for the table */
            .venue-table {
                width: 50%;
                border-collapse: collapse;
                background-color: #d3d3d3; 
                border: 1px solid #ddd;
            }

            .venue-table th,
            .venue-table td {
                padding: 8px;
                text-align: left;
                border-bottom: 1px solid #ddd;
            }

            .venue-id {
                color: black;
            }

            .view-button {
                padding: 2px 4px;
                font-size: 8px;
                text-align: right;
            }
        </style>
    </head>

    <body>
        <?php include 'boNavbar.php' ?>
        <link href="style.css" rel="stylesheet" type="text/css">

        <div class="container" id="homepage">
            <h1 style="text-align: left;">All Venues</h1>
            <br>
        </div>

        <table class="venue-table">
            <tbody>
                <?php
                $VenueObj = new Venue();
                $AllVenues = $VenueObj->ViewAllVenues();

                foreach ($AllVenues as $Venue) {
                    ?>
                    <tr>
                        <td>
                            <span class="venue-id"><?php echo $Venue['_id']; ?></span><br>
                            <?php echo $Venue['address']; ?>
                        </td>
                        <td>
                            <form action="ViewAVenue.php" method="POST">
                                <input type="hidden" name="_id" value="<?php echo $Venue['_id']; ?>">
                                <input type="submit" name="ViewAVenue" value="View Venue">
                            </form>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>

    </body>

</html>