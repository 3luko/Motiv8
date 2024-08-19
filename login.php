<?php
include('connection.php');
//if the submit button was clicked then it will start the query
$database = mysqli_connect('localhost', 'root', "", 'mymotiv');
if (isset($_POST['submit-button'])) {
    //getting the values from the username input and the password input
    $username = $_POST['login-username'];
    $password = $_POST['login-pwd'];
    $errors = array();

    //making sure that they are properly filled
    if (empty($username)) {
        array_push($errors, "Username Required");
    }
    if (empty($password)) {

        array_push($errors, "Password required");
    }



    //checking if username already exists in the database
    $user_query = "SELECT * FROM usersTest WHERE username ='$username'";
    $result_of_check = mysqli_query($conn, $user_query);
    $user = mysqli_fetch_assoc($result_of_check);
    if ($user) {
        if ($user['username'] === $username) {
            array_push($errors, "Username already exists");
            echo "Username already exists";
        }
    }


    if (count($errors) == 0) {
        $query = "INSERT INTO usersTest (username, password) VALUES ('$username', '$password')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            header("Location: welcome.php");
            exit();
        } else {
            echo "Error inserting user into database: " . mysqli_error($conn);
        }
    }
}
