<?php
 $host = '127.0.0.1';
 $user = 'root';
 $pw = '1234';
 $db_name = 'db1';
 $conn = new mysqli($host, $user, $pw, $db_name); //db 연결

	$userid = $_POST['userid'];
	$userpw = $_POST['userpw'];
	$username = $_POST['name'];
	$adress = $_POST['adress'];
	$sex = $_POST['sex'];
	$email = $_POST['email'];

$sql = "insert into user (id,pw,name,address,sex,email) values('$userid','$userpw','$username','$adress','$sex','$email');";
if ($conn->query($sql) == TRUE ){
	echo "<script>alert('sign up completed');location.href='login.php';</script>";
}
else{
	"<script>alert('error');location.href='login.php';</script>";
}
?>