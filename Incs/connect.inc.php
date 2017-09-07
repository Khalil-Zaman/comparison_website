<?php
$conn_error = "Could not connect";

$mysql_host = "localhost";
$mysql_user = "root";
$mysql_pass = "";

$mysql_db = "laptops";

if (!@mysql_connect($mysql_host, $mysql_user, $mysql_pass) || !@mysql_select_db($mysql_db)){	
	die ($conn_error.mysql_error);
}

?>
 <?php 
/*
$link = mysql_connect('whichtopickcom.ipagemysql.com', 'whichtopickcom', 'Lilahk3121996!'); 
if (!$link) { 
    die('Could not connect: ' . mysql_error()); 
}
mysql_select_db(compare1); 
*/?> 