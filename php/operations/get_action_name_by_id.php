<?php


function GetActionNameByID($id){

    $sql = "SELECT * FROM Action WHERE ActionID = ".$id;
    
    $conn = connectToDb();
    $result = $conn->query($sql);
    if($result->num_rows == 1) {
        $actionName = $result->fetch_assoc()['ActionName'];
        $conn->close();
        return $actionName;
    }
    $conn->close();
}

?>