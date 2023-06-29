<!DOCTYPE html>
<html lang="en">
<?php
session_start();

//Inclusion of files
require_once('../Class/User.php');
require_once('../Class/SystemAdmin.php');
require_once('../Class/Beer.php');

//Mongodb client configuration
require_once '../vendor/autoload.php';

$user_id = $_SESSION['_id'];

?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Beers</title>
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
    <?php include 'navbar.php' ?>

    <div class="container" id="homepage">
        <h1><?php echo "All Beers"?> </h1>
    </div>

    <table id="saVenue">      
    <?php
        $BeerObj = new Beer();
        $AllBeers = $BeerObj->ViewAllBeers();
        $BeerCounter = 1;

        //From here for u to design
        foreach ($AllBeers as $Beer) {
            ?><tr> <form action="ViewABeerListing.php" method="POST"> 
            <td><?php 
            echo "Beer #$BeerCounter: " . $Beer['_id']?><input id="name" name="_id" type="hidden" value="<?php echo $Beer['_id']; ?>"></td>
            <td><?php
                $BeerCounter += 1;
                echo '<form type="POST"><input type="submit" name="ViewABeer" value="View"></form>';
            }; ?> </form></td></tr>
    </table>
</body>
</html>