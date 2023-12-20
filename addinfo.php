<!DOCTYPE html>
<html>

<head>
    <title>你想要对我说什么？</title>
    <link rel="stylesheet" href="./Mycss/addinfo.css">
</head>

<body>

    <div id='center'>
        <h2>欢迎使用留言板</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
            <div class="input">
                <input type="text" name="name" placeholder="请输入用户名"><br>
            </div>
            <div class="input">
                <input type="text" name="email" placeholder="邮箱"><br>
            </div>
            <label for="file-upload" class="upload-button">选择你的头像</label>
            <input id="file-upload" type="file" class="file" name="mailbox">
            <div class="message">
                <textarea name="message" placeholder="在这里输入你的留言"></textarea><br>
            </div>
            <div class="button">
                <input type="submit" value="Submit" class='提交留言'>
            </div>

        </form>

        <?php
        require_once("conn.php");

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $message = $_POST['message'];
            $mailbox = $_FILES['mailbox']['name'];

            if ($_FILES['mailbox']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = './mailbox/';
                $fileName = $_FILES['mailbox']['name'];
                $tmpFilePath = $_FILES['mailbox']['tmp_name'];
                $targetFilePath = $uploadDir . $fileName;

                if (move_uploaded_file($tmpFilePath, $targetFilePath)) {
                    echo '文件已上传至 ' . $targetFilePath;
                } else {
                    echo '移动文件时出错';
                }
            } else {
                echo '上传文件时发生错误：' . $_FILES['mailbox']['error'];
            }

            // 使用预处理语句来执行安全的数据库插入操作
            $sql = "INSERT INTO messages (name, email, message, avatar) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $name, $email, $message, $mailbox); // 绑定参数
            $stmt->execute(); // 执行预处理语句
        
            $stmt->close();
            $conn->close();

            header("Location: showinfo.php");
            exit();
        }
        ?>

    </div>
    <script src="./js/addinfo.js"></script>
</body>

</html>