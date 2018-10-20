<?php
//session_start();
$conn = mysqli_connect("localhost", "root", "", "cv1");

$test = mysqli_real_escape_string($conn, trim($_POST['fixmessage_db']));
if (!empty($test)) {
    $test_1 = "UPDATE datas SET message = '$test' WHERE id = '{$_POST['id']}'";
    $result = mysqli_query($conn, $test_1); ?>
    <script>
        alert("修改留言成功")
    </script>
    <?php
    header("Refresh:0; url=./index.php");
} else { ?>
    <script>
        alert("欄位請勿空白，請重新輸入")
    </script>
    <?php
    header("Refresh:0; url=./modify_message.php");
}
//用什麼東西判斷這筆是要修改的那筆?ID?如果要用ID判斷，那需要多送一次隱藏的ID
//接收POST，判斷空值，保護資料庫，存入，錯誤則返回輸入頁，成功則導向主頁