<!DOCTYPE html>
<html>

<head>
    <title>编辑留言</title>
    <link rel="stylesheet" href="./Mycss/addinfo.css">
</head>

<body>

    <div id='center'>
        <h2>说错话了吗？</h2>
        <?php
        require_once("conn.php");
        
        // 检查是否传入了有效的 ID
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            
            // 查询数据库获取对应 ID 的信息
            $sql = "SELECT * FROM messages WHERE id = $id";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $name = $row['name'];
                $email = $row['email'];
                $message = $row['message'];
                $avatar = $row['avatar'];

                // 显示表单，并将获取的信息填入对应字段
                echo '<form method="post" action="' . $_SERVER['PHP_SELF'] . '" enctype="multipart/form-data">';
                echo '<input type="hidden" name="id" value="' . $id . '">';
                echo '<div class="input">';
                echo '<input type="text" name="name" placeholder="请输入用户名" value="' . $name . '"><br>';
                echo '</div>';
                echo '<div class="input">';
                echo '<input type="text" name="email" placeholder="邮箱" value="' . $email . '"><br>';
                echo '</div>';
                echo "<label for='file-upload' class='upload-button'>选择你的头像</label>";
                echo '<input id="file-upload" class="file" type="file" name="mailbox" value="' . $avatar . '">';
                echo '<div class="message">';
                echo '<textarea name="message" placeholder="在这里输入你的留言">' . $message . '</textarea><br>';
                echo '</div>';
                echo '<div class="button">';
                echo '<input type="submit" value="完成修改！" class="提交留言">';
                echo '</div>';
                echo '</form>';
            } else {
                echo "未找到对应的留言";
            }
        } else {
            echo "未传入有效的ID";
        }

        // 处理表单提交
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $message = $_POST['message'];
            $mailbox = $_FILES['mailbox']['name'];

            // 处理文件上传，你之前的代码已经包含了这部分的逻辑，可以直接使用

            // 更新数据库中对应 ID 的信息
            $sql = "UPDATE messages SET name='$name', email='$email', message='$message', avatar='$mailbox' WHERE id=$id";
            $result = $conn->query($sql);

            if ($result) {
                echo "留言已成功更新";
                // 可以添加重定向或其他操作
                header("Location: showinfo.php");
            } else {
                echo "更新留言时出错：" . $conn->error;
            }
        }

        // 关闭连接
        $conn->close();
        ?>
    </div>
    <script src="./js/addinfo.js"></script>
</body>

</html>
