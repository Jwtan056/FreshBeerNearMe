<!DOCTYPE html>
<html lang="en">
<head>
  <title>Navigate Bar</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link href="../style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <nav class="navbar navbar-default">
    <div class="container-fluid" id="navbar">
        <ul class="nav navbar-nav">
        <li><a href="ViewAllVenues.php">
            <img width="30" height="30" src="https://img.icons8.com/ios-filled/30/marker.png" alt="marker"/>Venues</a></li>

        <li><a href="ViewAllBeer.php">
            <img width="30" height="30" src="https://img.icons8.com/ios-filled/30/beer.png" alt="beer"/>Beers</a></li>

        <li><a href="ViewAllPromotions.php">
            <img width="30" height="30" src="https://img.icons8.com/ios-filled/30/discount--v1.png" alt="discount--v1"/>Promotions</a></li>

        </ul>
        
        <ul class="nav navbar-nav navbar-right">
        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <img width="30" height="30" src="https://img.icons8.com/material-rounded/30/user.png" alt="user"/><span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a href="../loginPage.php">Logout</a></li>
            </ul>
        </li>
        </ul>
    </div>
    </nav>
</body>
</html>
