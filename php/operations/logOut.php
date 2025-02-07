<?php


    session_start();

    include_once('connectToDb.php');

    function LogOut($email, $passwordHash){
        $conn = connectToDb();

        echo $email." to be logged out";

        $sql="SELECT * FROM User WHERE Email = '".$email."' AND PasswordHash='".$passwordHash."'";
        $result = $conn->query($sql);   
        if($result->num_rows == 1){
            $sql = "UPDATE User SET LoggedIn = 0 WHERE Email = '".$email."' AND PasswordHash='".$passwordHash."'";
            $conn->query($sql);
            echo $email." logged out";
        }else {
            echo "User not found";
        }

        if(isset($_SESSION['email']) && isset($_SESSION['passwordHash'])){
            unset($_SESSION['email']);
            unset($_SESSION['passwordHash']);
            session_unset();
            session_destroy();
        }   
        $conn->close();
    }

    if(isset($_SESSION['email']) && isset($_SESSION['passwordHash'])){
        $email = $_SESSION['email'];
        $passwordHash = $_SESSION['passwordHash'];
        
        LogOut($email, $passwordHash);
    }
   
    
?>
