<?php
$dbserver='localhost';
$dbuser='root';
$dbpass='root';
$dbname='bulletin';
$conn=mysqli_connect($dbserver, $dbuser, $dbpass, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>