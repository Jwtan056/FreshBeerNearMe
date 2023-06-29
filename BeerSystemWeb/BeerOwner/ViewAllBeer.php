<!DOCTYPE html>
<html lang="en">
    <?php
    session_start();

    // Inclusion of files
    require_once('../Class/User.php');
    require_once('../Class/BeerOwner.php');
    require_once('../Class/Beer.php');

    // Mongodb client configuration
    require_once '../vendor/autoload.php';

    $user_id = $_SESSION['_id'];

    $BeerObj = new Beer();
    $AllBeers = $BeerObj->BOViewAllBeers($_SESSION['_id']);
    $BeerCounter = 1;

    if (isset($_POST['SearchABeer'])) {
        // check if it exist in database
        $AllBeers = $BeerObj->SearchBeer($_POST['searchterm'], $_SESSION['_id']);
    }

    ?>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>View All Beers</title>
        <link href="../style.css" rel="stylesheet" type="text/css">
    </head>

    <body>
        <?php include 'boNavbar.php' ?>
        <link href="../style.css" rel="stylesheet" type="text/css">

        <div class="container" id="homepage">
            <h1>All Beers</h1>
            <br>
        </div>

        <table id="saVenue">
            <?php
            

            // From here for you to design
            foreach ($AllBeers as $Beer) {
                ?><tr><td>
                        <?php echo "Beer #$BeerCounter: " . $Beer['_id']; ?> <br>
                        <?php echo "Origin: " . $Beer['origin']; ?> <br>
                        <?php echo "Colour: " . $Beer['colour']; ?>
                    </td>
                    <td><form action="ViewABeer.php" method="POST">
                        <input id="name" name="_id" type="hidden" value="<?php echo $Beer['_id']; ?>">
                        <br>
                        <input type="submit" name="ViewABeer" value="View Beer">
                    </form></td></tr>
                <?php
                $BeerCounter++;
            } ?>
            <tr>
                <form action="ViewAllBeer.php" method="POST">
                    <td><?php
                    echo "<input type='text' name='searchterm'>";
                    echo '<form type="POST"><input type="submit" name="SearchABeer" value="Search"></form>';
                        ?> </form></td>
            </tr>
        </table>
    </body>
</html>
