<?php //此頁為清除SESSION的狀態，並導回主頁。
session_start();
//unset($_SESSION['login']);
unset($_SESSION['username']); ?>
    <script>
        alert("登出成功")
    </script>
<?php header ("Refresh:0; url=./index.php"); ?>