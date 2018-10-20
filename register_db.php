<?php //此頁用來註冊新會員資料，成功後導回登入頁面
$conn = mysqli_connect("localhost", "root", "", "cv1");

$username_check = preg_match("/^([A-Za-z0-9]{3,30})$/", $_POST['username']);
$email_check = preg_match("/^([A-Za-z0-9\-\.]{3,30})+\@([A-Za-z0-9\-\.]{3,30})$/", $_POST['email']);
$password_1_check = preg_match("/^([A-Za-z0-9]{7,30})$/", $_POST['password_1']);
$password_2_check = preg_match("/^([A-Za-z0-9]{7,30})$/", $_POST['password_2']);
$username = mysqli_real_escape_string($conn, trim($_POST['username']));
$email = mysqli_real_escape_string($conn, trim($_POST['email']));
$password_1 = mysqli_real_escape_string($conn, trim($_POST['password_1']));
//$hash = hash('SHA256', $password_1);
//更正，密碼儲存的部分。
//COOKIE存活時間，或寫在單支程式，使用引用的方式。
$password_2 = mysqli_real_escape_string($conn, trim($_POST['password_2']));

$check_email = "SELECT email, username FROM members WHERE email = '$email' OR username = '$username'";
$result = mysqli_query($conn, $check_email);
if (mysqli_num_rows($result) == 0) {
    if ($password_1 == $password_2) {
        if ($username_check == 1 && $email_check == 1 && $password_1_check == 1 && $password_2_check ==1) {
            if ($username !== null && $email !== null && $password_1 !== null && $password_2 !== null) {
                $register = "INSERT INTO members (username, email, password_1, password_2) VALUES ('$username', '$email', md5('$password_1'), md5('$password_2'))";
                if (mysqli_query($conn, $register) == 1) { ?>
                    <script>
                        alert("註冊成功")
                    </script>
                    <?php
                    header("Refresh:0; url=./system.php");
                } else { ?>
                    <script>
                        alert("格式有誤，請重新輸入")
                    </script>
                    <?php header("Refresh:0; url=./register.php");
                }
            } else { ?>
                <script>
                    alert("欄位不可為空，請重新輸入")
                </script>
                <?php header("Refresh:0; url=./register.php");
            }
        }else { ?>
            <script>
                alert("格式有誤，請重新輸入")
            </script>
            <?php header("Refresh:0; url=./register.php");
        }
    } else { ?>
        <script>
            alert("密碼及驗證密碼不同，請重新輸入")
        </script>
        <?php header("Refresh:0; url=./register.php");
    }
}else { ?>
    <script>
        alert("使用者名稱或Email重複，請重新輸入")
    </script>
    <?php header("Refresh:0; url=./register.php");
}
$conn->close();
?>