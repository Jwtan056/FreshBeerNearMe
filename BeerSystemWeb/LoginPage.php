<?php
    session_start();
    require_once('Class/User.php');
    //require_once('Class/BeerOwner.php');
    require_once __DIR__ . '/vendor/autoload.php';

    $_SESSION['_id'] = "";
    $_SESSION['path'] = __DIR__;

    $error = ''; // Variable To Store Error Message
    if (isset($_POST['Login'])) {
        if (empty($_POST['_id']) || empty($_POST['Password'])) {
            $error = "Please fill in this field.";
        } 
        else {
            // check if it exist in database
            $user = new User($_POST['_id']);
            $user->setPassword($_POST['Password']);

            if($user->CheckLogin()){
                if($user->getRoles() == "1"){
                    $_SESSION['_id'] = $user->get_id();
					header("Location: SystemAdmin/UserDashboard.php");
				}
				else if($user->getRoles() == "2"){
                    $_SESSION['_id'] = $user->get_id();
					header("Location: BeerOwner/BeerOwnerDashboard.php");
				}
            }
        }
    }
?>

<!DOCTYPE html>
<html>

<head>
    <script src="Utility.js"></script>
    <title>Login Page</title>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div id="main">
        <div id="login">
            <h2>Login</h2>
            <form action="LoginPage.php" method="POST">
                <label> Username :</label>
                <input id="name" name="_id" type="text">
                <span>
                    <?php echo $error; ?>
                </span>
                </br>
                </br>
                <label>Password :</label>
                <input id="password" name="Password" type="password">
                <span>
                    <?php echo $error; ?>
                </span>
                </br>
                </br>
                <input type='submit' value='Login' name='Login'>
            </form>
            <form action='BeerOwner/BeerOwnerRegistrationPage.php' method='POST'>
			    <p><input type='submit' value='Register' name='BeerOwnerRegisterationPage' ></p>
		    </form>
        </div>
    </div>
</body>
</html>