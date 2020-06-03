<?php
$servername = '123.56.3.135';
$dbusername = 'root';
$dbpassword = '123456';
$dbname = 'web';
$port = '3306';
// 创建连接
$conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname,$port);
// 检测连接
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>