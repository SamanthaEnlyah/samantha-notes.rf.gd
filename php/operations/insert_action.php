<?php

    include_once("../connectToDb.php");
    include_once("../model/Action.php");

    

    function InsertAction(){
        $action=new Action();
        $action->setName($_GET["action_name"]);
        $sql = "INSERT INTO Action (ActionName, PastTense) VALUES ('".$action->name."', '".$action->.getPastTense()"')";
        $conn = connectToDb();
        $conn->query($sql);
        $conn->close();
    }

    InsertAction();

?>