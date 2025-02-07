<?php   

    include_once('connectToDb.php');

    $noteid = $_POST['id'];
    $sql = 'SELECT * FROM Note INNER JOIN Version ON NoteID = FK_NoteID WHERE NoteID='.$noteid;
    $conn = connectToDb();
    $result = $conn->query($sql);
    if($result->num_rows>0){
        while($row = $result->fetch_assoc()){

            $content = $row["Content"];

            $content = str_replace('style="width: 45%; height: 45%;"', 'style="width: 100%; height: 100%;"',  $content);

            echo

            " 

            <div id='card' class='card border-primary mb-3' style='width: 30rem; position: absolute; '>
                <div class='card-header' style='background-color: #ffffff;'>".$row["Date"]."</div>
                <div class='card-body'>
                    <h4 class='card-title' style='background-color: #ffffff;'>".$row["Title"]."</h4>
                    <p class='card-text' style='background-color: #ffffff;'>".$content."</p>
                </div>
            </div>            
            ";
        }
    }
?>