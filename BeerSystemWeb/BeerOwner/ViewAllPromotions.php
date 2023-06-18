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
    <link href="/FYP/style.css" rel="stylesheet" type="text/css">
    <title>Beer Owner Homepage</title>
</head>

<body>
    <?php include 'boNavbar.php' ?>
    <link href="style.css" rel="stylesheet" type="text/css">

    <div class="container" id="homepage">
        <h1><?php echo "All Promotions"?> </h1>
    </div>
    
    <table style="color: red" >    
    <?php
        $BO = new BeerOwner($_SESSION['_id']);
        $AllPromotions = $BO->ViewAllPromotion();

        //From here for u to design
        foreach ($AllPromotions as $Promotion) {
            ?><tr><td><?php
            echo $Promotion['_id']; ?> </td>
            <td><?php
            echo $Promotion['name']; ?> </td>
            <td><?php
            echo $Promotion['details']; 
            }; ?> </td></tr>
    </table>

    
</body>
</html>