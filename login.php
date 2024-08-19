<?php
include('connection.php');
//if the submit button was clicked then it will start the query
if (isset($_POST['submit-button'])) {
    //getting the values from the username input and the password input
    $username = mysqli_real_escape_string($database, $_POST['login-user']);
    $password = mysqli_real_escape_string($database, $_POST['login-pwd']);
    $errors = array();

    //making sure that they are properly filled
    if (empty($username)) {
        array_push($errors, "Username Required");
    }
    if (empty($password)) {
        array_push($errors, "Password required");
    }

    //checking if username already exists in the database
    $user_query = "SELECT * FROM usersTest WHERE username='$username'";
    $result_of_check = mysqli_query($database, $user_query);
    $user = mysqli_fetch_assoc($result_of_check);

    if ($user['username'] === $username) {
        array_push($errors, "Username already exists");
    }

    if(count($errors) == 0){
        $query = "INSERT INTO userTest (username, password) VALUES ('$username', '$password')";
        
    }

    
}
