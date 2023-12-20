<!DOCTYPE html>
<html>

<head>
    <title>你想要对我说什么？</title>
    <link rel="stylesheet" href="./Mycss/addinfo.css">
</head>

<body>

    <div id='center'>
        <h2>欢迎使用留言板</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="input">
                <input type="text" name="name" placeholder="请输入用户名"><br>
            </div>
            <div class="input">
                <input type="text" name="email" placeholder="邮箱"><br>
            </div>
            <div class="message">
                <textarea name="message" placeholder="在这里输入你的留言"></textarea><br>
            </div>
            <div class="button">
                <input type="submit" value="Submit" class='提交留言'>
            </div>


        </form>

        <?php
        require_once("conn.php");
        // 检查表单提交
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // 获取表单数据
            $name = $_POST['name'];
            $email = $_POST['email'];
            $message = $_POST['message'];

            // 准备 SQL 语句并执行插入
            // 准备 SQL 语句并执行插入
            $sql = "INSERT INTO messages (name, email, message) VALUES ('$name', '$email', '$message')";

            $conn->query($sql);
            header("Location: showinfo.php");
            exit(); // 确保在重定向后立即退出脚本

        }

        // 关闭连接
        $conn->close();
        ?>
    </div>
    <script src="./js/addinfo.js"></script>
</body>

</html>