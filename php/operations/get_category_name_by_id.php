<?php


function GetCategoryNameByID($id){

    $sql = "SELECT * FROM Category WHERE CategoryID = ".$id;
    
    $conn = connectToDb();
    $result = $conn->query($sql);
    if($result->num_rows == 1) {
        $categoryName = $result->fetch_assoc()['CategoryName'];
        $conn->close();
        return $categoryName;
    }
    $conn->close();
}

?>