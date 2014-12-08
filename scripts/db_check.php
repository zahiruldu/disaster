<?php 
require_once("../db.php");


//check DATABASE connection.
if(!$conn){
    
    die ("Connection failed:" . mysqli_connect_error());
}
else {
    echo "Connection Success!";
}
//create DATABASE

$sql = "CREATE DATABASE disaster";
if (mysqli_query($conn, $sql)) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . mysqli_error($conn);
}

mysqli_close($conn);

