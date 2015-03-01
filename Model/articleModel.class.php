<?php
    class articleModel{
        public $_table='article';

        function count(){
            $sql='select count (*) from '.$this->_table;
            return DB::findResult($sql,0,0);
        }

        function get_article_list(){
            $sql='select * from '.$this->_table.' order by updatetime desc';
            $data = DB::findAll($sql);
            return $this->formate_article($data);
        }

        function get_article($id){
            if(empty($id)){
                return array();
            }else{
                $id=intval($id);
                $sql='select * from '.$this->_table.' where id = "'.$id.'"';
                $data = DB::findOne($sql);
                return $this->formate_article_only_type($data);
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
                $content=addslashes($content);
                $type=addslashes($type);
                $data = array(
                    'title'=>$title,
                    'content'=>$content,
                    'type'=>$type,
                    'author'=>$auth,
                    'createtime'=>$createtime,
                    'updatetime'=>$updatetime
                );
                return  DB::insert('article',$data);
            }
        }

        function convertType($type){
            if($type=='0'){
                return '其他';
            }
            else if($type=='1'){
                return 'PHP';
            }
            else if($type=='2'){
                return 'cocos2d-x';
            }
            else if($type=='3'){
                return 'android';
            }
            else if($type=='4'){
                return 'IOS';
            }
            else if($type=='5'){
                return '笑话';
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


    }

?>