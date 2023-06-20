<!DOCTYPE html>
<html>
<?php
//Inclusion of files
require_once('Class/User.php');
require_once('Class/BeerOwner.php');

//Mongodb client configuration
require_once __DIR__ . '/vendor/autoload.php';

?>

<head> 
	<!-- Title of page + icon -->
	<title>Fresh Beer Near Me</title>
	<link rel="icon" type="images/x-icon" href="<insert icon>" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	
	<!-- Javascripts -->
	<script src="Utility.js"></script>
	
	<!-- CSS Stylesheets-->
	<!-- <link rel="stylesheet" href="<CSS file path>"> -->
</head>
<body>
	<div>
	<?php
		//User Creation
		if(isset($_POST['RegisterAccount'])){
			$beerowner= new BeerOwner($_POST['_id']);
			$beerowner->setfirstName($_POST['FirstName']);
			$beerowner->setlastName($_POST['LastName']);
			$beerowner->setGender($_POST['Gender']);
			$beerowner->setEmail($_POST['Email']);	
			$beerowner->setContact($_POST['contact']);	
			$beerowner->setDob($_POST['dob']);	
			$beerowner->setBusinessName($_POST['BusinessName']);
			$beerowner->setPassword($_POST['Password']);			
			
			if($beerowner->RegisterBeerOwner()){
				print("success");
			}
		}
		
		//User Login
		else if(isset($_POST['Login'])){
			$user = new User($_POST['_id']);
			$user->setPassword($_POST['Password']);

			if($user->CheckLogin()){ 
				if($user->getRoles() == "1"){
					header("Location: UserDashboard.php");
				}

				else if($user->getRoles() == "2"){
					header("Location: BeerOwnerDashboard.php");
				}
			}
			else {
				echo '<script>alert(Invalid Login Details)</script>';
			}
		}
		
	?>

	<?php
		if(isset($_POST['BeerOwnerRegisterationPage'])){
	?>
		<form action='index.php' method='POST'>
			<p>First Name:<input type='text' name='FirstName' required></p>
			<p>Last Name:<input type='text' name='LastName' required></p>
			<p>Gender:
				M<input type='radio' value='M' name='Gender' required>
				F<input type='radio' value='F' name='Gender'>
				N/A<input type='radio' value='None' name='Gender'>
			</p>
			<p>Business Name:<input type='text' name='BusinessName' required></p>
			<p>Email:<input type='email' name='Email' required></p>
			<p>Contact Number:<input type='text' name='contact' required></p>
			<p>Date Of Birth:<input type='text' name='dob' required></p>
			<p>Username:<input type='text' name='_id' required></p>
			<p>Password:<input type='password' id='Password' name='Password' onchange='UnlockRePassword()' required></p>
			<p>Password Confirmation:<input type='password' id='RePassword' name='RePassword' onchange='ComparePasswordOnChange()' disabled required></p>
			
			<p><input type='submit' value='Create account' name='RegisterAccount'></p>
		</form>
	<?php
		}
		else {
	?>
		<form action='index.php' method='POST'>
			<p>Username:<input type='text' name='_id' required></p>
			<p>Password:<input type='password' name='Password' required></p>
			<p><input type='submit' value='Login' name='Login'></p>
		</form>
		<form action='index.php' method='POST'>
			<p><input type='submit' value='Create Account' name='BeerOwnerRegisterationPage' ></p>
		</form>
	<?php
		}
	?>
	</div>
		
</body>
</html>
