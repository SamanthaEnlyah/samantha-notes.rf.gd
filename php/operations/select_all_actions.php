<?php

    include_once('connectToDb.php');

    function SelectAllActions(){
    
        $actions = array();

        $conn = connectToDb();
        $sql = "SELECT * FROM Action";
        $result = $conn->query($sql);
        if($result -> num_rows>0){
            while($row = $result -> fetch_assoc()){
                $action = new Action();
                $action -> setID($row["ActionID"]);
                $action -> setName($row["ActionName"]);
                array_push($actions, $action);
            }   
            $conn->close();
            return $actions;
        }
        $conn->close();

    }
        

?>