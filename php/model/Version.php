<?php

        class Version{
            public $id;
            public $date;
            public $FK_ActionID;
            public $FK_NoteID;

            public setID($id){
                $this->id = $id;
            }

            public getID(){
                return $this->id;
            }

            public setDate($date){
                $this->date = $date;
            }
            
            public getDate(){
                return $this->date;
            }

            public setFK_ActionID($FK_ActionID){
                $this->FK_ActionID = $FK_ActionID;
            }
            
            public getFK_ActionID(){
                return $this->FK_ActionID;
            }

            public setFK_NoteID($FK_NoteID){
                $this->FK_NoteID = $FK_NoteID;
            }
            
            public get(){
                return $this->FK_NoteID;
            }
        }

?>