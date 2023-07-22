<?php
	// 만약 post 요청이면 회원가입 처리 ( member.php )
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		include('./db_config.php');

		$userid = $_POST['userid'];
		$userpw = $_POST['userpw'];
		$username = $_POST['name'];
		$adress = $_POST['adress'];
		$sex = $_POST['sex'];
		$email = $_POST['email'];

		$sql = "INSERT INTO user (id, pw, name, address, sex, email) VALUES ('$userid', '$userpw', '$username', '$adress', '$sex', '$email');";
		if ($conn->query($sql) === TRUE) {
			echo "<script>alert('sign up completed');location.href='login.php';</script>";
		} else {
			echo "<script>alert('error');location.href='login.php';</script>";
		}
	}


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>회원가입 폼</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
	<form method="post" action="register.php" class="container mt-5">
		<h1 class="mb-4">회원가입 폼</h1>
		<fieldset>
			<legend>입력사항</legend>
			<table class="table table-borderless">
				<tr>
					<td>아이디</td>
					<td><input type="text" size="35" name="userid" placeholder="아이디" class="form-control" required></td>
				</tr>
				<tr>
					<td>비밀번호</td>
					<td><input type="password" size="35" name="userpw" placeholder="비밀번호" class="form-control" required></td>
				</tr>
				<tr>
					<td>이름</td>
					<td><input type="text" size="35" name="name" placeholder="이름" class="form-control" required></td>
				</tr>
				<tr>
					<td>주소</td>
					<td><input type="text" size="35" name="adress" placeholder="주소" class="form-control" required></td>
				</tr>
				<tr>
					<td>성별</td>
					<td>남<input type="radio" name="sex" value="남" class="form-check-input"> 여<input type="radio" name="sex" value="여" class="form-check-input"></td>
				</tr>
				<tr>
					<td>이메일</td>
					<td><input type="text" size='35' name="email" placeholder='이메일' class="form-control" required></td>
				</tr>
			</table>
			<input type="submit" value="가입하기" class="btn btn-primary" /><input type="reset" value="다시쓰기" class="btn btn-secondary" />
		</fieldset>
	</form>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
