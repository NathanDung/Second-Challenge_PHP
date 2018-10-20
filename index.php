<?php session_start(); ?>
    <style>
        table {
            border: 1px solid #666;
            border-collapse: collapse;
            text-align:center;
            width:70%;
        }
        tr, td {
            border: 1px solid #666;
        }
        td:hover {
            background-color: #E6FBFF;
        }
        tr:nth-child(even) {
            background: #CCC
        }
        tr:nth-child(odd) {
            background-color: #FAFAFA;
        }
    </style>
<h1>留言板</h1>
<hr>
    <div align="right">
        <?php
        if (isset($_SESSION['username'])) {
            echo $_SESSION['username']."會員，您好";?>
            <form method="POST" action="logout.php">
        <input type="submit" name="logout" value="登出"><br>
    </form>
    </div>
    <div align="right">
            <?php
            if (isset($_SESSION['username'])) {?>
        <form method="POST" action="modify.php">
            <input type="submit" name="modify" value="修改密碼">
        </form>
                <?php } ?>
    </div>
<?php        }
$conn = mysqli_connect('localhost', 'root', '', 'cv1');
$result = "SELECT * FROM datas ORDER BY create_time DESC";
$result = mysqli_query($conn, $result);
$test = "SELECT * FROM datas";
$result = mysqli_query($conn, $test);
$a = 0;
while ($a < $result_row = mysqli_num_rows($result)) {
    $a++;
}
if ($row = mysqli_num_rows($result) > 0) { ?>
<div>
    <table border="1">
    <tr><th><?php echo "Total ".$a." messages"?></th><th><?php echo "Name"; ?></th><th><?php echo "Content"; ?></th><th><?php echo "Time"; ?></th></tr>

    <?php $b = 1;
        while ($b < $result_row = mysqli_num_rows($result)) {
            while($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $b; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['message']; ?></td>
                    <td><?php echo $row['update_time']; ?></td>
            </tr>
            <?php $b++;
        }
    }
} else {
    echo "0 结果";
}
?>
    </table>
</div>
<!--    --><?php
//        if(! isset($_SESSION['login'])) {
//            header ("Location: ./system.php");
//        }
//        ?>
<hr>
<form method="POST" action="message.php">
    <input type="submit" name="message" value="留言">
</form>