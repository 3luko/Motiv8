<?php
    //file to connect the website to my database
    $servername = "localhost";
    $username = "root";
    $db = "mymotiv";


    $conn = new mysqli($servername, $username, "", $db);
    $database = mysqli_connect($servername, $username, '');
    if($conn->connect_error){
        die("Connection failed". $conn->connect_error);
    }
?>