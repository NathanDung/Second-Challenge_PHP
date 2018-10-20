<?php //此頁用來填寫新增留言。
session_start(); ?>
    <html>
    <head>
        <title>新增留言</title>
    </head>
<?php if (isset($_SESSION['username'])) { ?>
    <body>
    <form method="POST" action="list.php">
        <!-- <h3>Nickname : <input type="text" name="name"></h3><br> -->
        <h3><?php echo "Name : ".$_SESSION['username']."<br>" ?></h3>
        <h3>Message : <textarea rows="4" cols="50" type="text" name="message"></textarea></h3><br>
        <input type="submit" name="send" value="送出"><br>
    </form>
    <form method="POST" action="modify_message.php">
        <input type="submit" name="modify_message" value="修改留言">
    </form>
    </body>
    </html>
<?php } else {
    echo "請先登入";
    header ("Location: ./system.php");
}
?>