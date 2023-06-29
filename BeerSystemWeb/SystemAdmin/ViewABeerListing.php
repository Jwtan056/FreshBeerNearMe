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

    $error = ''; // Variable To Store Error Message
        if (isset($_POST['ViewABeer'])) {
            
            $BeerObj = new Beer();
            $Beer = $BeerObj->ViewABeer($_POST['_id']);
        }

    //Delete Beer
    else if(isset($_POST['DeleteABeer'])) {
        $BeerObj = new Beer();
        $DeleteSuccess = $BeerObj->DeleteABeer($_POST['_id']);
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
    <link href="../style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <?php include 'navbar.php' ?>

    <div class="container" id="homepage">
        <h1>View A Beer</h1>
    </div>

    <table id="saVenue">
    <form action="ViewABeerListing.php" method="POST">
    <?php foreach ($Beer as $BeerInfo) { ?>
        <input id="name" name="_id" type="hidden" value="<?php echo $BeerInfo['_id']; ?>">
    <?php
        echo "<tr><td>Beer ID: " . $BeerInfo['_id'] . "</tr></td>"; 
        echo "<tr><td>Beer Name: " . $BeerInfo['beername'] . "</tr></td>"; 
        echo "<tr><td>Origin: " . $BeerInfo['origin'] . "</tr></td>"; 
        echo "<tr><td>Colour: " . $BeerInfo['colour'] . "</tr></td>"; 
        echo "<tr><td>VenueID: " . $BeerInfo['venueid'] . "</tr></td>";
        echo "<tr><td>OwnerID: " . $BeerInfo['ownerid'] . "</tr></td>";
        echo "<tr><td>Addition Information: " . $BeerInfo['additional'] . "</tr></td>"; 
        echo "<tr><td>Flavour: " . $BeerInfo['flavour'] . "</tr></td>"; 
        echo '<tr><td><input type="button" value="Delete" onclick="DeleteBeer()"/></td></tr>';
        echo '<tr><td><input type="submit" name="DeleteABeer" id="submit-button" style="visibility: hidden;"/></td></tr>';
    }?> 
    </form></table>
</body>
</html>