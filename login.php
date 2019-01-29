<?php
session_start();
//['cookie_lifetime' => 86400]
$conn = mysqli_connect("localhost", "root", "", "cv1");

$email = preg_replace("/[^A-Za-z0-9@. ]/", "", $_POST['email']);
$password = preg_replace("/[^A-Za-z0-9@. ]/", "", $_POST['password_1']);
$email = mysqli_real_escape_string($conn, trim($_POST['email']));
$password = mysqli_real_escape_string($conn, trim($_POST['password_1']));
$password = md5($password);
//$account = $_POST['email'];
//$password = $_POST['password_1'];

$check = "SELECT * FROM members WHERE email = '$email' AND password_1 = '$password'";
$result = mysqli_query($conn, $check);

if (mysqli_num_rows($result) > 0) { ?>
    <script>
        alert("登入成功")
    </script>
    <?php
    //$_SESSION['login'] = "登入成功";
    $return = "SELECT username FROM members WHERE email = '$email'";
    $result_return = mysqli_query($conn, $return);
    $row= mysqli_fetch_assoc($result_return);
    $username = $row['username'];
    $_SESSION['username'] = "$username";//這邊不知道USERNAME是什麼，要SELECT出來
    header ("Refresh:0; url=./index.php");
} else { ?>
    <script>
        alert("登入失敗，請重新登入")
    </script>
<?php
    header ("Refresh:0; url=./index.php");
}
$conn->close();
exit();
?>