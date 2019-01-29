<?php //此頁用來送出要修改密碼的資料
session_start();
?>
<form method="POST" action="modify_db.php">
    <h3>舊密碼 : <input type="password" name="old_password"></h3>
    <h3>新密碼 : <input type="password" name="new_password_1"></h3>
    <h3>確認新密碼 : <input type="password" name="new_password_2"</h3>
    <h3><input type="submit" name="modify" value="送出"</h3>
</form>