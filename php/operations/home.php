<?php

    include_once("connectToDb.php");

    $sql = "SELECT * FROM Version INNER JOIN Action ON FK_ActionID = ActionID ORDER BY Date DESC LIMIT 5";
    $conn = connectToDb();

echo "home page";
?>