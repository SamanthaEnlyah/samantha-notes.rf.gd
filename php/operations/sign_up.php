<?php

    include_once("connectToDb.php");
    include_once("logIn.php");
    include_once("check_if_username_already_exists.php");

    function SignUp($email, $passwordHash){
        $conn = connectToDb();
        if(exists($conn, $email)){
            echo "This email already exists.";
            return;
        }
        $sql = "INSERT INTO User(Email, PasswordHash) VALUES('".$email."','".$passwordHash."')";
        $conn->query($sql);
        $conn->close();

        LogIn($email, $passwordHash);
        session_start();
        $_SESSION['email'] = $email;
        $_SESSION['passwordHash'] = $passwordHash;
        echo "You are registered and logged in.";
        
    }

    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $passHash = password_hash($pass, PASSWORD_DEFAULT);
    //hash('sha256', $pass);

    SignUp($email, $passHash);


?>