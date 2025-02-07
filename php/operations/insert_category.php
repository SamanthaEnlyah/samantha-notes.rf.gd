<?php

    include_once("../connectToDb.php");
    include_once("../model/Category.php");

    
    function InsertCategory(){
        $category=new Category();
        $category->setName($_GET["category_name"]);
        $sql = "INSERT INTO Category (CategoryName) VALUES ('".$category->name."')";
        $conn = connectToDb();
        $conn->query($sql);
        $conn->close();
    }

    InsertCategory();

?>