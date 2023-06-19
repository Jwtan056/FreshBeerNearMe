<!DOCTYPE html>
<html lang="en">
<?php
session_start();
$path = $_SESSION['path'];

//Inclusion of files
require_once($path . '/Class/User.php');
require_once($path . '/Class/BeerOwner.php');

//Mongodb client configuration
require_once $path . '/vendor/autoload.php';

$user_id = $_SESSION['_id'];

?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Beers</title>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <?php include 'boNavbar.php' ?>
    <link href="style.css" rel="stylesheet" type="text/css">
    
    <div class="container" id="homepage">
        <h1><?php echo "All Beers"?> </h1>
    </div>

    <table style="color: red" >    
    <?php
        $BO = new BeerOwner($_SESSION['_id']);
        $AllBeers = $BO->ViewAllBeers();
        $BeerCounter = 1;

       //From here for u to design
       foreach ($AllBeers as $Beer) {
        ?><tr> <form action="ViewABeer.php" method="POST"> 
        <td><?php 
        //Theres a stupid nonsense here that cannot print beer name so imma comment it and fix next time
        echo "Beer #$BeerCounter: " . $Beer['_id']?><input id="name" name="_id" type="hidden" value="<?php echo $Beer['_id']; ?>"></td>
        <td><?php
            $BeerCounter += 1;
            echo '<form type="POST"><input type="submit" name="ViewABeer" value="View"></form>';
        }; ?> </form></td></tr>
    </table>
</body>
</html>