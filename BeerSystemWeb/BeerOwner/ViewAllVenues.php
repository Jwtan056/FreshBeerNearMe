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
        <link href="../style.css" rel="stylesheet" type="text/css">
    
        <style>
        #saVenue {
            margin-left: auto;
            margin-right: auto;
            width: 800px;
            background-color: #d6d6d6;
            float: center;
            border-radius: 10px;
            border: solid #d6d6d6;
            padding: 10px 40px 25px;
            margin-top: 50px;
            margin-left: auto;
            margin-right: auto;
        }

        #saVenue th,
        #saVenue td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #000000;
        }

        #venue-id {
            color: black;
        }

        #view-button {
            padding: 2px 4px;
            font-size: 8px;
            text-align: right;
        }
        </style>
    </head>

    <body>
        <?php include 'boNavbar.php' ?>
        <link href="style.css" rel="stylesheet" type="text/css">

        <div class="container">
        <h1>
            <?php echo "All Venues" ?>
        </h1>
        <table id="saVenue">
            <tbody>
                <?php
                    $VenueObj = new Venue();
                    $AllVenues = $VenueObj->ViewAllVenues();

                //From here for u to design
                foreach ($AllVenues as $Venue) {
                    ?>
                    <tr>
                        <td>
                            <span id="venue-id">
                                <?php echo $Venue['_id']; ?>
                            </span><br>
                            <?php echo $Venue['address']; 
                            ?>  <br>
                            <?php echo $Venue['contact']; ?>
                        </td>
                        <td>
                            <form action="ViewAVenue.php" method="POST">
                                <input id="name" name="_id" type="hidden" value="<?php echo $Venue['_id']; ?>">
                                <?php
                                echo '<form type="POST"><input type="submit" name="ViewAVenue" value="View"></form>';
                                ?>
                            </form>
                        </td>
                    </tr>
                <?php }; ?>
            </tbody>
        </table>
    </div>
    </body>

</html>