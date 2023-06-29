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

    //Delete user
    else if(isset($_POST['DeleteAUser'])) {
        $user = new SystemAdmin($_SESSION['_id']);
        $DeleteSuccess = $user->DeleteAUser($_POST['_id']);
        if($DeleteSuccess == true){
            echo '<script>alert("Delete Successful.")</script>';
            header("Location: ViewAllUserAccounts.php");
        }
        else{
            echo '<script>alert("Delete Failed.")</script>';
        }
        
    }
?>

<script>
function DeleteUser() {
  if (confirm("Confirm to delete?") == true) {
    document.getElementById("submit-button").click();
  }
}
</script>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Administrator Homepage</title>
    <link href="../style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <?php include 'navbar.php' ?>

    <div class="container" id="homepage">
        <h1>View A User</h1>
    </div>

    <table id="saVenue">
    <?php foreach ($UserAccount as $User) { ?>
        <input id="name" name="_id" type="hidden" value="<?php echo $User['_id']; ?>">
    <?php
        echo "<tr><td>Username: " . $User['_id'] . "</tr></td>";
        echo "<tr><td>First Name: " . $User['firstname'] . "</tr></td>"; 
        echo "<tr><td>Last Name: " . $User['lastname'] . "</tr></td>"; 
        echo "<tr><td>Gender: " . $User['gender'] . "</tr></td>"; 
        echo "<tr><td>Contact: " . $User['contact'] . "</tr></td>"; 
        echo "<tr><td>Profile: " . $User['profile'] . "</tr></td>";
        echo "<tr><td>Email: " . $User['email'] . "</tr></td>";
        echo "<tr><td>Date Of Birth: " . $User['dob'] . "</tr></td>";
        if(isset($User['businessname']) == true){
            echo "<tr><td>Business Name: " . $User['businessname'] . "</tr></td>"; 
        } ?>
        <form action="ViewAUserAccount.php" method="POST">
        <input id="name" name="_id" type="hidden" value="<?php echo $User['_id']; ?>">
        <?php
        echo '<tr><td><input type="button" value="Delete" onclick="DeleteUser()"/></td></tr>';
        echo '<input type="submit" name="DeleteAUser" id="submit-button" style="visibility: hidden;"/>';
        ?></form>
        <form action="EditAUserAccount.php" method="POST">
        <input id="name" name="_id" type="hidden" value="<?php echo $User['_id']; ?>"><?php
        echo '<tr><td><input type="submit" name="ViewAUser" id="submit-button" value="Edit"/></td></tr>';
        ?></form><?php
    }?> 
    </table>
</body>
</html>