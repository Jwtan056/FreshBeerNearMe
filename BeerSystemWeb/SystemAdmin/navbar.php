<!DOCTYPE html>
<html lang="en">
<?php
    $path = $_SESSION['path'];

    //Mongodb client configuration
    require_once $path . '/vendor/autoload.php';

    $user_id = $_SESSION['_id'];
?>
<head>
  <title>Navigate Bar</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <nav class="navbar navbar-default">
    <div class="container-fluid" id="navbar">
        <ul class="nav navbar-nav">
        <li><a href="ViewAllUserAccounts.php">
            <img width="30" height="30" src="https://img.icons8.com/ios-glyphs/30/group.png" alt="group"/>User</a></li>

        <li><a href="report.php">
            <img width="30" height="30" src="https://img.icons8.com/ios-glyphs/30/business-report.png" alt="business-report"/>Report</a></li>

        <li><a href="beerEntryReq.php">
            <img width="30" height="30" src="https://img.icons8.com/ios-filled/30/ask-question.png" alt="ask-question"/>Beer Entry Request</a></li>
        
        <li><a href="ViewAllBeerListing.php">
            <img width="30" height="30" src="https://img.icons8.com/ios-filled/30/beer.png" alt="beer"/>Beer Listing</a></li>

        <li><a href="ViewAllVenues.php">
            <img width="30" height="30" src="https://img.icons8.com/glyph-neue/30/performance.png" alt="performance"/>Venues</a></li>
        </ul>
        
        <ul class="nav navbar-nav navbar-right">
        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <img width="30" height="30" src="https://img.icons8.com/material-rounded/30/user.png" alt="user"/><span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a href="http://localhost/BeerSystemWeb/loginPage.php"> Logout</a></li>
            </ul>
        </li>
        </ul>
    </div>
    </nav>
</body>
</html>
