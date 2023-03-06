<?php

    //Start Session
    session_start();


    //Create Constants to Store Non Repeating Values becoz these values will be same for all pages
    define('SITEURL', 'http://localhost/tanmay-food-order/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'tanmay-food-order');


    //Database connection
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());  
    
    // Selecting Database
    //$db_select = mysqli_select_db($conn, 'Database_name') or die(mysqli_error());   
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());   // Selecting Database


?>

<!-- To add this file in all pages we will include this page in menu.php -->