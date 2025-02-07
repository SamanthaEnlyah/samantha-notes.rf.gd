<?php

    session_start();
    include_once("connectToDb.php");

    function IsLoggedInDb($email, $passwordHash){
        $conn = connectToDb();
        $sql="SELECT * FROM User WHERE Email = '".$email."' AND PasswordHash='".$passwordHash."'";
        $result = $conn->query($sql);   
        if($result->num_rows == 1){
            $conn->close();
           return true;
        } else {
            $conn->close();
            return false;
        }
    }

    function IsLoggedIn(){

        if(isset($_SESSION['email']) && isset($_SESSION['passwordHash'])){
            $email = $_SESSION['email'];
            $passwordHash = $_SESSION['passwordHash'];

            return IsLoggedInDb($email, $passwordHash);
        }

    }
    
    

?>