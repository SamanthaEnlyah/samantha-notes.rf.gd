<?php
    include_once("connectToDb.php");
    
    $noteid = $_POST['noteid'];
    $newtitle = $_POST['newtitle'];

    $conn = connectToDb();
    $sql = "UPDATE Note SET Title = '".$newtitle."' WHERE NoteID = ".$noteid;
    $conn->query($sql);

?>