<?php

    class Image extends ContentItem {
        public $id;
        public $imageBlob;        
        public $FK_versionID;

        function setID($id){
            $this->id = $id;
        }
        
        function getID(){
            return $this->id;
        }

        function setImage($imageBlob){
            $this->imageBlob = $imageBlob;
        }
        
        function getImage(){
            return $this->imageBlob;
        }


        
        function setFK_versionID($FK_versionID){
            $this->FK_versionID = $FK_versionID;
        }
        
        function getFK_versionID(){
            return $this->FK_versionID;
        }

    }

?>