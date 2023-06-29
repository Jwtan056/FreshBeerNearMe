<!DOCTYPE html>
<html>
<?php
session_start();

//Inclusion of files
require_once('../Class/User.php');
require_once('../Class/BeerOwner.php');
require_once('../Class/Venue.php');

//Mongodb client configuration
require_once ('../vendor/autoload.php');

$user_id = $_SESSION['_id'];

?>

<head>
	<!-- Title of page + icon -->
	<title>Fresh Beer Near Me</title>
	<link rel="icon" type="images/x-icon" href="<insert icon>" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />

	<!-- Javascripts -->
	<script src="../Utility.js"></script>

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
	<link href="../style.css" rel="stylesheet" type="text/css">
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
		if (isset($_POST['CreateAVenue'])) {
			$location = new stdClass();
		  
			// Added property to the object
			$location->coordinates = array($_POST['x'],$_POST['y']);

			$VenueObj = new Venue();
			$VenueObj->set_id($_POST['_id']);
			$VenueObj->setAddress($_POST['Address']);
			$VenueObj->setContact($_POST['Contact']);
			$VenueObj->setDays($_POST['days']);
			$VenueObj->setOwnerid($_SESSION['_id']);
			$VenueObj->setOpentime($_POST['Opentime']);
			$VenueObj->setClosetime($_POST['Closetime']);
			$VenueObj->setLocation($location);

			
			if ($VenueObj->CreateVenue()) {
				header("Location: ViewAllVenues.php");
				echo '<script>alert("Venue Creation Success.")</script>';
			}

			else{
				echo '<script>alert("Venue Creation failed. Venue cannot use an existing Venue id")</script>';
			}		
		}

		?>
		<div id="register" class="container">
			<form class="form-horizontal" role="form" action='CreateAVenue.php' method='POST'>
				<h2>Create A Venue</h2>
				<p>Venue Name:<input type='text' name='_id' required></p>
				<p>Address:<input type='text' name='Address' required></p>
				<p>Contact:<input type='text' name='Contact' required></p>
				<p>Location x-axis:<input type='text' name='x' required></p>
				<p>Location y-axis:<input type='text' name='y' required></p>
				<p>Days:</p>
				<p><input type='checkbox' name='days[]' value='Mon'>Monday
				<input type='checkbox' name='days[]' value='Tue'>Tuesday
				<input type='checkbox' name='days[]' value='Wed'>Wednesday
				<input type='checkbox' name='days[]' value='Thu'>Thursday
				<input type='checkbox' name='days[]' value='Fri'>Friday
				<input type='checkbox' name='days[]' value='Sat'>Saturday
				<input type='checkbox' name='days[]' value='Sun'>Sunday</p>
				<p>Opening Hours:<input type='text' name='Opentime' required></p>
				<p>Closing Hours:<input type='text' name='Closetime' required></p>
				<p><input type='submit' value='Create Venue' name='CreateAVenue'></p>
			</form>
		</div>
	</div>
</body>

</html>