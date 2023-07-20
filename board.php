<!doctype html>
<head>
<meta charset="UTF-8">
<title>게시판</title>
</head>
<body>
<div id="board_area"> 
  <h1>게시판</h1>
    <table class="list-table">
      <thead>
          <tr>
              <th width="70">번호</th>
                <th width="500">제목</th>
                <th width="120">글쓴이</th>
                <th width="100">작성일</th>
                <th width="100">조회수</th>
            </tr>
        </thead>
        <?php
         session_start();
         $host = '127.0.0.1';
         $user = 'root';
         $pw = '1234';
         $db_name = 'db1';
         $conn = new mysqli($host, $user, $pw, $db_name); //db 연결
            
        // board테이블에서 idx를 기준으로 내림차순해서 10개까지 표시
          $sql = "SELECT * from board order by number desc limit 0,10"; 
          $result = $conn->query($sql);
            while($board = $result->fetch_array(MYSQLI_ASSOC))
            {
              //title변수에 DB에서 가져온 title을 선택
              $title=$board["title"]; 
              if(strlen($title)>30)
              { 
                //title이 30을 넘어서면 ...표시
                $title=str_replace($board["title"],mb_substr($board["title"],0,30,"utf-8")."...",$board["title"]);
              }
        ?>
      <tbody>
        <tr>
          <td width="70"><?php echo $board['number']; ?></td>
          <td width="500"><?php echo $board['title'];?></td>
          <td width="120"><?php echo $board['id']?></td>
          <td width="100"><?php echo $board['date']?></td>
          <td width="100"><?php echo $board['hit']; ?></td>
        </tr>
      </tbody>
      <?php } ?>
    </table>
    <div id="write_btn">
      <a href="/write.php"><button>글쓰기</button></a>
    </div>
  </div>
</body>
</html>