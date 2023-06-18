<!DOCTYPE html>
<html lang="en">
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
        <link href="/FYP/style.css" rel="stylesheet" type="text/css">
        <h1><h1><?php 
        session_start();
        $user_id = $_SESSION['_id'];
        echo "Welcome $user_id!"?> </h1></h1>
    </div>

    
</body>
</html>