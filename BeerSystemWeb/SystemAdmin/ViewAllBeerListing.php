<!DOCTYPE html>
<html lang="en">
<?php
session_start();
$path = $_SESSION['path'];

//Inclusion of files
require_once($path . '/Class/User.php');
require_once($path . '/Class/SystemAdmin.php');
require_once($path . '/Class/Beer.php');

//Mongodb client configuration
require_once $path . '/vendor/autoload.php';

$user_id = $_SESSION['_id'];

?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Beers</title>
    <link href="../style.css" rel="stylesheet" type="text/css">
    <style>
        #saBeer {
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

        #saBeer th,
        #saBeer td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #000000;
        }

        #beer-id {
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
    <link href="../style.css" rel="stylesheet" type="text/css">
    <div class="container">
        <h1>
            <?php echo "All Beers" ?>
        </h1>
        <table id="saBeer">
            <tbody>
                <?php
                    $BeerObj = new Beer();
                    $AllBeers = $BeerObj->ViewAllBeers();
                    $BeerCounter = 1;

                foreach ($AllBeers as $Beer) {
                    ?>
                    <tr>
                        <td>
                            <span id="beer-id">
                                <?php echo "Beer #$BeerCounter: " . $Beer['_id']; ?>
                            </span>
                        </td>
                        <td>
                            <form action="ViewABeerListing.php" method="POST"> 
                                <input id="name" name="_id" type="hidden" value="<?php echo $Beer['_id']; ?>">
                                <?php
                                $BeerCounter += 1;
                                echo '<form type="POST"><input type="submit" name="ViewABeer" value="View"></form>';
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