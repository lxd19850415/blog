<?php
    header("Content-type:text/html;charset=utf-8");
    session_start();
    require('config.php');
    require('kako/pc.php');
    PC::run($config);
?>