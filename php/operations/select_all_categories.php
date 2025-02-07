<?php
    include_once("connectToDb.php");
    include_once("../model/Category.php");

    function SelectAllCategories(){
        
        $sql = "SELECT * FROM Category";
        $conn = connectToDb();
        $result = $conn->query($sql);
        $categories = array();
        if($result -> num_rows > 0){
            
            while($row = $result->fetch_assoc()){
                   $category = new Category();
                   $category->setID($row["CategoryID"]);
                   $category->setName($row["CategoryName"]);

                   array_push($categories, $category);
            }
           
        }
        $conn->close();
        return $categories;
    }
?>