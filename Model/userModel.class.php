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
                'email'=>$email,
                'time'=>date("Y-m-d H:i:s"),
                'auth'=>0,
            );
            DB::insert($this->table,$data);
            return  true;


        }

        function changePwd($username,$oldPassword,$password,$email){
            $sql='select * from '.$this->table.' where account="'.$username.'" and password = "'.md5($oldPassword).'"';
            $result = DB::findOne($sql);
            if($result == null){
                return false;
            }
            if($password && $email){
                $data = array(
                    'password'=>md5($password),
                    'email'=>$email,
                );
            }else{
                if($password){
                    $data = array(
                        'password'=>md5($password),
                    );
                }
                if($email){
                    $data = array(
                        'email'=>$email,
                    );
                }
            }
            DB::update($this->table,$data,' account= "'.$username.'"');
            return  true;
        }

    }

?>