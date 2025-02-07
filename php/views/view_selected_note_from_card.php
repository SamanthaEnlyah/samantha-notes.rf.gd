<?php
    include_once("../connectToDb.php");

    function ViewSelectedCard(){
        $noteid = $_GET['noteid'];
        echo $noteid;
        $sql = "SELECT * FROM Note WHERE NoteID = ".$noteid;
        $conn = connectToDb();
        $result = $conn->query($sql);

        if($result->num_rows == 1){
            $row = $result->fetch_assoc();
            echo "<div class='container container-responsive' >";
            echo "<div class='card'>";
                echo "<div class='card-header' >".$row['NoteNumber']."</div>";
                echo "<div class='card-body' id='direct_change_card_body'>";
                    echo "<div id='change_title_save_btn_group' class='btn-group' style='width: 100%;'>";
                        echo "<h4 class='card-title' id='change_title_from_card' noteid='".$noteid."'>".$row['Title']."</h4>";
                    echo "</div>";
                    echo "<div class='card-text' id='edit_note_directly_from_card' noteid='".$noteid."' categoryid='".$row['FK_CategoryID']."'>".$row['Content']."</div>";
                echo "</div>";
            echo "</div>";
            echo "</div>";

        }
    }

ViewSelectedCard();
?>