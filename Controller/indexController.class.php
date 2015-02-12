<?php
    class indexController{
        function index(){

            $articleobj = M('article');
            $data = $articleobj->get_article_list();
            VIEW::assign(array('data'=>$data));

            $authobj = M('auth');
            $loginData =$authobj->checkCookie();
            VIEW::assign(array('loginData'=>$loginData));

            VIEW::display('index/index.html');
        }

        function getOneArticle(){

            $articleModel = M('article');
            $data = $articleModel->get_article(intval($_GET['id']));
            VIEW::assign(array('article'=>$data));

            $authobj = M('auth');
            $loginData =$authobj->checkCookie();
            VIEW::assign(array('loginData'=>$loginData));

            VIEW::display('index/article.html');
        }

        function login(){

            if(!empty($_POST)){
                $authobj = M('auth');
                if($authobj->loginsubmit()){
                    header("refresh:0;url=index.php");
                }
            }else{
                $articleModel = M('article');
                $data = $articleModel->get_article_list();
                VIEW::assign(array('data'=>$data));

                $authobj = M('auth');
                $loginData =$authobj->checkCookie();
                VIEW::assign(array('loginData'=>$loginData));

                VIEW::display('index/login.html');
            }

        }

        function logout(){
            $authobj = M('auth');
            $authobj->logout();
            header("refresh:0;url=index.php");
        }

        function reg(){

            $articleModel = M('article');
            $data = $articleModel->get_article_list();
            VIEW::assign(array('data'=>$data));

            $authobj = M('auth');
            $loginData =$authobj->checkCookie();
            VIEW::assign(array('loginData'=>$loginData));

            VIEW::display('index/reg.html');
        }

        function search(){

            if(!empty($_POST)){
                $articleModel = M('article');
                $data = $articleModel->search_article($_POST['keyword']);
                VIEW::assign(array('data'=>$data));

                $authobj = M('auth');
                $loginData =$authobj->checkCookie();
                VIEW::assign(array('loginData'=>$loginData));

                VIEW::display('index/index.html');
            }else{
                $authobj = M('auth');
                $loginData =$authobj->checkCookie();
                VIEW::assign(array('loginData'=>$loginData));

                VIEW::display('index/search.html');
            }
        }

        function post(){
            if(!empty($_POST)){
                $articleModel = M('article');
                $data = $articleModel->add_article($_POST);
                header("refresh:0;url=index.php");
            }else{
                $authobj = M('auth');
                $loginData =$authobj->checkCookie();
                if($loginData['isLogin'] == false){
                    $this->login();
                    return;
                }
                $articleModel = M('article');
                $data = $articleModel->get_article_list();
                VIEW::assign(array('data'=>$data));

//                $authobj = M('auth');
//                $loginData =$authobj->checkCookie();
                VIEW::assign(array('loginData'=>$loginData));

                VIEW::display('index/post.html');
            }
        }

        function assort(){

            if(!empty($_GET['type'])){
                $articleModel = M('article');
                $data = $articleModel->search_article_by_type($_GET['type']);
                VIEW::assign(array('data'=>$data));

                $authobj = M('auth');
                $loginData =$authobj->checkCookie();
                VIEW::assign(array('loginData'=>$loginData));

                VIEW::display('index/index.html');
            }else{
                $authobj = M('auth');
                $loginData =$authobj->checkCookie();
                VIEW::assign(array('loginData'=>$loginData));
                VIEW::display('index/assort.html');
            }
        }



    }

?>