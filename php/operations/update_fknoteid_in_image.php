<?php
    include_once("connectToDb.php");

    $imageid = $_GET['imageid'];
    $noteid = $_GET['noteid'];

    

    $sql = "UPDATE Image SET FK_NoteID=".$noteid." WHERE ImageID=".$imageid;
    $conn=connectToDb();
    $conn->query($sql);
    $conn->close();


    

?>