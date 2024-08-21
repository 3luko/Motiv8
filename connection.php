<?php
    //file to connect the website to my database
    $servername = "localhost";
    $username = "root";
    $db = "mymotiv";


    $conn = new mysqli($servername, $username, "", $db);
    if($conn->connect_error){
        die("Connection failed". $conn->connect_error);
    }
?>