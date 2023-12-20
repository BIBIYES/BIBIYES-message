<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
// 声明三个变量名接受主机数据库名数据库密码
$server = "localhost";
$username = "root";
$password = 'root';
//新建链接对象
$conn = new mysqli($server, $username, $password,'message_board');
//如果链接失败就输出连接对象里的错误信息
if ($conn->connect_error) {
    // 终止代码，并输出连接错误信息
    die('连接失败'. $conn->connect_error);
}

?>
</body>
</html>