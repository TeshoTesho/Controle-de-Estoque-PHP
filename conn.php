<?php


//conexão
$hostname = 'localhost';
$username ='root'; 
$senha = ''; 
$banco = 'db_estoque';
$connect = mysqli_connect($hostname,$username,$senha,$banco);
$connect -> set_charset("utf8");

?>