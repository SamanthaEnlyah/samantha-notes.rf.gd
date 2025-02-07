<?php
include_once("../operations/find_notes_by_category.php");
include_once("../operations/get_category_name_by_id.php");

    $categoryID = $_POST['categoryid'];  

    
    $categoryName = GetCategoryNameByID($categoryID);
    echo "<h1 class='form-size' style='margin: 0 auto;' catid='".$categoryID."'>".$categoryName."</h1>";
    echo "<br>";

    $notes = array();
    $has_notes = Find_notes_by_category($categoryID);


    if(!$has_notes) {
            echo "No notes to show in " .$categoryName." category.";
            return;
    } 
    // foreach($notes as $note){
    //     //pravim html
    //     echo "<div class='card'>
    //         <div class = 'card-body'
    //             <div noteid = '".$note->getID()."' class='card-title'>".$note->getTitle()."</div>
    //             <div class='card-text'>".$note->getFirstText()->getFirst100Letters()."</div>
                
    //         </div>
    //         <div class='card-footer'>Date created: ".$note->getCreationDate()."</div>
    //     </div>";
    // }


?>

