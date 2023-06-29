<!DOCTYPE html>
<html lang="en">
    <?php
    session_start();

    // Inclusion of files
    require_once('../Class/User.php');
    require_once('../Class/BeerOwner.php');
    require_once('../Class/Venue.php');

    // Mongodb client configuration
    require_once '../vendor/autoload.php';

    $user_id = $_SESSION['_id'];

    $VenueObj = new Venue();
    $AllVenues = $VenueObj->BOViewAllVenues($_SESSION['_id']);
    
    if (isset($_POST['SearchAVenue'])) {
        // check if it exist in database
        $AllVenues = $VenueObj->SearchVenue($_POST['searchterm'], $_SESSION['_id']);
    }

    ?>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>View All Venues</title>
        <link href="../style.css" rel="stylesheet" type="text/css">
    </head>

    <body>
        <?php include 'boNavbar.php' ?>
        <link href="../style.css" rel="stylesheet" type="text/css">

        <div class="container">
        <h1>
            <?php echo "All Venues" ?>
        </h1>
        <table id="saVenue">
            <?php
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
            <tr>
                <form action="ViewAllVenues.php" method="POST">
                    <td><?php
                    echo "<input type='text' name='searchterm'>";
                    echo '<form type="POST"><input type="submit" name="SearchAVenue" value="Search"></form>';
                        ?> </form></td>
            </tr>
            <tr>
                <form action="CreateAVenue.php" method="POST">
                    <td><?php
                    echo '<form type="POST"><input type="submit" name="" value="Create"></form>';
                        ?> </form></td>
            </tr>
        </table>
    </div>
    </body>

</html>