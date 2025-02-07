<?php


    class Category{
        public $id;
        public $name;
        public $description;


        function setID($id){
            $this->id = $id;
        }

        function getID(){
            return $this->id;
        }

        function setName($name){
            $this->name = $name;
        }

        function getName(){
            return $this->name;
        }


        function setDescription($description){
            $this->description = $description;
        }

        function getDescription(){
            return $this->description;
        }
    }


?>