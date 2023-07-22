# RED

## DB 변경

```sql
-- 기존 board 테이블 지우기
DROP TABLE board;

-- 새로운 board 테이블 생성
CREATE TABLE board (
    idx INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    userid VARCHAR(50) NOT NULL,
    title VARCHAR(100) NOT NULL,
    content TEXT NOT NULL,
    image VARCHAR(255),
    date DATETIME NOT NULL,
    hit_count INT(11) DEFAULT 0,
    pw VARCHAR(50),
    is_secret TINYINT(4) NOT NULL DEFAULT 0
);

```