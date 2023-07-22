<?php
  session_start();
  // 세션
  if (isset($_SESSION['name'])) {
    header('Location: index.php');
  }

  // 만약에 요청 정보가 POST 방식이라면
  // 이거는 로그인 처리를 하는거 ( logincheck.php )
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include('db_config.php');
    $id = $_POST['id'];
    $pw = $_POST['pw'];

    $sql = "SELECT * FROM user WHERE id = '$id' AND pw = '$pw'";
    $result = $conn->query($sql);
    $row = $result->fetch_array(MYSQLI_ASSOC);

    if ($row != null) {
      // 세션에 사용자 정보(id,name,address)를 입력
      $_SESSION['id'] = $row['id'];
      $_SESSION['name'] = $row['name'];
      $_SESSION['address'] = $row['address'];
      echo "<script>location.replace('index.php');</script>";
      exit;
    }

    if($row == null){
      echo "<script>alert('Invalid username or password')</script>";
      echo "<script>location.replace('login.php');</script>";
      exit;
    }
  }


?>

<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="utf-8">
  <title>LOGIN</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <style>
    body {
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .loginForm {
      max-width: 400px;
      padding: 30px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .idForm, .passForm {
      margin-bottom: 20px;
    }

    .btn {
      width: 100%;
      background-color: #007BFF;
      color: #fff;
    }

    .btn:hover {
      background-color: #0056b3;
    }

    .bottomText {
      text-align: center;
    }
  </style>
</head>
<body>
  <form method="post" action="login.php" class="loginForm">
    <h2 class="text-center mb-4">Login</h2>
    <div class="idForm">
      <input type="text" name="id" class="form-control" placeholder="ID">
    </div>
    <div class="passForm">
      <input type="password" name="pw" class="form-control" placeholder="Password">
    </div>
    <button type="submit" class="btn">LOGIN</button>
    <div class="bottomText">
      <a href="register.php">Sign up</a>
    </div>
  </form>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
