<?php
//to access the database on the server
$servername = "localhost";
$username = "root";
$password = "";


// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "CREATE DATABASE GameLaboratory";
$conn->query($sql);


$dbname = "GameLaboratory";
//Run again with the Database name this time needed to be run again incase the database didn't exist yet because could not input empty database variable
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


//Making the USER table
$sql = "CREATE TABLE MyUsers (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(250) NOT NULL,
password VARCHAR(500) NOT NULL, 
firstname VARCHAR(150) NOT NULL,
lastname VARCHAR(150) NOT NULL,
email VARCHAR(200),
reg_date TIMESTAMP
)";
$conn->query($sql);


$sql = "CREATE TABLE Messages (
    id INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(250) NOT NULL,
    message VARCHAR(500) NOT NULL,
    message_date TIMESTAMP
    )";
$conn->query($sql);


//commented out the close connection but have added a close to each script as if connection was closed they wouldn't be able to connect'
//$conn->close();

?>