<?php 
include 'header.php';

if (! isset($_SESSION['name'])) {
    header('location: login.php');
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new SQLite3('/tmp/blog.sqlite', SQLITE3_OPEN_READWRITE);
    $now = new DateTime('now');
    $statement = $db->prepare('INSERT INTO "blogs" ("title", "content", "time")
        VALUES (:title, :content, datetime("now"))');
    $statement->bindValue(':title', $_POST['title']);
    $statement->bindValue(':content', $_POST['content']);

    $statement->execute();
}
?>

<h2>Create Post</h2>
<form class="editor" action="new.php" method="POST">
<input class="title" name="title" placeholder="title"><br/>
<textarea class="content" name="content" placeholder="content..."></textarea><br/>
<button type="submit">Submit</button>
</form>
