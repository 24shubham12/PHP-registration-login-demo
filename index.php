<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
include_once 'dbconnect.php';
?>


<html>
    <head>
        <meta charset="UTF-8">
        <title>Home</title>
    </head>
    <body>
        <div>
            <h1>Welcome
            </h1>
        </div>
        <br>
        <div>
            <ul style="list-style-type: none">
                <?php if (isset($_SESSION['user_id'])) { ?>
                <li>
                    <p>Signed in as <?php echo $_SESSION['user_name'] ?> </p>
                </li>
                <li>
                    <a href="logout.php">Logout</a>
                </li>
                <?php } else { ?>
                <li>
                    <a href="login.php">Login</a>
                    <a href="register.php">Sign Up</a>
                </li>
                <?php } ?>
            </ul>
        </div>
    </body>
</html>
