<!DOCTYPE html>
<html>
<?php
// Inclusion of files
require_once('Class/User.php');
require_once('Class/BeerOwner.php');
require_once __DIR__ . '/vendor/autoload.php';

// Session Handling
session_start();
?>

<head> 
	<!-- Title of page + icon -->
	<title>Fresh Beer Near Me</title>
	<link rel="icon" type="images/x-icon" href="<insert icon>" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	
	<!-- CSS Stylesheets-->
	<!-- <link rel="stylesheet" href="<CSS file path>"> -->
</head>
<body>
	<div>
		Hello World
	</div>
	<form method="POST">
		<button type="submit" formaction="logout.php" name="logout">log out </button>
		<?php
			print_r($_SESSION);
		?>
	</form>	
</body>
</html>
