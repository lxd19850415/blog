<?php
    class articleModel{
        public $_table='article';

        function count(){
            $sql='select count (*) from '.$this->_table;
            return DB::findResult($sql,0,0);
        }

        function get_article_list(){
//            $sql='select * from '.$this->_table.' order by updatetime desc';
//            $data = DB::findAll($sql);
//            return $this->formate_article($data);
            return $this->get_article_list_by_page(1);
        }

        function get_article_list_by_page($count){
            $size = 6;
            $start = ($count - 1) * $size;

            $sql='select * from '.$this->_table.' order by updatetime desc limit '.$start.','.$size;
            $data = DB::findAll($sql);
            return $this->formate_article($data);
        }

        function get_article($id){
            if(empty($id)){
                return array();
            }else{
                $id=intval($id);

                $this->add_article_view_count($id);

                $sql='select * from '.$this->_table.' where id = "'.$id.'"';
                $data = DB::findOne($sql);
                return $this->formate_article_only_type($data);
            }
        }

        function add_article_view_count($id){
            if(empty($id)){
                return array();
            }else{
                $id=intval($id);

                $sql='select * from '.$this->_table.' where id = "'.$id.'"';
                $data = DB::findOne($sql);

                $viewCount = $data['viewcount'];

                if($viewCount){
                    $viewCount = $viewCount + 1;
                }else{
                    $viewCount = 1;
                }
                $arr=array(
                    'viewcount'=>$viewCount
                );
                $where=' id ="'.$id.'"';
                return DB::update($this->_table,$arr,$where);
            }
        }


        function search_article($keyword){
            if (empty($keyword)) {
                return array();
            } else {
                $sql = "select * from article where title like '%$keyword%' or content like '%$keyword%'";
                $data = DB::findAll($sql);
                return $this->formate_article($data);
            }
        }

            function search_article_by_type($type){
                if(empty($type)){
                    return array();
                }else{
                    $sql = "select * from article where type='$type'";
                    $data = DB::findAll($sql);
                    return $this->formate_article($data);
                }
        }

        function add_article($data){
            extract($data);
            $createtime=date("Y-m-d H:i:s");
            $updatetime=date("Y-m-d H:i:s");

            $authobj = M('auth');
            $auth=$authobj->getUser();
            if(empty($title) || empty($content)  ||empty($type)){
                return 0;
            }else{
                $title=addslashes($title);
//                $content=addslashes($content);
                $type=addslashes($type);
                $data = array(
                    'title'=>$title,
                    'content'=>$content,
                    'type'=>$type,
                    'author'=>$auth,
                    'createtime'=>$createtime,
                    'updatetime'=>$updatetime,
                    'replycount'=>0,
                    'viewcount'=>0
                );
                return  DB::insert('article',$data);
            }
        }

        function convertType($type){
            $sql='select * from type where id = "'.$type.'"';
            $data = DB::findOne($sql);
            if($data){
                return $data['typename'];
            }
            else{
                return '其他';
            }
        }

        function increase_reply_count($id){
            $id=intval($id);
            $sql='select * from '.$this->_table.' where id = "'.$id.'"';
            $data = DB::findOne($sql);
            $count=$data['replycount'];
            $count=intval($count,10);
            $count++;
            $arr=array(
                'replycount'=>$count
            );
            $where=' id ="'.$id.'"';
            return DB::update($this->_table,$arr,$where);
        }

        function formate_article($data){
            foreach($data as $k=>$article){
                $data[$k]['content']=mb_substr(strip_tags($data[$k]['content']),0,200);
                $data[$k]['type']=$this->convertType($data[$k]['type']);
                if(empty($data[$k]['replycount'])){
                    $data[$k]['replycount']=0;
                }
            }
            return  $data;
        }

        function formate_article_only_type($data){
                $data['type']=$this->convertType($data['type']);
            return  $data;
        }

        function get_article_count(){
            $sql='select count(*) as count from '.$this->_table;
            $data = DB::query($sql);
            if($data){
                return mysql_fetch_assoc($data)['count'];
            }
            else{
                return 0;
            }
        }


    }

?>