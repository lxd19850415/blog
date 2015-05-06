<?php
    class indexController{
        function index(){

            $articleobj = M('article');
            $pageN = 1;
            if($_GET['page'] != null){
                $pageN = $_GET['page'];

            }
            //文章的数据
            $data = $articleobj->get_article_list_by_page($pageN);
            VIEW::assign(array('data'=>$data));
            //分页数据
            $pageobj = M('page');
            $allArticleCount = $articleobj->get_article_count();
            $pageData = $pageobj->get_page_data($pageN,$allArticleCount);
            VIEW::assign(array('pagedata'=>$pageData));
            //权限
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

            $replyobj = M('reply');
            $replyData =$replyobj->findAll_by_articleid($_GET['id']);
            VIEW::assign(array('replies'=>$replyData));

            VIEW::display('index/article.html');
        }



        function showLogin(){
            $articleModel = M('article');
            $data = $articleModel->get_article_list();
            VIEW::assign(array('data'=>$data));

            $authobj = M('auth');
            $loginData =$authobj->checkCookie();

            VIEW::assign(array('loginData'=>$loginData));

            VIEW::display('index/login.html');


        }


        function login(){

            if(!empty($_POST)){
                $authobj = M('auth');
                if($authobj->loginsubmit()){
                    header("refresh:0;url=index.php");
                }
            }else{
                $this->showLogin();
            }

        }

        function logout(){
            $authobj = M('auth');
            $authobj->logout();
            header("refresh:0;url=index.php");
        }

        function reg(){

            if (defined('DISABLE_REG'))
            {
                echo "<script type=\"text/javascript\"> alert(\"暂未开放注册！\");   </script>";
                header("refresh:0;url=index.php");
                return;
            }

            if(!empty($_POST)){
                $mobj = M('user');
                $data = $mobj->regUser($_POST['name'],$_POST['password'],$_POST['email']);
                if($data == true){
                    header("refresh:0;url=index.php");
                }
                else{
                    echo "<script type=\"text/javascript\"> alert(\"用户名注册过了！\");   </script>";
                    header("refresh:0;url=index.php");
                }

            }else{
                $authobj = M('auth');
                $loginData =$authobj->checkCookie();
                VIEW::assign(array('loginData'=>$loginData));

                VIEW::display('index/reg.html');
            }


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

                $typeobj = M('type');
                $typeData =$typeobj->findAll_type();
                VIEW::assign(array('typeData'=>$typeData));

                VIEW::assign(array('loginData'=>$loginData));

                VIEW::display('index/post.html');
            }
        }

        function reply(){
            if(!empty($_POST)){
                $authobj = M('auth');
                $loginData =$authobj->checkCookie();
                if($loginData['isLogin'] == false){
                    $this->showLogin();
                    return;
                }

                $replyModel = M('reply');
                $data = $replyModel->add_reply($_POST);

                header("refresh:0;url=index.php");
            }else{
                $authobj = M('auth');
                $loginData =$authobj->checkCookie();
                if($loginData['isLogin'] == false){
                    $this->showLogin();
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


                $typeobj = M('type');
                $typeData =$typeobj->findAll_type();
                VIEW::assign(array('typeData'=>$typeData));
                VIEW::display('index/assort.html');
            }
        }



    }

?>