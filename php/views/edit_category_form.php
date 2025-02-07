<?php

    include_once("connectToDb.php");
    include_once("php/model/Category.php");
    include_once("php/operations/get_user_data.php");


    function EditCategory(){
        $note_id = $_POST['noteid'];

        $conn = connectToDb();
        $userid = GetUserId();
        $sql = "SELECT * FROM Note WHERE NoteID = ".$note_id " AND FK_UserID=".$userid;
        $result = $conn->query($sql);
        if($result -> num_rows > 0){
            $row = $result->fetch_assoc();
            $note_title = $_row['Title'];
            $note_content = $_row['Content'];
            $note_number = $_row['NoteNumber'];
            $note_category = GetCategoryByID($_row['FK_CategoryID']);

        }

        
        echo "<script>$('#noteid').text('".$name."');</script>";
    
    }



    function GetCategoryByID($id){
        $sql = "SELECT * FROM Category WHERE CategoryID = ".$id;
        $conn=connectToDb();
        $result = $conn->query($sql);
        if($result -> num_rows > 0){
            $row = $result->fetch_assoc();
            $category = new Category();
            $category->setID($row['CategoryID']);
            $category->setName($row['CategoryName']);
            $category->setDescription($row['Description']);
            return $category;
        }

    }

    EditCategory();
?>