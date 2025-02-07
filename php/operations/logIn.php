
<?php

    session_start();
    include_once("connectToDb.php");

    function LogIn($email, $passwordHash){
        $conn = connectToDb();
        $sql1="SELECT * FROM User WHERE Email = '".$email."' AND PasswordHash='".$passwordHash."'";
        $result = $conn->query($sql1);   
        if($result->num_rows == 1){
            $sql2 = "UPDATE User SET LoggedIn = 1 WHERE Email = '".$email."' AND PasswordHash='".$passwordHash."'";
            $conn->query($sql2);
            $_SESSION['email'] = $email;
            $_SESSION['passwordHash'] = $passwordHash;
            echo "User found";

        }else {
            echo "User not found";
        }
        $conn->close();

        $_SESSION['mail'] = $email;
        $_SESSION['passwordHash'] = $passwordHash;


    }




?>
