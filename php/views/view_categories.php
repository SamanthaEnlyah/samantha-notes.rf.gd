<?php

    include_once("../model/Category.php");
    include_once("../operations/select_all_categories.php");
    
        
    function view_categories(){

    

        echo "<table class='table container'>";
        echo "<thead>";
        echo "<th>Category ID</th>";
        echo "<th>Category Name</th>";
        echo "</thead>";
        echo "<tbody>";

        $categories = SelectAllCategories();
        

        foreach($categories as $category){
            echo "<tr>";
            echo "<td>".$category->getID()."</td>";
            // echo "<td><a id='category' categoryID = '".$category->getID()."'>".$category->getName()."</a></td>";
            echo "<td><a href='javascript:show_notes_by_category(".$category->getID().");' name='category' id='category_".$category->getID()."' categoryID = '".$category->getID()."'>".$category->getName()."</a></td>";
            echo "</tr>";    
        }
        echo "</tbody>";
        echo "</table>";
    
    }
    view_categories();
?>