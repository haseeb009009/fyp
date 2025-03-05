<?php

//this file is used to connect to the database
//it is included in all the files that need to connect to the database


$servername = "localhost";
$username = "root";  // Change if needed
$password = "";  // Change if needed
$dbname = "lms_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
