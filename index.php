<?php
session_start();
// 만약 로그인이 되어있지 않다면 로그인 페이지로 이동
// 로그인이 되어있다면 게시판(./board/index.php으로 이동
if (!isset($_SESSION['name'])) {
  header('Location: /login.php');
} else {
  header('Location: /board/index.php');
}