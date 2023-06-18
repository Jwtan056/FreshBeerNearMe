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
				header("Location: $path . /LoginPage.php");
			}
		}
		
	?>
		<form action='BeerOwnerCreationPage.php' method='POST'>
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
	</div>
		
</body>
</html>
