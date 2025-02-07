<?php
    session_start();
  function GetUserId(){
      $email = $_SESSION['email'];
      $passwordHash = $_SESSION['passwordHash'];


        $sql = "SELECT UserID FROM User WHERE Email = '".$email."' AND PasswordHash='".$passwordHash."'";
        $conn = connectToDb();
        $result = $conn -> query($sql);
        if($result->num_rows==1) {
            $id = $result->fetch_assoc()['UserID'];
            $conn->close();
            return  $id;
        }
    }

?>