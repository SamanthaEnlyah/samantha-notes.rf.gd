<?php

  session_start();
    include_once("connectToDb.php");

    function LogInFromForm(){
        // echo "<script>console.log('logging in as: email: ".$email."');</script>";   
        if(isset($_POST['email']) && isset($_POST['pass'])){
            $email = $_POST['email'];
            $pass = $_POST['pass'];

            $sqlLoginVerify = "SELECT PasswordHash FROM User WHERE Email = '".$email."'";
            $conn = connectToDb();
            $result = $conn->query($sqlLoginVerify);   
            if($result->num_rows == 1){

                $passwordHash = $result->fetch_assoc()['PasswordHash'];
                if(password_verify($pass, $passwordHash)) {
                    $_SESSION['email'] = $email;
                    $_SESSION['passwordHash'] = $passwordHash;

                    $sql2 = "UPDATE User SET LoggedIn = 1 WHERE Email = '".$email."' AND PasswordHash='".$passwordHash."'";
                    $conn->query($sql2);
                    echo $email;
                } else {
                    echo "User not found";
                }
                
            }

            $conn->close();

         
        }
    }

    LogInFromForm();

?>