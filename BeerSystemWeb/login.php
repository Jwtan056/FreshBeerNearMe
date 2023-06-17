<?php
session_start(); // Starting Session
$error = ''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
    if (empty($_POST['_id']) || empty($_POST['password'])) {
        $error = "Please fill in this field.";
    } else {
        // Define $username and $password
        $username = $_POST['_id'];
        $password = $_POST['password'];
        // Establishing Connection with Server by passing server_name, user_id and password as a parameter
        $connection = mysql_connect("localhost", "root", "");
        // To protect MySQL injection for Security purpose
        $username = stripslashes($_id);
        $password = stripslashes($password);
        $username = mysql_real_escape_string($_id);
        $password = mysql_real_escape_string($password);
        // Selecting Database
        $db = mysql_select_db("company", $connection);
        // SQL query to fetch information of registerd users and finds user match.
        $query = mysql_query("select * from login where password='$password' AND _id='$username'", $connection);
        $rows = mysql_num_rows($query);
        if ($rows == 1) {
            $_SESSION['login_user'] = $username; // Initializing Session
            header("location: profile.php"); // Redirecting To Other Page
        } else {
            $error = "User does not exist";
        }
        mysql_close($connection); // Closing Connection
    }
}
?>