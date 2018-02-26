<?php 

header("content-type:text/html;charset=utf-8");

$arr = include_once("../Application/Common/Conf/config.php");

$conn= mysqli_connect($arr['DB_HOST'],$arr['DB_USER'],$arr['DB_PWD']) or die("连接数据库失败!");
 mysqli_select_db($conn,$arr['DB_NAME']);
 mysqli_query($conn,"set names utf8");

 

?>