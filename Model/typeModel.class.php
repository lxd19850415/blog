<?php
    class typeModel{
        public $_table='type';

        function findAll_type($username){
            $sql='select * from '.$this->_table.' order by id desc';
            $data = DB::findAll($sql);
            return $data;
        }
    }

?>