<!DOCTYPE html>
<html lang="en">
<?php
    session_start();
    $path = $_SESSION['path'];

    //Inclusion of files
    require_once($path . '/Class/User.php');
    require_once($path . '/Class/SystemAdmin.php');

    //Mongodb client configuration
    require_once $path . '/vendor/autoload.php';

    $user_id = $_SESSION['_id'];

    if(isset($_POST['submit_btn']))
    {
    //whatever u need to do
    }

?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
    <link href="../style.css" rel="stylesheet" type="text/css">
    <style>
        #saVenue {
            margin-left: auto;
            margin-right: auto;
            width: 800px;
            background-color: #d6d6d6;
            float: center;
            border-radius: 10px;
            border: solid #d6d6d6;
            padding: 10px 40px 25px;
            margin-top: 50px;
            margin-left: auto;
            margin-right: auto;
        }

        #saVenue th,
        #saVenue td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #000000;
        }

        #venue-id {
            color: black;
        }

        #view-button {
            padding: 2px 4px;
            font-size: 8px;
            text-align: right;
        }
    </style>
</head>
<body>
    <?php include 'navbar.php' ?>
    <div class="container" id="users">
        <h1>All Users</h1>
    </div>

    <table id="saVenue">
    <tbody>
        <?php
        $SysAdmin = new SystemAdmin($_SESSION['_id']);
        $UserAccounts = $SysAdmin->ViewAllUsers();

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
    </tbody>
    </table>
</body>
</html>