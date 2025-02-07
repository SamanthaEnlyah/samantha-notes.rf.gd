<?php


    class Action{
        public $id;
        public $name;
        public $pastTense;


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


        function setPastTense($pastTense){
            $this->pastTense = $pastTense;
        }

        function getPastTense(){
            return $this->pastTense;
        }
    }


?>