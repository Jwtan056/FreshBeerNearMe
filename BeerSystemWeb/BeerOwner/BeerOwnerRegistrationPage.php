<!DOCTYPE html>
<html>
<?php
session_start();
$path = $_SESSION['path'];

//Inclusion of files
require_once($path . '/Class/User.php');
require_once($path . '/Class/BeerOwner.php');

//Mongodb client configuration
require_once $path . '/vendor/autoload.php';

$user_id = $_SESSION['_id'];

?>

<head>
	<!-- Title of page + icon -->
	<title>Fresh Beer Near Me</title>
	<link rel="icon" type="images/x-icon" href="<insert icon>" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />

	<!-- Javascripts -->
	<script src="Utility.js"></script>

	<!-- bootstrap-->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
		integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
		integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
		crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
		integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
		crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
		integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
		crossorigin="anonymous"></script>
	<!-- CSS Stylesheets-->
	<link href="style.css" rel="stylesheet" type="text/css">
</head>

<script>
	.container label {
		display:inline-block;
		width:20px;
		text-align:left;
		flex:1;
	}
	.container input{
		flex:1;
	}
</script>

<body>
	<div id="main">
		<?php
		//User Creation
		if (isset($_POST['RegisterAccount'])) {
			$beerowner = new BeerOwner($_POST['_id']);
			$beerowner->setfirstName($_POST['FirstName']);
			$beerowner->setlastName($_POST['LastName']);
			$beerowner->setGender($_POST['Gender']);
			$beerowner->setEmail($_POST['Email']);
			$beerowner->setContact($_POST['contact']);
			$beerowner->setDob($_POST['dob']);
			$beerowner->setBusinessName($_POST['BusinessName']);
			$beerowner->setPassword($_POST['Password']);

			
			if ($beerowner->RegisterBeerOwner()) {
				header("Location: ../loginPage.php");
				echo '<script>alert("User Creation Success.")</script>';
			}

			else{
				echo '<script>alert("User Creation failed. User cannot use an existing username")</script>';
			}
			
			
		}

		?>
		<div id="register" class="container">
			<form class="form-horizontal" role="form" action='BeerOwnerRegistrationPage.php' method='POST'>
				<h2>Registration</h2>
				<p style="display: flex">First Name:
				<div><input type='text' name='FirstName' required></div></p>
				<p>Last Name:<input type='text' name='LastName' required></p>
				<p>Gender:
					<input type='radio' value='M' name='Gender' required>M
					<input type='radio' value='F' name='Gender'>F
					<input type='radio' value='None' name='Gender'>N/A
				</p>
				<p>Business Name:<input type='text' name='BusinessName' required></p>
				<p>Email:<input type='email' name='Email' required></p>
				<p>Contact Number:<input type='text' name='contact' required></p>
				<p>Date Of Birth:<input type='text' name='dob' required></p>
				<p>Username:<input type='text' name='_id' required></p>
				<p>Password:<input type='password' id='Password' name='Password' onchange='UnlockRePassword()' required>
				</p>
				<p>Password Confirmation:<input type='password' id='RePassword' name='RePassword'
						onchange='ComparePasswordOnChange()' disabled required></p>

				<p><input type='submit' value='Create account' name='RegisterAccount'></p>
			</form>
		</div>
	</div>
</body>

</html>