<?php


include_once("../model/Action.php");
include_once("../operations/select_all_actions.php");

    
function view_all_actions(){



    echo "<table class='table container'>";
    echo "<thead>";
    echo "<th>Action ID</th>";
    echo "<th>Action Name</th>";
    echo "</thead>";
    echo "<tbody>";

    $actions = SelectAllActions();
    

    foreach($actions as $action){
        echo "<tr>";
        echo "<td>".$action->getID()."</td>";
        
        echo "<td><a href='javascript:show_notes_by_action(".$action->getID().");' name='action' id='action".$action->getID()."' actionID = '".$action->getID()."'>".$action->getName()."</a></td>";
        echo "</tr>";    
    }
    echo "</tbody>";
    echo "</table>";

}

view_all_actions();

?>