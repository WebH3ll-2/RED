<?php
session_start(); // 세션 시작

// 로그인 여부 확인
if (!isset($_SESSION['name'])) {
    echo "<script>alert('로그인 후 이용해주세요.');location.href='/login.php';</script>";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userid = $_SESSION['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $date = date("Y-m-d H:i:s");

    // 비밀번호 필드와 체크박스 상태 확인
    $pw = ""; // 기본값은 빈 문자열로 설정
    $isSecret = isset($_POST['isSecret']) && $_POST['isSecret'] == 'on';

    if ($isSecret) {
        $pw = $_POST['pw'];
    }

    include('../db_config.php');

    // 이미지 업로드 처리
    $target_dir = "uploads/"; // 이미지를 업로드할 디렉토리
    $target_file = $target_dir . basename($_FILES["image"]["name"]); // 업로드할 파일 경로
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION)); // 파일 확장자

    // 이미지 파일 업로드
    if (isset($_FILES["image"]["tmp_name"]) && move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        // 게시글 저장
        $sql = "INSERT INTO board (userid, pw, title, content, image, date, is_secret ) VALUES ('$userid', '$pw', '$title', '$content', '$target_file', '$date', $isSecret)";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('게시글이 작성되었습니다.');location.href='index.php';</script>";
        } else {
            echo "<script>alert('오류가 발생했습니다. 다시 시도해주세요.');</script>";
        }
    } else {
        // 이미지 업로드 실패 시에도 게시글 저장
        $sql = "INSERT INTO board (userid, pw, title, content, date, is_secret ) VALUES ('$userid', '$pw', '$title', '$content', '$date', $isSecret)";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('게시글이 작성되었습니다.');location.href='index.php';</script>";
        } else {
            echo "<script>alert('오류가 발생했습니다. 다시 시도해주세요.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>게시글 작성</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h1>게시글 작성</h1>
        <form method="post" id="writeForm" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="isSecret" class="form-check-label">비밀글 여부</label>
                <input type="checkbox" name="isSecret" class="form-check-input" id="isSecretCheckbox" onchange="togglePasswordField()">
            </div>
            <div class="mb-3" id="pwFieldDiv" style="display: none;">
                <label for="pw" class="form-label">비밀번호</label>
                <input type="password" name="pw" id="pwField" class="form-control">
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">제목</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">내용</label>
                <textarea name="content" class="form-control" rows="5" required></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">이미지 업로드</label>
                <input type="file" name="image" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">작성</button>
        </form>
    </div>

    <script>
        function togglePasswordField() {
            const isSecretCheckbox = document.getElementById('isSecretCheckbox');
            const pwFieldDiv = document.getElementById('pwFieldDiv');

            pwFieldDiv.style.display = isSecretCheckbox.checked ? 'block' : 'none';
        }
    </script>
</body>
</html>