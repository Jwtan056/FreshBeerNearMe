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

if (isset($_POST['ViewAVenue'])) {
        
	// check if it exist in database
	$VenueObj = new Venue();
	$Venue = $VenueObj->ViewAVenue($_POST['_id']);
}

//User Creation
else if (isset($_POST['EditAVenue'])) {
	$location = new stdClass();
  
	// Added property to the object
	$location->coordinates = array($_POST['x'],$_POST['y']);

	$VenueObj = new Venue();
	$VenueObj->set_id($_POST['_id']);
	$VenueObj->setAddress($_POST['Address']);
	$VenueObj->setContact($_POST['Contact']);
	$VenueObj->setDays($_POST['days']);
	$VenueObj->setOpentime($_POST['Opentime']);
	$VenueObj->setClosetime($_POST['Closetime']);
	$VenueObj->setLocation($location);

	
	if ($VenueObj->EditVenue()) {
		header("Location: ViewAllVenues.php");
		echo '<script>alert("Venue Edited Successfully.")</script>';
	}

	else{
		echo '<script>alert("Venue Edit failed.")</script>';
	}		
}
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
		<div id="register" class="container">
			<h2>Edit A Venue</h2>
			<form class="form-horizontal" role="form" action='EditAVenue.php' method='POST'>
			<?php foreach ($Venue as $Venueinfo) { ?>
				<p>Venue Name:<input type='text' name='_id' value='<?php echo $Venueinfo['_id']; ?>' readonly></p>
				<p>Address:<input type='text' name='Address' value='<?php echo $Venueinfo['address']; ?>' required></p>
				<p>Contact:<input type='text' name='Contact' value='<?php echo $Venueinfo['contact']; ?>' required></p>
				<?php foreach ($Venueinfo['location'] as $location) { 
					$Counter = 0; 
					foreach ($location as $xy){
						if($Counter == 0){	?>
							<p>Location x-axis:<input type='text' name='x' value='<?php echo $xy; ?>' required></p>
						<?php } 
						else { ?>
							<p>Location y-axis:<input type='text' name='y' value='<?php echo $xy; ?>' required></p>
				<?php }
					$Counter++;
				} } ?>
				<p>Days:</p>
				<?php 
				$DaysChecked = [];
				foreach ($Venueinfo['days'] as $days) { 	
					array_push($DaysChecked,$days); 
				} ?>
				<p><input type='checkbox' name='days[]' value='Mon' <?php if(in_array('Mon',$DaysChecked)){ echo 'checked';	} ?>>Monday
				<input type='checkbox' name='days[]' value='Tue' <?php if(in_array('Tue',$DaysChecked)){ echo 'checked';} ?>>Tuesday
				<input type='checkbox' name='days[]' value='Wed' <?php if(in_array('Wed',$DaysChecked)){ echo 'checked';} ?>>Wednesday
				<input type='checkbox' name='days[]' value='Thu' <?php if(in_array('Thu',$DaysChecked)){ echo 'checked';} ?>>Thursday
				<input type='checkbox' name='days[]' value='Fri' <?php if(in_array('Fri',$DaysChecked)){ echo 'checked';} ?>>Friday
				<input type='checkbox' name='days[]' value='Sat' <?php if(in_array('Sat',$DaysChecked)){ echo 'checked';} ?>>Saturday
				<input type='checkbox' name='days[]' value='Sun' <?php if(in_array('Sun',$DaysChecked)){ echo 'checked';} ?>>Sunday</p>
				<p>Opening Hours:<input type='text' name='Opentime' value='<?php echo $Venueinfo['opentime']; ?>' required></p>
				<p>Closing Hours:<input type='text' name='Closetime' value='<?php echo $Venueinfo['closetime']; ?>' required></p>
				<p><input type='submit' value='Edit Venue' name='EditAVenue'></p>
				<?php } ?>
			</form>
		</div>
	</div>
</body>

</html>