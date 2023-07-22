<?php
    session_start(); // 세션 시작

    include('../db_config.php');

    // 게시글 가져오기
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['idx'])) {
        $idx = $_GET['idx'];
        $sql = "SELECT * FROM board WHERE idx = $idx";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $post = $result->fetch_assoc();

            // 비밀글일 경우 비밀번호 검증
            if ($post['is_secret'] == 1) {
                if (isset($_GET['pw']) && $_GET['pw'] == $post['pw']) {
                    // 비밀번호가 일치하는 경우
                    // 게시글 내용 표시
                } else {
                    // 비밀번호가 일치하지 않는 경우
                    echo "<script>alert('비밀번호가 일치하지 않습니다.');location.href='index.php';</script>";
                    exit;
                }
            }
        } else {
            echo "<script>alert('존재하지 않는 게시글입니다.');location.href='index.php';</script>";
            exit;
        }
    } else {
        echo "<script>alert('잘못된 접근입니다.');location.href='index.php';</script>";
        exit;
    }

    // 게시글 조회수 증가
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['idx'])) {
        $idx = $_GET['idx'];
        $sql = "UPDATE board SET hit_count = hit_count + 1 WHERE idx = $idx";
        $conn->query($sql);
    }


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>게시글 보기</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h1><?= $post['title'] ?></h1>
        <p><?= $post['userid'] ?> | <?= $post['date'] ?> | 조회수: <?= $post['hit_count'] ?></p>
        <hr>
        <?php if (!empty($post['image'])) : ?>
            <img src="<?= $post['image'] ?>" alt="이미지" class="img-fluid">
            <hr>
        <?php endif; ?>
        <p><?= nl2br($post['content']) ?></p>
        <a href="index.php" class="btn btn-primary">목록으로</a>
    </div>
</body>
</html>