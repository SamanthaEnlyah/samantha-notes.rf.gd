<?php

    class Text extends ContentItem {
        public $id;
        public $text;
        public $FK_versionID;

        function setID($id){
            $this->id = $id;
        }
        
        function getID(){
            return $this->id;
        }

        function setText($text){
            $this->text = $text;
        }
        
        function getText(){
            return $this->text;
        }

        
        function setFK_versionID($FK_versionID){
            $this->FK_versionID = $FK_versionID;
        }
        
        function getFK_versionID(){
            return $this->FK_versionID;
        }

        function getFirst100Letters(){
            return substr($text, 0, 100);
        }
    }

?>