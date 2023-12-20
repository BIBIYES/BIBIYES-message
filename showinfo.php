<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>子豪的留言板</title>
    <link rel="stylesheet" href="./Mycss/showinfo.css">
</head>

<body>
    <h1>对我的项目有什么意向呢？欢迎留言~</h1>
    <div id="nav">
        <div class="navigation"><a href="./addinfo.php">去留言</a></div>
        <div class="navigation"><a href="./login.html">去管理</a></div>
    </div>

    <?php
    require_once('conn.php');

    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $offset = ($page - 1) * 5;

    $sql = "SELECT * FROM messages ORDER BY created_at DESC LIMIT $offset, 5";

    $result = $conn->query($sql);
    $count = 0;
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='centent'>";
            if ($count === 0) {
                echo "<div class='remove'><a href='./mvinfo.php?id=" . $row['id'] . "'>编辑</a></div>";
            }
            $count = 1;
            echo "<div class='avatar'><img src='" . "./mailbox/" . $row['avatar'] . "'></div>";
            echo "<p>昵称: " . $row["name"] . "</p>";
            echo "<p class='email'>邮件: " . $row["email"] . "</p>";
            echo "<p>内容: " . $row["message"] . "</p>";
            echo "<p class='left'>留言时间: " . $row["created_at"] . "</p>";
            echo "</div>";

        }
    } else {
        echo "No messages found";
    }

    $total_sql = "SELECT COUNT(*) FROM messages";
    $total_result = $conn->query($total_sql);
    $total_row = $total_result->fetch_array();
    $total = ceil($total_row[0] / 5);

    echo "<div class='centent'>";
    if ($page > 1) {
        echo "<div class='page-link'><a href='?page=1'>首页</a></div> ";
        echo "<div class='page-link'><a href='?page=" . ($page - 1) . "'>上一页</a></div> ";
    }

    for ($i = 1; $i <= $total; $i++) {
        echo "<div class='page-link'><a href='?page=$i'>$i</a></div> ";
    }

    if ($page < $total) {
        echo "<div class='page-link'><a href='?page=" . ($page + 1) . "'>下一页</a></div> ";
        echo "<div class='page-link'><a href='?page=$total'>末页</a></div> ";
    }
    echo "</div>";

    $conn->close();
    ?>
    <script src="./js/showinfo.js"></script>
</body>

</html>