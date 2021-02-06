<?php
header('Content-Type: text/html; charset=utf-8');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pl";
$db=mysqli_connect($servername,$username,$password,$dbname) or die('Error');
$sql="set names 'utf8'";
mysqli_query($db,$sql);
$sql="set character set 'utf8'";
mysqli_query($db,$sql);
?>