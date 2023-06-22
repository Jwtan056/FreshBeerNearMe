<!DOCTYPE html>
<html lang="en">
<?php
session_start();
$path = $_SESSION['path'];

//Inclusion of files
require_once($path . '/Class/User.php');
require_once($path . '/Class/BeerOwner.php');
require_once($path . '/Class/Venue.php');

//Mongodb client configuration
require_once $path . '/vendor/autoload.php';

$user_id = $_SESSION['_id'];

?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Venues</title>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <?php include 'boNavbar.php' ?>
    <link href="style.css" rel="stylesheet" type="text/css">
    
    <div class="container" id="homepage">
        <h1><?php echo "All Venues"?> </h1>
    </div>

    <table style="color: red" >    
    <?php
        $VenueObj = new Venue();
        $AllVenues = $VenueObj->ViewAllVenues();

        //From here for u to design
        foreach ($AllVenues as $Venue) {
            ?><tr><form action="ViewAVenue.php" method="POST">
            <td><input id="name" name="_id" type="hidden" value="<?php echo $Venue['_id']; ?>"><?php echo $Venue['_id']; ?></td></tr>
            <tr><td><?php
            echo $Venue['address']; ?> </td>
            <td><?php
                echo '<form type="POST"><input type="submit" name="ViewAVenue" value="View"></form>';
            }; ?> </form></td></tr>
    </table>

    
</body>
</html>