<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "cv1");

$result_session = $_SESSION['username'];

$select = "SELECT * FROM datas WHERE username = '$result_session' ORDER BY create_time DESC";
$result = mysqli_query($conn, $select);?>
<head>
    <title>留言筆數</title>
</head>
<body>
    <h1>留言筆數</h1>
<hr>
<div>
    <table border="1">
        <tr><th><?php echo "Name"; ?></th><th><?php echo "Message"; ?></th><th><?php echo "functions"; ?></th></tr>
<?php $i = 0;
while ($i < $row = mysqli_num_rows($result)) {
    $row = mysqli_fetch_assoc($result);?>
        <tr>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['message'];
                $i++; ?>
                </td>
            <td>
                <form method="GET" action="fixmessage.php">
                    <input type="hidden" name="fix" value="<?php echo $row['id']; ?>">
                    <input type="submit" name="fixmessage" value="修改留言">
                </form>
                <form method="POST" action="deletemessage.php">
                    <input type="hidden" name="delete" value="<?php echo $row['id']; ?>">
                    <input type="submit" name="deletemessage" value="刪除留言">
                </form>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>
</body>