<?php
// Server Name
$host = "localhost";
// Database Username
$username = "root";
// Database Password
$password = "";
// Database Name
$db_name = "technos_systems";

// Create Connection
$conn = new mysqli($host, $username, $password, $db_name);

// Check if database connection failed then do die
if(!$conn){
    die("Database connection failed.");
}