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
                session_start();//启动session，必须放在第一句，否则会出错。
                $_SESSION['auth']=$this->auth;
//                echo 'loginsubmit _SESSION'.$_SESSION['auth'];
                return true;
            }else{
//                echo 'loginsubmit false';
                return false;
            }
        }

        public function getauth(){
            return $this->auth;
        }

        public function isLogin(){
//            echo 'isLogin() _SESSION='.$_SESSION['auth'];
            if(isset($_SESSION['auth']) && (!empty($_SESSION['auth']))){
//                echo 'isLogin()true11';
                return true;
            }else{
//                echo 'isLogin()false22';
                return false;
            }
        }

        public  function  logout(){
            unset($_SESSION['auth']);
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