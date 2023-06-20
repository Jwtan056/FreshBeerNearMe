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

    $error = ''; // Variable To Store Error Message
    if (isset($_POST['ViewAVenue'])) {
        
        // check if it exist in database
        $user = new BeerOwner($_SESSION['_id']);
        $Venue = $user->ViewAVenue($_POST['_id']);
    }

    //Delete venue
    else if(isset($_POST['DeleteAVenue'])) {
        $user = new BeerOwner($_SESSION['_id']);
        $DeleteSuccess = $user->DeleteAVenue($_POST['_id']);
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
    <title>System Administrator Homepage</title>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <?php include 'boNavbar.php' ?>

    <div class="container" id="homepage">
        <h1>View A Venue</h1>
    </div>

    <table style="color:white"><form action="ViewAVenue.php" method="POST">
    <?php foreach ($Venue as $VenueInfo) {?>
         <input id="name" name="_id" type="hidden" value="<?php echo $VenueInfo['_id']; ?>">
    <?php
        echo "<tr><td>Venue Name: " . $VenueInfo['_id'] . "</tr></td>";
        echo "<tr><td>Address: " . $VenueInfo['address'] . "</tr></td>";
        echo "<tr><td>Contact Number: " . $VenueInfo['contact'] . "</tr></td>";
        
        //Opening hours
        if(count($VenueInfo['opening']) == 0){ 
            echo "<tr><td>Opening: No Opening hours available" . "</tr></td>";
        } 
        else { 
            $daycounter = 0;
            foreach ($VenueInfo['opening'] as $day) {  
                foreach ($day as $openinghours) {
                    foreach ($openinghours as $time) {
                        if (array_key_exists("open",(array) $time)){
                            $open = $time['open'];
                        }
                        else{
                            $close = $time['close'];
                        }
                    }
                    $theday = current(array_keys((array)$day));
                    echo "<tr><td>$theday Opening Hours: $open - $close </tr></td>";
                }
                $daycounter += 1;
            } 
        } 
        
        //Beer Information
        if(count($VenueInfo['beer']) == 0){ 
             echo "<tr><td>No Beers Available</tr></td>";  } 
        else { 
            foreach ($VenueInfo['beer'] as $beer) { 
                    $bid = $beer['beerid'];
                    echo "<tr><td>Beer Name: $bid </tr></td>";
                    $bfreshness = $beer['freshness'];
                    echo "<tr><td>Beer Freshness: $bfreshness </tr></td>";
                    $btemp = $beer['temperature'];
                    echo "<tr><td>Beer Temperature: $btemp </tr></td>";
                }    
        } 
        
        //Promotion
        if(count($VenueInfo['promotionid']) == 0){ 
            echo "<tr><td>No promotions Available</tr></td>";
        } 
        else { 
            foreach ($VenueInfo['promotionid'] as $promotion) { 
                    echo "<tr><td>PromotionID: $promotion </tr></td>";
                }
         } 
        
        echo "<tr><td>OwnerID: " . $VenueInfo['ownerid'] . "</tr></td>"; 

        //Location with their x and y
        foreach ($VenueInfo['location'] as $coordinates) {  
            $count = 0;
            $x = "";
            $y = "";
            foreach ($coordinates as $xy) {
                if ($count == 0){
                    $x = $xy;
                }
                else{
                    $y = $xy;
                }
                $count++;
            }
            echo "<tr><td>Location(x: $x,y: $y) </tr></td>";
        }     

        echo '<tr><td><input type="button" value="Delete" onclick="DeleteVenue()"/></td></tr>';
        echo '<tr><td><input type="submit" name="DeleteAVenue" id="submit-button" style="visibility: hidden;"/></td></tr>';
    }?> 
    </form></table>
</body>
</html>