<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Administrator Homepage</title>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <?php include 'navbar.php' ?>

    <div class="container" id="homepage">
        <h1><?php 
        session_start();
        $user_id = $_SESSION['_id'];
        echo "Welcome $user_id!"?> </h1>
    </div>

    <table style="color: red" >
    <tr>
        <th>Username</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email </th>
    </tr>
    <tr>
    <?php
        $SysAdmin = new SystemAdmin("");
        $UserAccounts = $SysAdmin->ViewAllUsers();

        //From here need to research alr
        foreach($UserAccounts as $_id => $value){
            echo "$_id: ";
            print_r(var_dump( $value ));
        }
    ?>
    </tr>
    </table>
</body>
</html>