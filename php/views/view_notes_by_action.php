<?php
include_once("../operations/find_notes_by_action.php");
include_once("../operations/get_action_name_by_id.php");

    $actionID = $_POST['actionid'];  
    $notes = array();
    $notes = Find_notes_by_action($actionID);

   

    $actionName = GetActionNameByID($actionID);

    if(!is_array($notes)) {
        echo "No notes that are marked by ".$actionName." action.";
        return;
    }

    echo "<h1 actionid='".$actionID."'>".$actionName."</h1>";
    foreach($notes as $note){
        //pravim html
        echo "<div class='card'>
            <div class = 'card-body'
                <div noteid = '".$note->getID()."' class='card-title'>".$note->getTitle()."</div>
                <div class='card-text'>".$note->getFirstText()->getFirst100Letters()."</div>
                
            </div>
            <div class='card-footer'>Date created: ".$note->getCreationDate()."</div>
        </div>";
    }


?>

