<?php
    class replyModel{

        public $_table='replies';

        function findAll_by_articleid($articleid){
            $sql='select * from '.$this->_table.' where articleid="'.$articleid.'"';
            return DB::findAll($sql);
        }

        function add_reply($data){
            extract($data);
            $createtime=date("Y-m-d H:i:s");
            $articleid=$_GET['articleid'];
            $authobj = M('auth');
            $auth=$authobj->getUser();
            if(empty($content)){
                return 0;
            }else{

                $articleobj = M('article');
                $articleobj->increase_reply_count($articleid);

                $content=addslashes($content);
                $data = array(
                    'articleid'=>$articleid,
                    'content'=>$content,
                    'author'=>$auth,
                    'createtime'=>$createtime
                );
                return  DB::insert($this->_table,$data);
            }
        }



    }

?>