<?php
    class userModel{
        public $table='user';

        function findOne_by_username($username){
            $sql='select * from '.$this->table.' where account="'.$username.'"';
            return DB::findOne($sql);
        }

        function regUser($username,$password,$email){
            $sql='select * from '.$this->table.' where account="'.$username.'"';
            $data = DB::findOne($sql);
            if($data != null){
                return false;
            }

            $data = array(
                'account'=>$username,
                'password'=>md5($password),
                'email'=>$email
            );
            DB::insert($this->table,$data);
            return  true;


        }

    }

?>