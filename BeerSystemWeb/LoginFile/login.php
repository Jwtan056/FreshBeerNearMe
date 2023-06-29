<?php
    session_start();
    require_once('../Class/User.php');
    require_once('../vendor/autoload.php');

    $_SESSION['_id'] = "";

    $error = ''; // Variable To Store Error Message

    //If post login function
    if (isset($_POST['Login'])) {
        //Check whether fields empty
        if (empty($_POST['_id']) || empty($_POST['Password'])) {
            $error = "Please fill in this field.";
        } 
        else {
            // check if it exist in database
            $user = new User($_POST['_id']);
            $user->setPassword($_POST['Password']);

            if($user->CheckLogin() == "1"){
                $_SESSION['_id'] = $user->get_id();
				header("Location: ../SystemAdmin/UserDashboard.php");
            }

            else if($user->CheckLogin() == "2"){
                $_SESSION['_id'] = $user->get_id();
                header("Location: ../BeerOwner/BeerOwnerDashboard.php");
            }

            else{
                echo '<script>alert("Login failed.")</script>';
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<script src="../Utility.js"></script>
	<title>Login Page</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(images/beer.png);">
					<span class="login100-form-title-1">
						Fresh Beer Near Me <br> Sign In
					</span>
				</div>

				<form class="login100-form validate-form" action="login.php" method="POST">
					<div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
						<span class="label-input100">Username</span>
						<input class="input100" type="text" name="_id" placeholder="Enter username">
						<span class="focus-input100">
							<!--================================================
							<?php echo $error; ?>
							===============================================-->
						</span>
					</div>

					<div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
						<span class="label-input100">Password</span>
						<input class="input100" type="Password" name="Password" placeholder="Enter password">
						<span class="focus-input100">
							<!--================================================
							<?php echo $error; ?>
							===============================================-->
						</span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type='submit' value='Login' name='Login'>Login
						</button></form>
						<form action='../BeerOwner/BeerOwnerRegistrationPage.php' method='POST'>
							<button class="login101-form-btn">
								<input type='submit' value='Register' hidden name='BeerOwnerRegistrationPage'>Register
							</button>
						</form>
					</div>
			</div>
		</div>
	</div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>