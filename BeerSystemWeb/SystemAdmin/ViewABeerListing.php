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

$error = ''; // Variable To Store Error Message
    if (isset($_POST['ViewABeer'])) {
        
        $BeerObj = new Beer();
        $Beer = $BeerObj->ViewABeer($_POST['_id']);
    }

//Delete Beer
else if(isset($_POST['DeleteABeer'])) {
    $BeerObj = new Beer();
    $DeleteSuccess = $Beer->DeleteABeer($_POST['_id']);
    if($DeleteSuccess == true){
        echo '<script>alert("Delete Successful.")</script>';
        header("Location: ViewAllBeerListing.php");
    }
    else{
        echo '<script>alert("Delete Failed.")</script>';
    }
    
}
?>

<script>
function DeleteBeer() {
  if (confirm("Confirm to delete?") == true) {
    document.getElementById("submit-button").click();
  }
}
</script>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Administrator Homepage</title>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <?php include 'navbar.php' ?>

    <div class="container" id="homepage">
        <h1>View A Beer</h1>
    </div>

    <table style="color:white"><form action="ViewABeerListing.php" method="POST">
    <?php foreach ($Beer as $BeerInfo) { ?>
        <input id="name" name="_id" type="hidden" value="<?php echo $BeerInfo['_id']; ?>">
    <?php
        echo "<tr><td>Beer Name: " . $BeerInfo['_id'] . "</tr></td>"; 
        echo "<tr><td>Origin: " . $BeerInfo['origin'] . "</tr></td>"; 
        echo "<tr><td>Colour: " . $BeerInfo['colour'] . "</tr></td>"; 
        
        // Need to come out with how i can just print venueid once
        $counter = 0; //Only print venueid once
        if(count($BeerInfo['venueid']) == 0){ 
            echo "<tr><td>VenueID: None Available</tr></td>";
        } 
        else { 
            foreach ($BeerInfo['venueid'] as $venue) { 
                if($counter == 0)
                {
                    echo "<tr><td>VenueID: $venue</tr></td>";
                }
                else{
                    echo "<tr><td>&emsp;$venue</tr></td>";
                }
                $counter++;
            }
        } 
        echo "<tr><td>Addition Information: " . $BeerInfo['additional'] . "</tr></td>"; 
        echo "<tr><td>Flavour: " . $BeerInfo['flavour'] . "</tr></td>"; 
        echo '<tr><td><input type="button" value="Delete" onclick="DeleteBeer()"/></td></tr>';
        echo '<tr><td><input type="submit" name="DeleteABeer" id="submit-button" style="visibility: hidden;"/></td></tr>';
    }?> 
    </form></table>
</body>
</html>