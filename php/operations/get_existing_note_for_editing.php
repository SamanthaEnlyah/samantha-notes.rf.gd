<?php

    include_once("../connectToDb.php");
    include_once("../model/Note.php");


    $notenumber = $_GET['notenumber'];
    //echo "<script>alert('notenumber in php: ".$notenumber."');</script>";
    $noteid = $_GET['noteid'];

    //echo "<script>alert('noteid in php: ".$noteid."');</script>";

    $note = GetNoteFromID($noteid);

    
    $date = date("Y.m.d H:i:s");    

    function GetNoteFromID($noteid){
      
        $sql = "SELECT * FROM Note WHERE NoteID=".$noteid;
        $conn = connectToDb();
        $result = $conn -> query($sql);
        if($result->num_rows == 1){
            $row = $result->fetch_assoc();

            //return new Note($noteid, $row["Title"], $row["Content"], $row["NoteNumber"], $row["FK_CategoryID"], $row["FK_UserID"]);

            $NoteLatestVersion = new Note();
            $NoteLatestVersion->setID($noteid);
            $NoteLatestVersion->setTitle($row["Title"]);
            $NoteLatestVersion->setContent($row["Content"]);
            $NoteLatestVersion->setNoteNumber($row["NoteNumber"]);
            $NoteLatestVersion->setFK_CategoryID($row["FK_CategoryID"]);
            $NoteLatestVersion->setFK_UserID($row["FK_UserID"]);
            //$NoteLatestVersion->setCreationDate($row["Date"]);


            return $NoteLatestVersion;
        }
    }

   /* function array_push_assoc($array, $key, $value){
        $array[$key] = $value;
        return $array;
    }*/


    /*$response = [
        'data' => [
            'noteTitle' => $note->getTitle(),
            'noteContent' => $note->getContent(),
            'date' => $date,
            'categoryID' => $note->getFK_CategoryID()
        ]
    ];
*/

   //$testArray = array("key1" => "value1", "key2"=>"value2");

    $noteForJSON = [
        "noteTitle" => $note->getTitle(),
        "noteContent" => $note->getContent(),
        "noteNumber" => $note->getNoteNumber(),
        "categoryID" => $note->getFK_CategoryID()
    ];

    header('Content-Type: application/json');
    echo json_encode($noteForJSON);

/*
    $noteForJSON = array();
    $noteForJSON = array_push_assoc($noteForJSON, 'data', "");
    $noteForJSON = array_push_assoc($noteForJSON, 'noteTitle', $note->getTitle());
    $noteForJSON = array_push_assoc($noteForJSON, 'noteContent', $note->getContent());
    $noteForJSON = array_push_assoc($noteForJSON, 'date', $date);*/


    //$json = "{title: '".$note->getTitle()."', content: '".$note->getContent()."', date: '".$date."'}";
    //$json = '{noteTitle: "test 1"}';
    //[ {"albums" :   [{"albumtitle" : "Herzeleid", "year" : "1995", "number" : "1" }]}]
    /*
    {
        "orderID": 12345,
        "shopperName": "John Smith",
        "shopperEmail": "johnsmith@example.com"
    }
    */

    /*$json = [
    "noteTitle" => "test 1",          // String value
    "noteContent" => "This is a note.", // String value
    "date" => "2023-10-01",            // String value (date)
    "categoryID" => "1"                 // Integer value
]   ;*/

/*
    $noteJSON =  json_encode($noteForJSON);
    if (json_last_error() !== JSON_ERROR_NONE) {
        echo 'JSON encoding error: ' . json_last_error_msg();
    } else {
        // Output the JSON string
        return $noteJSON; // This will output: {"noteTitle":"test 1","noteContent":"This is a note.","date":"2023-10-01","categoryID":1}
    }*/
    
?>