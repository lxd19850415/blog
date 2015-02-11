<?php
    class indexController{
        function index(){

            $articleobj = M('article');
            $data = $articleobj->get_article_list();
            VIEW::assign(array('data'=>$data));

            $authobj = M('auth');
            $isLogin=$authobj->isLogin();
            $user=$authobj->getUser();
            $arr= array(
                'isLogin'=>$isLogin,
                'user'=>$user
            );
            VIEW::assign(array('loginData'=>$arr));

            VIEW::display('index/index.html');
        }

        function getOneArticle(){

            $articleModel = M('article');
            $data = $articleModel->get_article(intval($_GET['id']));
            VIEW::assign(array('article'=>$data));
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
                $isLogin=$authobj->isLogin();
                VIEW::assign(array('isLogin'=>$isLogin));

                VIEW::display('index/login.html');
            }

        }

        function logout(){

            $authobj = M('auth');
            $authobj->logout();
            $this->showmessaget('退出成功','');
        }
        function reg(){

            $articleModel = M('article');
            $data = $articleModel->get_article_list();
            VIEW::assign(array('data'=>$data));

            $authobj = M('auth');
            $isLogin=$authobj->isLogin();
            VIEW::assign(array('isLogin'=>$isLogin));

            VIEW::display('index/reg.html');
        }

        function search(){

            if(!empty($_POST)){
                $articleModel = M('article');
                $data = $articleModel->search_article($_POST['keyword']);
                VIEW::assign(array('data'=>$data));

                $authobj = M('auth');
                $isLogin=$authobj->isLogin();
                VIEW::assign(array('isLogin'=>$isLogin));

                VIEW::display('index/index.html');
            }else{
                $authobj = M('auth');
                $isLogin=$authobj->isLogin();
                VIEW::assign(array('isLogin'=>$isLogin));
                VIEW::display('index/search.html');
            }
        }

        function post(){
            if(!empty($_POST)){
                $articleModel = M('article');
                $data = $articleModel->add_article($_POST);
                header("refresh:0;url=index.php");
            }else{
                $articleModel = M('article');
                $data = $articleModel->get_article_list();
                VIEW::assign(array('data'=>$data));

                $authobj = M('auth');
                $isLogin=$authobj->isLogin();
                VIEW::assign(array('isLogin'=>$isLogin));
                VIEW::display('index/post.html');
            }
        }

        function assort(){

            if(!empty($_GET['type'])){
                $articleModel = M('article');
                $data = $articleModel->search_article_by_type($_GET['type']);
                VIEW::assign(array('data'=>$data));

                $authobj = M('auth');
                $isLogin=$authobj->isLogin();
                VIEW::assign(array('isLogin'=>$isLogin));

                VIEW::display('index/index.html');
            }else{
                $authobj = M('auth');
                $isLogin=$authobj->isLogin();
                VIEW::assign(array('isLogin'=>$isLogin));
                VIEW::display('index/assort.html');
            }
        }



    }

?>