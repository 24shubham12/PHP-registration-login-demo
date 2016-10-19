<?php
define('DBHOST', 'localhost');
define('DBUSER', 'root');
define('DBPASS', '');
define('DBNAME', 'testdb');

$con = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME) or
        die("Error" . mysqli_error($con));
?>
