<?php
    // session_start();
    // include_once("connectToDb.php");
    // include("logIn.php");

    // function LogInFromForm(){

    //     if(isset($_POST["email"]) && isset($_POST["pass"])){          
    //         echo "LOGGING IN";
    //         $email = $_POST['email'];
    //         $pass = $_POST['pass'];

    //         $passwordHash = hash('sha256', $pass);
            
    //         LogIn($email, $passwordHash);
    //         echo "<script>console.log('email: ".$email."');</script>";   
    //     }
    // }
    
   header('Access-Control-Allow-Origin: *');
   header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
   header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');



    


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
                    echo "User found";
                } else {
                    echo "User not found";
                }
                
            }

            $conn->close();

            // $passed_login = password_verify($pass, $passwordHash);

            // $conn = connectToDb();
            // $sql1="SELECT * FROM User WHERE Email = '".$email."' AND PasswordHash='".$passwordHash."'";
            // $result = $conn->query($sql1);   
            // if($result->num_rows == 1){
            //     $sql2 = "UPDATE User SET LoggedIn = 1 WHERE Email = '".$email."' AND PasswordHash='".$passwordHash."'";
            //     $conn->query($sql2);
            //     $_SESSION['email'] = $email;
            //     $_SESSION['passwordHash'] = $passwordHash;
            //     echo "User found";

            // }else {
            //     echo "User not found";
            // }
            // $conn->close();
        }
    }

    LogInFromForm();

?>