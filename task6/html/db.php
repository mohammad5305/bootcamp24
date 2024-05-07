<?php 
$db = new SQLite3('/tmp/blog.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
$db->query('CREATE TABLE IF NOT EXISTS "blogs" (
    "id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    "title" VARCHAR NOT NULL,
    "content" VARCHAR NOT NULL,
    "time" DATETIME
)');

if (array_values($db->querySingle("SELECT COUNT(*) FROM blogs", true))[0] == 0) {
    $db->exec('BEGIN');
    $db->query('INSERT INTO "blogs" ("title", "content", "time")
        VALUES ("Test", "hello world", "2017-01-14 10:11:23")');

    $db->query('INSERT INTO "blogs" ("title", "content", "time")
        VALUES ("bye", "bye world\n second line :D", "2018-01-14 10:11:23")');
    $db->exec('COMMIT');
}


$db->close();
?>
