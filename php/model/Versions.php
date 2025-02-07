<?php
include_once('../operations/find_first_created_version_of_note.php');

    class Versions{
        public $versions = array();

        
        function GetAllVersionsFromDB(){
            
        }

        function addVersion($version){
            array_push($versions, $version);
        }

        function getFirstCreatedVersionFromDB(){
            return GetFirstCreatedVersionOfNote($noteid);
        }

        
    }

?>