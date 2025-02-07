<?php

    class Note{

        public $id;
        public $title;
        public $creationDate;

        public $content;

        public $noteNumber;

        // public $text = new Text();  //tipa Text
        // public $image = new Image();  //tipa Image
        
        public $FK_CategoryID;
        public $category; //tipa Category, a ne string
        
        public $FK_UserID;
        //public $contentArray = array();

        //public $contentCounter = 0;

        //public $versions = new Versions();

        public $versionID;

      /* public function __construct($id, $title, $content, $noteNumber, $FK_CategoryID, $FK_UserID) {
            $this->id = $id;
            $this->title = $title;
            $this->content = $content;
            $this->noteNumber = $noteNumber;
            $this->FK_CategoryID = $FK_CategoryID;
            $this->FK_UserID = $FK_UserID;
        }*/





        function getID(){
            return $this->id;
        }

        function setID($id){
            $this->id = $id;
        }

        function getTitle(){
            return $this->title;
        }

        function setTitle($title){
            $this->title = $title;
        }

        function getCreationDate(){
            return $this->creationDate;
        }

        function setCreationDate($creationDate){
            $this->creationDate = $creationDate;
        }

        function setContent($content){
            $this->content = $content;
        }

        function getContent(){
            return $this->content;
        }

        function getContentPeek(){
            
            //$latest_opened_tag_position = strrpos($this->content, "<");
            //return substr($this->content, 0, ($latest_opened_tag_position>300)?300:$latest_opened_tag_position);

            //return $this->content;

            $content_peek = strip_tags($this->content);
            return substr($content_peek, 0, (strlen($this->content)>300)?300:strlen($this->content));

            //return substr($this->content, 0, (strlen($this->content)>300)?300:strlen($this->content));
        }
        

        function getFK_CategoryID(){
            return $this->FK_CategoryID;
        }

        function setFK_CategoryID($FK_CategoryID){
            $this->FK_CategoryID = $FK_CategoryID;
        }
        
        function getCategory(){
            return $this->category;
        }

        function setCategory($category){
            $this->category = $category;
        }

        function setFK_UserID($FK_UserID){
            $this->FK_UserID = $FK_UserID;
        }

        function getFK_UserID(){
            return $this->FK_UserID;
        }

          
        function getNoteNumber(){
            return $this->noteNumber;
        }

        function setNoteNumber($NoteNumber){
            $this->noteNumber = $NoteNumber;
        }

        // function addTextToContent($text){
        //     array_push($contentArray, $text);
        //     $text->setPositionInNote(count($contentArray));
        // }

        // function addImageToContent($image){
        //     array_push($contentArray, $image);
        //     $image->setPositionInNote(count($contentArray));
        // }

        // function addContentItemToContentArray($item){
        //     array_push($contentArray, $item);
        //     $item->setPositionInNote(count($contentArray));
        
        // }

        // function getFirstText(){
        //     foreach($contentArray as $content) {
        //         if($content instanceof Text)
        //             return $content[0];    
        //     }
        //     return new Text()->setText("No text");
        // }


        function getVersionID(){
            return $this->versionID;
        }

        function setVersionID($versionID){
            $this->versionID = $versionID;
        }
    }

?>