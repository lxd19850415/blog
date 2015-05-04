<?php
    class pageModel{

        function get_page_data($page,$listCount){

            $pageN = $page;
            $pageSize = 6;

            $maxShowPageCount = 2 + 1 + 2;
            $halfMaxPageCount = floor($maxShowPageCount / 2);
            $allArticleCount = $listCount;
            $realPageCount = floor($allArticleCount / $pageSize);
            if($allArticleCount % $pageSize != 0){
                $realPageCount++;
            }

            $prePage = null;
            $preDot = false;
            $nextPage = null;
            $nextDot = false;

            $pageNum=array();

            if($pageN - $halfMaxPageCount > 1){
                $preDot = true;

            }
            if($pageN  > 1){
                $prePage = $pageN - 1;
            }
            if($pageN  < $realPageCount){
                $nextPage = $pageN + 1;
            }

            if($pageN + $halfMaxPageCount < $realPageCount){
                $nextDot = true;
            }

            if($realPageCount < $maxShowPageCount){
                //实际页数不足最大可以显示的，就按照实际页数
                for($i=0;$i<$realPageCount;$i++){
                    $pageNum[$i]= $i + 1;
                }
            }else{
                if($pageN - $halfMaxPageCount <= 1 ){

                    for($i=0;$i<$maxShowPageCount;$i++){
                        $pageNum[$i]= $i + 1;
                    }
                }
                if($pageN + $halfMaxPageCount >= $realPageCount){

                    for($i=0;$i<$maxShowPageCount;$i++){
                        $pageNum[$i]= $realPageCount - $maxShowPageCount + $i + 1;
                    }
                }
            }

            $page=array(
                'hasPrePage'=>$prePage,
                'hasPreDot'=>$preDot,
                'hasNextDot'=>$nextDot,
                'hasNextPage'=>$nextPage,
                'pageLast'=>$realPageCount,
                'pageNum'=>$pageNum,
            );
            return $page;
        }



    }

?>