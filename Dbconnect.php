<?php
//connect to mysql database
$con = mysqli_connect("localhost", "root", "", "testdb") or   //change username and password accordingly and give name of the db accordingly
        die("Error " . mysqli_error($con));
?>
