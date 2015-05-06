<?php
    class authModel{
        private $auth='';

        public function loginsubmit(){
            if(empty($_POST['name']) || empty($_POST['password'])){
                return false;
            }

            $username = addslashes($_POST['name']);
            $password = addslashes($_POST['password']);
            $this->auth=$this->checkuser($username,$password);
            if($this->auth){
                $_SESSION['user']=$username;
                setcookie('user',$username,time()+10 * 60);
                return true;
            }else{
                return false;
            }
        }

        public function getUser(){
            return $_COOKIE['user'];
        }

        public function checkCookie(){

            if(isset($_COOKIE['user']) && !empty($_COOKIE['user'])){

                $adminobj=M('user');
                $auth=$adminobj->findOne_by_username($_COOKIE['user']);

                $isAdmin =false;
                if($auth['auth'] == 100){
                    $isAdmin = true;
                }

                $arr= array(
                    'isLogin'=>true,
                    'user'=>$_COOKIE['user'],
                    'isAdmin'=>$isAdmin,
                );
            }else{
                unset($_SESSION['auth']);
                $arr= array(
                    'isLogin'=>false,
                    'user'=>'',
                    'isAdmin'=>'',
                );
            }
            return $arr;
        }

        public  function  logout(){
            unset($_SESSION['auth']);
            setcookie('user');
            $this->auth='';
        }

        private function checkuser($username,$password){
            $adminobj=M('user');
            $auth=$adminobj->findOne_by_username($username);

            if((!empty($auth)) && $auth['password']==md5($password)){
                return $auth;
            }else{
                return false;
            }
        }

        public function __construct(){
            if(isset($_SESSION['auth']) && (!empty($_SESSION['auth']))){
                $this->auth=$_SESSION['auth'];
            }
        }


    }




?>