<!DOCTYPE html>
<html lang="en">
<?php
    session_start();

    //Inclusion of files
    require_once('../Class/User.php');
    require_once('../Class/SystemAdmin.php');
    require_once('../Class/Venue.php');

    //Mongodb client configuration
    require_once '../vendor/autoload.php';

    $user_id = $_SESSION['_id'];

    $error = ''; // Variable To Store Error Message
    if (isset($_POST['ViewAVenue'])) {
        
        // check if it exist in database
        $VenueObj = new Venue();
        $Venue = $VenueObj->ViewAVenue($_POST['_id']);
    }

    //Delete venue
    else if(isset($_POST['DeleteAVenue'])) {
        $VenueObj = new Venue();
        $DeleteSuccess = $VenueObj->DeleteAVenue($_POST['_id']);
        if($DeleteSuccess == true){
            echo '<script>alert("Delete Successful.")</script>';
            header("Location: ViewAllVenues.php");
        }
        else{
            echo '<script>alert("Delete Failed.")</script>';
        }
        
    }
?>

<script>
    function DeleteVenue() {
    if (confirm("Confirm to delete?") == true) {
        document.getElementById("submit-button").click();
    }
    }
</script>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View A Venue</title>
    <link href="../style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <?php include 'navbar.php' ?>
    <link href="../style.css" rel="stylesheet" type="text/css">

    <div class="container" id="homepage">
        <h1>View A Venue</h1>
    </div>

    <table id="saVenue">
    <form action="ViewAVenue.php" method="POST">
    <?php foreach ($Venue as $VenueInfo) { ?>
         <input id="name" name="_id" type="hidden" value="<?php echo $VenueInfo['_id']; ?>">
    <?php
        echo "<tr><td>Venue Name: " . $VenueInfo['_id'] . "</tr></td>";
        echo "<tr><td>Address: " . $VenueInfo['address'] . "</tr></td>";
        echo "<tr><td>Contact Number: " . $VenueInfo['contact'] . "</tr></td>";
        
        //Opening day and hours
        if(count($VenueInfo['days']) == 0){ 
            echo "<tr><td>Opening Days: No Opening Days available</tr></td>";
        } 
        else { 
            $days = [];
            foreach($VenueInfo['days'] as $openingdays){
                array_push($days, $openingdays);
            }
            echo "<tr><td>Opening Days: ". implode(", ",$days) . "</tr></td>";
        } 
        echo "<tr><td>Opening Hours: " . $VenueInfo['opentime'] . "-" . $VenueInfo['closetime'] . " </tr></td>";

        //Promotions
        if(count($VenueInfo['promotionid']) == 0){ 
            echo "<tr><td>Promotion ID: No promotions available</tr></td>";
        } 
        else { 
            $promotions = [];
            foreach($VenueInfo['promotionid'] as $Promos){
                array_push($promotions, $Promos);
            }
            echo "<tr><td>Promotion ID: ". implode(", ",$promotions) . "</tr></td>";
        } 

        echo "<tr><td>OwnerID: " . $VenueInfo['ownerid'] . "</tr></td>";

        echo '<tr><td><input type="button" value="Delete" onclick="DeleteVenue()"/></td></tr>';
        echo '<tr><td><input type="submit" name="DeleteAVenue" id="submit-button" style="visibility: hidden;"/></td></tr>';
    }?> 
    </form>
    </table>
</body>
</html>