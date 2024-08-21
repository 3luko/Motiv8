<?php
include('connection.php');
//if the submit button was clicked then it will start the query
if (isset($_POST['submit-button'])) {
    //getting the values from the username input and the password input
    $email = $_POST['login-email'];
    $username = $_POST['login-username'];
    $password = $_POST['login-pwd'];

    $errors = array();

    //making sure that they are properly filled
    if (empty($email)) {
        array_push($errors, "Email Required");
        echo "Email Required";
        exit();
    }
    if (empty($username)) {
        array_push($errors, "Username Required");
        echo "Username Required";
        exit();
    }
    if (empty($password)) {
        array_push($errors, "Password required");
        echo "Password Required. Please try again";
        exit();
    }

    //checking if email is in the database 
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();


    if ($user) {
        global $errors;
        if ($user['email'] === $email) {
            $errors[] = "This email is in the database. Please try again.";
            echo "This email is in the database. Please try again.";
            exit();
        }
    }
    $stmt->close();

    //checking if username is in the database
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    if($user){
        if($user['username'] === $username){
            $errors[] = "This username is in the database. Please try again.";
            echo "This username is in the database. Please try again.";
            exit();
        }
    }
    $stmt->close();

    //if there are no errors it will insert the user into the database
    if (count($errors) == 0) {
        $stmt = $conn->prepare("INSERT INTO users (email, username, pwd) VALUES (?, ?, ?)");
        $stmt->bind_param('sss', $email, $username, $password);
        if ($stmt->execute()) {
            header("Location: welcome.php");
            exit();
        } else {
            echo "Error inserting user into database: " . mysqli_error($conn);
        }
    }
    $stmt->close();
}
