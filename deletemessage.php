<?php
$conn = mysqli_connect("localhost", "root", "", "cv1");
?>
<head>
    <title>刪除留言</title>
</head>
<body>
<script>
    alert("確定要刪除該筆留言?")
</script>
</body>
<?php
$delete = $_POST['delete'];
$result = "DELETE FROM datas WHERE id = '{$_POST['delete']}'";
$result_delete = mysqli_query($conn, $result); ?>
    <script>
        alert("刪除成功!")
    </script>
<?php
header("Refresh:0; url=./index.php");