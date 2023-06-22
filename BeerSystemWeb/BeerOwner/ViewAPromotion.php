<!DOCTYPE html>
<html lang="en">
<?php
session_start();
$path = $_SESSION['path'];

//Inclusion of files
require_once($path . '/Class/User.php');
require_once($path . '/Class/BeerOwner.php');
require_once($path . '/Class/Promotion.php');

//Mongodb client configuration
require_once $path . '/vendor/autoload.php';

$user_id = $_SESSION['_id'];

$error = ''; // Variable To Store Error Message
if (isset($_POST['ViewAPromotion'])) {
    
    // check if it exist in database
    $PromotionObj = new Promotion();
    $PromotionObj->setOwnerid($user_id);
    $Promotions = $PromotionObj->ViewAPromotion($_POST['_id']);
}

//Delete Promotion
else if(isset($_POST['DeleteAPromotion'])) {
    $PromotionObj = new Promotion();
    $DeleteSuccess = $PromotionObj->DeleteAPromotion($_POST['_id']);
    if($DeleteSuccess == true){
        echo '<script>alert("Delete Successful.")</script>';
        header("Location: ViewAllPromotions.php");
    }
    else{
        echo '<script>alert("Delete Failed.")</script>';
    }
        
    }
?>
    
<script>
    function DeletePromotion() {
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
        <h1>View A Promotion</h1>
    </div>

    <table style="color:white"><form action="ViewAPromotion.php" method="POST">
    <?php foreach ($Promotions as $Promotioninfo) { ?>
         <input id="name" name="_id" type="hidden" value="<?php echo $Promotioninfo['_id']; ?>">
    <?php
        echo "<tr><td>Promotion ID: " . $Promotioninfo['_id'] . "</tr></td>"; 
        echo "<tr><td>Promotion Name: " . $Promotioninfo['name'] . "</tr></td>"; 
        
        //timeperiod
        $counter = 0;
        if(count($Promotioninfo['timeperiod']) == 0){ 
            echo "<tr><td>Promotion not available</tr></td>";  } 
        else { 
            $startdate = "";
            $enddate = "";
            foreach ($Promotioninfo['timeperiod'] as $date) { 
                if ($counter == 0){
                    $startdate = $date['open'];
                }
                else{
                    $enddate = $date['close'];
                }       
                $counter++;
            }    
            echo "<tr><td>Promotion period is from $startdate - $enddate </tr></td>";
        } 

        echo "<tr><td>Promotion Details: " . $Promotioninfo['details'] . "</tr></td>"; 

        $counter = 0; //Only print venueid once
        if(count($Promotioninfo['venueid']) == 0){ 
            echo "<tr><td>VenueID: None Available</tr></td>";
        } 
        else { 
            foreach ($Promotioninfo['venueid'] as $venue) { 
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

        $counter = 0; //Only print venueid once
        if(count($Promotioninfo['condition']) == 0){ 
            echo "<tr><td>Conditions: None Available</tr></td>";
        } 
        else { 
            foreach ($Promotioninfo['condition'] as $condition) { 
                if($counter == 0)
                {
                    echo "<tr><td>Conditions: $condition</tr></td>";
                }
                else{
                    echo "<tr><td>&emsp;$condition</tr></td>";
                }
                $counter++;
            }
        } 

        echo "<tr><td>Promotion Status: " . $Promotioninfo['status'] . "</tr></td>"; 

        echo '<tr><td><input type="button" value="Delete" onclick="DeletePromotion()"/></td></tr>';
        echo '<tr><td><input type="submit" name="DeleteAPromotion" id="submit-button" style="visibility: hidden;"/></td></tr>';
    }?> 
    </form></table>
</body>
</html>