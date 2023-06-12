<?php

//Start Session
session_start();

//Get SITEURL
$protocol = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https://" : "http://");
$siteUrl =  $protocol.$_SERVER['SERVER_NAME'];
//.$_SERVER['REQUEST_URI'];

//Create constants
define('SITEURL', $siteUrl);
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'abcdF@123');
define('DB_NAME', 'food-order');

 $connection = new mysqli(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
 // Check connection
 if ($connection->connect_errno) {
     echo "Failed to connect to MySQL: " . $connection->connect_error;
     header('Location:index.php');
 }
?>