<?php


    class ContentItem {
        public $id;
        public $content;
        public $PositionInNote;


        function setID($id){
            $this->id = $id;
        }

        function getID(){
            return $this->id;
        }

        function setContent($content){
            $this->content = $content;
        }

        function getContent(){
            return $this->content;
        }


        function setPositionInNote($PositionInNote){
            $this->PositionInNote = $PositionInNote;
        }
        
        function getPositionInNote(){
            return $this->PositionInNote;
        }

    }

?>