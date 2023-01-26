<?php
// Script to connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$database = "idiscuss";

$conn = mysqli_connect($servername, $username, $password, $database);
if(!$conn){
    echo die("Not Connect to the Database duo to this Error ---> " . mysqli_connect_error());
}


?>