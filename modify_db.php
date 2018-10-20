<?php //此頁用來修改密碼，成功後導到登入畫面
session_start();

$conn = mysqli_connect("localhost", "root", "", "cv1");

$old_password_check = preg_match("/^([A-Za-z0-9]{7,30})$/", $_POST['old_password']);
$new_password_1_check = preg_match("/^([A-Za-z0-9]{7,30})$/", $_POST['new_password_1']);
$new_password_2_check = preg_match("/^([A-Za-z0-9]{7,30})$/", $_POST['new_password_2']);
$old_password = mysqli_real_escape_string($conn, trim($_POST['old_password']));
$new_password_1 = mysqli_real_escape_string($conn, trim($_POST['new_password_1']));
$new_password_2 = mysqli_real_escape_string($conn, trim($_POST['new_password_2']));
$old_password = md5($old_password);
$new_password_1 = md5($new_password_1);
$new_password_2 = md5($new_password_2);

$result_session = $_SESSION['username'];

if (isset($old_password) && isset($new_password_1) && isset($new_password_2)) {
    if ($old_password_check == 1 && $new_password_1_check == 1 && $new_password_2_check == 1) {
        $check = "SELECT password_1, password_2 FROM members WHERE username = '$result_session'";
        $result_check = mysqli_query($conn, $check);
        $row = mysqli_fetch_assoc($result_check);
        if ($old_password == $row['password_1'] && $old_password == $row['password_2']) {
            if ($new_password_1 == $new_password_2) {
                $new = "UPDATE members SET password_1 = '$new_password_1', password_2 = '$new_password_2' WHERE username = '$result_session'";
                $result_new = mysqli_query($conn, $new); ?>
                <script>
                    alert("密碼更新完成，請重新登入")
                </script>
                <?php
                    unset($_SESSION['username']);
                    header("Refresh:0; url=./system.php");
            } else { ?>
                <script>
                    alert("新密碼及驗證碼輸入錯誤，請重新輸入")
                </script>
                <?php
                header("Refresh:0; url=./modify.php");
            }
        } else { ?>
            <script>
                alert("舊密碼輸入錯誤，請重新輸入")
            </script>
            <?php
            header("Refresh:0; url=./modify.php");
        }
    } else { ?>
        <script>
            alert("輸入錯誤，請重新輸入")
        </script>
        <?php
        header("Refresh:0; url=./modify.php");
    }
} else { ?>
    <script>
        alert("輸入錯誤，請重新輸入")
    </script>
    <?php
    header("Refresh:0; url=./modify.php");
}
?>