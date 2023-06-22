<!DOCTYPE html>
<html lang="en">
    <?php
    session_start();
    $path = $_SESSION['path'];

    // Inclusion of files
    require_once($path . '/Class/User.php');
    require_once($path . '/Class/BeerOwner.php');
    require_once($path . '/Class/Promotion.php');

    // Mongodb client configuration
    require_once $path . '/vendor/autoload.php';

    $user_id = $_SESSION['_id'];
    ?>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>View All Promotions</title>
        <link href="style.css" rel="stylesheet" type="text/css">
        <style>
            /* CSS styling for the table */
            .venue-table {
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

            .venue-table th,
            .venue-table td {
                padding: 8px;
                text-align: left;
                border-bottom: 1px solid #000000;
            }

            .venue-id {
                color: black;
            }

            .view-button {
                padding: 2px 4px;
                font-size: 8px;
                text-align: right;
            }
        </style>
    </head>

    <body>
        <?php include 'boNavbar.php' ?>
        <link href="style.css" rel="stylesheet" type="text/css">

        <div class="container" id="homepage">
            <h1>All Promotions</h1>
            <br>
        </div>

        <table class="venue-table">
            <tbody>
                <?php
                $PromotionObj = new Promotion();
                $PromotionObj->setOwnerid($user_id);
                $AllPromotions = $PromotionObj->ViewAllPromotion();

                foreach ($AllPromotions as $Promotion) {
                    ?>
                    <tr>
                        <td>
                            <span class="venue-id"><?php echo $Promotion['name']; ?></span><br>
                        <?php echo $Promotion['details']; ?>
                        </td>
                        <td>
                            <form action="ViewAPromotion.php" method="POST"> 
                                <input id ="name" name="_id" type="hidden" value="<?php echo $Promotion['_id']; ?>">
                                <br>
                                <input type="submit" name="ViewAPromotion" value="View Promotion">
                            </form>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>   
    </body>   
</html>
