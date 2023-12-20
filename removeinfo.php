<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>子豪的留言板</title>
    <link rel="stylesheet" href="./Mycss/removeinfo.css">
</head>

<body>
    <h1>欢迎root用户</h1>
    <div id="nav">
        <div class="navigation"><a href="./showinfo.php">去留言大厅</a></div>
    </div>
    <?php
    require_once('conn.php');

    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $offset = ($page - 1) * 5;

    $sql = "SELECT * FROM messages LIMIT $offset, 5";
    $result = $conn->query($sql);
    echo "<div id='center'>";
    if ($result->num_rows > 0) {

        echo "<table>";
        echo "<tr><th>id</th><th>用户名</th><th>邮箱</th><th>发送时间</th><th>内容</th><th>操作</th></tr>";

        while ($row = $result->fetch_assoc()) {

            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["name"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["created_at"] . "</td>";
            echo "<td>" . $row["message"] . "</td>";
            echo "<td><a href='removeinfo.php?id=" . $row["id"] . "'> <img src='./images/垃圾桶.svg'></a></td>";
            echo "</tr>";
        }


        echo "</table>";

    } else {
        echo "No messages found";
    }

    $total_sql = "SELECT COUNT(*) FROM messages";
    $total_result = $conn->query($total_sql);
    $total_row = $total_result->fetch_array();
    $total = ceil($total_row[0] / 5);

    echo "<div class='next'>";
    if ($page > 1) {
        echo "<a href='?page=1'>首页</a>";
        echo "<a href='?page=" . ($page - 1) . "'>上一页</a>";
    }

    for ($i = 1; $i <= $total; $i++) {
        echo "<a href='?page=$i'>$i</a>";
    }

    if ($page < $total) {
        echo "<a href='?page=" . ($page + 1) . "'>下一页</a>";
        echo "<a href='?page=$total'>末页</a>";
    }
    echo "</div>";
    echo "</div>";
    // 删除片段
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // 删除指定 ID 的留言
        $delete_sql = "DELETE FROM messages WHERE id = ?";
        $stmt = $conn->prepare($delete_sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();

        // 重定向回留言列表页面
        header("Location: removeinfo.php");
        exit();
    }

    $conn->close();
    ?>
</body>

</html>