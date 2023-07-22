<?php
include('../db_config.php');

// 세션확인
session_start();
if (!isset($_SESSION['name'])) {
    echo "<script>alert('로그인 후 이용해주세요.');location.href='/login.php';</script>";
}

$sql = "SELECT * FROM board ORDER BY date DESC";
$result = $conn->query($sql);
$posts = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $posts[] = $row;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>게시판</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h1>게시판</h1>
        <div class="mb-3">
            <a href="write.php" class="btn btn-primary">게시글 작성</a>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>제목</th>
                    <th>작성자</th>
                    <th>작성일</th>
                    <th>조회수</th>
                    <th>비밀글</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($posts as $post) : ?>
                    <td><?= $post['idx'] ?></td>
                    <td>
                        <?php if ($post['is_secret']) : ?>
                            <a href="#" onclick="checkPassword(<?= $post['idx'] ?>)"><?= $post['title'] ?></a>
                        <?php else : ?>
                            <a href="view.php?idx=<?= $post['idx'] ?>"><?= $post['title'] ?></a>
                        <?php endif; ?>
                    </td>
                    <td><?= $post['userid'] ?></td>
                    <td><?= $post['date'] ?></td>
                    <td><?= $post['hit_count'] ?></td>
                    <td><?= $post['is_secret'] ? 'O' : 'X' ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</body>
</html>

<script>
    function checkPassword(postIdx) {
        const password = prompt('비밀번호를 입력해주세요:');
        if (password !== null) {
            window.location.href = `view.php?idx=${postIdx}&pw=${password}`;
        }
    }
</script>