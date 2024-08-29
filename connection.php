<?php
$env = parse_ini_file('.env');
//file to connect the website to my database
$servername = $env['DB_HOST'];
$username = $env['DB_USER'];
$password = $env['DB_PASSWORD'];
$db = $env['DB_NAME'];


$conn = new mysqli($servername, $username, $password, $db);
if ($conn->connect_error) {
    die("Connection failed" . $conn->connect_error);
}
