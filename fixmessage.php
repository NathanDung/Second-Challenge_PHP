<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "cv1");
$result_session = $_SESSION['username']; ?>
<head>
    <title>修改留言</title>
</head>
<body>
    <h1>修改留言</h1>
    <hr>
    <?php
        $test = "SELECT * FROM datas WHERE id = '{$_GET['fix']}'";
        $result = mysqli_query($conn, $test);
        $row = mysqli_fetch_assoc($result);
    ?>
    <h3>原有留言</h3>
    <div>
        <table border="1">
            <tr><th><?php echo "Message"; ?></th></tr>
            <tr>
                <td><?php echo $row['message']; ?></td>
            </tr>
        </table>
    </div>
    <hr>
    <h3>新留言</h3>
    <form method="POST" action="fixmessage_db.php">
        <h3>Message : <textarea rows="4" cols="50" type="text" name="fixmessage_db"></textarea></h3>
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <input type="submit" name="submit" value="送出">
    </form>
</body>