<!DOCTYPE html>
<html lang="en">
<?php
    session_start();

    //Inclusion of files
    require_once('../Class/User.php');
    require_once('../Class/SystemAdmin.php');

    //Mongodb client configuration
    require_once '../vendor/autoload.php';

    $user_id = $_SESSION['_id'];

    $error = ''; // Variable To Store Error Message
    if (isset($_POST['ViewAUser'])) {
        
        // check if it exist in database
        $user = new SystemAdmin($_SESSION['_id']);
        $UserAccount = $user->ViewAUser($_POST['_id']);
    }

    //Edit user
    else if(isset($_POST['EditAUser'])) {
        $user = new SystemAdmin($_SESSION['_id']);
        $user->setfirstName($_POST['fname']);
        $user->setlastName($_POST['lname']);
        $user->setGender($_POST['gender']);
        $user->setEmail($_POST['email']);
        $user->setContact($_POST['contact']);
        $user->setDob($_POST['dob']);
        $user->setPassword($_POST['Password']);
        $EditSuccess = $user->EditAUser($_POST['_id']);
        if($EditSuccess == true){
            echo '<script>alert("Edit Successful.")</script>';
            header("Location: ViewAllUserAccounts.php");
        }
        else{
            echo '<script>alert("Edit Failed.")</script>';
        }
        
    }
?>

<script>
function EditUser() {
  if (confirm("Confirm to edit?") == true) {
    document.getElementById("submit-button").click();
  }
}
</script>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Administrator Homepage</title>
    <link href="../style.css" rel="stylesheet" type="text/css">

    <!-- Javascripts -->
	<script src="../Utility.js"></script>

	<!-- CSS Stylesheets-->
	<link href="../style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <?php include 'navbar.php' ?>

    <div class="container" id="homepage">
        <h1>Edit A User</h1>
    </div>

    <table id="saVenue"><form action="EditAUserAccount.php" method="POST">
    <?php foreach ($UserAccount as $User) { ?>
        <input id="name" name="_id" type="hidden" value="<?php echo $User['_id']; ?>">
    <?php
        echo "<tr><td>Username: " . $User['_id'] . "</tr></td>";
        echo "<tr><td>First Name: " . '<input type="text" id="fname" name="fname" value="' . $User['firstname'] . '">' . "</tr></td>"; 
        echo "<tr><td>Last Name: " . '<input type="text" id="lname" name="lname" value="' . $User['lastname'] . '">' . "</tr></td>"; 
        echo "<tr><td>Gender: " . '<input type="text" id="gender" name="gender" value="' . $User['gender'] . '">' . "</tr></td>"; 
        echo "<tr><td>Contact: " . '<input type="text" id="contact" name="contact" value="' . $User['contact'] . '">' . "</tr></td>"; 
        if($User['profile'] == "1"){
            echo "<tr><td>Profile: System Admin</tr></td>";
        }
        else if($User['profile'] == "2"){
            echo "<tr><td>Profile: Beer Owner</tr></td>";
        }
        else{
            echo "<tr><td>Profile: Beer Drinker</tr></td>";
        }

        
        echo "<tr><td>Email: " . '<input type="text" id="email" name="email" value="' . $User['email'] . '">' . "</tr></td>";
        echo "<tr><td>Date Of Birth: " .  '<input type="text" id="dob" name="dob" value="' . $User['dob'] . '">' . "</tr></td>";
        ?>
        <tr><td>Password:<input type='password' id='Password' name='Password' onchange='UnlockRePassword()' required></td></tr>
        <tr><td>Password Confirmation:<input type='password' id='RePassword' name='RePassword'
                onchange='ComparePasswordOnChange()' disabled required></td></tr>
                
        <input id="name" name="_id" type="hidden" value="<?php echo $User['_id']; ?>"><?php
        echo '<tr><td><input type="submit" name="EditAUser" id="submit-button" value="Edit"/></td></tr>';
    }?> 
    </table></form>
</body>
</html>