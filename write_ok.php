<?php
 $host = '127.0.0.1';
 $user = 'root';
 $pw = '1234';
 $db_name = 'db1';
 $conn = new mysqli($host, $user, $pw, $db_name); //db 연결

$write_name = $_POST['name'];
$write_pw = $_POST['pw'];
$title = $_POST['title'];
$content = $_POST['content'];
$date = date('Y-m-d');
if($write_name && $write_pw && $title && $content){
    $sql = "insert into board(title, content, id, pw, date) values('$username','$userpw','$title','$content','$date')";
    if ($conn->query($sql) == TRUE ){
        echo "<script>
        alert('글쓰기 완료되었습니다.');
        location.href='board.php';</script>";
    }
}else{
    echo "<script>alert('글쓰기에 실패했습니다.');history.back();</script>";
}
?>