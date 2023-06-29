<!DOCTYPE html>
<html lang="en">
<?php
    session_start();
    $path = $_SESSION['path'];

    //Inclusion of files
    require_once('../Class/User.php');
    require_once('../Class/SystemAdmin.php');

    //Mongodb client configuration
    require_once '../vendor/autoload.php';

    $SysAdmin = new SystemAdmin($_SESSION['_id']);
    $UserAccounts = $SysAdmin->ViewAllUsers();

    if (isset($_POST['SearchAUser'])) {
        // check if it exist in database
        $UserAccounts = $SysAdmin->SearchUserAccount($_POST['searchterm']);
    }

?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
    <link href="../style.css" rel="stylesheet" type="text/css">

</head>
<body>
    <?php include 'navbar.php' ?>
    <div class="container" id="users">
        <h1>All Users</h1>
    </div>

    <table id="saVenue">
    <tbody>
        <?php
        //From here for u to design
        foreach ($UserAccounts as $User) {
        ?>
        <tr>
        <form action="ViewAUserAccount.php" method="POST">
            <td>
                <input id="name" name="_id" type="hidden" value="<?php echo $User['_id']; ?>">
                <br>
                <?php echo $User['firstname']; ?>
                <br>
                <?php echo $User['lastname']; ?>
                <br>
                <?php echo $User['email']; ?>
            </td>
            <td><?php
            echo '<form type="POST"><input type="submit" name="ViewAUser" value="View"></form>';
            }; ?> </form></td>
        </tr>
        <tr>
        <form action="CreateUserAccount.php" method="POST">
            <td><?php
            echo '<form type="POST"><input type="submit" name="CreateAUser" value="Create User Account"></form>';
             ?> </form></td>
        </tr>
        <tr>
        <form action="ViewAllUserAccounts.php" method="POST">
            <td><?php
            echo "<input type='text' name='searchterm'>";
            echo '<form type="POST"><input type="submit" name="SearchAUser" value="Search"></form>';
             ?> </form></td>
        </tr>
    </tbody>
    </table>
</body>
</html>