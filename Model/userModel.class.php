<?php
    class userModel{
        public $table='user';

        function findOne_by_username($username){
            $sql='select * from '.$this->table.' where account="'.$username.'"';
            return DB::findOne($sql);
        }
    }

?>