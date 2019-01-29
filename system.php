<!-- 登入、忘記密碼、註冊表格-->
<html>
<head>
    <title>會員系統</title>
</head>
<body>
    <div>
        <form method="POST" action="login.php"> <!--登入的表格-->
            <h3>帳號 (請輸入email) : <input type="text" name="email"></h3>
            <h3>密碼 : <input type="password" name="password_1"></h3><br>
            <h3><input type="submit" name="login" value="送出"></h3>
        </form>
    </div>
    <div>
        <form method="POST" action="forgetpw.php">
            <h3><input type="submit" name="forgetpw" value="忘記密碼"</h3>
        </form>
    </div>
<hr>
    <a href="./register.php">註冊</a>
</body>
</html>