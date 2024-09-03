<?php
session_start();
include('connection.php');
include('functions.php');
//if the submit button was clicked then it will start the query
if (isset($_POST['submit-button'])) {
    //getting the values from the username input and the password input
    $email = htmlspecialchars($_POST['login-email']);
    $username = htmlspecialchars($_POST['login-username']);
    $password = htmlspecialchars($_POST['login-pwd']);

    $errors = array();


    //making sure that they are properly filled
    if (empty($email)) {
        array_push($errors, "Email Required");
    }
    if (empty($username)) {
        array_push($errors, "Username Required");
    }
    if (empty($password)) {
        array_push($errors, "Password required");
    }

    

    //Error Handling
    if (!isGmail($email)){
        array_push($errors, "Please use a Gmail account.");
    }
    
    if (checkUser($conn, $username)){
        array_push($errors, "Username already taken");
    } 

    if (checkEmail($conn, $email)){
        array_push($errors, "Email already taken");
    }

    if(empty($email) && empty($username) && empty($password)){
        array_push($errors, "Please enter in the fields above.");
    }

    //if there are errors it will display the errors on the login page
    if (count($errors) > 0){
        $_SESSION['errors'] = $errors;
        header("Location: index.php");
        exit();
    }

    $_SESSION['session_user'] = $username;
    send_Entry_Mail($email, $username);

    //if there are no errors it will insert the user into the database
    if (count($errors) == 0) {
        create_User($email, $username, $pwd, $conn);
    }
    
}
