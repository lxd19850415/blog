<?php
    class manageController{
        function home(){

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

            VIEW::display('manage/home.html');
        }

        function delPost(){

            $articleobj = M('article');
            $articleobj->delete_article($_GET['id'] );

            header("refresh:0;url=index.php?controller=manage&method=home");
        }

        function editPost(){
            $articleModel = M('article');
            $data = $articleModel->get_article(intval($_GET['id']));
            VIEW::assign(array('article'=>$data));

            $authobj = M('auth');
            $loginData =$authobj->checkCookie();
            VIEW::assign(array('loginData'=>$loginData));

            $replyobj = M('reply');
            $replyData =$replyobj->findAll_by_articleid($_GET['id']);
            VIEW::assign(array('replies'=>$replyData));

            $typeobj = M('type');
            $typeData =$typeobj->findAll_type();
            VIEW::assign(array('typeData'=>$typeData));

            VIEW::display('manage/edit.html');

        }




    }

?>