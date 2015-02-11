<?php
    class authModel{
        private $auth='';

        public function loginsubmit(){
            if(empty($_POST['name']) || empty($_POST['password'])){
//                echo 'loginsubmit 1 false';
                return false;
            }

            $username = addslashes($_POST['name']);
            $password = addslashes($_POST['password']);
            $this->auth=$this->checkuser($username,$password);
            if($this->auth){
                $_SESSION['user']=$username;
                setcookie('user',$username,time()+10);
//                echo 'loginsubmit _SESSION'.$_SESSION['auth'];
                return true;
            }else{
//                echo 'loginsubmit false';
                return false;
            }
        }

        public function getUser(){
            $this->auth = $_COOKIE['user'];
            return $this->auth;
        }

        public function isLogin(){
//            if(isset($_SESSION['user']) && (!empty($_SESSION['user']))){
//                return true;
//            }else{
//                return false;
//            }
            if(isset($_COOKIE['user']) && !empty($_COOKIE['user'])){
                return true;
            }else{
                return false;
            }

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